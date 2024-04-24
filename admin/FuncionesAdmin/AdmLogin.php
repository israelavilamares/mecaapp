<?php session_start();
require "conecta.php";
$mensajeErrorCorreo = "";
$mensajeErrorPass = "";
if (isset($_POST['entrar'])) {

    //variables de post
    $user = $_POST['Email'];
    $pass = $_POST['password'];
       
    // verificamos el correo y de manera segura email .
    $sql = "SELECT * FROM administrador WHERE EMAIL = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    //verificamos la contreseña
    if(mysqli_num_rows($result)==1)
    {
    
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row["PASS"];

        if(password_verify($pass,$hashedPassword))
        {
            $_SESSION['email'] = $row["email"];
            $_SESSION['nombre'] = $row["nombre"];
            $_SESSION['APELLIDO'] = $row["APELLIDO"];

            
            //generar un id
            $user_id = md5(uniqid() . time() . mt_rand());
            
            //user_id
            $_SESSION["user_id"] = $user_id;
            //sesion en de 24 horas
            setcookie("session_id", session_id(), time() + (60 * 60 * 24), "/");            
            
            // Usar la cookie para identificar al usuario en solicitudes posteriores
            if (isset($_COOKIE["session_id"])) {
              $session_id = $_COOKIE["session_id"];
              // Recuperar datos del usuario de la sesión usando el ID de sesión
              $user_data = $_SESSION[$session_id];
            }
            header("Location: AdminPage.php");
            exit;

        }else{
            
            $mensajeErrorPass = '<label class="alerta">* Contraseña Incorrecta</label>';
            return $mensajeErrorPass;
        }


    }else{
        
        $mensajeErrorCorreo = '<label class="alerta"> * Correo Incorrecto</label>';
        return $mensajeErrorCorreo;
    }

}
?>