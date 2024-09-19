<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sets -  SALON Comunal</title>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/citas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <header>
        <nav>
            <div class="topbar">
                <div class="menu-left">
                    <img src="img/guarda.png" alt="Admin" class="admin-img">
                    <a href="#" class="menu-button">Guarda Seguridad</a>
                    <ul class="dropdown-menu">
                        <li><a href="Perfil.html">Editar datos</a></li>
                        <li><a href="#">Reportar problema</a></li>
                        <li><a href="index.html">Cerrar sesión</a></li>
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
                                <a href="#" class="chat-item" onclick="openChat('admi')">Admi</a>
                                <a href="#" class="chat-item" onclick="openChat('ADMINISTRADOR')">Administrador</a>
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
    </main>
    <section class="anuncio">
        <h2  style="text-align: center; color:rgb(22, 58, 46)">Horarios disponibles - Salon Comunal</h2>
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
                            <td>1</td>
                            <td>2</td>
                            <td >3</td>
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
                <h3>Salón Comunal</h3>
                <p>Fecha: 20/09/2024</p>
                <p>Hora: 3:00 PM</p>
                <p>Apartamento: 405</p>
                <p>Nombre Completo: Ana Martínez</p>
                <p>Documento: 2233445566</p>
                <p>Celular: 3003344556</p>
                <p>Correo: ana.martinez@example.com</p>
                <div class="buttons">

                </div>
            </div>
            <div class="appointment">
                <h3>Salón Comunal</h3>
                <p>Fecha: 12/09/2024</p>
                <p>Hora: 3:00 PM</p>
                <p>Apartamento: 405</p>
                <p>Nombre Completo: Ana Martínez</p>
                <p>Documento: 2233445566</p>
                <p>Celular: 3003344556</p>
                <p>Correo: ana.martinez@example.com</p>
                <div class="buttons">
 
                </div>
            </div>
        </div>
    </div>
    <a href="zonas_comunes.php" class="btn btn-success" style="font-size: 40px;">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>