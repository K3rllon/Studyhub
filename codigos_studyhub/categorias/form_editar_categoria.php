<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>StudyHub - Editar Categoria</title>
    <link rel="stylesheet" href="style_form.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
</head>
<body>
    <div id="telalogin">
        <div id="ladoesquerdo">
            <div>
                <a href="../tela_inicial">
                    <img src="assets/logo.png" alt="Logo" id="logo" />
                </a>
            </div>
            <div>
                <img src="assets/imagem.cadastro.png" alt="Imagem menino com uma folha" id="imagemCadastroArquivo" />
            </div>
        </div>
        <div id="ladodireito">
            <div id="caixaCriarCategoria">
                <form action="alteracao_categorias.php" method="post">
                    <div id="cabecalhoarquivo">
                        <a href="../categorias">
                            <img src="assets/voltar.png" alt="Voltar" id="botaovoltar" />
                        </a>
                        <h1 id="tituloCriarCategoria">Edite a categoria</h1>
                    </div>

                    <h6 id="subtitulo">Edite o nome da sua categoria abaixo.</h6>

                    <input type="hidden" name="id_categoria" value="<?= htmlspecialchars($id_categoria) ?>" />

                    <h5 class="tituloinput">Nome</h5>
                    <input
                        type="text"
                        name="nome"
                        class="input"
                        placeholder="Digite um nome para alteração"
                        value="<?= htmlspecialchars($nome) ?>"
                        required
                    />
                    
                    <input type="submit" value="Salvar Alteração" id="botao" />

                    <?php if (!empty($erro)): ?>
                        <h3 class="mensagem-erro"><?= htmlspecialchars($erro) ?></h3><br />
                    <?php endif; ?>

                    <?php if (!empty($sucesso)): ?>
                        <h3 id="cadastro-sucedido"><?= htmlspecialchars($sucesso) ?></h3><br />
                    <?php endif; ?>

                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>
