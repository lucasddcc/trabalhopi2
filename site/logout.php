<?php
session_start();

// Verificar se o usuário está logado
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Encerrar a sessão
    session_unset();
    session_destroy();
    header("Location: login.php"); 
    echo '<script>alert("deslogado");</script>';
    exit();
}
else {
    echo '<script>alert("deslogado");</script>';
    header("Location: index.php");
    exit();
}
?>