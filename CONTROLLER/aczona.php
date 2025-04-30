<?php
include_once './conexion.php';
include_once '../MODEL/aczona.php';

if (isset($_POST['accion']) && isset($_POST['id_solicitud'])) {
    $id_solicitud = $_POST['id_solicitud'];
    $accion = $_POST['accion'];
    

    $zonas = [
        '1' => 'solicitarfutbol.php',
        '5' => 'solicitargym.php',
        '4' => 'solicitarvoley.php',
        '3' => 'solicitarsalon.php',
        '2' => 'solicitarbbq.php'
    ];
    

    $zona = isset($_POST['zona']) ? $_POST['zona'] : 'futbol';
    

    if (!array_key_exists($zona, $zonas)) {
        $zona = 'futbol'; 
    }
    
    $redireccion = '../VIEW/admin/' . $zonas[$zona];
    
    if (gestionarSolicitudZona($base_de_datos, $id_solicitud, $accion)) {
        header("Location: $redireccion?mensaje=exito&accion=$accion");
    } else {
        header("Location: $redireccion?mensaje=error&accion=$accion");
    }
    exit();
}


header("Location: ../VIEW/admin/zonas_comunes.php");
exit();
?>