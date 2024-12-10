<?php
header('Access-Control-Allow-Origin: http://localhost:3000');  
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;

// Clave secreta para generar el token JWT
$secret_key = "tu_clave_secreta";  // Reemplaza con tu clave secreta real

// Incluir la conexión a la base de datos
include_once "conexion.php"; // Asegúrate de que 'conexion.php' esté correctamente configurado

// Función para autenticar al usuario
function autenticarUsuario($usuario, $clave) {
    global $base_de_datos, $secret_key;

    // Consultar el usuario en la base de datos
    $stmt = $base_de_datos->prepare("SELECT idRol, Clave FROM registro WHERE Usuario = ?");
    $stmt->execute([$usuario]);
    $usuarioDB = $stmt->fetch();

    // Verificar las credenciales
    if ($usuarioDB && password_verify($clave, $usuarioDB['Clave'])) {
        // Si las credenciales son correctas, generar el token JWT
        $payload = [
            "Usuario" => $usuario,
            "idRol" => $usuarioDB['idRol'],
            "iat" => time(),  // Fecha de emisión
            "exp" => time() + 3600  // Expira en 1 hora
        ];

        // Generar el token JWT
        $jwt = JWT::encode($payload, $secret_key, 'HS256');
        
        return [
            'mensaje' => 'Inicio de sesión exitoso',
            'token' => $jwt
        ];
    } else {
        // Si las credenciales no coinciden
        return ['error' => 'Credenciales incorrectas'];
    }
}

// Procesar la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados en la solicitud
    $data = json_decode(file_get_contents("php://input"), true);
    $usuario = $data['Usuario'] ?? '';
    $clave = $data['Clave'] ?? '';

    // Llamar a la función para autenticar
    $respuesta = autenticarUsuario($usuario, $clave);
    
    // Enviar la respuesta en formato JSON
    echo json_encode($respuesta);
    exit;
} else {
    // Si no es un POST, devolver un error 405
    http_response_code(405); // Método no permitido
    echo json_encode(["error" => "Método no permitido"]);
}
?>
