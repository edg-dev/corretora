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
    public function alteraSenha($senhanova, $idUsuario){
        try{
            $senha = sha1($senhanova);
            $alteraSenha = $this->bd->prepare("UPDATE usuario as u SET u.senha = :senhanova
                                                WHERE u.idUsuario = :idUsuario");
            $alteraSenha->bindParam(":senhanova", $senha);
            $alteraSenha->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $alteraSenha->execute();
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function getSenha($idUsuario){
        $senha = $this->bd->prepare("SELECT senha FROM usuario where idUsuario = :idUsuario");
        $senha->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
        $senha->execute();
        return $senha->fetch(PDO::FETCH_ASSOC);

    public function userInfo($idUsuario){
        $select = $this->bd->prepare("SELECT * FROM Usuario as u inner join usuarioperfil as up
            on up.idusuario = u.idusuario where u.idusuario = :idUsuario");
        $select->bindParam(":idUsuario", $idUsuario);
        $select->execute();
        return $select->fetch(PDO::FETCH_ASSOC);
    }
}

?>