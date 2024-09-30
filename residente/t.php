<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Torre, Piso y Apartamento</title>
</head>
<body>
    <h2>Agregar Torre, Piso y Apartamento</h2>
    <form action="p.php" method="POST">
        <h3>Torre</h3>
        <h3>Piso</h3>
        <label for="piso">Número de Piso:</label>
        <input type="number" name="piso" required>

        <h3>Apartamento</h3>
        <label for="apartamento">Número de Apartamento:</label>
        <input type="number" name="apartamento" required>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
