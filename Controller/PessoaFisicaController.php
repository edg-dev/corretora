<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaFisicaModel.php";

    $pessoaFisicaModel = new PessoaFisicaModel();

    $acao = $_GET["acao"];

    if($acao == "create"){
        $nome = $_POST["nome"];
        $codSexo = $_POST["sexo"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $telefone1 = $_POST["telefone1"];
        $telefone2 = $_POST["telefone2"];
        $rg = $_POST["rg"];
        $cpf = $_POST["cpf"];
        $logradouro = $_POST["logradouro"];
        $numero = $_POST["numero"];
        $complemento = $_POST["complemento"];  
        $cep = $_POST["cep"];
        $nomeBairro = $_POST["bairro"];
        $nomeCidade = $_POST["cidade"];
        $idEstado = $_POST["estado"];
        $idEstadoCivil = $_POST["estadoCivil"];
        $descricaoProfissao = $_POST["profissao"];

        if(!isset($_POST["complemento"])){
            $complemento = " ";
        }
        
        $pessoaFisicaModel->inserir($nome, $codSexo, $email, $senha, $telefone1, $telefone2, $rg, $cpf, $logradouro, $numero, 
                                    $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado, $idEstadoCivil, $descricaoProfissao);

        echo "<script>alert('Pessoa cadastrada com sucesso'); location.href='/corretora/index.php';</script>"
    }

?>