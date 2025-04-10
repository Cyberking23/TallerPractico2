<?php
session_start();  // Inicia la sesión para poder destruirla

// Verifica si la sesión está iniciada
if (isset($_SESSION['user_id'])) {
    // Destruir todas las variables de la sesión
    session_unset();

    // Destruir la sesión
    session_destroy();

    header("Location: ../../index.html");  
    exit;
} else {
    // Si no hay sesión iniciada, redirigir a login
    header("Location: login.php");
    exit;
}
?>
