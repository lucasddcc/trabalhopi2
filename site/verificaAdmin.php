<?php

// Verificar se o usuário está logado e é um administrador
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['admin'] === 1) {

    // Consulta SQL para verificar se o cliente é um administrador
    $query = "SELECT admin FROM cliente WHERE id = :cliente_id";
    
    // Substitua 'seu_host', 'seu_banco_de_dados', 'seu_usuario' e 'sua_senha' pelas informações do seu banco de dados
    $pdo = new PDO('mysql:host=root;dbname=trabalho', 'root', 'admin');
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':cliente_id', $_SESSION['cliente_id']);
    $stmt->execute();


    // Verifique o resultado da consulta
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $isAdmin = ($row['admin'] == 1);

        // Exibir a opção específica para o administrador
        if ($isAdmin) {
            echo '<script> alert("admin logado")</script>';
        }
    }
}
?>