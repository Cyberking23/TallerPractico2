<?php
// Include your PHP class
include "../../config/Conexion.php";
include "../../models/Users.php";

$message = ''; // Variable para almacenar mensajes de éxito o error

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $password = htmlspecialchars(trim($_POST['password'] ?? ''));
    $id_escuela = htmlspecialchars(trim($_POST['id_escuela'] ?? ''));

    // Check if all fields are filled
    if (!empty($name) && !empty($email) && !empty($password)) {
        // Create a new User instance
        $user = new Users([
            'nombre' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT), // Hash the password
            'id_escuela' => $id_escuela,
        ]);

        // Register the user
        $result = $user->register();

        if (isset($result['success'])) {
            // Redirect to login page if registration is successful
            header("Location: login.php");
            exit();
        } else {
            // Store the error message
            $message = $result['error'] ?? 'Error desconocido al registrar el usuario.';
        }
    } else {
        $message = 'Por favor, completa todos los campos.';
    }
}
else{
    exit("Acceso no permitido.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema de Tesis</title>
    <link rel="stylesheet" href="../../public/css/Form.css">
</head>
<body class="page">
    <div class="page__container">
        <div class="login">
            <h1 class="login__title">Registro de Usuario</h1>
            <?php if (!empty($message)): ?>
                <p class="login__footer-text"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>
            <a href="register.html" class="button button--secondary">Volver al registro</a>
        </div>
    </div>
</body>
</html>