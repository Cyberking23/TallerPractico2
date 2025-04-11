<?php
session_start(); // Inicia la sesión para acceder a las variables de sesión

// Verificar si el usuario tiene el rol de decano
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'decano') {
    header("Location: ../auth/login.php"); // Redirigir al login si no es decano
    exit();
}

require_once '../config/Conexion.php';
require_once '../models/Project.php';

// Obtener todos los proyectos
try {
    $projects = Project::getAll(); // Método que obtiene todos los proyectos
} catch (PDOException $e) {
    die("Error al obtener los proyectos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Decano</title>
    <link rel="stylesheet" href="../../public/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="dashboard">
    <!-- Sidebar con información del usuario -->
    <aside class="dashboard__sidebar">
        <div class="dashboard__user-info">
            <h3>Información del Usuario</h3>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
            <p><strong>Rol:</strong> Decano</p>
            <a href="../views/auth/logout.php" class="dashboard__logout-button"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </div>
    </aside>

    <!-- Contenido principal -->
    <div class="dashboard__main-content">
        <h1 class="dashboard__title">Dashboard Decano</h1>
        <p class="dashboard__welcome">Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?>.</p>

        <?php foreach ($projects as $project): ?>
            <div class="project-card">
                <h3 class="project-card__title"><?php echo htmlspecialchars($project['titulo']); ?></h3>
                <p class="project-card__description"><?php echo htmlspecialchars($project['descripcion']); ?></p>
                
                <div class="project-card__details">
                    <span class="project-card__stage">Etapa: 
                        <span class="project-card__stage-indicator"><?php echo htmlspecialchars($project['etapa']); ?></span>
                    </span>
                </div>

                <!-- Mostrar archivos asociados al proyecto -->
                <?php if (!empty($project['files'])): ?>
                    <div class="project-card__files">
                        <h4>Archivos:</h4>
                        <ul>
                            <?php foreach ($project['files'] as $file): ?>
                                <li>
                                    <a href="<?php echo htmlspecialchars($file['ruta']); ?>" target="_blank">
                                        <?php echo htmlspecialchars($file['nombre_archivo']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Mostrar colaboradores asociados al proyecto -->
                <?php if (!empty($project['collaborators'])): ?>
                    <div class="project-card__collaborators">
                        <h4>Colaboradores:</h4>
                        <ul>
                            <?php foreach ($project['collaborators'] as $collaborator): ?>
                                <li>
                                    <?php echo htmlspecialchars($collaborator['nombre']); ?> (<?php echo htmlspecialchars($collaborator['email']); ?>)
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>