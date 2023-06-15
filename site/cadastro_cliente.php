<?php
session_start();
include_once('conectarBanco.php');
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

include_once('conectarBanco.php');

// Obtém os valores enviados pelo formulário
$nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$senha = isset($_POST["senha"]) ? $_POST["senha"] : "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($username) || empty($email) || empty($password)) {
        exit('Por favor, preencha todos os campos obrigatórios.');
    }

    if (!validateEmail($email)) {
        exit('O e-mail informado é inválido.');
    }

    // Insere o usuário na tabela "users"
    $sql = "INSERT INTO cliente (nome, email, senha) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conexao, $sql)) {
        echo "Usuário cadastrado com sucesso!";
        header('Location: login.php');
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conn);
    }
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
    <script src="script.js"></script>
    <div class="container mt-4">
        <h2>Cadastro</h2>

        <form id="cadastro-form" action="cadastro_cliente.php" method="post" onsubmit="return validarCadastro()">

            <div class="form-group">
                <label for="username">Nome de Usuário:</label>
                <input type="text" class="form-control" id="username" placeholder="Digite o nome de usuário"
                    name="username">
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" placeholder="Digite o e-mail" name="email">
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" placeholder="Digite a senha" name="password">
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