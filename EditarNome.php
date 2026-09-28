<?php
header("Content-Type: application/json; charset=UTF-8");
require 'conexao.php';
$dados = json_decode(file_get_contents("php://input"));

if (!empty($dados->email) && !empty($dados->nome) && isset($dados->biografia)) {
    $sql = "UPDATE usuario SET nome = :nome, biografia = :biografia WHERE email = :email";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            'nome' => $dados->nome,
            'biografia' => $dados->biografia,
            'email' => $dados->email
        ]);
        $sqlBusca = "SELECT id, email, nome, biografia FROM usuario WHERE email = :email";
        $stmtBusca = $pdo->prepare($sqlBusca);
        $stmtBusca->execute(['email' => $dados->email]);
        
        $usuarioAtualizado = $stmtBusca->fetch();
        http_response_code(200);
        echo json_encode($usuarioAtualizado);
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Erro ao atualizar o perfil.";
    }
} else {
    http_response_code(400);
    echo "Dados incompletos.";
}
?>