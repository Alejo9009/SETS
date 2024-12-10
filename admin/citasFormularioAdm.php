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

if ($datosRol['idRol'] != 1) { // Solo si el rol es "residente" (idRol == 4)
    header("Location: http://localhost/sets/error.php");
    exit();
}


// Para respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['responder'])) {
    $id = $_POST['id'];
    $respuesta = $_POST['respuesta'];

    // Ya al tener una respuesta y actualizar
    $sql = "UPDATE citas SET respuesta = :respuesta, estado = 'respondida' WHERE id = :id";
    $stmt = $base_de_datos->prepare($sql);
    
    if ($stmt->execute(['respuesta' => $respuesta, 'id' => $id])) {
        
    } else {
        echo "Error al enviar la respuesta.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['delete_id'];

    // Borrar una cita
    $sql = "DELETE FROM citas WHERE id = :id";
    $stmt = $base_de_datos->prepare($sql);
    
    if ($stmt->execute(['id' => $id])) {
        
    } else {
        echo "Error al eliminar la cita.";
    }
}

// Tener las citas
$sql = "SELECT * FROM citas";
$stmt = $base_de_datos->query($sql);
$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CItAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/citasFormularioAdm.css">
</head>
<body>
    <header>
        <nav class="topbar">
            <div class="menu-left">
            <img src="img/ajustes.png" alt="Logo" width="80" height="84" class="d-inline-block align-text-top" style="background-color: #0e2c0a;">
            <b style="font-size: 40px;color:aliceblue"> ADMIN - <?php echo htmlspecialchars($nombreUsuario); ?>  </b></a> <ul class="dropdown-menu">
                    <a href="Perfil.html">Editar datos</a>
                   <a href="#">Reportar problema</a>
                    <a href="../backend/logout.php">Cerrar sesión</a>
                </ul>
                <a href="notificaciones.html">
                    <img src="img/notificacion.png" alt="Notificaciones" class="notification">
                </a>
            </div>
            <div class="menu-right">
                <div class="chat">
                    <img src="img/hablando.png" alt="Chat" class="chat-button" id="chatToggle">
                    <img src="img/C.png" alt="Chat" class="chat-button">
                    <div class="chat-menu">
                        <div class="search-container">
                            <input type="text" placeholder="Buscar" class="search-bar" onkeyup="filterChat()">
                        </div>
                        <br>
                        <ul class="chat-links">
                            <a href="#" class="chat-item" onclick="openChat('Admi')">Admi</a>
                            <a href="#" class="chat-item" onclick="openChat('Administrador')">Administrador</a>
                            <a href="#" class="chat-item" onclick="openChat('Guarda De Seguridad')">Guarda DE Seguridad</a>
                             <a href="#" class="chat-item" onclick="openChat('Chat Comunal')">Chat Comunal</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 mt-5">
                <h2>Control de citas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Caracter</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Respuesta</th>
                        <th>Acciones</th>
                        <th>Proceso</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($citas as $cita): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cita['opcion']); ?></td>
                    <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                    <td><?php echo htmlspecialchars($cita['estado']); ?></td>
                    <td><?php echo htmlspecialchars($cita['respuesta']); ?></td>
                    <td>
                        <a class="btn btn-secondary" href="editar.php?id=<?php echo $cita['id']; ?>">Editar</a>

                        <form action="" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cita?');">
                            <input type="hidden" name="delete_id" value="<?php echo $cita['id']; ?>">
                            <button class="btn btn-danger mt-3" type="submit" name="delete">Eliminar</button>
                            <link rel="stylesheet" href="administrar.css">
                        </form>
                    </td>
                    <td>
                        <?php if ($cita['estado'] == 'pendiente'): ?>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $cita['id']; ?>">
                            <textarea name="respuesta" required placeholder="Escribe tu respuesta aquí"></textarea>
                            <button class="btn btn-secondary" type="submit" name="responder">Enviar Respuesta</button>
                        </form>
                        <?php else: ?>
                        <span>Respondida</span>
                        <?php endif; ?> 
                    </td>
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="container">
        <a class="btn btn-success" href="inicioprincipal.php">Volver</a>
    </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>