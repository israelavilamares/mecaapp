<?php
include("conecta.php");

$sql = "SELECT * FROM inventario";
$resultado = mysqli_query($con,$sql);

$vector1 = array();

    if($resultado==TRUE)
    {
        while($filas = mysqli_fetch_assoc($resultado))
        {
            $vector1[] = $filas;
        }
        echo json_encode($vector1);

    }else{
        echo "ERROR. " . mysqli_error($con);
    }


$con->close();
?>