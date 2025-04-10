<?php

include '../../config/Conexion.php';  // Asegúrate de que la ruta sea correcta
require_once '../../models/Project.php';  // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $etapa = trim($_POST['etapa']);
    $colaboradores = trim($_POST['colaboradores']);
    $archivo = $_FILES['archivo'];  // Recoger el archivo

    // Verificar si los campos obligatorios están completos
    if (empty($titulo) || empty($descripcion) || empty($etapa)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Verificar que el archivo fue subido correctamente
    if (!isset($archivo) || $archivo['error'] !== UPLOAD_ERR_OK) {
        echo "Error al subir el archivo.";
        exit;
    }

    // Verificar que el archivo tiene una extensión válida
    if (!in_array(pathinfo($archivo['name'], PATHINFO_EXTENSION), ['pdf', 'docx', 'mp4', 'avi', 'jpg', 'png'])) {
        echo "Extensión de archivo no válida. Solo se permiten archivos PDF, Word, MP4, AVI, o imágenes.";
        exit;
    }

    // Obtener el contenido del archivo como binario
    $archivo_binario = file_get_contents($archivo['tmp_name']);  // Leer el archivo como binario

    // Crear una instancia de la clase Project
    $conexion = new Conexion();  // Obtener la conexión

    $project = new Project($titulo, $descripcion, $etapa, $colaboradores, $archivo_binario);  // Pasar el archivo binario

    // Intentar crear el proyecto
    try {
        $result = $project->create();  // Llamar al método para crear el proyecto en la BD

        if ($result) {
            echo "Proyecto registrado con éxito. Redirigiendo...";
            header("refresh:3;url=/views/dashboard.php"); // Redirige a la lista de proyectos o al lugar que desees
            exit;
        } else {
            echo "Error al registrar el proyecto.";
        }
    } catch (Exception $e) {
        echo "Ocurrió un error en la creación del proyecto: " . $e->getMessage();
    }
}
?>
