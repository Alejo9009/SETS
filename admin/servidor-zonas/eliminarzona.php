<?php
if (!isset($_POST["idZona"])) {
    exit('ID de zona no proporcionado.');
}

$TipoZonaid = $_POST["idZona"];

include_once "conexion.php";

if (!$base_de_datos) {
    exit('Error en la conexión a la base de datos.');
}

try {
    $base_de_datos->beginTransaction();

    $sqlEliminarZonaComun = "DELETE FROM zona_comun WHERE idZona = ?";
    $sentenciaEliminarZonaComun = $base_de_datos->prepare($sqlEliminarZonaComun);
    $resultadoEliminarZonaComun = $sentenciaEliminarZonaComun->execute([$TipoZonaid]);

    if (!$resultadoEliminarZonaComun) {
        throw new Exception("Error al eliminar los registros en zona_comun.");
    }

    $base_de_datos->commit();

    echo '
    <script> 
        alert("La zona común ha sido eliminada correctamente.");
        window.location.href = "../zonas_comunes.php"; // Redirige a la página de zonas comunes
    </script>';

} catch (Exception $e) {

    $base_de_datos->rollBack();
    echo '
    <script> 
        alert("Error al eliminar la zona común: ' . $e->getMessage() . '");
        window.location.href = "../zonas_comunes.php"; // Redirige en caso de error
    </script>';
}

$base_de_datos = null; 
?>
