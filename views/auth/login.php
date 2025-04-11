<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/Form.css">
    <title>Login - Sistema de Tesis</title>
</head>
<body class="page">

    <div class="page__container">
        <div class="login">
            <div class="login__logo">
                <h1 class="login__title">Sistema de Tesis</h1>
            </div>
            
            <form class="login__form" method="POST" action="./loginUser.php">
                <div class="login__form-group">
                    <label for="email" class="login__label">Correo electrónico</label>
                    <input type="email" id="email" placeholder="Ingresa tu correo" name="email" class="login__input" required>
                </div>
                
                <div class="login__form-group">
                    <label for="password" class="login__label">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" class="login__input" required>
                </div>
                
                <button type="submit" class="button button--primary">Ingresar</button>
            </form>
            
            <p class="login__footer-text">
                ¿No tienes cuenta? <a href="register.php" class="login__link">Regístrate aquí</a>
            </p>

            <a href="../../../index.html" class="login__back">
                <button type="button" class="button button--secondary">Volver al inicio</button>
            </a>
        </div>
    </div>

</body>
</html>
