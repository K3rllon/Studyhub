<?php
include("conexao.php")
?>

<?php
session_start();
$erro_login = false;
if (isset($_SESSION['erro_login']) && $_SESSION['erro_login'] === true) {
    $erro_login = true;
    unset($_SESSION['erro_login']);
}
?>

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
            <div id="conteinerimagemlogin">
                <img src="assets/imagem.logo.png" alt="Imagem Login" id="imagemlogin">
            </div> 
        </div>
        <div id="ladodireito">
            <div id="caixalogin">
                <form action="logar.php" method="post">
                    <div id="cabecalhologin">
                        <h1 id="titulologin">Login</h1>
                        <img src="assets/portaDeSaidaLogin.png" alt="Imagem porta" id="imgporta">
                    </div>
                    <h6 id="subtitulo">Digite os seus dados de acesso no campo abaixo.</h6>
                    <h5 class="tituloinput">E-mail</h5>
                   <input type="email" name="email" class="input <?php if ($erro_login) echo 'erro'; ?>" placeholder="Digite seu e-mail">
                    <h5 class="tituloinput">Senha</h5>
                    <input type="password" name="senha" class="input <?php if ($erro_login) echo 'erro'; ?>" placeholder="Digite sua senha">
                    <input type="submit" value="Acessar" id="botao">
                </form>
                <?php if ($erro_login): ?>
                <p class="mensagem-erro">E-mail ou senha incorretos.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>