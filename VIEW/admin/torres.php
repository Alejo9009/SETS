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


if ($idRol != 1111) {
  header("Location: http://localhost/sets/error.php");
  exit();
}

include_once "conexion.php";

$query = "SELECT numApartamento, pisos, torre FROM apartamento ORDER BY torre, pisos, numApartamento";
$stmt = $base_de_datos->prepare($query);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

$torres = [];
foreach ($resultados as $fila) {
  $torre = $fila['torre'];
  $piso = $fila['pisos'];

  if (!isset($torres[$torre])) {
    $torres[$torre] = [];
  }

  if (!isset($torres[$torre][$piso])) {
    $torres[$torre][$piso] = [];
  }

  $torres[$torre][$piso][] = [
    'numApartamento' => $fila['numApartamento']
  ];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SETS - Pisos</title>
  <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/pisos.css?v=<?php echo (rand()); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
<header>
        <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid" style="background-color: #0e2c0a;">
            <img src="img/ajustes.png" alt="Logo" width="70" height="74" class="d-inline-block align-text-top" style="background-color: #0e2c0a;">
            <b style="font-size: 25px;color:aliceblue"> ADMIN - <?php echo htmlspecialchars($Usuario); ?>  </b></a>
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
                                            <center><a href="Perfil.php">Editar Datos</a></center>
                                        </li>
                                        <li>
                                            <center> <a href="../../MODEL/backend/logout.php">Cerrar Sesión</a></center>
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
                <input type="text" id="chatInput" style="font-size: 14px;" placeholder="Escribe tu mensaje...">
                <button onclick="sendMessage()">Enviar</button>
            </div>
        </div>

    </main>
    <br>
    <br>
    <div class="alert alert-success" role="alert" style="font-size: 40px; text-align:center">
      <b>Torre Pisos y Apartamentos</b>
    </div>
    <div class="container">
      <div class="barra">
        <div class="sombra"></div>
        <input type="text" placeholder="Buscar Piso...">
        <ion-icon name="search-outline"></ion-icon>
      </div>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <br>
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="d-flex justify-content-between">
            <button class="btn btn-outline-success" onclick="cambiarTorre(-1)">← Anterior</button>
            <h2 id="torreActual" style="text-align: center;">Torre 1</h2>
            <button class="btn btn-outline-success" onclick="cambiarTorre(1)">Siguiente →</button>
          </div>
          <div id="contenidoTorre">
            <?php foreach ($torres as $torre => $pisos): ?>
              <div class="torre" data-torre="<?= $torre ?>" style="display: <?= $torre == 1 ? 'block' : 'none' ?>;">
                <?php foreach ($pisos as $piso => $apartamentos): ?>
                  <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white">
                      <h2 class="mb-0" style="text-align: center;"><b>Piso: <?= htmlspecialchars($piso) ?></b></h2>
                    </div>
                    <div class="card-body">
                      <h4 style="text-align: center;"><b>Apartamentos:</b></h4>
                      <div class="row">
                        <?php foreach ($apartamentos as $apartamento): ?>
                          <div class="col-md-6 mb-3">
                            <div class="card card-apartamento">
                              <div class="card-body">
                                <strong>Número:</strong> <?= htmlspecialchars($apartamento['numApartamento']) ?><br>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <a href="./ingresoregi.php" class="btn btn-outline-success" style="font-size: 25px;" >Ingreso Peatonal</a>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
   
  
      <a href="./inicioprincipal.php" class="btn btn-outline-success" style=" font-size:30px;"> VOLVER</a>
    </div>
    <script type="text/javascript" src="JAVA/main.js"></script>
    <script>
      let torres = <?= json_encode(array_keys($torres)) ?>;
      let torreActual = 1;

      function cambiarTorre(direccion) {
        torreActual += direccion;
        if (torreActual < 1) torreActual = torres.length;
        if (torreActual > torres.length) torreActual = 1;

        document.querySelectorAll('.torre').forEach(torre => {
          torre.style.display = 'none';
        });

        document.querySelector(`.torre[data-torre="${torreActual}"]`).style.display = 'block';
        document.getElementById('torreActual').textContent = `Torre ${torreActual}`;
      }
    </script>
    <br>
    <br>
    <br>
    <br>

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
      function buscar() {
        var input = document.getElementById("inputBusqueda").value.toLowerCase();
        var lista = document.getElementById("listaElementos");
        var items = lista.getElementsByTagName("li");
        for (var i = 0; i < items.length; i++) {
          var elemento = items[i].textContent || items[i].innerText;
          if (elemento.toLowerCase().indexOf(input) > -1) {
            items[i].style.display = "";
          } else {
            items[i].style.display = "none";
          }
        }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </header>
</body>

</html>