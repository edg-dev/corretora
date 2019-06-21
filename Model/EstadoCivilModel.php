<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class EstadoCivilModel{
    
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function getAllEstadoCivil(){
        try{
            $resEstadoCivil = $this->bd->query("SELECT * FROM estadocivil");
            $resEstadoCivil->execute();
            return $estadosCivil = $resEstadoCivil->fetchAll();
        } catch(Exception $e){
            throw $e;
        }
    }
}

?>