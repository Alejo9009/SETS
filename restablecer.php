<?php
// restablecer.php

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    require 'db_config.php';  // Conexión a la base de datos

    // Conectar a la base de datos
    $conexion = new mysqli($db_host, $db_usuario, $db_contrasena, $db_nombre);
    
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Verificar si el token existe y no ha expirado
    $sql_token = "SELECT correo, expiracion FROM recuperacion_contrasena WHERE token = ?";
    $stmt = $conexion->prepare($sql_token);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $expiracion = $fila['expiracion'];

        if (strtotime($expiracion) > time()) {
            // Mostrar formulario para cambiar la contraseña
            echo '<form action="actualizar_contrasena.php" method="POST">
                    <input type="password" name="nueva_contrasena" required placeholder="Nueva Contraseña">
                    <input type="hidden" name="token" value="' . $token . '">
                    <button type="submit">Restablecer Contraseña</button>
                  </form>';
        } else {
            echo "El token ha expirado.";
        }
    } else {
        echo "Token inválido.";
    }

    $conexion->close();
} else {
    echo "No se proporcionó un token válido.";
}
?>
