<?php
include_once "conexion.php";

if (isset($_POST['accion']) && isset($_POST['id_solicitud'])) {

    $id_solicitud = $_POST['id_solicitud'];
    $accion = $_POST['accion'];
    
    if ($accion == 'eliminar') {
        $sql = "DELETE FROM solicitud_zona WHERE ID_Apartamentooss = ?"; // Cambia 'ID_Apartament' según tu estructura
    } 
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute([$id_solicitud]);

    if ($stmt->execute()) {
        header("Location: solicitarbbq.php?mensaje=exito");
    } else {
        header("Location: solicitarbbq.php?mensaje=error");
    }
    exit();
}
?>
