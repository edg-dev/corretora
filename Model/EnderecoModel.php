<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class EnderecoModel{
    private $bd;

    $cep = new CepModel();
    $bairro = new BairroModel();
    $cidade = new CidadeModel();

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($logradouro, $numero, $complemento, $descricaoCep, $nomeBairro, $nomeCidade, $idEstado){

        $idCep = $cep->ListarIdPorDescricao($descricaoCep);
        $idBairro = $bairro->ListarIdPorBairro($nomeBairro);
        $idCidade = $cidade->ListarIdPorCidade($nomeCidade);

        if($idCep->num_rows() == 0){
            $cep->inserir($descricaoCep);
            $idCep = $cep->ListarIdPorDescricao($descricaoCep);
        }

        if($idBairro->num_rows() == 0){
            $bairro->inserir($nomeBairro);
            $idBairro = $bairro->ListarIdPorBairro($nomeBairro);
        }

        if($idCidade->num_rows() == 0){
            $cidade->inserir($nomeCidade);
            $idCep = $cep->ListarIdPorDescricao($descricaoCep);
        }

        $insercao = $this->bd->prepare(
            "INSERT INTO endereco(logradouro, numero, complemento, idCep, idBairro, idCidade, idEstado)
            VALUES (:logradouro, :numero, :complemento, :idCep, :idBairro, :idCidade, :idEstado)"
        );

        $insercao->bindParam(":logradouro",     $logradouro);
        $insercao->bindParam(":numero",         $numero);
        $insercao->bindParam(":complemento",    $complemento);
        $insercao->bindParam(":idCep",          $idCep);
        $insercao->bindParam(":idBairro",       $idBairro);
        $insercao->bindParam(":idCidade",       $idCidade);
        $insercao->bindParam(":idEstado",       $idEstado);
        $insercao->execute();
    }

    public function getIdEndereco($logradouro, $numero, $complemento, $descricaoCep, $nomeBairro, $nomeCidade, $idEstado){
        $idCep = $cep->ListarIdPorDescricao($descricaoCep);
        $idBairro = $bairro->ListarIdPorBairro($nomeBairro);
        $idCidade = $cidade->ListarIdPorCidade($nomeCidade);
        
        $getEndereco = $this->bd->query(
            "SELECT idEndereco FROM Endereco WHERE logradouro = :logradouro AND numero = :numero AND complemento = :complemento
            AND idCep = :idCep AND idCidade = :idCidade AND idEstado = :idEstado"
            );
        $getEndereco->bindParam(":logradouro",     $logradouro);
        $getEndereco->bindParam(":numero",         $numero);
        $getEndereco->bindParam(":complemento",    $complemento);
        $getEndereco->bindParam(":idCep",          $idCep);
        $getEndereco->bindParam(":idBairro",       $idBairro);
        $getEndereco->bindParam(":idCidade",       $idCidade);
        $getEndereco->bindParam(":idEstado",       $idEstado);
        $getEndereco->execute();

        return $idEndereco = $getEndereco->fetch();
    }
}

?>