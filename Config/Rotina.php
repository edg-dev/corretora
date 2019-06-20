<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";
    
    class Rotina {

        private $bd;

		 function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function selectPedidos($idUsuario){
            $select = $this->bd->prepare("SELECT * FROM pedidos WHERE idUsuario = :idUsuario");
            $select->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $select->execute();
            return $select->fetchAll(PDO::FETCH_ASSOC);
        }

        public function comparePedidos($idTipoImovel, $idTransacao, $idCidade, $idBairro, $idEstado,
            $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $precoMin, $precoMax)
        {
            $compare = $this->bd->prepare("SELECT 
                i.idTipoImovel, i.idTransacao, e.idCidade, e.idBairro, e.idEstado,
                i.quantQuarto, i.quantSuite, i.quantVagaGaragem, i.quantBanheiro, i.precoImovel
                FROM imovel as i
                    inner join endereco as e
                        on e.idEndereco = i.idEndereco
                WHERE  i.idTipoImovel = :idTipoImovel and i.idTransacao = :idTransacao and e.idCidade = :idCidade and e.idBairro = :idBairro and
                    e.idEstado = :idEstado and i.quantQuarto = :quantQuarto and i.quantSuite = :quantSuite and 
                    i.quantVagaGaragem = :quantVagaGaragem and i.quantBanheiro = :quantBanheiro and 
                    (:precoMin < i.precoImovel and i.precoImovel < :precoMax)");

            #$compare->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
            $compare->bindParam(":idTipoImovel", $idTipoImovel, PDO::PARAM_INT);
            $compare->bindParam(":idTransacao", $idTransacao, PDO::PARAM_INT);

            $compare->bindParam(":idBairro", $idBairro, PDO::PARAM_INT);
            $compare->bindParam(":idCidade", $idCidade, PDO::PARAM_INT);
            $compare->bindParam(":idEstado", $idEstado, PDO::PARAM_INT);

            $compare->bindParam(":quantQuarto", $quantQuarto, PDO::PARAM_INT);
            $compare->bindParam(":quantSuite", $quantSuite, PDO::PARAM_INT);
            $compare->bindParam(":quantVagaGaragem", $quantVagaGaragem, PDO::PARAM_INT);
            $compare->bindParam(":quantBanheiro", $quantBanheiro, PDO::PARAM_INT);

            $compare->bindParam(":precoMin", $precoMin, PDO::PARAM_INT);
            $compare->bindParam(":precoMax", $precoMax, PDO::PARAM_INT);
            $compare->execute();
            return count($compare->fetchAll(PDO::FETCH_ASSOC));
        }
    }

?>