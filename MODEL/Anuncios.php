
<?php
function crearAnuncio($db, $datos) {
    $sql = "INSERT INTO anuncio (titulo, descripcion, fechaPublicacion, horaPublicacion, persona, img_anuncio) 
            VALUES (:titulo, :descripcion, :fechaPublicacion, :horaPublicacion, :persona, :img_anuncio)";
    
    $stmt = $db->prepare($sql);
    if ($stmt === false) return false;
    
    $stmt->bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
    $stmt->bindParam(':fechaPublicacion', $datos['fechaPublicacion'], PDO::PARAM_STR);
    $stmt->bindParam(':horaPublicacion', $datos['horaPublicacion'], PDO::PARAM_STR);
    $stmt->bindParam(':persona', $datos['persona'], PDO::PARAM_INT);
    $stmt->bindParam(':img_anuncio', $datos['img_anuncio'], PDO::PARAM_STR);
    
    return $stmt->execute();
}

function eliminarAnuncio($db, $titulo) {
    $sql = "DELETE FROM anuncio WHERE titulo = :titulo";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    return $stmt->execute();
}
?>