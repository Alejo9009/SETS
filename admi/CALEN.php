<?php
// Conexión a la base de datos
include_once "conexion.php";
if (!$base_de_datos) {
    exit('Error en la conexión a la base de datos.');
}

// Consulta para obtener las solicitudes de la cancha de fútbol con el nombre del estado
$sql = "SELECT c.* FROM citas c WHERE c.estado = 'respondida'";
$stmt = $base_de_datos->query($sql); // Usa $base_de_datos para ejecutar la consulta

if (!$stmt) {
    exit('Error en la consulta: ' . print_r($base_de_datos->errorInfo(), true));
}

$citas = []; // Inicializa el array

if ($stmt->rowCount() > 0) { // Verifica si hay resultados
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $citas[] = $row; // Almacena cada solicitud en el array
    }
}

$eventos = [];
foreach ($citas as $row) {
    $eventos[] = [
        'id' => $row['id'],
        'title' => $row['opcion'],
        'start' => $row['fecha'] . 'T' . $row['hora'],
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sets - Citas</title>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/citas.css?v=<?php echo (rand()); ?>">
</head>

<body>
    <header>
    <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid" style="background-color: #0e2c0a;">
                <img src="img/ajustes.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;"><b style="font-size: 40px;color:aliceblue"> ADMI</b></a>
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
                                            <center><a href="Perfil.php">Editar datos</a></center>
                                        </li>
                                        <li>
                                            <center><a href="#">Reportar problema</a></center>
                                        </li>
                                        <li>
                                            <center> <a href="../index.php">Cerrar sesión</a></center>
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
                                            <center><a href="#" class="chat-item" onclick="openChat('admi')">Admi</a></center>
                                        </li>
                                        <li>
                                            <center><a href="#" class="chat-item" onclick="openChat('ADMINISTRADOR')">Administrador</a></center>
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
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="anuncio">
            <h2 style="text-align: center;">Citas</h2>
        </section>
        <div class="container">
            <div class="calendar-container">
                <div class="calendar">
                    <div class="calendar-header">
                        <h2 id="calendar-title">Calendario de Disponibilidad</h2>
                        <p id="month-year" style="color: #0e2c0a;"><b></b></p>
                        <div id="calendar-controls">
                            <button id="prev-month" onclick="prevMonth()">←</button>
                            <button id="next-month" onclick="nextMonth()">→</button>
                        </div>
                    </div>
                    <table id="calendar-table">
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
                        <tbody id="calendar-body">
                            <!-- Las fechas serán generadas aquí por JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

           
        </div>
    </main>
    <center>
                
                <a href="citas.php" class="btn btn-success" style="font-size: 30px;">Volver</a>
            </center>
    <script>
        const calendarBody = document.getElementById('calendar-body');
        const monthYearDisplay = document.getElementById('month-year');

        const today = new Date();
        let currentYear = today.getFullYear();
        let currentMonth = today.getMonth();

        const meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        function generarCalendario(mes, anio) {
            const primerDia = new Date(anio, mes, 1).getDay(); // Día de la semana del primer día
            const ultimoDia = new Date(anio, mes + 1, 0).getDate(); // Último día del mes
            calendarBody.innerHTML = ''; // Limpiar el calendario

            let fecha = 1;

            for (let i = 0; i < 6; i++) { // Máximo 6 filas
                const row = document.createElement('tr');

                for (let j = 0; j < 7; j++) { // 7 días de la semana
                    const cell = document.createElement('td');
                    if (i === 0 && j < primerDia) {
                        cell.textContent = ''; // Celdas vacías para los días previos
                    } else if (fecha > ultimoDia) {
                        break; // Si ya pasamos el último día del mes, salimos
                    } else {
                        cell.textContent = fecha; // Coloca el número de fecha
                        fecha++;
                    }
                    row.appendChild(cell);
                }
                calendarBody.appendChild(row);
            }
            monthYearDisplay.textContent = `${meses[mes]} ${anio}`; // Muestra el mes y el año
        }

        function prevMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generarCalendario(currentMonth, currentYear);
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generarCalendario(currentMonth, currentYear);
        }

        // Generar el calendario inicial
        generarCalendario(currentMonth, currentYear);
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
