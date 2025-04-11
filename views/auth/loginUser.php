<?php
// Importar las clases necesarias
require_once '../../config/Conexion.php';
require_once '../../models/Users.php';

$message = ''; // Variable para almacenar mensajes de error o éxito

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y validar los datos de entrada
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $password = htmlspecialchars(trim($_POST['password'] ?? ''));

    // Verificar que los campos no estén vacíos
    if (!empty($email) && !empty($password)) {
        // Crear una instancia de la clase Users
        $user = new Users(['email' => $email, 'password' => $password]);

        // Intentar iniciar sesión
        if ($user->Login()) {
            // Redirigir según el rol del usuario
            session_start();
            if ($_SESSION['user_role'] === 'decano') {
                header("Location: /views/dashboard_decano.php");
            } else {
                header("Location: /views/dashboard.php");
            }
            exit();
        } else {
            $message = 'Credenciales incorrectas. Por favor, inténtalo de nuevo.';
        }
    } else {
        $message = 'Por favor, completa todos los campos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../../public/css/Form.css">
</head>
<body class="page">
    <div class="page__container">
        <div class="login">
            <h1 class="login__title">Inicio de Sesión</h1>
            <?php if (!empty($message)): ?>
                <p class="login__footer-text"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>
            <a href="login.php" class="button button--secondary">Volver al inicio de sesión</a>
        </div>
    </div>
</body>
</html>