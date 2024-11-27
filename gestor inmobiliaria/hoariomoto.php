<?php
// Conexión a la base de datos
include_once "conexion.php";
if (!$base_de_datos) {
    exit('Error en la conexión a la base de datos.');
}

// Consulta para obtener las solicitudes de parqueadero solo para carros
$sql = "SELECT sp.*, e.estados, tv.descripcionvehiculo 
        FROM solicitud_parqueadero sp 
        LEFT JOIN estados e ON sp.estadoos = e.idestado 
        LEFT JOIN tipovehiculo tv ON sp.TipoVehiculo = tv.idtVehiculo 
        WHERE tv.descripcionvehiculo = 'MOTO'";                                                        // Filtra solo los vehículos de tipo 'CARRO'

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
    <title>sets - MOTO</title>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/citas.css?v=<?php echo (rand()); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid" style="background-color: #0e2c0a;">
                <img src="img/administrado.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;"><b style="font-size: 30px;color:aliceblue"> Administrador </b></a>
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
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <main>
        <section class="chat-container" id="chatContainer">
            <header class="chat-header">
                <span id="chatHeader">Chat</span>
                <button class="close-btn" onclick="closeChat()">×</button>
            </header>
            <div class="chat-messages" id="chatMessages">
            </div>
            <div class="chat-input">
                <input type="text" id="chatInput" placeholder="Escribe tu mensaje...">
                <button onclick="sendMessage()">Enviar</button>
            </div>
        </section>
    </main>
    <main>
        <center>
            <div class="alert alert-success" role="alert">
                <h3>Agendacion de Parqueadero moto</h3>
            </div>

        </center>

        <div class="container">


            <!-- Citas Agendadas -->
            <div class="sidebar">
             
                <br>
                <div class="barra">
                    <div class="sombra"></div>
                    <input type="text" placeholder="Buscar moto...">
                    <ion-icon name="search-outline"></ion-icon>
                </div>
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
                <br>
                <div class="appointment-list">
                    <center>

                    </center>
                    <?php foreach ($solicitudes as $solicitud): ?>
                        <div class="appointment">
                            <center>
                                <div class="alert alert-success" role="alert">
                                    <h3>Solicitud de Agendacion</h3>
                                </div>

                            </center>
                            <center>
                                <p><strong>Numero del Parqueadero :</strong> <?= $solicitud['id_parking'] ?></p>
                                <p><strong>fecha Inicio:</strong> <?= date('d/m/Y', strtotime($solicitud['fecha_inicio'])) ?></p>
                                <p><strong>fecha Final:</strong> <?= date('d/m/Y', strtotime($solicitud['fecha_final'])) ?></p>
                                <p><strong>Hora_inicio:</strong> <?= date('h:i A', strtotime($solicitud['hora_inicio'])) ?></p>
                                <p><strong>Hora_final:</strong> <?= date('h:i A', strtotime($solicitud['hora_final'])) ?></p>
                                <p><strong>Color del Vehiculo:</strong> <?= $solicitud['colorVehiculo'] ?></p>
                                <p><strong>Tipo de Vehiculo:</strong> <?= $solicitud['id_TipoVehiculo'] ?> - <?= $solicitud['descripcionvehiculo'] ?></p>
                                <p><strong>SOLICITUD FUE:</strong> <?= $solicitud['estadoos'] ?> - <?= $solicitud['estados'] ?></p>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <!-- Formulario para aceptar la solicitud -->
                                    <form action="procesar_MOTO.php" method="POST">
                                        <input type="hidden" name="id_parking" value="<?= $solicitud['id_parking'] ?>"> <!-- o ID_zonaComun -->
                                        <input type="hidden" name="accion" value="aceptar">
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                    </form>

                                    <!-- Formulario para dejar la solicitud como pendiente -->
                                    <form action="procesar_MOTO.php" method="POST">
                                        <input type="hidden" name="id_parking" value="<?= $solicitud['id_parking'] ?>"> <!-- o ID_zonaComun -->
                                        <input type="hidden" name="accion" value="pendiente">
                                        <button type="submit" class="btn btn-warning">Pendiente</button>
                                    </form>

                                    <!-- Formulario para eliminar la solicitud -->
                                    <form action="procesar_MOTO.php" method="POST">
                                        <input type="hidden" name="id_parking" value="<?= $solicitud['id_parking'] ?>"> <!-- o ID_zonaComun -->
                                        <input type="hidden" name="accion" value="eliminar">
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>

                                </div>
                            </center>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
    </main>
    <a href="paromoto.php" class="btn btn-outline-success" style="font-size: 40px;">
        <center>VOLVER</center>
    </a>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    </main>
</body>

</html>