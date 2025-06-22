<?php
require_once "../conexao.php";

if (
    isset($_POST["nome"]) && !empty(trim($_POST["nome"])) &&
    isset($_POST["tipo"]) && !empty(trim($_POST["tipo"])) &&
    isset($_POST["formato"]) && !empty(trim($_POST["formato"])) &&
    isset($_POST["categoria"]) && !empty(trim($_POST["categoria"])) &&
    isset($_FILES["arquivo"]) && $_FILES["arquivo"]["error"] === UPLOAD_ERR_OK
) {

    $nome = $_POST["nome"];
    $tipo_conteudo = $_POST["tipo"];
    $formato = $_POST["formato"];
    $id_categoria = $_POST["categoria"];

    $arquivo = $_FILES["arquivo"];
    $nome_original = $arquivo["name"];
    $nome_final = uniqid() . "_" . basename($nome_original);

    $pasta_destino = __DIR__ . "/uploads";
    if (!is_dir($pasta_destino)) {
        mkdir($pasta_destino, 0777, true);
    }

    $caminho_arquivo = $pasta_destino . "/" . $nome_final;
    $caminho_banco = "uploads/" . $nome_final;

    if (move_uploaded_file($arquivo["tmp_name"], $caminho_arquivo)) {
        try {
            $stmt = $conexao->prepare("INSERT INTO arquivos (nome, tipo, formato, caminho_arquivo, id_categorias) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $tipo_conteudo, $formato, $caminho_banco, $id_categoria]);

            header("Location: index.php?arquivo_criado");
            exit;
        } catch (PDOException $erro) {
            echo "Erro ao salvar: " . $erro->getMessage();
        }
    } else {
        echo "Erro ao mover o arquivo para o servidor.";
    }
} else {
    header("Location: index.php?erro=2");
    exit;
}
?>
