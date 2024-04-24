<!DOCTYPE html>
<html>
    <head>
    <title>Incio sesion</title>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/logAdm.css">
    <link rel="shortcut icon" href="admin/descargas/mecappchica.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    
</head>
    <body>
        <div class="cont-form">
            <div class="hijo">
                <h3>Iniciar Sesión en Mecapp </h3>
                <hr color="black">
                <form action="" enctype="multipart/form-data" method="post">
                    <?php 
                    
                    require "FuncionesAdmin/AdmLogin.php";
                        require "funciones/conecta.php";
                     
                    ?>
                    <input class="class-email" type="text" placeholder="ingresa tu correo" name="Email" required>
                    <!-- aqui esta el mensaje correo error -->  
                    <?php echo $mensajeErrorCorreo ?>
                    <input class="class-pass" type="password" placeholder="contraseña" name="password" id="passw"  required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i></button>
                    <!-- aqui esta el mensaje password error -->    
                    <?php echo $mensajeErrorPass?>
                    <input class="button" type="submit" value="Iniciar sesion" name="entrar">
                        <br>
                    <hr color="black">
                    <p><a href="../index.php">Regresa a Pagina Principal</a></p>
                </form>
                <div class="cf-turnstile" data-sitekey="0x4AAAAAAAYD4RNdN2j_z7GG" data-callback="javascriptCallback"></div>

             
            </div>

        </div>
       
        <script src="javascript/ocultarPass.js"></script>
    </body>
    
</html>