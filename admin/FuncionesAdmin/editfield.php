<?php 

require "conecta.php";

// Obtener datos del usuario de la solicitud
$id = $_POST["id"];

$status ="Completado";
// Validar datos (opcional)
// Puedes agregar validaciones más complejas aquí


// Preparar la consulta SQL
$sql = "UPDATE citas SET estado = ? WHERE id = ?";

// Preparar la declaración
$stmt = mysqli_prepare($con, $sql);

// Vincular parámetros
mysqli_stmt_bind_param($stmt, "si", $status, $id);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
  $response = array("success" => true, "message" => "Usuario actualizado correctamente");
} else {
  $response = array("success" => false, "message" => "Error al actualizar el usuario: " . mysqli_error($con));
}

// Cerrar recursos
mysqli_stmt_close($stmt);
mysqli_close($con);

// Enviar respuesta JSON
echo json_encode($response);
?>