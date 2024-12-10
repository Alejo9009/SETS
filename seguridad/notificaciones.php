<?php
include_once "conexion.php";
session_start();
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// Verificar si el usuario está logueado
if (!isset($_SESSION['Usuario'])) {
    header("Location: http://localhost/sets/login.php");
    exit();
}

// Obtener el nombre de usuario desde la sesión
$usuario = $_SESSION['Usuario']; // Se asume que 'Usuario' es el nombre de usuario que está en la sesión

// Consultar el nombre completo usando solo el campo 'Usuario'
$sqlUsuario = "SELECT Usuario FROM registro WHERE Usuario = :usuario";
$stmt = $base_de_datos->prepare($sqlUsuario);
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmt->execute();
$datosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar que el usuario existe
if ($datosUsuario) {
    $nombreUsuario = $datosUsuario['Usuario']; // Guardar solo el nombre de usuario
} else {
    // Si no se encuentra el usuario, redirigir a login
    header("Location: http://localhost/sets/login.php");
    exit();
}

// Redirigir si no es residente
$sqlRol = "SELECT idRol FROM registro WHERE Usuario = :usuario";
$stmtRol = $base_de_datos->prepare($sqlRol);
$stmtRol->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmtRol->execute();
$datosRol = $stmtRol->fetch(PDO::FETCH_ASSOC);

if ($datosRol['idRol'] != 3) { // Solo si el rol es "residente" (idRol == 4)
    header("Location: http://localhost/sets/error.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETS - NOTIFICACIONES</title>
    <link rel="stylesheet" href="css/notificaciones.css?v=<?php echo (rand()); ?>">
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
<body>
    <header>
        <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid" style="background-color: #0e2c0a;">
            <img src="img/guarda.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;">
            <b style="font-size: 40px;color:aliceblue"> Guarda de Seguridad - <?php echo htmlspecialchars($nombreUsuario); ?> </b></a>
             <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" style="background-color: white;">
                    <span class="navbar-toggler-icon" style="color: white;"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <img src="img/C.png" alt="Logo" width="90" height="94" class="d-inline-block align-text-top">
                        <center>
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="text-align: center;">SETS</h5>
                        </center>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <center><a class="nav-link active" aria-current="page" href="#" style="font-size: 20px;"><b>Inicio</b></a></center>
                            </li>
                            <center>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <b style="font-size: 20px;"> Perfil</b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <center><a href="Perfil.php">Editar Datos</a></center>
                                        </li> 
                                        <li>
                                        <center> <a href="../backend/logout.php">Cerrar sesión</a></center>
                                        </li>
                                    </ul>
                            </center>
                            </li>
                            <div class="offcanvas-header">
                                <img src="img/notificacion.png" alt="Logo" width="70" height="74" class="d-inline-block align-text-top">
                                <center>
                                    <a href="notificaciones.php" class="btn" id="offcanvasNavbarLabel" style="text-align: center;">Notificaciones</a>
                                </center>
                            </div>
                            <center>
                                <li class="nav-item dropdown">
                                    <img src="img/hablando.png" alt="Logo" width="30" height="44" class="d-inline-block align-text-top" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <b style="font-size: 20px;"> CHAT</b>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <center><a href="#" class="chat-item" onclick="openChat('Admin')">Admin</a></center>
                                        </li>
                                        <li>
                                            <center><a href="#" class="chat-item" onclick="openChat('Gestor de Imobiliaria')">Gestor de Imobiliaria</a></center>
                                        </li>
                                        <li>
                                            <center><a href="#" class="chat-item" onclick="openChat('Residente')">Residente</a></center>
                                        </li>
                                        <li>
                                            <center><a href="#" class="chat-item" onclick="openChat('Chat Comunal')">Chat Comunal</a></center>
                                        </li>
                                    </ul>
                            </center>
                        </ul>
                        <form class="d-flex mt-3" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div id="chatContainer" class="chat-container z-3 position-fixed p-5 rounded-3">
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
        </div>
        </header>
        </div>
        </header>
        <br><br>
        <br><br>
        <br> <br>
        <br> <br> <br>
        <main>
            <div class="main">
                <aside class="sidebar">
                    <div class="menu">
                        <a href="#" class="menu-item">Recibidos</a>
                        <a href="#" class="menu-item">Guardados</a>
                        <a href="#" class="menu-item">Borradores</a>
                        <a href="#" class="menu-item">Papelera</a>
                        <a href="inicioprincipal.php" class="menu-item">Volver</a>
                    </div>
                </aside>
                <section class="content">
                    <div class="email-list">
                        <div class="barra">
                            <div class="sombra"></div>
                            <input type="text" id="searchInput" placeholder="Buscar notificación..." onkeyup="filterEmails()">
                            <ion-icon name="search-outline"></ion-icon>
                        </div>
                        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
                        <div class="email-item">
                            <div class="email-sender">Administración</div>
                            <div class="email-subject">Mantenimiento Programado</div>
                            <div class="email-snippet">Se llevará a cabo mantenimiento en el sistema de agua el 22 de agosto de 2024.</div>
                        </div>
                        <div class="email-item">
                            <div class="email-sender">Comité de Seguridad</div>
                            <div class="email-subject">Reunión de Seguridad</div>
                            <div class="email-snippet">Reunión para discutir nuevas medidas de seguridad el 25 de agosto a las 18:00.</div>
                        </div>
                        <div class="email-item">
                            <div class="email-sender">Junta de Condominio</div>
                            <div class="email-subject">Nuevo Reglamento</div>
                            <div class="email-snippet">Se ha actualizado el reglamento del condominio. Por favor, revisa los cambios en el portal.</div>
                        </div>
                        <div class="email-item">
                            <div class="email-sender">Mantenimiento</div>
                            <div class="email-subject">Problema de Fontanería</div>
                            <div class="email-snippet">Hay un problema de fontanería en la Torre A. Se espera resolución para el 20 de agosto.</div>
                        </div>
                        <div class="email-item">
                            <div class="email-sender">Eventos Sociales</div>
                            <div class="email-subject">Fiesta de Verano</div>
                            <div class="email-snippet">¡No te pierdas la fiesta de verano el 30 de agosto en el área de BBQ!</div>
                        </div>
                        <div class="email-item">
                            <div class="email-sender">Administración</div>
                            <div class="email-subject">Actualización de Horarios</div>
                            <div class="email-snippet">Los horarios de recepción se han actualizado. Consulta los nuevos horarios en el portal.</div>
                        </div>
                        <div class="email-item">
                            <div class="email-sender">Servicios Generales</div>
                            <div class="email-subject">Corte de Energía Programado</div>
                            <div class="email-snippet">Habrá un corte de energía el 15 de agosto de 2024 entre las 10:00 y 14:00.</div>
                        </div>
                        <div class="email-item">
                            <div class="email-sender">Área Verde</div>
                            <div class="email-subject">Cuidado de Jardines</div>
                            <div class="email-snippet">El mantenimiento de jardines en el área común se realizará el 23 de agosto.</div>
                        </div>
                        <div class="email-item">
                            <div class="email-sender">Reparaciones</div>
                            <div class="email-subject">Reparación de Ascensores</div>
                            <div class="email-snippet">Se está reparando el ascensor de la Torre B. Se espera finalizar el 18 de agosto.</div>
                        </div>
                    </div>
                </section>
                <script>
                    function filterEmails() {
                        // Obtener el valor del input de búsqueda y convertirlo a minúsculas
                        let searchValue = document.getElementById('searchInput').value.toLowerCase();

                        // Obtener todos los elementos con la clase 'email-item'
                        let emailItems = document.querySelectorAll('.email-item');

                        // Recorrer cada elemento de la lista
                        emailItems.forEach(item => {
                            // Obtener el texto del remitente, asunto y descripción
                            let sender = item.querySelector('.email-sender').textContent.toLowerCase();
                            let subject = item.querySelector('.email-subject').textContent.toLowerCase();
                            let snippet = item.querySelector('.email-snippet').textContent.toLowerCase();

                            if (sender.includes(searchValue) || subject.includes(searchValue) || snippet.includes(searchValue)) {
                                item.style.display = ''; 
                            } else {
                                item.style.display = 'none'; 
                            }
                        });
                    }
                </script>
                <script>
                    document.querySelector('.admin-img').addEventListener('click', function() {
                        document.querySelector('.dropdown-menu').classList.toggle('show');
                    });

                    document.querySelector('.chat-button').addEventListener('click', function() {
                        document.querySelector('.chat-menu').classList.toggle('show');
                    });

                    function filterChat() {
                        const searchInput = document.querySelector('.search-bar').value.toLowerCase();
                        const chatItems = document.querySelectorAll('.chat-item');
                        chatItems.forEach(item => {
                            if (item.textContent.toLowerCase().includes(searchInput)) {
                                item.style.display = 'block';
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    }
                    function showTab(tabId) {
                        document.querySelectorAll('.tab-content').forEach(tab => {
                            tab.classList.remove('active');
                        });
                        document.querySelectorAll('.tab-btn').forEach(btn => {
                            btn.classList.remove('active');
                        });
                        document.getElementById(tabId).classList.add('active');
                        document.querySelector(`.tab-btn[onclick="showTab('${tabId}')"]`).classList.add('active');
                    }
                </script>
                <script>
                    function openChat(chatName) {
                        const chatContainer = document.getElementById('chatContainer');
                        const chatHeader = document.getElementById('chatHeader');
                        chatHeader.textContent = chatName;
                        chatContainer.classList.add('show');
                    }

                    function closeChat() {
                        const chatContainer = document.getElementById('chatContainer');
                        chatContainer.classList.remove('show');
                    }
                    function sendMessage() {
                        const messageInput = document.getElementById('chatInput');
                        const messageText = messageInput.value.trim();
                        if (messageText) {
                            const chatMessages = document.getElementById('chatMessages');
                            const messageElement = document.createElement('p');
                            messageElement.textContent = messageText;
                            chatMessages.appendChild(messageElement);
                            messageInput.value = '';
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                        }
                    }
                    function filterChat() {
                        const searchInput = document.querySelector('.search-bar').value.toLowerCase();
                        const chatItems = document.querySelectorAll('.chat-item');
                        chatItems.forEach(item => {
                            if (item.textContent.toLowerCase().includes(searchInput)) {
                                item.style.display = 'block';
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    }
                </script>
                <script
                    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
                </script>
            </div>
</body>

</html>