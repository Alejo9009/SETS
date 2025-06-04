<?php
$host = 'sets.mysql.database.azure.com';
$usuario = 'wolwerine24@sets';  
$contrasena = 'Apartamento12';
$nombre_bd = 'sets';
$ssl_cert = '../ssl/DigiCertGlobalRootCA.crt.pem'; 

$opciones = [
    PDO::MYSQL_ATTR_SSL_CA => $ssl_cert,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    $dsn = "mysql:host=$host;dbname=$nombre_bd;charset=utf8mb4";
    $base_de_datos = new PDO($dsn, $usuario, $contrasena, $opciones);
    echo "Conexión segura establecida con SSL";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>