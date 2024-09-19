<?php
include 'conexionn.php';

// Para respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['responder'])) {
    $id = $_POST['id'];
    $respuesta = $_POST['respuesta'];

    // Ya al tener una respuesta y actualizar
    $sql = "UPDATE citas SET respuesta = :respuesta, estado = 'respondida' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['respuesta' => $respuesta, 'id' => $id])) {
        echo "Respuesta enviada exitosamente.";
    } else {
        echo "Error al enviar la respuesta.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['delete_id'];

    // Borrar una cita
    $sql = "DELETE FROM citas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['id' => $id])) {
        
    } else {
        echo "Error al eliminar la cita.";
    }
}

// Tener las citas
$sql = "SELECT * FROM citas";
$stmt = $pdo->query($sql);
$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Citas</title>
    <link rel="stylesheet" href="css/administrar.css">
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

    <h1>Administrar Citas</h1>

    <table>
        <thead>
            <tr>
                <th>Caracter</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Respuesta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($citas as $cita): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cita['opcion']); ?></td>
                    <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                    <td><?php echo htmlspecialchars($cita['estado']); ?></td>
                    <td><?php echo htmlspecialchars($cita['respuesta']); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $cita['id']; ?>">Editar</a>

                        <form action="" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cita?');">
                            <input type="hidden" name="delete_id" value="<?php echo $cita['id']; ?>">
                            <button type="submit" name="delete">Eliminar</button>
                        </form>
                    </td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="ver.php">Volver</a>
</body>
</html>
