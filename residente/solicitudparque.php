<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETS - PARQUEADERO-solicitar</title>
    <link rel="stylesheet" href="css/solictudparque.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
</head>
<body>
    <header>
        <nav>
            <div class="topbar">
                <div class="menu-left">
                    <div class="admin-container">
                        <img src="img/resi.png" alt="Admin" class="admin-img">
                        <a href="#" class="menu-button">Residente</a>
                        <ul class="dropdown-menu">
                            <a href="Perfil.html">Editar datos</a>
                            <a href="#">Reportar problema</a>
                            <a href="index.html">Cerrar sesión</a>
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
                            <div class="chat-links">
                                <a href="#" class="chat-item" onclick="openChat('Admi')">Admi</a>
                                <a href="#" class="chat-item" onclick="openChat('Administrador')">Administrador</a>
                                <a href="#" class="chat-item" onclick="openChat('Guarda De Seguridad')">Guarda DE Seguridad</a>
                                 <a href="#" class="chat-item" onclick="openChat('Chat Comunal')">Chat Comunal</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div id="chatContainer" class="chat-container">
            <div class="chat-header">
                <h2 id="chatHeader">Chat</h2>
                <button class="close-btn" onclick="closeChat()">×</button>
            </div>
            <div class="chat-messages" id="chatMessages">
            </div>
            <div class="chat-input">
                <input type="text" id="chatInput" placeholder="Escribe tu mensaje...">
                <button onclick="sendMessage()">Enviar</button>
            </div>
        </div>
        <div class="container">
            <div class="login-content">
                <form action="recuperar.html" method="post" enctype="multipart/form-data">
                    <img src="img/cocheEE.png" alt="Logo" class="imgp">
                    <h2 class="title">SOLICITAR PARQUEADERO DE CARRO</h2>
                    <div class="book-form">
                        <div class="page left-page">
                            <div class="form-group">
                                <label for="nombre">N Parqueadero:</label>
                                <input type="NUMBER" id="nombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="nombre">placaVehiculo:</label>
                                <input type="VARCHAR" id="nombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="nombre">modelo  Vehiculo:</label>
                                <input type="VARCHAR" id="nombre" name="nombre">
                            </div>

                            <div class="form-group">
                                <label for="nombre">TORRE:</label>
                                <input type="NUMBER" id="nombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="nombre">PISO:</label>
                                <input type="NUMBER" id="nombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="nombre">nombre completo:</label>
                                <input type="text" id="nombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="nombre">documento:</label>
                                <input type="NUMBER" id="nombre" name="nombre">
                            </div>
                       
                        </div>
                    </div>

                    <input type="submit" class="btn" value="actualizar" style="color: aliceblue;">
                    <a href="parqueaderocarro.html" class="btn small-btn" style="color: aliceblue;">VOLVER</a>
                </form>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="JAVA/main.js"></script>
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