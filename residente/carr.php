<?php
include_once "conexion.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    if (isset($_POST['id_parking'])) {
        $idSolicitud = $_POST['id_parking']; // Asegúrate de que este campo está presente en tu formulario
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

    // Actualizar la solicitud en la base de datos
    $query = "UPDATE solicitud_parqueadero SET 
                fecha_inicio = :fecha_inicio, 
                hora_inicio = :hora_inicio, 
                fecha_final = :fecha_final, 
                hora_final = :hora_final,
                numParqueadero = :numParqueadero,
                placaVehiculo = :placaVehiculo,
                colorVehiculo = :colorVehiculo
              WHERE id_parking = :id_parking"; // Eliminé la coma extra antes de 'WHERE'
    
    $statement = $base_de_datos->prepare($query);
    
    $statement->bindParam(':fecha_inicio', $fechaInicio);
    $statement->bindParam(':hora_inicio', $horaInicio);
    $statement->bindParam(':fecha_final', $fechaFinal);
    $statement->bindParam(':hora_final', $horaFinal);
    $statement->bindParam(':numParqueadero', $numParqueadero);
    $statement->bindParam(':placaVehiculo', $placaVehiculo);
    $statement->bindParam(':colorVehiculo', $colorVehiculo);
    $statement->bindParam(':id_parking', $idSolicitud);

    if ($statement->execute()) {
        header("Location: horariocarro.php"); // Redirigir a una lista de solicitudes
        exit();
    } else {
        echo "Error al actualizar la solicitud.";
    }
}
?>
