<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['ID_Apartamentooss'], $_POST['ID_zonaComun'], $_POST['fechainicio'], 
              $_POST['fechafinal'], $_POST['Hora_inicio'], $_POST['Hora_final'])) {
        die("Error: Datos incompletos.");
    }


    $ID_Apartamentooss = $_POST['ID_Apartamentooss'];
    $ID_zonaComun = $_POST['ID_zonaComun'];
    $fechainicio = $_POST['fechainicio'];
    $fechafinal = $_POST['fechafinal']; 
    $Hora_inicio = $_POST['Hora_inicio'];
    $Hora_final = $_POST['Hora_final'];


    $sql = "INSERT INTO solicitud_zona (ID_Apartamentooss, ID_zonaComun, fechainicio, fechafinal, Hora_inicio, Hora_final) 
            VALUES (:ID_Apartamentooss, :ID_zonaComun, :fechainicio, :fechafinal, :Hora_inicio, :Hora_final)";
    $stmt = $base_de_datos->prepare($sql);


    $stmt->bindParam(':ID_Apartamentooss', $ID_Apartamentooss, PDO::PARAM_STR);
    $stmt->bindParam(':ID_zonaComun', $ID_zonaComun, PDO::PARAM_INT);
    $stmt->bindParam(':fechainicio', $fechainicio, PDO::PARAM_STR);
    $stmt->bindParam(':fechafinal', $fechafinal, PDO::PARAM_STR);
    $stmt->bindParam(':Hora_inicio', $Hora_inicio, PDO::PARAM_STR);
    $stmt->bindParam(':Hora_final', $Hora_final, PDO::PARAM_STR);

  
    if ($stmt->execute()) {
        echo "<script>
                alert('Solicitud exitosa.');
                window.location.href = '../zonas_comunes.php';
              </script>";
    } else {
        echo "Error al agregar: " . $stmt->errorInfo();
    }
}
?>