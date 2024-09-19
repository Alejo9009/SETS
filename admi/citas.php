<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sets - Citas</title>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/citas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <nav class="topbar">
            <div class="menu-left">
                <img src="img/ajustes.png" alt="Admin" class="admin-img">
                <a class="menu-button">Admin</a>
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
    <br><br>
    <main>
        <section class="anuncio">
            <center><h2 style=" font-size:50px ;color: rgb(9, 48, 26);">Citas</h2></center>
        </section>

        <div class="container">
            <div class="calendar-container">
                <div class="calendar">
                    <h2>Calendario</h2>
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
                                <td>1</td>
                                <td>2</td>
                                <td class="highlight">3</td>
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
                                <td class="highlight">12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <td>19</td>
                                <td class="highlight">20</td>
                                <td>21</td>
                                <td>22</td>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>26</td>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                                <td>30</td>
                                <td>31</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <aside class="sidebar">
                <h2>Citas Agendadas</h2>
                <br>
                <div class="barra">
                    <div class="sombra"></div>
                    <input type="text" placeholder="Buscar CITA...">
                    <ion-icon name="search-outline"></ion-icon>
                </div>
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
                <br>
                <article class="appointment">
                    <h3>Mantenimiento del Ascensor</h3>
                    <p>Fecha: 20/08/2024</p>
                    <p>Hora: 09:00 AM</p>
                    <p>Torre: 1</p>
                    <p>Piso: 5</p>
                    <p>Nombre Completo: Juan Pérez</p>
                    <p>Documento: 1234567890</p>
                    <p>Celular: 3001234567</p>
                    <p>Correo: juan.perez@example.com</p>
                    <div class="buttons">
                        <button class="button accept">Aceptar</button>
                        <button class="button delete">Eliminar</button>
                        <button class="button pending">Pendiente</button>
                    </div>
                </article>

                <article class="appointment">
                    <h3>Reunión de Comunidad</h3>
                    <p>Fecha: 12/08/2024</p>
                    <p>Hora: 03:00 PM</p>
                    <p>Torre: 2</p>
                    <p>Piso: 1</p>
                    <p>Nombre Completo: María Gómez</p>
                    <p>Documento: 0987654321</p>
                    <p>Celular: 3007654321</p>
                    <p>Correo: maria.gomez@example.com</p>
                    <div class="buttons">
                        <button class="button accept">Aceptar</button>
                        <button class="button delete">Eliminar</button>
                        <button class="button pending">Pendiente</button>
                    </div>
                </article>
                <article class="appointment">
                    <h3>Reparación de Fugas</h3>
                    <p>Fecha: 3/08/2024</p>
                    <p>Hora: 11:00 AM</p>
                    <p>Torre: 3</p>
                    <p>Piso: 10</p>
                    <p>Nombre Completo: Luis Fernández</p>
                    <p>Documento: 1122334455</p>
                    <p>Celular: 3001122334</p>
                    <p>Correo: luis.fernandez@example.com</p>
                    <div class="buttons">
                        <button class="button accept">Aceptar</button>
                        <button class="button delete">Eliminar</button>
                        <button class="button pending">Pendiente</button>
                    </div>
                </article>
            </aside>
        </div>
        <a href="inicioprincipal.html" class="button accept" style="font-size: 30px; text-decoration:none;">Volver</a>


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