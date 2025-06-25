<?php
require_once '../seguranca_geral.php';
require_once "../conexao.php";

function redirecionarComErro($erro, $nome = '') {
    $params = http_build_query([
        'erro' => $erro,
        'nome' => $nome,
    ]);
    header("Location: index.php?$params");
    exit;
}

$id_usuario = $_SESSION['id'] ?? null;
if (!$id_usuario) {
    die("Usuário não autenticado.");
}

if (isset($_POST["nome"]) && !empty(trim($_POST["nome"]))) {
    $nome = trim($_POST["nome"]);

    try {
        $checar_nome = $conexao->prepare("SELECT id_categoria FROM categorias WHERE nome = ? AND id_usuario = ?");
        $checar_nome->execute([$nome, $id_usuario]);

        if ($checar_nome->rowCount() > 0) {
            redirecionarComErro(1, $nome);
        }

        $stmt = $conexao->prepare("INSERT INTO categorias (nome, id_usuario) VALUES (?, ?)");
        $stmt->execute([$nome, $id_usuario]);

        header("Location: ../categorias");
        exit;

    } catch (PDOException $erro) {
        echo "Erro ao salvar: " . $erro->getMessage();
    }

} else {
    $nome = $_POST["nome"] ?? '';
    redirecionarComErro(2, $nome);
}
