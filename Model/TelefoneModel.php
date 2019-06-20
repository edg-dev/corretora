<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class TelefoneModel {
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($idPessoa, $telefone1, $telefone2){
        try{
            $idP = intval($idPessoa[0]);

            $telefone = $this->bd->prepare("INSERT INTO telefone(idPessoa, telefone) VALUES (:idPessoa, :telefone)");
            $telefone->bindParam(":idPessoa", $idP, PDO::PARAM_INT);
            $telefone->bindParam(":telefone", $telefone1);
            $telefone->execute();

            $telefone = $this->bd->prepare("INSERT INTO telefone(idPessoa, telefone) VALUES (:idPessoa, :telefone)");
            $telefone->bindParam(":idPessoa", $idP, PDO::PARAM_INT);
            $telefone->bindParam(":telefone", $telefone2);
            $telefone->execute();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function getTelefonesById($idPessoa){
        $select = $this->bd->prepare("SELECT telefone FROM telefone where idPessoa = :idPessoa");
        $select->bindParam(":idPessoa", $idPessoa);
        $select->execute();
        return $select->fetchAll();
    }

}

?>