<?php

require_once "../conexao.php";

$act = $_REQUEST["act"] ?? null;
$id_categoria = $_REQUEST["id_categoria"] ?? "";
$nome = "";

if ($act == "upd" AND $id_categoria != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM categorias WHERE id_categoria = ?");
        $stmt->bindValue(1, $id_categoria, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $resultado = $stmt->fetch(PDO::FETCH_OBJ);
            $id_categoria = $resultado->id_categoria;
            $nome = $resultado->nome;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração SQL");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_categoria = isset($_POST["id_categoria"]) ? $_POST["id_categoria"] : "";
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    
    try {
        $sql = "SELECT COUNT(*) FROM categorias WHERE nome = ?";
        $params = [$nome];

        if ($id_categoria != "") {
            $sql .= " AND id_categoria != ?";
            $params[] = $id_categoria;
        }

        $stmt = $conexao->prepare($sql);
        $stmt->execute($params);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            header("Location: form_editar_categoria.php?erro=1");
            exit;
        } else {
            if ($id_categoria != "") {
                $stmt = $conexao->prepare("UPDATE categorias SET nome = ? WHERE id_categoria = ?");

                $stmt->bindValue(1, $nome);
                $stmt->bindValue(2, $id_categoria, PDO::PARAM_INT);
            } else {
                $stmt = $conexao->prepare("INSERT INTO categorias (nome) VALUES (?)");
                $stmt->bindValue(1, $nome);
            }

            $stmt->execute();
            $id_categoria = "";
            $nome = "";

            header("Location: alteracao_categorias.php?act=upd&id_categoria=$id_categoria&categoria_editada=1");
            exit;}
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
?>

<?php include "form_editar_categoria.php"; ?>

