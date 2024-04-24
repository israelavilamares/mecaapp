<?php
require "conecta.php";
$id = $_POST["id"];

$sql = "DELETE FROM inventario where id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);//i es para numeros s para caracteres.

if(mysqli_stmt_execute($stmt))
{
    $response = array('success' => true, 'message' => 'El elemento se eliminó correctamente.');
    echo json_encode($response);
    
}else
{
    $response = array('success' => false, 'message' =>'ID inválido.');
    echo json_encode($response);
}
?>