<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EnderecoModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TipoImovelModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TransacaoModel.php";

	class UsuarioModel{

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

		 public function inserir($DescricaoTipoImovel, $cep, $idEstado, $nomeCidade, $nomeBairro, $logradouro, $numero,
								 $complemento, $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $transacao, $areaUtil, 
								 $areaTotal, $precoImovel, $descricaoImovel){
			try {
				
				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro,
															 $nomeCidade, $idEstado);
				$idTipoImovel = $this->tipoImovel->getIdTipoImovel($DescricaoTipoImovel);
				$idTrasacao = $this->transacao->getidTrasacao($transacao);

			if($idEndereco == null){
				$this->endereco->inserir($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, 
				$nomeCidade, $idEstado);
			}
			if($idTipoImovel == null){
                $this->pessoa->inserir($DescricaoTipoImovel);
			}
			if($idTrasacao == null){
                $this->pessoa->inserir($transacao);
			}

			$valTipoImovel = $this->pessoa->getIdTipoImovel($DescricaoTipoImovel);

			$valTransacao = $this->pessoa->getidTrasacao($transacao);

		 	    $insImovel = $this->bd->prepare("INSERT INTO Imovel(areaUtil, areaTotal, precoImovel, descricaoImovel
				 											quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro) 
			    VALUES (:areaUtil, :areaTotal, :precoImovel, :descricaoImovel, :quantQuarto, :quantSuite, 
						:quantVagaGaragem, :quantBanheiro)");

				$insImovel = intval($valTipoImovel[0]);
				$insImovel = intval($valTransacao[0]);

			    $insImovel->bindParam(":areaUtil", $areaUtil);
			    $insImovel->bindParam(":areaTotal", $areaTotal);
				$insImovel->bindParam(":precoImovel", $precoImovel);
				$insImovel->bindParam(":descricaoImovel", $descricaoImovel);
				$insImovel->bindParam(":quantQuarto", $quantQuarto);
				$insImovel->bindParam(":quantSuite", $quantSuite);
				$insImovel->bindParam(":quantVagaGaragem", $quantVagaGaragem);
				$insImovel->bindParam(":quantBanheiro", $quantBanheiro);

		 	    $insImovel->execute();

			  } catch(Exception $e){
				  throw $e;
			  }

		 }
	}
?>