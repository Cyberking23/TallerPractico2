<?php
require_once '../../config/Conexion.php';
require_once '../../models/Project.php';

// Verificar si el ID del proyecto y el ID del usuario están presentes en la URL
if (!isset($_GET['project_id']) || empty($_GET['project_id']) || !isset($_GET['user_id']) || empty($_GET['user_id'])) {
    echo "ID del proyecto o del colaborador no proporcionado.";
    exit;
}

$project_id = intval($_GET['project_id']); // Asegurarse de que el ID sea un número entero
$user_id = intval($_GET['user_id']); // Asegurarse de que el ID sea un número entero

// Llamar al método estático deleteCollaborator() de la clase Project
$result = Project::deleteCollaborator($project_id, $user_id);

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