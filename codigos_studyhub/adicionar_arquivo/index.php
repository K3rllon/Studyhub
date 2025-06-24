<!DOCTYPE html>
<html lang="pt-br">
<?php
require_once "../conexao.php";

try {
    $stmt = $conexao->query("SELECT id_categoria, nome FROM categorias");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $erro) {
    echo "Erro ao carregar categorias: " . $erro->getMessage();
    $categorias = [];
}
?>

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
                <form action="criar_arquivos.php" method="post" enctype="multipart/form-data">
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
                    <select name="categoria" class="input" required>
                        <option value="">Selecione uma categoria</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= $cat['id_categoria'] ?>"><?= htmlspecialchars($cat['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <h5 class="tituloinput">Formato do arquivo</h5>
                    <input type="text" name="formato" class="input" accept=".pdf, .mp4, .avi, .mov, .png, .jpg, .jpeg" required placeholder="Ex: MP4, PDF...">
                    <h5 id="tituloanexar">Anexar arquivo</h5>
                    <label for="adicionararquivo">
                        <img src="assets/nuvem.arquivo" alt="Imagem adicionar arquivos nuvem" id="imagemnuvem">
                    </label>
                    <input type="file" name="arquivo" id="adicionararquivo">
                    <input type="submit" value="Criar" id="botao">

                    <?php
                    if (isset($_GET['erro'])) {
                        if ($_GET['erro']== 1) {
                            echo "<h3 class='mensagem-erro'>Este nome já está cadastrado.</h3> <br>";
                        } if ($_GET['erro']== 2) {
                            echo "<h3 class='mensagem-erro'>Precencha todos os campos!</h3> <br>";}
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>