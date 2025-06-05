
<?php
include './conexion.php';
include '../MODEL/citas.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $datos = [
            'tipocita' => $_POST['tipocita'],
            'fechacita' => $_POST['fechacita'],
            'horacita' => $_POST['horacita'],
            'apa' => $_POST['apa']
        ];

        validarFechaHora($datos['fechacita'], $datos['horacita']);

        if (validarDisponibilidadCita($base_de_datos, $datos['fechacita'], $datos['horacita'])) {
            die("<script>alert('La fecha y hora ya están reservadas'); window.history.back();</script>");
        }

        if (crearCita($base_de_datos, $datos)) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=1");
            exit();
        } else {
            die("<script>alert('Error al solicitar la cita'); window.history.back();</script>");
        }
    } catch (Exception $e) {
        die("<script>alert('Error: " . $e->getMessage() . "'); window.history.back();</script>");
    }
} else {
    header("Location: citas.php");
    exit();
}
?>