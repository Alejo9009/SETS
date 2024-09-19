<?php
include_once "conexion.php";

$query = isset($_GET['query']) ? $_GET['query'] : '';

// Preparar la consulta SQL con filtro
$sql = "SELECT id_Torre, numTorre, descripcionTorre FROM torre WHERE numTorre LIKE :query OR descripcionTorre LIKE :query";
$stmt = $base_de_datos->prepare($sql);
$stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
$stmt->execute();

$torre = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($torre) {
    foreach ($torre as $index => $torre) {
        ?>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <center>
                <div class="card">
                    <img src="img/yy.jpg" class="" alt="Imagen del apartamento" style="border: 3px solid #14c55e;">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($torre['numTorre']); ?></h5>
                        <h2 class="card-text"><?= htmlspecialchars($torre['descripcionTorre']); ?></h2><br>
                        <a href="pisos.php" style="font-size: 30px;" class="btn-custom">Pisos</a><br>
                    </div>
                </div>
            </center>
        </div>
        <?php
    }
} else {
    echo "<p>No se encontraron torres.</p>";
}
?>
