<?php
if (!isset($_POST["TipoZonaid"])) {
    exit('ID de zona no proporcionado.');
}

$TipoZonaid = $_POST["TipoZonaid"];

include_once "conexion.php";

// Verifica si la conexión a la base de datos se estableció correctamente
if (!$base_de_datos) {
    exit('Error en la conexión a la base de datos.');
}

try {
    $base_de_datos->beginTransaction();

    // Eliminar registros en `solicitud_zona` que referencian `zona_comun`
    $sqlEliminarSolicitudes = "DELETE FROM solicitud_zona WHERE ID_zonaComun IN (SELECT idZona FROM zona_comun WHERE idTipoZona = ?)";
    $sentenciaEliminarSolicitudes = $base_de_datos->prepare($sqlEliminarSolicitudes);
    $resultadoEliminarSolicitudes = $sentenciaEliminarSolicitudes->execute([$TipoZonaid]);

    if (!$resultadoEliminarSolicitudes) {
        throw new Exception("Error al eliminar los registros en solicitud_zona.");
    }

    // Eliminar registros en `zona_comun` que referencian `tipozona`
    $sqlEliminarZonaComun = "DELETE FROM zona_comun WHERE idTipoZona = ?";
    $sentenciaEliminarZonaComun = $base_de_datos->prepare($sqlEliminarZonaComun);
    $resultadoEliminarZonaComun = $sentenciaEliminarZonaComun->execute([$TipoZonaid]);

    if (!$resultadoEliminarZonaComun) {
        throw new Exception("Error al eliminar los registros en zona_comun.");
    }

    // Finalmente, eliminar el registro en `tipozona`
    $sqlEliminarTipoZona = "DELETE FROM tipozona WHERE TipoZonaid = ?";
    $sentenciaEliminarTipoZona = $base_de_datos->prepare($sqlEliminarTipoZona);
    $resultadoEliminarTipoZona = $sentenciaEliminarTipoZona->execute([$TipoZonaid]);

    if (!$resultadoEliminarTipoZona) {
        throw new Exception("Error al eliminar el registro de tipozona.");
    }

    // Confirmar la transacción
    $base_de_datos->commit();

    echo '
    <script> 
        alert("La zona común ha sido eliminada correctamente.");
        window.location.href = "zonas_comunes.php"; // Redirige a la página de zonas comunes
    </script>';

} catch (Exception $e) {

    $base_de_datos->rollBack();
    echo '
    <script> 
        alert("Error al eliminar la zona común: ' . $e->getMessage() . '");
        window.location.href = "zonas_comunes.php"; // Redirige en caso de error
    </script>';
}

$base_de_datos = null; // Cierra la conexión a la base de datos
?>
