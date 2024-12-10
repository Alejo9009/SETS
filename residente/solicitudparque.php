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

if ($datosRol['idRol'] != 4) { // Solo si el rol es "residente" (idRol == 4)
    header("Location: http://localhost/sets/error.php");
    exit();
}



// Obtener parqueaderos disponibles
$stmt = $base_de_datos->query("SELECT * FROM parqueadero WHERE disponibilidad = 'SI ESTA DISPONIBLE'");
$parqueaderosDisponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETS - PARQUEADERO-solicitar</title>
    <link rel="stylesheet" href="css/solictudparque.css?v=<?php echo (rand()); ?>s">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid" style="background-color: #0e2c0a;">
            <img src="img/resi.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;">

<b style="font-size: 40px;color:aliceblue"> Residente - <?php echo htmlspecialchars($nombreUsuario); ?> </b>
</a> <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" style="background-color: white;">
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
                                        <center> <a href="../backend/logout.php">Cerrar sesión</a></center>
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
                                            <center><a href="#" class="chat-item" onclick="openChat('Admin')">Admin</a></center>
                                        </li>
                                        <li>
                                            <center><a href="#" class="chat-item" onclick="openChat('Gestor de Imobiliaria')">Gestor de Imobiliaria</a></center>
                                        </li>
                                        <li>
                                        <center><a href="#" class="chat-item" onclick="openChat('Guarda de Seguridad')">Guarda de Seguridad</a></center>
                                        </li>
                                        <li>
                                            <center><a href="#" class="chat-item" onclick="openChat('Chat Comunal')">Chat Comunal</a></center>
                                        </li>
                                    </ul>
                            </center>
                        </ul>

                        <form class="d-flex mt-3" role="search">
                            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
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
        <br> <br> <br> <br>  <br> <br> <br> <br> <br> <br> <br> <br> <br>  <br><br> <br>
        <br> <br> <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br> <br>  <br>
        <div class="container">
            <div class="login-content">
                <div class="alert alert-success" role="alert">
                    Solicitar Parqueadero Carro
                </div>
                <img src="img/coches.png" alt="Logo" class="imgp">
                <form action="./servidor-parqueaderos/parking.php" method="POST" class="p-4 border rounded bg-white">
                    <select name="numParqueadero" class="form-select" required>
                        <option value="">Seleccione un parqueadero</option>
                        <?php foreach ($parqueaderosDisponibles as $parqueadero): ?>
                            <option value="<?php echo $parqueadero['numero_Parqueadero']; ?>">
                                <?php echo $parqueadero['numero_Parqueadero']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="mb-3">
                        <label for="id_parking" class="form-label">ID del Parqueadero</label>
                        <input type="number" name="id_parking" class="form-control" placeholder="Ingrese el ID del parqueadero" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_Aparta" class="form-label">ID Apartamento</label>
                        <input type="number" name="id_Aparta" class="form-control" placeholder="Ingrese el ID del apartamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_dueño" class="form-label">Nombre del Dueño</label>
                        <input type="text" name="nombre_dueño" class="form-control" placeholder="Ingrese su nombre completo" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                        <input type="time" name="hora_inicio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_final" class="form-label">Fecha Final</label>
                        <input type="date" name="fecha_final" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora_final" class="form-label">Hora Final</label>
                        <input type="time" name="hora_final" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="placaVehiculo" class="form-label">Placa del Vehículo</label>
                        <input type="text" name="placaVehiculo" class="form-control" placeholder="Ingrese la placa del vehículo">
                    </div>
                    <div class="mb-3">
                        <label for="colorVehiculo" class="form-label">Color del Vehículo</label>
                        <input type="text" name="colorVehiculo" class="form-control" placeholder="Ingrese el color del vehículo">
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" name="marca" class="form-control" placeholder="Ingrese la marca del vehículo">
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" name="modelo" class="form-control" placeholder="Ingrese el modelo del vehículo">
                    </div>
                    <div class="mb-3">
                        <label for="TipoVehiculo" class="form-label">Tipo de Vehículo</label>
                        <input type="text" name="TipoVehiculo" class="form-control" placeholder="Ejemplo: Carro, Moto">
                    </div>
                    <div class="mb-3">
                        <label for="descripcionvehiculo" class="form-label">Descripción del Vehículo</label>
                        <textarea name="descripcionvehiculo" class="form-control" placeholder="Descripción breve del vehículo"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Solicitar</button>
                </form>
            </div>
        </div>
        </div>
    </main>
    <a href="parqueaderocarro.php" class="btn btn-danger btn-lg" style="position: absolute; bottom: 10px;">Volver</a>
    <script>
        function toggleDetails() {
            const section = document.getElementById('form-section');
            section.style.display = section.style.display === 'none' || section.style.display === '' ? 'block' : 'none';
        }
    </script>
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
</body>
</html>