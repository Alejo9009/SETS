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

if ($datosRol['idRol'] != 2) { // Solo si el rol es "residente" (idRol == 4)
    header("Location: http://localhost/sets/error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pagos</title>
    <link rel="stylesheet" href="css/pagos.css">
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav>
            <div class="topbar">
                <div class="menu-left">
                    <div class="admin-container">
                    <img src="img/administrado.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;">
                    <b style="font-size: 40px;color:aliceblue"> Gestor de inmobiliaria - <?php echo htmlspecialchars($nombreUsuario); ?> </b></a><ul class="dropdown-menu">
                            <li><a href="Perfil.html">Editar datos</a></li>
                            <center> <a href="../backend/logout.php">Cerrar sesión</a></center>

                        </ul>
                    </div>
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
                                <a href="#" class="chat-item" onclick="openChat('ADMI')">Admin</a>
                                <a href="#" class="chat-item" onclick="openChat('GUARDA DE SEGURIDAD')">Guarda de seguridad</a>
                                <a href="#" class="chat-item" onclick="openChat('Residente')">Residente</a>
                              <a href="#" class="chat-item" onclick="openChat('Chat Comunal')">Chat Comunal</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
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
        <div class="payments-container">
            <center><h1 class="yo">Formulario de Pagos</h1></center>
            <br>
            <br>
            <div class="payment-areas">
                <section class="payment-table-container">
                    <center><h2>Pagos Realizados</h2></center>
                    <div class="search-bar-container">
                        <div class="barra">
                            <div class="sombra"></div>
                            <input type="text" placeholder="Buscar pagos...">
                            <ion-icon name="search-outline"></ion-icon>
                        </div>
                        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Pago</th>
                                <th>Tipo de Notificación</th>
                                <th>Valor Pago</th>
                                <th>Fecha de Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Notificación 1</td>
                                <td>$1000</td>
                                <td>2024-08-01 10:00:00</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Notificación 2</td>
                                <td>$500</td>
                                <td>2024-08-10 14:30:00</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Notificación 2</td>
                                <td>$500</td>
                                <td>2024-08-10 14:30:00</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Notificación 2</td>
                                <td>$500</td>
                                <td>2024-08-10 14:30:00</td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Notificación 3</td>
                                <td>$1500</td>
                                <td>2024-08-20 09:00:00</td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>Notificación 4</td>
                                <td>$800</td>
                                <td>2024-08-25 16:00:00</td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Notificación 3</td>
                                <td>$1500</td>
                                <td>2024-08-20 09:00:00</td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>Notificación 4</td>
                                <td>$800</td>
                                <td>2024-08-25 16:00:00</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="payment-table-container">
                    <center><h2>Pagos Pendientes</h2></center>
                    <div class="search-bar-container">
                        <div class="barra">
                            <div class="sombra"></div>
                            <input type="text" placeholder="Buscar pagos...">
                            <ion-icon name="search-outline"></ion-icon>
                        </div>
                        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Pago</th>
                                <th>Tipo de Notificación</th>
                                <th>Valor Pago</th>
                                <th>Fecha de Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>003</td>
                                <td>Notificación 3</td>
                                <td>$1500</td>
                                <td>2024-08-20 09:00:00</td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>Notificación 4</td>
                                <td>$800</td>
                                <td>2024-08-25 16:00:00</td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Notificación 3</td>
                                <td>$1500</td>
                                <td>2024-08-20 09:00:00</td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>Notificación 4</td>
                                <td>$800</td>
                                <td>2024-08-25 16:00:00</td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Notificación 3</td>
                                <td>$1500</td>
                                <td>2024-08-20 09:00:00</td>
                            </tr>
                            <tr>
                                <td>004</td>
                                <td>Notificación 4</td>
                                <td>$800</td>
                                <td>2024-08-25 16:00:00</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </main>
    <a href="perfil.html" class="btn btn-success" style="font-size: 30px;">
        <center>VOLVER</center>
    </a>
    <script>
        document.querySelector('.admin-img').addEventListener('click', function () {
            document.querySelector('.dropdown-menu').classList.toggle('show');
        });

        document.querySelector('.chat-button').addEventListener('click', function () {
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
</body>
</html>