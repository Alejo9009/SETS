<?php
include 'conexion.php';

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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/citasFormulario.css">
</head>
<body>
<header>
        <nav class="topbar">
            <div class="menu-left">
                <img src="img/resi.png" alt="Admin" class="admin-img">
                <a href="#" class="menu-button" style="color: aliceblue;">Residente</a>
                <ul class="dropdown-menu">
                    <a href="Perfil.html">Editar datos</a>
                   <a href="#">Reportar problema</a>
                    <a href="index.html">Cerrar sesión</a>
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
        <div class="col-sm-12 col-md-3 col-lg-4 mt-5">
            <form action="createCita.php" method="post">
                <fieldset>
                    <legend>Agendar cita</legend>
                    <div class="mb-3">
                        <label for="opcion" class="form-label">Tipo de cita:</label>
                            <select name="opcion" id="opcion" class="form-select">
                                <option selected value="Administrativo">Administrativo (1h)</option>
                                <option value="Reclamo">Reclamo (1h)</option>
                                <option value="Duda">Duda (1h)</option>
                            </select>   
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora:</label>
                        <input type="time" class="form-control" step="3600" min="08:00" max="17:00" id="hora" name="hora" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit">Enviar</button>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 mt-5">
            <h2>Panel de citas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Tipo de cita</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Acciones</th>

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
                        <a class="btn btn-secondary href="editar.php?id=<?php echo $cita['id']; ?>">Editar</a>

                        <form action="" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cita?');">
                            <input type="hidden" name="delete_id" value="<?php echo $cita['id']; ?>">
                            <button class="btn btn-danger mt-3 type="submit" name="delete">Eliminar</button>
                        </form>
                    </td>
                    
                </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
   </div> 
</div>
<div class="container mt-5">
    <a href="inicioprincipal.php" class="btn btn-success" >Volver</a>
</div>






<script src="js/ver.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>