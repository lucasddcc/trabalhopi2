<?php
session_start();
// Verifica se o código do produto foi enviado pelo formulário
if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];

    // Verifica se a variável de sessão 'carrinho' já existe
    if (isset($_SESSION['carrinho'])) {
        $carrinho = $_SESSION['carrinho'];
    } else {
        // Se não existir, cria um novo array vazio para o carrinho
        $carrinho = array();
    }

    // Adiciona o código do produto ao carrinho
    $carrinho[] = $codigo;

    // Atualiza a variável de sessão 'carrinho' com o novo carrinho
    $_SESSION['carrinho'] = $carrinho;
}

// Redireciona de volta para a página do carrinho
header("Location: carrinho.php");
exit();
?>
