<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class PessoaFisicaModel{
    private $bd;

    $endereco = new EnderecoModel();
    $pessoa = new PessoaModel();

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($nome, $codSexo, $email, $senha, $telefone1, $telefone2, $rg, $cpf, $logradouro,
                            $numero, $descricaoCep, $nomeBairro, $nomeCidade, $idEstado, $idEstadoCivil, $descricaoProfissao){
        
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

        $insPF = $this->bd->prepare("INSERT INTO PessoaFisica(idPessoa, rg, cpf, codigoSexo, estadoCivil) 
                                    VALUES (:idPessoa, :rg, :cpf, :codigoSexo, :estadoCivil)");
        $insPF->bindParam(":idPessoa",      $idPessoa);
        $insPF->bindParam(":rg",            $rg);
        $insPF->bindParam(":cpf",           $cpf);
        $insPF->bindParam(":codigoSexo",    $codigoSexo);
        $insPF->bindParam(":estadoCivil",   $idEstadoCivil);
        $insPF->execute();
    }
}


?>
