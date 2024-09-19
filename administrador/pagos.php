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
                        <img src="img/administrado.png" alt="Admin" class="admin-img">
                        <a href="#" class="menu-button">Administrador </a>
                        <ul class="dropdown-menu">
                            <li><a href="Perfil.html">Editar datos</a></li>
                            <li><a href="#">Reportar problema</a></li>
                            <li><a href="index.html">Cerrar sesión</a></li>
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
                                <a href="#" class="chat-item" onclick="openChat('ADMI')">ADMI</a>
                                <a href="#" class="chat-item" onclick="openChat('GUARDA DE SEGURIDAD')">GUARDA DE SEGURIDAD</a>
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