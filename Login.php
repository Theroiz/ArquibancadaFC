<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'Conexao.php';
header("Content-Type: application/json; charset=UTF-8");

require 'Conexao.php';
$dados = json_decode(file_get_contents("php://input"));

if (!empty($dados->email) && !empty($dados->senha)) {
    $sql = "SELECT id, email, nome FROM usuario WHERE email = :email AND senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $dados->email, 'senha' => $dados->senha]);
    
    $usuario = $stmt->fetch();

    if ($usuario) {
        http_response_code(200);
        echo json_encode($usuario);
    } else {
        http_response_code(401);
        echo "E-mail ou senha incorretos";
    }
} else {
    http_response_code(400);
    echo "Dados incompletos.";
}
?>