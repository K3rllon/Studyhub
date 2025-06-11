<?php

class Aluno{
    public function login($email, $senha){
        if (session_status() == PHP_SESSION_NONE) {
        session_start();}
        global $conexao;

        $sql = "SELECT * FROM aluno WHERE email = :email";
        $sql = $conexao->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0){ 
            $dado = $sql->fetch();
        
        if (password_verify($senha, $dado["senha"])) {
            $_SESSION['id'] = $dado['id'];
            return true;     
        } else{
            return false;
        }
    } else {
        return false;
    }
}}

?>