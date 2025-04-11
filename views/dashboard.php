<?php
session_start();  // Inicia la sesión para acceder a las variables de sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: ../views/auth/login.php");
    exit();
}

// Mensaje de bienvenida
$bienvenida = "Bienvenido, " . htmlspecialchars($_SESSION['user_name']);

// Importar las clases necesarias
require_once '../config/Conexion.php';
require_once '../models/Project.php';

// Obtener todos los proyectos del usuario actual
try {
    $projects = Project::getAllByUserId($_SESSION['user_id']);
} catch (PDOException $e) {
    die("Error al obtener los proyectos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Proyectos - Sistema de Tesis</title>
    <link rel="stylesheet" href="../../public/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="dashboard">
    <div class="dashboard__sidebar">
        <h3 class="dashboard__menu-title">Menú</h3>
        <ul class="dashboard__menu">
            <li class="dashboard__menu-item"><a href="#" class="dashboard__menu-link"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="dashboard__menu-item"><a href="create.php" class="dashboard__menu-link"><i class="fas fa-plus"></i> Nuevo Proyecto</a></li>
        </ul>

        <div class="dashboard__user-info">
            <p><strong>ID:</strong> <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
            <a href="../views/auth/logout.php" class="dashboard__logout-button"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </div>
    </div>
    
    <div class="dashboard__main-content">
        <h1 class="dashboard__title">Mis Proyectos de Tesis</h1>
        <p class="dashboard__welcome"><?php echo $bienvenida; ?>!</p>

        <?php foreach ($projects as $project): ?>
            <div class="project-card">
                <h3 class="project-card__title"><?php echo htmlspecialchars($project['titulo']); ?></h3>
                <p class="project-card__description"><?php echo htmlspecialchars($project['descripcion']); ?></p>
                
                <div class="project-card__details">
                    <span class="project-card__stage">Etapa: 
                        <span class="project-card__stage-indicator"><?php echo htmlspecialchars($project['etapa']); ?></span>
                    </span>

                    <div class="project-card__actions">
                        <a href="./details.php?id=<?php echo $project['id']; ?>" class="button button--primary"><i class="fas fa-edit"></i> Editar</a>
                        <a href="./projects/delete.php?id=<?php echo $project['id']; ?>" class="button button--secondary"><i class="fas fa-trash"></i> Eliminar</a>
                        <a href="./projects/addCollaborator.php?id=<?php echo $project['id']; ?>" class="button button--primary"><i class="fas fa-user-plus"></i> Agregar Colaborador</a>
                        <a href="./projects/addFile.php?id=<?php echo $project['id']; ?>" class="button button--secondary"><i class="fas fa-file-upload"></i> Agregar Archivos</a>
                    </div>
                </div>

                <!-- Botón para actualizar la etapa a "Presentación de tesis" -->
                <?php if ($project['etapa'] === 'Propuesta de tema'): ?>
                    <div class="project-card__present">
                        <form method="POST" action="./projects/updateStage.php">
                            <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                            <button type="submit" class="button button--large button--primary">
                                <i class="fas fa-graduation-cap"></i> Presentar Tesis
                            </button>
                        </form>
                    </div>
                <?php endif; ?>

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
                                    <a href="./projects/deleteFile.php?id=<?php echo $file['id']; ?>" class="button button--secondary">
                                        <i class="fas fa-trash"></i> Eliminar
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
                                    <a href="./projects/deleteCollaborator.php?project_id=<?php echo $project['id']; ?>&user_id=<?php echo $collaborator['id']; ?>" class="button button--secondary">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </a>
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
