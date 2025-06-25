<?php
require_once '../seguranca_geral.php';
require_once "../conexao.php";

session_start();
$id_usuario = $_SESSION['id'] ?? null;
if (!$id_usuario) {
    die("Usuário não autenticado.");
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && !empty($_REQUEST["id_arquivos"])) {
    $id = intval($_REQUEST["id_arquivos"]);

    try {
        $stmt = $conexao->prepare("
            DELETE a FROM arquivos a
            INNER JOIN categorias c ON a.id_categorias = c.id_categoria
            WHERE a.id_arquivos = ? AND c.id_usuario = ?
        ");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->bindValue(2, $id_usuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: index.php?msg=excluido");
            exit();
        } else {
            throw new PDOException("Erro ao executar a exclusão."); 
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
?>
