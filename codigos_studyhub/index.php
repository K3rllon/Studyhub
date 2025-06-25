<?php
session_start();

$email = $_SESSION['email'] ?? '';
$erro = $_SESSION['erro'] ?? null;
unset($_SESSION['email'], $_SESSION['erro']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>StudyHub</title>
    <link rel="stylesheet" href="style_index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
</head>
<body>
    <div id="telalogin">
        <div id="ladoesquerdo">
            <div>
                <img src="assets/logo.png" alt="Logo" id="logo" />
            </div>
            <div>
                <img src="assets/imagem.login.png" alt="Imagem menina com papeis" id="imagemlogin" />
            </div>
        </div>
        <div id="ladodireito">
            <div id="caixalogin">
                <form action="login/logar.php" method="post">
                    <div id="cabecalhologin">
                        <h1 id="titulologin">Login</h1>
                        <img src="assets/portaDeSaidaLogin.png" alt="Imagem porta" id="imgporta" />
                    </div>
                    <h6 id="subtitulo">Digite os seus dados de acesso no campo abaixo.</h6>
                    <h5 class="tituloinput">E-mail</h5>
                    <input
                        type="email"
                        name="email"
                        class="input"
                        placeholder="Digite seu e-mail"
                        value="<?= htmlspecialchars($email) ?>"
                        required
                    />
                    <h5 class="tituloinput">Senha</h5>
                    <input
                        type="password"
                        name="senha"
                        class="input"
                        placeholder="Digite sua senha"
                        required
                    />
                    <input type="submit" value="Acessar" id="botao" />
                    <h6 id="textoCadastrar">Não tem uma conta? <a href="cadastro">Cadastre-se aqui</a></h6>

                    <?php if ($erro): ?>
                        <?php if ($erro == 1): ?>
                            <h3 class='mensagem-erro'>Atenção, senha ou email inválidos! Tente novamente.</h3><br>
                        <?php elseif ($erro == 2): ?>
                            <h3 class='mensagem-erro'>Ops, você deixou algum campo vazio! Por favor, preencha-o corretamente.</h3><br>
                        <?php endif; ?>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
