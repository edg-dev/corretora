<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

    class PessoaProfissaoModel {
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function inserir($idPessoa, $idProfissao){
            $insProf = $this->bd->prepare("INSERT INTO PessoaProfissao(idPessoa, idProfissao) 
                                            VALUES (:idPessoa, :idProfissao)");
            $idPes = intval($idPessoa[0]);
            $idProf = intval($idPessoa[0]);
            $insProf->bindParam(":idPessoa", $idPes, PDO::PARAM_INT);
            $insProf->bindParam(":idProfissao", $idProf, PDO::PARAM_INT);
            $insProf->execute();
        }
    }

?>
