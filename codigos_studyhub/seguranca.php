<?php
 if (!isset($_SESSION)) {
    session_start();
 }
 if (!isset($_SESSION['id'])) {
    die("Parecere que você não tem acesso... <br> ACESSO *NEGADO*");
 }
?>