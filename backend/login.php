<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require 'vendor/autoload.php';  
include_once "conexion.php";   

use \Firebase\JWT\JWT;

header('Content-Type: application/json');
$key = "sets"; 

// Obtener el método de solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Obtener los datos de la solicitud (si existe)
$data = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'POST':
        // Solo procesamos el login si es una solicitud POST
        $Usuario = $data['Usuario'] ?? ''; 
        $Clave = $data['Clave'] ?? '';

        if (empty($Usuario) || empty($Clave)) {
            http_response_code(400);
            echo json_encode(["error" => "Usuario o clave no pueden estar vacíos."]);
            exit();
        }

        try {
            error_log("Usuario: " . $Usuario);
            error_log("Clave: " . $Clave);

            // Consulta para verificar el usuario y la clave
            $sql = "SELECT id_Registro, Clave, idRol FROM registro WHERE Usuario = ?";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([$Usuario]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            error_log("Resultado de la consulta: " . var_export($row, true));

            if ($row && password_verify($Clave, $row['Clave'])) {
                $id_Registro = $row['id_Registro'];
                $idRol = $row['idRol'];

                // Obtener el rol del usuario
                $sql_rol = "SELECT Roldescripcion FROM rol WHERE id = ?";
                $stmt = $base_de_datos->prepare($sql_rol);
                $stmt->execute([$idRol]);
                $rol = $stmt->fetchColumn();

                // Crear el payload del JWT
                $payload = [
                    "iat" => time(),
                    "exp" => time() + (60 * 60),  // Expiración de 1 hora
                    "id" => $id_Registro,
                    "usuario" => $Usuario,
                    "roles" => [$rol]
                ];

                // Codificar el JWT
                $jwt = JWT::encode($payload, $key  ,'HS256');

                // Devolver el JWT generado
                echo json_encode(["success" => true, "token" => $jwt, "roles" => [$rol]]);
            } else {
                http_response_code(401);
                echo json_encode(["error" => "Usuario o clave incorrectos."]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
        }
        break;

    case 'GET':
        // Aquí puedes manejar las solicitudes GET, por ejemplo, para obtener un usuario por su ID
        $id = $_GET['id'] ?? null;  // Obtener el ID de la consulta GET

        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "ID de usuario requerido."]);
            exit();
        }

        try {
            $sql = "SELECT id_Registro, Usuario, idRol FROM registro WHERE id_Registro = ?";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo json_encode($row);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Usuario no encontrado."]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
        }
        break;

    case 'PUT':
        // Aquí puedes manejar las solicitudes PUT, por ejemplo, para actualizar un usuario
        $id = $data['id'] ?? null;
        $usuario = $data['Usuario'] ?? null;
        $clave = $data['Clave'] ?? null;

        if (!$id || !$usuario || !$clave) {
            http_response_code(400);
            echo json_encode(["error" => "Faltan datos para actualizar."]);
            exit();
        }

        try {
            $sql = "UPDATE registro SET Usuario = ?, Clave = ? WHERE id_Registro = ?";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([$usuario, password_hash($clave, PASSWORD_BCRYPT), $id]);

            echo json_encode(["success" => true, "message" => "Usuario actualizado correctamente."]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
        }
        break;

    case 'DELETE':
        // Aquí puedes manejar las solicitudes DELETE, por ejemplo, para eliminar un usuario
        $id = $data['id'] ?? null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "ID de usuario requerido para eliminar."]);
            exit();
        }

        try {
            $sql = "DELETE FROM registro WHERE id_Registro = ?";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([$id]);

            echo json_encode(["success" => true, "message" => "Usuario eliminado correctamente."]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido."]);
        break;
}
?>
