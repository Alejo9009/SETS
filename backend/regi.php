<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

require 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

include_once "conexion.php";

$secret_key = "tu_clave_secreta"; // Usa una clave segura

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idRol = $_POST['idRol'];
        $PrimerNombre = $_POST['PrimerNombre'];
        $SegundoNombre = $_POST['SegundoNombre'] ?? null;
        $PrimerApellido = $_POST['PrimerApellido'];
        $SegundoApellido = $_POST['SegundoApellido'] ?? null;
        $Correo = $_POST['Correo'];
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

        $sql = "INSERT INTO registro (idRol, PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, Correo, Id_tipoDocumento, numeroDocumento, telefonoUno, telefonoDos, Usuario, Clave) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([$idRol, $PrimerNombre, $SegundoNombre, $PrimerApellido, $SegundoApellido, $Correo, $Id_tipoDocumento, $numeroDocumento, $telefonoUno, $telefonoDos, $Usuario, $Clave]);

        $base_de_datos->commit();

        session_start();
        $_SESSION['Usuario'] = $Usuario;
        $_SESSION['idRol'] = $idRol;

        // Obtener la descripción del rol
        $sqlRoleDesc = "SELECT Roldescripcion FROM rol WHERE id = ?";
        $stmtRoleDesc = $base_de_datos->prepare($sqlRoleDesc);
        $stmtRoleDesc->execute([$idRol]);
        $rolDescripcion = $stmtRoleDesc->fetchColumn();

        // Generar token JWT
        $payload = [
            "id" => $base_de_datos->lastInsertId(), // ID del usuario registrado
            "Usuario" => $Usuario,
            "Correo" => $Correo,
            "idRol" => $idRol,
            "exp" => time() + (60 * 60 * 24) // Expira en 24 horas
        ];

        $jwt = JWT::encode($payload, $secret_key, 'HS256');

        // Configurar la cookie en la respuesta
        setcookie("token", $jwt, time() + (60 * 60 * 24), "/", "", false, true);

        // Redirección basada en el rol
        $redirect = "";
        switch ($rolDescripcion) {
            case "admin":
                $redirect = "1";
                break;
            case "Gestor de Imobiliaria":
                $redirect = "2";
                break;
            case "Guarda de Seguridad":
                $redirect = "3";
                break;
            case "residente":
                $redirect = "4";
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
    // Cerrar la conexión
    $base_de_datos = null;
}