<?php
require '../../MODEL/backend/authMiddleware.php';
session_start();
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
$decoded = authenticate();

$idRegistro = $decoded->id;
$Usuario = $decoded->Usuario;
$idRol = $decoded->idRol;

if ($idRol != 3333) {
    header("Location: http://localhost/sets/error.php");
    exit();
}

include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id_solicitud = $_POST['delete_id_solicitud'];

    $sql = "DELETE FROM solicitud_parqueadero WHERE id_solicitud = :id_solicitud";
    $stmt = $base_de_datos->prepare($sql);

    if ($stmt->execute(['id_solicitud' => $id_solicitud])) {
    } else {
        echo "Error al eliminar la solicitud.";
    }
}

$sql = "SELECT * FROM solicitud_parqueadero WHERE tipoVehiculo = 'carro'";

$stmt = $base_de_datos->query($sql);
$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);





$sql_estado = "SELECT 
    p.parqueadero_visitante AS parqueadero,
    CASE 
        WHEN p.estado = 'aprobado' AND NOW() BETWEEN p.fecha_inicio AND p.fecha_final THEN 'ocupado'
        WHEN p.estado = 'aprobado' AND NOW() < p.fecha_inicio THEN 'reservado'
        ELSE 'disponible'
    END AS estado,
    IFNULL(p.nombre_visitante, '') AS visitante,
    IFNULL(p.placaVehiculo, '') AS placa,
    IFNULL(CONCAT(DATE_FORMAT(p.fecha_inicio, '%d/%m/%Y %H:%i'), ' - ', DATE_FORMAT(p.fecha_final, '%d/%m/%Y %H:%i')), '') AS horario
FROM 
    (SELECT 'V1' AS parqueadero_visitante UNION SELECT 'V2' UNION SELECT 'V3' UNION 
     SELECT 'V4' UNION SELECT 'V5' UNION SELECT 'V6' UNION 
     SELECT 'V7' UNION SELECT 'V8' UNION SELECT 'V9' UNION SELECT 'V10') AS todos_parqueaderos
LEFT JOIN solicitud_parqueadero p ON 
    todos_parqueaderos.parqueadero_visitante = p.parqueadero_visitante AND
    p.estado = 'aprobado' AND
    NOW() <= p.fecha_final
GROUP BY 
    todos_parqueaderos.parqueadero_visitante
ORDER BY parqueadero";

$stmt_estado = $base_de_datos->query($sql_estado);
$estado_parqueaderos = $stmt_estado->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETS - Parqueadero Visitante</title>
    <link rel="stylesheet" href="css/parqueadero.css?v=<?php echo (rand()); ?>">
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <header>
        <div class="topbar">
            <nav class="navbar bg-body-tertiary fixed-top">
                <div class="container-fluid" style="background-color: #0e2c0a;">
                    <img src="img/resi.png" alt="Logo" width="70" height="74" class="d-inline-block align-text-top" style="background-color: #0e2c0a;">

                    <b style="font-size: 30px;color:aliceblue"> Residente - <?php echo htmlspecialchars($Usuario); ?> </b>
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
                                                <center> <a href="../../MODEL/backend/logout.php">Cerrar sesión</a></center>
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
        <br><br>
        <br><br>
        <div class="container">
            <div class="alert alert-success" role="alert" style="text-align: center; font-size: 24px;">
                <b>Estado de Parqueaderos Carros Visitantes</b>
            </div>

            <div class="row mb-5">
                <?php foreach ($estado_parqueaderos as $parqueadero): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card parking-card parking-status-<?php echo $parqueadero['estado']; ?>">
                            <div class="card-header">
                                <h5 class="card-title">Parqueadero <?php echo htmlspecialchars($parqueadero['parqueadero']); ?></h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <strong>Estado:</strong> <?php echo ucfirst(htmlspecialchars($parqueadero['estado'])); ?><br>
                                    <?php if ($parqueadero['estado'] != 'disponible'): ?>
                                        <strong>Visitante:</strong> <?php echo htmlspecialchars($parqueadero['visitante']); ?><br>
                                        <strong>Placa:</strong> <?php echo htmlspecialchars($parqueadero['placa']); ?><br>
                                        <strong>Horario:</strong> <?php echo htmlspecialchars($parqueadero['horario']); ?>
                                    <?php else: ?>
                                        <strong>Disponible para reserva</strong>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-4 mt-5">
                    <form action="../../CONTROLLER/carro.php" method="post">
                        <fieldset>
                            <center>
                                <legend><b>Nueva Solicitud</b></legend>
                            </center>
                            <div class="mb-3">
                                <label for="id_apartamento" class="form-label" style="font-size: 15px;">Apartamento:</label>
                                <input type="text" class="form-control" id="id_apartamento" name="id_apartamento" required>
                            </div>
                            <div class="mb-3">
                                <label for="parqueadero_visitante" class="form-label" style="font-size: 15px;">Parqueadero Visitante:</label>
                                <select class="form-control" id="parqueadero_visitante" name="parqueadero_visitante" required>
                                    <option value="V1">V1</option>
                                    <option value="V2">V2</option>
                                    <option value="V3">V3</option>
                                    <option value="V4">V4</option>
                                    <option value="V5">V5</option>
                                    <option value="V6">V6</option>
                                    <option value="V7">V7</option>
                                    <option value="V8">V8</option>
                                    <option value="V9">V9</option>
                                    <option value="V10">V10</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombre_visitante" class="form-label" style="font-size: 15px;">Nombre del Visitante:</label>
                                <input type="text" class="form-control" id="nombre_visitante" name="nombre_visitante" required>
                            </div>
                            <div class="mb-3">
                                <label for="placaVehiculo" class="form-label" style="font-size: 15px;">Placa del Vehículo:</label>
                                <input type="text" class="form-control" id="placaVehiculo" name="placaVehiculo" required>
                            </div>
                            <div class="mb-3">
                                <label for="colorVehiculo" class="form-label" style="font-size: 15px;">Color del Vehículo:</label>
                                <input type="text" class="form-control" id="colorVehiculo" name="colorVehiculo" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipoVehiculo" class="form-label" style="font-size: 15px;">Tipo de Vehículo:</label>
                                <input type="text" class="form-control" id="tipoVehiculo" name="tipoVehiculo" placeholder="carro" required>
                            </div>
                            <div class="mb-3">
                                <label for="modelo" class="form-label" style="font-size: 15px;">Modelo:</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" required>
                            </div>
                            <div class="mb-3">
                                <label for="marca" class="form-label" style="font-size: 15px;">Marca:</label>
                                <input type="text" class="form-control" id="marca" name="marca" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label" style="font-size: 15px;">Fecha de Inicio:</label>
                                <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_final" class="form-label" style="font-size: 15px;">Fecha Final:</label>
                                <input type="datetime-local" class="form-control" id="fecha_final" name="fecha_final" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-success" type="submit" style="font-size: 15px;">Enviar Solicitud</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8 mt-5">
                    <center>
                        <h2>Panel de Solicitudes Carros</h2>
                    </center>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="font-size: 15px;">ID Solicitud</th>
                                <th scope="col" style="font-size: 15px;">Apartamento</th>
                                <th scope="col" style="font-size: 15px;">Parqueadero Visitante</th>
                                <th scope="col" style="font-size: 15px;">Nombre del Visitante</th>
                                <th scope="col" style="font-size: 15px;">Placa del Vehículo</th>
                                <th scope="col" style="font-size: 15px;">Color del Vehículo</th>
                                <th scope="col" style="font-size: 15px;">Tipo de Vehículo</th>
                                <th scope="col" style="font-size: 15px;">Modelo</th>
                                <th scope="col" style="font-size: 15px;">Marca</th>
                                <th scope="col" style="font-size: 15px;">Fecha de Inicio</th>
                                <th scope="col" style="font-size: 15px;">Fecha Final</th>
                                <th scope="col" style="font-size: 15px;">Estado</th>
                                <th scope="col" style="font-size: 15px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($solicitudes as $solicitud): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($solicitud['id_solicitud']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['id_apartamento']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['parqueadero_visitante']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['nombre_visitante']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['placaVehiculo']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['colorVehiculo']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['tipoVehiculo']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['modelo']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['marca']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['fecha_inicio']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['fecha_final']); ?></td>
                                    <td><?php echo htmlspecialchars($solicitud['estado']); ?></td>
                                    <td>
                                        <form action="" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta solicitud?');">
                                            <input type="hidden" name="delete_id_solicitud" value="<?php echo $solicitud['id_solicitud']; ?>">
                                            <button class="btn btn-danger mt-3" type="submit" name="delete">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="container mt-5">
                    <a href="parqueaderocarro.php" class="btn btn-success">Volver</a>
                </div>
            </div>
        </div>
        <br>
        </div>
        <br>
        </div>
        <script>
            document.getElementById('searchInput').addEventListener('input', function() {
                const query = this.value.toLowerCase();
                const cards = document.querySelectorAll('.product-card');

                cards.forEach(card => {
                    const number = card.getAttribute('data-number').toLowerCase();
                    if (number.includes(query)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                const fechaInicioInput = document.getElementById('fecha_inicio');
                const fechaFinalInput = document.getElementById('fecha_final');
                const parqueaderoSelect = document.getElementById('parqueadero_visitante');


                const now = new Date();
                const timezoneOffset = now.getTimezoneOffset() * 60000;
                const localISOTime = new Date(now - timezoneOffset).toISOString().slice(0, 16);

                fechaInicioInput.min = localISOTime;
                fechaFinalInput.min = localISOTime;

                fechaInicioInput.addEventListener('change', function() {
                    const fechaInicio = new Date(this.value);
                    const fechaFinal = new Date(fechaFinalInput.value);

      
                    if (fechaFinal <= fechaInicio) {

                        const nuevaFechaFinal = new Date(fechaInicio);
                        nuevaFechaFinal.setHours(nuevaFechaFinal.getHours() + 1);
                        fechaFinalInput.value = nuevaFechaFinal.toISOString().slice(0, 16);
                    }


                    fechaFinalInput.min = this.value;
                });


                form.addEventListener('submit', function(e) {
                    const fechaInicio = new Date(fechaInicioInput.value);
                    const fechaFinal = new Date(fechaFinalInput.value);
                    const ahora = new Date();


                    if (fechaInicio < ahora) {
                        alert('La fecha de inicio no puede ser en el pasado');
                        e.preventDefault();
                        return false;
                    }

                    if (fechaFinal < ahora) {
                        alert('La fecha final no puede ser en el pasado');
                        e.preventDefault();
                        return false;
                    }


                    if (fechaFinal <= fechaInicio) {
                        alert('La fecha final debe ser posterior a la fecha de inicio');
                        e.preventDefault();
                        return false;
                    }

                    return true;
                });


                parqueaderoSelect.addEventListener('change', validarDisponibilidad);
                fechaInicioInput.addEventListener('change', validarDisponibilidad);
                fechaFinalInput.addEventListener('change', validarDisponibilidad);

             
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<style>
    .parking-card {
        transition: all 0.3s ease;
    }

    .parking-card:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .parking-status-ocupado {
        background-color: #ff6b6b;
        color: white;
    }

    .parking-status-reservado {
        background-color: rgb(102, 255, 153);
        color: black;
    }

    .parking-status-disponible {
        background-color: rgb(19, 88, 70);
        color: white;
    }
</style>
<br>

<br>
<br>
<footer>

    <div class="footer-content">
        <li>&copy; 2025 SETS. Todos los derechos reservados.</li>
        <ul>
            <li><a href="#">Términos y Condiciones</a></li>
            <li><a href="#">Política de Privacidad</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </div>
</footer>

</html>