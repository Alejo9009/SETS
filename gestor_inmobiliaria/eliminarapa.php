<?php
if (!isset($_POST["id_Apartamento"])) {
    exit('Número del apartamento no proporcionado.');
}

$id_Apartamento = $_POST["id_Apartamento"];

include_once "conexion.php";

if (!$base_de_datos) {
    exit('Error en la conexión a la base de datos.');
}

$sql_eliminar_dependencias = "DELETE FROM piso_apto WHERE APTO = ?";
$sentencia_dependencias = $base_de_datos->prepare($sql_eliminar_dependencias);
$sentencia_dependencias->execute([$id_Apartamento]);


$sql = "DELETE FROM apartamento WHERE id_Apartamento = ?";
$sentencia = $base_de_datos->prepare($sql);

try {
    $resultado = $sentencia->execute([$id_Apartamento]);

    if ($resultado) {
        echo '
        <script>
            alert("El apartamento ha sido eliminado correctamente.");
            window.location.href = "pisos.php"; // Redirige a la página principal
        </script>';
    } else {
        echo '
        <script>
            alert("El apartamento NO pudo ser eliminado.");
            window.location.href = "pisos.php"; // Redirige en caso de error
        </script>';
    }
} catch (PDOException $e) {
    echo '
    <script>
        alert("Error al eliminar el apartamento: ' . $e->getMessage() . '");
        window.location.href = "pisos.php"; // Redirige en caso de error
    </script>';
}

$base_de_datos = null;
?>
