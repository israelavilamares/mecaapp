<?php 
session_start();
#para mejorar solo por el usuario
// Función para verificar si el usuario ha iniciado sesión

function usuarioAutenticado() {
    return isset($_SESSION["email"]) && !empty($_SESSION["nombre"] && !empty($_SESSION["user_id"]));
  }

  // Redirigir al usuario si no ha iniciado sesión
  if (!usuarioAutenticado()) {
    header("Location: ../index.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>
    <head>
   <title>Administrador</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
   <link rel="icon" href="descargas/logo.jpeg" type="image/x-icon"> 
   <link rel="stylesheet" href="style/InterfazAdmStyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-YWznkfwQXVzKUryCHFwBA3Hr7Aegl+sYNcCWRePfrYBm1qvTFShPwvvOMyRmVWLPQCB7D2wwIbLAQkWjtFzYwQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Enlace a DataTables CSS -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> -->

<!-- Enlace a DataTables JS -->
<!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->
</head>

<body>
    <div class="barra">
    <h2><?php echo $_SESSION['nombre'],' ', $_SESSION["APELLIDO"];?></h2><img src="descargas/menu.png">
    <ul>
        <!-- <li><a href="alertas.php">Alerta</a></li> -->
        <li><a id="modalAlert" data-bs-toggle="modal" data-bs-target="#modalAlertas">Alerta</a></li>
        <li><a id="modalCitas" data-bs-toggle="modal" data-bs-target="#modalCitasAdm">citas</a></li>
        <li><a id="inventCss" href="inventario.php">inventario</a></li>
        <li><a id="modalUser" data-bs-toggle="modal" data-bs-target="#myModalUser">usuarios</a></li>
        <li><form action="logout.php">
            <input type="submit" value="cerrar sesion">
        </form></li>
    </ul>

    </div>

    <div class="linea">
      <div class="marco-circular" id="btn-user-admin">
          <img src="descargas/user_85923.png" alt="imagen">
      </div>
        <h2 class="Cinta-nombre">Bienvenido <?php echo $_SESSION['nombre'],' ',  $_SESSION["APELLIDO"];?></h2>
    </div>


<!-- **********************************************MODAL DE USUARIO **************************************************** -->

<div class="modal fade" id="myModalUser"  tabindex="-1" aria-labelledby="modalTablaLabel" aria-hidden="true">
 <!-- <div class="modal-dialog modal-lg modal-dialog-centered"> -->
 <div class="modal-dialog  modal-dialog-centered modal-xl"> 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTablaLabel">CLIENTES</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body my-modal-body-user">
      <div class="input-group mb-3">
    <input type="text" class="form-control" id="searchInput" placeholder="Buscar...">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="button">Buscar</button>
    </div>
    </div>
         <table class="table table-striped table-bordered mx-auto">
          <thead>
            <tr>
              <th>nombre</th>
              <th>apellidos</th>
              <th>correo</th>
              <th>status</th>
              <th>acciones</th>
            </tr>
          </thead>
          <tbody id="tableData">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>



<!-- **********************************************MODAL DE CITAS **************************************************** -->

<div class="modal fade" id="modalCitasAdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Citas</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <table class="table table-striped table-bordered table-responsive mx-auto">
          <thead>
            <tr> <!-- fila -->
              
              <th class="tname">Nombre</th> <!-- columnas -->
              <th class="tname">Correo</th>
              <th class="tname">Placas</th>
              <th class="tname">Fecha</th>
              <th class="tname">Hora</th>
              <th class="tname">Estatus</th>
              <th class="tname">Accion</th>
          </thead>
        <tbody id="resultCitas">
        </tbody>
      </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- ************************************** AQUI TERMINA MODAL CITAS ********************************** -->

<!-- ************************************   MODAL DE ALERTAS **************************************************** -->

<div class="modal fade" id="modalAlertas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Alertas</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


      <table class="table table-striped table-bordered table-responsive mx-auto">
          <thead>
            <tr> <!-- fila -->
              
              <th class="tname">Nombre</th> <!-- columnas -->
              <th class="tname">Correo</th>
              <th class="tname">Placas</th>
              <th class="tname">Estatus</th>
              <th class="tname">Accion</th>
            </tr>
           </thead>
        <tbody id="resultAlert">

        </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- ************************************** AQUI TERMINA MODAL ALERTAS ********************************** -->
<div class="csschart">
  <canvas id="myChart" class="csschart"></canvas>
</div>
<div class="btnLogSup" id="btn-SuperAdm">login Super Admin</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="javascript/admin.js"></script>
  
<script>

var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
  
    type: 'bar',
    data: {
        datasets: [{
          label: 'Inventario Menor a 6 Productos',
            backgroundColor: ['#6bf1ab','#63d69f', '#438c6c', '#509c7f', '#1f794e', '#34444c', '#90CAF9', '#64B5F6', '#42A5F5', '#2196F3', '#0D47A1'],
            borderColor: 'black',
            borderWidth: 1,
            data: [] // Agrega un array vacío para los datos
        }]
    },
    options: {
        plugins:{
            title: {
                display: true,
                text: 'Inventario Emergencia '
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

let url = "FuncionesAdmin/consultainventario0.php";
fetch(url)
    .then(response => response.json())
    .then(datos => mostrar(datos))
    .catch(error => console.log(error));

const mostrar = (articulos) => {
    // Restablecer los datos del gráfico antes de actualizarlo
    myChart.data.labels = [];
    myChart.data.datasets[0].data = [];

    articulos.forEach(element => {
        myChart.data.labels.push(element.nombre);
        myChart.data.datasets[0].data.push(element.cantidad);
    });
    myChart.update();
    console.log(myChart.data);
};

</script>

</body>

  
    <footer>
        <div class="contenedor-footer">
            <div class="content-foo">
           <h4>Teléfono</h4>
           <p>3337984333</p>
        </div>
        <div class="content-foo">
            <h4>Correo electrónico</h4>
            <p>taller@gmail.com</p>
        </div>
        <div class="content-foo">
           <h4> Ubicación </h4>
           <p>Paulino Navarro 1345, Los Maestros, 45150 Zapopan, Jal.</p>
        </div>
    </div>
    <h2 class="titulo-final">&copy; pluton | IngSoftware</h2>
</footer>

</html>