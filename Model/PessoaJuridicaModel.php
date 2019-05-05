<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class PessoaJuridicaModel{
    private $bd;

    $endereco = new EnderecoModel();
    $pessoa = new PessoaModel();

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($nome, $email, $senha, $telefone1, $telefone2, $razaoSocial, $cnpj, $logradouro,
                            $numero, $descricaoCep, $nomeBairro, $nomeCidade, $idEstado, $creci){
        
        $idEndereco = $endereco->getIdEndereco($logradouro, $numero, $complemento, $descricaoCep, $nomeBairro, $nomeCidade, $idEstado);
        $idPessoa = $pessoa->getIdPessoa($nome, $email);

        if($idEndereco->num_rows() == 0){
            $endereco->inserir($logradouro, $numero, $complemento, $descricaoCep, $nomeBairro, $nomeCidade, $idEstado);
            $idEndereco = $endereco->getIdEndereco($logradouro, $numero, $complemento, $descricaoCep, $nomeBairro, $nomeCidade, $idEstado);
        }
        
        if($idPessoa->num_rows() == 0){
            $pessoa->inserir($nome, $idEndereco, $email);
            $idPessoa = $pessoa->getIdPessoa($nome, $email);
        }

        $insPJ = $this->bd->prepare("INSERT INTO PessoaJuridica(idPessoa, razaoSocial, cnpj) 
                                    VALUES (:idPessoa, :razaoSocial, :cnpj)");
        $insPF->bindParam(":idPessoa",      $idPessoa);
        $insPF->bindParam(":razaoSocial", $razaoSocial);
        $insPF->bindParam(":cnpj",           $cnpj);
        $insPF->execute();
    }
}


?>
