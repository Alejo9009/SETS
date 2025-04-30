
<?php
include_once './conexion.php';
include_once '../MODEL/zona.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $camposRequeridos = [
        'ID_Apartamentooss', 'ID_zonaComun', 'fechainicio',
        'fechafinal', 'Hora_inicio', 'Hora_final'
    ];

    foreach ($camposRequeridos as $campo) {
        if (!isset($_POST[$campo])) {
            die(json_encode([
                'status' => 'error',
                'message' => "Falta el campo: $campo"
            ]));
        }
    }


    $datos = [
        'ID_Apartamentooss' => $_POST['ID_Apartamentooss'],
        'ID_zonaComun' => $_POST['ID_zonaComun'],
        'fechainicio' => $_POST['fechainicio'],
        'fechafinal' => $_POST['fechafinal'],
        'Hora_inicio' => $_POST['Hora_inicio'],
        'Hora_final' => $_POST['Hora_final']
    ];


    if (registrarSolicitudZonaComun($base_de_datos, $datos)) {
        echo "<script>
                alert('Solicitud exitosa.');
                window.location.href = '../VIEW/residente/zonas_comunes.php?status=success';
              </script>";
    } else {
        $errorInfo = $base_de_datos->errorInfo();
        echo "<script>
                alert('Error al agregar: {$errorInfo[2]}');
                window.history.back();
              </script>";
    }
} else {
    header("Location: ../VIEW/residente/zonas_comunes.php");
    exit();
}
?>