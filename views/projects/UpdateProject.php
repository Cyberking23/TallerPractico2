<?php

include '../../config/Conexion.php';  
require_once '../../models/Project.php'; 

// Obtener el ID del proyecto desde la URL, verificando si está presente
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID del proyecto no proporcionado.";
    exit;
}

$project_id = $_GET['id']; 

// Crear la instancia de la clase Conexion
$conexion = new Conexion();
$project = new Project($conexion);

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario, asegurándonos de eliminar espacios innecesarios
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $etapa = trim($_POST['etapa']);
    $colaboradores = trim($_POST['colaboradores']);

    // Llamar al método update() con los 4 parámetros necesarios (sin el archivo)
    if ($project->update($project_id, $titulo, $descripcion, $etapa, $colaboradores)) {
        // Redirigir al dashboard o mostrar mensaje de éxito
        echo "Proyecto actualizado correctamente. Redirigiendo...";
        header("refresh:3;url=../dashboard.php");
        exit;
    } else {
        echo "Hubo un error al actualizar el proyecto.";
    }
}
?>
