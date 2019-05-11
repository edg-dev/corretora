<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class TipoImovelModel{

    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($DescricaoTipoImovel){
        try{

            $insTipo = $this->bd->prepare("INSERT INTO TipoImovel($DescricaoTipoImovel) 
                                        VALUES (:DescricaoTipoImovel)");

            $insTipo->bindParam(":DescricaoTipoImovel", $DescricaoTipoImovel);

            $insTipo->execute();

        } catch(Exception $e){
            throw $e;
        }
    }

    public function getIdTipoImovel($DescricaoTipoImovel){       
        try{
            $selTipoImovel = $this->bd->prepare("SELECT idTipoImovel FROM TipoImovel WHERE DescricaoTipoImovel LIKE ? ");
            $param = array("%$DescricaoTipoImovel%");//pode dar errado
            $selTipoImovel->execute($param);

            return $idTipoImovel = $selTipoImovel->fetch();
        } catch(Exception $e){
            throw $e;
        }
    }
    public function getAllTipoImovel(){
        try{
            $resTipo = $this->bd->query("SELECT * FROM TipoImovel");
            $resTipo->execute();
            return $tipoImovel = $resTipo->fetchAll();
        }catch(Exception $e){
            throw $e;
        }
    }
}

?>