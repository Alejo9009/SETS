<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

include_once "conexion.php";

session_start();

use \Firebase\JWT\JWT;

require_once 'vendor/autoload.php'; 

$secret_key = "tu_clave_secreta";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Usuario = $_POST['Usuario'] ?? '';
    $Clave = $_POST['Clave'] ?? '';

    if (empty($Usuario) || empty($Clave)) {
        echo json_encode(['error' => 'Usuario y contraseña requeridos.']);
        exit;
    }

    $stmt = $base_de_datos->prepare("SELECT idRol, Clave FROM registro WHERE Usuario = ?");
    $stmt->execute([$Usuario]);
    $usuarioDB = $stmt->fetch();

    if ($usuarioDB && password_verify($Clave, $usuarioDB['Clave'])) {
        
        $payload = [
            "Usuario" => $Usuario,
            "idRol" => $usuarioDB['idRol'],
            "iat" => time(), 
            "exp" => time() + 3600  
        ];

        // Generación del token
        $jwt = JWT::encode($payload, $secret_key ,'HS526');


        echo json_encode(['mensaje' => 'Inicio de sesión exitoso', 'token' => $jwt]);
    } else {
        echo json_encode(['error' => 'Credenciales incorrectas']);
    }
}