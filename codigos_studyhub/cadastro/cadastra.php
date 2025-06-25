<?php
session_start();
require_once "../conexao.php";

function redirecionarComErro($erro, $email = '') {
    $_SESSION['erro'] = $erro;
    $_SESSION['email'] = $email;
    header("Location: index.php");
    exit;
}

if (
    isset($_POST["email"], $_POST["senha"], $_POST["confirmar_senha"]) &&
    !empty(trim($_POST["email"])) &&
    !empty(trim($_POST["senha"])) &&
    !empty(trim($_POST["confirmar_senha"]))
) {
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    if ($senha !== $confirmar_senha) {
        redirecionarComErro(1, $email);
    }

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $checar_email = $conexao->prepare("SELECT id FROM aluno WHERE email = ?");
        $checar_email->execute([$email]);

        if ($checar_email->rowCount() > 0) {
            redirecionarComErro(2, $email);
        }

        $stmt = $conexao->prepare("INSERT INTO aluno (email, senha) VALUES (?, ?)");
        $stmt->execute([$email, $senhaCriptografada]);

        header("Location: ../login");
        exit;

    } catch (PDOException $erro) {
        echo "Erro ao salvar: " . $erro->getMessage();
    }
} else {
    $email = $_POST["email"] ?? '';
    redirecionarComErro(3, $email);
}
