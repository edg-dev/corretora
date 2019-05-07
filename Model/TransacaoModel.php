<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class TransacaoModel{

    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($transacao){
        try{

            $insTransacao = $this->bd->prepare("INSERT INTO Transacao(descricaoTransacao) 
                                        VALUES (:descricaoTransacao)");

            $insTransacao->bindParam(":descricaoTransacao", $transacao);

            $insTransacao->execute();

        } catch(Exception $e){
            throw $e;
        }
    }
    public function getidTrasacao($transacao){       
        try{
            $selTransacao = $this->bd->prepare("SELECT idTransacao FROM Transacao WHERE descricaoTransacao LIKE ? ");
            $param = array("%$transacao%");//pode dar errado
            $selTransacao->execute($param);

            return $idTransacao = $selTransacao->fetch();
        } catch(Exception $e){
            throw $e;
        }
    }
    public function getAllTransacao(){
        try{
            $resTransacao = $this->bd->query("SELECT * FROM Transacao");
            $resTransacao->execute();
            return $transacao = $resTransacao->fetchAll();
        }catch(Exception $e){
            throw $e;
        }
    }
}

?>