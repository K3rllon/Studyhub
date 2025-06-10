<?php

if (isset($_POST["email"], $_POST["senha"], $_POST["confirmar_senha"]) AND $_POST["email"] != "senha" AND $_POST["confirmar_senha"] != "" AND $_POST[""] != "") {
    try{
        if ($_POST["senha"] === $_POST["confirmar_senha"]) {
            $senhaHash = password_hash($_POST["senha"], PASSWORD_DEFAULT);

        $stmt = $conexao->prepare("INSERT INTO aluno (email,senha") VALUES (?,?")
        }
    }


} catch {

}


?>