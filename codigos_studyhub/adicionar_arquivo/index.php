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
            <div id="caixacadastro">
                <form action="logar.php" method="post">
                    <div id="cabecalhoarquivo">
                        <a href="../tela_inicial">
                            <img src="assets/voltar.png" alt="Voltar" id="botaovoltar">
                        </a>
                        <h1 id="tituloarquivo">Adicionar Arquivo</h1>
                    </div>
                    <h6 id="subtitulo">Adicione um arquivo</h6>
                    <h5 class="tituloinput">Nome</h5>
                   <input type="text" name="nome" class="input" placeholder="Digite um nome par o arquivo">
                    <h5 class="tituloinput">Tipo de conteudo</h5>
                    <input type="text" name="tipo" class="input" placeholder="Ex: Resumo, vídeo-aula, flashcard... ">
                    <h5 class="tituloinput">Categoria cadastrada</h5>
                    <input type="text" name="categoria" class="input" placeholder="Ex: História, química, português...">
                    <h5 class="tituloinput">Formato do arquivo</h5>
                    <input type="text" name="formato" class="input" placeholder="Ex: MP4, PDF...">
                    <h5 id="tituloanexar">Anexar arquivo</h5>
                    <label for="adicionararquivo">
                        <img src="assets/nuvem.arquivo" alt="Imagem adicionar arquivos nuvem" id="imagemnuvem">
                    </label>
                    <input type="file" name="arquivo" id="adicionararquivo">
                    <input type="submit" value="Criar" id="botao">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
</body>
</html>