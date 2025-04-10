<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Sistema de Tesis' ?></title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <header>
        <h1>Sistema de Gestión de Tesis</h1>
        <nav>
            <a href="">Proyectos</a>
            <a href="">Dashboard</a>
            <a href="">Cerrar sesión</a>
        </nav>
    </header>

    <main>
        <?php include $view; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Desafio</p>
    </footer>
</body>
</html>
