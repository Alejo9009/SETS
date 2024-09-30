<?php
session_start();
include_once "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Torre, Piso y Apartamento</title>
</head>
<body>
    <h2>Agregar Torre, Piso y Apartamento</h2>
    <form method="post" action="p.php">
    <!-- Selección de Torre -->
    <label for="torre">Seleccionar Torre:</label>
    <select name="torre" id="torre" required>
        <option value="">Seleccione una Torre</option>
        <?php
        // Aquí se cargan las torres desde la base de datos
        $query = $pdo->query("SELECT * FROM registro_torre");
        while ($row = $query->fetch()) {
            echo '<option value="'.$row['idTorre'].'">'.$row['nombreTorre'].'</option>';
        }
        ?>
    </select>

    <!-- Selección de Piso -->
    <label for="piso">Seleccionar Piso:</label>
    <select name="piso" id="piso" required>
        <option value="">Seleccione un Piso</option>
        <?php
        // Carga dinámica de los pisos
        $query = $pdo->query("SELECT * FROM torre_piso");
        while ($row = $query->fetch()) {
            echo '<option value="'.$row['idPiso'].'">'.$row['nombrePiso'].'</option>';
        }
        ?>
    </select>

    <!-- Selección de Apartamento -->
    <label for="apartamento">Seleccionar Apartamento:</label>
    <select name="apartamento" id="apartamento" required>
        <option value="">Seleccione un Apartamento</option>
        <?php
        // Carga dinámica de los apartamentos
        $query = $pdo->query("SELECT * FROM piso_apto");
        while ($row = $query->fetch()) {
            echo '<option value="'.$row['idApto'].'">'.$row['nombreApto'].'</option>';
        }
        ?>
    </select>

    <input type="submit" value="Guardar">
</form>

</body>
</html>
