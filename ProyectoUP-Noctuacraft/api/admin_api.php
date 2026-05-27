<?php
// ============================================
// Noctuacraft — API de Administración
// Endpoints: login, logout, crear, editar, eliminar, listar
// Protegido por sesión PHP. Siempre responde JSON.
// ============================================

session_start();
header('Content-Type: application/json; charset=utf-8');

// Contraseña del admin (hardcodeada)
define('ADMIN_PASSWORD', 'noctuacraft2025');

// Obtener acción
$action = isset($_POST['action']) ? $_POST['action'] : '';

// --- LOGIN (no requiere sesión previa ni base de datos) ---
if ($action === 'login') {
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged'] = true;
        echo json_encode(['success' => true]);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Contraseña incorrecta']);
    }
    exit;
}

// --- Verificar sesión para todas las demás acciones ---
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

// --- LOGOUT (no requiere base de datos) ---
if ($action === 'logout') {
    session_destroy();
    echo json_encode(['success' => true]);
    exit;
}

// --- Conectar a la base de datos (solo para acciones que la necesitan) ---
require_once __DIR__ . '/../db/conexion.php';

// --- LISTAR (todos los productos para el panel admin) ---
if ($action === 'listar') {
    $query = "
        SELECT p.id, p.nombre, p.precio, p.categoria,
               (SELECT pi.ruta FROM producto_imagenes pi 
                WHERE pi.producto_id = p.id 
                ORDER BY pi.orden ASC LIMIT 1) AS imagen_principal
        FROM productos p
        ORDER BY p.created_at DESC
    ";
    $result = mysqli_query($conn, $query);

    $productos = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $row['precio'] = floatval($row['precio']);
            $productos[] = $row;
        }
    }

    echo json_encode($productos);
    mysqli_close($conn);
    exit;
}

// --- CREAR ---
if ($action === 'crear') {
    $nombre      = isset($_POST['nombre']) ? mysqli_real_escape_string($conn, trim($_POST['nombre'])) : '';
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($conn, trim($_POST['descripcion'])) : '';
    $precio      = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
    $categoria   = isset($_POST['categoria']) ? mysqli_real_escape_string($conn, $_POST['categoria']) : '';

    // Validaciones
    if ($nombre === '' || $descripcion === '' || $categoria === '') {
        http_response_code(400);
        echo json_encode(['error' => 'Nombre, descripción y categoría son campos obligatorios.']);
        mysqli_close($conn);
        exit;
    }

    if ($precio <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'El precio debe ser un número positivo.']);
        mysqli_close($conn);
        exit;
    }

    $categorias_validas = ['llaveros', 'deco_hogar', 'utilidades', 'juegos'];
    if (!in_array($categoria, $categorias_validas)) {
        http_response_code(400);
        echo json_encode(['error' => 'Categoría inválida.']);
        mysqli_close($conn);
        exit;
    }

    // Verificar nombre único
    $check = mysqli_query($conn, "SELECT id FROM productos WHERE nombre = '$nombre' LIMIT 1");
    if ($check && mysqli_num_rows($check) > 0) {
        http_response_code(409);
        echo json_encode(['error' => 'Ya existe un producto con ese nombre.']);
        mysqli_close($conn);
        exit;
    }

    // Insertar producto
    $query = "INSERT INTO productos (nombre, descripcion, precio, categoria) 
              VALUES ('$nombre', '$descripcion', $precio, '$categoria')";

    if (!mysqli_query($conn, $query)) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al crear el producto: ' . mysqli_error($conn)]);
        mysqli_close($conn);
        exit;
    }

    $producto_id = mysqli_insert_id($conn);

    // Procesar imágenes (base64 ya convertidas a WebP en el navegador)
    $img_dir = __DIR__ . '/../assets/img/productos/' . $producto_id;
    if (!is_dir($img_dir)) {
        mkdir($img_dir, 0777, true);
    }

    // Las imágenes vienen como imagenes[] en POST
    if (isset($_POST['imagenes']) && is_array($_POST['imagenes'])) {
        $orden = 0;
        foreach ($_POST['imagenes'] as $base64) {
            $orden++;
            // Remover el prefijo data:image/webp;base64, si existe
            $base64_clean = preg_replace('/^data:image\/\w+;base64,/', '', $base64);
            $img_data = base64_decode($base64_clean);

            if ($img_data === false) continue;

            $filename = $orden . '.webp';
            $filepath = $img_dir . '/' . $filename;
            file_put_contents($filepath, $img_data);

            $ruta_db = 'assets/img/productos/' . $producto_id . '/' . $filename;
            $ruta_escaped = mysqli_real_escape_string($conn, $ruta_db);
            mysqli_query($conn, "INSERT INTO producto_imagenes (producto_id, ruta, orden) 
                                 VALUES ($producto_id, '$ruta_escaped', $orden)");
        }
    }

    echo json_encode(['success' => true, 'id' => $producto_id]);
    mysqli_close($conn);
    exit;
}

// --- EDITAR ---
if ($action === 'editar') {
    $id          = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre      = isset($_POST['nombre']) ? mysqli_real_escape_string($conn, trim($_POST['nombre'])) : '';
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($conn, trim($_POST['descripcion'])) : '';
    $precio      = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
    $categoria   = isset($_POST['categoria']) ? mysqli_real_escape_string($conn, $_POST['categoria']) : '';

    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de producto inválido.']);
        mysqli_close($conn);
        exit;
    }

    // Validaciones
    if ($nombre === '' || $descripcion === '' || $categoria === '') {
        http_response_code(400);
        echo json_encode(['error' => 'Nombre, descripción y categoría son campos obligatorios.']);
        mysqli_close($conn);
        exit;
    }

    if ($precio <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'El precio debe ser un número positivo.']);
        mysqli_close($conn);
        exit;
    }

    $categorias_validas = ['llaveros', 'deco_hogar', 'utilidades', 'juegos'];
    if (!in_array($categoria, $categorias_validas)) {
        http_response_code(400);
        echo json_encode(['error' => 'Categoría inválida.']);
        mysqli_close($conn);
        exit;
    }

    // Verificar nombre único (excluyendo el producto actual)
    $check = mysqli_query($conn, "SELECT id FROM productos WHERE nombre = '$nombre' AND id != $id LIMIT 1");
    if ($check && mysqli_num_rows($check) > 0) {
        http_response_code(409);
        echo json_encode(['error' => 'Ya existe un producto con ese nombre.']);
        mysqli_close($conn);
        exit;
    }

    $query = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', 
              precio = $precio, categoria = '$categoria' WHERE id = $id";

    if (!mysqli_query($conn, $query)) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al actualizar el producto: ' . mysqli_error($conn)]);
        mysqli_close($conn);
        exit;
    }

    echo json_encode(['success' => true]);
    mysqli_close($conn);
    exit;
}

// --- ELIMINAR ---
if ($action === 'eliminar') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de producto inválido.']);
        mysqli_close($conn);
        exit;
    }

    // Eliminar la carpeta de imágenes del servidor
    $img_dir = __DIR__ . '/../assets/img/productos/' . $id;
    if (is_dir($img_dir)) {
        $files = glob($img_dir . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        rmdir($img_dir);
    }

    // Eliminar de la DB (CASCADE elimina producto_imagenes)
    $query = "DELETE FROM productos WHERE id = $id";

    if (!mysqli_query($conn, $query)) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al eliminar el producto: ' . mysqli_error($conn)]);
        mysqli_close($conn);
        exit;
    }

    echo json_encode(['success' => true]);
    mysqli_close($conn);
    exit;
}

// --- Acción no reconocida ---
http_response_code(400);
echo json_encode(['error' => 'Acción no válida.']);
mysqli_close($conn);
