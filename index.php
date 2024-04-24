<!DOCTYPE html>
<html>

<head>
    <title>Mecapp</title>
    <link rel="stylesheet" href="admin/style/newstyle.css">
    <link rel="icon" href="admin/descargas/logo.jpeg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- CSS de Bootstrap -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript de Bootstrap (requiere jQuery y Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body class="all">
    <d
    iv class="maincontainer">

   
        <div class="navbar0">
            <a href="#inicio">Inicio</a>
            <a href="#acerca">Acerca de Nosotros</a>
            <a href="#servicios">Servicios</a>
            <img src="admin/descargas/logo.jpeg" height="40px" width="40px"  alt="logo">
            <div class="subnav">
            <a href="#">
                <img src="" alt="">Usuarios
            </a>
            <div class="subnav-content">
                <a href="login_clientes.php">Inicio Sesion</a>
                <a href="agregar_clientes.php">Registro</a>
            </div>
        </div>

        </div>



        <!--  <div class="conteinersecond">-->
        <div class="container-carousel">
        
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="admin/descargas/1images.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="admin/descargas/2images.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="admin/descargas/3images.jpg" alt="Third slide">
                </div>
                
                <div class="carousel-item">
                    <img class="d-block w-100" src="admin/descargas/4imagen.jpg" alt="four slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>

        </div>



        <br>
        <hr>
        <div id="inicio" class="inicio-box-big">
            <div class="text-box">
                <a class="cssh3" href="login_clientes.php"><h3 style="text-decoration: none;">!Agenda una cita con Nosotros!</h3></a>
            </div>
        </div>
        <!-- sub menu -->
            <div class="acerca-box-big" id="acerca">
            
                    <div class="text-box">
                    <h3>Acerca</h3>
                        <p style="font-size:1.3em;">
                            Nos enorgullece ofrecer 
                            servicios de alta calidad en reparación y mantenimiento automotriz.
                            Con una sólida reputación, nos esforzamos por ser el destino preferido de nuestros
                            clientes cuando se trata de mantener sus vehículos 
                            en óptimas condiciones de funcionamiento.
                        </p>
                            <br>
                            <hr>
                            <h4>Nuestra Misión</h4>
                            <p style="font-size:1.3em;">
                            Nuestra misión es proporcionar a nuestros clientes soluciones confiables y eficientes para todas sus necesidades de reparación y mantenimiento automotriz. Nos comprometemos a ofrecer un servicio excepcional, utilizando la última tecnología y técnicas innovadoras para garantizar la satisfacción del cliente en cada visita.
                            </p>
                            <br>
                            <hr>
                            <h4>Nuestros Valores</h4>
                            <br>
                            <p style="font-size:1.3em;">
                                <strong>1. Excelencia:</strong>
                                Nos esforzamos por alcanzar la excelencia en cada aspecto de nuestro trabajo. Desde la calidad de nuestros servicios hasta la atención al cliente, buscamos superar las expectativas en todo momento.

                            <br>
                            <strong>2. Compromiso con el Cliente:</strong>
                                Nuestros clientes son nuestra prioridad número uno. Nos comprometemos a escuchar sus necesidades, ofrecer soluciones efectivas y brindar un servicio excepcional en cada encuentro.
                            <br>
                            <strong>3.Responsabilidad Social y Ambiental:</strong>
                                Nos preocupamos por nuestro impacto en la comunidad y el medio ambiente. Nos comprometemos a operar de manera responsable, minimizando nuestro impacto ambiental y contribuyendo positivamente al bienestar de nuestra comunidad.
                               </p>

                    </div>

            </div>
        <br>
        <div id="servicios" class="Servicios-box-big">
            <div class="text-box">
                <h3>Servicios</h3>
                <p  style="font-size:1.3em;"><strong>Mantenimiento Preventivo:</strong>
                Mantén tu vehículo en óptimas condiciones con nuestros servicios de mantenimiento preventivo. 
                Realizamos inspecciones exhaustivas y seguimos los programas de mantenimiento recomendados por los fabricantes para garantizar el rendimiento y la seguridad de tu vehículo.
                <ul>
                    <li>Cambio de aceite y filtro.</li>
                    <li>Alineación y balanceo de ruedas.</li>
                    <li>Inspección de frenos.</li>
                    <li> Cambio de bujías y cables de encendido.</li>
                    <li>Inspección de sistemas de dirección y suspensión.</li>
                </ul>
                </p>
                <br>
                <p>
                <strong>Reparaciones Mecánicas:</strong>
                    Nuestro equipo de técnicos altamente capacitados está preparado para solucionar una amplia gama de problemas mecánicos en tu vehículo. Utilizamos equipos de diagnóstico avanzados y piezas de repuesto de calidad para garantizar reparaciones duraderas y confiables.
                    <ul>
                    <li>Reparación de sistemas de frenos.</li>
                    <li>Reparación de sistemas de transmisión.</li>
                    <li>Reparación de sistemas de dirección y suspensión.</li>
                    <li>Reparación de sistemas de escape.</li>
                    <li>Reparacion de motor.</li>
                    </ul>
                </p>

            </div>
        </div>
        <p></p>
        <br>
    </div>
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
            <h4>Ubicación</h4>
            <p>Paulino Navarro 1345, Los Maestros, 45150 Zapopan, Jal.</p>
        </div>
    </div>
    <h2 class="titulo-final">&copy; pluton | IngSoftware</h2>

</footer>
</html>
