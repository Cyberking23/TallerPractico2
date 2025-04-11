<?php
session_start();

require_once '../../config/Conexion.php';
require_once '../../models/Project.php';

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

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $collaborator_id = intval($_POST['collaborator_id'] ?? 0);

    // Validar que se haya proporcionado un ID de colaborador
    if ($collaborator_id <= 0) {
        echo "ID del colaborador no válido.";
        exit;
    }

    // Agregar el colaborador al proyecto
    $result = Project::addCollaborator($project_id, $collaborator_id);

    if (isset($result['success'])) {
        // Redirigir al dashboard si la operación es exitosa
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Mostrar el mensaje de error si ocurre un problema
        echo $result['error'];
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Colaborador</title>
    <link rel="stylesheet" href="../../public/css/create.css">
</head>
<body class="create">
    <div class="create__container">
        <h1 class="create__title">Agregar Colaborador</h1>
        <form method="POST" action="">
            <div class="create__form-group">
                <label for="collaborator_id" class="create__label">ID del Colaborador</label>
                <input type="number" id="collaborator_id" name="collaborator_id" class="create__input" placeholder="Ingrese el ID del colaborador" required>
            </div>
            <div class="create__actions">
                <a href="../dashboard.php" class="create__button create__button--secondary">Cancelar</a>
                <button type="submit" class="create__button create__button--primary">Agregar</button>
            </div>
        </form>
    </div>
</body>
</html>