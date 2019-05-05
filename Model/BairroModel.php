<?php

class BairroModel{
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($nomeBairro){
        try{
            $insBairro = $this->bd->prepare("INSERT INTO bairro(nomeBairro) VALUES(:nomeBairro)");
            $insBairro->bindParam(":nomeBairro", $nomeBairro);
            $insBairro->execute();
        } catch (Exception $e){
            throw $e;
        }

    } 

    public function listarIdPorBairro($nomeBairro){
        try{
            $resBairro = $this->bd->prepare("SELECT idBairro FROM Bairro WHERE nomeBairro = :nomeBairro");
            $resBairro->bindParam(":nomeBairro", $nomeBairro);
            $resBairro->execute();
            return $idBairro = $resBairro->fetch();
        } catch(Exception $e){
            throw $e;
        }
    }
}

?>
