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
    <div id="lateral">
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
    </div>
    <div id="conteinerLateral">
        <header>
            <img src="assets/tela_fundo_categorias.png" alt="Imagem categorias" id="tela_fundo_categorias">
        </header>
        <div id="listaCategorias">
            <main id="conteudoPrincipal">
                <?php
                include "listar_categorias.php";
                ?>
            </main>
        </div>
    </div>
    <footer id="rodape">
        <a href="../criar_categorias">
            <img src="assets/adicionar.png" alt="Adicionar" class="botaoadiciona">
        </a>
        <button></button>
    </footer>
</body>
</html>