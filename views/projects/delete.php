<?php
require_once '../../config/Conexion.php';
require_once '../../models/Project.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Asegurarse de que el ID sea un número entero

    // Llamar al método estático delete() de la clase Project para eliminar el proyecto
    $result = Project::delete($id);

    if (isset($result['success'])) {
        // Redirigir al dashboard si la eliminación es exitosa
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Mostrar el mensaje de error si ocurre un problema
        echo $result['error'];
        exit();
    }
} else {
    echo "ID de proyecto no especificado.";
    exit();
}
?>