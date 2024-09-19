<?php
include_once "conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Apartament = $_POST['ID_Apartament'];
    $ID_zonaComun = $_POST['ID_zonaComun'];
    $fechaInicio = $_POST['fechainicio'];
    $fechaFinal = $_POST['fechaFinal'];
    $Hora_inicio = $_POST['Hora_inicio'];
    $Hora_final = $_POST['Hora_final'];

 

    $sql = "INSERT INTO solicitud_zona (ID_Apartament, ID_zonaComun , fechainicio,  fechaFinal, Hora_inicio, Hora_final)  VALUES (:ID_Apartament, :ID_zonaComun, :fechainicio, :fechaFinal, :Hora_inicio, :Hora_final)";
    $stmt = $base_de_datos->prepare($sql);

    var_dump($stmt);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $base_de_datos->errorInfo());
    }
    $stmt->bindParam(':ID_Apartament', $ID_Apartament, PDO::PARAM_INT);
    $stmt->bindParam(':ID_zonaComun', $ID_zonaComun, PDO::PARAM_INT);
    $stmt->bindParam(':fechainicio', $fechaInicio, PDO::PARAM_STR);
    $stmt->bindParam(':fechaFinal', $fechaFinal, PDO::PARAM_STR);
    $stmt->bindParam(':Hora_inicio', $Hora_inicio, PDO::PARAM_STR);
    $stmt->bindParam(':Hora_final', $Hora_final, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "<script>
                alert('solicitud exitosa.');
                window.location.href = 'zonas_comunes.php';
              </script>";
    } else {
        echo "Error al agregar: " . $stmt->errorInfo();
    }
   
    //$base_de_datos->Close();
}


