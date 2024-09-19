<?php
include 'conexion.php';

// Condicion para ver el id
if (isset($_GET['citaID'])) {
    $citaID = $_GET['citaID'];

    // si si obtener esos datos
    $sql = "SELECT * FROM cita WHERE citaID = :citaID";
    $stmt = $base_de_datos->prepare($sql);
    $stmt->execute(['citaID' => $citaID]);
    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    // si no se encuentra
    if (!$cita) {
        echo "Cita no encontrada.";
        exit;
    }
} else {
    echo "ID de cita no especificado.";
    exit;
}

// actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AptoID = $_POST['AptoID'];
    $tipocita = $_POST['idTipoCita'];
    $fechacita = $_POST['fechacita'];
    $horacita = $_POST['horacita'];

    $sql = "UPDATE cita SET citaID  = :idTipoCita, fechacita = :fechacita, horacita = :horacita WHERE citaID = :citaID";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['tipocita' => $idTipoCita, 'fechacita' => $fechacita, 'horacita' => $horacita, 'citaID' => $citaID])) {
        echo "Cita actualizada exitosamente.";
        header("Location: administrar_u.php");
        exit;
    } else {
        echo "Error al actualizar la cita.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>

    <header>
        <nav class="topbar">
            <div class="menu-left">
                <img src="img/resi.jpg" alt="residente" class="admin-img">
                <a class="menu-button">residente</a>
                <ul class="dropdown-menu">
                    <a href="Perfil.html">Editar datos</a>
                    <a href="#">Reportar problema</a>
                    <a href="index.html">Cerrar sesión</a>
                </ul>
                <a href="notificaciones.html">
                    <img src="img/notificacion.png" alt="Notificaciones" class="notification">
                </a>
            </div>
            <div class="menu-right">
                <div class="chat">
                    <img src="img/hablando.png" alt="Chat" class="chat-button" id="chatToggle">
                    <img src="img/C.png" alt="Chat" class="chat-button">
                    <div class="chat-menu">
                        <div class="search-container">
                            <input type="text" placeholder="Buscar" class="search-bar" onkeyup="filterChat()">
                        </div>
                        <br>
                        <ul class="chat-links">
                            <a href="#" class="chat-item" onclick="openChat('ADMINISTRADOR')">ADMINISTRADOR</a>
                            <a href="#" class="chat-item" onclick="openChat('GUARDA DE SEGURIDAD')">GUARDA DE SEGURIDAD</a>
                            <a href="#" class="chat-item" onclick="openChat('Chat Comunal')">Chat Comunal</a>
                            <a href="#" class="chat-item" onclick="openChat('Residente')">Residente</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <h1>Editar Cita</h1>
    <form action="" method="post">

        <label for="tipocita">Tipo de cita:</label>
        <select id="tipocita" name="tipocita" required>
            <?php foreach ($idTipoCita as $descripcion): ?>
                <option value="<?php echo htmlspecialchars($tipo['idTipoCita']); ?>" 
                    <?php echo ($cita['idTipoCita'] == $tipo['descripcion']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($tipo['descripcion']); ?>
                </option>
            <?php endforeach; ?>
        </select>


        <label for="fechacita">Fecha:</label>
        <input type="date" id="fechacita" name="fechacita" value="<?php echo htmlspecialchars($cita['fechacita']); ?>" required>

        <label for="horacita">Hora:</label>
        <input type="time" id="horacita" name="horacita" value="<?php echo htmlspecialchars($cita['horacita']); ?>" required>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
