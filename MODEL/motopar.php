
<?php
function registrarSolicitudParqueadero($db, $datos)
{
    $query = "INSERT INTO solicitud_parqueadero 
                (id_apartamento, parqueadero_visitante, nombre_visitante, placaVehiculo, colorVehiculo, 
                tipoVehiculo, modelo, marca, fecha_inicio, fecha_final, estado) 
              VALUES 
                (:id_apartamento, :parqueadero_visitante, :nombre_visitante, :placaVehiculo, :colorVehiculo, 
                :tipoVehiculo, :modelo, :marca, :fecha_inicio, :fecha_final, 'pendiente')";

    $statement = $db->prepare($query);

    $statement->bindParam(':id_apartamento', $datos['id_apartamento']);
    $statement->bindParam(':parqueadero_visitante', $datos['parqueadero_visitante']);
    $statement->bindParam(':nombre_visitante', $datos['nombre_visitante']);
    $statement->bindParam(':placaVehiculo', $datos['placaVehiculo']);
    $statement->bindParam(':colorVehiculo', $datos['colorVehiculo']);
    $statement->bindParam(':tipoVehiculo', $datos['tipoVehiculo']);
    $statement->bindParam(':modelo', $datos['modelo']);
    $statement->bindParam(':marca', $datos['marca']);
    $statement->bindParam(':fecha_inicio', $datos['fecha_inicio']);
    $statement->bindParam(':fecha_final', $datos['fecha_final']);

    return $statement->execute();
}
?>