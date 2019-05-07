<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EnderecoModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TipoImovelModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TransacaoModel.php";

	class ImovelModel{

		private $bd;
		private $endereco;
		private	$tipoImovel;
		private	$transacao;

		 function __construct(){
			 $this->bd = BancoDados::obterConexao();
			 $this->endereco = new EnderecoModel();
			 $this->tipoImovel = new TipoImovelModel();
			 $this->transacao = new TransacaoModel();
		 }

		 public function inserir($descricaoTipoImovel, $cep, $idEstado, $nomeCidade, $nomeBairro, $logradouro, $numero,
								 $complemento, $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $transacao, $areaUtil, 
								 $areaTotal, $precoImovel, $descricaoImovel){
			try {
				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro,
															 $nomeCidade, $idEstado);
				$idTipoImovel = $this->tipoImovel->getIdTipoImovel($descricaoTipoImovel);
				$idTrasacao = $this->transacao->getidTrasacao($transacao);

			if($idEndereco == null){
				$this->endereco->inserir($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, 
				$nomeCidade, $idEstado);
			}
		/*	if($idTipoImovel == null){
                $this->tipoImovel->inserir($descricaoTipoImovel);
			}
			if($idTrasacao == null){
                $this->transacao->inserir($transacao);
			}

			$valTipoImovel = $this->tipoImovel->getIdTipoImovel($descricaoTipoImovel);

			$valTransacao = $this->transacao->getidTrasacao($transacao);*/

		 	    $insImovel = $this->bd->prepare("INSERT INTO Imovel(areaUtil, areaTotal, precoImovel, descricaoImovel
				 											quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro) 
			    VALUES (:areaUtil, :areaTotal, :precoImovel, :descricaoImovel, :quantQuarto, :quantSuite, 
						:quantVagaGaragem, :quantBanheiro)");

			/*	$insTipImovel = intval($valTipoImovel[0]);
				$insTransa = intval($valTransacao[0]);

				$insImovel->bindParam(":idTipoImovel", $insTipImovel, PDO::PARAM_INT);
				$insImovel->bindParam(":idTransacao", $insTransa, PDO::PARAM_INT);*/

			    $insImovel->bindParam(":areaUtil", $areaUtil, PDO::PARAM_INT);
			    $insImovel->bindParam(":areaTotal", $areaTotal, PDO::PARAM_INT);
				$insImovel->bindParam(":precoImovel", $precoImovel, PDO::PARAM_INT);
				$insImovel->bindParam(":descricaoImovel", $descricaoImovel);
				$insImovel->bindParam(":quantQuarto", $quantQuarto, PDO::PARAM_INT);
				$insImovel->bindParam(":quantSuite", $quantSuite, PDO::PARAM_INT);
				$insImovel->bindParam(":quantVagaGaragem", $quantVagaGaragem, PDO::PARAM_INT);
				$insImovel->bindParam(":quantBanheiro", $quantBanheiro, PDO::PARAM_INT);

		 	    $insImovel->execute();
			  } catch(Exception $e){
				  throw $e;
			  }

		 }
	}
?>