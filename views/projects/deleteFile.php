<?php
require_once '../../config/Conexion.php';
require_once '../../models/File.php';

// Verificar si el ID del archivo está presente en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID del archivo no proporcionado.";
    exit;
}

$file_id = intval($_GET['id']); // Asegurarse de que el ID sea un número entero

// Llamar al método estático deleteFile() de la clase Project
$result = File::deleteFile($file_id);

if (isset($result['success'])) {
    // Redirigir al dashboard si la eliminación es exitosa
    header("Location: ../dashboard.php");
    exit();
} else {
    // Mostrar el mensaje de error si ocurre un problema
    echo $result['error'];
    exit();
}
?>