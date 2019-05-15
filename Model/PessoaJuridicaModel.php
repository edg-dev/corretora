<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EnderecoModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/UsuarioModel.php";

class PessoaJuridicaModel{

    private $bd;
    private $endereco;
    private $pessoa;
    private $usuario;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
        $this->endereco = new EnderecoModel();
        $this->pessoa = new PessoaModel();
        $this->usuario = new UsuarioModel();
    }

    public function inserir($nome, $razaoSocial, $email, $senha, $telefone1, $telefone2,  $cnpj, 
                            $logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado){
        
        try{
            $idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
            $idPessoa = $this->pessoa->getIdPessoa($nome, $email);
            
            if($idEndereco == null){
                $this->endereco->inserir($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
                $idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
            }
            
            if($idPessoa == null){
                $this->pessoa->inserir($nome, $idEndereco, $email);
            }
            $valPessoa = $this->pessoa->getIdPessoa($nome, $email);

            $insPJ = $this->bd->prepare("INSERT INTO PessoaJuridica(idPessoa, razaoSocial, cnpj) 
                                        VALUES (:idPessoa, :razaoSocial, :cnpj)");
            $idPj = intval($valPessoa[0]);
            $insPJ->bindParam(":idPessoa", $idPj, PDO::PARAM_INT);
            $insPJ->bindParam(":razaoSocial", $razaoSocial);
            $insPJ->bindParam(":cnpj", $cnpj, PDO::PARAM_INT);
            $insPJ->execute();

            $this->usuario->inserir($idPj, $email, $senha);

            } catch(Exception $e){
                throw $e;
            }
    }
}


?>
