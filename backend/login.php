<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

include_once "conexion.php";

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_COOKIE['Usuario']) && isset($_COOKIE['idRol'])) {
        $Usuario = $_COOKIE['Usuario'];  
        $idRol = $_COOKIE['idRol'];      


        $stmt = $base_de_datos->prepare("SELECT idRol, Clave FROM registro WHERE Usuario = ?");
        $stmt->execute([$Usuario]);
        $usuarioDB = $stmt->fetch();

        if ($usuarioDB && $usuarioDB['idRol'] == $idRol) {
            
            echo json_encode(['mensaje' => 'Sesión válida, por favor ingrese su contraseña para continuar']);
        } else {
            echo json_encode(['error' => 'Cookies inválidas']);
        }
    } else {
        echo json_encode(['mensaje' => 'No hay cookies, se requiere inicio de sesión']);
    }
}

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
   
        $_SESSION['Usuario'] = $Usuario;
        $_SESSION['idRol'] = $usuarioDB['idRol'];

        echo json_encode(['mensaje' => 'Inicio de sesión exitoso', 'redirect' => 'residente/BIENVENIDORESIDENTE.php']);
    } else {
        echo json_encode(['error' => 'Credenciales incorrectas']);
    }
}
