<?php
require_once "../conexao.php";

$act = $_REQUEST["act"] ?? null;
$id_arquivos = $_REQUEST["id_arquivos"] ?? "";
$nome = "";
$tipo = "";
$formato = "";
$id_categorias = "";
$caminho_arquivo = "";

if ($act == "upd" && $id_arquivos != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM arquivos WHERE id_arquivos = ?");
        $stmt->bindValue(1, $id_arquivos, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $resultado = $stmt->fetch(PDO::FETCH_OBJ);
            if ($resultado) {
                $nome = $resultado->nome;
                $tipo = $resultado->tipo;
                $formato = $resultado->formato;
                $id_categorias = $resultado->id_categorias;
                $caminho_arquivo = $resultado->caminho_arquivo;
            } else {
                echo "Arquivo não encontrado.";
                exit;
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração SQL");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_arquivos = $_POST["id_arquivos"] ?? "";
    $nome = $_POST["nome"] ?? "";
    $tipo = $_POST["tipo"] ?? "";
    $formato = $_POST["formato"] ?? "";
    $id_categorias = $_POST["id_categorias"] ?? "";
    $caminho_arquivo = $_POST["caminho_arquivo"] ?? "";

    try {
        // Verificar nome duplicado, ignorando o registro atual
        $sql = "SELECT COUNT(*) FROM arquivos WHERE nome = ?";
        $params = [$nome];
        if ($id_arquivos != "") {
            $sql .= " AND id_arquivos != ?";
            $params[] = $id_arquivos;
        }
        $stmt = $conexao->prepare($sql);
        $stmt->execute($params);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            header("Location: form_editar_arquivo.php?erro=1");
            exit;
        }

        if ($id_arquivos != "") {
            $stmt = $conexao->prepare("UPDATE arquivos SET nome = ?, tipo = ?, formato = ?, id_categorias = ?, caminho_arquivo = ? WHERE id_arquivos = ?");
            $stmt->bindValue(1, $nome);
            $stmt->bindValue(2, $tipo);
            $stmt->bindValue(3, $formato);
            $stmt->bindValue(4, $id_categorias, PDO::PARAM_INT);
            $stmt->bindValue(5, $caminho_arquivo);
            $stmt->bindValue(6, $id_arquivos, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $stmt = $conexao->prepare("INSERT INTO arquivos (nome, tipo, formato, id_categorias, caminho_arquivo) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $nome);
            $stmt->bindValue(2, $tipo);
            $stmt->bindValue(3, $formato);
            $stmt->bindValue(4, $id_categorias, PDO::PARAM_INT);
            $stmt->bindValue(5, $caminho_arquivo);
            $stmt->execute();
        }

        header("Location: alterar_arquivos.php?arquivo_editado=1");
        exit;

    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
        exit;
    }
}
?>

<?php include "form_editar_arquivo.php"; ?>
