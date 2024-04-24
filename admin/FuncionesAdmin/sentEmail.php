<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;

//require 'phpmailer/src/Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer;

$mensaje = "tu carro esta listo par recojerlo ya puedes pasar nuestro horario es de 12:00 a 8:00";
$email = $_POST['correo'];
$nombre = $_POST['nombre'];
$placas = $_POST['placas'];


$mail->SMTPDebug = 0; 
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "israel.avila5220@alumnos.udg.mx"; // Reemplaza con tu correo electrónico
$mail->Password = "sjldzdvfzvlbeynb"; // Reemplaza con tu contraseña
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('israel.avila5220@alumnos.udg.mx', 'Taller Mecanico');
$mail->addAddress($email,$nombre);
$mail->Subject = "Correo electronico de prueba";
$mail->isHTML(true);
$mail->Body = "<b>Nombre:</b>$nombre<br><b>Correo electrónico:</b> $email <br><b>Mensaje:</b> $mensaje <br><b>Placas:</b> $placas";

// Enviar correo electrónico
if(!$mail->send()){
    echo "error";
}else{
    echo "exito";
}

?>