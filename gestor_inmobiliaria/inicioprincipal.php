<?php
include_once "conexion.php";
if (!$base_de_datos) {
    exit('Error en la conexión a la base de datos.');
}

$sql = "SELECT * FROM anuncio";
$result = $base_de_datos->query($sql);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $isEvent = strpos($row["titulo"], "Evento") !== false;
    }
}
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Preparar la consulta SQL

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de inmobiliaria </title>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/principal.css?v=<?php echo (rand()); ?>">
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
        </header>
        <br><br>
        <br>
        <br>
        <main>
            <div class="container text-center">
                <div class="row">
         
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="icon">
                            <a href="torres.php" class="link-button">
                                <img src="img/casa.png" alt="Torres" class="medium-img">
                                <button class="add-announcement">Torre</button>
                            </a>
                        </div>
                    </div>

              
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="icon">
                            <a href="parqueaderocarro.php" class="link-button">
                                <img src="img/coche.png" alt="Parqueadero" class="medium-img">
                                <button class="add-announcement">Parqueadero</button>
                            </a>
                        </div>
                    </div>

              
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="icon">
                            <a href="zonas_comunes.php" class="link-button">
                                <img src="img/campo.png" alt="Zonas Comunes" class="medium-img">
                                <button class="add-announcement">Zonas Comunes</button>
                            </a>
                        </div>
                    </div>

         
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="icon">
                            <a href="manualconvivencia.php" class="link-button">
                                <img src="img/instrucciones.png" alt="Manual de convivencia" class="medium-img">
                                <center><button class="add-announcement">Manual de convivencia</button></center>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="icon">
                            <a href="datos_usuario.php" class="link-button">
                                <img src="img/inf.png" alt="Datos Usuarios" class="medium-img">
                                <button class="add-announcement">Datos Usuario</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="icon">
                            <a href="citas.php" class="link-button">
                                <img src="img/citas.png" alt="Citas con amd" class="medium-img">
                                <button class="add-announcement">Citas</button>
                            </a>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </main>

    <br>
    <br><br>
    <main>
            <div class="container">
                <section class="announcements">
                    <center>
                        <h2>Anuncios</h2>
                    </center>
                    <div class="search-container">
                        <form onsubmit="return searchAnnouncements();">
                            <input type="text" id="search-input" placeholder="Buscar Anuncio">
                            <img src="img/lupa.png" alt="Buscar" class="search-icon">
                        </form>
                    </div>
                
                    <div id="announcements">
                        <?php
                        $sql = "SELECT * FROM anuncio";
                        $result = $base_de_datos->query($sql);
                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                <div class="announcement" id="announcement-<?= htmlspecialchars($row['titulo']); ?>">
                                    <img src="<?= htmlspecialchars($row['img_anuncio']); ?>" alt="Imagen" style="width:90%; max-width:90px;"><br>
                                    <p><b>Anuncio:</b> <?= htmlspecialchars($row["titulo"]); ?><br>
                                        <b>Descripcion:</b> <?= htmlspecialchars($row["descripcion"]); ?><br>
                                        <b>Fecha  Publicación: </b><?= htmlspecialchars($row["fechaPublicacion"]); ?><br>
                                        <b>Hora de Publicación:</b> <?= htmlspecialchars($row["horaPublicacion"]); ?><br>
                                    </p>
                                    <button class="delete-button" onclick="deleteAnnouncement('<?= htmlspecialchars($row['titulo']); ?>')">Eliminar</button>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>No se encontraron anuncios.</p>";
                        }
                        ?>
                    </div>
                </section>
                <script>
                    function deleteAnnouncement(titulo) {
                        if (confirm("¿Está seguro de que desea eliminar este anuncio?")) {

                            fetch('./servidor-anuncios/anuncio.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: new URLSearchParams({
                                        'titulo': titulo,
                                        'accion': 'eliminar'
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {

                                        document.getElementById('announcement-' + titulo).remove();
                                        alert(data.message);
                                    } else {
                                        alert(data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error al eliminar el anuncio:', error);
                                    alert("Hubo un error al eliminar el anuncio.");
                                });
                        }
                    }
                </script>
                <div class="icon">
                    <a href="añadiranuncio.php" class="link-button">
                        <button class="add-announcement">Añadir Anuncio</button>
                    </a>
                </div>
            </div>
            <script>
                function searchAnnouncements() {
                    var query = document.getElementById('search-input').value;
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', './servidor-anuncios/buscador.php?query=' + encodeURIComponent(query), true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            document.getElementById('announcements').innerHTML = xhr.responseText;
                        } else {
                            console.error('Error en la búsqueda:', xhr.statusText);
                        }
                    };
                    xhr.send();
                    return false;
                }
            </script>
        <script>
            function confirmDelete(id) {
                if (confirm("¿Está seguro de que desea eliminar este anuncio?")) {
                    window.location.href = 'eliminaranuncio.php?id=' + id;
                }
            }
        </script>
     <script>
                const searchEventInput = document.getElementById('searchEventInput');
                const events = document.querySelectorAll('.event');

                searchEventInput.addEventListener('input', function() {
                    const filter = searchEventInput.value.toLowerCase();

                    events.forEach(function(event) {
                        const text = event.textContent.toLowerCase();
                        if (text.includes(filter)) {
                            event.style.display = 'block';
                        } else {
                            event.style.display = 'none';
                        }
                    });
                });
            </script>
            <script>
                const searchInput = document.getElementById('searchInput');
                const announcements = document.querySelectorAll('.announcement');


                searchInput.addEventListener('input', function() {
                    const filter = searchInput.value.toLowerCase();


                    announcements.forEach(function(announcement) {
                        const text = announcement.textContent.toLowerCase();
                        if (text.includes(filter)) {
                            announcement.style.display = 'block';
                        } else {
                            announcement.style.display = 'none';
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