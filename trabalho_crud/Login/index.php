<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login concluido</title>
    <link rel="stylesheet" href="style_tela_inicial.css">
</head>
<body id="inicio">
    <?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit;}
    ?>
    <div id="caixa_inicial">
        <form action="logout.php">
            <h1 id="tituloinicio">Você chegou a tela inicial! 😊</h1>
            <p id="subtituloinicio">Tela ainda em construção! 🧑‍🏭🏗️</p>
            <input type="submit" value="Sair" id="botao">
        </form>
    </div>
</body>
</html>