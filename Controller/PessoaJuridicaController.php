<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaJuridicaModel.php";

    $pessoaJuridicaModel = new PessoaJuridicaModel();

    $acao = $_GET["acao"];

    if($acao == "create"){
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $telefone1 = $_POST["telefone1"];
        $telefone2 = $_POST["telefone2"];
        $razaoSocial = $_POST["razaoSocial"];
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
        
        $pessoaJuridicaModel->inserir($nome, $email, $senha, $telefone1, $telefone2, $razaoSocial, $cnpj, $logradouro, $numero, 
                                    $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);

        echo "<div class='card-panel teal lighten-2'>Usuário cadastrado com sucesso</div>";
    }

?>