<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Informe de Progreso de Proyectos de Tesis</title>
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

        .project-student {
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

        .status {
            padding: 5px 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .approved {
            background-color: #4CAF50;
            color: white;
        }

        .pending {
            background-color: #FFC107;
            color: black;
        }

        .rejected {
            background-color: #F44336;
            color: white;
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
        <div class="header">
            <h1>Informe de Progreso de Proyectos de Tesis</h1>
        </div>

        <div class="card-project">
            <div class="project-title">Proyecto 1: Desarrollo de Sistema Web</div>
            <div class="project-student">Estudiante: Juan Pérez</div>
            <div class="progress-bar">
                <div class="progress" style="width: 80%;"></div>
            </div>
            <div class="status approved">Aprobado</div>
        </div>

        <div class="card-project">
            <div class="project-title">Proyecto 2: Implementación de IA en la Educación</div>
            <div class="project-student">Estudiante: Ana García</div>
            <div class="progress-bar">
                <div class="progress" style="width: 60%;"></div>
            </div>
            <div class="status pending">En Revisión</div>
        </div>

        <div class="card-project">
            <div class="project-title">Proyecto 3: Aplicación Móvil para Gestión de Tareas</div>
            <div class="project-student">Estudiante: Luis Rodríguez</div>
            <div class="progress-bar">
                <div class="progress" style="width: 40%;"></div>
            </div>
            <div class="status rejected">Rechazado</div>
        </div>

        <div class="card-project">
            <div class="project-title">Proyecto 4: Plataforma de Comercio Electrónico</div>
            <div class="project-student">Estudiante: María Fernández</div>
            <div class="progress-bar">
                <div class="progress" style="width: 75%;"></div>
            </div>
            <div class="status approved">Aprobado</div>
        </div>

    </div>

</body>
</html>
