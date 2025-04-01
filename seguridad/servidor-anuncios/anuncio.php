<?php
include '../conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["accion"])) {

  
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fechaPublicacion = $_POST['fechaPublicacion'];
    $horaPublicacion = $_POST['horaPublicacion'];
    $persona = $_POST['persona'];

    $img_anuncio = $_POST['img_anuncio'];

    
    $sql = "INSERT INTO anuncio (titulo, descripcion, fechaPublicacion, horaPublicacion,persona, img_anuncio) 
            VALUES (:titulo, :descripcion, :fechaPublicacion, :horaPublicacion,:persona,  :img_anuncio)";
    
    
    $stmt = $base_de_datos->prepare($sql);

    
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . implode(", ", $base_de_datos->errorInfo()));
    }

    
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':fechaPublicacion', $fechaPublicacion, PDO::PARAM_STR);
    $stmt->bindParam(':horaPublicacion', $horaPublicacion, PDO::PARAM_STR);
    $stmt->bindParam(':persona', $persona, PDO::PARAM_INT);
    $stmt->bindParam(':img_anuncio', $img_anuncio, PDO::PARAM_STR);


    if ($stmt->execute()) {
        echo "<script>
                alert('Anuncio creado exitosamente.');
                window.location.href = '../inicioprincipal.php';
              </script>";
    } else {
        echo "Error al agregar el anuncio: " . implode(", ", $stmt->errorInfo());
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"]) && $_POST["accion"] == "eliminar") {
    $titulo = $_POST["titulo"];

    if (!empty($titulo)) {
        
        $sql = "DELETE FROM anuncio WHERE titulo = :titulo";
        $sentencia = $base_de_datos->prepare($sql);

        $sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);

        if ($sentencia->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'El anuncio ha sido eliminado correctamente.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error al eliminar el anuncio.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No se ha proporcionado un título válido.'
        ]);
    }
}
?>
