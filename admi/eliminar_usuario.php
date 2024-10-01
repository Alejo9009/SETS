<?php
// eliminar_usuario.php
try {
    include_once "conexion.php";

    // Verificamos si se ha pasado el ID del registro
    if (isset($_GET['id_Registro'])) {
        $idRegistro = $_GET['id_Registro'];

        // Primero, eliminamos las referencias en rol_registro
        $stmt = $base_de_datos->prepare("DELETE FROM rol_registro WHERE idRegistro = :id");
        $stmt->bindParam(':id', $idRegistro);
        $stmt->execute();

        // Ahora, eliminamos las referencias en telefono
        $stmt = $base_de_datos->prepare("DELETE FROM telefono WHERE person = :id");
        $stmt->bindParam(':id', $idRegistro);
        $stmt->execute();

        // Ahora, eliminamos el usuario de la tabla registro
        $stmt = $base_de_datos->prepare("DELETE FROM registro WHERE id_Registro = :id");
        $stmt->bindParam(':id', $idRegistro);

        // Ejecutamos la consulta
        if ($stmt->execute()) {
            // Redirigimos a la página anterior con un mensaje de éxito
            header("Location: datos_usuario.php?mensaje=Usuario eliminado con éxito");
            exit();
        } else {
            // Redirigimos en caso de error
            header("Location: datos_usuario.php?mensaje=Error al eliminar el usuario");
            exit();
        }
    } else {
        // Redirigir si no se especifica el ID
        header("Location: datos_usuario.php?mensaje=ID no válido");
        exit();
    }
} catch (PDOException $e) {
    // Manejo de errores
    echo "Error: " . $e->getMessage();
}

?>
