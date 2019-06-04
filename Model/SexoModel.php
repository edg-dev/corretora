<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

    class SexoModel {
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }
        public function getCodigoSexo($codigoSexo){
            try{
                $sexo = $this->bd->prepare("SELECT codigoSexo FROM Sexo WHERE codigoSexo = :codigoSexo");
                $sexo->bindParam(":codigoSexo", $codigoSexo);
                $sexo->execute();

                return $res = $sexo->fetch();
            } catch(Exception $e){
                throw $e;
            }
        }

        public function getAllSexo(){
            try{
                $resSexo = $this->bd->query("SELECT * FROM Sexo");
                $resSexo->execute();
                return $sexo = $resSexo->fetchAll();
            }catch(Exception $e){
                throw $e;
            }
        }
    }

?>
