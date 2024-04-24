<?php 
include("conecta.php");

// Verificar si se recibió el parámetro "id" en la solicitud GET
if(isset($_GET['id'])) {
  // Obtener el ID del usuario desde la solicitud
  $id = $_GET['id'];

  //tambien icluir el id 
  // Preparar la consulta SQL para obtener los datos del usuario
  $sql = "SELECT nombre, apellido, email, id FROM administrador WHERE id = ?";

  // Preparar la declaración SQL
  $stmt = mysqli_prepare($con, $sql);

  // Vincular el parámetro de ID
  mysqli_stmt_bind_param($stmt, "i", $id);

  // Ejecutar la consulta
  if (mysqli_stmt_execute($stmt)) {
      // Obtener el resultado de la consulta
      $result = mysqli_stmt_get_result($stmt);
      
      // Verificar si se encontraron resultados
      if (mysqli_num_rows($result) > 0) {
          // Obtener los datos del usuario
          $userData = mysqli_fetch_assoc($result);
          
          // Crear un array de respuesta
          $response = array("success" => true, "data" => $userData);
      } else {
          // No se encontraron resultados para el ID especificado
          $response = array("success" => false, "message" => "Usuario no encontrado");
      }
  } else {
      // Error al ejecutar la consulta SQL
      $response = array("success" => false, "message" => "Error al obtener datos del usuario: " . mysqli_error($con));
  }

  // Cerrar la declaración SQL
  mysqli_stmt_close($stmt);
} else {
  // No se proporcionó el parámetro "id" en la solicitud
  $response = array("success" => false, "message" => "ID de usuario no proporcionado");
}

// Cerrar la conexión a la base de datos
mysqli_close($con);

// Enviar la respuesta JSON al cliente
echo json_encode($response);


?>