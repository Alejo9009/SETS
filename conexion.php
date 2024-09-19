<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sets";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
