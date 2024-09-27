<?php
include_once "conexion.php";

try {

    // Obtener el email del formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

        // Verificar que el email no esté vacío
        if (!empty($email)) {
            // Insertar en la base de datos
            $stmt = $base_de_datos->prepare("INSERT INTO contacto (email) VALUES (:email)");
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                echo "Suscripción exitosa. ¡Gracias!";
            } else {
                echo "Error al suscribirse. Por favor intenta nuevamente.";
            }
        } else {
            echo "Por favor, ingresa un correo válido.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
$base_de_datos = null;
?>
