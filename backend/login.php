
<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

// Usar JWT
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;

$secret_key = "tu_clave_secreta";  // Define una clave secreta para la codificación del JWT

include_once "conexion.php";  // Conexión a la base de datos

// Función para autenticar el usuario usando la base de datos
function autenticarUsuario($Usuario, $Clave) {
    global $base_de_datos, $secret_key;

    // Buscar el usuario en la base de datos
    $stmt = $base_de_datos->prepare("SELECT idRol, Clave FROM registro WHERE Usuario = ?");
    $stmt->execute([$Usuario]);
    $UsuarioDB = $stmt->fetch();

    // Verificar si la clave es correcta (comparando la clave con el hash almacenado en la base de datos)
    if ($UsuarioDB && password_verify($Clave, $UsuarioDB['Clave'])) {

        // Si la autenticación es exitosa, crear el payload para el JWT
        $payload = [
            "Usuario" => $Usuario,
            "idRol" => $UsuarioDB['idRol'],
            "iat" => time(),  // Tiempo de emisión
            "exp" => time() + 3600  // Tiempo de expiración (1 hora)
        ];

        // Generar el JWT
        $jwt = JWT::encode($payload, $secret_key, 'HS256');

        // Retornar el token JWT
        return [
            'mensaje' => 'Inicio de sesión exitoso',
            'token' => $jwt
        ];
    } else {
        // Si las credenciales son incorrectas, retornar el error
        return ['error' => 'Credenciales incorrectas'];
    }
}

// Si no se ha enviado el nombre de usuario y la clave, mostrar un mensaje de error
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Zona Privada"');
    header('HTTP/1.0 401 Unauthorized');
    print 'Lo Siento, credenciales incorrectas.';
    exit;
} else {
    // Si el usuario está autenticado con las credenciales básicas, validar las credenciales enviadas
    $usuario = $_SERVER['PHP_AUTH_USER'];
    $clave = $_SERVER['PHP_AUTH_PW'];

    // Llamar a la función de autenticación
    $respuesta = autenticarUsuario($usuario, $clave);

    // Responder con el resultado de la autenticación
    echo json_encode($respuesta);
    exit;
}
?>