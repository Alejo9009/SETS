<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pagos</title>
    <link rel="stylesheet" href="css/notificaciones.css">
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <div class="topbar">
            <div class="menu-left">
                <div class="admin-container">
                    <img src="img/ajustes.png" alt="Admin" class="admin-img">
                    <a  class="menu-button">Admin</a>
                    <div class="dropdown-menu">
                        <a href="Perfil.html">Editar datos</a>
                        <a href="#">Reportar problema</a>
                        <a href="index.html">Cerrar sesión</a>
                    </div>
                </div>
                <a href="notificaciones.html">
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
                            <a href="#" class="chat-item" onclick="openChat('GUARDA DE SEGURIDAD')">GUARDA DE
                                SEGURIDAD</a>
                            <a href="#" class="chat-item" onclick="openChat('Chat Comunal')">Chat Comunal</a>
                            <a href="#" class="chat-item" onclick="openChat('Residente')">Residente</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        </div>
        </header>
        </div>
        </header>

        <main>
            <div class="main">
                <aside class="sidebar">
                    <div class="menu">
                        <a href="#" class="menu-item">Recibidos</a>
                        <a href="#" class="menu-item">guardados</a>
                        <a href="#" class="menu-item">Borradores</a>
                        <a href="#" class="menu-item">Papelera</a>
                        <a href="inicioprincipal.html" class="menu-item">volver</a>
                    </div>
                </aside>
                <section class="content">
                    <div class="email-list">
                        <div class="barra">
                            <div class="sombra"></div>
                            <input type="text" placeholder="Buscar notificacion...">
                            <ion-icon name="search-outline"></ion-icon>
                        </div>
                        <script type="module"
                            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

                        <div class="email-item">
                            <div class="email-sender">Administración</div>
                            <div class="email-subject">Mantenimiento Programado</div>
                            <div class="email-snippet">Se llevará a cabo mantenimiento en el sistema de agua el 22 de
                                agosto de 2024.</div>
                        </div>

                        <div class="email-item">
                            <div class="email-sender">Comité de Seguridad</div>
                            <div class="email-subject">Reunión de Seguridad</div>
                            <div class="email-snippet">Reunión para discutir nuevas medidas de seguridad el 25 de agosto
                                a las 18:00.</div>
                        </div>

                        <div class="email-item">
                            <div class="email-sender">Junta de Condominio</div>
                            <div class="email-subject">Nuevo Reglamento</div>
                            <div class="email-snippet">Se ha actualizado el reglamento del condominio. Por favor, revisa
                                los cambios en el portal.</div>
                        </div>

                        <div class="email-item">
                            <div class="email-sender">Mantenimiento</div>
                            <div class="email-subject">Problema de Fontanería</div>
                            <div class="email-snippet">Hay un problema de fontanería en la Torre A. Se espera resolución
                                para el 20 de agosto.</div>
                        </div>

                        <div class="email-item">
                            <div class="email-sender">Eventos Sociales</div>
                            <div class="email-subject">Fiesta de Verano</div>
                            <div class="email-snippet">¡No te pierdas la fiesta de verano el 30 de agosto en el área de
                                BBQ!</div>
                        </div>

                        <div class="email-item">
                            <div class="email-sender">Administración</div>
                            <div class="email-subject">Actualización de Horarios</div>
                            <div class="email-snippet">Los horarios de recepción se han actualizado. Consulta los nuevos
                                horarios en el portal.</div>
                        </div>

                        <div class="email-item">
                            <div class="email-sender">Servicios Generales</div>
                            <div class="email-subject">Corte de Energía Programado</div>
                            <div class="email-snippet">Habrá un corte de energía el 15 de agosto de 2024 entre las 10:00
                                y 14:00.</div>
                        </div>

                        <div class="email-item">
                            <div class="email-sender">Área Verde</div>
                            <div class="email-subject">Cuidado de Jardines</div>
                            <div class="email-snippet">El mantenimiento de jardines en el área común se realizará el 23
                                de agosto.</div>
                        </div>

                        <div class="email-item">
                            <div class="email-sender">Reparaciones</div>
                            <div class="email-subject">Reparación de Ascensores</div>
                            <div class="email-snippet">Se está reparando el ascensor de la Torre B. Se espera finalizar
                                el 18 de agosto.</div>
                        </div>




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