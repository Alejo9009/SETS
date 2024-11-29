<?php
include_once "conexion.php";

if (isset($_POST['accion']) && isset($_POST['id_solicitud'])) {

    $id_solicitud = $_POST['id_solicitud'];
    $accion = $_POST['accion'];
    
    if ($accion == 'aceptar') {
        $sql = "UPDATE solicitud_zona SET estado = 1 WHERE ID_Apartamentooss = ?"; // Cambia 'ID_Apartament' según tu estructura
    } elseif ($accion == 'pendiente') {
        $sql = "UPDATE solicitud_zona SET estado = 2 WHERE ID_Apartamentooss = ?"; // Cambia 'ID_Apartament' según tu estructura
    } elseif ($accion == 'eliminar') {
        $sql = "DELETE FROM solicitud_zona WHERE ID_Apartamentooss = ?"; // Cambia 'ID_Apartament' según tu estructura
    }
    
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute([$id_solicitud]);

    if ($stmt->execute()) {
        header("Location: solicitarfutbol.php?mensaje=exito");
    } else {
        header("Location: solicitarfutbol.php?mensaje=error");
    }
    exit();
}
?>
