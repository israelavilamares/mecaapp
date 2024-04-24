<?php
require "conecta.php";

$sql = "SELECT * FROM administrador";
$result = $con->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $nombre = $row["nombre"];
    $apellido = $row["APELLIDO"];
    $email = $row["email"];
    $status = $row["STATUS"];
    $data[] = array("id"=>$id, "nombre" => $nombre, "apellido" => $apellido  ,"email" => $email,"status"=>$status,);
}

echo json_encode($data);
$con->close();

?>