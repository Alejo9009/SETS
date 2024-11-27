<?php
if (!isset($_POST["titulo"])) {
    exit('Título del anuncio no proporcionado.');
}

$titulo = $_POST["titulo"]; // Asegúrate de que el título sea seguro para usar en la consulta

include_once "conexion.php";

// Verifica si la conexión a la base de datos se estableció correctamente
if (!$base_de_datos) {
    exit('Error en la conexión a la base de datos.');
}

// Preparar y ejecutar la consulta para eliminar el anuncio
$sql = "DELETE FROM anuncio WHERE titulo = ?";
$sentencia = $base_de_datos->prepare($sql);

if ($sentencia) {
    $resultado = $sentencia->execute([$titulo]);

    if ($resultado) {
        echo '
        <script>
            alert("El anuncio ha sido eliminado correctamente.");
            window.location.href = "inicioprincipal.php"; // Redirige a la página principal
        </script>';
    } else {
        echo '
        <script>
            alert("El anuncio NO pudo ser eliminado.");
            window.location.href = "inicioprincipal.php"; // Redirige en caso de error
        </script>';
    }
} else {
    echo '
    <script>
        alert("Error al preparar la consulta.");
        window.location.href = "inicioprincipal.php"; // Redirige en caso de error
    </script>';
}

$base_de_datos = null; // Cierra la conexión a la base de datos
?>
