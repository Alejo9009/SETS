<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_message'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $torre = $_POST['torre'];
    $apartamento = $_POST['apartamento'];
    $anuncio = $_POST['anuncio'];

    try {
        // Consulta
        $sql = "UPDATE anuncio SET nombre = :nombre, torre = :torre, apartamento = :apartamento, anuncio = :anuncio WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        // Con parametros ejecutarla
        $stmt->execute([
            'nombre' => $nombre,
            'torre' => $torre,
            'apartamento' => $apartamento,
            'anuncio' => $anuncio,
            'id' => $id
        ]);

        // Redirijir
        header('Location: index.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Obtener los datos
$id = $_GET['id'];
try {
    $sql = "SELECT * FROM anuncio WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $message = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Anuncio</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Editar Mensaje</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $message['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($message['nombre']); ?>" required>
        <label for="torre">Torre:</label>
        <input type="text" id="torre" name="torre" value="<?php echo htmlspecialchars($message['torre']); ?>" required>
        <label for="apartamento">Apartamento:</label>
        <input type="text" id="apartamento" name="apartamento" value="<?php echo htmlspecialchars($message['apartamento']); ?>" required>
        <label for="anuncio">Anuncio:</label>
        <textarea id="anuncio" name="anuncio" required><?php echo htmlspecialchars($message['anuncio']); ?></textarea>
        <button type="submit" name="update_message">Actualizar anuncio</button>
    </form>
</body>
</html>

<?php
// Cerrar la conexión PDO (opcional)
$pdo = null;
?>
