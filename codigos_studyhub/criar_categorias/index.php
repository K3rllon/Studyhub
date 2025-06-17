<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studyhub</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyHub</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <div id="telalogin">
        <div id="ladoesquerdo">
            <div>
                <a href="../tela_inicial">
                    <img src="assets/logo.png" alt="Logo" id="logo">
                </a>
            </div>
            <div>
                <img src="assets/imagem.menino.arquivo.png" alt="Imagem menino com uma folha" id="imagemCadastroArquivo">
            </div> 
        </div>
        <div id="ladodireito">
            <div id="caixaCriarCategoria">
                <form action="criar.php" method="post">
                    <div id="cabecalhoarquivo">
                        <a href="../categorias">
                            <img src="assets/voltar.png" alt="Voltar" id="botaovoltar">
                        </a>
                        <h1 id="tituloCriarCategoria">Criar Categoria</h1>
                    </div>
                    <h6 id="subtitulo">Crie uma categoria</h6>
                    <h5 class="tituloinput">Nome</h5>
                   <input type="text" name="nome" class="input" placeholder="Digite um nome para a categoria">
                    <input type="file" name="arquivo" id="criarCategoria">
                    <input type="submit" value="Criar" id="botao">

                    <?php
                    if (isset($_GET['erro'])) {
                        if ($_GET['erro']== 1) {
                            echo "<h3 class='mensagem-erro'>Este nome já está cadastrado.</h3> <br>";
                        } if ($_GET['erro']== 2) {
                            echo "<h3 class='mensagem-erro'>Precencha todos os campos!</h3> <br>";}
                    }
                    if (isset($_GET['categoria_cadastrada'])) {
                            echo "<h3 id='cadastro-sucedido'>Categoria cadastrada com sucesso! </h3> <br>";}
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
</body>
</html>