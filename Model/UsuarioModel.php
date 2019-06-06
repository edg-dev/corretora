<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class UsuarioModel{

    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($idPessoa,  $email, $senha){
        try{
            $usuario = $this->bd->prepare("INSERT INTO usuario(idUsuario, usuario, senha) VALUES (:idUsuario, :email, :senha)");
            $senhaCrip = sha1($senha);
            $usuario->bindParam(":idUsuario", $idPessoa);
            $usuario->bindParam(":email", $email);
            $usuario->bindParam(":senha", $senhaCrip);
            $usuario->execute(); 

        } catch(Exception $e){
            throw $e;
        }
    }

    public function countUsers(){
        try{
            $users = $this->bd->prepare("SELECT COUNT(*) as total FROM Usuario");
            $users->execute();
            return $users->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $e){
            throw $e;
        }     
    }

    public function userInfo($idUsuario){
        $select = $this->bd->prepare("SELECT * FROM Usuario as u inner join usuarioperfil as up
            on up.idusuario = u.idusuario where u.idusuario = :idUsuario");
        $select->bindParam(":idUsuario", $idUsuario);
        $select->execute();
        return $select->fetch(PDO::FETCH_ASSOC);
    }
}

?>