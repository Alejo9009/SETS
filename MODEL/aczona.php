
<?php
function gestionarSolicitudZona($db, $id_solicitud, $accion)
{
    if ($accion == 'aceptar') {
        $sql = "UPDATE solicitud_zona SET estado = 1 WHERE ID_Apartamentooss = ?";
    } elseif ($accion == 'pendiente') {
        $sql = "UPDATE solicitud_zona SET estado = 2 WHERE ID_Apartamentooss = ?";
    } elseif ($accion == 'eliminar') {
        $sql = "DELETE FROM solicitud_zona WHERE ID_Apartamentooss = ?";
    } else {
        return false;
    }

    $stmt = $db->prepare($sql);
    return $stmt->execute([$id_solicitud]);
}
?>