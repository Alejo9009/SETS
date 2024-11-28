<?php
include 'conexion.php';

$id = $_GET['id'];

try {
    $sql = "DELETE FROM anuncio WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute(['id' => $id]);

    header('Location: index.php');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
