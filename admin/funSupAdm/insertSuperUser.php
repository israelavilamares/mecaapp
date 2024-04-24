<?php
require 'conecta.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['email'];
$password = password_hash($_POST['pass'],PASSWORD_BCRYPT);

$sql = "INSERT INTO superadmin(nombre,apellido,email,pass) VALUES('$nombre','$apellido','$correo','$password')";

if($con->query($sql) === TRUE) {
    $response = array("success" => true, "message" => "Datos insertados con exito");
} else {
    $response = array("success" => false, "message" => "Error: " . mysqli_error($conn));
}
// Enviar la respuesta JSON
echo json_encode($response);

?>