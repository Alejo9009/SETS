
<?php
include_once './conexion.php';
include_once '../MODEL/backend/authMiddleware.php';
include_once '../MODEL/pagos.php';

session_start();
header("Access-Control-Allow-Origin: http://localhost:3000");  
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");


$decoded = authenticate();
$idRol = $decoded->idRol;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['pagoPor'])) {
        $datos = [
            ':pagoPor' => $_POST['pagoPor'],
            ':cantidad' => $_POST['cantidad'],
            ':mediopago' => $_POST['mediopago'],
            ':apart' => $_POST['apart'],
            ':fechaPago' => $_POST['fechaPago'],
            ':referenciaPago' => $_POST['referenciaPago'] ?? null,
            ':estado' => $_POST['estado']
        ];
        
        if (crearPago($base_de_datos, $datos)) {
            header("Location: ../VIEW/admin/pagos.php?mensaje=creado_exito");
        } else {
            header("Location: ../VIEW/admin/pagos.php?mensaje=creado_error");
        }
        exit();
    }
    
   
    if (isset($_POST['idPagos']) && isset($_POST['nuevoEstado'])) {
        if (!verificarPermisosAdmin($idRol)) {
            header("Location: ../VIEW/admin/pagos.php");
            exit();
        }
        
        if (actualizarEstadoPago($base_de_datos, $_POST['idPagos'], $_POST['nuevoEstado'])) {
            header("Location: ../VIEW/admin/pagos.php?mensaje=estado_actualizado");
        } else {
            header("Location: ../VIEW/admin/pagos.php?mensaje=estado_error");
        }
        exit();
    }
}

header("Location: ../VIEW/admin/pagos.php");
exit();
?>