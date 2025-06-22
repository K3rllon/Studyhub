<?php
require_once "../conexao.php";

if (isset($_REQUEST["act"]) AND $_REQUEST["act"] == "del" AND !empty($_REQUEST["id_arquivos"])) {
    $id = intval($_REQUEST["id_arquivos"]);
    
    try {
        $stmt = $conexao->prepare("DELETE FROM arquivos WHERE id_arquivos = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: index.php?msg=excluido");
            exit();
        } else {
            throw new PDOException("Error ao executar a exclussão."); 

        }
    } catch (PDOException $erro) {
    echo "Erro: " . $erro->getMessage();
}
}
?>