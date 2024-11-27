<?php
include_once "conexion.php";  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id_parking'])) {
        $idSolicitud = $_POST['id_parking'];
    } else {
        die("Error: 'id_parking' no está definido en el formulario.");
    }
    $fechaInicio = $_POST['fecha_inicio'];
    $horaInicio = $_POST['hora_inicio'];
    $fechaFinal = $_POST['fecha_final'];
    $horaFinal = $_POST['hora_final'];
    $numParqueadero = $_POST['numParqueadero'];
    $placaVehiculo = $_POST['placaVehiculo'];
    $colorVehiculo = $_POST['colorVehiculo'];
    $tipoVehiculo = $_POST['TipoVehiculo'];
    $disponibilidad = $_POST['disponibilidad'];
    $nombreDueno = $_POST['nombre_dueño'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $descripcionVehiculo = $_POST['descripcionvehiculo'];
    $estadoos = $_POST['estadoos'];

    $query = "UPDATE solicitud_parqueadero SET   fecha_inicio = :fecha_inicio,  hora_inicio = :hora_inicio,  fecha_final = :fecha_final, hora_final = :hora_final,
             numParqueadero = :numParqueadero, placaVehiculo = :placaVehiculo, colorVehiculo = :colorVehiculo, TipoVehiculo = :TipoVehiculo, disponibilidad = :disponibilidad,
             nombre_dueño = :nombre_dueño, modelo = :modelo,  marca = :marca,  descripcionvehiculo = :descripcionvehiculo, estadoos = :estadoos WHERE id_parking = :id_parking";
    
    $statement = $base_de_datos->prepare($query);
    
    $statement->bindParam(':fecha_inicio', $fechaInicio);
    $statement->bindParam(':hora_inicio', $horaInicio);
    $statement->bindParam(':fecha_final', $fechaFinal);
    $statement->bindParam(':hora_final', $horaFinal);
    $statement->bindParam(':numParqueadero', $numParqueadero);
    $statement->bindParam(':placaVehiculo', $placaVehiculo);
    $statement->bindParam(':colorVehiculo', $colorVehiculo);
    $statement->bindParam(':TipoVehiculo', $tipoVehiculo);
    $statement->bindParam(':disponibilidad', $disponibilidad);
    $statement->bindParam(':nombre_dueño', $nombreDueno);
    $statement->bindParam(':modelo', $modelo);
    $statement->bindParam(':marca', $marca);
    $statement->bindParam(':descripcionvehiculo', $descripcionVehiculo);
    $statement->bindParam(':estadoos', $estadoos);
    $statement->bindParam(':id_parking', $idSolicitud);

    // Ejecutar la consulta
    if ($statement->execute()) {
        header("Location: horariocarro.php"); // Redirigir a una lista de solicitudes
        exit();
    } else {
        echo "Error al actualizar la solicitud.";
    }
}
?>
