<?php

date_default_timezone_set('America/Mexico_City');

$star_date = date('Y-m-d', strtotime('next day'));
$end_date = date('Y-m-d', strtotime('saturday next week'));

?>

<html>

<head>
    <title>Crear cita</title>
    <link rel="stylesheet" href="admin/style/citas.css">

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="admin/javascript/jquery.js" type="text/javascript"></script>


</head>

<body class="fondo" data-bs-theme="dark">

    <?php include('admin/funciones/menu_clientes.php'); ?>


    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>Registro de citas</h1>
            </div>
            <div class="card-body">
                <form class="form-control p-2"  method="post" id="createDate">

                    <div class="input-group mt-3">
                        <span class="input-group-text" name="date">Fecha</span>
                        <input type="date" id="date" class="form-control" placeholder="Seleccione una fecha" min="<?= $star_date ?>" max="<?= $end_date ?>" required>
                    </div>

                    <div class="input-group mt-3">
                        <span class="input-group-text" name="time">Hora</span>
                        <select id="timeSelect" class="form-control" disabled required></select>
                    </div>

                    <div class="input-group mt-3">
                        <span class="input-group-text" name="time">Placas</span>
                        <input type="text" id="plate" class="form-control" placeholder="Ingrese las placas" minlength="5" maxlength="10" required disabled>
                    </div>

                    <hr>

                    <div class="container-fluid d-flex justify-content-end mb-2">
                        <button type="submit" class="btn btn-success" id="buttom-submit" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-calendar2-check" viewBox="0 0 16 16">
                                <path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5z" />
                            </svg>
                            <span class="d-none d-xl-inline">&nbsp;Crear cita</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="admin/javascript/citas.js" type="text/javascript"></script>

</body>

</html>