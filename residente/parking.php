<?php
// incluir la conexión a la base de datos
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_Aparta = $_POST['id_Aparta'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_final = $_POST['hora_final'];
    $numParqueadero = $_POST['numParqueadero']; // Cambiado aquí
    $placaVehiculo = $_POST['placaVehiculo'];
    $colorVehiculo = $_POST['colorVehiculo'];
    $id_TipoVehiculo = $_POST['id_TipoVehiculo'];

    // Consulta para insertar datos
    // Consulta para insertar datos
    $estado = 1; // El ID del estado que deseas asignar, asegúrate de que este ID exista en la tabla estado

    // Consulta para insertar datos
    $sql = "INSERT INTO solicitud_parqueadero (id_Aparta, fecha_inicio, fecha_final, hora_inicio, hora_final, id_parking, placaVehiculo, colorVehiculo, id_TipoVehiculo, estadoos)
            VALUES (:id_Aparta, :fecha_inicio, :fecha_final, :hora_inicio, :hora_final, :id_parking, :placaVehiculo, :colorVehiculo, :id_TipoVehiculo, :estadoos)";

    // Preparar la declaración
    $stmt = $base_de_datos->prepare($sql);

    // Vincular parámetros
    $stmt->bindParam(':id_Aparta', $id_Aparta);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_final', $fecha_final);
    $stmt->bindParam(':hora_inicio', $hora_inicio);
    $stmt->bindParam(':hora_final', $hora_final);
    $stmt->bindParam(':id_parking', $numParqueadero);
    $stmt->bindParam(':placaVehiculo', $placaVehiculo);
    $stmt->bindParam(':colorVehiculo', $colorVehiculo);
    $stmt->bindParam(':id_TipoVehiculo', $id_TipoVehiculo);
    $stmt->bindParam(':estadoos', $estado); // Vincula el estado aquí

    // Ejecutar la declaración
    if ($stmt->execute()) {
        echo "Solicitud de parqueadero insertada correctamente.";
    } else {
        echo "Error al insertar la solicitud: " . implode(", ", $stmt->errorInfo());
    }
}
?>