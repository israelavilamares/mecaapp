function agregarClientes() {
  window.location.href = "agregar_clientes.php";
}


function registrar() {
    var nombre = $("#formulario input[name='nombre']").val();
    var apellido = $("#formulario input[name='apellidos']").val();
    var correo = $("#formulario input[name='correo']").val();
    var pass = $("#formulario input[name='pass']").val();
     
    if (nombre === '' || apellido === '' || correo === '' || pass === '') {
      $("#error-message").text("Faltan campos por llenar");
      setTimeout(function () {
        $("#error-message").empty();
      }, 5000);
      return;
    }
  
    var formData = new FormData(); 
    formData.append('nombre', nombre);
    formData.append('apellidos', apellido);
    formData.append('correo', correo);
    formData.append('pass', pass);
     
    $.ajax({
      data: formData, 
      processData: false, 
      contentType: false, 
      url: "admin/funciones/clientes_agregar.php",
      type: "post",
      success: function (response) {
        $("#success-message").text("Tu registro fue exitoso");
        $("#success-message").show();
        setTimeout(function () {
          $("#success-message").empty().hide();
        }, 5000);
      },
    });
  }


  function validarCorreo(elemento) {
    console.log("Validando");
  
    var correo = $(elemento).val();
    $.ajax({
      type: "POST",
      url: "admin/funciones/verificar_correoClientes.php",
      data: { correo: correo },
      success: function (response) {
        if (response === "existe") {
          $("#editar-boton").prop("disabled", true);
  
  
          $("#error-message-mail").text("El correo " + correo + " ya existe.");
          setTimeout(function () {
            $("#error-message-mail").empty();
          }, 5000);
        } else {
          $("#editar-boton").prop("disabled", false);
       
  
        }
      }
    });
  }


  function logearme_cliente() {
    var email = $('#email').val();
    var password = $('#password').val();
  
    if (email === "" || password === "") {
      $('#error-message').text("Por favor, llena todos los campos.");
      setTimeout(function () {
        $('#error-message').text("");
      }, 5000);
    } else {
      $.ajax({
        type: "POST",
        url: "admin/funciones/login_clientes.php",
        data: { email: email, password: password },
        success: function (response) {
          console.log(response);
          if (response == "TRUE") {
            window.location.href = "bienvenido_clientes.php";
          } else {
            $('#error-message').text("Credenciales incorrectas.");
            setTimeout(function () {
              $('#error-message').text("");
            }, 5000);
          }
        }
      });
    }
  }

const backHome = document.getElementById("regresarHome");
backHome.addEventListener("click",function(){
  window.location.href = "index.php";
});
