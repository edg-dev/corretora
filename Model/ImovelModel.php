<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EnderecoModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TipoImovelModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TransacaoModel.php";

	class ImovelModel{

		private $bd;
		private $endereco;

		 function __construct(){
			 $this->bd = BancoDados::obterConexao();
			 $this->endereco = new EnderecoModel();
		 }

		 public function inserir($idTipoImovel, $idTransacao, $cep, $idEstado, $nomeCidade, $nomeBairro, $logradouro, $numero,
								 $complemento, $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $areaUtil, 
								 $areaTotal, $precoImovel, $descricaoImovel){
			try {
				
				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro,
															 $nomeCidade, $idEstado);

			if($idEndereco == null){
				$this->endereco->inserir($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, 
				$nomeCidade, $idEstado);
			}

		 	    $insImovel = $this->bd->prepare("INSERT INTO Imovel(idEndereco, idTransacao, idTipoImovel, areaUtil, areaTotal, 
				 		precoImovel, descricaoImovel, quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro) 
			    VALUES (:idEndereco, :idTransacao, :idTipoImovel, :areaUtil, :areaTotal, :precoImovel, :descricaoImovel, 
						:quantQuarto, :quantSuite, :quantVagaGaragem, :quantBanheiro)");

				$insImovel->bindParam(":idEndereco", $idEndereco, PDO::PARAM_INT);
				$insImovel->bindParam(":idTransacao", $idTransacao, PDO::PARAM_INT);
				$insImovel->bindParam(":idTipoImovel", $idTipoImovel, PDO::PARAM_INT);

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