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


mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Loja de Eletrônicos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
                        <a class="nav-link" href="login.php">Login</a>
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

        <!-- Formulário de Login -->
        <div class="container">
            <h2>Login</h2>
            <form id="login-form" action="testLogin.php" method="post">
                <div class="form-group">
                    <label for="username">Email:</label>
                    <input type="text" class="form-control" id="username" placeholder="Digite o nome de usuário"
                        name="username">
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" id="password" placeholder="Digite a senha"
                        name="password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Entrar</button>
                <div class="alert alert-danger mt-3" id="login-error" style="display: none;">Nome de usuário ou senha
                    incorretos</div>

            </form>
        </div>

        <!-- FOOTER -->
        <footer>
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Informações de Contato</h4>
                            <p>Endereço: Avenida da Imprensa, 1137 - Ribeirão Preto - São Paulo</p>
                            <p>Telefone: (16) 3826-4002</p>
                            <p>Email: exemplo@email.com</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Links Úteis</h4>
                            <ul>
                                <li><a href="#">Página Inicial</a></li>
                                <li><a href="#">Produtos</a></li>
                                <li><a href="#">Sobre Nós</a></li>
                                <li><a href="#">Contato</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>&copy; 2023 Loja de Tecnologias Tech Store. Todos os direitos reservados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Scripts JavaScript do Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>