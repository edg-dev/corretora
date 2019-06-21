<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EnderecoModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/UsuarioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TelefoneModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PerfisModel.php";

class PessoaJuridicaModel{

    private $bd;
    private $endereco;
    private $pessoa;
    private $usuario;
    private $telefone;
    private $perfis;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
        $this->endereco = new EnderecoModel();
        $this->pessoa = new PessoaModel();
        $this->usuario = new UsuarioModel();
        $this->telefone = new TelefoneModel();
        $this->perfis = new PerfisModel();
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


            $this->telefone->inserir($valPessoa, $telefone1, $telefone2);

            $insPJ = $this->bd->prepare("INSERT INTO pessoajuridica(idPessoa, razaoSocial, cnpj) 
                                        VALUES (:idPessoa, :razaoSocial, :cnpj)");
            $idPj = intval($valPessoa[0]);
            $insPJ->bindParam(":idPessoa", $idPj, PDO::PARAM_INT);
            $insPJ->bindParam(":razaoSocial", $razaoSocial);
            $insPJ->bindParam(":cnpj", $cnpj, PDO::PARAM_INT);
            $insPJ->execute();

            $this->usuario->inserir($idPj, $email, $senha);
            $this->perfis->insertPerfilDefault($idPj);
            
            } catch(Exception $e){
                throw $e;
            }
    }

    public function getPessoaJuridicaInfo(){
        $select = $this->bd->prepare("SELECT  
        p.nome, p.idpessoa, pj.razaoSocial, p.emailContato, pj.cnpj, per.descricaoperfil, up.cresci
        from pessoajuridica as pj
            inner join pessoa as  p
                on p.idpessoa = pj.idpessoa
            inner join usuario u
                on u.idusuario = p.idpessoa
            inner join usuarioperfil up
                on up.idusuario = u.idusuario
            inner join perfis per
                on per.idperfil = up.idperfil");
        $select->execute();
        return $select->fetchAll();
    }

    public function removerPessoaJuridica($idPessoa){
        $delete = $this->bd->prepare("DELETE FROM pessoajuridica where idPessoa = :idPessoa");
        $delete->bindParam(":idPessoa", $idPessoa);
        $delete->execute();
    }
}


?>
