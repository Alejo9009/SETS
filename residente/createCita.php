<?php
include 'conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipocita = $_POST['tipocita'];
    $fechacita = $_POST['fechacita'];
    $horacita = $_POST['horacita'];
    $apa = $_POST['apa'];

    // Verficar si ya hay una cita asignada para esa fecha y hora
    $sql = "SELECT * FROM cita WHERE fechacita = :fechacita AND horacita = :horacita LIMIT 1";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute(['fechacita' => $fechacita, 'horacita' => $horacita]);
    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cita != false) {
        echo "<script>alert('La fecha ya esta reservada');</script>";
    }else{
        // Reservar la cita
        $sql = "INSERT INTO cita (tipocita, fechacita, horacita ,apa) VALUES (:tipocita, :fechacita, :horacita , :apa)";
        $stmt = $base_de_datos->prepare($sql);
        
        if ($stmt->execute(['tipocita' => $tipocita, 'fechacita' => $fechacita, 'horacita' => $horacita, 'apa' => $apa])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error al solicitar la cita.";
        }
    }
}
?>