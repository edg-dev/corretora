<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/Rotina.php";

    class execRotina {
        private $rotina;

        function __construct(){
            $this->rotina = new Rotina();
        }

        public function execRotina($idUsuario){
            $select = $this->rotina->selectPedidos($idUsuario);

            foreach($select as $res){
                $idTipoImovel = $res['idTipoImovel'];
                $idTransacao = $res['idTransacao'];
                $idCidade = $res['idCidade'];
                $idBairro = $res['idBairro'];
                $idEstado = $res['idEstado'];
                $quantQuarto = $res['quantQuarto'];
                $quantSuite = $res['quantSuite'];
                $quantVagaGaragem = $res['quantVagaGaragem'];
                $quantBanheiro = $res['quantBanheiro'];
                $precoMin = $res['precoMin'];
                $precoMax = $res['precoMax'];

                $result = $this->rotina->comparePedidos($idTipoImovel, $idTransacao, $idCidade, $idBairro, $idEstado,
                $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $precoMin, $precoMax);

                if($result > 0){
                   echo '<script>alert("Um anúncio foi cadastrado com as informações de um de seus pedidos! Confira em seu perfil.");</script>';
                }
            }
        }

        public function execMatches($res){

                $idTipoImovel = $res['idTipoImovel'];
                $idTransacao = $res['idTransacao'];
                $idCidade = $res['idCidade'];
                $idBairro = $res['idBairro'];
                $idEstado = $res['idEstado'];
                $quantQuarto = $res['quantQuarto'];
                $quantSuite = $res['quantSuite'];
                $quantVagaGaragem = $res['quantVagaGaragem'];
                $quantBanheiro = $res['quantBanheiro'];
                $precoMin = $res['precoMin'];
                $precoMax = $res['precoMax'];

                return $result = $this->rotina->matches($idTipoImovel, $idTransacao, $idCidade, $idBairro, $idEstado,
                $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $precoMin, $precoMax);
        
        }
    }
?>
