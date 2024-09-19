<?php
// Incluye tu archivo de conexión a la base de datos
include('conexion.php');

// Obtener el ID del anuncio desde la URL
$idAnuncio = $_GET['idAnuncio'] ?? null;

if ($idAnuncio) {
    try {
        // Preparar y ejecutar la consulta para obtener el anuncio
        $sql = "SELECT * FROM anuncio WHERE idAnuncio = ?";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([$idAnuncio]);
        $anuncio = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error al obtener el anuncio: " . $e->getMessage();
        exit();
    }
}

// Manejo del formulario para actualizar el anuncio
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcionAnuncio'];
    $fecha = $_POST['fechaPublicacion'];
    $hora = $_POST['horaPublicacion'];
    $img_anuncio = $_POST['img_anuncio'];


    try {
        // Preparar y ejecutar la consulta para actualizar el anuncio
        $sql = "UPDATE anuncio SET titulo = ?, descripcionAnuncio = ?, fechaPublicacion = ?, horaPublicacion = ? ,img_anuncio  = ?   WHERE idAnuncio = ?";
        $stmt = $base_de_datos->prepare($sql);
        $stmt->execute([$titulo, $descripcion, $fecha, $hora, $img_anuncio   , $idAnuncio]);

        // Redirigir después de la actualización
        header("Location: inicioprincipal.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al actualizar el anuncio: " . $e->getMessage();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Anuncio</title>
    <link rel="stylesheet" href="css/actualizaranuncio.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
</head>
<body>
<header>
        <div class="topbar">
            <div class="menu-left">
                <img src="img/ajustes.png" alt="Admin" class="admin-img">
                <a href="#" class="menu-button">Admin</a>
                <div class="dropdown-menu">
                    <a href="Perfil.php">Editar datos</a>
                    <a href="#">Reportar problema</a>
                    <a href="index.html">Cerrar sesión</a>
                </div>
                <a href="notificaciones.php">
                    <img src="img/notificacion.png" alt="Notificaciones" class="notification">
                </a>
            </div>
            <div class="menu-right">
                <div class="chat">
                    <a class="menu-button"></a>
                    <img src="img/hablando.png" alt="Chat" class="chat-button" id="chatToggle">
                    <a href="#" class="menu-button"></a>

                    <img src="img/C.png" alt="Chat" class="chat-button">
                    <div class="chat-menu">
                        <div class="search-container">
                            <input type="text" placeholder="Buscar" class="search-bar" onkeyup="filterChat()">
                        </div>
                        <br>
                        <div class="chat-links">
                            <a href="#" class="chat-item" onclick="openChat('ADMINISTRADOR')">ADMINISTRADOR</a>
                            <a href="#" class="chat-item" onclick="openChat('GUARDA DE SEGURIDAD')">GUARDA DE SEGURIDAD</a>
                            <a href="#" class="chat-item" onclick="openChat('Chat Comunal')">Chat Comunal</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br><br>
    <main>
        <div id="chatContainer" class="chat-container">
            <div class="chat-header">
                <span id="chatHeader">Chat</span>
                <button class="close-btn" onclick="closeChat()">×</button>
            </div>
            <div class="chat-messages" id="chatMessages">
            </div>
            <div class="chat-input">
                <input type="text" id="chatInput" placeholder="Escribe tu mensaje...">
                <button onclick="sendMessage()">Enviar</button>
            </div>
        </div>
        </header>
    <main>
        <div class="container">
            <section class="login-content">
                <form action="actualizaranuncio.php?idAnuncio=<?php echo urlencode($idAnuncio); ?>" method="post" enctype="multipart/form-data">
                    <img src="img/anun.png" alt="Logo" class="imgp">
                    <h2 class="title">Actualizar Anuncio</h2>

                    <!-- Campo oculto para el ID del anuncio -->
                    <input type="hidden" name="idAnuncio" value="<?php echo htmlspecialchars($anuncio['idAnuncio'] ?? ''); ?>">

                    <div class="input-div one">
                        <h5>Título Del Anuncio</h5>
                        <input type="text" class="input" name="titulo" value="<?php echo htmlspecialchars($anuncio['titulo'] ?? ''); ?>" required>
                    </div>

                    <div class="input-div one">
                        <h5>Descripción Del Anuncio</h5>
                        <input type="text" class="input" name="descripcionAnuncio" value="<?php echo htmlspecialchars($anuncio['descripcionAnuncio'] ?? ''); ?>" required>
                    </div>

                    <div class="input-div one">
                        <h5>Fecha</h5>
                        <input type="date" class="input" name="fechaPublicacion" value="<?php echo htmlspecialchars($anuncio['fechaPublicacion'] ?? ''); ?>" required>
                    </div>

                    <div class="input-div one">
                        <h5>Hora</h5>
                        <input type="time" class="input" name="horaPublicacion" value="<?php echo htmlspecialchars($anuncio['horaPublicacion'] ?? ''); ?>" required>
                    </div>

  

                    <input type="submit" class="btn" value="Actualizar">
                    <a href="anuncios.php" class="btn small-btn">Volver</a>
                </form>
            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
