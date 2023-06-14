<?php
session_start();

// Verifica se o código do produto foi enviado pelo formulário
if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];

    // Verifica se a variável de sessão 'carrinho' existe
    if (isset($_SESSION['carrinho'])) {
        $carrinho = $_SESSION['carrinho'];

        // Verifica se o código do produto está presente no carrinho
        if (($key = array_search($codigo, $carrinho)) !== false) {
            // Remove o produto do carrinho
            unset($carrinho[$key]);

            // Atualiza a variável de sessão 'carrinho' com o carrinho atualizado
            $_SESSION['carrinho'] = $carrinho;
        }
    }
}

// Redireciona de volta para a página do carrinho
header('Location: carrinho.php');
exit();
?>
