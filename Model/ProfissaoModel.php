<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

    class ProfissaoModel {
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function inserir($descricaoProfissao){
            try{
                $insProf = $this->bd->prepare("INSERT INTO profissao(descricaoProfissao) VALUES (:descricaoProfissao)");
                $insProf->bindParam(":descricaoProfissao", $descricaoProfissao);
                $insProf->execute();
            } catch (Exception $e){
                throw $e;
            }

        }

        public function getProfissao($descricaoProfissao){
            try{
                $getProf = $this->bd->prepare("SELECT idProfissao FROM profissao WHERE descricaoProfissao = :descricaoProfissao");
                $getProf->bindParam(":descricaoProfissao", $descricaoProfissao);
                $getProf->execute();
                return $getProf->fetch();
            } catch (Exception $e){
                throw $e;
            }
        }
    }

?>
