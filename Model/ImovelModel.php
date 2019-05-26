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

		 public function inserir($idTipoImovel, $cep, $idEstado, $nomeCidade, $nomeBairro, $logradouro, $numero,
		 						 $complemento, $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, 
								 $idTransacao, $areaUtil, $areaTotal, $precoImovel, $descricaoImovel){
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
				return $teste = $this->bd->lastInsertId();
				
			  } catch(Exception $e){
				  throw $e;
			  }

		 }

		 public function getAllImovel(){
			try{
				$resImovel = $this->bd->query("select nomeBairro, nomeCidade, descricaoEstado, numero, logradouro,
				areaUtil, areaTotal, precoImovel, descricaoImovel, quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro,
				descricaoTipoImovel, descricaoTransacao from imovel 
				inner join transacao on imovel.idTransacao = transacao.idTransacao
				inner join tipoimovel on imovel.idTipoImovel = tipoimovel.idTipoImovel
				inner join endereco on imovel.idEndereco = endereco.idEndereco
				inner join bairro on endereco.idBairro = bairro.idBairro
				inner join cidade on endereco.idCidade = cidade.idCidade
				inner join estado on endereco.idEstado = estado.idEstado");
				$resImovel->execute();
				return $imoveis = $resImovel->fetchAll();
			} catch(Exception $e){
				throw $e;
			}
		}

		public function getIdImovel($idTipoImovel, $areaUtil, $areaTotal, $precoImovel, $idTransacao, $descricaoImovel,
									$quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro){

			$getID = $this->bd->prepare("SELECT idImovel FROM Imovel where 
			idTipoImovel = :idTipoImovel and areaUtil = :areaUtil and areaTotal = :areaTotal and precoImovel = :precoImovel
			and idTransacao = :idTransacao and descricaoImovel = :descricaoImovel and quantQuarto = :quantQuarto
			and quantSuite = :quantSuite and quantVagaGaragem = :quantVagaGaragem and quantBanheiro = :quantBanheiro");
							$getID->bindParam(":idTransacao", $idTransacao, PDO::PARAM_INT);
							$getID->bindParam(":idTipoImovel", $idTipoImovel, PDO::PARAM_INT);
			
							$getID->bindParam(":areaUtil", $areaUtil, PDO::PARAM_INT);
							$getID->bindParam(":areaTotal", $areaTotal, PDO::PARAM_INT);
							$getID->bindParam(":precoImovel", $precoImovel, PDO::PARAM_INT);
							$getID->bindParam(":descricaoImovel", $descricaoImovel);
							$getID->bindParam(":quantQuarto", $quantQuarto, PDO::PARAM_INT);
							$getID->bindParam(":quantSuite", $quantSuite, PDO::PARAM_INT);
							$getID->bindParam(":quantVagaGaragem", $quantVagaGaragem, PDO::PARAM_INT);
							$getID->bindParam(":quantBanheiro", $quantBanheiro, PDO::PARAM_INT);
			$getID->execute();
			return $idImovel = $getID->fetch();

		}
		public function deleteImovel($idImovel){
			$delete = $this->bd->prepare("DELETE FROM Imovel WHERE idImovel = :idImovel");
            $delete->bindParam(":idImovel", $idImovel);
            $delete->execute();
		}
	}
?>