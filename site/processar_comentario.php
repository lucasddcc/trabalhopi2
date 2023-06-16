<?php
session_start();
include_once('conectarBanco.php');

if ((!isset($_SESSION['username']) == true) and (!isset($_SESSION['password']) == true)) {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    $nomeUser = '';
} else {
    $nomeUser = -1;
    $email = $_SESSION['username'];
    $sql = "SELECT nome FROM cliente WHERE email = '$email' ";
    $result = mysqli_query($conexao, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nomeUser = $row["nome"];
        //print_r($row["admin"]);
    }
}

if (isset($_POST['codigo']) && isset($_POST['comentario'])) {
    $codigo = $_POST['codigo'];
    $comentario = $_POST['comentario'];

    if ((!isset($_SESSION['username'])) || (!isset($_SESSION['password']))) {
        // Usuário não está logado
        $nome_usuario = 'Anônimo';
    } else {
        // Usuário está logado, obter o nome do usuário
        $email = $_SESSION['username'];
        $sql = "SELECT nome FROM cliente WHERE email = '$email'";
        $result = mysqli_query($conexao, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nome_usuario = $row["nome"];
        } else {
            // Caso ocorra algum erro ao obter o nome do usuário, defina como anônimo
            $nome_usuario = 'Anônimo';
        }
    }

    // Inserir o comentário no banco de dados
    $sql = "INSERT INTO comentarios (codigo_produto, comentario, nome_usuario) VALUES ('$codigo', '$comentario', '$nome_usuario')";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        // Comentário inserido com sucesso
        header("Location: detalhes.php?codigo=$codigo");
        exit();
    } else {
        // Ocorreu um erro ao inserir o comentário
        echo "Erro ao inserir o comentário.";
    }
} else {
    // Código do produto ou comentário não fornecido
    echo "Código do produto ou comentário não fornecido.";
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>