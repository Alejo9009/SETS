
<?php
function registrarSolicitudZonaComun($db, $datos)
{
    $sql = "INSERT INTO solicitud_zona 
            (ID_Apartamentooss, ID_zonaComun, fechainicio, fechafinal, Hora_inicio, Hora_final) 
            VALUES 
            (:ID_Apartamentooss, :ID_zonaComun, :fechainicio, :fechafinal, :Hora_inicio, :Hora_final)";

    $stmt = $db->prepare($sql);

    $stmt->bindParam(':ID_Apartamentooss', $datos['ID_Apartamentooss'], PDO::PARAM_STR);
    $stmt->bindParam(':ID_zonaComun', $datos['ID_zonaComun'], PDO::PARAM_INT);
    $stmt->bindParam(':fechainicio', $datos['fechainicio'], PDO::PARAM_STR);
    $stmt->bindParam(':fechafinal', $datos['fechafinal'], PDO::PARAM_STR);
    $stmt->bindParam(':Hora_inicio', $datos['Hora_inicio'], PDO::PARAM_STR);
    $stmt->bindParam(':Hora_final', $datos['Hora_final'], PDO::PARAM_STR);

    return $stmt->execute();
}
?>