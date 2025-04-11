<?php

require_once '../../config/Conexion.php';
require_once '../../models/Project.php';

// Verificar si el ID del proyecto está presente en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID del proyecto no proporcionado.";
    exit;
}

$project_id = intval($_GET['id']); // Asegurarse de que el ID sea un número entero

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos actuales del proyecto
    $current_project = Project::getById($project_id);
    if (!$current_project) {
        echo "El proyecto no existe.";
        exit;
    }

    // Obtener los datos del formulario, asegurándonos de eliminar espacios innecesarios
    $titulo = trim($_POST['titulo'] ?? '') ?: $current_project['titulo'];
    $descripcion = trim($_POST['descripcion'] ?? '') ?: $current_project['descripcion'];
    $etapa = trim($_POST['etapa'] ?? '') ?: $current_project['etapa'];

    // Crear una instancia del proyecto con los datos actualizados
    $project = new Project([
        'id' => $project_id,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'etapa' => $etapa
    ]);

    // Llamar al método update() para actualizar el proyecto
    $result = $project->update();

    if (isset($result['success'])) {
        // Redirigir al dashboard si la actualización es exitosa
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Mostrar el mensaje de error si ocurre un problema
        echo $result['error'];
        exit();
    }
}
?>
