<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/AnuncioModel.php";

	$ImovelModel = new ImovelModel();
	$AnuncioModel = new AnuncioModel();

	$acao = $_GET['acao'];

	if($acao == "create"){

		$idTipoImovel = $_POST["tipoDeImovel"];

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

		$idTransacao = $_POST["transacao"];

		$areaUtil = $_POST["areaUtil"];
		$areaTotal = $_POST["areaTotal"];
		$precoImovel = $_POST["precoImovel"];

		$descricaoImovel = $_POST["descricaoImovel"];

		$idUsuario = $_SESSION['idUsuario'];

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

		$idteste = $ImovelModel->inserir($idTipoImovel, $cep, $idEstado, $nomeCidade, $nomeBairro, $logradouro, $numero,
							  $complemento, $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, 
							  $idTransacao, $areaUtil, 
							  $areaTotal, $precoImovel, $descricaoImovel);

		$AnuncioModel->inserir($idteste, $idUsuario);
							  
		$_SESSION['idteste'] = $idteste;
		echo "<script>alert('Imóvel cadastrado com sucesso'); location.href='/corretora/View/Cadastro/ImagensImovel.php';</script>";

	}

	if($acao == 'pedir'){
		$idUsuario = $_GET['idUsuario'];

		$idTipoImovel = $_POST["tipoDeImovel"];
		$idTransacao = $_POST["transacao"];

		$idEstado = $_POST["estado"];
		$nomeCidade = $_POST["cidade"];
		$nomeBairro = $_POST["bairro"];

		$quantQuarto = $_POST["quantQuarto"];
		$quantSuite = $_POST["quantSuite"];
		$quantVagaGaragem = $_POST["quantVagaGaragem"];
		$quantBanheiro = $_POST["quantBanheiro"];

		$precoMin = $_POST["precoMin"];
		$precoMax = $_POST["precoMax"];

		$ImovelModel->cadastraPedido($idUsuario, $idTipoImovel, $idTransacao, $nomeBairro, $nomeCidade, $idEstado, 
		$quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $precoMin, $precoMax);

		echo "<script>alert('Pedido cadastrado com sucesso'); location.href='/corretora/index.php';</script>";
	}

?>