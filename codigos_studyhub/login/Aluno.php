<?php

class Aluno{
    public function login($email, $senha){
        global $conexao;

        $sql = "SELECT * FROM aluno WHERE email = :email AND senha = :senha2";
        $sql = $conexao->prepare($sql);
        $sql->bindValue("email", $email);
        $sql->bindValue("senha2", $senha);
        $sql->execute();

        if($sql->rowCount() > 0){ 
            $dado = $sql->fetch();
            
            $_SESSION['id'] = $dado['id'];

            return true;
        } else{
            return false;
        }
        }
    }

?>