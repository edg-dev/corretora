<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EnderecoModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/UsuarioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TelefoneModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ProfissaoModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaProfissaoModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PerfisModel.php";

class PessoaFisicaModel {

    private $bd;
    private $endereco;
    private $pessoa;
    private $usuario;
    private $telefone;
    private $profissao;
    private $pessoaProfissao;
    private $perfis;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
        $this->endereco = new EnderecoModel();
        $this->pessoa = new PessoaModel();
        $this->usuario = new UsuarioModel();
        $this->telefone = new TelefoneModel();
        $this->profissao = new ProfissaoModel();
        $this->pessoaProfissao = new PessoaProfissaoModel();
        $this->perfis = new PerfisModel();
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

            $this->pessoaProfissao->inserir($valPessoa, $idProfissao);
            $this->usuario->inserir($idPf, $email, $senha);
            $this->perfis->insertPerfilDefault($idPf);


        } catch(Exception $e){
            throw $e;
        }
    }

    public function getUsuarioInfo(){
        $select = $this->bd->prepare("SELECT  
        p.idPessoa, p.nome, p.emailContato, ec.descricaoEstadoCivil, pf.rg, pf.cpf, pr.descricaoProfissao, per.descricaoPerfil, up.cresci
        from pessoafisica pf
            inner join pessoa p
                on p.idpessoa = pf.idpessoa
            inner join estadocivil ec
                on ec.idestadocivil = pf.idestadocivil
            inner join pessoaprofissao as pp
                on pp.idpessoa = p.idpessoa
            inner join profissao as pr
                on pr.idprofissao = pp.idprofissao
            inner join usuario u
                on u.idusuario = p.idpessoa
            inner join usuarioperfil up
                on up.idusuario = u.idusuario
            inner join perfis per 
                on per.idperfil = up.idperfil");
        $select->execute();
        return $select->fetchAll();
    }
}


?>
