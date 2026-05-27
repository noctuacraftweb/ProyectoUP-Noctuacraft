<?php
// ============================================
// Noctuacraft — Conexión a Base de Datos
// Solo abre la conexión mysqli. Nada más.
// ============================================

$db_host = 'sql102.infinityfree.com';
$db_user = 'if0_42011092';
$db_pass = 'mT61xZrGdLtAKFu';
$db_name = 'if0_42011092_noctuacraft';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    http_response_code(500);
    die(json_encode(['error' => 'Error de conexión a la base de datos']));
}

mysqli_set_charset($conn, 'utf8mb4');
