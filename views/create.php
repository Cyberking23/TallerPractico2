<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Proyecto - Sistema de Tesis</title>
    <link rel="stylesheet" href="../../public/css/create.css">
</head>
<body class="create">
    <div class="create__container">
        <h1 class="create__title">Crear Nuevo Proyecto</h1>
        <form method="POST" action="projects/RegisterProyect.php" class="create__form">
            <div class="create__form-group">
                <label for="titulo" class="create__label">Título del Proyecto</label>
                <input type="text" id="titulo" name="titulo" class="create__input" placeholder="Ingrese el título del proyecto" required>
            </div>

            <div class="create__form-group">
                <label for="descripcion" class="create__label">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="create__textarea" placeholder="Ingrese una descripción del proyecto" required></textarea>
            </div>

            <div class="create__actions">
                <a href="dashboard.php" class="create__button create__button--secondary">Cancelar</a>
                <button type="submit" class="create__button create__button--primary">Guardar Proyecto</button>
            </div>
        </form>
    </div>
</body>
</html>
