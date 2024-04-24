
//----------------------------------------------------------------------
//                      MOSTRAR LA TABLA de ADMINISTRADORES parte 1
//----------------------------------------------------------------------

function mostrarTabla()
  {
      $(document).ready(function() {
          // Enviar la solicitud AJAX
          $.ajax({
              url: "FuncionesAdmin/selectAdmin.php",
              type: 'GET',
              dataType: 'json',
              success: function(data) {
                  // Procesar la respuesta JSON y llenar la tabla
                  var html = '<table class="table table-hover table-bordered table-striped caption-top text-start table-resposive">';
                  html += '<caption class="table-title">Administradores</caption>';
                  html += '<thead class="columnas-table"><tr><th>Nombre</th><th>Apellido</th><th>correo</th><th>Status</th><th>Acciones</th></tr></thead>';
                  html += '<tbody class="table-filas">';
      
                  for (var i = 0; i < data.length; i++) {
                      html += '<tr>';
                      html += '<td>' + data[i].nombre + '</td>';
                      html += '<td>' + data[i].apellido + '</td>';
                      html += '<td>' + data[i].email + '</td>';
                      html += '<td>' + data[i].status + '</td>';
                      html += '<td>';
                      html += '<button class="btn btn-primary btn-editar" data-id="' + data[i].id + '">Editar</button>';
                      html += '<button class="btn btn-danger" onclick="eliminarUsuario(' + data[i].id + ')">Eliminar</button>';
                      html += '</td>';
                      html += '</tr>';
                  }
      
                  html += '</tbody></table>';
                  $('#resultado').html(html);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.error('Error:', textStatus, errorThrown);
              }
          });
    });
      
}

//----------------------------------------------------------------------
//              ELIMINAR ADMINISTRADORES parte 2
//----------------------------------------------------------------------


function eliminarUsuario(id) {
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
            url: "FuncionesAdmin/deleteUser.php", // Script to handle deletion
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
                mostrarTabla();
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

//----------------------------------------------------------------------
//              EDITAR ADMINISTRADORES parte 3
//----------------------------------------------------------------------

function EditarDatos(id) {
    // Obtener los datos del usuario mediante una solicitud AJAX
    $.ajax({
        url: "FuncionesAdmin/getUserData.php",
        type: "GET",
        dataType: "json",
        data: { id: id },
        success: function(response) {
            if (response.success) {
                // Rellenar el formulario de edición con los datos del usuario
                $("#editForm #id").val(response.data.id);
                $("#editForm #nombre").val(response.data.nombre);
                $("#editForm #apellido").val(response.data.apellido);
                $("#editForm #email").val(response.data.email);
            //    $("#editForm #password").val(response.data.password);
                // Mostrar el modal de edición
                $("#modalEditar").modal("show");
            } else {
                console.error("Error al obtener los datos del usuario");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error de conexión: " + textStatus + " - " + errorThrown);
        },
    });
  }
  
  // Asignar el evento click al botón "Editar" dentro de la tabla
  $(document).on("click", ".btn-editar", function() {
    var id = $(this).data("id"); // Obtener el ID del usuario del atributo data-id del botón
    EditarDatos(id);
  });
  
  // Cuando se envía el formulario de edición
  $("#editForm").submit(function(event) {
    event.preventDefault(); // Prevenir la acción por defecto del formulario
    // Obtener los datos del formulario
    var id = $("#editForm #id").val();
    var nombre = $("#editForm #nombre").val();
    var apellido = $("#editForm #apellido").val();
    var email = $("#editForm #email").val();
    // Realizar la petición AJAX para editar el usuario
    $.ajax({
        url: "FuncionesAdmin/editUser.php",
        type: 'POST',
        data: { id: id, nombre: nombre, apellido: apellido, email: email},
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Cerrar el modal de edición
                $("#modalEditar").modal("hide");
                // Recargar la tabla de usuarios
                Swal.fire({
                  title: "Good job!",
                  text: "You clicked the button!",
                  icon: "success"
                  });
                mostrarTabla();
            } else {
                alert("Error al editar el usuario");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error de conexión: " + textStatus + " - " + errorThrown);
        }
    });
  });






//----------------------------------------------------------------------
//                      MOSTRAR LA TABLA de ADMINISTRADORES cuando de se
//                      AGREGQUE UN USUARIO PERO NECESARIA PARA MOSTRARLA
//                      NORMAL parte 4.
//----------------------------------------------------------------------


$(document).ready(function(){
    mostrarTabla();
$('#insertForm').submit(function(e){
    e.preventDefault(); // Evitar que se recargue la página
    var formData = new FormData(this); // Obtener los datos del formulario
    $.ajax({
        type: 'POST',
        url: 'FuncionesAdmin/insert.php', // Archivo PHP donde procesas los datos
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(response) {
            if (response.success) {
        //$("#resultado2").html("¡Datos insertados con éxito!");
        Swal.fire({
            title: "Good job!",
            text: "You clicked the button!",
            icon: "success"
            });
            mostrarTabla();
        } else {

            Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!"
            });
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error("Error:", textStatus, errorThrown);
    }

        });
    });
});





//----------------------------------OCULTAR Y DSECOUTAR FORMUALRIO-----------------------------

// Obtener el elemento del formulario por su ID
var formulario = document.getElementById("AdminForRegister");
// Ocultar el formulario cambiando su estilo
formulario.style.display = "none";

function btonAgregarOcultarFor()
{

  if(formulario.style.display === "none")
  {

    formulario.style.display = "block";
  }else
  {

    formulario.style.display = "none";
  }
}

//-----------------------------FIN DE OCULTAR FORMULARIO------------/



//|--------------------------------------------------------------------------------------
//|--------------------------------------------------------------------------------------
//|------------------    MODAL DE SUPERADMINISTRADORES   -------------------------------/
//|--------------------------------------------------------------------------------------
//|--------------------------------------------------------------------------------------


//var btnsuperadmin0 = document.getElementById('btn-super-admin');

//btnsuperadmin0.addEventListener("click",function(){

function superAdmin(){

  //alert("funcionado");
  $.ajax({
    url: "funSupAdm/querysuper.php",
    type: "GET",
    dataType: "JSON",
    success: function(datos){
      
      const tbody = document.getElementById('contenidoTable');
      tbody.innerHTML = '';
      datos.forEach(celda => {
        const Tablafilas = document.createElement('tr');
        Tablafilas.innerHTML = 
       `<td>${celda.nombre}</td>
        <td>${celda.apellido}</td>
        <td>${celda.email}</td>
        <td><button class="btn btn-primary btn-editar-Super" onclick ="editarSupUsr(${celda.id})" >Editar</button>
        <button class="btn btn-danger" onclick="eliminarSuperUsuario(${celda.id})">Eliminar</button></td>
        `;
        tbody.appendChild(Tablafilas);
      });
    },
    error:
      function(xhr, status) {
        alert('Disculpe, existió un problema');
      },

     // complete: function(xhr, status) {
       // alert('Petición realizada');

  });

}


//|----------------------------------------------------------------------------------
//|----------------------------------------------------------------------------------
//--------------------------  ELIMINAR SUPER USUARIO  ------------------------------
//|----------------------------------------------------------------------------------
//|----------------------------------------------------------------------------------

function eliminarSuperUsuario(id)
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
        url: 'funSupAdm/deleteSuperAdmin.php',
        type: 'POST',
        data:{id: id },
        dataType: "json",
        success: function(response) {
         
          if (response.success) {
            Swal.fire(
              'Eliminado!',
              'El usuario ha sido eliminado con éxito.',
              'success'
            );
           
              superAdmin(); 
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


//|----------------------------------------------------------------------------------
//|----------------------------------------------------------------------------------
//--------------------------  EDITAR SUPER USUARIO  ------------------------------
//|----------------------------------------------------------------------------------
//|----------------------------------------------------------------------------------
function editarSupUsr(id){
  // Realizar la llamada Ajax inicial para obtener los datos
  $.ajax({
    url: "funSupAdm/queryedit.php",
    type: "GET",
    data: { id: id },
    dataType: "json",    
    success: function (response) {
      if (!response.success) {
        Swal.fire("Error", response.message, "error");
        return;
      }
      
      const data = response.data;

      // Rellenar el formulario con los datos recuperados
      $("#edit-id").val(id);
      $("#edit-nombre").val(data.nombre);
      $("#edit-apellido").val(data.apellido);
      $("#edit-email").val(data.email);


        // Asociar el evento 'shown.bs.modal' antes de mostrar el modal
        $('#editarModalSuperUSER').on('shown.bs.modal', function () {
          var backdropZIndex = parseInt($('.modal-backdrop').last().css('z-index'));
          $(this).css('z-index', backdropZIndex + 1);
        });
         
      // Mostrar el modal
      $("#editarModalSuperUSER").modal("show");
      
      // Asegurarse de que el nuevo modal aparezca encima del anterior
  
    }
  });



  // Manejar el envío del formulario dentro del modal
  $("#editar-submit").on("click", function() {
    const form = document.getElementById("editar-form-super");
    const formData = new FormData(form);
    $.ajax({
      url: "funSupAdm/EditSupUser.php",
      type: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.success) {
          $("#editarModalSuperUSER").modal("hide");
          Swal.fire("¡Éxito!", "El elemento ha sido actualizado correctamente.", "success");
          superAdmin();
        } else {
          Swal.fire("Error", response.message, "error");
        }
      }
    });
  });
}









//|----------------------------------------------------------------------------------
//|----------------------------------------------------------------------------------
//---------------------------------  INSERTAR DATOS SUPER USUARIO -------------------
//|----------------------------------------------------------------------------------
//|----------------------------------------------------------------------------------



const myForSuperUser = document.getElementById("myFormUS");

myForSuperUser.addEventListener('submit', async (event) => {
  event.preventDefault();

  const formData = new FormData(myForSuperUser);

  try {
    const response = await fetch("funSupAdm/insertSuperUser.php", {
      method: "POST",
      body: formData
    });

    const data = await response.json();

    if (data.success) {
      // Success logic (close modal, reload table)
      Swal.fire({
        title: "buen trabajo!",
        text: "haz hecho click en boton!",
        icon: "success"
      });
      superAdmin();
    } else {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: data.message || "Something went wrong!"
      });
    }
  } catch (error) {
    console.error("Error:", error);
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "An error occurred. Please try again later."
    });
  }
});