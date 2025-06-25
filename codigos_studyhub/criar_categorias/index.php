<?php
require_once '../seguranca_geral.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>StudyHub - Criar Categoria</title>
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
                <img src="assets/imagem.cadastro.png" alt="Imagem menino com uma folha" id="imagemCadastroArquivo" />
            </div>
        </div>
        <div id="ladodireito">
            <div id="caixaCriarCategoria">
                <form action="criar.php" method="post">
                    <div id="cabecalhoarquivo">
                        <a href="../categorias"><img src="assets/voltar.png" alt="Voltar" id="botaovoltar" /></a>
                        <h1 id="tituloCriarCategoria">Criar Categoria</h1>
                    </div>
                    <h6 id="subtitulo">Crie uma categoria</h6>

                    <?php
                    $nome = $_GET['nome'] ?? '';
                    ?>

                    <h5 class="tituloinput">Nome</h5>
                    <input
                        type="text"
                        name="nome"
                        class="input"
                        placeholder="Digite um nome para a categoria"
                        value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>"
                        required
                    />

                    <input type="submit" value="Criar" id="botao" />

                    <?php if (isset($_GET['erro'])): ?>
                        <?php if ($_GET['erro'] === '1'): ?>
                            <p class="mensagem-erro">Este nome já está cadastrado.</p>
                        <?php elseif ($_GET['erro'] === '2'): ?>
                            <p class="mensagem-erro">Preencha o campo nome!</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
