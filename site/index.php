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

    <?php
    include_once('header.php');
    ?>

    <!-- CARROUSEL -->
    <div id="carouselExampleIndicators" class="container mt-4 carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="imagens/1.png" alt="Primeiro Slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="imagens/2.png" alt="Segundo Slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="imagens/3.png" alt="Terceiro Slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>



    <div id="lista_produtos" class="lista_produtos container mt-4">
        <div class="row">
            <?php
            // Consulta os produtos no banco de dados
            $sql = "SELECT * FROM produto";
            $resultado = mysqli_query($conexao, $sql);
            $cont_prod = 0;

            // Loop através dos resultados e exibe cada produto
            while ($row = mysqli_fetch_assoc($resultado)) {
                $nome = $row['nome'];
                $codigo = $row['codigo'];
                $descricao = $row['descricao'];
                $quantidade = $row['quantidade'];
                $preco = $row['preco'];
                $imagem = base64_encode($row['imagem']);

                // Exibe o produto
                echo '<div class="col-md-4">
                            <div class="card mb-4">
                                <img class="card-img-top" style="max-width: 100%; max-height: 200px;" src="data:;base64,' . $imagem . '" alt="Imagem do Produto">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $nome . '</h5>
                                        <p class="card-text">Código: ' . $codigo . '</p>
                                        <p class="card-text">' . $descricao . '</p>
                                        <p class="card-text">Quantidade: ' . $quantidade . '</p>
                                        <p class="card-text">Preço: ' . $preco . '</p>
                                        <form action="carrinho.php" method="post">
                                            <input type="hidden" name="codigo" value="' . $codigo . '">
                                            <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                                        </form>
                                    </div>
                                </div>
                            </div>';

            }
            // Fecha a conexão com o banco de dados
            mysqli_close($conexao);
            ?>
        </div>
    </div>
    </div>
    </div>


    <?php
    include_once('footer.php');
    ?>

    <!-- Scripts JavaScript do Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>

</html>