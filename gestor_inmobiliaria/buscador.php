<?php
// Conectar a la base de datos
require 'conexion.php'; // Asegúrate de tener el archivo de conexión a la base de datos

$query = isset($_GET['query']) ? $_GET['query'] : '';

// Preparar la consulta SQL
$sql = "SELECT * FROM anuncio WHERE titulo LIKE :query";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    foreach ($results as $row) {
        ?>
        <div class="announcement">
            <img src="<?= htmlspecialchars($row['img_anuncio']); ?>" alt="Imagen del anuncio" style="width:100%; max-width:100px;">
            <p>Anuncio: <?= htmlspecialchars($row["titulo"]); ?><br>
                <?= htmlspecialchars($row["descripcionAnuncio"]); ?><br>
                Fecha de Publicación: <?= htmlspecialchars($row["fechaPublicacion"]); ?><br>
                Hora de Publicación: <?= htmlspecialchars($row["horaPublicacion"]); ?><br>
            </p>
            <form action="eliminaranuncio.php" method="POST" onsubmit="return confirm('¿Está seguro de que desea eliminar este anuncio?');">
                <input type="hidden" name="titulo" value="<?= htmlspecialchars($row['titulo']); ?>">
                <button type="submit">Eliminar</button>
            </form>
        </div>
        <?php
    }
} else {
    echo "<p>No se encontraron anuncios.</p>";
}
?>