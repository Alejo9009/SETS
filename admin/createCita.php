<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pagoPor = $_POST['pagoPor'];
    $cantidad = $_POST['cantidad'];
    $mediopago = $_POST['mediopago'];
    $apart = $_POST['apart'];
    $fechaPago = $_POST['fechaPago'];
    $referenciaPago = $_POST['referenciaPago'];
    $estado = $_POST['estado'];


    if (!empty($pagoPor) && !empty($cantidad) && !empty($mediopago) && !empty($apart) && !empty($fechaPago) && !empty($estado)) {

        $sql = "INSERT INTO pagos (pagoPor, cantidad, mediopago, apart, fechaPago, referenciaPago, estado) 
                VALUES (:pagoPor, :cantidad, :mediopago, :apart, :fechaPago, :referenciaPago, :estado)";
        $stmt = $base_de_datos->prepare($sql);


        $stmt->bindParam(':pagoPor', $pagoPor, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
        $stmt->bindParam(':mediopago', $mediopago, PDO::PARAM_STR);
        $stmt->bindParam(':apart', $apart, PDO::PARAM_STR);
        $stmt->bindParam(':fechaPago', $fechaPago, PDO::PARAM_STR);
        $stmt->bindParam(':referenciaPago', $referenciaPago, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);


        if ($stmt->execute()) {
            echo "<script style=text-align: center; font-size :30px;>
                    alert('Pago insertado con éxito.');
                    window.location.href = 'pagos.php'; // Redirige a la página principal
                  </script>";
        } else {
            echo "Error al insertar el pago: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Por favor, completa todos los campos obligatorios.";
    }
}
?>