<?php
require "conecta.php";

$id= $_POST["id"];

// Preparar la consulta SQL
$sql = "DELETE FROM administrador WHERE id = ?";

// Preparar la instrucción
$stmt = mysqli_prepare($con, $sql);

// Vincular parámetros y ejecutar la consulta
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
  $response = array("success" => true, "message" => "¡Usuario eliminado con éxito!");
} else {
  $response = array("success" => false, "message" => "Error: " . mysqli_error($conn));
}

// Cerrar la instrucción y la conexión
mysqli_stmt_close($stmt);
mysqli_close($con);

// Enviar la respuesta JSON
echo json_encode($response);

?>