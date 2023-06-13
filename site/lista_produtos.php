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

<body>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Loja de Eletrônicos</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="#">
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
        <h2>Catálogo de Produtos</h2>

        <div class="row">
            <?php
            // Configurações do banco de dados
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $banco = "trabalho";

            // Conecta ao banco de dados
            $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

            // Verifica se a conexão foi bem sucedida
            if (!$conexao) {
                die("Conexão falhou: " . mysqli_connect_error());
            }

            // Consulta os produtos no banco de dados
            $sql = "SELECT * FROM produto";
            $resultado = mysqli_query($conexao, $sql);

            // Loop através dos resultados e exibe cada produto
            while ($row = mysqli_fetch_assoc($resultado)) {
                $nome = $row['nome'];
                $codigo = $row['codigo'];
                $descricao = $row['descricao'];
                $quantidade = $row['quantidade'];
                $imagem = base64_encode($row['imagem']);

                // Exibe o produto
                echo '
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img class="card-img-top" src="data:;base64,'.$imagem.'" alt="Imagem do Produto">
                        <div class="card-body">
                            <h5 class="card-title">'.$nome.'</h5>
                            <p class="card-text">Código: '.$codigo.'</p>
                            <p class="card-text">'.$descricao.'</p>
                            <p class="card-text">Quantidade: '.$quantidade.'</p>
                        </div>
                    </div>
                </div>';
            }
            // Fecha a conexão com o banco de dados
            mysqli_close($conexao);
            ?>
        </div>
    </div>

    <!-- Scripts JavaScript do Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>