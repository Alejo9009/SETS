<?php

include_once "conexion.php";

try {

    $idRol = $_POST['idRol'];
    $PrimerNombre = $_POST['PrimerNombre'];
    $SegundoNombre = $_POST['SegundoNombre'] ?? null;
    $PrimerApellido = $_POST['PrimerApellido'];
    $SegundoApellido = $_POST['SegundoApellido'] ?? null;
    $Correo = $_POST['Correo'];
    $Usuario = $_POST['Usuario'];
    $Clave = password_hash($_POST['Clave'], PASSWORD_BCRYPT); 
    $Id_tipoDocumento = $_POST['Id_tipoDocumento'];
    $numeroDocumento = $_POST['numeroDocumento'];
    $telefonoUno = $_POST['telefonoUno'];
    $telefonoDos = $_POST['telefonoDos'] ?? null;
    $rol = $_POST['rol'];

    $base_de_datos->beginTransaction();


    $sql = "INSERT INTO registro (idRol, PrimerNombre,SegundoNombre, PrimerApellido,SegundoApellido, Correo, Usuario, Clave, Id_tipoDocumento, numeroDocumento ,telefonoUno ,telefonoDos ) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute([$idRol, $PrimerNombre,$SegundoNombre, $PrimerApellido, $SegundoApellido, $Correo, $Usuario, $Clave, $Id_tipoDocumento, $numeroDocumento, $telefonoUno, $telefonoDos]);


    $id_Registro  = $base_de_datos->lastInsertId();

    $sqlRoleDesc = "SELECT Roldescripcion FROM rol WHERE id = ?";
    $stmtRoleDesc = $base_de_datos->prepare($sqlRoleDesc);
    $stmtRoleDesc->execute([$rol]);
    $rolDescripcion = $stmtRoleDesc->fetchColumn();

    $base_de_datos->commit();

} catch (Exception $e) {

    $base_de_datos->rollBack();
    die("Error: " . $e->getMessage());
} finally {
 
    $base_de_datos = null;
}


switch ($rolDescripcion) {
    case 'admin':
        header("Location: ../admin/BIENVENIDOADMI.php");
        break;
    case 'residente':
        header("Location: ../residente/BIENVENIDORESIDENTE.php");
        break;
    case 'Gestor de Imobiliaria':
        header("Location: ../gestor_inmobiliariar/BIENVENIDOADMINISTRADOR.php");
        break;
    case 'Guarda de Seguridad':
        header("Location: ../seguridad/BIENVENIDOGUARDA.php");
        break;
    default:
        header("Location: default_view.php");
        break;
}

exit();

?>
