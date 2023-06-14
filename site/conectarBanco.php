<?php
// Configurações do banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "admin";
$banco = "trabalho";

// Conecta ao banco de dados
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se a conexão foi bem sucedida
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}


?>