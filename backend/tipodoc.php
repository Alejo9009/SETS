
<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "set");

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$result = $conn->query("SELECT idtDoc, descripcionDoc FROM tipodoc");
$tipodocs = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($tipodocs);
$conn->close();
?>