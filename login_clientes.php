<?php 
session_start();

if (isset($_SESSION['logeado']) and $_SESSION['logeado'] == TRUE) {
    header('Location: bienvenido_clientes.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="admin/style/estilo.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>
<body class="fondo">

<button class="btnHomeBack" id="regresarHome"><img src="admin/descargas/casaregresar.png" alt="">Regresar</button>


    <div class="body-index">

   <form action="login_clientes.php" method="post">
         <h1>Login</h1>
        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="button" onclick="logearme_cliente()" value="Iniciar sesión">
        <a href="agregar_clientes.php">No tengo cuenta</a>
        <br>
    </form>

    <div id="error-message" style="color: red;"></div>


    <script src="admin/javascript/clientes.js"></script>
</div>
</body>

<footer>
<div class="contenedor-footer">
            <div class="content-foo">
           <h4>Teléfono</h4>
           <p>3337984333</p>
        </div>
        <div class="content-foo">
            <h4>Correo electrónico</h4>
            <p>taller@gmail.com</p>
        </div>
        <div class="content-foo">
           <h4> Ubicación </h4>
           <p>Paulino Navarro 1345, Los Maestros, 45150 Zapopan, Jal.</p>
        </div>
        <div class="content-foo">
           <p><a class="link-login" href="admin/LogAdm.php">Soy Parte del Equipo</a></p>
        </div>
    </div>
    <h2 class="titulo-final">&copy; pluton | IngSoftware</h2>
</footer>
</html>