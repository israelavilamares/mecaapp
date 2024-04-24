<?php 
include("conecta.php");
session_start();
if(isset($_POST["entrar"]))
{
    $correo = $_POST["email"];
    $pass  = $_POST["password"];

     // verificamos el correo y de manera segura email .
     $sql = "SELECT * FROM superadmin WHERE email = ?";
     $stmt = mysqli_prepare($con, $sql);
     mysqli_stmt_bind_param($stmt, "s", $correo);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);
 
     //verificamos la contreseña
    if(mysqli_num_rows($result)==1)
    {
     
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row["pass"];
 
        if(password_verify($pass,$hashedPassword))
        {
                $_SESSION['email'] = $row["email"];
                $_SESSION['nombre'] = $row["nombre"];
                $_SESSION['apellido'] = $row["apellido"];

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

                header("Location: ../superAdmPage.php");
                exit;
            
        }else{
            echo "<script>
            alert('*Contraseña Incorrecta');
            location.href ='../AdminPage.php';
            </script>";  
            
            }

    }else{
        echo "<script>alert('*Correo Incorrecto');
        location.href ='../AdminPage.php';
        </script>";
    }

}


?>