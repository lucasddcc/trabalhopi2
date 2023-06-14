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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- BOOTSTRAP 5 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body style="background-color: #5f7dcf;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar bg-dark border-bottom border-bottom-dark"
        data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Tech Store Tecnologias</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Página Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_cliente.php">Cadastro de Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_produtos.php">Catálogo de Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_produto.php">Cadastro de Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="busca_produto.php">Busca de Produto</a>
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
                            <i class="fa fa-bell"></i> Notificações</a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="logout.php">
                            <i class="fa fa-power-off"></i> Sair</a>
                    </li>
                    <?php echo '<p style="margin-top: 20px;">' . $nomeUser . '</p>'; ?>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-4" style="display: flex;">
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
                                <div class="card mb-4" >
                                    <img class="card-img-top" style="max-width: 100%; max-height: 200px;" src="data:;base64,' . $imagem . '" alt="Imagem do Produto">
                                    <div class="card-body">
                                        <div>
                                            <h5 class="card-title">' . $nome . '</h5>
                                            <p class="card-text">' . $descricao . '</p>
                                            <p class="card-text">Quantidade: ' . $quantidade . '</p>
                                            <p class="card-text">Preço: ' . $preco . '</p>
                                            <div style="display: flex;">
                                                <form action="adicionar_carrinho.php" method="post">
                                                <input type="hidden" name="codigo" value="' . $codigo . '">
                                                <button id="botao_carrinho adicionar" type="submit" class="btn btn-success">Adicionar</button>
                                                </form>
                                                <form action="remover_carrinho.php" method="post">
                                                <input type="hidden" name="codigo" value="' . $codigo . '">
                                                <button id="botao_carrinho remover" type="submit" class="botao_carrinho btn btn-danger">Remover</button>
                                                </form>
                                            </div>
                                        </div>
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
    <?php

    // Função para gerar número de pedido aleatório
    function gerarNumeroPedido()
    {
        // Gera um número de pedido aleatório de 6 dígitos
        return '#' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }


    // Verifica se o formulário foi enviado para finalizar o pedido
    if (isset($_POST['finalizar_pedido'])) {
        // Gera um número de pedido aleatório
        $numeroPedido = gerarNumeroPedido();

        // Obtém os produtos do carrinho
        $produtosCarrinho = $_SESSION['carrinho'];

        // Percorre os produtos do carrinho para decrementar a quantidade no banco de dados
        foreach ($produtosCarrinho as $codigo) {
            // Consulta a quantidade atual do produto no banco de dados
            $sql = "SELECT quantidade FROM produto WHERE codigo = '$codigo'";
            $resultado = mysqli_query($conexao, $sql);
            $row = mysqli_fetch_assoc($resultado);
            $quantidadeAtual = $row['quantidade'];

            // Decrementa a quantidade do produto no banco de dados
            $novaQuantidade = $quantidadeAtual - 1;
            $sql = "UPDATE produto SET quantidade = $novaQuantidade WHERE codigo = '$codigo'";
            mysqli_query($conexao, $sql);
        }

        // Limpa o carrinho
        $_SESSION['carrinho'] = array();

        // Exibe a mensagem de confirmação do pedido com o número de pedido gerado
        echo '<div class="container">
        <div class="alert alert-success" role="alert">
            O pedido foi feito com sucesso!
            <br>
            Número do pedido: ' . $numeroPedido . '
        </div>
        </div>';
    }
    ?>

    <!-- Restante do código HTML -->

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

        <!-- Formulário para finalizar o pedido -->
        <div>
            <a href="lista_produtos.php" class="btn btn-primary">Continuar Comprando</a>
        </div>
        <br>
        <form action="carrinho.php" method="post">
            <input type="hidden" name="finalizar_pedido" value="1">
            <button type="submit" class="btn btn-primary">Finalizar Pedido</button>
        </form>
    </div>





    <style>
    body {
      margin: 0;
      padding-bottom: 60px; /* altura do footer */
    }

    footer {
      position: absolute;
      left: 0;
      bottom: 0;
      width: 100%;
      height: 60px; /* altura do footer */
      background-color: #0b0262;
      text-align: center;
      color: whitesmoke;
    }
  </style>


<footer>
<span>© 2023 Tech Store Loja de Tecnologia. Todos os direitos reservados.</span>
  </footer>




    </div>

    <!-- Scripts JavaScript do Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>