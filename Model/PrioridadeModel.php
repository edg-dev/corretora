<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

    class PrioridadeModel{
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function getPrioridades(){
            $get = $this->bd->prepare("SELECT * FROM PrioridadeAnuncio");
            $get->execute();
            return $prioridades = $get->fetchAll();
        }
    }
?>
