<?php
include("conecta.php");

$sql = "SELECT nombre,cantidad FROM inventario";
$result = mysqli_query($con,$sql);


$articulos = array(); // Creamos un array para almacenar los datos

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Verificamos si la cantidad es menor o igual a 5
        if ($row["cantidad"] <= 5) {
            // Agregamos la fila al array de artículos
            $articulos[] = $row; 
        }
    }
    
    // Configuramos las cabeceras para indicar que la respuesta es JSON
    header('Content-Type: application/json');
    
    // Devolvemos los datos como JSON
    echo json_encode($articulos);
} else {
    echo "0 resultados";
}

$con->close();
?>