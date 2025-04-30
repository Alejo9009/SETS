
<?php
function eliminarSolicitudZona($db, $id_solicitud)
{
    $sql = "DELETE FROM solicitud_zona WHERE ID_Apartamentooss = ?";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$id_solicitud]);
}

function actualizarSolicitudZona($db, $datos)
{
    $query = "UPDATE solicitud_zona SET 
                fechainicio = :fechainicio, 
                Hora_inicio = :Hora_inicio, 
                fechafinal = :fechafinal, 
                Hora_final = :Hora_final 
              WHERE ID_Apartamentooss = :ID_Apartamentooss";

    $statement = $db->prepare($query);
    return $statement->execute($datos);
}
?>