<?php
session_start();

require_once '../../config/Conexion.php';
require_once '../../models/File.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    echo "No has iniciado sesión. Redirigiendo al login...";
    header("refresh:3;url=/views/auth/login.php");
    exit;
}

// Verificar si el ID del proyecto está presente en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID del proyecto no proporcionado.";
    exit;
}

$project_id = intval($_GET['id']); // Asegurarse de que el ID sea un número entero

// Tipos de archivo permitidos
$allowed_types = [
    'application/pdf', // PDF
    'application/msword', // Word (doc)
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // Word (docx)
    'video/mp4', // MP4
    'video/x-msvideo', // AVI
    'image/jpeg', // JPEG
    'image/png', // PNG
    'image/bmp' // BMP
];

// Directorio de subida
$upload_dir = '../../uploads/';

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_FILES['file']['name'] ?? '';
    $file_tmp = $_FILES['file']['tmp_name'] ?? '';
    $file_type = $_FILES['file']['type'] ?? '';
    $file_size = $_FILES['file']['size'] ?? 0;

    // Validar que se haya subido un archivo
    if (empty($file_name)) {
        echo "No se ha seleccionado ningún archivo.";
        exit;
    }

    // Validar el tipo de archivo
    if (!in_array($file_type, $allowed_types)) {
        echo "Tipo de archivo no permitido. Solo se permiten PDF, Word, MP4, AVI e imágenes (excepto GIF).";
        exit;
    }

    // Validar el tamaño del archivo (máximo 10 MB)
    if ($file_size > 10485760) { // 10 MB en bytes
        echo "El archivo excede el tamaño máximo permitido de 10 MB.";
        exit;
    }

    // Mover el archivo al directorio de subida
    $file_path = $upload_dir . basename($file_name);
    if (move_uploaded_file($file_tmp, $file_path)) {
        $result = File::addFile($project_id, $file_name, $file_type, $file_path);
        
        if ($result['success']) {
            // Redirigir al dashboard si la operación es exitosa
            header("Location: ../dashboard.php");
            exit();
        } else {
            echo "Error al guardar el archivo en la base de datos.";
            exit();
        }
    } else {
        echo "Error al subir el archivo.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Archivo</title>
    <link rel="stylesheet" href="../../public/css/create.css">
</head>
<body class="create">
    <div class="create__container">
        <h1 class="create__title">Agregar Archivo</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="create__form-group">
                <label for="file" class="create__label">Seleccionar Archivo</label>
                <input 
                    type="file" 
                    id="file" 
                    name="file" 
                    class="create__input" 
                    accept=".pdf,.doc,.docx,.mp4,.avi,.jpg,.jpeg,.png,.bmp" 
                    required>
                <small class="create__helper-text">
                    Solo se permiten archivos PDF, Word, MP4, AVI e imágenes (excepto GIF). Tamaño máximo: 10 MB.
                </small>
            </div>
            <div class="create__actions">
                <a href="../dashboard.php" class="create__button create__button--secondary">Cancelar</a>
                <button type="submit" class="create__button create__button--primary">Subir</button>
            </div>
        </form>
    </div>
</body>
</html>