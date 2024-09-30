<?php
session_start();
include_once "conexion.php";

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: ../SETS/login.php");
    exit();
}

// Recuperar datos del formulario
$numTorre = $_POST['numTorre'];
$descripcionTorre = $_POST['descripcionTorre'];
$piso = $_POST['piso'];
$apartamento = $_POST['apartamento'];

// Iniciar una transacción
$base_de_datos->beginTransaction();

try {
    // Insertar en la tabla TORRE

    // Insertar en la tabla TORRE_PISO
    $sqlTorrePiso = "INSERT INTO TORRE_PISO (pisoid, Torreid) VALUES (?, ?)";
    $stmtTorrePiso = $base_de_datos->prepare($sqlTorrePiso);
    $stmtTorrePiso->execute([$piso, $torreId]);

    // Insertar en la tabla PISO_APTO
    $sqlPisoApto = "INSERT INTO PISO_APTO (PISO, APTO) VALUES (?, ?)";
    $stmtPisoApto = $base_de_datos->prepare($sqlPisoApto);
    $stmtPisoApto->execute([$piso, $apartamento]);

    // Confirmar la transacción
    $base_de_datos->commit();
    echo "Datos insertados correctamente.";
} catch (Exception $e) {
    // Deshacer la transacción en caso de error
    $base_de_datos->rollBack();
    echo "Error al insertar datos: " . $e->getMessage();
}
?>
