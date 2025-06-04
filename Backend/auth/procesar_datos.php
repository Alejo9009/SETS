<?php

require './controller/guarda.php';

include_once "conexion.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['imagenPerfil']) && $_FILES['imagenPerfil']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imagenPerfil']['tmp_name'];
        $fileName = basename($_FILES['imagenPerfil']['name']);
        $fileSize = $_FILES['imagenPerfil']['size'];
        $fileType = $_FILES['imagenPerfil']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


        $check = getimagesize($fileTmpPath);
        if ($check === false) {
            echo "El archivo no es una imagen.";
            exit;
        }


        if ($fileSize > 2000000) {
            echo "El archivo es demasiado grande.";
            exit;
        }


        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExtension, $allowedTypes)) {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            exit;
        }


        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $targetFilePath = $targetDir . $fileName;
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {

            $sql = "UPDATE registro SET imagenPerfil = ? WHERE Usuario = ?";
            $stmt = $base_de_datos->prepare($sql);
            if ($stmt->execute([$targetFilePath, $Usuario])) {
                echo "La imagen se ha subido correctamente.";
            } else {
                echo "Hubo un error al actualizar la base de datos.";
            }
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    }

 
    $PrimerNombre = $_POST['profile-firstname'] ?? '';
    $SegundoNombre = $_POST['profile-secondname'] ?? '';
    $PrimerApellido = $_POST['profile-firstlastname'] ?? '';
    $SegundoApellido = $_POST['profile-secondlastname'] ?? '';
    $Correo = $_POST['profile-email'] ?? '';
    $telefonoUno = $_POST['profile-phone1'] ?? '';
    $telefonoDos = $_POST['profile-phone2'] ?? '';


    $sql = "UPDATE registro SET 
            PrimerNombre = ?, 
            SegundoNombre = ?, 
            PrimerApellido = ?, 
            SegundoApellido = ?, 
            Correo = ?, 
            telefonoUno = ?,
            telefonoDos = ?
            WHERE Usuario = ?";

    $stmt = $base_de_datos->prepare($sql);
    if ($stmt->execute([$PrimerNombre, $SegundoNombre, $PrimerApellido, $SegundoApellido, $Correo, $telefonoUno, $telefonoDos,  $Usuario])) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos.";
    }


    if (!empty($_POST['profile-password'])) {
        $clave = $_POST['profile-password'];
        $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
        $sql = "UPDATE registro SET Clave = ? WHERE Usuario = ?";
        $stmt = $base_de_datos->prepare($sql);
        if ($stmt->execute([$claveEncriptada, $Usuario])) {
            echo "Clave actualizada con éxito.";
        } else {
            echo "Error al actualizar la clave.";
        }
    }


    $_SESSION['Usuario'] = $Usuario;

    header("Location: perfil.php"); 
    exit(); 
}
?>