<?php
$host = 'sets.mysql.database.azure.com';
$username = 'wolwerine24@sets'; 
$password = 'Apartamento12';    
$db_name = 'sets';              
$ssl_cert = '../ssl/DigiCertGlobalRootCA.crt.pem';  

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, $ssl_cert, NULL, NULL);
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);

if (mysqli_connect_errno()) {
    die('❌ Error de conexión: ' . mysqli_connect_error());
} else {
    echo '✅ Conectado a Azure MySQL con SSL';
}
?>