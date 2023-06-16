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

    <div class="container">
        <h1>Loja Fisica</h1>
        <h4>Venha nos conhecer e se maravilhar com nossos produtos e descontos incrieis</h4>
    </div>

    <iframe class="container"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10988.532909863896!2d-48.23202963100415!3d-18.912189403080014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94a44f794bf1137b%3A0xb66c1ac5715128c!2sZool%C3%B3gico%20Municipal%20de%20Uberl%C3%A2ndia!5e0!3m2!1spt-BR!2sbr!4v1686951541762!5m2!1spt-BR!2sbr"
        width="600" height="600" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>


    

    <?php
    include_once('footer.php');
    ?>

    <!-- Scripts JavaScript do Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>

</html>