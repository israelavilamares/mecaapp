<?php 

require "conecta.php";

// Obtener datos del usuario de la solicitud
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
// Validar datos (opcional)
// Puedes agregar validaciones más complejas aquí

if (empty($nombre) || empty($apellido) || empty($email)) {
  $response = array("success" => false, "message" => "Debes completar todos los campos");
  echo json_encode($response);
  exit;
}

// Preparar la consulta SQL
$sql = "UPDATE administrador SET nombre = ?, apellido = ?, email = ? WHERE id = ?";

// Preparar la declaración
$stmt = mysqli_prepare($con, $sql);

// Vincular parámetros
mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $email, $id);

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