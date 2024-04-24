//------------------------------------------------------------------
//                       MOSTRAR INVENTARIO
//------------------------------------------------------------------

let cont;
$(document).ready(function(){
    $.ajax({
      url: "FuncionesAdmin/consultainventAll.php",
      type: "GET",
      dataType: "json",
      success: function(data)
      {
        //procesar el json
        const cuerpoTabla = $('#tablainv');
        let html = "";
        for(var i=0; i<data.length; i++)
          {   
              cont = i+1;
              html += '<tr class="fila-table-inv">';
              html += '<td>'+ cont +'</td>';
              html += '<td>'+data[i].id+'</td>';
              html += '<td>'+data[i].nombre+'</td>';
              html += '<td>'+data[i].cantidad+'</td>';
              html += '<td>'+data[i].descripcion+'</td>';
              html += '<td>'+data[i].costo+'</td>';
              html += '<td>'+data[i].fecha_entrada+'</td>';
              html += '<td>'+data[i].proveedor+'</td>';
              html += '<td>';
              html += '<button class="btn-edit-inv" onclick="EditarItem(\'' + data[i].id + '\')"><img src="descargas/edit-validated.png" alt="">Editar</button>';
              html += '<button class="btn-eliminar" onclick="eliminaritem(\'' + data[i].id + '\')"><img src="descargas/basura.png" alt="">Eliminar</button>'; //lo hice string para que no entrara en conflitos con los caracters especiales
              html += '</td>';
              html += '</tr>';
            }
        
          cuerpoTabla.html(html);
      },
      //error-----------------------------------------
      error: function(jqXHR,textStatus,errorThrown){
        console.error("ERROR:", textStatus,errorThrown);
      }
      //-----------------------------------------------
    });
    
  });
  
//------------------------------------------------------------------
//                              EDITAR PRODUCTO O ITEM
//-----------------------------------------------------------------

function EditarItem(id) {
  // 1. Make the initial Ajax call to fetch data
  $.ajax({
    url: "FuncionesAdmin/consultaitem.php",
    type: "GET",
    data: { id: id},// Send the id to the server
    dataType: "json",    
    success: function (response) {
      if (!response.success) {
        Swal.fire("Error", response.message, "error");
        return; // Exit if there's an error
      }
      // 2. Populate the form with the retrieved data
      const data = response.data; // Assuming response has a "data" property
      // 3. Open the Swal modal with prepopulated data
      Swal.fire({
        title: "Editar Articulo",
        html: `
        <hr>
        <br>
          <form id="editar-form" class="my-custom-form">
            <input type="hidden" name="id" value="${id}">
            
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value ="${data.nombre}" required>
            
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="${data.cantidad}" required>
            
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">${data.descripcion}</textarea>
            
            <label for="costo">Costo</label>
            <input type="number" name="costo" id="Costo" value="${data.costo}" class="form-control">

            <label for="Fecha_Ent">Fecha de entrada</label>
            <input type="date" name="Fecha_Ent" id="Fecha_Ent" value="${data.fecha_entrada}" class="form-control">

            <label for="Proveedor">Proveedor</label>
            <input type="text" name="proveedor" id="proveedor" value="${data.proveedor}" class="form-control">            
          </form>
        `,
        showCancelButton: true,
        preConfirm: () => {
          return new Promise((resolve) => {
            const form = document.getElementById("editar-form");
            const formData = new FormData(form);
            // Enviar datos al servidor (same as before)
            $.ajax({
              url: "FuncionesAdmin/editaritem.php",
              type: "POST",
              data: formData,
              dataType: "JSON",
              processData: false, 
              contentType: false,
              success: function (response) {
                if (response.success) {
                  resolve();
                  Swal.fire("¡Éxito!", "El elemento ha sido actualizado correctamente.", "success");
                  setTimeout(function(){
                    location.reload(); // Recargar la página después de 3 segundos
                  }, 2000);
                  // Recargar la página o actualizar la tabla
                } else {
                  Swal.fire("Error", response.message, "error");
                }
              },
            });
          });
        },

        customClass: {
          container: "my-custom-modal", // Clase CSS para el contenedor principal
          confirmButton: "btn btn-primary", // Clase CSS para el botón de confirmación
          cancelButton: "btn btn-secondary", // Clase CSS para el botón de cancelación
          
          //width: "500px",
      },

      });
    },
  });
}


//------------------------------------------------------------------
//                              ELIMINAR
//------------------------------------------------------------------

function eliminaritem(id)
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
        url: 'FuncionesAdmin/deleteitem.php',
        type: 'POST',
        data:{id:id},
        dataType: "JSON",
        success: function(response) {
          if (response.success) {
            Swal.fire(
              'Eliminado!',
              'El usuario ha sido eliminado con éxito.',
              'success'
            );
            setTimeout(function(){
              location.reload(); // Recargar la página después de 3 segundos
            }, 1000);

          }else
          {
            Swal.fire(
              'Error!',
              'Ha ocurrido un error al eliminar el usuario.',
              'error'
            );
          }
        }
      });

    }

  });
}

//------------------------------------------------------------------
//                      MODAL DE FORMULARIO
//------------------------------------------------------------------

var modal = document.getElementById("miModal");
var btnAbrirModal = document.getElementById("agregar");
var btncerrarModal = document.getElementById("btnCerrarModal");

btnAbrirModal.addEventListener("click",function()
  {

    modal.style.display = "block";

  });


btncerrarModal.addEventListener("click",function(){
modal.style.display = "none";
});

window.addEventListener("click",function()
{
    if (event.target == modal) {
        modal.style.display = 'none';
      }   
});

//------------------------------------------------------------------
//                      AGREGAR FORMULARIO
//------------------------------------------------------------------
const form  = document.getElementById('form-invent');
form.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent default form submission

  const nombre = $('#nombre').val();
  const cantidad =$("#cantidad").val();
  const descripcion = $("#descripcion").val();
  const costo = $("#costo").val();
  const fecha_entrada = $("#fecha_entrada").val();
  const proveedor = $("#proveedor").val();
  

  $.ajax({
    type: 'POST',
    url: "FuncionesAdmin/insertInvet.php", // Replace with your script path
    data: {nombre: nombre,cantidad: cantidad, descripcion: descripcion, costo:costo, fecha_entrada:fecha_entrada, proveedor:proveedor},
    //dataType: 'json',
      success: function(data) {
      Swal.fire({
        title: "Good job!",
        text: "You clicked the button!",
        time: 2000,
        icon: "success"
        });
        setTimeout(function(){
          location.reload(); // Recargar la página después de 3 segundos
        }, 3000);
        // Mostrar mensaje de éxito
        // Opcional: recargar la página o redireccionar a otra página
    },
    error: function(xhr, status, error) {
      console.error('Error en la petición AJAX:', xhr.responseText);
    }
  });
});

/*
$(document).ready(function()
{
  $('#sendInfo').click(function(event)
  {
    //evitar que se recarge
    event.preventDefault();
    //option 1
    //obtiene todo los campos name del formulario
    //var formData = $(this).serialize();
    //var formData = new FormData(this);
    //option 2
    var nombre = $("#nombre").val();
    var cantidad =$("#cantidad").val();
    var descripcion = $("#descripcion").val();
    var costo = $("#costo").val();
    var fecha_entrada = $("#fecha_entrada").val();
    var proveedor = $("#proveedor").val();

/*
   var Data = {
      nombre: nombre,
      cantidad: cantidad,
      descripcion: descripcion,
      costo:costo,
      fecha_entrada:fecha_entrada,
      proveedor:proveedor 
    };
   
    $.ajax({
      type: "POST",
      url: "admin/FuncionesAdmin/insertInvet.php",
      data: {nombre: nombre,cantidad: cantidad, descripcion: descripcion, costo:costo, fecha_entrada:fecha_entrada, proveedor:proveedor}, 
      dataType: "json",
      success: function(response)
      {
        console.log(response)
        alert("agregado");
        //mensaje de confirmacion
       // $('#insertForm')[0].reset(); // Limpiar el formulario
        //tambieen que recarge la pagina
       // location.reload();
      },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error:", textStatus, errorThrown);
          // Handle errors
        }
    });
  });
});
*/



//------------------------------------------------------------------
//                              BARRA DE BUSQUEDA
//------------------------------------------------------------------

const searchInput = document.getElementById('searchInput');
const tableBody = document.getElementById('tablainv');
//hacer la consulta
async function getData() {
  const response = await fetch('FuncionesAdmin/consultinven.php');
  const data = await response.json();
  return data;
}

// Función para actualizar la tabla
function updateTableData(data) {
  let count = 0;
  // aqui puedo tener un problema que me borre la tabla 
  tableBody.innerHTML = ''; // Limpiar el cuerpo de la tabla antes de actualizarla
  data.forEach(item => {
    const tableRow = document.createElement('tr');
    tableRow.classList.add("fila-table-inv");
    tableRow.innerHTML = `
      <td>${count+=1}</td>
      <td>${item.id}</td>
      <td>${item.nombre}</td>
      <td>${item.cantidad}</td>
      <td>${item.descripcion}</td>
      <td>${item.costo}</td>
      <td>${item.fecha_entrada}</td>
      <td>${item.proveedor}</td>
      <td><button class="btn-edit-inv" onclick="EditarItem('${item.id}')"><img src="descargas/edit-validated.png" alt="">Editar</button>
      <button class="btn-eliminar" onclick="eliminaritem( '${item.id}' )"><img src="descargas/basura.png" alt="">Eliminar</button></td>
      `;
    tableBody.appendChild(tableRow);
  });
}


// Función para filtrar la información
function filterData(data, searchTerm) {
  return data.filter(item => {
    const Codigo = item.id.toLowerCase();
    const Nombre = item.nombre.toLowerCase();
    const Descripción = item.descripcion.toLowerCase();
    const Proveedor = item.proveedor.toLowerCase();
    return Nombre.includes(searchTerm) || Codigo.includes(searchTerm) || Descripción.includes(searchTerm) ||  Proveedor.includes(searchTerm); 
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












