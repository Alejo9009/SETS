
<?php
function crearPago($db, $datos)
{
    $sql = "INSERT INTO pagos (pagoPor, cantidad, mediopago, apart, fechaPago, referenciaPago, estado) 
            VALUES (:pagoPor, :cantidad, :mediopago, :apart, :fechaPago, :referenciaPago, :estado)";

    $stmt = $db->prepare($sql);
    return $stmt->execute($datos);
}

function actualizarEstadoPago($db, $idPagos, $nuevoEstado)
{
    $sql = "UPDATE pagos SET estado = :nuevoEstado WHERE idPagos = :idPagos";
    $stmt = $db->prepare($sql);
    return $stmt->execute([':nuevoEstado' => $nuevoEstado, ':idPagos' => $idPagos]);
}

function verificarPermisosAdmin($idRol)
{
    return $idRol == 1111;
}
?>