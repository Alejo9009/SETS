<?php
include_once "conexion.php";
$query = "SELECT  p.numPiso, p.descripcionPiso, a.numApartamento, a.descripcionApartamento FROM  piso p JOIN  apartamento a ON p.id_Piso = a.pisos  -- Relación entre piso y apartamento
ORDER BY  p.numPiso, a.id_Apartamento,a.numApartamento";
$stmt =  $base_de_datos->prepare($query);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
$pisos = [];
foreach ($resultados as $fila) {
  $numPiso = $fila['numPiso'];

  if (!isset($pisos[$numPiso])) {
    $pisos[$numPiso] = [
      'descripcionPiso' => $fila['descripcionPiso'],
      'apartamentos' => []
    ];
  }
  if (isset($fila['numApartamento']) && isset($fila['descripcionApartamento'])) {
    $pisos[$numPiso]['apartamentos'][] = [
      'numApartamento' => $fila['numApartamento'],
      'descripcionApartamento' => $fila['descripcionApartamento']
    ];
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Piso</title>
  <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
  <link rel="stylesheet" href="css/pisos.css?v=<?php echo (rand()); ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
  <header>
    <nav class="navbar bg-body-tertiary fixed-top">
      <div class="container-fluid" style="background-color: #0e2c0a;">
        <img src="img/administrado.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;"><b style="font-size: 40px;color:aliceblue"> Gestor de inmobiliaria </b></a>
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
                      <center><a href="#" class="chat-item" onclick="openChat('admi')">Admin</a></center>
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
    <section id="chatContainer" class="chat-container position-fixed p-5 rounded-3" style="z-index: 1000; bottom: 20px; right: 20px;">
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

    </header>
    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="alert alert-success" role="alert" style="font-size: 40px; text-align:center">
      <b>Pisos y Apartamentos</b>
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
        <?php foreach ($pisos as $numPiso => $pisoData): ?>
          <div class="col-md-12 mb-4">
            <div class="card shadow">
              <div class="card-header bg-success text-white">
                <h2 class="mb-0" style="text-align: center; "><b>Piso: <?= htmlspecialchars($numPiso) ?></b></h2>
              </div>
              <div class="card-body">
                <div class="barra">
                  <div class="sombra"></div>
                  <input type="text" placeholder="Buscar apartamento...">
                  <ion-icon name="search-outline"></ion-icon>
                </div>
                <h4 style="text-align: center;"><b>Apartamento:</b></h4>
                <div class="row">
                  <?php foreach ($pisoData['apartamentos'] as $apartamento): ?>
                    <div class="col-md-6 mb-3">
                      <div class="card card-apartamento">
                        <div class="card-body">
                          <strong>Número:</strong> <?= htmlspecialchars($apartamento['numApartamento']) ?><br>
                          <strong>Descripción:</strong> <?= htmlspecialchars($apartamento['descripcionApartamento']) ?>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="confirmModal<?= htmlspecialchars($apartamento['id_Apartamento']) ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel<?= htmlspecialchars($apartamento['id_Apartamento']) ?>" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel<?= htmlspecialchars($apartamento['id_Apartamento']) ?>">Confirmar Eliminación</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar este apartamento?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form method="POST" action="eliminarapa.php">
                              <input type="hidden" name="id_Apartamento" value="<?= htmlspecialchars($apartamento['id_Apartamento']) ?>">
                              <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
    <br>
    <br>

    <br>
    <br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a href="inicioprincipal.php" class="btn btn-outline-success" style=" font-size:30px;">
        VOLVER
      </a>
    </div>

    <script>
      function confirmDelete(id) {
        if (confirm("¿Está seguro de que desea eliminar este anuncio?")) {
          window.location.href = 'eliminaranuncio.php?id=' + id;
        }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </header>

</body>

</html>