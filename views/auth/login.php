<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/Form.css">
    <title>Login - Sistema de Tesis</title>
    <style>

    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>Sistema de Tesis</h1>
        </div>
        
        <form method="POST" action="#">
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn-uber">Ingresar</button>
        </form>
        
        <p class="footer-text">
            ¿No tienes cuenta? <a href="register.php">Regístrate aquí</a>
        </p>
    </div>
</body>
</html>