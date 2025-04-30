
<?php
include_once './conexion.php';
include_once '../MODEL/futbol.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar' && isset($_POST['id_solicitud'])) {
        if (eliminarSolicitudZona($base_de_datos, $_POST['id_solicitud'])) {
            header("Location: ../VIEW/residente/solicitarfutbol.php?mensaje=eliminado_exito");
        } else {
            header("Location: ../VIEW/residente/solicitarfutbol.php?mensaje=eliminado_error");
        }
        exit();
    }
    

    if (isset($_POST['idSolicitud'])) {
        $datos = [
            'fechainicio' => $_POST['fechainicio'],
            'Hora_inicio' => $_POST['Hora_inicio'],
            'fechafinal' => $_POST['fechafinal'],
            'Hora_final' => $_POST['Hora_final'],
            'ID_Apartamentooss' => $_POST['idSolicitud']
        ];
        
        if (actualizarSolicitudZona($base_de_datos, $datos)) {
            header("Location: ../VIEW/residente/solicitarfutbol.php?mensaje=actualizado_exito");
        } else {
            header("Location: ../VIEW/residente/solicitarfutbol.php?mensaje=actualizado_error");
        }
        exit();
    }
}

header("Location: ../VIEW/residente/solicitarfutbol.php");
exit();
?>