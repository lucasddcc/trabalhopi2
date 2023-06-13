<?php
// Obtém os dados do formulário de login
$emailUsuario = $_POST['username'];
$senhaUsuario = $_POST['password'];

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

$sql = "SELECT * FROM cliente WHERE email = '$emailUsuario' AND senha = '$senhaUsuario'";
$result = $conexao->query($sql);


// Verifica se o resultado da consulta retornou algum registro
if ($result->num_rows > 0) {
    // O login é válido, o usuário está autenticado
    echo "Login bem-sucedido!";

    // Você pode redirecionar o usuário para outra página ou executar outras ações desejadas aqui

} else {
    // Login inválido, o usuário não está autenticado
    echo "Nome de usuário ou senha inválidos.";

    // Você pode redirecionar o usuário de volta para a página de login ou executar outras ações desejadas aqui
}

// Fecha a conexão com o banco de dados
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
    <link rel="stylesheet" type="text/css" href="css/style_produto.css">
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
            <form id="login-form" action="login.php" method="post">
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
                <button type="submit" class="btn btn-primary">Entrar</button>
                <div class="alert alert-danger mt-3" id="login-error" style="display: none;">Nome de usuário ou senha incorretos</div>

            </form>
        </div>


        <!-- Scripts JavaScript do Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            // Seleciona o formulário de login
            const form = document.querySelector('#login-form');

            // Adiciona um listener para o evento submit do formulário
            form.addEventListener('submit', (event) => {
                // Impede o envio do formulário
                event.preventDefault();

                // Seleciona os campos de usuário e senha
                const username = form.querySelector('#username').value;
                const password = form.querySelector('#password').value;

                // Verifica se os campos estão preenchidos
                if (!username || !password) {
                    // Exibe mensagem de erro se algum campo estiver vazio
                    document.querySelector('#login-error').style.display = 'block';
                } else {
                    // Envia o formulário se os campos estiverem preenchidos
                    form.submit();
                }
            });
        </script>
</body>
</html>

