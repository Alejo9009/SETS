<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

require 'vendor/autoload.php';
use Firebase\JWT\JWT;

include_once "conexion.php";

$secret_key = "tu_clave_secreta"; 

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idRol = $_POST['idRol'];
        $PrimerNombre = $_POST['PrimerNombre'];
        $SegundoNombre = $_POST['SegundoNombre'] ?? null;
        $PrimerApellido = $_POST['PrimerApellido'];
        $SegundoApellido = $_POST['SegundoApellido'] ?? null;
        $Correo = $_POST['Correo'];
        $tipo_propietario = $_POST['tipo_propietario'];
        $apartamento  = $_POST['apartamento'];
        $Id_tipoDocumento = $_POST['Id_tipoDocumento'];
        $numeroDocumento = $_POST['numeroDocumento'];
        $telefonoUno = $_POST['telefonoUno'];
        $telefonoDos = $_POST['telefonoDos'] ?? null;
        $Usuario = $_POST['Usuario'];
        $Clave = $_POST['Clave'];

        if (empty($Clave)) {
            throw new Exception("La contraseña no puede estar vacía.");
        }

        $Clave = password_hash($Clave, PASSWORD_BCRYPT);

        $base_de_datos->beginTransaction();

        $sql = "INSERT INTO registro (idRol, PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, apartamento , Correo, Id_tipoDocumento, numeroDocumento, tipo_propietario,telefonoUno, telefonoDos, Usuario, Clave) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?)";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([$idRol, $PrimerNombre, $SegundoNombre, $PrimerApellido, $SegundoApellido, $apartamento, $Correo, $Id_tipoDocumento, $numeroDocumento, $tipo_propietario, $telefonoUno, $telefonoDos, $Usuario, $Clave]);

        $idRegistro = $base_de_datos->lastInsertId();

        // Generar token JWT
        $payload = [
            "id" => $idRegistro,
            "Usuario" => $Usuario,
            "Correo" => $Correo,
            "idRol" => $idRol,
            "exp" => time() + 3600 // 1 hora de expiración
        ];

        $jwt = JWT::encode($payload, $secret_key, 'HS256');

        $sqlToken = "INSERT INTO tokens (id_Registro, token, fecha_expiracion) VALUES (?, ?, ?)";
        $stmtToken = $base_de_datos->prepare($sqlToken);
        $fechaExpiracion = date('Y-m-d H:i:s', time() + 3800); // 1 hora de expiración
        $stmtToken->execute([$idRegistro, $jwt, $fechaExpiracion]);

        $base_de_datos->commit();

        setcookie("token", $jwt, time() + 3900, "/", "localhost", false, true); // 1 hora de expiración

        $redirect = "";
        switch ($idRol) {
            case 1111:
                $redirect = "1111"; 
                break;
            case 2222:
                $redirect = "2222"; 
                break;
            case 3333:
                $redirect = "3333"; 
                break;
            case 4444:
                $redirect = "4444"; 
                break;
            default:
                $redirect = "error";
                break;
        }


        echo json_encode(['redirect' => $redirect, 'token' => $jwt]);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['tipo'])) {
            if ($_GET['tipo'] === 'roles') {
                try {
                    $result = $base_de_datos->query("SELECT id, Roldescripcion FROM rol");
                    $roles = $result->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($roles);
                } catch (Exception $e) {
                    echo json_encode(["error" => "Error al obtener roles: " . $e->getMessage()]);
                }
            } elseif ($_GET['tipo'] === 'tipodocs') {
                try {
                    $result = $base_de_datos->query("SELECT idtDoc, descripcionDoc FROM tipodoc");
                    $tipodocs = $result->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($tipodocs);
                } catch (Exception $e) {
                    echo json_encode(["error" => "Error al obtener tipos de documento: " . $e->getMessage()]);
                }
            } else {
                echo json_encode(["error" => "Tipo no válido"]);
            }
        } else {
            echo json_encode(["error" => "Parámetro 'tipo' no encontrado"]);
        }
    }
} catch (Exception $e) {
    if ($base_de_datos->inTransaction()) {
        $base_de_datos->rollBack();
    }
    echo json_encode(["error" => "Error general: " . $e->getMessage()]);
} finally {
    
    $base_de_datos = null;
}