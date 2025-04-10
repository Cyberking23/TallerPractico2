<!DOCTYPE html>
<html>
<head>
    <title>Editar Proyecto</title>
</head>
<body>
    <h2>Editar Proyecto</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $project['id'] ?>">

        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= $project['titulo'] ?>" required><br>

        <label>Descripción:</label><br>
        <textarea name="descripcion" required><?= $project['descripcion'] ?></textarea><br>

        <button type="submit">Actualizar</button>
    </form>
    <a href="">← Volver</a>
</body>
</html>
