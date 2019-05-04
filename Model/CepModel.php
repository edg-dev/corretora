<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class CepModel{
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function listarIdPorDescricao($descricaoCep){
        $resCep = $this->bd->query("SELECT idCep FROM Cep WHERE descricaoCep = :descricaoCep");
        $resCep->bindParam(":descricaoCep", $descricaoCep);
        $resCep->execute();
        return $idCep = $resCep->fetch();
    }

    public function inserir($descicaoCep) {
            $insCep = $this->bd->prepare("INSERT INTO cep(descricaoCep) VALUES(:descricaoCep)");
            $insCep->bindParam(":descricaoCep", $descricaoCep);
            $insCep->execute();
    }
}

?>
