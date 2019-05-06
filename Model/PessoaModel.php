<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class PessoaModel{
    private $bd;

    public function inserir($nome, $idEndereco, $email){
        $insPessoa = $this->bd->prepare(
            "INSERT INTO Pessoa(nome, idEndereco, email) VALUES(:nome, :idEndereco, :email)"
        );
        $insPessoa->bindParam(":nome",          $nome);
        $insPessoa->bindParam(":idEndereco",    $idEndereco);
        $insPessoa->bindParam(":email",         $email);
        $insPessoa->execute();
    }

    public function getIdPessoa($nome, $email){       
        $selPessoa = $this->bd->query("SELECT idPessoa FROM Pessoa WHERE nome = :nome AND email =:email");
        $selPessoa->bindParam(":nome",          $nome);
        $selPessoa->bindParam(":idEndereco",    $idEndereco);
        $selPessoa->execute();
        $idPessoa = $selPessoa->fetch();
    }
}

?>