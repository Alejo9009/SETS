<?php
include_once "conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset(
        $_POST['id_apartamento'],
        $_POST['parqueadero_visitante'],
        $_POST['nombre_visitante'],
        $_POST['placaVehiculo'],
        $_POST['colorVehiculo'],
        $_POST['tipoVehiculo'],
        $_POST['modelo'],
        $_POST['marca'],
        $_POST['fecha_inicio'],
        $_POST['fecha_final']
    )) {
        die("Error: Datos incompletos.");
    }

  
    $id_apartamento = $_POST['id_apartamento'];
    $parqueadero_visitante = $_POST['parqueadero_visitante'];
    $nombre_visitante = $_POST['nombre_visitante'];
    $placaVehiculo = $_POST['placaVehiculo'];
    $colorVehiculo = $_POST['colorVehiculo'];
    $tipoVehiculo = $_POST['tipoVehiculo'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];


    $query = "INSERT INTO solicitud_parqueadero 
                (id_apartamento, parqueadero_visitante, nombre_visitante, placaVehiculo, colorVehiculo, 
                tipoVehiculo, modelo, marca, fecha_inicio, fecha_final, estado) 
              VALUES 
                (:id_apartamento, :parqueadero_visitante, :nombre_visitante, :placaVehiculo, :colorVehiculo, 
                :tipoVehiculo, :modelo, :marca, :fecha_inicio, :fecha_final, 'pendiente')";

    $statement = $base_de_datos->prepare($query);


    $statement->bindParam(':id_apartamento', $id_apartamento); 
    $statement->bindParam(':parqueadero_visitante', $parqueadero_visitante);
    $statement->bindParam(':nombre_visitante', $nombre_visitante);
    $statement->bindParam(':placaVehiculo', $placaVehiculo);
    $statement->bindParam(':colorVehiculo', $colorVehiculo);
    $statement->bindParam(':tipoVehiculo', $tipoVehiculo);
    $statement->bindParam(':modelo', $modelo);
    $statement->bindParam(':marca', $marca);
    $statement->bindParam(':fecha_inicio', $fecha_inicio);
    $statement->bindParam(':fecha_final', $fecha_final);

    if ($statement->execute()) {
        echo "Solicitud creada correctamente.";
        header("Location: ../horariocarro.php");
        exit();
    } else {
        echo "Error al registrar la solicitud.";
    }
}
