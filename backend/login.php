<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include_once "conexion.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);

        $sql = "SELECT idRol, Clave FROM registro WHERE Usuario = ?";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([$data['Usuario']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($data['Clave'], $user['Clave'])) {
            session_start();
            $_SESSION['Usuario'] = $data['Usuario'];
            $_SESSION['idRol'] = $user['idRol'];

            $sqlRoleDesc = "SELECT Roldescripcion FROM rol WHERE id = ?";
            $stmtRoleDesc = $base_de_datos->prepare($sqlRoleDesc);
            $stmtRoleDesc->execute([$user['idRol']]);
            $rolDescripcion = $stmtRoleDesc->fetchColumn();

            echo json_encode([
                'success' => true,
                'rol' => $rolDescripcion
            ]);
        } else {
            throw new Exception("Usuario o contraseña incorrectos.");
        }
    } else {
        throw new Exception("Método no permitido");
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
