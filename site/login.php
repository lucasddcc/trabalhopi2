<?php
//CONECTA AO BANCO DE DADOS
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- BOOTSTRAP 5 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color: #5f7dcf;">
<nav class="navbar navbar-expand-lg bg-body-tertiary navbar bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
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

        <br><br><br>
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

        <!-- Scripts JavaScript do Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>