<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include_once "conexion.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);

        if (empty($data['correo'])) {
            throw new Exception("El correo es obligatorio.");
        }

        $correo = $data['correo'];

        // Buscar el usuario y su token en la base de datos
        $sql = "SELECT r.id_Registro, t.token 
                FROM registro r
                JOIN tokens t ON r.id_Registro = t.id_Registro
                WHERE r.Correo = ? AND t.fecha_expiracion > NOW()";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([$correo]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception("No se encontró un token válido para este correo.");
        }

        // Devolver el token para redirigir al usuario
        echo json_encode([
            'mensaje' => 'Token encontrado. Redirigiendo...',
            'token' => $user['token'],
        ]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    $base_de_datos = null;
}