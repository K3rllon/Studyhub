<?php
require_once "../conexao.php";

if (isset($_REQUEST["act"]) AND $_REQUEST["act"] == "del" AND !empty($_REQUEST["id_categoria"])) {
    $id = intval($_REQUEST["id_categoria"]);
    
    try {
        $stmt = $conexao->prepare("DELETE FROM categorias WHERE id_categoria = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "deucerto";
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