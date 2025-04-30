<?php

try {
    include_once "conexion.php";

    if (isset($_GET['id_Registro'])) {
        $idRegistro = $_GET['id_Registro'];

        $stmt = $base_de_datos->prepare("DELETE FROM registro WHERE id_Registro = :id");
        $stmt->bindParam(':id', $idRegistro);


        if ($stmt->execute()) {

            header("Location: ../VIEW/admin/datos_usuario.php?mensaje=Usuario eliminado con éxito");
            exit();
        } else {
   
            header("Location: ../VIEW/admin/datos_usuario.php?mensaje=Error al eliminar el usuario");
            exit();
        }
    } else {
   
        header("Location: ../VIEW/admin/datos_usuario.php?mensaje=ID no válido");
        exit();
    }
} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
}

?>
