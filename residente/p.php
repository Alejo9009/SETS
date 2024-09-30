<?php
include_once "conexion.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir valores seleccionados del formulario
    $torre_id = $_POST['torre'];
    $piso_id = $_POST['piso'];
    $apto_id = $_POST['apartamento'];

    // Conectar a la base de datos
    require 'conexion.php'; // tu archivo de conexión PDO

    try {
        // Iniciar la transacción
        $pdo->beginTransaction();

        // Insertar en la tabla registro_torre si es necesario
        $stmt = $base_de_datos->prepare("INSERT INTO registro_torre (idTorre) VALUES (?)");
        $stmt->execute([$torre_id]);

        // Insertar en la tabla torre_piso si es necesario
        $stmt = $base_de_datos->prepare("INSERT INTO torre_piso (idPiso, idTorre) VALUES (?, ?)");
        $stmt->execute([$piso_id, $torre_id]);

        // Insertar en la tabla piso_apto si es necesario
        $stmt = $base_de_datos->prepare("INSERT INTO piso_apto (idApto, idPiso) VALUES (?, ?)");
        $stmt->execute([$apto_id, $piso_id]);

        // Confirmar la transacción
        $pdo->commit();

        echo "Registro guardado exitosamente.";
    } catch (Exception $e) {
        // En caso de error, hacer rollback
        $pdo->rollBack();
        echo "Error al guardar el registro: " . $e->getMessage();
    }
}
?>
