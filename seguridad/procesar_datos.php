<?php
session_start();
include_once "conexion.php";

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../SETS/login.php");
    exit();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: ../SETS/registrase.php");
    exit();
}
// Obtener el ID del usuario desde la sesión
$idRegistro = $_SESSION['id_Registro'] ?? null;
if ($idRegistro === null) {
    die("Error: ID de registro no está disponible en la sesión.");
}

// Manejar la subida de la imagen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['imagenPerfil']) && $_FILES['imagenPerfil']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imagenPerfil']['tmp_name'];
        $fileName = basename($_FILES['imagenPerfil']['name']);
        $fileSize = $_FILES['imagenPerfil']['size'];
        $fileType = $_FILES['imagenPerfil']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real
        $check = getimagesize($fileTmpPath);
        if ($check === false) {
            echo "El archivo no es una imagen.";
            exit;
        }

        // Verificar el tamaño del archivo (máximo 2MB)
        if ($fileSize > 2000000) {
            echo "El archivo es demasiado grande.";
            exit;
        }

        // Permitir ciertos formatos de archivo
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExtension, $allowedTypes)) {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            exit;
        }

        // Definir la ruta de destino y mover el archivo
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $targetFilePath = $targetDir . $fileName;
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            // Actualizar la base de datos con la ruta de la imagen
            $sql = "UPDATE registro SET imagenPerfil = ? WHERE id_Registro = ?";
            $stmt = $base_de_datos->prepare($sql);
            if ($stmt->execute([$targetFilePath, $idRegistro])) {
                echo "La imagen se ha subido correctamente.";
            } else {
                echo "Hubo un error al actualizar la base de datos.";
            }
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    }
    
    // Actualizar los demás datos del perfil
    $PrimerNombre = $_POST['profile-firstname'] ?? '';
    $SegundoNombre = $_POST['profile-secondname'] ?? '';
    $PrimerApellido = $_POST['profile-firstlastname'] ?? '';
    $SegundoApellido = $_POST['profile-secondlastname'] ?? '';
    $email = $_POST['profile-email'] ?? '';
    $usuario = $_POST['profile-username'] ?? '';
    $telefono = $_POST['profile-phone'] ?? ''; // Cambié a 'profile-phone' para evitar confusiones

    // Consulta SQL corregida para campos existentes en la base de datos
    $sql = "UPDATE registro r
    JOIN telefono t ON r.id_Registro = t.person
    SET r.PrimerNombre = ?, 
        r.SegundoNombre = ?, 
        r.PrimerApellido = ?, 
        r.SegundoApellido = ?, 
        r.Correo = ?, 
        r.Usuario = ?, 
        t.numeroTel = ? 
    WHERE r.id_Registro = ?";
    
    $stmt = $base_de_datos->prepare($sql);
    if ($stmt->execute([$PrimerNombre, $SegundoNombre, $PrimerApellido, $SegundoApellido, $email, $usuario, $telefono, $idRegistro])) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos.";
    }
    if (!empty($_POST['profile-password'])) {
        $clave = $_POST['profile-password'];
        // Encriptar la contraseña
        $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
        $sql = "UPDATE registro SET Clave = ? WHERE id_Registro = ?";
        $stmt = $base_de_datos->prepare($sql);
        if ($stmt->execute([$claveEncriptada, $idRegistro])) {
            echo "Clave actualizada con éxito.";
        } else {
            echo "Error al actualizar la clave.";
        }
    }
}
?>

