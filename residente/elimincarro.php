<?php
include_once "conexion.php";

if (isset($_POST['accion']) && isset($_POST['id_parking'])) {
    $id_parking = $_POST['id_parking']; // Cambia esto para usar la variable correcta
    $accion = $_POST['accion'];

    if ($accion == 'eliminar') {
        $sql = "DELETE FROM solicitud_parqueadero WHERE id_parking = ?";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([$id_parking]); // Usa $id_parking en lugar de $id_solicitud

        // Verifica si se eliminó correctamente
        if ($stmt->rowCount() > 0) {
            header("Location: horariocarro.php?mensaje=exito");
        } else {
            header("Location: horariocarro.php?mensaje=error");
        }
        exit();
    }
}
?>
