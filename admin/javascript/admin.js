  
//------------------------------------------------MODEL DE CLIENTE-------------------------------

$(document).ready(function() {
  var myModal = new bootstrap.Modal(document.getElementById('myModalUser'));

  $("#modalUser").on("click", function() {
      AbrirmodalUser();
  });

  function AbrirmodalUser() {
      $.ajax({
          url: "FuncionesAdmin/consultaUsers.php",
          type: "GET",
          success: function(response) {
              var datos = JSON.parse(response);
              var tabla = "";

              $.each(datos, function(index, fila) {
                  tabla += "<tr>";
                  tabla += "<td>" + fila.nombre + "</td>";
                  tabla += "<td>" + fila.apellidos + "</td>";
                  tabla += "<td>" + fila.correo + "</td>";
                  tabla += "<td>" + fila.status + "</td>";
                  tabla += '<td><button class="btn btn-danger" onclick="eliminarCliente(' + fila.id + ')">Eliminar</button></td>';
                  tabla += "</tr>";
              });

              $("#myModalUser tbody").html(tabla);
              myModal.show();
          }
      });
  }
});

function eliminarCliente(id) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: "¡Esta acción eliminará al usuario permanentemente!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      // Send AJAX request to delete user
      $.ajax({
        url: "FuncionesAdmin/deleteUserCliente.php", // Script to handle deletion
        type: 'POST',
        data: { id: id }, // Send user ID as data
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            Swal.fire(
              'Eliminado!',
              'El usuario ha sido eliminado con éxito.',
              'success'
            );
           
            $.ajax({
              url: "FuncionesAdmin/consultaUsers.php",
              type: "GET",
              success: function(response) {
                // Recargar la tabla con los datos actualizados
                var datosActualizados = JSON.parse(response);
                cargarTablaUsuarios(datosActualizados);
              }
            });
           
            // Update the table after successful deletion (optional)
            // You can trigger another AJAX call to fetch updated data or remove the deleted user's row from the existing table data (if you have it stored)
          } else {
            Swal.fire(
              'Error!',
              'Ha ocurrido un error al eliminar el usuario.',
              'error'
            );
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('Error:', textStatus, errorThrown);
          Swal.fire('Error!', 'Error de conexión. Intenta nuevamente.', 'error');
        }
      });
    }
  });

}



function cargarTablaUsuarios(datos) {
  var tabla = "";
  $.each(datos, function(index, fila) {
    tabla += "<tr>";
    tabla += "<td>" + fila.nombre + "</td>";
    tabla += "<td>" + fila.apellidos + "</td>";
    tabla += "<td>" + fila.correo + "</td>";
    tabla += "<td>" + fila.status + "</td>";
    tabla += '<td><button class="btn btn-danger" onclick="eliminarCliente(' + fila.id + ')">Eliminar</button></td>';
    tabla += "</tr>";
  });

  $("#myModalUser tbody").html(tabla);
  myModal.show();
}


// --------------------------------------AQUI ACABA EL ELIMINAR------------------------------

//boton para cambiar a modo dark





//------------------------------------------------------------------
//                  hacer la barra de busqueda
//------------------------------------------------------------------


const searchInput = document.getElementById('searchInput');
const tableBody = document.getElementById('tableData');

// Función para obtener la información de la tabla
async function getData() {
  const response = await fetch('FuncionesAdmin/consultaUsers.php');
  const data = await response.json();
  return data;
}
// Función para actualizar la tabla
function updateTableData(data) {
  tableBody.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de actualizarla
  data.forEach(user => {
    const tableRow = document.createElement('tr');
    tableRow.innerHTML = `
      <td>${user.nombre}</td>
      <td>${user.apellidos}</td>
      <td>${user.correo}</td>
      <td>${user.status}</td>
      <td><button class="btn btn-danger" onclick="eliminarCliente(${user.id})">Eliminar</button></td>
    `;
    tableBody.appendChild(tableRow);
  });
}

// Función para filtrar la información
function filterData(data, searchTerm) {
  return data.filter(user => {
    const fullName = `${user.nombre} ${user.apellidos}`.toLowerCase();
    const email = user.correo.toLowerCase();
    return fullName.includes(searchTerm) || email.includes(searchTerm);
  });
}

// Obtener la información al cargar el modal
getData().then(data => {
  updateTableData(data);

  // Agregar evento al input de búsqueda
  searchInput.addEventListener('keyup', (event) => {
    const searchTerm = event.target.value.toLowerCase();
    const filteredData = filterData(data, searchTerm);
    updateTableData(filteredData);
  });
});
//------------------------------------------------------------------
//                 fin de busqueda
//------------------------------------------------------------------



//------------------------------------------------------------------
//                 el login de super usuario
//------------------------------------------------------------------

function ver()
{
  const btnver = document.getElementById("btn-SuperAdm");
  btnver.innerHTML = '<div class ="form-login-super"></div>' 
  +'<h2>Super Login</h2>'
  +'<form method="POST" action="funSupAdm/superlogin.php">'
 
  +'<input class="entradas" type ="text" name="email" id="email" placeholder="Ingresa tu correo" required>'
  
  +'<input class="entradas" type ="password" name="password" id="password" placeholder="Ingresa tu contraseña" required>'
  +'<input class ="Boton-regrister" type="submit" name="entrar" value="INGRESAR">'
  +'</form>';
}
//ID
const btnSuperAdm = document.getElementById("btn-SuperAdm");
// Agregar un evento de clic al botón y llamar a la función "ver" cuando se haga clic
btnSuperAdm.addEventListener("click", ver());

//------------------------------------------------------------------
//                 el fin login de super usuario
//------------------------------------------------------------------



//------------------------------------------------------------------
//                        al hacer click en el usuario 
//------------------------------------------------------------------
/*
const btnAdminUser = document.getElementById("btn-user-admin");
btnAdminUser.addEventListener('click',(event)=>{

});

*/

//------------------------------------------------------------------
//                        al hacer click en el Citas 
//------------------------------------------------------------------

$(document).ready(function() {
  $("#modalCitas").on("click", function() {
      AbrirmodalCitas();
  });
});

function AbrirmodalCitas()
{

  $.ajax({
    url: "FuncionesAdmin/queryCitas.php",
    type: "GET",
    dataType: "JSON",
    success:function(data)
    {
      const tbody = document.getElementById("resultCitas");
      tbody.innerHTML = "";//limpiar
      data.forEach(dato =>{
       const filas = document.createElement("tr");
       filas.innerHTML = `
       
        <td class="tcell">${dato.nombre}</td>
        <td class="tcell">${dato.correo}</td>
        <td class="tcell">${dato.placas}</td>
        <td class="tcell">${dato.fecha}</td>
        <td class="tcell">${dato.hora}</td>
        <td class="tcell">${dato.estado}</td>
        <td class=""><button class="btn btn-danger" onclick="eliminarCita(${dato.id})">Eliminar</button></td>          
       `;
      tbody.appendChild(filas);
      });

    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error('Error:', textStatus, errorThrown);
      Swal.fire('Error!', 'Error de conexión. Intenta nuevamente.', 'error');
    }
  });

}

//------------------------------------------------------------------
//                        ELIMINAR CITAS
//------------------------------------------------------------------


function eliminarCita(id)
{
  
  Swal.fire({
    title: '¿Estás seguro?',
    text: "¡Esta acción eliminará al usuario permanentemente!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "FuncionesAdmin/deleteCitas.php",
        type: "POST",
        data: {id:id},
        dataType: "JSON",
        success:function(response){
          if(response.success)
          {
            Swal.fire('Eliminado!','se ha eliminado con exito','success')
            AbrirmodalCitas();
          }else
          {
            Swal.fire(
              'Error!',
              'Ha ocurrido un error al eliminar el usuario.',
              'error'
            );
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('Error:', textStatus, errorThrown);
          Swal.fire('Error!', 'Error de conexión. Intenta nuevamente.', 'error');
        }

      });

}
  });

}



//------------------------------------------------------------------
//                        Alertas
//------------------------------------------------------------------



$(document).ready(function() {
  $("#modalAlert").on("click", function() {
      AbrirmodalAlert();
  });
});

function AbrirmodalAlert()
{

  $.ajax({
    url: "FuncionesAdmin/queryCitas.php",
    type: "GET",
    dataType: "JSON",
    success:function(data)
    {
      const tbody = document.getElementById("resultAlert");
      tbody.innerHTML = "";//limpiar
      data.forEach(dato =>{
       const filas = document.createElement("tr");
       filas.innerHTML = `
       
        <td class="tcell">${dato.nombre}</td>
        <td class="tcell">${dato.correo}</td>
        <td class="tcell">${dato.placas}</td>
        <td class="tcell">${dato.estado}</td>
        <td><button class="btn btn-success" onclick="enviarCorreo('${dato.correo}','${dato.nombre}','${dato.placas}','${dato.id}')">listo</button></td>          
       `;
      tbody.appendChild(filas);
      });

    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error('Error:', textStatus, errorThrown);
      Swal.fire('Error!', 'Error de conexión. Intenta nuevamente.', 'error');
    }
  });

}


function enviarCorreo(correo,nombre,placas,id)
{
  const val = "Completado";
    $.ajax({
    type: "POST",
    url: "FuncionesAdmin/sentEmail.php",
    data: {
    correo:correo,
    nombre:nombre,
    placas:placas},
    success: function(respuesta)
    {
      if(respuesta == "exito"){  
        Swal.fire(
            'Enviado!',
            'El usuario ha recibido el mensaje con exito.',
            'success'
          );

        $.ajax({
          type: "POST",
          url: "FuncionesAdmin/editfield.php",
          dataType: "JSON",
          data:{id:id},
          success: function(result)
          {
            if(result.success)
            {
                console.log("Termindo");
                AbrirmodalAlert();
            }else
            {
                console.log("Error");
            }
          }
        });
      }else{
        Swal.fire(
          'Error!',
          'El usuarioc no ha recibido el mensaje.',
          'error'
        );
      }
    }

  });
    
}

const colorchanges = document.getElementById("inventCss");
colorchanges.addEventListener('mouseover', (event) => {
  if (colorchanges.style.color === "white") {
    colorchanges.style.color = "black";
  } else {
    colorchanges.style.color = "white";
  }
});





