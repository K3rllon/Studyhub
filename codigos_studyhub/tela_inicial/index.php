<!DOCTYPE html>
<html lang="pt-br">
    <?php
        include('../login/seguranca.php')
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studyhub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="homePage">
    <aside id="cabecalhoLateral">
        <ul id="icones">
            <li>
                <a href="">
                <img src="assets/Perfil.png" alt="Perfil" id="iconeperfil">
                </a>
            </li>
            <div id="iconescentral"> 
                <li>
                    <a href="../tela_inicial">
                    <img src="assets/inicio.png" alt="inicio" id="iconecasa">
                    </a>
                </li>
                <li>
                    <a href="../adicionar_arquivo">
                    <img src="assets/adicionarArquivos.png" alt="Adicionar Arquivos" class="iconesQuadrados">
                    </a>
                </li>
                <li>
                    <a href="../criar_categorias">
                    <img src="assets/criarCategoria.png" alt="Criar categoria" class="iconesQuadrados">
                    </a>
                </li>
                <li>
                    <a href="../categorias">
                    <img src="assets/categoria.png" alt="Categorias" class="iconesQuadrados">
                    </a>
                </li>
            </div>
            <li>
                <a href="../index.php">
                <img src="assets/sair.png" alt="Sair" class="iconesQuadrados" id="iconesair">
                </a>
            </li>
        </ul>
    </aside>
    <header>
        <img src="assets/tela_fundo_seja_bem_vindo.png" alt="Imagem seja bem vindo" id="imagem_seja_bem_vindo">
    </header>
    <footer id="rodape">
        <a href="../adicionar_arquivo">
            <img src="assets/adicionar.png" alt="Adicionar" class="botaoadiciona">
            </a>
    </footer>
</body>
</html>