<?php //função para pegar o nome e colocar na página
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
?>

<?php //ver se é admin
//print_r($_SESSION);
if ((!isset($_SESSION['username']) == true) and (!isset($_SESSION['password']) == true)) {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header('Location: login.php');
}

$email = $_SESSION['username'];
$sql = "SELECT admin FROM cliente WHERE email = '$email' ";
$verificaAdmin = -1;
$result = mysqli_query($conexao, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $verificaAdmin = $row["admin"];
    //print_r($row["admin"]);
} else {
    echo "Nenhum resultado encontrado.";
}

// print_r($verificaAdmin);
// echo '<p>' .($_SESSION['username']). '</p>';
// echo '<h1>' .($verificaAdmin). '</h1>';
// echo '<h1>' .($_SESSION). '</h1>';

if ($verificaAdmin < 1) {
    header("location:lista_produtos.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];


    // Verifica se um arquivo de imagem foi enviado
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        // Lê o arquivo de imagem
        $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
        // Escapa os caracteres especiais da imagem
        $imagem = mysqli_real_escape_string($conexao, $imagem);
    } else {
        // Define um valor padrão para a imagem, caso nenhum arquivo tenha sido enviado
        $imagem = '';
    }

    // Insere os valores na tabela "produtos" incluindo a imagem
    $sql = "INSERT INTO produto(nome, descricao, quantidade, preco, imagem) VALUES ('$nome','$descricao','$quantidade', '$preco', '$imagem')";
    if (mysqli_query($conexao, $sql)) {
        header("Location: lista_produtos.php");
    } else {
        echo "Erro ao cadastrar produto: " . mysqli_error($conexao);
    }
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- BOOTSTRAP 5 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="script.js"></script>
</head>

<body style="background-color: #5f7dcf;">

    <?php
    include_once('header.php');
    ?>
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
                <input type="text" class="form-control" id="nome" placeholder="Digite o nome do produto" name="nome">
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
                <input type="text" class="form-control" id="preco" placeholder="Digite o preço do produto" name="preco">
            </div>

            <div class="form-group">
                <label for="qnt">Imagem:</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
            </div>


            <button id="cadastro-btn" class="btn btn-primary">Cadastrar</button>
            <input type="button" class="btn btn-primary" value="Limpar" onclick="limparFormulario()">
        </form>
    </div>
    <style>
        body {
            margin: 0;
            padding-bottom: 60px;
            /* altura do footer */
        }

        footer {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 60px;
            /* altura do footer */
            background-color: #0b0262;
            text-align: center;
            color: whitesmoke;
        }
    </style>


    <?php
    include_once('footer.php');
    ?>

</body>

</html>