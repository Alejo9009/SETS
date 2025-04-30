
<?php
require_once './conexion.php';
require_once '../MODEL/anuncios.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["accion"])) {
    $datos = [
        'titulo' => $_POST['titulo'],
        'descripcion' => $_POST['descripcion'],
        'fechaPublicacion' => $_POST['fechaPublicacion'],
        'horaPublicacion' => $_POST['horaPublicacion'],
        'persona' => $_POST['persona'],
        'img_anuncio' => $_POST['img_anuncio']
    ];

    if (crearAnuncio($base_de_datos, $datos)) {
        echo "<script>
                alert('Anuncio creado exitosamente.');
                window.location.href = '../VIEW/residente/inicioprincipal.php';
              </script>";
    } else {
        echo "Error al agregar el anuncio";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"]) && $_POST["accion"] == "eliminar") {
    $resultado = eliminarAnuncio($base_de_datos, $_POST["titulo"]);

    echo json_encode([
        'status' => $resultado ? 'success' : 'error',
        'message' => $resultado
            ? 'El anuncio ha sido eliminado correctamente.'
            : 'Error al eliminar el anuncio.'
    ]);
}
?>