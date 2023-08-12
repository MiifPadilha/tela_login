<?php
  require_once('classes/Usuario.php');
  require_once('conexao/conexao.php');

  $database = new conexao();
  $db = $database ->getConnection();
  $usuario = new Usuario($db);
  
  if (isset ($_POST ['cadastrar'])){
    $nome = $_POST['$nome'];
    $email = $_POST['$email'];
    $senha = $_POST['$senha'];
    $confsenha = $_POST['$confsenha'];
  
    if ($usuario->cadastrar($nome, $email, $senha, $confsenha)){
    echo "cadastro realizado com sucesso";
    }else{
    echo "erro ao cadastrar novo usuario.";
    }
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
    <form method= "POST">
    <label for="nome">nome</label>
        <input type= "text" nome= nome placeholder ="informe seu nome">
        <label for="email"> e-mail</label>
        <input type= "email" nome=email placeholder ="informe seu email">
        <label for ="senha"> senha </label>
        <input type="password" name= "senha" placeholder = "insira sua senha">
        <label for =""> confirmar senha </label>
        <input type="password" name= "confsenha" placeholder = "cofirme sua senha">

        <button type="submit" name="Cadastrar">Cadastrar</button>

</form>
<a href ="index.php"> voltar para a página de login</a> 
</body>
</html>