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
    <div id="lista_produtos" class="lista_produtos container mt-4">
        <h2>Catálogo de Produtos</h2>

        <div class="row">
            <?php
            // CONECTA AO BANCO DE DADOS
            include_once('conectarBanco.php');

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
                echo '<div class="col-md-4 container mt-4">
                            <div class="card mb-4">
                                <img class="card-img-top" style="margin: 0 auto; justify-content: center; align-items: center; display: flex; height: 250px; width: 250px" src="data:;base64,' . $imagem . '" alt="Imagem do Produto">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $nome . '</h5>
                                        <p class="card-text">Código: ' . $codigo . '</p>
                                        <p class="card-text">' . $descricao . '</p>
                                        <p class="card-text">Quantidade: ' . $quantidade . '</p>
                                        <p class="card-text">Preço: R$' . $preco . '</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                        <form action="carrinho.php" method="post">
                                        <input type="hidden" name="codigo" value="' . $codigo . '">
                                        <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                                        </form>
                                        <form action="detalhes.php" method="get">
                                        <input type="hidden" name="codigo" value="' . $codigo . '">
                                        <button type="submit" class="btn btn-secondary">Ver Detalhes</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';

            }
            // Fecha a conexão com o banco de dados
            mysqli_close($conexao);
            ?>
        </div>
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


    <?php
    include_once('footer.php');
    ?>

</body>

</html>