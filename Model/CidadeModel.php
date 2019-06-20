<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class CidadeModel{
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function listarIdPorCidade($nomeCidade){
        try{
            $resCidade = $this->bd->prepare("SELECT idCidade FROM cidade WHERE nomeCidade = :nomeCidade");
            $resCidade->bindParam(":nomeCidade", $nomeCidade);
            $resCidade->execute();
            return $idCidade = $resCidade->fetch();  
        } catch(Exception $e){
            throw $e;
        }      
    }

    public function inserir($nomeCidade){   
        try{   
            $insCidade = $this->bd->prepare("INSERT INTO cidade(nomeCidade) VALUES(:nomeCidade)");
            $insCidade->bindParam(":nomeCidade", $nomeCidade);
            $insCidade->execute();
        } catch(Exception $e){
            throw $e;
        }
    }
}


?>