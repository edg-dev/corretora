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

        public function selectAllPedidos(){
            $select = $this->bd->prepare("SELECT * FROM pedidos as p
                inner join usuario as u
                    on u.idUsuario = p.idUsuario
                inner join pessoa as pe
                    on pe.idPessoa = u.idUsuario
                inner join bairro as b
                    on b.idBairro = p.idBairro
                inner join cidade as c
                    on c.idCidade = p.idCidade
                inner join estado as e
                    on e.idEstado = p.idEstado
                inner join tipoimovel as ti
                    on ti.idTipoImovel = p.idTipoImovel
                inner join transacao as tr
                    on tr.idTransacao = p.idTransacao");
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
                WHERE  i.idTipoImovel = :idTipoImovel or i.idTransacao = :idTransacao or e.idCidade = :idCidade or e.idBairro = :idBairro or
                    e.idEstado = :idEstado or i.quantQuarto = :quantQuarto or i.quantSuite = :quantSuite or 
                    i.quantVagaGaragem = :quantVagaGaragem or i.quantBanheiro = :quantBanheiro or 
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

        public function matches($idTipoImovel, $idTransacao, $idCidade, $idBairro, $idEstado,
            $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $precoMin, $precoMax)
        {
            $compare = $this->bd->prepare("SELECT *
                FROM imovel as i
                    inner join tipoimovel as ti
                        on ti.idTipoImovel = i.idTipoImovel
                    inner join endereco as e
                        on e.idEndereco = i.idEndereco
                    inner join bairro as b
                        on b.idBairro = e.idBairro
                    inner join cidade as c
                        on c.idCidade = e.idCidade
                    inner join estado as es
                        on es.idEstado = e.idEstado
                    inner join anuncio as a
                        on a.idImovel = i.idImovel
                    inner join usuario as u
                        on u.idUsuario = a.idUsuario
                    inner join pessoa as p
                        on p.idPessoa = u.idUsuario
                    inner join transacao as tr
                        on tr.idTransacao = i.idTransacao
                WHERE  (i.idTipoImovel = :idTipoImovel or i.idTransacao = :idTransacao or e.idCidade = :idCidade or e.idBairro = :idBairro or
                    e.idEstado = :idEstado or i.quantQuarto = :quantQuarto or i.quantSuite = :quantSuite or 
                    i.quantVagaGaragem = :quantVagaGaragem or i.quantBanheiro = :quantBanheiro) and 
                    (:precoMin < i.precoImovel and i.precoImovel < :precoMax)");

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
            return $compare->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>