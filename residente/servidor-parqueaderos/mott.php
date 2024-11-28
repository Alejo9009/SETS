<?php
include_once "conexion.php";  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si el ID de la solicitud está presente en el formulario
    if (isset($_POST['id_parking'])) {
        $idSolicitud = $_POST['id_parking'];
    } else {
        die("Error: 'id_parking' no está definido en el formulario.");
    }

    // Obtener los valores del formulario
    $id_Aparta = $_POST['id_Aparta'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $hora_inicio = $_POST['hora_inicio'];
    $fecha_final = $_POST['fecha_final'];
    $hora_final = $_POST['hora_final'];
    $numParqueadero = $_POST['numParqueadero'];
    $placaVehiculo = $_POST['placaVehiculo'];
    $colorVehiculo = $_POST['colorVehiculo'];
    $TipoVehiculo = $_POST['TipoVehiculo'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $descripcionvehiculo = $_POST['descripcionvehiculo'];

    // Preparar la consulta de actualización
    $query = "UPDATE solicitud_parqueadero 
              SET id_Aparta = :id_Aparta, fecha_inicio = :fecha_inicio, hora_inicio = :hora_inicio, fecha_final = :fecha_final, 
                  hora_final = :hora_final, numParqueadero = :numParqueadero, placaVehiculo = :placaVehiculo, 
                  colorVehiculo = :colorVehiculo, TipoVehiculo = :TipoVehiculo, modelo = :modelo, marca = :marca, 
                  descripcionvehiculo = :descripcionvehiculo 
              WHERE id_parking = :id_parking";

    $statement = $base_de_datos->prepare($query);

    // Vincular los parámetros
    $statement->bindParam(':id_Aparta', $id_Aparta);
    $statement->bindParam(':fecha_inicio', $fecha_inicio);
    $statement->bindParam(':hora_inicio', $hora_inicio);
    $statement->bindParam(':fecha_final', $fecha_final);
    $statement->bindParam(':hora_final', $hora_final);
    $statement->bindParam(':numParqueadero', $numParqueadero);
    $statement->bindParam(':placaVehiculo', $placaVehiculo);
    $statement->bindParam(':colorVehiculo', $colorVehiculo);
    $statement->bindParam(':TipoVehiculo', $TipoVehiculo);
    $statement->bindParam(':modelo', $modelo);
    $statement->bindParam(':marca', $marca);
    $statement->bindParam(':descripcionvehiculo', $descripcionvehiculo);
    $statement->bindParam(':id_parking', $idSolicitud);

    // Ejecutar la actualización
    if ($statement->execute()) {
        echo "Solicitud actualizada correctamente.";
        header("Location: ../hoariomoto.php");   // Redirigir a la página de solicitudes
        exit();
    } else {
        echo "Error al actualizar la solicitud.";
    }
}
?>
