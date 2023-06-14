<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cadastro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="style_produto.css">
    <script src="script.js"></script>
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
        <!-- Scripts JavaScript do Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Formulário de Cadastro -->
        <script src="script_cad_produto.js"></script>
        <div class="container mt-4">
            <h2>Buscar Produto</h2>

            <form id="cadastro_produto-form" action="busca_produto.php" method="POST">

                <div class="form-group">
                    <input type="text" name="buscar" placeholder="Digite o nome ou código do produto">
                    <input type="submit" class="btn btn-primary" value="Buscar">
                </div>
            </form>
        </div>
</body>

</html>

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

// Verifica se o formulário de busca foi submetido
if (isset($_POST['buscar'])) {
    // Obtém o valor de busca
    $busca = $_POST['buscar'];

    // Query para buscar produtos com base no nome ou código
    $sql = "SELECT * FROM produto WHERE nome LIKE '%$busca%' OR codigo LIKE '%$busca%'";

    // Executa a query
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se houve resultados
    if (mysqli_num_rows($resultado) > 0) {
        // Itera sobre os resultados
        while ($row = mysqli_fetch_assoc($resultado)) {
            $nome = $row['nome'];
            $codigo = $row['codigo'];
            $descricao = $row['descricao'];
            $quantidade = $row['quantidade'];
            $preco = $row['preco'];
            $imagem = base64_encode($row['imagem']);

            // Exibe o produto
            echo '
                <div class="col-md-4">
    <div class="card mb-4" style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
        <div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <h5 class="card-title" style="text-align: center; font-size: 18px; font-weight: bold;">' . $nome . '</h5>
            <p class="card-text" style="text-align: center;">Código: ' . $codigo . '</p>
            <p class="card-text" style="text-align: center;">' . $descricao . '</p>
            <p class="card-text" style="text-align: center;">Quantidade:' . $quantidade . '</p>
            <p class="card-text" style="text-align: center;">Preço: ' . $preco . '</p>
        </div>
        <img class="card-img-top" style="max-width: 100%; max-height: 200px;" src="data:;base64,' . $imagem . '" alt="Imagem do Produto">
    </div>
</div>

                ';
        }
    } else {
        echo '<p class="no-results">Nenhum resultado encontrado.</p>';
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>