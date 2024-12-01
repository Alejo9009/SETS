<?php
include_once "conexion.php"; // Archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo del formulario
    $email = $_POST['email'];

    // Validar que el campo email no esté vacío y sea válido
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // Preparar la consulta SQL
        $sql = "INSERT INTO contacto (email) VALUES (:email)";
        $stmt = $base_de_datos->prepare($sql);

        // Verificar si la consulta se preparó correctamente
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $base_de_datos->errorInfo());
        }

        // Enlazar el parámetro a la consulta
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>
                    alert('Correo enviado con éxito.');
                    window.location.href = 'index.php'; // Redirige a la página principal
                  </script>";
        } else {
            echo "Error al enviar el correo: " . $stmt->errorInfo();
        }
    } else {
        echo "Por favor ingresa un correo válido.";
    }
}
?>
