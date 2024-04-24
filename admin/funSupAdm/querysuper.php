<?php 
include("conecta.php");

$sql = "SELECT id,nombre,apellido,email FROM superadmin";

$resultado = mysqli_query($con,$sql);

$almacen = array();


if($resultado)
{
    while($filas = mysqli_fetch_assoc($resultado))
    {
        $almacen[] = $filas;
    }
    echo json_encode($almacen);

}else{
    echo "ERROR. " . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);


?>