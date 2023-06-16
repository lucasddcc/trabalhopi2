<?php
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
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Catálogo de Produtos</title>
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
    <style>
        body {
            background-color: #f8f9fa;

        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #3153afa8;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .error-message {
            color: blue;
            font-weight: bold;
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .aaaaaa {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="container mt-4">
        <?php
        // Verifica se o parâmetro 'codigo' foi enviado na URL
        if (isset($_GET['codigo'])) {
            $codigo = $_GET['codigo'];

            // Consulta o produto com base no código recebido
            $sql = "SELECT * FROM produto WHERE codigo = '$codigo'";
            $resultado = mysqli_query($conexao, $sql);

            // Verifica se o produto foi encontrado
            if ($resultado && mysqli_num_rows($resultado) > 0) {
                $row = mysqli_fetch_assoc($resultado);
                $nome = $row['nome'];
                $descricao = $row['descricao'];
                $quantidade = $row['quantidade'];
                $preco = $row['preco'];
                $imagem = base64_encode($row['imagem']);

                // Exibe os detalhes do produto
                echo '<h2>' . $nome . '</h2>';
                echo '<img src="data:;base64,' . $imagem . '" alt="Imagem do Produto">';
                echo '<p><strong>Descrição:</strong> ' . $descricao . '</p>';
                echo '<p><strong>Quantidade:</strong> ' . $quantidade . '</p>';
                echo '<p><strong>Preço:</strong> R$' . $preco . '</p>';
                echo '<form action="carrinho.php" method="post">
                <input type="hidden" name="codigo" value="' . $codigo . '">
                <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button><br><br><br>
                </form>';

                // Processar o envio do comentário
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Verificar se o comentário foi enviado
                    if (isset($_POST["comentario"])) {
                        $comentario = $_POST["comentario"];
                        $codigo = $_POST["codigo"];

                        // Inserir o comentário no banco de dados
                        $sqlInserirComentario = "INSERT INTO comentarios (codigo_produto, comentario) VALUES ('$codigo', '$comentario')";
                        $resultadoInserirComentario = mysqli_query($conexao, $sqlInserirComentario);

                        // Verificar se o comentário foi inserido com sucesso
                        if ($resultadoInserirComentario) {
                            echo '<div class="error-message aaaaaa" ">comentário enviado com sucesso!</div>';
                        } else {
                            $mensagem = "Erro ao enviar o comentário.";
                        }
                    }
                }

                // Exibir a mensagem de sucesso ou erro
                if (isset($mensagem)) {
                    echo '<p>' . $mensagem . '</p>';
                }

                // Formulário de comentário
                echo '<form method="POST">';
                echo '<div class="form-group">';
                echo '<label for="comentario">Comentário:</label>';
                echo '<textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>';
                echo '</div>';
                echo '<input type="hidden" name="codigo" value="' . $codigo . '">';
                echo '<button type="submit" class="btn btn-primary">Enviar Comentário</button>';
                echo '</form>';
            } else {
                echo '<p>Produto não encontrado.</p>';
            }
        } else {
            echo '<p>Código do produto não fornecido.</p>';
        }
        ?>
        <?php
        // Verificar se há comentários para o produto
        $sqlComentarios = "SELECT nome_usuario, comentario FROM comentarios WHERE codigo_produto = '$codigo'";
        $resultadoComentarios = mysqli_query($conexao, $sqlComentarios);

        if ($resultadoComentarios && mysqli_num_rows($resultadoComentarios) > 0) {
            echo '<h3>Comentários:</h3>';

            while ($rowComentario = mysqli_fetch_assoc($resultadoComentarios)) {
                $nomeUsuario = $rowComentario['nome_usuario'];
                $comentario = $rowComentario['comentario'];

                echo '<p><strong>' . $nomeUsuario . ':</strong> ' . $comentario . '</p>';
            }
        } else {
            echo '<p>Ainda não há comentários para este produto.</p>';
        }
        // Fecha a conexão com o banco de dados
        mysqli_close($conexao);
        ?>
    </div>
    <!-- Scripts JavaScript do Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <br>
    <?php
    include_once('footer.php');
    ?>

</body>

</html>