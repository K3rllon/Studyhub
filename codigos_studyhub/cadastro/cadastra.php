<?php
require_once "../conexao.php";

if (isset($_POST["email"], $_POST["senha"], $_POST["confirmar_senha"]) AND !empty($_POST["email"]) AND  !empty($_POST["senha"]) AND !empty($_POST["confirmar_senha"])) {

    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    if ($senha != $confirmar_senha) {
        header("Location: index.php?erro=1");
        exit;
    }

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    try {

        $checar_email = $conexao->prepare("SELECT id FROM aluno WHERE email = ?");
        $checar_email->bindParam(1, $email);
        $checar_email->execute();

        if ($checar_email->rowCount() > 0) {
            header("Location: index.php?erro=2");
            exit;
        }

        $stmt = $conexao->prepare("INSERT INTO aluno (email, senha) VALUES (?, ?) ");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $senhaCriptografada);
        $stmt->execute();

        header("Location: index.php?cadastro_susucedido");
        exit;

    } catch (PDOException $erro) {
        echo "Erro ao salvar: " . $erro->getMessage();
    }
} else {
    header("Location: index.php?erro=3");
     exit;
}
?>
