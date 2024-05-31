<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Login</title>
    <link href="../css/login_admin.css" type="text/css" rel="stylesheet">

</head>
<body>
<div class="login-container">
        <h2>INICIAR SESIÓN</h2>
        <form action="../verificar.php" method="POST">
            <label for="user">Nombre:</label><br>
            <input type="text" id="user" name="user"/><br>
            <label for="pass">Password:</label><br>
            <input type="password" id="pass" name="pass"/><br>
            <input type="submit" value="Ingresar"/>
            <input type="reset" value="Limpiar"/>					  									
        </form>
    </div>
</body>
</html>
