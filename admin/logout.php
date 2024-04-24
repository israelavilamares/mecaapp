<?php
// Iniciar la sesión
session_start();
// Eliminar todas las variables de sesión
session_unset();
// Destruir la sesión
session_destroy();
//destruye el cookies
setcookie("session_id", "", time() - 3600, "/");

//igual si sea ono el usuario este le redirigira o
//o ya sea que lo mamntenga el la interfaz de usuario
//admin
//header("Location: /ProyectoMecapp/index.php");
header("Location: AdminPage.php");

exit();
?>