<?php
include_once "conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcionAnuncio = $_POST['descripcionAnuncio'];
    $fechaPublicacion = $_POST['fechaPublicacion'];
    $horaPublicacion = $_POST['horaPublicacion'];
    $persona = $_POST['persona'];
    $img_anuncio = $_POST['img_anuncio'];

    $sql = "INSERT INTO anuncio ( titulo , descripcionAnuncio, fechaPublicacion, horaPublicacion, persona, img_anuncio) VALUES ( :titulo, :descripcionAnuncio, :fechaPublicacion, :horaPublicacion, :persona, :img_anuncio)";
    $stmt = $base_de_datos->prepare($sql);

    var_dump($stmt);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $base_de_datos->errorInfo());
    }
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':descripcionAnuncio', $descripcionAnuncio,PDO::PARAM_STR);
    $stmt->bindParam(':fechaPublicacion', $fechaPublicacion,PDO::PARAM_STR);
    $stmt->bindParam(':horaPublicacion', $horaPublicacion,PDO::PARAM_STR);
    $stmt->bindParam(':persona', $persona,PDO::PARAM_INT);
    $stmt->bindParam(':img_anuncio', $img_anuncio,PDO::PARAM_STR);



    if ($stmt->execute()) {
        echo "<script>
                alert('creado exitosamente.');
                window.location.href = 'añadiranuncio.php';
              </script>";
    } else {
        echo "Error al agregar: " . $stmt->errorInfo();
    }

    //$base_de_datos->Close();
}