<?php
include_once('conectarBanco.php');
?>
<?php 
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
    <title>Contato</title>
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
    <script src="js/script.js"></script>
    <!-- <style>
        body {
            background-color: #5f7dcf;
        }

        .container {
            background-color: #1e1f22;
            padding: 30px;
            border-radius: 5px;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: RoyalBlue;
        }

        label {
            font-weight: bold;
        }

        textarea {
            resize: vertical;
        }

        .btn {
            margin-top: 10px;
        }

    </style> -->
</head>

<body style="background-color: #5f7dcf;">
    <?php
    include_once('header.php');
    ?>

    <div class="container mt-4">
        <h2>Contato</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            onsubmit="return validarCadastro()">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="motivo">Motivo para Contato:</label>
                <select id="motivo" name="motivo" class="form-control" required>
                    <option value="duvida">Dúvida</option>
                    <option value="troca_devolucao">Troca ou Devolução</option>
                    <option value="pedido">Pedido</option>
                    <option value="produto">Produto</option>
                    <option value="sugestao_elogio">Sugestão, Elogio ou Reclamação</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" rows="5" class="form-control" required></textarea>
            </div>

            <button id="cadastro-btn" class="btn btn-primary">Enviar</button>
            <input type="button" class="btn btn-primary" value="Limpar" onclick="limparFormulario()">
        </form>
    </div>

    <?php
    // Verificando se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Recebendo os dados do formulário
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $motivo = $_POST["motivo"];
        $mensagem = $_POST["mensagem"];

        // Verificando se todos os campos foram preenchidos
        if (empty($nome) || empty($email) || empty($telefone) || empty($motivo) || empty($mensagem)) {
            echo "Por favor, preencha todos os campos do formulário.";
        } else {
            // Inserindo os dados no banco de dados
            $sql = "INSERT INTO contato (nome, email, telefone, motivo, mensagem)
                    VALUES ('$nome', '$email', '$telefone', '$motivo', '$mensagem')";

            if (mysqli_query($conexao, $sql) === TRUE) {
                echo "Mensagem enviada com sucesso!";
            } else {
                echo "Erro ao enviar mensagem: ";
            }
        }
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conexao);
    ?>

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