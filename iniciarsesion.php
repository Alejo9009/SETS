<?php
include_once "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETS - Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css?v=<?php echo (rand()); ?>">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: url('img/t.jpg') no-repeat center center fixed;
            background-size: cover;
        }


        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            height: 100%;
        }

        .row {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .col-md-6 {
            padding: 0;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        form {
            width: 100%;
        }

        .bg-white {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
        }

        .input-div {
            margin-bottom: 1.5rem;
        }

        .input-div h5 {
            margin-bottom: 0.5rem;
            color: #083d11;
        }

        .btn-primary {
            background: linear-gradient(90deg, #12460d, #4ba281);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #4ba252, #66ea83, #2d7c54);
        }

        a {
            color: #133f0a;
        }

        a:hover {
            text-decoration: none;
            color: #27945170;
        }
    </style>
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-md-6 bg-white">
                <form action="login.php" method="post">
                    <center>
                        <header class="text-center mb-4 d-flex flex-column align-items-center">
                            <img src="img/c.png" alt="Logo" class="mb-3">
                            <h2 class="title text-center">SETS <br>BIENVENIDO</h2>
                        </header>
                    </center>
                    <section class="input-div mb-3 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                        <div class="flex-grow-1">
                            <h5 class="mb-2">Usuario</h5>
                            <input type="text" class="form-control" id="usuario" name="usuario" required style="color: #12460d;">
                        </div>
                    </section>
                    <section class="input-div mb-4 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-key me-2" viewBox="0 0 16 16">
                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8m4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5" />
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                        </svg>
                        <div class="flex-grow-1">
                            <h5 class="mb-2">Clave</h5>
                            <input type="password" class="form-control" id="clave" name="clave" required style="color: #12460d;">
                        </div>
                    </section>
                    <nav class="text-center">
                        <button type="submit" class="btn btn-primary btn-block mb-3">Ingresar</button>
                        <div class="d-flex justify-content-between">
                            <a href="registrase.php">Registrarse</a>
                            <a href="recuperarcontraseña.php">Recuperar Contraseña</a>
                            <a href="index.php">Volver</a>
                        </div>
                    </nav>
                </form>

            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>