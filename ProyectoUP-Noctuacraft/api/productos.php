<?php
// ============================================
// Noctuacraft — API Pública de Productos
// Endpoints: GET ?limit=10&random=true | GET ?id=X
// Siempre responde JSON. Nunca genera HTML.
// ============================================

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../db/conexion.php';

// --- GET ?id=X → Detalle de un producto ---
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT id, nombre, descripcion, precio, categoria FROM productos WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        http_response_code(404);
        echo json_encode(['error' => 'Producto no encontrado']);
        mysqli_close($conn);
        exit;
    }

    $producto = mysqli_fetch_assoc($result);
    $producto['precio'] = floatval($producto['precio']);

    // Obtener imágenes ordenadas
    $img_query = "SELECT ruta, orden FROM producto_imagenes WHERE producto_id = $id ORDER BY orden ASC";
    $img_result = mysqli_query($conn, $img_query);

    $imagenes = [];
    if ($img_result) {
        while ($img = mysqli_fetch_assoc($img_result)) {
            $imagenes[] = $img['ruta'];
        }
    }

    $producto['imagenes'] = $imagenes;

    echo json_encode($producto);
    mysqli_close($conn);
    exit;
}

// --- GET ?limit=N&random=true → Lista de productos aleatorios ---
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
if ($limit < 1) $limit = 1;
if ($limit > 50) $limit = 50;

$random = isset($_GET['random']) && $_GET['random'] === 'true';
$order = $random ? 'ORDER BY RAND()' : 'ORDER BY p.created_at DESC';

$query = "
    SELECT p.id, p.nombre, p.precio, p.categoria,
           (SELECT pi.ruta FROM producto_imagenes pi 
            WHERE pi.producto_id = p.id 
            ORDER BY pi.orden ASC LIMIT 1) AS imagen_principal
    FROM productos p
    $order
    LIMIT $limit
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
