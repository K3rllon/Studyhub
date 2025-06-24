<?php
require_once "../conexao.php";

$act = $_REQUEST["act"] ?? null;
$id_categoria = $_REQUEST["id_categoria"] ?? "";
$nome = "";

if ($act === "upd" && !empty($id_categoria) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM categorias WHERE id_categoria = ?");
        $stmt->execute([$id_categoria]);
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($categoria) {
            $nome = $categoria['nome'];
        } else {
            die("Categoria não encontrada.");
        }
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }
}

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_categoria = $_POST["id_categoria"] ?? "";
    $nome = trim($_POST["nome"] ?? "");

    if ($nome === "") {
        $erro = "O nome da categoria não pode ficar vazio.";
    } else {
        try {
            $sql = "SELECT COUNT(*) FROM categorias WHERE nome = ?";
            $params = [$nome];
            if ($id_categoria !== "") {
                $sql .= " AND id_categoria != ?";
                $params[] = $id_categoria;
            }

            $stmt = $conexao->prepare($sql);
            $stmt->execute($params);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $erro = "Este nome já está cadastrado.";
            } else {
                if ($id_categoria !== "") {
                    $stmt = $conexao->prepare("UPDATE categorias SET nome = ? WHERE id_categoria = ?");
                    $stmt->execute([$nome, $id_categoria]);
                    $sucesso = "Categoria editada com sucesso!";
                } else {
                    $stmt = $conexao->prepare("INSERT INTO categorias (nome) VALUES (?)");
                    $stmt->execute([$nome]);
                    $id_categoria = $conexao->lastInsertId();
                    $sucesso = "Categoria criada com sucesso!";
                }
            }
        } catch (PDOException $e) {
            $erro = "Erro no banco: " . $e->getMessage();
        }
    }
}

include "form_editar_categoria.php";
