<?php

class BairroModel{
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($nomeBairro){
        $insBairro = $this->bd->prepare("INSERT INTO bairro(nomeBairro) VALUES(:nomeBairro)");
        $insBairro->bindParam(":nomeBairro", $nomeBairro);
        $insBairro->execute();
    } 

    public function listarIdPorBairro($nomeBairro){
        $resBairro = $this->bd->query("SELECT idBairro FROM Bairro WHERE nomeBairro = :nomeBairro");
        $resBairro->bindParam(":nomeBairro", $nomeBairro);
        $resBairro->execute();
        return $idBairro = $resBairro->fetch();
    }
}

?>
