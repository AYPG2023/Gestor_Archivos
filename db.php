<?php
$servername = "localhost"; // Cambia por tu servidor si es necesario
$username = "root"; // Tu usuario de MySQL
$password = "Ander2023@"; // Tu contraseña de MySQL
$dbname = "gestor_archivos"; // Nombre de tu base de datos

// Activar el informe de errores de mysqli
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Crear conexión
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $e->getMessage()]));
}
?>
