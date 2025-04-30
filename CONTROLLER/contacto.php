
<?php
include_once "./conexion.php";
include_once "../MODEL/backend/contactarnos.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['nombre']) || empty($_POST['correo'])) {
        die("Faltan campos obligatorios");
    }

    try {
        $modelo = new ContactoModel($base_de_datos);
        $modelo->guardarContacto($_POST);

        echo "<script>
                alert('Contacto enviado con éxito.');
                window.location.href = '../VIEW/index.php';
              </script>";
    } catch (Exception $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
    }
}
?>