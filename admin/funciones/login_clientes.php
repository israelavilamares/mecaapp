<?php
session_start();

require "conecta.php";

$con = conecta();

$correo = $_POST['email'];
$password = $_POST['password'];

$passEnc = md5($password);

$query = "SELECT * FROM clientes WHERE correo = '$correo' AND pass = '$passEnc' AND eliminado != 1 AND status != 0";
$result = $con->query($query);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $_SESSION['logeado'] = true;
    $_SESSION['correo'] = $correo;
    $_SESSION['nombre'] = $row['nombre'];
    echo 'TRUE';
} else {
    echo 'FALSE';
}
?>