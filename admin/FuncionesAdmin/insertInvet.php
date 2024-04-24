<?php 
require "conecta.php";


        $nombre = $_POST['nombre'];
        $cant = $_POST["cantidad"];
        $descrip = $_POST["descripcion"];
        $cost = $_POST["costo"];
        $dateinput = $_POST["fecha_entrada"];
        $provee = $_POST["proveedor"];
        // generar el id aprtir de la siguiente regla
        //la regla es 3 caractres de nombre 
        //2 caracteres de costo //3 fecha_entrega //2 proveedor
       
        $getNom = substr($nombre, 0, 3);
        $getCosto = substr($cant, 0, 1);
        $getFecha_entrega = substr($dateinput, 0, 3);
        $getProveedor = substr($provee, 0, 3);

        $id = $getNom . $getCosto . $getFecha_entrega . $getProveedor;

        //echo "El ID generado es: $id";
        //$id = $getNom + $getCosto + $getFecha_entrega + $getproveedor;
        //echo "hola",$id;
        

        //$sql ="INSERT INTO inventario(inombre,cantidad,descripcion,costo,fecha_entrada,proveedor) values('?','?','?','?','?','?')";

        $sql ="INSERT INTO inventario(id,nombre,cantidad,descripcion,costo,fecha_entrada,proveedor) values('$id','$nombre','$cant','$descrip','$cost','$dateinput','$provee')";
        //$stmt = $con->prepare($sql);
        //$stmt->bind_param("ssssss",$nombre,$cant,$descrip,$cost,$dateinput,$provee);
        // Preparar la respuesta JSON
           //$respuesta = array();
   
           if ($con->query($sql) === TRUE) {
            echo "Datos insertados correctamente";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
   
           /*
        if ($con->query($sql)=== TRUE) {

            $respuesta["success"] = true;

        } else {
            $respuesta["message"] = "El registro se ha insertado correctamente.";
        }
        
 //      $stmt->close();
 echo json_encode($response);
 header("Content-Type: application/json");
 */

?>