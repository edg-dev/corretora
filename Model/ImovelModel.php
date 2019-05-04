<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";

	class UsuarioModel{

		private $bd;

		 function __construct(){
		 	$this->bd = BancoDados::obterConexao();
		 }

		 public function inserir($transacao, $tipoDeImovel, $cep, 
		 						 $uf, $cidade, $bairro, $rua, $complemento, $quarto, $suite, $vagaGaragem, $banheiro, 
		 						 $areaUtil, $areaTotal, $descricao, $precoImovel){

		 	$insercao = $this->bd->prepare("INSERT INTO Imovel(transacao, tipoDeImovel, cep, uf, cidade, bairro,
			 rua, complemento, quarto, suite, vagaGaragem, banheiro,areaUtil, areaTotal, descricao, precoImovel)

			 VALUES (:transacao, :tipoDeImovel, :cep, :uf, :cidade, :bairro, :rua, :complemento, :quarto, :suite, 
			 :vagaGaragem, :banheiro, :areaUtil, :areaTotal, :descricao, :precoImovel)");

		 	$insercao->bindParam(":areaUtil", $areaUtil);
			 $insercao->bindParam(":areaTotal", $areaTotal);
			 $insercao->bindParam(":precoImovel", $precoImovel);
		 	$insercao->execute();

		 }
	}
?>