<?php
require_once '../seguranca_geral.php';
require_once "../conexao.php";

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && !empty($_REQUEST["id_categoria"])) {
    $id_categoria = intval($_REQUEST["id_categoria"]);
    $id_usuario = $_SESSION['id'];

    try {
        $check = $conexao->prepare("SELECT 1 FROM categorias WHERE id_categoria = ? AND id_usuario = ?");
        $check->execute([$id_categoria, $id_usuario]);

        if ($check->fetch()) {
            $stmt = $conexao->prepare("DELETE FROM categorias WHERE id_categoria = ?");
            $stmt->execute([$id_categoria]);

            header("Location: index.php?msg=excluido");
            exit();
        } else {
            header("HTTP/1.1 403 Forbidden");
            echo "Você não tem permissão para excluir esta categoria.";
            exit();
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
        exit();
    }
}
?>
