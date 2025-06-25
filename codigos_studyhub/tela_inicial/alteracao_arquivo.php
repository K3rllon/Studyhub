<?php
require_once "../conexao.php";
require_once '../seguranca_geral.php';

$id_usuario = $_SESSION['id'] ?? null;
if (!$id_usuario) {
    die("Usuário não autenticado.");
}

$act = $_REQUEST["act"] ?? null;
$id_arquivos = $_REQUEST["id_arquivos"] ?? "";
$nome = "";
$tipo = "";
$formato = "";
$id_categorias = "";
$caminho_arquivo = "";
$erro = "";
$sucesso = "";

try {
    $stmtCat = $conexao->prepare("SELECT id_categoria, nome FROM categorias WHERE id_usuario = ?");
    $stmtCat->execute([$id_usuario]);
    $categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao carregar categorias: " . $e->getMessage());
}

if ($act === "upd" && !empty($id_arquivos)) {
    try {
        $stmt = $conexao->prepare("
            SELECT a.*, c.id_usuario 
            FROM arquivos a
            INNER JOIN categorias c ON a.id_categorias = c.id_categoria
            WHERE a.id_arquivos = ?
        ");
        $stmt->execute([$id_arquivos]);
        $arquivo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($arquivo) {
            if ($arquivo['id_usuario'] != $id_usuario) {
                die("Você não tem permissão para editar este arquivo.");
            }
            $nome = $arquivo['nome'];
            $tipo = $arquivo['tipo'];
            $formato = $arquivo['formato'];
            $id_categorias = $arquivo['id_categorias'];
            $caminho_arquivo = $arquivo['caminho_arquivo'];
        } else {
            die("Arquivo não encontrado.");
        }
    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_arquivos = $_POST["id_arquivos"] ?? "";
    $nome = trim($_POST["nome"] ?? "");
    $tipo = trim($_POST["tipo"] ?? "");
    $formato = trim($_POST["formato"] ?? "");
    $id_categorias = $_POST["categoria"] ?? "";
    $caminho_arquivo = "";

    if ($nome === "" || $tipo === "" || $formato === "" || $id_categorias === "") {
        $erro = "Preencha todos os campos!";
    } else {
        $stmtValidaCat = $conexao->prepare("SELECT 1 FROM categorias WHERE id_categoria = ? AND id_usuario = ?");
        $stmtValidaCat->execute([$id_categorias, $id_usuario]);
        if (!$stmtValidaCat->fetch()) {
            $erro = "Categoria inválida ou não pertence a você.";
        }
    }

    if (!$erro) {
        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === 0) {
            $nome_arquivo = basename($_FILES["arquivo"]["name"]);
            $diretorio = "../adicionar_arquivo/uploads/";
            
            $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
            $permitidos = ['pdf','mp4','avi','mov','png','jpg','jpeg'];
            if (!in_array($extensao, $permitidos)) {
                $erro = "Tipo de arquivo não permitido.";
            } else {
                $novo_nome = uniqid() . '.' . $extensao;
                $caminho_arquivo = $diretorio . $novo_nome;
                if (!move_uploaded_file($_FILES["arquivo"]["tmp_name"], $caminho_arquivo)) {
                    $erro = "Erro ao enviar o arquivo.";
                }
            }
        } elseif (!empty($id_arquivos)) {
            try {
                $stmt = $conexao->prepare("SELECT a.caminho_arquivo, c.id_usuario FROM arquivos a INNER JOIN categorias c ON a.id_categorias = c.id_categoria WHERE a.id_arquivos = ?");
                $stmt->execute([$id_arquivos]);
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$resultado || $resultado['id_usuario'] != $id_usuario) {
                    $erro = "Você não tem permissão para alterar este arquivo.";
                } else {
                    $caminho_arquivo = $resultado["caminho_arquivo"] ?? "";
                }
            } catch (PDOException $e) {
                $erro = "Erro ao buscar caminho do arquivo: " . $e->getMessage();
            }
        }

        if (!$erro) {
            try {
                $sql = "SELECT COUNT(*) FROM arquivos WHERE nome = ?";
                $params = [$nome];
                if ($id_arquivos !== "") {
                    $sql .= " AND id_arquivos != ?";
                    $params[] = $id_arquivos;
                }

                $stmt = $conexao->prepare($sql);
                $stmt->execute($params);
                $count = $stmt->fetchColumn();

                if ($count > 0) {
                    $erro = "Este nome já está cadastrado.";
                } else {
                    if ($id_arquivos !== "") {
                        $stmt = $conexao->prepare("UPDATE arquivos SET nome = ?, tipo = ?, formato = ?, id_categorias = ?, caminho_arquivo = ? WHERE id_arquivos = ?");
                        $stmt->execute([$nome, $tipo, $formato, $id_categorias, $caminho_arquivo, $id_arquivos]);
                        header("Location: index.php");
                        exit();
                    } else {
                        $stmt = $conexao->prepare("INSERT INTO arquivos (nome, tipo, formato, id_categorias, caminho_arquivo) VALUES (?, ?, ?, ?, ?)");
                        $stmt->execute([$nome, $tipo, $formato, $id_categorias, $caminho_arquivo]);
                        $id_arquivos = $conexao->lastInsertId();
                        header("Location: index.php");
                        exit();
                    }
                }
            } catch (PDOException $e) {
                $erro = "Erro no banco: " . $e->getMessage();
            }
        }
    }
}

include "form_editar_arquivo.php";
