<?php
// recuperar.php

// Asegúrate de usar una configuración adecuada para tu base de datos
require 'conexion.php';  // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];

    // Validar que el correo sea válido
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Verificar si el correo existe en la base de datos
        $sql = "SELECT id_Registro FROM registro WHERE Correo = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Generar un token único para el restablecimiento
            $token = bin2hex(random_bytes(16));  // Genera un token de 32 caracteres
            $expiracion = date("Y-m-d H:i:s", strtotime("+1 hour")); // El token expirará en 1 hora

            // Guardar el token en la base de datos
            $sql_token = "INSERT INTO recuperacion_contrasena (correo, token, expiracion) VALUES (?, ?, ?)";
            $stmt_token = $conexion->prepare($sql_token);
            $stmt_token->bind_param("sss", $correo, $token, $expiracion);
            $stmt_token->execute();

            // Enviar correo al usuario
            $enlace_recuperacion = "http://localhost/restablecer.php?token=" . $token;
            $asunto = "Recuperación de Contraseña";
            $mensaje = "Haz clic en el siguiente enlace para restablecer tu contraseña: " . $enlace_recuperacion;
            $cabeceras = "From: no-reply@tusitio.com";

            if (mail($correo, $asunto, $mensaje, $cabeceras)) {
                echo "Se ha enviado un correo con las instrucciones para recuperar tu contraseña.";
            } else {
                echo "Hubo un problema al enviar el correo.";
            }
        } else {
            echo "No se encontró un usuario con ese correo.";
        }
        
        $conexion->close();
    } else {
        echo "Por favor ingresa un correo válido.";
    }
}
?>
