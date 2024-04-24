<?php
session_start();

require "conecta.php";

$con = conecta();

$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$passEnc = md5($_REQUEST['pass']);
 
    $query = "INSERT INTO clientes (nombre, apellidos, correo, pass) VALUES ('$nombre', '$apellido', '$correo', '$passEnc')";
    $sql = $con->query($query);
    if ($sql) {

        echo "Registro exitoso";
        
    } else {
        echo "Error al registrar";
    }
?>
