<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "mecapp";

    $con = new mysqli($host, $user, $password, $database);
    if (!$con) {
        die("Error al conectar: " . mysqli_connect_error());
    }

?>