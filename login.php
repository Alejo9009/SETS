<?php
include_once "conexion.php";

// Obtener datos del formulario
$usuario = $_POST['usuario'] ?? '';
$clave = $_POST['clave'] ?? '';

// Validar si los datos no están vacíos
if (empty($usuario) || empty($clave)) {
    die("Usuario o clave no pueden estar vacíos.");
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
            $sql = "SELECT r.Roldescripcion FROM rol_registro  rr
                    JOIN rol r ON rr.idROL = r.id 
                    WHERE rr.idRegistro = ?";
            $stmt = $base_de_datos->prepare($sql);
            $stmt->execute([$idRegistro]);
            $roles = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            // Iniciar sesión
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['roles'] = $roles;
            $_SESSION['id_Registro'] = $idRegistro; // Asegúrate de guardar el ID en la sesión

            // Redirigir según el rol del usuario
            if (in_array('Admin', $roles)) {
                header("Location: ../SETS/admin/inicioprincipal.php");
            } elseif (in_array('Residente', $roles)) {
                header("Location: ../SETS/residente/inicioprincipal.php");
            } elseif (in_array('Gestor de Imobiliaria', $roles)) {
                header("Location: ../SETS/gestor inmobiliaria/inicioprincipal.php");
            } elseif (in_array('Guarda de Seguridad', $roles)) {
                header("Location: ../SETS/seguridad/inicioprincipal.php");
            } else {
                header("Location: ../SETS/error.html");
            }
            exit();
        } else {
            echo "Usuario o clave incorrectos.";
        }
    } else {
        echo "Usuario o clave incorrectos.";
    }
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}

// Cerrar conexión
$base_de_datos = null;
?>
