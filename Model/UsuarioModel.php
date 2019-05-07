<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class UsuarioModel{

    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($idPessoa,  $email, $senha){
        try{
            $usuario = $this->bd->prepare("INSERT INTO usuario(idUsuario, emailLogin, senha) VALUES (:idUsuario, :email, :senha)");
            $senhaCrip = sha1($senha);
            $usuario->bindParam(":idUsuario", $idPessoa);
            $usuario->bindParam(":email", $email);
            $usuario->bindParam(":senha", $senhaCrip);
            $usuario->execute(); 

        } catch(Exception $e){
            throw $e;
        }
    }
}

?>