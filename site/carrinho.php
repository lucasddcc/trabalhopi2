<?php
session_start();
//CONECTA AO BANCO DE DADOS
include_once('conectarBanco.php');
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Carrinho de Compras</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body style="background-color: #5f7dcf;">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Loja de Eletrônicos</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Página Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_cliente.php">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_produtos.php">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_produto.php">Cadastro Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="busca_produto.php">Buscar Produto</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="carrinho.php">
                            <i class="fa fa-shopping-cart"></i> Carrinho
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-bell"></i> Notificações
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mt-4">
            <?php
            // Verifica se o carrinho está vazio
            if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
                // Cria um array associativo para armazenar a quantidade de cada produto
                $quantidades = array_count_values($_SESSION['carrinho']);

                // Loop através dos produtos no carrinho
                foreach ($quantidades as $codigo => $quantidade) {
                    // Consulta os detalhes do produto no banco de dados
                    $sql = "SELECT * FROM produto WHERE codigo = '$codigo'";
                    $resultado = mysqli_query($conexao, $sql);

                    // Verifica se a consulta retornou algum resultado
                    if (mysqli_num_rows($resultado) > 0) {
                        $row = mysqli_fetch_assoc($resultado);
                        $nome = $row['nome'];
                        $descricao = $row['descricao'];
                        $imagem = base64_encode($row['imagem']);
                        $preco = $row['preco'];
                        // Exibe o card com o produto e a quantidade
                        echo '<div class="col-md-4">
                                <div class="card mb-4">
                                    <img class="card-img-top" style="max-width: 100%; max-height: 200px;" src="data:;base64,' . $imagem . '" alt="Imagem do Produto">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $nome . '</h5>
                                        <p class="card-text">' . $descricao . '</p>
                                        <p class="card-text">Quantidade: ' . $quantidade . '</p>
                                        <p class="card-text">Preço: ' . $preco . '</p>
                                        <form action="adicionar_carrinho.php" method="post">
                                        <input type="hidden" name="codigo" value="' . $codigo . '">
                                        <button type="submit" class="btn btn-success">Adicionar</button>
                                        </form>
                                        <form action="remover_carrinho.php" method="post">
                                        <input type="hidden" name="codigo" value="' . $codigo . '">
                                        <button type="submit" class="btn btn-danger">Remover</button>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                    }
                }
            } else {
                echo "<p>O carrinho está vazio.</p>";
            }
            ?>
        </div>
        <div class="container">
            <?php
            // Calcula o total de itens no carrinho
            $totalItens = count($_SESSION['carrinho']);

            // Calcula o preço total somado
            $precoTotal = 0;

            // Loop através dos produtos no carrinho para somar os preços
            foreach ($_SESSION['carrinho'] as $produto) {
                // Consulta o preço do produto no banco de dados
                $sql = "SELECT preco FROM produto WHERE codigo = '$produto'";
                $resultado = mysqli_query($conexao, $sql);

                // Obtém o preço do resultado da consulta
                $row = mysqli_fetch_assoc($resultado);
                $preco = $row['preco'];

                // Soma o preço ao total
                $precoTotal += $preco;
            }
            ?>
            <h4>Total de Itens:
                <?php echo $totalItens; ?>
            </h4>
            <h4>Preço Total: R$
                <?php echo number_format($precoTotal, 2, ',', '.'); ?>
            </h4>
        </div>
        <a href="index.php" class="btn btn-primary">Continuar Comprando</a>
    </div>

    <!-- Scripts JavaScript do Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
