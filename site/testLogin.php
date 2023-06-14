<?php
    session_start();
    // print_r($_REQUEST);
    if(isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password']))
    {
        // Acessa
        include_once('conectarBanco.php');
        $username = $_POST['username'];
        $password = $_POST['password'];

        // print_r('username: ' . $username);
        // print_r('<br>');
        // print_r('password: ' . $password);

        $sql = "SELECT * FROM cliente WHERE email = '$username' and senha = '$password'";

        $result = $conexao->query($sql);

        // print_r($sql);
        // print_r($result);
        
        include_once('verificaAdmin.php');

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['username']);
            unset($_SESSION['password']);
            header('Location: login.php');
        }
        else
        {
            $_SESSION['username'] = $email;
            $_SESSION['password'] = $password;
            header('Location: index.php');
        }
    }
    else
    {
        // Não acessa
        header('Location: login.php');
    }
?>