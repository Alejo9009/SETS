<?php

include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $id_parking = $_POST['id_parking'];
        $id_Aparta = $_POST['id_Aparta'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $hora_inicio = $_POST['hora_inicio'];
        $fecha_final = $_POST['fecha_final'];
        $hora_final = $_POST['hora_final'];
        $numParqueadero = $_POST['numParqueadero'];
        $placaVehiculo = $_POST['placaVehiculo'];
        $colorVehiculo = $_POST['colorVehiculo'];
        $TipoVehiculo = $_POST['TipoVehiculo'];
        $nombre_dueño = $_POST['nombre_dueño'];
        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $descripcionvehiculo = $_POST['descripcionvehiculo'];
        $estadoos = "2"; // Suponiendo que este valor se define así

        // Preparar la consulta SQL con valores de marcador de posición `?`
        $sql = "INSERT INTO solicitud_parqueadero 
                (id_parking, id_Aparta, fecha_inicio, hora_inicio, fecha_final, hora_final, 
                numParqueadero, placaVehiculo, colorVehiculo, TipoVehiculo, nombre_dueño, 
                modelo, marca, descripcionvehiculo, estadoos) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $base_de_datos->prepare($sql);

        // Ejecutar la consulta pasando los valores directamente al método execute
        $result = $stmt->execute([
            $id_parking, $id_Aparta, $fecha_inicio, $hora_inicio, $fecha_final, $hora_final,
            $numParqueadero, $placaVehiculo, $colorVehiculo, $TipoVehiculo, $nombre_dueño,
            $modelo, $marca, $descripcionvehiculo, $estadoos
        ]);

        // Verificar si la ejecución fue exitosa
        if ($result) {
            echo "<script>
                    alert('Solicitud registrada con éxito.');
                    window.location.href = '../hoariomoto.php';
                  </script>";
        } else {
            echo "Error al registrar la solicitud: " . implode(", ", $stmt->errorInfo());
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>


