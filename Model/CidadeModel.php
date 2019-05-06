<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class CidadeModel{
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function listarIdPorCidade($nomeCidade){
        $resCidade = $this->bd->query("SELECT idCidade FROM Cidade WHERE nomeCidade = :nomeCidade");
        $resCidade->bindParam(":nomeCidade", $nomeCidade);
        $resCidade->execute();
        return $idCidade = $resCidade->fetch();        
    }

    public function inserir($nomeCidade){      
            $insCidade = $this->bd->prepare("INSERT INTO cidade(nomeCidade) VALUES(:nomeCidade)");
            $insCidade->bindParam(":nomeCidade", $nomeCidade);
            $insCidade->execute();
    }
}


?>