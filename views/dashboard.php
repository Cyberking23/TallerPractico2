<?php
session_start();  // Inicia la sesión para acceder a las variables de sesión

if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    // Si la sesión está activa, muestra el nombre del usuario
    $bienvenida =  "Bienvenido, " . $_SESSION['user_name'];
} else {
    // Si la sesión no está activa, redirigir al login o mostrar un mensaje
    echo "No has iniciado sesión. Redirigiendo al login...";
    header("refresh:3;url=/views/auth/login.html"); // Redirige después de 3 segundos
    exit;
}

// Conectar a la base de datos y obtener los proyectos
include '../config/Conexion.php';
require_once '../models/Project.php';

$conexion = new Conexion();  // Crear una instancia de la clase Conexion
$project = new Project($conexion);  // Crear una instancia de la clase Project

// Obtener todos los proyectos
$projects = $project->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Proyectos - Sistema de Tesis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --uber-black: #000000;
            --uber-dark: #121212;
            --uber-green: #00ff5f;
            --uber-gray: #1e1e1e;
            --uber-light: #e6e6e6;
        }
        
        body {
            background-color: var(--uber-black);
            font-family: 'Segoe UI', sans-serif;
            color: white;
            margin: 0;
        }
        
        .sidebar {
            width: 250px;
            background-color: var(--uber-dark);
            height: 100vh;
            position: fixed;
            padding: 20px;
            border-right: 1px solid #333;
        }
        
        .main-content {
            margin-left: 300px;
            padding: 30px;
        }
        
        .card-project {
            background-color: var(--uber-gray);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #333;
            transition: all 0.3s;
        }
        
        .card-project:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .progress-bar {
            height: 6px;
            background-color: #333;
            border-radius: 3px;
            margin: 15px 0;
        }
        
        .progress {
            height: 100%;
            background-color: var(--uber-green);
            border-radius: 3px;
            width: 65%;
        }
        
        .btn-uber {
            background-color: var(--uber-green);
            color: var(--uber-black);
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .file-card {
            background-color: var(--uber-gray);
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-top: 10px;
        }

        .file-info {
            display: flex;
            align-items: center;
        }

        .file-icon {
            margin-right: 10px;
            font-size: 20px;
        }

        .file-actions a {
            margin-left: 10px;
            color: var(--uber-black);
            background-color: var(--uber-green);
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .stage-indicator {
            background-color: var(--uber-green);
            color: var(--uber-dark);
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Menú -->
        <h3 style="color: var(--uber-green);">Menú</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 10px 0;"><a href="#" style="color: white; text-decoration: none;"><i class="fas fa-home"></i> Dashboard</a></li>
            <li style="padding: 10px 0;"><a href="create.php" style="color: white; text-decoration: none;"><i class="fas fa-plus"></i> Nuevo Proyecto</a></li>
            <li style="padding: 10px 0;"><a href="../auth/logout.php" style="color: white; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </div>
    
    <div class="main-content">
        <h1 style="color: var(--uber-green);">Mis Proyectos de Tesis</h1>
        <p><?php echo $bienvenida; ?>!</p>

        <?php foreach ($projects as $project): ?>
            <div class="card-project">
                <h3><?php echo htmlspecialchars($project['titulo']); ?></h3>
                <p><?php echo htmlspecialchars($project['Descripcion']); ?></p>
                
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Etapa: 
                        <span class="stage-indicator"><?php echo htmlspecialchars($project['etapa']); ?></span>
                    </span>

                    <div>
                        <a href="./projects/details.php?id=<?php echo $project['id']; ?>" class="btn-uber" style="margin-right: 10px;"><i class="fas fa-edit"></i> Editar</a>
                        <a href="./projects/delete.php?id=<?php echo $project['id']; ?>" class="btn-uber"><i class="fas fa-trash"></i> Eliminar</a>
                    </div>
                </div>

                <h4>Archivos Subidos</h4>
                <div class="file-card">
                    <div class="file-info">
                        <div class="file-icon"><i class="fas fa-file-pdf"></i></div>
                        <div>
                            <div>Propuesta_Tesis_IA.pdf</div>
                            <small style="color: #aaa;">Subido el 15/05/2023 - 2.4 MB</small>
                        </div>
                    </div>
                    
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
