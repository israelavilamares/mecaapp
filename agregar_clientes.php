

<html>

<head>

    <title>Formulario</title>
    <link rel="stylesheet" href="admin/style/estilo.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body class="fondo">

<?php include('admin/funciones/menu_clienuevo.php'); ?>

    <form id="formulario" enctype="multipart/form-data">
        <label for="nombre">Nombre </label>
        <input type="text" name="nombre" id="nombre"> <br>
        <label for="apellidos">Apellidos </label>
        <input type="text" name="apellidos" id="apellidos"> <br>
        <label for="correo">Correo </label>
        <div class="container-flex">
            <input type="text" onblur="validarCorreo(this)" name="correo" id="correo" value="@" />
            <div id="error-message-mail" style="color: red;"></div>
        </div>
        <label for="pass">Contraseña </label>
        <input type="password" name="pass" id="pass" placeholder="Escribe tu pass"> <br>  
        <input type="submit" id="editar-boton" onclick="registrar();  return false;" value="registrar" />
        <a href="login_clientes.php">Ya tengo cuenta</a>
    </form>
    <div id="error-message" style="color: red;"></div>
    <div class="success-message" id="success-message" style="display: none;"></div>
    
   
    <script src="admin/javascript/clientes.js"></script>
</body>

</html>