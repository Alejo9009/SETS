
<?php
function validarDisponibilidadCita($db, $fechacita, $horacita) {
    $sql = "SELECT * FROM cita WHERE fechacita = :fechacita AND horacita = :horacita LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute(['fechacita' => $fechacita, 'horacita' => $horacita]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function crearCita($db, $datos) {
    $sql = "INSERT INTO cita (tipocita, fechacita, horacita, apa, estado) 
            VALUES (:tipocita, :fechacita, :horacita, :apa, 'Pendiente')";
    $stmt = $db->prepare($sql);
    
    return $stmt->execute([
        'tipocita' => $datos['tipocita'], 
        'fechacita' => $datos['fechacita'], 
        'horacita' => $datos['horacita'], 
        'apa' => $datos['apa']
    ]);
}

function validarFechaHora($fechacita, $horacita) {
    $fechaHoraCita = new DateTime("$fechacita $horacita");
    $ahora = new DateTime();

    if ($fechaHoraCita < $ahora) {
        throw new Exception('No se puede agendar una cita en el pasado');
    }

    $hora = $fechaHoraCita->format('H');
    if ($hora < 8 || $hora >= 17) {
        throw new Exception('El horario de atención es de 8:00 a 17:00 horas');
    }

    if ($fechaHoraCita->format('i') != '00') {
        throw new Exception('Las citas solo pueden ser en horas exactas (8:00, 9:00, etc.)');
    }

    return true;
}
?>