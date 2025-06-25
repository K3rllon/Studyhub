<?php
session_start();

require '../conexao.php';
require 'Aluno.php';

function redirecionarComErro($erro, $email = '') {
    $_SESSION['erro'] = $erro;
    $_SESSION['email'] = $email;
    header("Location: ../index.php");
    exit;
}

if (
    isset($_POST['email'], $_POST['senha']) &&
    !empty(trim($_POST['email'])) &&
    !empty(trim($_POST['senha']))
) {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    $usuario = new Aluno();

    if ($usuario->login($email, $senha) === true) {
        if (isset($_SESSION['id'])) {
            header("Location: ../tela_inicial/index.php");
            exit;
        } else {
            redirecionarComErro(1, $email);
        }
    } else {
        redirecionarComErro(1, $email);
    }
} else {
    $email = $_POST['email'] ?? '';
    redirecionarComErro(2, $email);
}
