<?php
class ContactoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarContacto($datos) {
        $sql = "INSERT INTO contactarnos (nombre, correo, telefono, comentario) 
                VALUES (:nombre, :correo, :telefono, :comentario)";
        
        $stmt = $this->conexion->prepare($sql);
        
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $datos['telefono'], PDO::PARAM_STR);
        $stmt->bindParam(':comentario', $datos['comentario'], PDO::PARAM_STR);

        if (!$stmt->execute()) {
            throw new Exception("Error al guardar: " . implode(", ", $stmt->errorInfo()));
        }
    }
}
?>