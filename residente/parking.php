<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_Aparta = $_POST['id_Aparta'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_final = $_POST['hora_final'];
    $numParqueadero = $_POST['numParqueadero'];
    $placaVehiculo = $_POST['placaVehiculo'];
    $colorVehiculo = $_POST['colorVehiculo'];
    $TipoVehiculo = $_POST['TipoVehiculo'];
    $nombre_dueño = $_POST['nombre_dueño'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $descripcionvehiculo = $_POST['descripcionvehiculo'];
    $disponibilidad = $_POST['disponibilidad'];
    $estadoos = $_POST['estadoos']; // El estado como texto

    // Consulta para insertar datos
    $sql = "INSERT INTO solicitud_parqueadero ( id_Aparta,  fecha_inicio,  fecha_final,  hora_inicio,  hora_final,  numParqueadero,  placaVehiculo,  colorVehiculo,  TipoVehiculo, 
                nombre_dueño,  modelo,  marca,  descripcionvehiculo,  disponibilidad,  estadoos ) 
                VALUES (:id_Aparta, :fecha_inicio, :fecha_final, :hora_inicio, :hora_final, :numParqueadero, :placaVehiculo, :colorVehiculo, :TipoVehiculo, :nombre_dueño, 
                :modelo, :marca, :descripcionvehiculo, :disponibilidad, :estadoos)";

    // Preparar la declaración
    $stmt = $base_de_datos->prepare($sql);

    // Vincular parámetros
    $stmt->bindParam(':id_Aparta', $id_Aparta);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_final', $fecha_final);
    $stmt->bindParam(':hora_inicio', $hora_inicio);
    $stmt->bindParam(':hora_final', $hora_final);
    $stmt->bindParam(':numParqueadero', $numParqueadero);
    $stmt->bindParam(':placaVehiculo', $placaVehiculo);
    $stmt->bindParam(':colorVehiculo', $colorVehiculo);
    $stmt->bindParam(':TipoVehiculo', $TipoVehiculo);
    $stmt->bindParam(':nombre_dueño', $nombre_dueño);
    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':marca', $marca);
    $stmt->bindParam(':descripcionvehiculo', $descripcionvehiculo);
    $stmt->bindParam(':disponibilidad', $disponibilidad);
    $stmt->bindParam(':estadoos', $estadoos);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        echo "Solicitud de parqueadero insertada correctamente.";
    } else {
        echo "Error al insertar la solicitud: " . implode(", ", $stmt->errorInfo());
    }
}
?>
