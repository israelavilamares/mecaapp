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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>super usuario</title>
    <!-- Agrega el ícono de la página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   
    <link rel="icon" href="descargas/logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="style/interSupAdm.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Enlace a modal de editar CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 
    <!-- Enlace a DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- Enlace a DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    </head>
    
    <body>

        <div class="linea">
            <h2 class="Cinta-nombre">Bienvenido <?php echo $_SESSION['nombre'],' ',  $_SESSION["APELLIDO"];?></h2>
            <form action="logout.php">
                <input class="bto-cerrar"  type="submit" value="cerrar sesion">
            </form>
            <button id="btn-super-admin" onclick="superAdmin()" class="btn-super-adm" data-bs-toggle="modal" data-bs-target="#mi-modal-super-usuario"><img src="descargas/superAdm.png" alt="">super Admin</button>
            <p><a class="lik-back" href="AdminPage.php">volver</a></p>
        </div>
        
                <!-- **************************** FORMULARIO PARA AGREGAR ADMINISTRADORES  *********************************************** -->

                <button class="btn-AgregarAdmin" onclick="btonAgregarOcultarFor()">Agregar<img src="descargas/adduser.ico" alt=""></button>

            <!-- **************** Aqui termmina el boton para aque aprasca el formulario------->


            <!-- ************************************** AQUI TERMINA MODAL USERS ********************************** -->




            <div class="form-Registro" id="AdminForRegister">
            <h3>Registrar</h3>
            <hr>
            <form id="insertForm" >
            <input class="box-text" type="text"  name="nombre" id="nombre" placeholder="Ingresa tu nombre" required>
            <input class="box-text" type ="text" name="apellido" id="apellido" placeholder="Ingresa tu apellido" required>
            <input class="box-text" type ="email" name="email" id="email" placeholder="Ingresa tu correo" required>
            <input class="box-text" type ="password" name="password" id="password" placeholder="Ingresa tu contraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}$" required>
            <small>Debe contener al menos 8 caracteres, incluyendo al menos una letra mayúscula, una letra minúscula, un número y un carácter especial (@ $ ! % * ? &)</small>
            <button class="Boton-regrister" type="submit">Agregar</button>
            </form>
            </div>

            <div id="resultado"></div>

            <!------------------- aqui el modal de editar------------------------->
            <!-- Modal para editar usuario -->

            <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Administrador</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="editForm">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico">
                </div>
            

                <input type="hidden" id="id" name="id"> <!-- Campo oculto para almacenar el ID del usuario -->
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" form="editForm" class="btn btn-primary">Guardar Cambios</button>
            </div>
            </div>
            </div>
            </div>

         
                <!-- el otro modal de super usuarios  -->
                
            <div class="modal fade" id="mi-modal-super-usuario" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="myModalLabel">Super usuarios</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    
                    <hr>
                <h6 style="font-size:20px;">Agregar Super Usuarios</h6>
                    <br>
                    
                    <form id="myFormUS">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Ingresa tu apellido:</label>
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese tu apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Ingresa tu Correo Electronico:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Ingresa tu Contraseña:</label>
                            <input type="password" class="form-control" name="pass" id="pass"  placeholder="Ingresa tu Contraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}$" required>
                            <small>Debe contener al menos 8 caracteres, incluyendo al menos una letra mayúscula, una letra minúscula, un número y un carácter especial (@ $ ! % * ? &)</small>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <button type="reset" class="btn btn-secondary">Limpiar</button>

                    </form>
                    <!-- ------------------    TERMINA EL formulario    -------------------- -->
                    <br>
                    <hr>
                    <h6 style="font-size:20px;">Mostrar Super Usuarios</h6>

                    <table class="table table-striped table-bordered mx-auto">
                        <thead>
                            <tr>
                                <th>nombre </th>
                                <th>apellido</th>
                                <th>email</th>
                                <th>accion</th>
                            </tr>
                        </thead>
                        
                        <tbody id=contenidoTable>
                            
                        </tbody>
                    </table>



                       <!-- MODAL PARA EDITAR SUPER USUARIOS  -->


                            <!-- Modal -->
                <div class="modal fade" id="editarModalSuperUSER" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalLabel">Editar Super Usuarios</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editar-form-super">
                        <input type="hidden" name="id" id="edit-id">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="edit-nombre" class="form-control">
                        
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" id="edit-apellido" class="form-control">
                        
                        <label for="email">Email</label>
                        <input type="text" name="email" id="edit-email" class="form-control">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="editar-submit">Guardar cambios</button>
                    </div>
                    </div>
                </div>
                </div>




            <!-- MODAL PARA FIN DEL EDITAR SUPER USUARIOS  -->



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
            </div>




        <script src="javascript/superAdmin.js"></script>
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