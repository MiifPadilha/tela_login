<?php
include ('conexao/conexao.php');

$db = new conexao ();

class Usuario{
    private $conn;

    public function __construct($db){

        $this->conn= $db;
    }

public function cadastrar($nome, $email, $senha, $confsenha)
{
    if ($senha === $confsenha){ 

        $emailesistente=$this->verificaremailexistente($email);
        if($emailesistente){
            print"<script> alert('Email ja cadastrado')</script>";
            return false;
        }

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    $sql= "INSERT INTO usuarios (nome, email, senha) VALUES( ?, ?, ?)";


    $stmt = $this-> conn->prepare($sql);
    $stmt-> binvalue (1, $nome);
    $stmt-> binvalue (2, $email);
    $stmt-> binvalue (3, $senha);
    $stmt-> binvalue (4, $senhaCriptografada);
    $result =$stmt ->execute();

    return $result;
    
    }else{
        return false;
    }
}

private function verificaremailexistente($email){
 $sql="SELECT COUNT(*) FROM usuarios WHERE email =?";
 $stmt= $this->conn-> prepare ($sql);
 $stmt->bindParam(1,$email);
 $stmt->execute ();

    return $stmt->fetchColumn()>0;
}

public function logar ($email,$senha){
    $sql= "SELECT * FROM usuarios WHERE email = $email";
    $stmt= $this->conn-> prepare ($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    if ($stmt-> rowCount() == 1){
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if(password_verify($senha, $usuario['senha'])){
            return true;
        }
    }

    return false;
}

}

?>