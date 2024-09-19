<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sets";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los tipos de documentos
$tipodoc_result = $conn->query("SELECT * FROM tipodoc");
$tipodocs = $tipodoc_result->fetch_all(MYSQLI_ASSOC);

// Obtener los roles
$rol_result = $conn->query("SELECT * FROM rol");
$roles = $rol_result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="shortcut icon" href="img/c.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: url('img/t.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            margin-top: 30px;
            max-width: 600px;
        }

        .form-control,
        .form-select {
            border-radius: 0.25rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            border-radius: 0.25rem;
            padding: 0.75rem 1.25rem;
        }

        .fieldset-legend {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <center>
                    <header class="text-center mb-4 d-flex flex-column align-items-center">
                        <img src="img/c.png" alt="Logo" class="mb-3">
                        <h2 class="title text-center"><b>SETS <br>Registro </b></h2>
                    </header>
                </center>
                <form action="regi.php" method="post">
                    <fieldset class="form-group">
                        <legend class="fieldset-legend">Rol</legend>
                        <label for="rol">Rol:</label>
                        <select id="rol" name="rol" class="form-select" required>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?php echo $role['id']; ?>"><?php echo $role['Roldescripcion']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </fieldset>

                    <fieldset class="form-group">
                        <legend class="fieldset-legend">Datos Personales</legend>
                        <div class="mb-3">
                            <label for="tipoDocumento" class="form-label">Tipo de Documento:</label>
                            <select id="tipoDocumento" name="tipoDocumento" class="form-select" required>
                                <?php foreach ($tipodocs as $doc): ?>
                                    <option value="<?php echo $doc['idtDoc']; ?>"><?php echo $doc['DescripcionDoc']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="numeroDocumento" class="form-label">Número de Documento:</label>
                            <input type="text" id="numeroDocumento" name="numeroDocumento" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="primerNombre" class="form-label">Primer Nombre:</label>
                            <input type="text" id="primerNombre" name="primerNombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="segundoNombre" class="form-label">Segundo Nombre:</label>
                            <input type="text" id="segundoNombre" name="segundoNombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="primerApellido" class="form-label">Primer Apellido:</label>
                            <input type="text" id="primerApellido" name="primerApellido" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="segundoApellido" class="form-label">Segundo Apellido:</label>
                            <input type="text" id="segundoApellido" name="segundoApellido" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="email" id="correo" name="correo" class="form-control" required>
                        </div>

                        <fieldset class="form-group">
                            <legend class="fieldset-legend">Teléfono</legend>
                            <div class="mb-3">
                                <label for="numeroTel" class="form-label">Número de Teléfono:</label>
                                <input type="text" id="numeroTel" name="numeroTel" class="form-control" required>
                            </div>
                        </fieldset>

                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario:</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="clave" class="form-label">Clave:</label>
                            <input type="password" id="clave" name="clave" class="form-control" required>
                        </div>
                    </fieldset>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Registrar</button>

                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <a href="iniciarsesion.php" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Iniciar Sesion</a>
                        <a href="recuperarcontraseña.php" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Recuperar Contraseña</a>
                        <a href="index.php" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Volver</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-gggZ3fMgbQk6H62v1R9kjUl9c9vLb8EN6MC95aFv6IXhV2mKtnD5G2vU0c3fLaQz3" crossorigin="anonymous"></script>
</body>

</html>