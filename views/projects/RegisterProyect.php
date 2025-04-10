<?php
include '../../config/Conexion.php';
require_once '../../models/Project.php';
require_once '../../models/File.php';  // Incluir la clase File

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $etapa = trim($_POST['etapa']);
    $colaboradores = isset($_POST['colaboradores']) ? trim($_POST['colaboradores']) : '';

    if (empty($titulo) || empty($descripcion) || empty($etapa)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Verificar si se ha subido un archivo
    $archivo = isset($_FILES['archivo']) ? $_FILES['archivo'] : null;
    $file_path = null;

    if ($archivo && $archivo['error'] === UPLOAD_ERR_OK) {
        // Crear una instancia de la clase File
        $file = new File($archivo);
        
        // Guardar el archivo y obtener la ruta en la base de datos
        $conexion = new Conexion();
        $conn = $conexion->getConnection();
        $project = new Project($conexion);
        
        // Guardamos el proyecto primero para obtener el ID del proyecto
        $project_id = $project->save($titulo, $descripcion, $etapa, $colaboradores);
        
        // Llamar al método saveToDatabase para guardar el archivo
        if ($project_id) {
            $result = $file->saveToDatabase($project_id, $conexion);
            if (!$result) {
                echo "Error al guardar el archivo en la base de datos.";
                exit;
            }
        } else {
            echo "Hubo un problema al registrar el proyecto.";
            exit;
        }
    }

    echo "Proyecto registrado con éxito. Redirigiendo...";
    header("refresh:3;url=/views/dashboard.php"); 
    exit;
}
?>
