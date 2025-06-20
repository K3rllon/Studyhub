<?php
require_once "../conexao.php";

if (isset($_POST["nome"]) AND !empty($_POST["nome"])) {

    $nome = $_POST["nome"];
    
    try {

        $checar_nome = $conexao->prepare("SELECT id_categoria FROM categorias WHERE nome = ?");
        $checar_nome->bindParam(1, $nome);
        $checar_nome->execute();

        if ($checar_nome->rowCount() > 0) {
            header("Location: index.php?erro=1");
            exit;
        }

        $stmt = $conexao->prepare("INSERT INTO categorias (nome) VALUES (?) ");
        $stmt->bindParam(1, $nome);
        $stmt->execute();

        header("Location: index.php?categoria_cadastrada");
        exit;

    } catch (PDOException $erro) {
        echo "Erro ao salvar: " . $erro->getMessage();
    }
} else {
    header("Location: index.php?erro=2");
    exit;
}
?>
