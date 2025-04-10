<?php
include '../../config/Conexion.php';
require_once '../../models/Project.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Crear una instancia de conexión y de la clase Project
    $conexion = new Conexion();
    $project = new Project($conexion);

    // Llamar al método delete() de la clase Project para eliminar el proyecto
    $result = $project->delete($id);

    if ($result) {
        echo "Proyecto eliminado con éxito. Redirigiendo...";

        // Redirigir al dashboard después de 3 segundos
        header("refresh:3;url=/views/dashboard.php");
    } else {
        echo "Hubo un error al eliminar el proyecto.";
    }
} else {
    echo "ID de proyecto no especificado.";
}
?>
