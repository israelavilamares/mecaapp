<?php 
session_start();
#para mejorar solo por el usuario
// Función para verificar si el usuario ha iniciado sesión

function usuarioAutenticado() {
    return isset($_SESSION["email"]) && !empty($_SESSION["nombre"] && !empty($_SESSION["user_id"]));
  }

  // Redirigir al usuario si no ha iniciado sesión
  if (!usuarioAutenticado()) {
    header("Location: AdminPage.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>INVENTARIO</title>
        <link rel="icon" href="descargas/logo.jpeg" type="image/x-icon">
        <link rel="stylesheet" href="style/styleinventario.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">



    </head>
    <body>
    <div class="linea">
        <h2 class="Cinta-nombre">Bienvenido a Inventario <?php echo $_SESSION['nombre'],' ',  $_SESSION["APELLIDO"];?></h2>
        <button class="btn-house" onclick="location.href='AdminPage.php'"><img src="descargas/casaregresar.png" alt="">Regresar</button>
    </div>

    <div class="space-search">
        <input class="search-barra" type="search" id="searchInput" placeholder="Search................................."><span class="icon"><img src="descargas/found.png" alt="Icono"></span>
    </div>

    <button id="agregar" class="btn-agregar-inv"><img src="descargas/agregarinve.png" alt="">Agregar</button>

    <table class="table-inv" id="tablainventario">
    <thead class="table-head-inv">
        <tr>
            <th>#</th>
            <th>codigo</th>
            <th>nombre</th>
            <th>cantidad</th>
            <th>descripcion</th>
            <th>costo</th>
            <th>fecha_entrada</th>
            <th>proveedor</th>
            <th>accion</th>
            <!-- Agrega más columnas según tu tabla -->
        </tr>
    </thead>
    <tbody id="tablainv">
    </tbody>
    </table>

    <!--<button id="prueba">prueba</button>  -->

    <div id="miModal" class="modal">
    <!-- Contenido del modal -->
    <div class="modal-contenido">
        <!-- Botón para cerrar el modal -->
        <span class="modal-cerrar" id="btnCerrarModal">&times;</span>
        <!-- Contenido del modal -->
        <div class="conteinerForm">
            <form id="form-invent" method="POST"><!-- action="FuncionesAdmin/insertInvet.php" -->
            <div id="mensajes"></div>
                <h3 class="tito-form">AGREGA</h3>
                <hr>
                <br>
                <input class="entradas" name="nombre"  id="nombre" type="text" placeholder="nombre" minlength="3" required  title="El nombre debe tener al menos 3 caracteres">
                <input class="entradas" name="cantidad" id="cantidad" type="number" maxlength="11" title="Maximo 11 numeros" placeholder="cantidad" required>
                <textarea class="entradas" name="descripcion" id="descripcion" type="text" placeholder="descripcion ejem. modelo, color, etc." required></textarea>
                <input class="entradas" name="costo" id="costo" type="text" placeholder="costo" minlength="1" title="Minimo 1 caracter"  required>
                <input class="entradas" name="fecha_entrada" id="fecha_entrada" type="date" minlength="3" title="Minimo 3 caracteres" required>
                <input class="entradas" name="proveedor" id="proveedor" type="text" minlength="3" title="Minimo 3 caracter" placeholder="proveedor" required>
                <hr>
                <br>
                <button class="btn-form-inv"  type="submit">Enviar</button> <!--onclick="agregar()" -->
            </form>
        </div>

    </div>
    </div>


    <script src="javascript/adminInv.js"></script>
    </body>

</html>