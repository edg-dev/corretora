<?php
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'corretora');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');

function geraChaveAcesso($usuario){
    $stmt = $this->prepare("SELECT * FROM login WHERE usuario = :usuario");
    $stmt->bindValue(":usuario",$usuario);
    $run = $stmt->execute();
  
    $rs = $stmt->fetch(PDO::FETCH_ASSOC);
    
     if($rs){
       $chave = sha1($rs["id"].$rs["senha"]);
       return $chave;
     }
  
  }
  