<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

class PessoaModel{
    private $bd;

    function __construct(){
        $this->bd = BancoDados::obterConexao();
    }

    public function inserir($nome, $idEndereco, $email){
        try{
            $idend = intval($idEndereco[0]);
            $insPessoa = $this->bd->prepare("INSERT INTO pessoa(nome, idEndereco, emailContato) VALUES(:nome, :idEndereco, :email)");
            $insPessoa->bindParam(":nome",          $nome);
            $insPessoa->bindParam(":idEndereco",    $idend, PDO::PARAM_INT);
            $insPessoa->bindParam(":email",         $email);
            $insPessoa->execute();
        } catch(Exception $e){
            throw $e;
        }
    }

    public function getIdPessoa($nome, $email){       
        try{
            $selPessoa = $this->bd->prepare("SELECT idPessoa FROM pessoa WHERE nome LIKE ? AND emailContato LIKE ?");
            $params = array("%$nome%", "%$email%");
            $selPessoa->execute($params);

            return $idPessoa = $selPessoa->fetch();
        } catch(Exception $e){
            throw $e;
        }
    }
}

?>