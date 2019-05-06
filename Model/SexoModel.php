<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class SexoModel {
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }
    public function getCodigoSexo($codigoSexo){
        $sexo = $this->bd->query("SELECT codigoSexo FROM Sexo WHERE codigoSexo = :codigoSexo");
        $sexo->bindParam(":codigoSexo", $codigoSexo);
        $sexo->execute();

        return $res = $sexo->fetch();
    }
}


?>