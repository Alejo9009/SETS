<?php
include 'conexionn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opcion = $_POST['opcion'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    // Verficar si ya hay una cita asignada para esa fecha y hora
    $sql = "SELECT * FROM citas WHERE fecha = :fecha AND hora = :hora LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['fecha' => $fecha, 'hora' => $hora]);
    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cita != false) {
        echo "La fecha no esta disponible";
    }else{
        // Reservar la cita
        $sql = "INSERT INTO citas (opcion, fecha, hora) VALUES (:opcion, :fecha, :hora)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute(['opcion' => $opcion, 'fecha' => $fecha, 'hora' => $hora])) {
            echo "Cita solicitada exitosamente.";
        } else {
            echo "Error al solicitar la cita.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedir Cita</title>
    <link rel="stylesheet" href="css/ver.css">
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

    <h1>Pedir Cita</h1>
    <form action="" method="post">
        <label for="opcion">Tipo de cita:</label>
        <select name="opcion" id="opcion">
            <option selected value="Administrativo">Administrativo (1h)</option>
            <option value="Reclamo">Reclamo (40min)</option>
            <option value="Duda">Duda (30min)</option>
        </select>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required step="3600" min="08:00" max="17:00">

        <button type="submit">Solicitar Cita</button>
    </form>
    <a href="administrar_u.php">Administrar Citas</a>
    <a href="citas.php">Volver</a>
    <script src="./ver.js"></script>
</body>
</html>
