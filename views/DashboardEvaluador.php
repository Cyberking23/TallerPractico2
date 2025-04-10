<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Listado de Proyectos</title>
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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #333;
        }

        .header h1 {
            margin: 0;
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

        .project-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .project-author {
            padding-bottom:10px;
            font-size: 1.1rem;
            color: var(--uber-light);
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
        <h3 style="color: var(--uber-green);">Menú</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 10px 0;"><a href="#" style="color: white; text-decoration: none;"><i class="fas fa-home"></i> Dashboard</a></li>
            <li style="padding: 10px 0;"><a href="create.php" style="color: white; text-decoration: none;"><i class="fas fa-plus"></i> Nuevo Proyecto</a></li>
            <li style="padding: 10px 0;"><a href="../auth/logout.php" style="color: white; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Listado de Proyectos</h1>
            <button class="btn-uber">Agregar Proyecto</button>
        </div>

        <div class="card-project">
            <div class="project-title">Proyecto 1: Sistema de Gestión</div>
            <div class="project-author">Autores: Juan Pérez, Ana García</div>
            <a href="Fases.php"><button class="btn-uber">Ver Detalles</button></a>
        </div>



      
    </div>

</body>
</html>
