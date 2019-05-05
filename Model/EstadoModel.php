<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class EstadoModel{

    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function getAllEstado(){
        try{
            $resEstado = $this->bd->query("SELECT * FROM estado");
            $resEstado->execute();
            return $estados = $resEstado->fetchAll();
        } catch(Exception $e){
            throw $e;
        }
    }
}

?>