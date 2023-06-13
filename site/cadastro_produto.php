<?php
session_start();
include_once('conectarBanco.php');
// print_r($_SESSION);
if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['password']) == true))
{
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: login.php');
}
// Obtém os valores enviados pelo formulário
$nome = $_POST["nome"];
$codigo = $_POST["codigo"];
$descricao = $_POST["descricao"];
$quantidade = $_POST["quantidade"];

// Verifica se um arquivo de imagem foi enviado
if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){
    // Lê o arquivo de imagem
    $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    // Escapa os caracteres especiais da imagem
    $imagem = mysqli_real_escape_string($conexao, $imagem);
} else {
    // Define um valor padrão para a imagem, caso nenhum arquivo tenha sido enviado
    $imagem = '';
}

// Insere os valores na tabela "produtos" incluindo a imagem
$sql = "INSERT INTO produto (nome, codigo, descricao, quantidade, imagem) VALUES ('$nome', '$codigo', '$descricao', $quantidade, '$imagem')";

if (mysqli_query($conexao, $sql)) {
    header("Location: lista_produtos.php");
} else {
    echo "Erro ao cadastrar produto: " . mysqli_error($conexao);
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cadastro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS Personalizado -->

    <link rel="stylesheet" type="text/css" href="css/style_produto.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="script.js"></script>
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
        <!-- Scripts JavaScript do Bootstrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Formulário de Cadastro -->
        <script src="script_cad_produto.js"></script>
        <div class="container mt-4">
            <h2>Cadastro</h2>

            <form id="cadastro_produto-form" action="cadastro_produto.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="nome">Nome de Produto:</label>
                    <input type="text" class="form-control" id="nome" placeholder="Digite o nome do produto"
                        name="nome">
                </div>

                <div class="form-group">
                    <label for="desc">Descrição:</label>
                    <input type="text" class="form-control" id="descricao" placeholder="Digite a descrição do produto"
                        name="descricao">
                </div>

                <div class="form-group">
                    <label for="qnt">Quantidade:</label>
                    <input type="number" class="form-control" id="quantidade" placeholder="Digite a quantidade"
                        name="quantidade">
                </div>

                <div class="form-group">
                    <label for="qnt">Preço:</label>
                    <input type="text" class="form-control" id="preco" placeholder="Digite o preço do produto"
                        name="preco">
                </div>

                <div class="form-group">
                    <label for="qnt">Imagem:</label>
                    <input type="file" id="imagem" placeholder="Selecione a imagem do produto" 
                    name="imagem">
                </div>

                

                <button id="cadastro-btn" class="btn btn-primary">Cadastrar</button>
                <input type="button" class="btn btn-primary" value="Limpar" onclick="limparFormulario()">
            </form>
        </div>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores enviados pelo formulário
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
    $quantidade = isset($_POST["quantidade"]) ? $_POST["quantidade"] : "";
    $preco = isset($_POST["preco"]) ? $_POST["preco"] : "";

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

    // Verifica se um arquivo de imagem foi enviado
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){
        // Lê o arquivo de imagem
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        // Escapa os caracteres especiais da imagem
        $imagem = mysqli_real_escape_string($conexao, $imagem);
    } else {
        // Define um valor padrão para a imagem, caso nenhum arquivo tenha sido enviado
        $imagem = '';
    }

    // Insere os valores na tabela "produtos" incluindo a imagem
    $sql = "INSERT INTO produto (nome, descricao, quantidade, preco, imagem) VALUES ('$nome', '$descricao', '$quantidade', '$preco', '$imagem')";
    if (mysqli_query($conexao, $sql)) {
        echo "Produto cadastrado!";
    } else {
        echo "Erro ao cadastrar produto: " . mysqli_error($conexao);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
}
?>
