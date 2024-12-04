<?php
header('Access-Control-Allow-Origin: http://localhost:3000/');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETS - Recuperar Contraseña</title>
    <link rel="stylesheet" href="recuperarcontraseña.css?v=<?php echo (rand()); ?>">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../SETS/img/c.png" type="image/x-icon" />
</head>

<body>

    <main>
        <section class="container">
            <article class="login-content">
                <form action="recuperar.html" method="post">
                    <figure>
                        <img src="img/c.png" alt="Logo">
                    </figure>
                    <h2 class="title">Recuperar Contraseña</h2>
                    <div class="input-div one">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16" style="background-color: #e8f5e9;">
                            <path d="M6.445 11.688V6.354h-.633A13 13 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23" />
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                        </svg>
                        <div class="div">

                            <input type="email" class="input" name="correo" required placeholder="Correo">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success  btn-lg" value="Enviar">
                    <p><a href="http://localhost:3000/login" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Iniciar Sesión</a></p>
                </form>
            </article>
        </section>
    </main>
    <script type="text/javascript" src="JAVA/main.js"></script>
</body>

</html>