<?php
require_once '../seguranca_geral.php';
require_once "../conexao.php";

$id_usuario = $_SESSION['id'] ?? null;

if (!$id_usuario) {
    header("Location: ../login.php");
    exit;
}

try {
    $stmt = $conexao->prepare("SELECT id_categoria, nome FROM categorias WHERE id_usuario = :id_usuario");
    $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $erro) {
    echo "Erro ao carregar categorias: " . $erro->getMessage();
    $categorias = [];
}

$nome = $_GET['nome'] ?? '';
$tipo = $_GET['tipo'] ?? '';
$formato = $_GET['formato'] ?? '';
$categoria = $_GET['categoria'] ?? '';
$erro = $_GET['erro'] ?? '';
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>StudyHub</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
</head>

<body>
    <div id="telalogin">
        <div id="ladoesquerdo">
            <div>
                <a href="../tela_inicial"><img src="assets/logo.png" alt="Logo" id="logo" /></a>
            </div>
            <div>
                <img src="assets/imagem.menino.arquivo.png" alt="Imagem menino com uma folha" id="imagemCadastroArquivo" />
            </div>
        </div>
        <div id="ladodireito">
            <div id="caixacadastro">
                <form action="criar_arquivos.php" method="post" enctype="multipart/form-data">
                    <div id="cabecalhoarquivo">
                        <a href="../tela_inicial"><img src="assets/voltar.png" alt="Voltar" id="botaovoltar" /></a>
                        <h1 id="tituloarquivo">Adicionar Arquivo</h1>
                    </div>
                    <h6 id="subtitulo">Adicione um arquivo</h6>

                    <h5 class="tituloinput">Nome</h5>
                    <input
                        type="text"
                        name="nome"
                        class="input"
                        placeholder="Digite um nome para o arquivo"
                        value="<?= htmlspecialchars($nome) ?>"
                    />

                    <h5 class="tituloinput">Tipo de conteúdo</h5>
                    <input
                        type="text"
                        name="tipo"
                        class="input"
                        placeholder="Ex: Resumo, vídeo-aula, flashcard..."
                        value="<?= htmlspecialchars($tipo) ?>"
                    />

                    <h5 class="tituloinput">Categoria cadastrada</h5>
                    <select name="categoria" class="input" required>
                        <option value="">Selecione uma categoria</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option
                                value="<?= $cat['id_categoria'] ?>"
                                <?= ($categoria == $cat['id_categoria']) ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($cat['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <h5 class="tituloinput">Formato do arquivo</h5>
                    <select name="formato" class="input" required>
                        <?php
                        $formatos = ['PDF', 'MP4', 'AVI', 'MOV', 'PNG', 'JPG', 'JPEG'];
                        foreach ($formatos as $f) {
                            $selected = (strcasecmp($formato, $f) === 0) ? 'selected' : '';
                            echo "<option value=\"$f\" $selected>$f</option>";
                        }
                        ?>
                    </select>

                    <h5 id="tituloanexar">Anexar arquivo</h5>
                    <label for="adicionararquivo">
                        <img src="assets/nuvem.arquivo" alt="Imagem adicionar arquivos nuvem" id="imagemnuvem" />
                    </label>
                    <input type="file" name="arquivo" id="adicionararquivo" />

                    <input type="submit" value="Criar" id="botao" />

                    <?php
                    if (!empty($erro)) {
                        if ($erro == 1) {
                            echo "<h3 class='mensagem-erro'>Este nome já está cadastrado.</h3><br>";
                        } elseif ($erro == 2) {
                            echo "<h3 class='mensagem-erro'>Já existe um arquivo com esse nome no servidor.</h3><br>";
                        } elseif ($erro == 3) {
                            echo "<h3 class='mensagem-erro'>Erro ao mover o arquivo.</h3><br>";
                        } elseif ($erro == 4) {
                            echo "<h3 class='mensagem-erro'>Erro no banco de dados.</h3><br>";
                        } elseif ($erro == 5) {
                            echo "<h3 class='mensagem-erro'>Preencha todos os campos!</h3><br>";
                        } elseif ($erro == 6) {
                            echo "<h3 class='mensagem-erro'>Arquivo não compatível com o sistema.</h3><br>";
                        } elseif ($erro == 7) {
                            echo "<h3 class='mensagem-erro'>Categoria inválida ou não pertence a você.</h3><br>";
                        }elseif ($erro == 8) {
                            echo "<h3 class='mensagem-erro'>Usuário não autenticado.</h3><br>";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
