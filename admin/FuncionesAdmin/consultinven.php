<?php
include("conecta.php");


$sql = "SELECT * FROM inventario";
$result = mysqli_query($con,$sql);

$vector = array();

    if($result==TRUE)
    {
        while($filas = mysqli_fetch_assoc($result))
        {
            $vector[] = $filas;
        }
        echo json_encode($vector);

    }else{
        echo "ERROR. " . mysqli_error($con);
    }


$con->close();
?>