
<!DOCTYPE html>
<html>
<head>
    <title>Archivos del Proyecto</title>
</head>
<body>
    <h2>Archivos de la Tesis: <?= $project['titulo'] ?></h2>

    <form method="POST" enctype="multipart/form-data" action="">
        <input type="hidden" name="id_project" value="<?= $id_project ?>">
        <label>Selecciona archivo:</label><br>
        <input type="file" name="archivo" required><br><br>
        <button type="submit">Subir</button>
    </form>

    <h3>Archivos subidos:</h3>
    <ul>
 
    </ul>

    <br>
    <a href="">← Volver a proyectos</a>
</body>
</html>
