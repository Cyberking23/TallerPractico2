<?php

include '../../config/Conexion.php';  // Asegúrate de que la ruta sea correcta
require_once '../../models/Users.php';  // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $rol_id = trim($_POST['rol_id']);  // Recoger el valor del rol_id (1 para Estudiante, 2 para Catedrático)

    // Validación: asegurarse de que el campo "rol_id" no sea nulo o vacío
    if (empty($rol_id)) {
        echo "El tipo de usuario (rol_id) es obligatorio.";
        exit;
    }

    $conexion = new Conexion();  // Instancia de la clase Conexion para obtener la conexión

    $user = new Users($conexion);  // Se pasa la instancia de Conexion a la clase Users

    // Asignar los valores a los atributos del objeto
    $user->nombre = $name;
    $user->email = $email;
    $user->password = $password;  // Almacenamos la contraseña en texto plano (sin hash)
    $user->rol_id = $rol_id;  // Asignar el rol_id al objeto User

    // Llamar al método de registro en la clase Users
    $result = $user->register();  

    // Mostrar el mensaje de éxito
    echo "Usuario registrado con éxito. Redirigiendo...";

    // Esperar 3 segundos antes de redirigir
    header("refresh:3;url=/views/auth/login.html"); 
    exit;
}
?>
