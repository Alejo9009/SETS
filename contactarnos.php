<?php
include_once "conexion.php"; // Tu archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $comentario = $_POST['comentario'];

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($correo) && !empty($telefono) && !empty($comentario)) {

        // Preparar la consulta SQL
        $sql = "INSERT INTO contactarnos (nombre, correo, telefono, comentario) VALUES (:nombre, :correo, :telefono, :comentario)";
        $stmt = $base_de_datos->prepare($sql);

        // Verificar si la consulta se preparó correctamente
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $base_de_datos->errorInfo());
        }

        // Enlazar los parámetros a la consulta
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                    alert('Contacto enviado con éxito.');
                    window.location.href = 'index.php'; // Redirige a la página principal u otra página
                  </script>";
        } else {
            echo "Error al enviar el contacto: " . $stmt->errorInfo();
        }
    } else {
        echo "Por favor completa todos los campos.";
    }
}
?>
