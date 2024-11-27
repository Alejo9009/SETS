<?php
include_once "conexion.php";

// Verificar si se ha proporcionado el ID de la solicitud
if (isset($_GET['id_parking'])) {
    $idSolicitud = $_GET['id_parking'];

    // Consulta para obtener los datos de la solicitud
    $query = "SELECT * FROM solicitud_parqueadero WHERE id_parking = :id_parking";
    $statement = $base_de_datos->prepare($query);
    $statement->bindParam(':id_parking', $idSolicitud);
    $statement->execute();
    $solicitud = $statement->fetch(PDO::FETCH_ASSOC);

    // Verificar si la solicitud existe
    if (!$solicitud) {
        echo "Solicitud no encontrada.";
        exit();
    }
} else {
    echo "ID de solicitud no proporcionado";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETS - actualizar solicitud de parqueadero</title>
    <link rel="stylesheet" href="./css/caaaa.css?v=<?php echo (rand()); ?>">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid" style="background-color: #0e2c0a;">
                <img src="img/resi.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;">
                <b style="font-size: 40px;color:aliceblue"> Residente </b>
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
                                            <center><a href="../index.php">Cerrar sesión</a></center>
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
                                            <center><a href="#" class="chat-item" onclick="openChat('ADMINISTRADOR')">Administrador</a></center>
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
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <br><br>
    <main>
        <section class="chat-container" id="chatContainer">
            <header class="chat-header">
                <span id="chatHeader">Chat</span>
                <button class="close-btn" onclick="closeChat()">×</button>
            </header>
            <div class="chat-messages" id="chatMessages"></div>
            <div class="chat-input">
                <input type="text" id="chatInput" placeholder="Escribe tu mensaje...">
                <button onclick="sendMessage()">Enviar</button>
            </div>
        </section>
    </main>
    <br><br><br>
    <div class="alert alert-success" role="alert">
        <h2 style="text-align: center;">Editar Solicitud de Agendación Parqueadero</h2>
        <p><br></p>
    </div>
    <br><br>
    <div class="container">
        <section class="login-content">
            <img src="img/esta.png" alt="Logo" class="imgp">
            <div class="container">

            <form action="parking.php" method="post" class="p-4 border rounded bg-white">
            <input type="hidden" name="id_parking" value="<?php echo $id_parking; ?>">

                    <div class="mb-3">
                        <label for="id_Aparta" class="form-label">ID Aparta</label>
                        <input type="number" name="id_Aparta" class="form-control" placeholder="Ingrese el ID del apartamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_final" class="form-label">Fecha Final</label>
                        <input type="date" name="fecha_final" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                        <input type="time" name="hora_inicio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora_final" class="form-label">Hora Final</label>
                        <input type="time" name="hora_final" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="numParqueadero" class="form-label">Número de Parqueadero</label>
                        <select name="numParqueadero" class="form-select" required>
                            <option value="">Seleccione un parqueadero</option>
                            <?php foreach ($parqueaderosDisponibles as $parqueadero): ?>
                                <option value="<?php echo $parqueadero['numero_Parqueadero']; ?>">
                                    <?php echo $parqueadero['numero_Parqueadero']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Botón para mostrar más datos -->
                    <button type="button" class="btn btn-outline-secondary btn-toggle" onclick="toggleDetails()">Mostrar más datos</button>

                    <!-- Campos adicionales -->
                    <div id="form-section" class="form-section">
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
                            <label for="descripcionvehiculo" class="form-label">Descripción</label>
                            <textarea name="descripcionvehiculo" class="form-control" placeholder="Descripción breve del vehículo"></textarea>
                        </div>
                    </div>
                    <!-- Botón para enviar -->
                    <button type="submit" class="btn btn-success">Solicitar</button>
                </form>
            </div>

            <script>
                function toggleDetails() {
                    const section = document.getElementById('form-section');
                    section.style.display = section.style.display === 'none' || section.style.display === '' ? 'block' : 'none';
                }
            </script>
        </section>
    </div>
    <a href="horariocarro.php" class="btn btn-danger btn-lg">volver</a>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        function openChat(user) {
            document.getElementById('chatHeader').innerText = user;
            document.querySelector('.chat-container').classList.add('show');
        }

        function closeChat() {
            document.querySelector('.chat-container').classList.remove('show');
        }

        function sendMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value;
            if (message) {
                const messagesDiv = document.getElementById('chatMessages');
                messagesDiv.innerHTML += `<div>${message}</div>`;
                input.value = '';
            }
        }
    </script>
</body>

</html>