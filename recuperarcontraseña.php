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
                            <h5>Correo</h5>
                            <input type="email" class="input" name="correo" required>
                        </div>
                    </div>
                    <input type="submit" class="btn" value="Enviar">
                    <p><a href="iniciarsesion.php">Iniciar Sesión</a></p>
                </form>
            </article>
        </section>
    </main>
    <script type="text/javascript" src="JAVA/main.js"></script>
</body>
</html>