<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";

	$ImovelModel = new ImovelModel();

	$acao = $_GET["acao"];

	if($acao == "create"){

		$descricaoTipoImovel = $_POST["tipoDeImovel"];

		$cep = $_POST["cep"];
		$idEstado = $_POST["estado"];
		$nomeCidade = $_POST["cidade"];
		$nomeBairro = $_POST["bairro"];
		$logradouro = $_POST["rua"];
		$numero =$_POST["numero"];
		$complemento = $_POST["complemento"];

		$quantQuarto = $_POST["quantQuarto"];
		$quantSuite = $_POST["quantSuite"];
		$quantVagaGaragem = $_POST["quantVagaGaragem"];
		$quantBanheiro = $_POST["quantBanheiro"];

		$transacao = $_POST["transacao"];

		$areaUtil = $_POST["areaUtil"];
		$areaTotal = $_POST["areaTotal"];
		$precoImovel = $_POST["precoImovel"];

		$descricaoImovel = $_POST["descricaoImovel"];

		if(!isset($_POST["complemento"])){
            $complemento = " ";
		}
		if(!isset($_POST["quantQuarto"])){
            $quantQuarto = "0";
		}
		if(!isset($_POST["quantSuite"])){
            $quantSuite = "0";
		}
		if(!isset($_POST["quantVagaGaragem"])){
            $quantVagaGaragem = "0";
		}
		if(!isset($_POST["quantBanheiro"])){
            $quantBanheiro = "0";
		}
		if(!isset($_POST["descricaoImovel"])){
            $descricaoImovel = " ";
		}


		$ImovelModel->inserir($descricaoTipoImovel, $cep, $idEstado, $nomeCidade, $nomeBairro, $logradouro, $numero,
							  $complemento, $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $transacao, $areaUtil, 
							  $areaTotal, $precoImovel, $descricaoImovel);

			echo "<script>alert('Imóvel cadastrado com sucesso'); location.href='/corretora/index.php';</script>";

	}

?>