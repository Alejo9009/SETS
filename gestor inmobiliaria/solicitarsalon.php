<?php
// Conexión a la base de datos
include_once "conexion.php";
if (!$base_de_datos) {
    exit('Error en la conexión a la base de datos.');
}

// Consulta para obtener las solicitudes de la cancha de fútbol con el nombre del estado
$sql = "SELECT sz.*, e.estados 
        FROM solicitud_zona sz 
        LEFT JOIN estado e ON sz.estado = e.idestado 
        WHERE sz.ID_zonaComun = 3"; // Filtra solo las solicitudes para la cancha de fútbol

$stmt = $base_de_datos->query($sql); // Usa $base_de_datos para ejecutar la consulta
$solicitudes = []; // Inicializa el array

if ($stmt->rowCount() > 0) { // Verifica si hay resultados
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $solicitudes[] = $row; // Almacena cada solicitud en el array
    }
}

// Ahora puedes usar el array $solicitudes en tu HTML
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sets - Salon Comunal</title>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/citas.css?v=<?php echo (rand()); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <header>
    <nav class="navbar bg-body-tertiary fixed-top">
      <div class="container-fluid" style="background-color: #0e2c0a;">
        <img src="img/administrado.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;"><b style="font-size: 40px;color:aliceblue"> Administrador </b></a>
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
                      <center> <a href="../index.php">Cerrar Sesión</a></center>
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
                    <center><a href="#" class="chat-item" onclick="openChat('Guarda de Seguridad')">Guarda de Seguridad</a></center>
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
    <br>
    <br>
    <br><br>
    <main>
<br>
<br>
<br>
        <div class="alert alert-success g" role="alert">
            <h2>Horarios disponibles - SALON COMUNAL</h2>
        </div>

        <div class="container">
            <div class="calendar-container">
                <div class="calendar">
                    <div class="calendar-header">
                        <h2 id="calendar-title">Calendario de Disponibilidad</h2>
                        <br><p>
                        <span id="month-year" style="color: #0e2c0a;"><b></b></span>
                        <div id="calendar-controls">
                    <button id="prev-month" onclick="prevMonth()">←</button>
                    <span id="month-year"></span>
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

            <aside class="sidebar">
                <h2>Agendaciones</h2>
                <div class="search-bar">
                    <input type="search" placeholder="Buscar agendaciones..." />
                    <ion-icon name="search-outline"></ion-icon>
                </div>
                <div class="appointment-list">
                    <?php foreach ($solicitudes as $solicitud): ?>
                        <div class="appointment">
                            <h3>SALON COMUNAL</h3>
                            <p><strong>fecha Inicio:</strong> <?= date('d/m/Y', strtotime($solicitud['fechaInicio'])) ?></p>
                            <p><strong>fecha Final:</strong> <?= date('d/m/Y', strtotime($solicitud['fechaFinal'])) ?></p>
                            <p><strong>Hora_inicio:</strong> <?= date('h:i A', strtotime($solicitud['Hora_inicio'])) ?></p>
                            <p><strong>Hora_final:</strong> <?= date('h:i A', strtotime($solicitud['Hora_final'])) ?></p>
                            <p><strong>Apartamento:</strong> <?= $solicitud['ID_Apartament'] ?></p>
                            <p><strong>SOLICITUD FUE:</strong> <?= $solicitud['estado'] ?> - <?= $solicitud['estados'] ?></p>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <!-- Formulario para aceptar la solicitud -->
                          <form action="procesar_salon.php" method="POST">
                                    <input type="hidden" name="id_solicitud" value="<?= $solicitud['ID_Apartament'] ?>"> <!-- o ID_zonaComun -->
                                    <input type="hidden" name="accion" value="aceptar">
                                    <button type="submit" class="btn btn-success">Aceptar</button>
                                </form>

                                <!-- Formulario para dejar la solicitud como pendiente -->
                                <form action="procesar_salon.php" method="POST">
                                    <input type="hidden" name="id_solicitud" value="<?= $solicitud['ID_Apartament'] ?>"> <!-- o ID_zonaComun -->
                                    <input type="hidden" name="accion" value="pendiente">
                                    <button type="submit" class="btn btn-warning">Pendiente</button>
                                </form>

                                <!-- Formulario para eliminar la solicitud -->
                                <form action="procesar_salon.php" method="POST">
                                    <input type="hidden" name="id_solicitud" value="<?= $solicitud['ID_Apartament'] ?>"> <!-- o ID_zonaComun -->
                                    <input type="hidden" name="accion" value="eliminar">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                    </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </aside>

        </div>

  
        <a href="zonas_comunes.php" class="btn btn-success" style="font-size: 30px;">
            <center>VOLVER</center>
        </a>

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
        // Convertir los datos de PHP a JavaScript
        const solicitudes = <?php echo json_encode($solicitudes); ?>;
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const calendarBody = document.getElementById('calendar-body');
    const monthYearDisplay = document.getElementById('month-year');

    const today = new Date();
    const months = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    let currentYear = today.getFullYear();
    let currentMonth = today.getMonth();

    // Datos de solicitudes (simulado, en tu caso vendrá de PHP)
    const solicitudes = <?php echo json_encode($solicitudes); ?>;

    // Función para generar el calendario del mes y año dados
    function generarCalendario(mes, anio) {
        calendarBody.innerHTML = '';  // Limpia el contenido anterior
        monthYearDisplay.textContent = `${months[mes]} ${anio}`;

        const firstDayOfMonth = new Date(anio, mes, 1).getDay() || 7;  // Lunes = 1
        const daysInMonth = new Date(anio, mes + 1, 0).getDate();  // Número de días en el mes

        let date = 1;

        // Crear filas para las semanas (hasta 6 semanas máximo)
        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');

            // Crear celdas para cada día de la semana
            for (let j = 1; j <= 7; j++) {
                const cell = document.createElement('td');

                if (i === 0 && j < firstDayOfMonth) {
                    cell.innerHTML = '';  // Celdas vacías antes del primer día
                } else if (date > daysInMonth) {
                    break;  // No más días en el mes
                } else {
                    const fechaActual = new Date(anio, mes, date);

                    // Asignar el día a la celda
                    cell.textContent = date;
                    cell.setAttribute('data-date', fechaActual.toISOString().split('T')[0]);

                    // Verificar si la fecha está solicitada
                    solicitudes.forEach(solicitud => {
                        const fechaSolicitud = new Date(solicitud.fechaInicio);

                        if (fechaSolicitud.toISOString().split('T')[0] === fechaActual.toISOString().split('T')[0]) {
                            cell.style.backgroundColor = '#84c9a1'; // Color para fechas solicitadas
                        }
                    });

                    // Resaltar los fines de semana
                    if (j === 6 || j === 7) {  // Sábado y domingo
                        cell.style.color = 'green';
                    }

                    date++;
                }

                row.appendChild(cell);
            }

            calendarBody.appendChild(row);
        }
    }

    // Función para cambiar al mes anterior
    function prevMonth() {
        currentMonth = (currentMonth - 1 + 12) % 12;
        if (currentMonth === 11) currentYear--;
        generarCalendario(currentMonth, currentYear);
    }

    // Función para cambiar al siguiente mes
    function nextMonth() {
        currentMonth = (currentMonth + 1) % 12;
        if (currentMonth === 0) currentYear++;
        generarCalendario(currentMonth, currentYear);
    }

    // Función para inicializar el calendario en el mes actual
    function inicializarCalendario() {
        generarCalendario(currentMonth, currentYear);
    }

    // Inicializa el calendario con el mes y año actuales
    inicializarCalendario();

    // Asigna las funciones de cambio de mes a los botones de control
    document.getElementById('prev-month').addEventListener('click', prevMonth);
    document.getElementById('next-month').addEventListener('click', nextMonth);
});

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