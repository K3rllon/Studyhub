<?php
require_once '../seguranca_geral.php';
require_once "../conexao.php";

// Função para redirecionar com erro e manter os dados no GET
function redirecionarComErro($erro, $nome, $tipo, $formato, $categoria) {
    $params = http_build_query([
        'erro' => $erro,
        'nome' => $nome,
        'tipo' => $tipo,
        'formato' => $formato,
        'categoria' => $categoria,
    ]);
    header("Location: index.php?$params");
    exit;
}

$id_usuario = $_SESSION['id'] ?? null;

if (!$id_usuario) {
    redirecionarComErro(8, '', '', '', '');
}

if (
    isset($_POST["nome"], $_POST["tipo"], $_POST["formato"], $_POST["categoria"]) &&
    !empty(trim($_POST["nome"])) &&
    !empty(trim($_POST["tipo"])) &&
    !empty(trim($_POST["formato"])) &&
    !empty(trim($_POST["categoria"])) &&
    isset($_FILES["arquivo"]) &&
    $_FILES["arquivo"]["error"] === UPLOAD_ERR_OK
) {
    $nome = trim($_POST["nome"]);
    $tipo_conteudo = trim($_POST["tipo"]);
    $formato = trim($_POST["formato"]);
    $id_categoria = intval($_POST["categoria"]);

    $stmt_categoria = $conexao->prepare("SELECT 1 FROM categorias WHERE id_categoria = ?");
    $stmt_categoria->execute([$id_categoria]);
    if (!$stmt_categoria->fetch()) {
        redirecionarComErro(7, $nome, $tipo_conteudo, $formato, $id_categoria);
    }

    $arquivo = $_FILES["arquivo"];
    $nome_original = $arquivo["name"];
    $extensoes_permitidas = ['pdf', 'mp4', 'avi', 'mov', 'png', 'jpg', 'jpeg'];
    $ext_arquivo = strtolower(pathinfo($nome_original, PATHINFO_EXTENSION));

    if (!in_array($ext_arquivo, $extensoes_permitidas)) {
        redirecionarComErro(6, $nome, $tipo_conteudo, $formato, $id_categoria);
    }

    $nome_final = uniqid() . "_" . basename($nome_original);
    $pasta_destino = __DIR__ . "/uploads";
    if (!is_dir($pasta_destino)) {
        mkdir($pasta_destino, 0777, true);
    }

    $caminho_arquivo = $pasta_destino . "/" . $nome_final;
    $caminho_banco = "uploads/" . $nome_final;

    try {
        $stmt_verifica_nome = $conexao->prepare("SELECT COUNT(*) FROM arquivos WHERE nome = ? AND id_usuario = ?");
        $stmt_verifica_nome->execute([$nome, $id_usuario]);
        if ($stmt_verifica_nome->fetchColumn() > 0) {
            redirecionarComErro(1, $nome, $tipo_conteudo, $formato, $id_categoria);
        }

        if (file_exists($caminho_arquivo)) {
            redirecionarComErro(2, $nome, $tipo_conteudo, $formato, $id_categoria);
        }

        if (move_uploaded_file($arquivo["tmp_name"], $caminho_arquivo)) {
            $stmt = $conexao->prepare("INSERT INTO arquivos (nome, tipo, formato, caminho_arquivo, id_categorias, id_usuario) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $tipo_conteudo, $formato, $caminho_banco, $id_categoria, $id_usuario]);
            header("Location: ../tela_inicial");
            exit;
        } else {
            redirecionarComErro(3, $nome, $tipo_conteudo, $formato, $id_categoria);
        }
    } catch (PDOException $e) {
        echo "Erro no banco: " . $e->getMessage();
        exit;
    }
} else {
    $nome = $_POST["nome"] ?? '';
    $tipo = $_POST["tipo"] ?? '';
    $formato = $_POST["formato"] ?? '';
    $categoria = $_POST["categoria"] ?? '';

    redirecionarComErro(5, $nome, $tipo, $formato, $categoria);
}
