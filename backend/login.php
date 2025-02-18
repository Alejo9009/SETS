<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Incluir las librerías necesarias
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;


$secret_key = "tu_clave_secreta";  

include_once "conexion.php"; 

// Obtener datos del frontend
$input_data = json_decode(file_get_contents("php://input"), true);
$Usuario = $input_data['Usuario'] ?? '';
$Clave = $input_data['Clave'] ?? '';

if (!$Usuario || !$Clave) {
    echo json_encode(["error" => "❌ Faltan credenciales"]);
    exit;
}

// Buscar el usuario en  base de datos
$stmt = $base_de_datos->prepare("SELECT idRol, Clave FROM registro WHERE Usuario = ?");
$stmt->execute([$Usuario]);
$UsuarioDB = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si  usuario existe
if (!$UsuarioDB) {
    echo json_encode(["error" => "❌ Usuario no encontrado"]);
    exit;
}

// Verificar si contraseña es correcta
if (!password_verify($Clave, $UsuarioDB['Clave'])) {
    echo json_encode(["error" => "❌ Clave incorrecta"]);
    exit;
}

// Crear el payload del JWT
$payload = [
    "Usuario" => $Usuario,
    "idRol" => $UsuarioDB['idRol'],
    "iat" => time(),
    "exp" => time() + 3600 
];

// Generar el token JWT
$jwt = JWT::encode($payload, $secret_key, 'HS256');

// Guardar el token en una cookie segura
setcookie("authToken", $jwt, [
    "expires" => time() + 3600,
    "path" => "/",
    "domain" => "localhost",
    "secure" => false,  
    "httponly" => true, 
    "samesite" => "Lax"
]);


echo json_encode([
    "mensaje" => "Inicio de sesión exitoso",
    "token" => $jwt,
    "idRol" => $UsuarioDB['idRol']
]);
?>
