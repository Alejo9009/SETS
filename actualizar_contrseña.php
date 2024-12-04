<?php
// actualizar_contrasena.php

if (isset($_POST['nueva_contrasena']) && isset($_POST['token'])) {
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $token = $_POST['token'];

    require 'db_config.php';  // Conexión a la base de datos

    // Conectar a la base de datos
    $conexion = new mysqli($db_host, $db_usuario, $db_contrasena, $db_nombre);
    
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Verificar el token y actualizar la contraseña
    $sql_token = "SELECT correo FROM recuperacion_contrasena WHERE token = ?";
    $stmt = $conexion->prepare($sql_token);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $correo = $fila['correo'];

        // Actualizar la contraseña en la base de datos
        $sql_update = "UPDATE usuarios SET contrasena = ? WHERE correo = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("ss", password_hash($nueva_contrasena, PASSWORD_DEFAULT), $correo);
        $stmt_update->execute();

        // Eliminar el token utilizado
        $sql_delete = "DELETE FROM recuperacion_contrasena WHERE token = ?";
        $stmt_delete = $conexion->prepare($sql_delete);
        $stmt_delete->bind_param("s", $token);
        $stmt_delete->execute();

        echo "Contraseña actualizada exitosamente.";
    } else {
        echo "Token inválido o expirado.";
    }

    $conexion->close();
}
?>
