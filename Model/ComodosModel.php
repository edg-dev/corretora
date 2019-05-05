<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class EnderecoModel{
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($descricaoComodos){

        $insercao = $this->bd->prepare(
            "INSERT INTO Comodos(descricaoComodos)
            VALUES (:descricaoComodos)"
        );

        $insercao->bindParam(":descricaoComodos", $descricaoComodos);
        $insercao->execute();
    }

}

?>