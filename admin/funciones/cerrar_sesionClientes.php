<?php
    require 'conecta.php';
    $conn = conecta();

    session_start();
    session_destroy();
    header("location: ../../index.php");
    exit();
?>
