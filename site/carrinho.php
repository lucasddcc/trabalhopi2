<!DOCTYPE html>
<html lang="en">

<head>
    <title>Catálogo de Produtos</title>
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
    <div class="container mt-4" >
        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <a class="navbar-brand" href="index.php">Loja de Eletrônicos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background-color: #3d6be7;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Página Principal</a>
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
        <h2>Produtos no Carrinho</h2>

        <div class="row">
            <?php
            session_start();

            // Verifica se a sessão do carrinho existe e se há produtos adicionados
            if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
                echo '<div class="container mt-4">';
                echo '<h2>Produtos no Carrinho</h2>';
                echo '<div class="row">';

                // Percorre os produtos no carrinho
                foreach ($_POST['codigo'] as $codigo) {
                    // Aqui você pode fazer consultas ao banco de dados ou usar os dados armazenados na sessão, dependendo de como você estruturou seus dados de produtos

                    // Exibe as informações do produto
                    echo '<div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Produto adicionado:</h5>
                                <p class="card-text">ID do Produto: ' . $codigo . '</p>
                            </div>
                        </div>
                    </div>';
                }

                echo '</div>';
                echo '</div>';
            } else {
                echo '<p class="no-results">Nenhum produto adicionado ao carrinho.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Scripts JavaScript do Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
