<?php
include_once "conexion.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $idSolicitud = $_POST['idSolicitud'];
    $fechaInicio = $_POST['fechaInicio'];
    $horaInicio = $_POST['horaInicio'];
    $fechaFinal = $_POST['fechaFinal'];
    $horaFinal = $_POST['horaFinal'];

    // Actualizar la solicitud en la base de datos
    $query = "UPDATE solicitud_zona SET fechaInicio = :fechaInicio, Hora_inicio = :horaInicio, fechaFinal = :fechaFinal, Hora_final = :horaFinal WHERE ID_Apartament = :ID_Apartament";
    $statement = $base_de_datos->prepare($query);
    $statement->bindParam(':fechaInicio', $fechaInicio);
    $statement->bindParam(':horaInicio', $horaInicio);
    $statement->bindParam(':fechaFinal', $fechaFinal);
    $statement->bindParam(':horaFinal', $horaFinal);
    $statement->bindParam(':ID_Apartament', $idSolicitud); // Cambiar aquí para usar $idSolicitud

    if ($statement->execute()) {
        header("Location: solicitarbbq.php"); // Redirigir a una lista de solicitudes (puedes cambiar esta parte)
        exit(); // Asegúrate de salir después de redirigir
    } else {
        echo "Error al actualizar la solicitud.";
    }
}
?>
