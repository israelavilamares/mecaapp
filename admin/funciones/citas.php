<?php

session_start();

require("conecta.php");

$conn = conecta();

date_default_timezone_set('America/Mexico_City');

if (isset($_POST['date']) and !empty($_POST['date'])) {
    try {
        // Obtiene la fecha del formulario
        $selected_date = $_POST['date'];

        // Prepara y ejecuta la consulta
        $stmt = $conn->prepare("SELECT hora FROM citas WHERE fecha = ?");
        $stmt->bind_param("s", $selected_date);
        $stmt->execute();
        $result = $stmt->get_result();

        $available_hours = [];
        while ($row = $result->fetch_assoc()) {
            $available_hours[] = $row['hora'];
        }

        echo json_encode($available_hours);
    } catch (Exception $e) {
        // Devolver un mensaje de fallo en formato JSON
        echo json_encode(['error' => $e->getMessage()]);
    }
}

if (isset($_POST['createDate']) and !empty($_POST['createDate'])) {
    try {

        $nombre = $_SESSION['nombre']; 
        $correo = $_SESSION['correo'];
        $fecha = $_POST['date'];
        $hora = $_POST['time'];
        $placas = $_POST['plate'];
    
        // Prepara y ejecuta la consulta
        $stmt = $conn->prepare("INSERT INTO citas (nombre, correo, fecha, hora, placas) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $correo, $fecha, $hora, $placas);
        $stmt->execute();
    
        echo 'Cita creada con éxito';

    } catch (Exception $e) {

        // Devolver un mensaje de fallo en formato JSON
        echo json_encode(['error' => $e->getMessage()]);
    }
}