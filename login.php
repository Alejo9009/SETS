<?php
include_once "conexion.php";

// Obtener datos del formulario
$usuario = $_POST['usuario'] ?? '';
$clave = $_POST['clave'] ?? '';

// Validar si los datos no están vacíos
if (empty($usuario) || empty($clave)) {
    die("Usuario o clave no pueden estar vacíos.");
}

// Preparar la consulta para verificar el usuario
$sql = "SELECT id_Registro, Clave FROM registro WHERE Usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si existe un usuario con esas credenciales
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idRegistro = $row['id_Registro'];
    $Clave = $row['Clave'];

    // Comparar la clave (si está en texto claro)
    if ($clave === $Clave) {
        // Preparar la consulta para obtener el rol del usuario
        $sql = "SELECT r.Roldescripcion FROM rol_registro rr 
                JOIN rol r ON rr.idROL = r.id 
                WHERE rr.idRegistro = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idRegistro);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $roles = [];
            while ($row = $result->fetch_assoc()) {
                $roles[] = $row['Roldescripcion'];
            }

            // Iniciar sesión
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['roles'] = $roles;
            $_SESSION['id_Registro'] = $idRegistro; // Asegúrate de guardar el ID en la sesión

            // Redirigir según el rol del usuario
            if (in_array('admi', $roles)) {
                header("Location: ../SETS/admi/inicioprincipal.php");
            } elseif (in_array('residente', $roles)) {
                header("Location: ../SETS/residente/inicioprincipal.php");
            } elseif (in_array('administrador', $roles)) {
                header("Location: ../SETS/administrador/inicioprincipal.php");
            } elseif (in_array('Guarda de Seguridad', $roles)) {
                header("Location: ../SETS/seguridad/inicioprincipal.php");
            } else {
                header("Location: ../SETS/error.html");
            }
            exit();
        } else {
            echo "Error: No se encontró rol para el usuario.";
        }
    } else {
        echo "Usuario o clave incorrectos.";
    }
} else {
    echo "Usuario o clave incorrectos.";
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
