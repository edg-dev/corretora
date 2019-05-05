<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/CepModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/BairroModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/CidadeModel.php";

class EnderecoModel{
    private $bd;

    private $cep;
    private $bairro; 
    private $cidade;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
        $this->cep = new CepModel();
        $this->bairro = new BairroModel();
        $this->cidade = new CidadeModel();
    }

    public function inserir($logradouro, $numero, $complemento, $descricaoCep, $nomeBairro, $nomeCidade, $idEstado){
        try{
            $verCep = $this->cep->ListarIdPorDescricao($descricaoCep);
            $verBairro = $this->bairro->ListarIdPorBairro($nomeBairro);
            $idCidade = $this->cidade->ListarIdPorCidade($nomeCidade);

            if($verCep == false){
                $this->cep->inserir($descricaoCep);              
            }
            
            $idCep = $this->cep->ListarIdPorDescricao($descricaoCep);

            if($verBairro[0] == 0){
                $this->bairro->inserir($nomeBairro);
                $idBairro = $this->bairro->ListarIdPorBairro($nomeBairro);
            }

            if($idCidade == 0){
                $this->cidade->inserir($nomeCidade);
                $idCidade = $this->cidade->ListarIdPorCidade($nomeCidade);
            }

            $insercao = $this->bd->prepare(
                "INSERT INTO endereco(logradouro, numero, complemento, idCep, idBairro, idCidade, idEstado)
                VALUES (:logradouro, :numero, :complemento, :idCep, :idBairro, :idCidade, :idEstado)"
            );

            $insercao->bindParam(":logradouro",     $logradouro);
            $insercao->bindParam(":numero",         $numero);
            $insercao->bindParam(":complemento",    $complemento);
            $insercao->bindParam(":idCep",          $idCep, PDO::PARAM_INT);
            $insercao->bindParam(":idBairro",       $idBairro, PDO::PARAM_INT);
            $insercao->bindParam(":idCidade",       $idCidade, PDO::PARAM_INT);
            $insercao->bindParam(":idEstado",       $idEstado);
            $insercao->execute();
            
        } catch(Exception $e){
            throw $e;
        }

    }

    public function getIdEndereco($logradouro, $numero, $complemento, $descricaoCep, $nomeBairro, $nomeCidade, $idEstado){

        try{
            $idCep = $this->cep->ListarIdPorDescricao($descricaoCep);
            $idBairro = $this->bairro->ListarIdPorBairro($nomeBairro);
            $idCidade = $this->cidade->ListarIdPorCidade($nomeCidade);
            
             
            $getEndereco = $this->bd->prepare("SELECT idEndereco FROM endereco WHERE logradouro = :logradouro 
            AND numero = :numero AND complemento = :complemento AND idCep = :idCep 
            AND idBairro = :idBairro AND idCidade = :idCidade AND idEstado = :idEstado");

            $getEndereco->bindParam(":logradouro",     $logradouro);
            $getEndereco->bindParam(":numero",         $numero);
            $getEndereco->bindParam(":complemento",    $complemento);
            $getEndereco->bindParam(":idCep",          $idCep, PDO::PARAM_INT);
            $getEndereco->bindParam(":idBairro",       $idBairro, PDO::PARAM_INT);
            $getEndereco->bindParam(":idCidade",       $idCidade, PDO::PARAM_INT);
            $getEndereco->bindParam(":idEstado",       $idEstado);
            $getEndereco->execute();

            return $idEndereco = $getEndereco->fetch();

        } catch(Exception $e){
            throw $e;
        } 
    }
}

?>