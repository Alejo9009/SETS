<?php

include_once "conexion.php";

try {
    // Obtener los datos del formulario POST
    $primerNombre = $_POST['primerNombre'];
    $segundoNombre = $_POST['segundoNombre'];
    $primerApellido = $_POST['primerApellido'];
    $segundoApellido = $_POST['segundoApellido'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT); // Encriptar la clave correctamente
    $tipoDocumento = $_POST['tipoDocumento'];
    $numeroDocumento = $_POST['numeroDocumento'];
    $rol = $_POST['rol'];
    $numeroTel = $_POST['numeroTel'];

    // Iniciar transacción
    $base_de_datos->beginTransaction();

    // Insertar datos en la tabla registro
    $sql = "INSERT INTO registro (PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, Correo, Usuario, Clave, Id_tipoDocumento, numeroDocumento) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute([$primerNombre, $segundoNombre, $primerApellido, $segundoApellido, $correo, $usuario, $clave, $tipoDocumento, $numeroDocumento]);

    // Obtener el ID del registro insertado
    $idRegistro = $base_de_datos->lastInsertId();

    // Insertar datos en la tabla telefono
    $sqlTel = "INSERT INTO telefono (numeroTel, person) VALUES (?, ?)";
    $stmtTel = $base_de_datos->prepare($sqlTel);
    $stmtTel->execute([$numeroTel, $idRegistro]);

    // Insertar datos en la tabla rol_registro
    $sqlRolReg = "INSERT INTO rol_registro (idROL, idRegistro) VALUES (?, ?)";
    $stmtRolReg = $base_de_datos->prepare($sqlRolReg);
    $stmtRolReg->execute([$rol, $idRegistro]);

    // Obtener la descripción del rol
    $sqlRoleDesc = "SELECT Roldescripcion FROM rol WHERE id = ?";
    $stmtRoleDesc = $base_de_datos->prepare($sqlRoleDesc);
    $stmtRoleDesc->execute([$rol]);
    $rolDescripcion = $stmtRoleDesc->fetchColumn();

    // Confirmar la transacción
    $base_de_datos->commit();

} catch (Exception $e) {
    // En caso de error, deshacer la transacción
    $base_de_datos->rollBack();
    die("Error: " . $e->getMessage());
} finally {
    // Cerrar la conexión
    $base_de_datos = null;
}

// Redirigir según el rol
switch ($rolDescripcion) {
    case 'admi':
        header("Location: ../SETS/admi/BIENVENIDOADMI.php");
        break;
    case 'residente':
        header("Location: ../SETS/residente/BIENVENIDORESIDENTE.php");
        break;
    case 'administrador':
        header("Location: ../SETS/administrador/BIENVENIDOADMINISTRADOR.php");
        break;
    case 'Guarda de Seguridad':
        header("Location: ../SETS/seguridad/BIENVENIDOGUARDA.php");
        break;
    default:
        header("Location: default_view.php");
        break;
}

exit();

?>
