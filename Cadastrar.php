<?php
header("Content-Type: application/json; charset=UTF-8");

require 'conexao.php';
$dados = json_decode(file_get_contents("php://input"));

if (!empty($dados->email) && !empty($dados->senha)) {
    $sql = "INSERT INTO usuario (email, senha) VALUES (:email, :senha)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute(['email' => $dados->email, 'senha' => $dados->senha]);
        http_response_code(201);
        echo "Conta criada com sucesso!";
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) { // Codigo 1062 (email rep)
            http_response_code(400);
            echo "Erro: E-mail ja cadastrado!";
        } else {
            http_response_code(500);
            echo "Erro interno do servidor.";
        }
    }
} else {
    http_response_code(400);
    echo "Preencha e-mail e senha.";
}
?>