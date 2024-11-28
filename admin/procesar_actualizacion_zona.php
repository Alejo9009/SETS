<?php
include_once "conexion.php"; // Conexión a la base de datos

// Verificar si se ha enviado el formulario con los datos
if (isset($_POST['TipoZonaid']) && isset($_POST['descripcion']) && isset($_POST['url_videos'])) {
    $TipoZonaid = $_POST['TipoZonaid'];
    $descripcion = $_POST['descripcion'];
    $url_videos = $_POST['url_videos'];

    // Consulta para actualizar los datos de la zona
    $query = "UPDATE tipozona SET descripcion = :descripcion, url_videos = :url_videos WHERE TipoZonaid = :TipoZonaid";
    $statement = $base_de_datos->prepare($query);
    $statement->bindParam(':descripcion', $descripcion);
    $statement->bindParam(':url_videos', $url_videos);
    $statement->bindParam(':TipoZonaid', $TipoZonaid);

    // Ejecutar la consulta
    if ($statement->execute()) {
        echo "Zona actualizada exitosamente";
        header("Location: zonas_comunes.php"); // Redireccionar a la página principal
        exit();
    } else {
        echo "Error al actualizar la zona";
    }
} else {
    echo "Datos incompletos";
}
?>
