<?php
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opcion = $_POST['opcion'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Verficar si ya hay una cita asignada para esa fecha y hora
    $sql = "SELECT * FROM citas WHERE fecha = :fecha AND hora = :hora LIMIT 1";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute(['fecha' => $fecha, 'hora' => $hora]);
    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cita != false) {
        echo "<script>alert('La fecha ya esta reservada');</script>";
    }else{
        // Reservar la cita
        $sql = "INSERT INTO citas (opcion, fecha, hora) VALUES (:opcion, :fecha, :hora)";
        $stmt = $base_de_datos->prepare($sql);
        
        if ($stmt->execute(['opcion' => $opcion, 'fecha' => $fecha, 'hora' => $hora])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error al solicitar la cita.";
        }
    }
}
?>