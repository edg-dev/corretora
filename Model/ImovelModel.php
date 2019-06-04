<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EnderecoModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TipoImovelModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TransacaoModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/BairroModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/CidadeModel.php";

	class ImovelModel{

		private $bd;
		private $endereco;
		private $bairro;
		private $cidade;

		 function __construct(){
			 $this->bd = BancoDados::obterConexao();
			 $this->endereco = new EnderecoModel();
			 $this->bairro = new BairroModel();
			 $this->cidade = new CidadeModel();
		 }

		 public function inserir($idTipoImovel, $cep, $idEstado, $nomeCidade, $nomeBairro, $logradouro, $numero,
		 						 $complemento, $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, 
								 $idTransacao, $areaUtil, $areaTotal, $precoImovel, $descricaoImovel){
			try {
				
				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro,
															 $nomeCidade, $idEstado);

			if($idEndereco == null){
				$this->endereco->inserir($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
			}

			$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, 
			$nomeCidade, $idEstado);

		 	    $insImovel = $this->bd->prepare("INSERT INTO Imovel(idEndereco, idTransacao, idTipoImovel, areaUtil, areaTotal, 
				 		precoImovel, descricaoImovel, quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro) 
			    VALUES (:idEndereco, :idTransacao, :idTipoImovel, :areaUtil, :areaTotal, :precoImovel, :descricaoImovel, 
						:quantQuarto, :quantSuite, :quantVagaGaragem, :quantBanheiro)");

				$insImovel->bindParam(":idEndereco", intval($idEndereco[0]), PDO::PARAM_INT);
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
				$resImovel = $this->bd->query("SELECT imovel.idImovel, nomeBairro, nomeCidade, descricaoEstado, numero, logradouro,
				areaUtil, areaTotal, precoImovel, descricaoImovel, quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro,
				descricaoTipoImovel, descricaoTransacao from imovel 
				inner join transacao on imovel.idTransacao = transacao.idTransacao
				inner join tipoimovel on imovel.idTipoImovel = tipoimovel.idTipoImovel
				inner join endereco on imovel.idEndereco = endereco.idEndereco
				inner join bairro on endereco.idBairro = bairro.idBairro
				inner join cidade on endereco.idCidade = cidade.idCidade
				inner join estado on endereco.idEstado = estado.idEstado
				inner join anuncio on imovel.idImovel = anuncio.idImovel
				where anuncio.verificado = 1 ORDER BY anuncio.idprioridade ASC");
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

		public function getBuscaImovel($idTransacao, $idTipoImovel, $idEstado, $nomeCidade, 
		$nomeBairro, $logradouro){
			try{

				echo "<script>console.log('teste: " . $idTipoImovel . "');</script>";
				echo "<script>console.log('trasa: " . $idTransacao . "');</script>";
				echo "<script>console.log('estado: " . $idEstado . "');</script>";

				$buscaImovel = $this->bd->prepare("SELECT i.idImovel, b.nomeBairro, c.nomeCidade, es.descricaoEstado, en.numero, en.logradouro,
				i.areautil, i.areaTotal, i.precoImovel, i.descricaoImovel, i.quantQuarto, i.quantSuite, i.quantVagaGaragem, 
				i.quantBanheiro, ti.descricaoTipoImovel, tr.descricaoTransacao from imovel as i
				inner join transacao as tr on i.idTransacao = tr.idTransacao
				inner join tipoimovel as ti on i.idTipoImovel = ti.idTipoImovel
				inner join anuncio as a on i.idImovel = a.idImovel
				inner join endereco as en on i.idEndereco = en.idEndereco
				inner join bairro as b on en.idBairro = b.idBairro
				inner join cidade as c on en.idCidade = c.idCidade
				inner join estado as es on en.idEstado = es.idEstado
				where
				(a.verificado = '1' ) and
				(en.logradouro like ':logradouro' or
				b.nomeBairro like ':nomeBairro' or
				c.nomeCidade like ':nomeCidade' or
				es.idEstado like ':idEstado' or
				tr.idTransacao like ':idTransacao' or
				ti.idTipoImovel like ':idTipoImovel')");

					$buscaImovel->bindValue(':idTransacao', $idTransacao );
					$buscaImovel->bindValue(':idTipoImovel', $idTipoImovel );

					$buscaImovel->bindValue(':idEstado', $idEstado );
					$buscaImovel->bindValue(':nomeCidade', '%' . $nomeCidade . '%');
					$buscaImovel->bindValue(':nomeBairro', '%' . $nomeBairro . '%');
					$buscaImovel->bindValue(':logradouro', '%' . $logradouro . '%');

				$buscaImovel->execute();

				return $buscasImovel = $buscaImovel->fetchAll();

			} catch(Exception $e){
				throw $e;
			}
		}

		public function deleteImovel($idImovel){
			$delete = $this->bd->prepare("DELETE FROM Imovel WHERE idImovel = :idImovel");
            $delete->bindParam(":idImovel", $idImovel);
            $delete->execute();
		}

		public function getImovelById($idImovel){
			$select = $this->bd->prepare("SELECT
			ti.descricaoTipoImovel, i.precoImovel, i.quantBanheiro, i.quantQuarto, i.quantSuite, i.quantVagaGaragem, i.areaTotal, i.areaUtil,
			a.idAnuncio, i.idimovel, u.usuario, t.descricaoTransacao, p.nome, est.descricaoEstado, est.siglaEstado, p.idpessoa,
			e.logradouro, e.numero, cep.descricaoCep, b.nomeBairro, c.nomecidade, i.descricaoImovel
		from anuncio as a
			inner join imovel as i
				on i.idimovel = a.idImovel 
			inner join endereco as e
				on i.idEndereco = e.idEndereco
			inner join cidade as c
				on e.idCidade = c.idCidade
			inner join estado as est
				on est.idestado = e.idestado
			inner join bairro as b
				on e.idBairro = b.idBairro
			inner join usuario as u
				on u.idusuario = a.idusuario
			inner join pessoa  as p
				on p.idpessoa = u.idusuario
			inner join transacao as t
				on t.idtransacao = i.idtransacao
			inner join cep
				on cep.idcep = e.idcep
			inner join tipoImovel ti
				on ti.idtipoimovel = i.idtipoimovel
			where i.idImovel = :idImovel");
			$select->bindParam(":idImovel", $idImovel);
			$select->execute();
			return $select->fetch(PDO::FETCH_ASSOC);
		}

		public function cadastraPedido($idUsuario, $idTipoImovel, $idTransacao, $nomeBairro, $nomeCidade, $idEstado, 
			$quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $precoMin, $precoMax){
				try {
					$verBairro = $this->bairro->ListarIdPorBairro($nomeBairro);
					$idCidade = $this->cidade->ListarIdPorCidade($nomeCidade);
	
					if($verBairro[0] == null){
						$this->bairro->inserir($nomeBairro); 
					}
					$idBairro = $this->bairro->ListarIdPorBairro($nomeBairro);
		 
					if($idCidade == 0){
						$this->cidade->inserir($nomeCidade);
					}
					$idCidade = $this->cidade->ListarIdPorCidade($nomeCidade);
	
					$insert = $this->bd->prepare("INSERT INTO Pedidos 
						(idUsuario, idTipoImovel, idTransacao, idBairro, idCidade, idEstado, 
						quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro, precoMin, precoMax)
						VALUES (:idUsuario, :idTipoImovel, :idTransacao, :idBairro, :idCidade, :idEstado, 
						:quantQuarto, :quantSuite, :quantVagaGaragem, :quantBanheiro, :precoMin, :precoMax)");
	
					$insert->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
					$insert->bindParam(":idTipoImovel", $idTipoImovel, PDO::PARAM_INT);
					$insert->bindParam(":idTransacao", $idTransacao, PDO::PARAM_INT);
	
					$insert->bindParam(":idBairro", intval($idBairro[0]), PDO::PARAM_INT);
					$insert->bindParam(":idCidade", intval($idCidade[0]), PDO::PARAM_INT);
					$insert->bindParam(":idEstado", $idEstado, PDO::PARAM_INT);
	
					$insert->bindParam(":quantQuarto", $quantQuarto, PDO::PARAM_INT);
					$insert->bindParam(":quantSuite", $quantSuite, PDO::PARAM_INT);
					$insert->bindParam(":quantVagaGaragem", $quantVagaGaragem, PDO::PARAM_INT);
					$insert->bindParam(":quantBanheiro", $quantBanheiro, PDO::PARAM_INT);

					$insert->bindParam(":precoMin", $precoMin, PDO::PARAM_INT);
					$insert->bindParam(":precoMax", $precoMax, PDO::PARAM_INT);
					$insert->execute();

				} catch(Exception $e){
					throw $e;
				}	
		}
	}
?>