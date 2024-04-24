<?php 
include("conecta.php");

$id = $_GET["id"];
    // Paso 2: Recuperar los datos del elemento según el ID
    $sql = "SELECT nombre, cantidad, descripcion, costo, fecha_entrada, proveedor FROM inventario WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Paso 3: Formatear los datos en JSON y enviarlos al cliente
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(array("success" => true, "data" => $data));
    } else {
        echo json_encode(array("success" => false, "message" => "No se encontraron datos para el ID proporcionado."));
    }


?>