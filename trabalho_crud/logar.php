<?php

session_start();

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha']) ) {

    require 'conexao.php';
    require 'Aluno.class.php';

    $usuario = new Aluno();
   

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']); 

    if ($usuario->login($email, $senha) == true) {
       if (isset($_SESSION['id'])) {
            header("Location: index.php");
        } else {
            header("Location: login.php");
        } 
    } else {
        header("Location: login.php");
    }
}

?>