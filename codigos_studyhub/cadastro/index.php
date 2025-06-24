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
                <img src="assets/logo.png" alt="Logo" id="logo">
            </div>
            <div>
                <img src="assets/imagem.cadastro.png" alt="Imagem Cadastro" id="imagemlogin">
            </div> 
        </div>
        <div id="ladodireito">
            <div id="caixalogin">
                <form action="cadastra.php" method="post">
                    <div id="cabecalhocadastro">
                        <a href="../index.php">
                            <img src="assets/voltar.png" alt="Voltar" id="botaovoltar">
                        </a>
                        <h1 id="titulocadastro">Cadastro</h1>
                    </div>
                    <h6 id="subtitulo">Digite os seus dados de acesso no campo abaixo.</h6>
                    <h5 class="tituloinput">E-mail</h5>
                    <input type="email" name="email" class="input" placeholder="Digite seu e-mail">
                    <h5 class="tituloinput">Senha</h5>
                    <input type="password" name="senha" class="input" placeholder="Digite sua senha">
                    <h5 class="tituloinput">Confirme sua senha</h5>
                    <input type="password" name="confirmar_senha" class="input" placeholder="Digite novamente sua senha">
                    <input type="submit" value="Cadastrar-se" id="botao">

                    <?php
                    if (isset($_GET['erro'])) {
                        if ($_GET['erro']== 1) {
                            echo "<h3 class='mensagem-erro'>As senhas não coincidem.</h3> <br>";
                        } if ($_GET['erro']== 2) {
                            echo "<h3 class='mensagem-erro'>Este email já está cadastrado.</h3> <br>";
                        } if ($_GET['erro']== 3) {
                            echo "<h3 class='mensagem-erro'>Precencha todos os campos!</h3> <br>";}
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>