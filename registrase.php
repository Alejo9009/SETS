<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "set";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$tipodoc_result = $conn->query("SELECT * FROM tipodoc");
$tipodocs = $tipodoc_result->fetch_all(MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="REGISTRARSE.css?v=<?php echo (rand()); ?>">
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
                <form action="./backend/regi.php" method="post">
                    <fieldset class="form-group">
                        <legend class="fieldset-legend">Rol</legend>
                        <label for="rol">Rol:</label>
                        <select id="rol" name="rol" class="form-select" required>
                            <?php foreach ($roles as $role):?>
                                <option value="<?php echo $role['id']; ?>"><?php echo $role['Roldescripcion'];?></option>
                            <?php endforeach; ?>

                            </select>

                    </fieldset>

                    <fieldset class="form-group">

                        <label for="idRol">Escoge el numero segun el Rol:</label>
                        <select id="idRol" name="idRol" class="form-select" required>
                          <?php foreach ($roles as $role): ?>
                             <option value="<?php echo $role['id']; ?>"><?php echo $role['id']; ?></option>
                          <?php endforeach; ?>
                </fieldset>
                </select>
                <br>
                <p>
                    <fieldset class="form-group">
                        <legend class="fieldset-legend">Datos Personales</legend>
                        <div class="mb-3">
                            <label for="Id_tipoDocumento" class="form-label">Tipo de Documento:</label>
                            <select id="Id_tipoDocumento" name="Id_tipoDocumento" class="form-select" required>
                                <?php foreach ($tipodocs as $doc): ?>
                                    <option value="<?php echo $doc['idtDoc']; ?>"><?php echo $doc['descripcionDoc']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="numeroDocumento" class="form-label">Número de Documento:</label>
                            <input type="number" id="numeroDocumento" name="numeroDocumento" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="PrimerNombre" class="form-label">Primer Nombre:</label>
                            <input type="text" id="PrimerNombre" name="PrimerNombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="SegundoNombre" class="form-label">Segundo Nombre:</label>
                            <input type="text" id="SegundoNombre" name="SegundoNombre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="PrimerApellido" class="form-label">Primer Apellido:</label>
                            <input type="text" id="PrimerApellido" name="PrimerApellido" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="SegundoApellido" class="form-label">Segundo Apellido:</label>
                            <input type="text" id="SegundoApellido" name="SegundoApellido" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="Correo" class="form-label">Correo:</label>
                            <input type="email" id="Correo" name="Correo" class="form-control" required>
                        </div>

                        <fieldset class="form-group">
                            <legend class="fieldset-legend">Teléfono</legend>
                            <div class="mb-3">
                                <label for="telefonoUno" class="form-label">Número de Teléfono 1:</label>
                                <input type="number" id="telefonoUno" name="telefonoUno" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefonoDos" class="form-label">Número de Teléfono 2:</label>
                                <input type="number" id="telefonoDos" name="telefonoDos" class="form-control" required>
                            </div>
                        </fieldset>

                        <div class="mb-3">
                            <label for="Usuario" class="form-label">Usuario:</label>
                            <input type="text" id="Usuario" name="Usuario" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="Clave" class="form-label">Clave:</label>
                            <input type="password" id="Clave" name="Clave" class="form-control" required>
                        </div>
                    </fieldset>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Registrar</button>

                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <a href="http://localhost:3000/" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Iniciar Sesion</a>
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