<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipocita = $_POST['tipocita'];
    $fechacita = $_POST['fechacita'];
    $horacita = $_POST['horacita'];
    $apa = $_POST['apa'];


    try {
        $fechaHoraCita = new DateTime("$fechacita $horacita");
        $ahora = new DateTime();


        if ($fechaHoraCita < $ahora) {
            die("<script>alert('Error: No se puede agendar una cita en el pasado'); window.history.back();</script>");
        }


        $hora = $fechaHoraCita->format('H');
        if ($hora < 8 || $hora >= 17) {
            die("<script>alert('Error: El horario de atención es de 8:00 a 17:00 horas'); window.history.back();</script>");
        }


        $minutos = $fechaHoraCita->format('i');
        if ($minutos != '00') {
            die("<script>alert('Error: Las citas solo pueden ser en horas exactas (8:00, 9:00, etc.)'); window.history.back();</script>");
        }


        $sql = "SELECT * FROM cita WHERE fechacita = :fechacita AND horacita = :horacita LIMIT 1";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute(['fechacita' => $fechacita, 'horacita' => $horacita]);
        $cita = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cita != false) {
            die("<script>alert('La fecha y hora ya están reservadas'); window.history.back();</script>");
        } else {

            $sql = "INSERT INTO cita (tipocita, fechacita, horacita, apa, estado) 
                    VALUES (:tipocita, :fechacita, :horacita, :apa, 'Pendiente')";
            $stmt = $base_de_datos->prepare($sql);
            
            if ($stmt->execute([
                'tipocita' => $tipocita, 
                'fechacita' => $fechacita, 
                'horacita' => $horacita, 
                'apa' => $apa
            ])) {
                header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=1");
                exit();
            } else {
                die("<script>alert('Error al solicitar la cita'); window.history.back();</script>");
            }
        }
    } catch (Exception $e) {
        die("<script>alert('Error en los datos de fecha y hora'); window.history.back();</script>");
    }
} else {
    header("Location: citas.php");
    exit();
}
?>