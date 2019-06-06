<?php
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
 
 
 function checkChave($usuario,$chave){
   $stmt = $this->pdo->prepare("SELECT * FROM login WHERE usuario = :usuario");
   $stmt->bindValue(":usuario",$usuario);
   $run = $stmt->execute();
 
   $rs = $stmt->fetch(PDO::FETCH_ASSOC);
 
   if($rs){
     $chaveCorreta = sha1($rs["id"].$rs["senha"]);
     if($chave == $chaveCorreta){
        return $rs["id"];
     }
   }
 }
 
 function setNovaSenha($novasenha,$id){
   $stmt = $this->pdo->prepare("UPDATE login SET senha = :novasenha WHERE id = :id");
   $stmt->bindValue(":novasenha",sha1($novasenha));
   $stmt->bindValue(":id",$id);
   $run = $stmt->execute();
 }

