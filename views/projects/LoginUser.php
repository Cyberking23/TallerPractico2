<?php

session_start();  // Inicia la sesión para almacenar la información del usuario

include '../../config/Conexion.php';  // Asegúrate de que la ruta sea correcta
require_once '../../models/Users.php';  // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Validación básica de campos vacíos
    if (empty($email) || empty($password)) {
        echo "Por favor, ingrese ambos campos.";
        exit;
    }

    // Crear instancia de la clase Conexion
    $conexion = new Conexion();  
    $user = new Users($conexion);  

    $user->email = $email;
    $user->password = $password;

    // Llamamos al método Login
    $result = $user->Login();

    if ($result) {
        header("Location: ../dashboard.php"); 
        exit;
    } else {
        echo "Credenciales incorrectas.Redirigiendo.......";
        header("refresh:3;url=/views/auth/dashboard.php"); 
    }
}
?>

