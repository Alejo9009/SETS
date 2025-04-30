
<?php
include_once './conexion.php';
include_once '../MODEL/motopar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $camposRequeridos = [
        'id_apartamento', 'parqueadero_visitante', 'nombre_visitante', 
        'placaVehiculo', 'colorVehiculo', 'tipoVehiculo',
        'modelo', 'marca', 'fecha_inicio', 'fecha_final'
    ];

    foreach ($camposRequeridos as $campo) {
        if (!isset($_POST[$campo])) {
            die("Error: Falta el campo $campo");
        }
    }


    $datos = [
        'id_apartamento' => $_POST['id_apartamento'],
        'parqueadero_visitante' => $_POST['parqueadero_visitante'],
        'nombre_visitante' => $_POST['nombre_visitante'],
        'placaVehiculo' => $_POST['placaVehiculo'],
        'colorVehiculo' => $_POST['colorVehiculo'],
        'tipoVehiculo' => $_POST['tipoVehiculo'],
        'modelo' => $_POST['modelo'],
        'marca' => $_POST['marca'],
        'fecha_inicio' => $_POST['fecha_inicio'],
        'fecha_final' => $_POST['fecha_final']
    ];


    if (registrarSolicitudParqueadero($base_de_datos, $datos)) {
        header("Location: ../VIEW/residente/moto.php?success=1");
        exit();
    } else {
        header("Location: ../VIEW/residente/moto.php?error=1");
        exit();
    }
} else {
    header("Location: ../VIEW/residente/moto.php");
    exit();
}
?>