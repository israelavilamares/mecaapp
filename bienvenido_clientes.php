<?php
session_start();

if (!isset($_SESSION['logeado']) || $_SESSION['logeado'] != TRUE) {
    header('Location: admin/funciones/cerrar_sesion.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="admin/style/estilo.css">
</head>
<body class="fondo">

    <?php include('admin/funciones/menu_clientes.php'); ?>
    <div class="body">
    <div class="welcome-container">
    <div class="titulo">
    <?php
    if (isset($_SESSION['nombre'])) {
        echo "Bienvenido " . $_SESSION['nombre'];
    }
    ?>
    </div>
    
        <p>Gracias por ingresar.</p>

    </div>
</body>
</html>