<?php
require_once "../conexao.php";

$act = $_REQUEST["act"] ?? null;
$id_arquivos = $_REQUEST["id_arquivos"] ?? "";
$nome = "";
$tipo = "";
$formato = "";
$id_categorias = "";
$caminho_arquivo = "";
$erro = "";
$sucesso = "";

// Carrega categorias para popular o select do form
try {
    $stmtCat = $conexao->query("SELECT id_categoria, nome FROM categorias");
    $categorias = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao carregar categorias: " . $e->getMessage());
}

// Se for edição, busca os dados para preencher o formulário
if ($act === "upd" && !empty($id_arquivos)) {
    try {
        $stmt = $conexao->prepare("SELECT * FROM arquivos WHERE id_arquivos = ?");
        $stmt->execute([$id_arquivos]);
        $arquivo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($arquivo) {
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
        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === 0) {
            $nome_arquivo = basename($_FILES["arquivo"]["name"]);
            $diretorio = "../adicionar_arquivo/uploads/";
            $caminho_arquivo = $diretorio . $nome_arquivo;

            if (!move_uploaded_file($_FILES["arquivo"]["tmp_name"], $caminho_arquivo)) {
                $erro = "Erro ao enviar o arquivo.";
            }
        } elseif (!empty($id_arquivos)) {
            try {
                $stmt = $conexao->prepare("SELECT caminho_arquivo FROM arquivos WHERE id_arquivos = ?");
                $stmt->execute([$id_arquivos]);
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                $caminho_arquivo = $resultado["caminho_arquivo"] ?? "";
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
                        $sucesso = "Arquivo editado com sucesso!";
                    } else {
                        $stmt = $conexao->prepare("INSERT INTO arquivos (nome, tipo, formato, id_categorias, caminho_arquivo) VALUES (?, ?, ?, ?, ?)");
                        $stmt->execute([$nome, $tipo, $formato, $id_categorias, $caminho_arquivo]);
                        $id_arquivos = $conexao->lastInsertId();
                        $sucesso = "Arquivo criado com sucesso!";
                    }
                }
            } catch (PDOException $e) {
                $erro = "Erro no banco: " . $e->getMessage();
            }
        }
    }
}

include "form_editar_arquivo.php";
?>
