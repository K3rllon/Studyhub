<?php

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha']) ) {

    require 'conexao.php';
    require 'Aluno.class.php';

    $usuario = new Aluno();

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']); 

} else {

    header("location: login.php");

}





?>