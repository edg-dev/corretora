<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaJuridicaModel.php";

    $pessoaJuridicaModel = new PessoaJuridicaModel();

    $acao = $_GET["acao"];

    if($acao == "create"){
        $nome = $_POST["nome"];
        $razaoSocial = $_POST["razaoSocial"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $telefone1 = $_POST["telefone1"];
        $telefone2 = $_POST["telefone2"];
        $cnpj = $_POST["cnpj"];
        $logradouro = $_POST["logradouro"];
        $numero = $_POST["numero"];
        $complemento = $_POST["complemento"];  
        $cep = $_POST["cep"];
        $nomeBairro = $_POST["bairro"];
        $nomeCidade = $_POST["cidade"];
        $idEstado = $_POST["estado"];


        if(!isset($_POST["complemento"])){
            $complemento = " ";
        }
        
        $pessoaJuridicaModel->inserir($nome, $razaoSocial, $email, $senha, $telefone1, $telefone2,  $cnpj, 
        $logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);

        echo "<script>alert('Pessoa cadastrada com sucesso'); location.href='/corretora/index.php';</script>";
    }

?>