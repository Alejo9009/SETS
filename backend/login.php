<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once "conexion.php";

// Obtener datos del formulario (en formato JSON)
$data = json_decode(file_get_contents('php://input'), true);
$usuario = $data['usuario'] ?? '';
$clave = $data['clave'] ?? '';

// Validar si los datos no están vacíos
if (empty($usuario) || empty($clave)) {
    echo json_encode(['error' => 'Usuario o clave no pueden estar vacíos.']);
    exit();
}

try {
    // Preparar la consulta para verificar el usuario
    $sql = "SELECT id_Registro, Clave FROM registro WHERE Usuario = ?";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute([$usuario]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si existe un usuario con esas credenciales
    if ($row) {
        $idRegistro = $row['id_Registro'];
        $claveHash = $row['Clave'];

        // Comparar la clave (verificar el hash de la clave)
        if (password_verify($clave, $claveHash)) {
            // Preparar la consulta para obtener el rol del usuario
            $sql = "SELECT r.Roldescripcion FROM rol_registro rr
                    JOIN rol r ON rr.idROL = r.id 
                    WHERE rr.idRegistro = ?";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([$idRegistro]);
            $roles = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            // Crear un token JWT (solo un ejemplo básico)
            $token = bin2hex(random_bytes(16)); // Para propósitos demostrativos

            // Iniciar sesión con el token
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['roles'] = $roles;
            $_SESSION['id_Registro'] = $idRegistro;

            echo json_encode([
                'token' => $token, // Este es un token de ejemplo, en producción usar JWT
                'roles' => $roles,
                'usuario' => $usuario
            ]);
            exit();
        } else {
            echo json_encode(['error' => 'Usuario o clave incorrectos.']);
        }
    } else {
        echo json_encode(['error' => 'Usuario o clave incorrectos.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la consulta: ' . $e->getMessage()]);
}

// Cerrar conexión
$base_de_datos = null;
?>
