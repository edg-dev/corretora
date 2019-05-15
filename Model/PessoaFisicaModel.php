<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EnderecoModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/UsuarioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TelefoneModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ProfissaoModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaProfissaoModel.php";

class PessoaFisicaModel{

    private $bd;
    private $endereco;
    private $pessoa;
    private $usuario;
    private $telefone;
    private $profissao;
    private $pessoaProfissao;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
        $this->endereco = new EnderecoModel();
        $this->pessoa = new PessoaModel();
        $this->usuario = new UsuarioModel();
        $this->telefone = new TelefoneModel();
        $this->profissao = new ProfissaoModel();
        $this->pessoaProfissao = new PessoaProfissaoModel();
    }

    public function inserir($nome, $codSexo, $email, $senha, $telefone1, $telefone2, $rg, $cpf, $logradouro, $numero, $complemento, 
                            $cep, $nomeBairro, $nomeCidade, $idEstado, $idEstadoCivil, $descricaoProfissao){
        try{
            $idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
            $idPessoa = $this->pessoa->getIdPessoa($nome, $email);
            $idProfissao = $this->profissao->getProfissao($descricaoProfissao);
            
            if($idEndereco == null){
                $this->endereco->inserir($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
                $idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
            }
            
            if($idPessoa == null){
                $this->pessoa->inserir($nome, $idEndereco, $email);
            }
            $valPessoa = $this->pessoa->getIdPessoa($nome, $email);


            if($idProfissao == null){
                $this->profissao->inserir($descricaoProfissao);
                $idProfissao = $this->profissao->getProfissao($descricaoProfissao);
            }

            $this->pessoaProfissao->inserir($idPessoa, $idProfissao);

            $this->telefone->inserir($valPessoa, $telefone1, $telefone2);

            
            

            $insPF = $this->bd->prepare("INSERT INTO PessoaFisica(idPessoa, rg, cpf, codigoSexo, idestadoCivil) 
                                        VALUES (:idPessoa, :rg, :cpf, :codigoSexo, :estadoCivil)");
            $idPf = intval($valPessoa[0]);
            $insPF->bindParam(":idPessoa",      $idPf,  PDO::PARAM_INT);
            $insPF->bindParam(":rg",            $rg);
            $insPF->bindParam(":cpf",           $cpf,  PDO::PARAM_INT);
            $insPF->bindParam(":codigoSexo",    $codSexo);
            $insPF->bindParam(":estadoCivil",   $idEstadoCivil,  PDO::PARAM_INT);
            $insPF->execute();

            $this->usuario->inserir($idPf, $email, $senha);

        } catch(Exception $e){
            throw $e;
        }
    }
}


?>
