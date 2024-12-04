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
    <link rel="stylesheet" href="recuperarcontraseña.css?v=<?php echo(rand()); ?>">
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
                        <div class="i">
                            <i class="fas fa-envelope"></i>
                        </div>
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