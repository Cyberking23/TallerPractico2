<?php
require_once '../../config/Conexion.php';
require_once '../../models/Escuela.php';

// Obtener todas las escuelas utilizando la clase Escuela
try {
    $escuelas = Escuela::getAll();
} catch (PDOException $e) {
    die("Error al obtener las escuelas: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/Form.css">
    <title>Registro - Sistema de Tesis</title>
</head>
<body class="page">

    <div class="page__container">
        <div class="login">
            <div class="login__logo">
                <h1 class="login__title">Sistema de Tesis</h1>
            </div>
   
            <!-- Formulario de Registro -->
            <form class="login__form" method="POST" action="./registerUser.php">
                <div class="login__form-group">
                    <label for="name" class="login__label">Nombre</label>
                    <input type="text" id="name" name="name" class="login__input" placeholder="Ingrese su nombre" required>
                </div>

                <div class="login__form-group">
                    <label for="email" class="login__label">Email</label>
                    <input type="email" id="email" name="email" class="login__input" placeholder="Ingrese su Email" required>
                </div>
                
                <div class="login__form-group">
                    <label for="password" class="login__label">Contraseña</label>
                    <input type="password" id="password" name="password" class="login__input" placeholder="Ingrese su contraseña" required>
                </div>

                <div class="login__form-group">
                    <label for="escuela" class="login__label">Escuela</label>
                    <select id="escuela" name="id_escuela" class="login__input" required>
                        <option value="">Seleccione una escuela</option>
                        <?php foreach ($escuelas as $escuela): ?>
                            <option value="<?php echo htmlspecialchars($escuela['id']); ?>">
                                <?php echo htmlspecialchars($escuela['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="button button--primary">Registrarse</button>
            </form>
            
            <p class="login__footer-text">
                ¿Ya tienes cuenta? <a href="login.php" class="login__link">Inicia sesión aquí</a>
            </p>

            <!-- Botón para volver al índice -->
            <a href="../../../index.html" class="login__back">
                <button type="button" class="button button--secondary">Volver al inicio</button>
            </a>
        </div>
    </div>

</body>
</html>
