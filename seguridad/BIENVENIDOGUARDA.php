<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:3000");  
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");  

if (!isset($_SESSION['Usuario'])) {
    header("Location: http://localhost/sets/login.php");
    exit();
}


if ($_SESSION['idRol'] != 3) { // Solo si el rol es "residente" (idRol == 4)
    header("Location: http://localhost/sets/error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida Guarda Seguridad</title>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/styl.css?v=<?php echo (rand()); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <header>
        <h1>¡Bienvenido a SETS!</h1>
        <h2>Gracias por Registrarte con Nosotros.</h2>
    </header>
    <main>
        <img src="img/guarda.png" alt="Bienvenida" style="width: 30%;">
       <br>
        <p><b>Estamos Emocionados de tenerte con nosotros Guarda de Seguridad <br>
         .Ahora Continua e Inicia en este nuevo Mundo:</b></p>
        
        <a href="inicioprincipal.php" class="btn btn-success btn-lg">Iniciar</a>
    </main>
   
</body>
</html>
