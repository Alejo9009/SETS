<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once "conexion.php";
header('Content-Type: application/json');
session_start();


$data = json_decode(file_get_contents("php://input"), true);

$Usuario = $data['usuario'] ?? ''; 
$clave = $data['clave'] ?? '';

if (empty($Usuario) || empty($clave)) {
    http_response_code(400);
    echo json_encode(["error" => "Usuario o clave no pueden estar vacíos."]);
    exit();
}

try {

    $sql = "SELECT id_Registro, Clave, idRol FROM registro WHERE Usuario = ?";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute([$Usuario]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($row && $clave === $row['Clave']) { 
        $idRegistro = $row['id_Registro'];
        $idRol = $row['idRol'];

        $_SESSION['Usuario'] = $Usuario;
        $_SESSION['id_Registro'] = $idRegistro;

    
        $sql_rol = "SELECT Roldescripcion FROM rol WHERE id = ?";
        $stmt = $base_de_datos->prepare($sql_rol);
        $stmt->execute([$idRol]);
        $rol = $stmt->fetchColumn();

        $_SESSION['roles'] = [$rol];


        echo json_encode(["success" => true, "roles" => [$rol]]);
    } else {
        http_response_code(401);
        echo json_encode(["error" => "Usuario o clave incorrectos."]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
}