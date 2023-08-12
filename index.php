<?php
session_start();

require_once('classes/Usuario.php');
require_once('conexao/conexao.php');

$database= new Conexao();
$db=$database->getConnection();
$usuario=new Usuario($db);

if(isset($_POST['logar'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
}

if ($Usuario -> logar( $email, $senha)){
    $_SESSION['email']=$email;

    header('Location: dashboard.php');
    exit();
}else{
    print"<script>alert ('Login Invalido')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tela de login</title>
</head>
<body>
    <form method ="POST">
        <label for="email"> e-mail</label>
        <input type= "email" nome=email placeholder ="informe seu email">
        <label for ="senha"> senha </label>
        <input type="password" name= "senha" placeholder = "insira sua senha">

        <button type="submit" name="logar">logar</button>

</form>
<a href ="cadastro.php"> criar uma nova conta</a> 
</body>
</html>