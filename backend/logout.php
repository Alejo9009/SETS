<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:3000");  
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");  

// Eliminar la cookie
setcookie('auth_token', '', time() - 3900, "/", "localhost", false, true);


session_destroy();


header("Location: http://localhost/SETS/");
exit();
?>