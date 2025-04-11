<?php
require_once '../../config/Conexion.php';
require_once '../../models/Project.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);

    // Validar que los campos no estén vacíos
    if (empty($titulo) || empty($descripcion)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Crear una instancia del proyecto
    $project = new Project([
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'id_user_owner' => $_SESSION['user_id'] // ID del usuario propietario desde la sesión
    ]);

    // Guardar el proyecto
    $result = $project->save();

    if (isset($result['success'])) {
        // Redirigir al dashboard si el registro es exitoso
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Mostrar el mensaje de error si ocurre un problema
        echo $result['error'];
        exit();
    }
}
?>