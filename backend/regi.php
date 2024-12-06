<?php
header("Access-Control-Allow-Origin: http://localhost:3000");  // Frontend React
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");  // Permitir cookies

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once "conexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        empty($data['Usuario']) || empty($data['idRol']) || empty($data['PrimerNombre']) || empty($data['PrimerApellido']) || empty($data['Correo']) ||
        empty($data['Id_tipoDocumento']) || empty($data['numeroDocumento']) || empty($data['telefonoUno']) || empty($data['Clave'])
    ) {
        http_response_code(400);
        echo json_encode(["error" => "Todos los campos obligatorios deben completarse."]);
        exit();
    }

    try {
        $idRol = $data['idRol'];
        $PrimerNombre = $data['PrimerNombre'];
        $SegundoNombre = $data['SegundoNombre'] ?? null;
        $PrimerApellido = $data['PrimerApellido'];
        $SegundoApellido = $data['SegundoApellido'] ?? null;
        $Correo = $data['Correo'];
        $Id_tipoDocumento = $data['Id_tipoDocumento'];
        $numeroDocumento = $data['numeroDocumento'];
        $telefonoUno = $data['telefonoUno'];
        $telefonoDos = $data['telefonoDos'] ?? null;
        $Usuario = $data['Usuario'];
        $Clave = password_hash($data['Clave'], PASSWORD_BCRYPT);

        // Insertar en la base de datos
        $sql = "INSERT INTO registro (idRol, PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, Correo, Id_tipoDocumento, numeroDocumento, telefonoUno, telefonoDos, Usuario, Clave) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([$idRol, $PrimerNombre, $SegundoNombre, $PrimerApellido, $SegundoApellido, $Correo, $Id_tipoDocumento, $numeroDocumento, $telefonoUno, $telefonoDos, $Usuario, $Clave]);

        // Iniciar sesión después de registrar al usuario
        session_start();
        $_SESSION['Usuario'] = $Usuario;
        $_SESSION['idRol'] = $idRol;
        $_SESSION['Clave'] = $Clave;
        
        
        // Responder con el idRol para que el frontend sepa a dónde redirigir
        http_response_code(201);
        echo json_encode([
            "message" => "Usuario registrado exitosamente.",
            "redirect" => $idRol // Mandar el idRol para usarlo en el frontend
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
    }
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
?>
