<?php
$host = 'localhost';
$port = '3307';
$db   = 'arquibancada_db';
$user = 'root';
$pass = 'usbw';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    die("Erro de conexão: " . $e->getMessage());
}
?>