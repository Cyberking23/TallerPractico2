<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    echo "No has iniciado sesión. Redirigiendo al login...";
    header("refresh:3;url=/views/auth/login.php");
    exit;
}

// Importar las clases necesarias
require_once '../config/Conexion.php';
require_once '../models/Project.php';

// Obtener el ID del proyecto desde la URL
if (!isset($_GET['id'])) {
    echo "ID de proyecto no especificado.";
    exit;
}

$project_id = intval($_GET['id']); // Asegurarse de que el ID sea un número entero

// Obtener los detalles del proyecto
$project_details = Project::getById($project_id);
if (!$project_details) {
    echo "El proyecto no existe.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto - Sistema de Tesis</title>
    <link rel="stylesheet" href="../../public/css/create.css">
</head>
<body class="create">
    <div class="create__container">
        <h1 class="create__title">Editar Proyecto</h1>
        <form method="POST" action="projects/UpdateProject.php?id=<?php echo $project_details['id']; ?>" class="create__form">
            <div class="create__form-group">
                <label for="titulo" class="create__label">Título del Proyecto</label>
                <input type="text" id="titulo" name="titulo" class="create__input" value="<?php echo htmlspecialchars($project_details['titulo']); ?>" required>
            </div>

            <div class="create__form-group">
                <label for="descripcion" class="create__label">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="create__textarea" required><?php echo htmlspecialchars($project_details['descripcion']); ?></textarea>
            </div>


            <div class="create__actions">
                <a href="dashboard.php" class="create__button create__button--secondary">Cancelar</a>
                <button type="submit" class="create__button create__button--primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</body>
</html>
