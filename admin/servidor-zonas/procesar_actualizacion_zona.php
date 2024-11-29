<?php
include_once "conexion.php"; 

if (isset($_POST['idZona']) && isset($_POST['descripcion']) && isset($_POST['url_videos'])) {
    $idZona = $_POST['idZona'];
    $descripcion = $_POST['descripcion'];
    $url_videos = $_POST['url_videos'];


    $query = "UPDATE zona_comun SET descripcion = :descripcion, url_videos = :url_videos WHERE idZona = :idZona ";
    $statement = $base_de_datos->prepare($query);
    $statement->bindParam(':descripcion', $descripcion);
    $statement->bindParam(':url_videos', $url_videos);
    $statement->bindParam(':idZona', $idZona);


    if ($statement->execute()) {
        echo "Zona actualizada exitosamente";
        header("Location: ../zonas_comunes.php"); 
        exit();
    } else {
        echo "Error al actualizar la zona";
    }
} else {
    echo "Datos incompletos";
}
?>
