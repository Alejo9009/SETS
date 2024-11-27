<?php
include_once "conexion.php";

if (isset($_POST['accion']) && isset($_POST['id_parking'])) {

    $id_solicitud = $_POST['id_parking'];
    $accion = $_POST['accion'];
    
    if ($accion == 'aceptar') {
        $sql = "UPDATE solicitud_parqueadero SET estadoos = 1 WHERE id_parking = ?"; // Cambia 'ID_Apartament' según tu estructura
    } elseif ($accion == 'pendiente') {
        $sql = "UPDATE solicitud_parqueadero SET estadoos = 2 WHERE id_parking = ?"; // Cambia 'ID_Apartament' según tu estructura
    } elseif ($accion == 'eliminar') {
        $sql = "DELETE FROM solicitud_parqueadero WHERE id_parking = ?"; // Cambia 'ID_Apartament' según tu estructura
    }
    
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute([$id_solicitud]);

    if ($stmt->execute()) {
        header("Location: horariocarro.php?mensaje=exito");
    } else {
        header("Location: horariocarro.php?mensaje=error");
    }
    exit();
}
?>
