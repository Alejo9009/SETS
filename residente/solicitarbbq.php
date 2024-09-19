<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sets - BBQ</title>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon">
    <link rel="stylesheet" href="css/citas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <div class="topbar">
            <div class="menu-left">
                <img src="img/resi.png" alt="Admin" class="admin-img">
                <a href="#" class="menu-button">Residente</a>
                <div class="dropdown-menu">
                    <a href="Perfil.html">Editar datos</a>
                    <a href="#">Reportar problema</a>
                    <a href="index.html">Cerrar sesión</a>
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
    </main>

    <section class="anuncio">
        <center>
            <h2 style="color: rgb(8, 44, 14);">Horarios disponibles - Zona BBQ</h2>
        </center>
    </section>

    <div class="container">
        <div class="calendar-container">
            <div class="calendar">
                <h2>Calendario de disponiblidad</h2>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Lu</th>
                            <th>Ma</th>
                            <th>Mi</th>
                            <th>Ju</th>
                            <th>Vi</th>
                            <th>Sa</th>
                            <th>Do</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="highlight">1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                            <td>15</td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>20</td>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24</td>
                            <td class="highlight">25</td>
                        </tr>
                        <tr>
                            <td>26</td>
                            <td>27</td>
                            <td>28</td>
                            <td>29</td>
                            <td class="highlight">30</td>
                            <td>31</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="sidebar">
            <h2>Agendadas</h2>
            <br>
            <div class="barra">
                <div class="sombra"></div>
                <input type="text" placeholder="Buscar agendaciones...">
                <ion-icon name="search-outline"></ion-icon>
            </div>
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <br>
            <div class="appointment">
                <h3>BBQ</h3>
                <p>Fecha: 1/09/2024</p>
                <p>Hora: 12:00 PM</p>
                <p>Apartamento: 101</p>
                <p>Nombre Completo: María López</p>
                <p>Documento: 987654321</p>
                <p>Celular: 3022233445</p>
                <p>Correo: maria.lopez@example.com</p>
                <div class="buttons">
                    <button class="button accept">Aceptar</button>
                    <button class="button delete">Eliminar</button>
                    <button class="button pending">Pendiente</button>
                </div>
            </div>
            <div class="appointment">
                <h3>BBQ</h3>
                <p>Fecha: 30/09/2024</p>
                <p>Hora: 12:00 PM</p>
                <p>Apartamento: 101</p>
                <p>Nombre Completo: JUAN López</p>
                <p>Documento: 987654321</p>
                <p>Celular: 3022233445</p>
                <p>Correo: maria.lopez@example.com</p>
                <div class="buttons">
                    <button class="button accept">Aceptar</button>
                    <button class="button delete">Eliminar</button>
                    <button class="button pending">Pendiente</button>
                </div>
            </div>

        </div>
    </div>
    <a href="zonas_comunes.html" class="btn btn-success" style="font-size: 30px;">
        <center>VOLVER</center>
    </a>
    <script>
        document.querySelector('.admin-img').addEventListener('click', function () {
            document.querySelector('.dropdown-menu').classList.toggle('show')
        });

        document.querySelector('.chat-button').addEventListener('click', function () {
            document.querySelector('.chat-menu').classList.toggle('show')
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