<?php
require "conecta.php";

$con = conecta();

$correo = $_POST['correo']; 

$query = "SELECT correo FROM clientes WHERE correo = '$correo'";
$sql = $con->query($query);

if ($sql->num_rows > 0) {
    echo "existe"; 
} else {
    echo "no existe"; 
}
?>