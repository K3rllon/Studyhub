<?php
session_start();

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    echo "Usuário NÃO está logado. Redirecionando...";
    header("Location: ../index.php");
    exit();
}