<?php
session_start();
include_once "conexion.php";


if (!isset($_SESSION['usuario'])) {
    header("Location: ../SETS/login.php");
    exit();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: ../SETS/registrase.php");
    exit();
}

$idRegistro = $_SESSION['id_Registro'] ?? null;
if ($idRegistro === null) {
    die("Error: ID de registro no está disponible en la sesión.");
}

// Recuperar los datos del usuario 
$sql = "SELECT r.PrimerNombre, r.SegundoNombre, r.PrimerApellido, r.SegundoApellido, r.Correo, r.Usuario, r.numeroDocumento , t.numeroTel, rd.Roldescripcion  , r.imagenPerfil
        FROM registro r
        JOIN telefono t ON r.id_Registro = t.person
        JOIN rol_registro rr ON r.id_Registro = rr.idRegistro
        JOIN rol rd ON rr.idROL = rd.id
        WHERE r.id_Registro = ?";
$stmt = $base_de_datos->prepare($sql);
$stmt->execute([$idRegistro]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);


if ($userData === false) {
    die("Error: No se pudieron recuperar los datos del usuario.");
}

// Manejar la subida 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar 
    if (isset($_FILES['imagenPerfil']) && $_FILES['imagenPerfil']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imagenPerfil']['tmp_name'];
        $fileName = basename($_FILES['imagenPerfil']['name']);
        $fileSize = $_FILES['imagenPerfil']['size'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Verificar si el archivo es una imagen real
        $check = getimagesize($fileTmpPath);
        if ($check === false) {
            echo "El archivo no es una imagen.";
            exit;
        }

        // Verificar el tamaño del archivo (máximo 2MB)
        if ($fileSize > 1000000) {
            echo "El archivo es demasiado grande.";
            exit;
        }

       
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExtension, $allowedTypes)) {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            exit;
        }

  
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $targetFilePath = $targetDir . $fileName;
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {

            $sql = "UPDATE registro SET imagenPerfil = ? WHERE id_Registro = ?";
            $stmt = $base_de_datos->prepare($sql);
            if ($stmt->execute([$targetFilePath, $idRegistro])) {
                echo "La imagen se ha subido correctamente.";
            } else {
                echo "Hubo un error al actualizar la base de datos.";
            }
        } else {
            echo "Hubo un error al subir la imagen.";
        }
    }


    $PrimerNombre = $_POST['profile-firstname'] ?? '';
    $SegundoNombre = $_POST['profile-secondname'] ?? '';
    $PrimerApellido = $_POST['profile-firstlastname'] ?? '';
    $SegundoApellido = $_POST['profile-secondlastname'] ?? '';
    $email = $_POST['profile-email'] ?? '';
    $usuario = $_POST['profile-username'] ?? '';
    $telefono = $_POST['profile-phone'] ?? ''; 

    $sql = "UPDATE registro r
    JOIN telefono t ON r.id_Registro = t.person
    SET r.PrimerNombre = ?, 
        r.SegundoNombre = ?, 
        r.PrimerApellido = ?, 
        r.SegundoApellido = ?, 
        r.Correo = ?, 
        r.Usuario = ?, 
        t.numeroTel = ? 
    WHERE r.id_Registro = ?";
    
    $stmt = $base_de_datos->prepare($sql);
    if ($stmt->execute([$PrimerNombre, $SegundoNombre, $PrimerApellido, $SegundoApellido, $email, $usuario, $telefono, $idRegistro])) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos.";
    }

   
    if (!empty($_POST['profile-password'])) {
        $clave = $_POST['profile-password'];
      
        $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
        $sql = "UPDATE registro SET Clave = ? WHERE id_Registro = ?";
        $stmt = $base_de_datos->prepare($sql);
        if ($stmt->execute([$claveEncriptada, $idRegistro])) {
            echo "Clave actualizada con éxito.";
        } else {
            echo "Error al actualizar la clave.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETS -Editar Perfil</title>
    <link rel="stylesheet" href="css/editarperfil.css?v=<?php echo (rand()); ?>">
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <br><br>
    <br><br>
    <main>
        <section id="chatContainer" class="chat-container z-3 position-fixed p-5 rounded-3" style="z-index: 1000; bottom: 20px; right: 20px;">
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
    <br>
    <br>
    <br>
    <main>
        <section class="profile-card" style="border: 6px solid #052910;">
            <form action="procesar_datos.php" method="POST" enctype="multipart/form-data">
              
    <div class="alert alert-success" role="alert">
        <center>
    <h2 class="profile-name">Editar Perfil</h2>
    </center>
    </div>
                <div class="text-center">
                    <img id="imagenSeleccionada" src="<?php echo htmlspecialchars($userData['imagenPerfil'] ?? 'img/guarda.png'); ?>" alt="Imagen de Perfil" width="120"><br>
                    <input type="file" name="imagenPerfil" onchange="mostrarImagenSeleccionada(this);" style="color: rgb(45, 110, 59);"><br>
                </div>
                

                <br>
                <label for="profile-firstname">Primer Nombre:</label><br>
                <input type="text" id="profile-firstname" name="profile-firstname" value="<?php echo htmlspecialchars($userData['PrimerNombre']); ?>"><br>

                <label for="profile-secondname">Segundo Nombre:</label><br>
                <input type="text" id="profile-secondname" name="profile-secondname" value="<?php echo htmlspecialchars($userData['SegundoNombre']); ?>"><br>

                <label for="profile-firstlastname">Primer Apellido:</label><br>
                <input type="text" id="profile-firstlastname" name="profile-firstlastname" value="<?php echo htmlspecialchars($userData['PrimerApellido']); ?>"><br>

                <label for="profile-secondlastname">Segundo Apellido:</label><br>
                <input type="text" id="profile-secondlastname" name="profile-secondlastname" value="<?php echo htmlspecialchars($userData['SegundoApellido']); ?>"><br>

                <label for="profile-email">Correo Electrónico:</label><br>
                <input type="email" id="profile-email" name="profile-email" value="<?php echo htmlspecialchars($userData['Correo']); ?>"><br>

                <label for="profile-username">Usuario:</label><br>
                <input type="text" id="profile-username" name="profile-username" value="<?php echo htmlspecialchars($userData['Usuario']); ?>"><br>

                <label for="profile-phone">Teléfono:</label><br>
                <input type="text" id="profile-phone" name="profile-phone" value="<?php echo htmlspecialchars($userData['numeroTel']); ?>"><br>

                <label for="profile-password">Nueva Contraseña:</label><br>
                <input type="password" id="profile-password" name="profile-password"><br>

                <input type="submit" value="Guardar Cambios" class="btn btn-success" style="margin-top: 10px;">
            </form>
        </section>
        <a href="perfil.php" type="button" class="btn btn-danger btn-lg">Volver</a>
    </main>

    <script>
        function mostrarImagenSeleccionada(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagenSeleccionada').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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