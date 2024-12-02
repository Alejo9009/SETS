<?php
include_once "conexion.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $pagoPor = $_POST['pagoPor'];
    $cantidad = $_POST['cantidad'];


    if (!empty($pagoPor) && !empty($cantidad) ) {


        $sql = "INSERT INTO  pagos (pagoPor, cantidad ) VALUES (:pagoPor, :cantidad)";
        $stmt = $base_de_datos->prepare($sql);


        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $base_de_datos->errorInfo());
        }

        $stmt->bindParam(':pagoPor', $pagoPor, PDO::PARAM_STR);
        $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);


        if ($stmt->execute()) {
            echo "<script>
                    alert('Pago Insertado  con éxito.');
                    window.location.href = 'pagos.php'; // Redirige a la página principal u otra página
                  </script>";
        } else {
            echo "Error al enviar el contacto: " . $stmt->errorInfo();
        }
    } else {
        echo "Por favor completa todos los campos.";
    }
}
?>
