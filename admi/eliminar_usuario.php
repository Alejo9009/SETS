<?php
// Conexión a la base de datos
try {
    include_once "conexion.php";

    // Verificar que el parámetro id está presente
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Convertir a entero para evitar inyecciones SQL

        // Preparar y ejecutar la consulta de eliminación
        $stmt = $base_de_datos->prepare("DELETE FROM registro WHERE id_Registro = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir de vuelta a la página principal con un mensaje de éxito
        header('Location: datos_usuario.php?mensaje=Usuario eliminado con éxito');
        exit();
    } else {
        echo 'ID de usuario no especificado.';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
