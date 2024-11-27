<?php
include_once "conexion.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $idSolicitud = $_POST['idSolicitud'];
    $fechainicio = $_POST['fechainicio'];
    $Hora_inicio = $_POST['Hora_inicio'];
    $fechafinal = $_POST['fechafinal'];
    $Hora_final = $_POST['Hora_final'];

    // Actualizar la solicitud en la base de datos
    $query = "UPDATE solicitud_zona SET fechainicio = :fechainicio, Hora_inicio = :Hora_inicio, fechafinal = :fechafinal, Hora_final = :Hora_final WHERE ID_Apartamentooss = :ID_Apartamentooss";
    $statement = $base_de_datos->prepare($query);
    $statement->bindParam(':fechainicio', $fechainicio);
    $statement->bindParam(':Hora_inicio', $Hora_inicio);
    $statement->bindParam(':fechafinal', $fechafinal);
    $statement->bindParam(':Hora_final', $Hora_final);
    $statement->bindParam(':ID_Apartamentooss', $idSolicitud); // Cambiar aquí para usar $idSolicitud

    if ($statement->execute()) {
        header("Location: ../solicitarbbq.php"); // Redirigir a una lista de solicitudes (puedes cambiar esta parte)
        exit(); // Asegúrate de salir después de redirigir
    } else {
        echo "Error al actualizar la solicitud.";
    }
}
?>
