<?php
require '../backend/authMiddleware.php';
session_start();
header("Access-Control-Allow-Origin: http://localhost:3000");  
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");  
$decoded = authenticate();

$idRegistro = $decoded->id;
$Usuario = $decoded->Usuario; 
$idRol = $decoded->idRol;

if ($idRol != 3333) { 
    header("Location: http://localhost/sets/error.php");
    exit();
}

include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPagos = $_POST['idPagos'];
    $nuevoEstado = $_POST['nuevoEstado'];

    if (!empty($idPagos) && !empty($nuevoEstado)) {
      
        $sql = "UPDATE pagos SET estado = :nuevoEstado WHERE idPagos = :idPagos";
        $stmt = $base_de_datos->prepare($sql);

        $stmt->bindParam(':nuevoEstado', $nuevoEstado, PDO::PARAM_STR);
        $stmt->bindParam(':idPagos', $idPagos, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Estado del pago actualizado correctamente.');
                    window.location.href = 'pagos.php'; // Redirige a la página de pagos
                  </script>";
        } else {
            echo "Error al actualizar el estado del pago: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Datos incompletos.";
    }
}
?>