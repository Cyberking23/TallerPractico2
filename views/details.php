<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Proyecto - Sistema de Tesis</title>
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
        
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .project-card {
            background-color: var(--uber-gray);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid #333;
        }
        
        .progress-container {
            margin: 25px 0;
        }
        
        .progress-bar {
            height: 8px;
            background-color: #333;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        
        .progress {
            height: 100%;
            background-color: var(--uber-green);
            border-radius: 4px;
            width: 65%;
        }
        
        .stage-indicator {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        
        .stage {
            text-align: center;
            position: relative;
            flex: 1;
        }
        
        .stage.active {
            color: var(--uber-green);
        }
        
        .stage.active .stage-icon {
            background-color: var(--uber-green);
            color: var(--uber-black);
        }
        
        .stage-icon {
            width: 36px;
            height: 36px;
            background-color: #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }
        
        .files-section {
            margin-top: 40px;
        }
        
        .file-card {
            background-color: #2a2a2a;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }
        
        .file-card:hover {
            transform: translateX(5px);
        }
        
        .file-info {
            display: flex;
            align-items: center;
        }
        
        .file-icon {
            font-size: 24px;
            margin-right: 15px;
            color: var(--uber-green);
        }
        
        .file-actions .btn {
            margin-left: 10px;
        }
        
        .btn-uber {
            background-color: var(--uber-green);
            color: var(--uber-black);
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-uber:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        .btn-uber-outline {
            background-color: transparent;
            border: 1px solid var(--uber-green);
            color: var(--uber-green);
        }
        
        .btn-uber-red {
            background-color: #ff4444;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="../../img/logo-tesis.png" alt="Logo" style="width: 120px;">
        </div>
        <h3 style="color: var(--uber-green); margin-bottom: 20px;">Menú</h3>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 12px 0; border-bottom: 1px solid #333;">
                <a href="dashboard.php" style="color: white; text-decoration: none;">
                    <i class="fas fa-home" style="margin-right: 10px;"></i> Dashboard
                </a>
            </li>
            <li style="padding: 12px 0; border-bottom: 1px solid #333;">
                <a href="details.php" style="color: var(--uber-green); text-decoration: none;">
                    <i class="fas fa-file-alt" style="margin-right: 10px;"></i> Mis Proyectos
                </a>
            </li>
            <li style="padding: 12px 0;">
                <a href="../auth/logout.php" style="color: white; text-decoration: none;">
                    <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i> Cerrar Sesión
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="header-actions">
            <h1 style="color: var(--uber-green); margin: 0;">Detalles del Proyecto</h1>
            <div>
                <a href="edit.php" class="btn-uber" style="margin-right: 10px;">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="../files/upload.php?project_id=1" class="btn-uber">
                    <i class="fas fa-upload"></i> Subir Archivo
                </a>
            </div>
        </div>
        
        <!-- Tarjeta de Proyecto -->
        <div class="project-card">
            <h2 style="margin-top: 0;">Inteligencia Artificial en Educación</h2>
            <p style="color: #aaa; margin-bottom: 20px;">Análisis de aplicaciones de IA en entornos educativos virtuales</p>
            
            <div class="progress-container">
                <h4 style="margin-bottom: 15px;">Progreso del Proyecto</h4>
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
                
                <div class="stage-indicator">
                    <div class="stage active">
                        <div class="stage-icon">1</div>
                        <div>Propuesta</div>
                    </div>
                    <div class="stage active">
                        <div class="stage-icon">2</div>
                        <div>Presentación</div>
                    </div>
                    <div class="stage active">
                        <div class="stage-icon">3</div>
                        <div>Correcciones</div>
                    </div>
                    <div class="stage">
                        <div class="stage-icon">4</div>
                        <div>Aprobación</div>
                    </div>
                </div>
            </div>
            
            <div style="display: flex; margin-top: 30px;">
                <div style="flex: 1;">
                    <h4 style="margin-bottom: 15px;">Autor Principal</h4>
                    <div style="display: flex; align-items: center;">
                        <div style="width: 40px; height: 40px; background-color: #333; border-radius: 50%; 
                                    display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <div>Juan Pérez</div>
                            <small style="color: #aaa;">juan.perez@email.com</small>
                        </div>
                    </div>
                </div>
                
            
            </div>
        </div>
        
        <!-- Sección de Archivos -->
        <div class="files-section">
            <h3 style="color: var(--uber-green); margin-bottom: 20px;">
                <i class="fas fa-paperclip" style="margin-right: 10px;"></i> Archivos Adjuntos
            </h3>
            
            <div class="file-card">
                <div class="file-info">
                    <div class="file-icon"><i class="fas fa-file-pdf"></i></div>
                    <div>
                        <div>Propuesta_Tesis_IA.pdf</div>
                        <small style="color: #aaa;">Subido el 15/05/2023 - 2.4 MB</small>
                    </div>
                </div>
                <div class="file-actions">
                    <a href="#" class="btn-uber btn-uber-outline" style="padding: 8px 12px;">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn-uber btn-uber-red" style="padding: 8px 12px;">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
            
            <div class="file-card">
                <div class="file-info">
                    <div class="file-icon"><i class="fas fa-file-word"></i></div>
                    <div>
                        <div>Capitulo_1_MarcoTeorico.docx</div>
                        <small style="color: #aaa;">Subido el 22/06/2023 - 1.8 MB</small>
                    </div>
                </div>
                <div class="file-actions">
                    <a href="#" class="btn-uber btn-uber-outline" style="padding: 8px 12px;">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn-uber btn-uber-red" style="padding: 8px 12px;">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
            
            <div class="file-card">
                <div class="file-info">
                    <div class="file-icon"><i class="fas fa-file-image"></i></div>
                    <div>
                        <div>Diagramas_Flujo.png</div>
                        <small style="color: #aaa;">Subido el 05/07/2023 - 3.2 MB</small>
                    </div>
                </div>
                <div class="file-actions">
                    <a href="#" class="btn-uber btn-uber-outline" style="padding: 8px 12px;">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn-uber btn-uber-red" style="padding: 8px 12px;">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>