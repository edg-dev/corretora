<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";


	$ImovelModel = new ImovelModel();

	$acao = $_GET["acao"];


	if($acao == "create"){

		$transacao = $_POST["transacao"];
		$tipoDeImovel = $_POST["tipoDeImovel"];
		$cep = $_POST["cep"];
		$uf = $_POST["uf"];
		$cidade = $_POST["cidade"];
		$bairro = $_POST["bairro"];
		$rua = $_POST["rua"];
		$complemento = $_POST["complemento"];
		$quarto = $_POST["quarto"];
		$suite = $_POST["suite"];
		$vagaGaragem = $_POST["vagaGaragem"];
		$banheiro = $_POST["banheiro"];
		$areaUtil = $_POST["areaUtil"];
		$areaTotal = $_POST["areaTotal"];
		$descricao = $_POST["descricao"];
		$precoImovel = $_POST["precoImovel"];

		$ImovelModel->inserir($transacao, $tipoDeImovel, $cep, 
							$uf, $cidade, $bairro, $rua, $complemento, $quarto, $suite, $vagaGaragem, $banheiro, 
							$areaUtil, $areaTotal, $descricao, $precoImovel);

		echo "<script>alert('Imóvel cadastrado com sucesso'); location.href='/corretora/index.php';</script>";

	}
	if($acao == "update"){ //não está sendo ultilizado

		$transacao = $_POST["transacao"];
		$tipoDeImovel = $_POST["tipoDeImovel"];
		$cep = $_POST["cep"];
		$uf = $_POST["uf"];
		$cidade = $_POST["cidade"];
		$bairro = $_POST["bairro"];
		$rua = $_POST["rua"];
		$complemento = $_POST["complemento"];
		$quarto = $_POST["quarto"];
		$suite = $_POST["suite"];
		$vagaGaragem = $_POST["vagaGaragem"];
		$banheiro = $_POST["banheiro"];
		$areaUtil = $_POST["areaUtil"];
		$areaTotal = $_POST["areaTotal"];
		$descricao = $_POST["descricao"];
		$precoImovel = $_POST["precoImovel"];

		$ImovelModel->inserir($transacao, $tipoDeImovel, $cep, 
							$uf, $cidade, $bairro, $rua, $complemento, $quarto, $suite, $vagaGaragem, $banheiro, 
							$areaUtil, $areaTotal, $descricao, $precoImovel);

		echo "<script>alert('Imóvel atualizado com sucesso'); location.href='/corretora/index.php';</script>";
	}

?>