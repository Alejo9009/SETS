<?php

session_start();

include_once "conexion.php";
$query = "SELECT id_Torre, numTorre, descripcionTorre FROM torre";
try {
  $statement = $base_de_datos->prepare($query);
  $statement->execute();
  $torre = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error al ejecutar la consulta: " . $e->getMessage();
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SETS -Torre </title>
  <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/torres.css?v=<?php echo (rand()); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
  <header>
    <nav class="navbar bg-body-tertiary fixed-top">
      <div class="container-fluid" style="background-color: #0e2c0a;">
        <img src="img/guarda.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;"><b style="font-size: 40px;color:aliceblue"> Guarda de Seguridad </b></a>
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
                    <center>
                      <li>
                        <a href="#" class="chat-item" onclick="openChat('Gestor de Imobiliaria')">Gestor de Imobiliaria</a>
                      </li>
                    </center>
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
    <section id="chatContainer" class="chat-container  z-3 position-fixed p-5 rounded-3 ">
      <div class="chat-header">
        <span id="chatHeader">Chat</span>
        <button class="close-btn" onclick="closeChat()">×</button>
      </div>
      <div class="chat-messages" id="chatMessages"></div>
      <div class="chat-input">
        <input type="text" id="chatInput" placeholder="Escribe tu mensaje...">
        <button onclick="sendMessage()">Enviar</button>
      </div>
    </section>
  </main>
  </div>
  <br>
  <br>
  <main>
    <section class="anuncio">
      <center>
        <h2 style="color: rgb(11, 51, 21); text-align:center ; font-size: 60px;">Torre</h2>
      </center>
    </section>
    <section class="announcements">
      <br>
      <div class="barra">
        <div class="sombra"></div>
        <form onsubmit="return searchTowers();">
          <input type="text" id="search-input" placeholder="Buscar torre...">
          <ion-icon name="search-outline"></ion-icon>
        </form>
      </div>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <br>
      <div id="tower-container" class="container">
        <?php if (!empty($torre)): ?>
          <div class="row">
            <?php foreach ($torre as $index => $torre): ?>
              <div class="col-12 col-md-6 col-lg-4 mb-4">
                <center>
                  <div class="card">
                    <img src="img/yy.jpg" class="" alt="Imagen del apartamento" style="border: 3px solid #14c55e;">
                    <div class="card-body">
                      <h5 class="card-title"><?= htmlspecialchars($torre['numTorre']); ?></h5>
                      <h2 class="card-text"><?= htmlspecialchars($torre['descripcionTorre']); ?></h2><br>
                      <a href="pisos.php" style="font-size: 30px;" class="btn-custom">Pisos</a><br>
                    </div>
                  </div>
                </center>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p>No se encontraron Torres.</p>
        <?php endif; ?>
      </div>
    </section>
  </main>
  </header>
  <br>
  <div class="d-flex justify-content-between">
    <a href="ingresoregi.php" class="btn btn-success" style="font-size: 30px; width: 9vw; height: 9vh;">Ingreso Peatonal</a>
    <a href="inicioprincipal.php" class="btn btn-success" style="font-size: 30px; width: 9vw; height: 7vh;">Volver</a>
  </div>
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
    function searchTowers() {
      var query = document.getElementById('search-input').value;

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'toers.php?query=' + encodeURIComponent(query), true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          document.getElementById('tower-container').innerHTML = xhr.responseText;
        } else {
          console.error('Error en la búsqueda:', xhr.statusText);
        }
      };
      xhr.send();
      return false;
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