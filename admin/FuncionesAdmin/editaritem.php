<?php 

require "conecta.php";

// Obtener datos del usuario de la solicitud
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$cantidad = $_POST["cantidad"];
$descripcion = $_POST["descripcion"];
$costo = $_POST["costo"];
$fecha_entrada = $_POST["Fecha_Ent"];
$proveedor = $_POST["proveedor"];



// Validar datos (opcional)
// Puedes agregar validaciones más complejas aquí

if (empty($nombre) || empty($cantidad) || empty($costo) || empty($fecha_entrada) || empty($proveedor)) {
  $response = array("success" => false, "message" => "Debes completar todos los campos");
  echo json_encode($response);
  exit;
}




// Preparar la consulta SQL
$sql = "UPDATE inventario SET nombre = ?, cantidad = ?, descripcion = ? , costo = ?, fecha_entrada = ?, proveedor=?  WHERE id = ?";

// Preparar la declaración
$stmt = mysqli_prepare($con, $sql);

// Vincular parámetros
mysqli_stmt_bind_param($stmt, "sisisss" , $nombre, $cantidad, $descripcion, $costo, $fecha_entrada, $proveedor,  $id);

// Ejecutar la consulta
if (mysqli_stmt_execute($stmt)) {
  $response = array("success" => true, "message" => "articulo actualizado correctamente");
} else {
  $response = array("success" => false, "message" => "Error al actualizar el usuario: " . mysqli_error($con));
}

// Cerrar recursos
mysqli_stmt_close($stmt);
mysqli_close($con);

// Enviar respuesta JSON
echo json_encode($response);
?>