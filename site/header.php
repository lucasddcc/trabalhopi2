<?php
include_once('conectarBanco.php');
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary navbar bg-dark border-bottom border-bottom-dark"
    data-bs-theme="dark">
    <div class="container-fluid">
        <a href="index.php">
            <i href="imagens/TechStoreSemFundo.png"></i>
            <img src="imagens/TechStoreSemFundo.png" style="width: 100px; height: auto;" class="img-fluid"
                alt="Imagem responsiva">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div style="margin: 0 auto; display: flex; justify-content: center; align-items: center;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" style="font: bolder;" href="index.php">Página Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_cliente.php">Cadastre-se</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_produtos.php">Catálogo de Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_produto.php">Cadastrar de Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="busca_produto.php">Buscar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contato.php">Contato</a>
                    </li>
                </ul>
            </div>


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
                <?php echo '<p style="margin-top: 20px; color: #3153af;">' . $nomeUser . '</p>'; ?>
            </ul>
        </div>
    </div>
</nav>