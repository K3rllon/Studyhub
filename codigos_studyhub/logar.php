<?php

session_start();

if (isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['senha']) AND !empty($_POST['senha']) ) {

    require 'conexao.php';
    require 'Aluno.php';

    $usuario = new Aluno();
   

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']); 

     if ($usuario->login($email, $senha) == true) {
       if (isset($_SESSION['id'])) {
            header("Location: tela_inicial.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        header("Location: index.php?erro=1");
        exit;
    }
} else{
    $email = null;
    $senha = null;
    header('location: index.php?erro=2');
    exit;
}
?>