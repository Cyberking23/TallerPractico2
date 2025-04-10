<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Proyecto - Sistema de Tesis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    /* Estilos generales */
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #1e1e1e;
        color: white;
        margin: 0;
        padding: 20px;
    }

    .main-content {
        max-width: 800px;
        margin: auto;
    }

    h1 {
        color: var(--uber-green, #29d882);
        margin-bottom: 30px;
    }

    .form-container {
        background-color: #2a2a2a;
        border-radius: 12px;
        padding: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #ddd;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        background-color: #1e1e1e;
        border: 1px solid #444;
        border-radius: 8px;
        color: white;
    }

    textarea.form-control {
        min-height: 150px;
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-input {
        font-size: 16px;
        color: transparent;
        cursor: pointer;
        width: 100%;
        height: 50px;
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
    }

    .file-input-label {
        display: inline-block;
        padding: 12px;
        background-color: #29d882;
        color: black;
        border-radius: 8px;
        font-weight: bold;
        width: 100%;
        text-align: center;
        cursor: pointer;
        box-sizing: border-box;
        border: 1px solid #444;
        transition: background-color 0.3s ease;
    }

    .file-input-label:hover {
        background-color: #25b36e;
    }

    .file-input-label:active {
        background-color: #1f9e58;
    }

    .file-info {
        margin-top: 10px;
        color: #ddd;
        font-size: 14px;
    }

    .btn-container {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-uber {
        padding: 10px 20px;
        background-color: #29d882;
        border: none;
        border-radius: 8px;
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-cancelar {
        background-color: #555;
        color: white;
    }
</style>

</head>
<body>
    <div class="main-content">
        <h1>Nuevo Proyecto de Tesis</h1>
        <div class="form-container">
        <form method="POST" action="projects/RegisterProyect.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>Título del Proyecto</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" name="descripcion" required></textarea>
            </div>

            <div class="form-group">
                <label>Etapa Inicial</label>
                <select class="form-control" name="etapa" required>
                    <option value="1">Propuesta de tema</option>
                    <option value="2">Revisión</option>
                    <option value="3">Corrección de observaciones</option>
                    <option value="4">Tesis aprobada</option>
                    <option value="5">Presentación final</option>
                </select>
            </div>

            <div class="form-group">
                <label>Colaboradores (opcional)</label>
                <input type="text" class="form-control" name="colaboradores" placeholder="Buscar estudiantes...">
            </div>

            <!-- Nuevo apartado para subir archivos -->
            <div class="form-group">
                <label>Subir Archivos (PDF, Word, MP4, AVI, Imágenes)</label>
                <div class="file-input-wrapper">
                    <input type="file" name="archivo" class="file-input" accept=".pdf,.docx,.mp4,.avi,image/*" required>
                    <label for="archivo" class="file-input-label">Seleccionar archivo...</label>
                </div>
            </div>

            <div class="btn-container">
                <a href="dashboard.php" class="btn-uber btn-cancelar">Cancelar</a>
                <button type="submit" class="btn-uber"><i class="fas fa-save"></i> Guardar Proyecto</button>
            </div>
        </form>


        </div>
    </div>
</body>
</html>
