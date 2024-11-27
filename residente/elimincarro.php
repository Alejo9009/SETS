<?php
include_once "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar' && isset($_POST['id_parking'])) {
        $id_parking = $_POST['id_parking'];

        // Consulta para eliminar
        $sql = "DELETE FROM solicitud_parqueadero WHERE id_parking = ?";
        $stmt = $base_de_datos->prepare($sql);

        if ($stmt->execute([$id_parking])) {
            // Redirige con mensaje de éxito
            header("Location: horariocarro.php?mensaje=exito");
            exit();
        } else {
            // Redirige con mensaje de error
            header("Location: horariocarro.php?mensaje=error");
            exit();
        }
    } else {
        // Si falta algún parámetro
        header("Location: horariocarro.php?mensaje=error_parametros");
        exit();
    }
}
?>
