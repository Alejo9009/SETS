<?php
include_once "conexion.php";

if (isset($_POST['accion']) && isset($_POST['id_solicitud'])) {

    $id_solicitud = $_POST['id_solicitud'];
    $accion = $_POST['accion'];
    $sql = ""; 

    if ($accion == 'aprobado') {
        $sql = "UPDATE solicitud_parqueadero SET estado = 'aprobado' WHERE id_solicitud  = ?"; 
    } elseif ($accion == 'pendiente') {
        $sql = "UPDATE solicitud_parqueadero SET estado = 'pendiente' WHERE id_solicitud  = ?"; 
    } elseif ($accion == 'rechazado') {
        $sql = "DELETE FROM solicitud_parqueadero WHERE id_solicitud  = ?"; 
    }


    if (!empty($sql)) {
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([$id_solicitud]);

       
        header("Location: ../horariocarro.php?mensaje=exito");
    } else {
        header("Location: ../horariocarro.php?mensaje=error");
    }
    exit();
}
?>
