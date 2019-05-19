<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";

    class uploadBanco {
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        function getImagens(){

            $stmt = $this->bd->prepare("SELECT imagemImovel FROM ImagensImovel where idImovel = 1");
            $stmt->execute();

            $array = array();
            while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($array, $res['imagemImovel']);
            }
            return $array;
        }

        function deletar($foto){
            $stmt = $this->bd->prepare("DELETE FROM ImagensImovel where imagemImovel = :foto");
            $stmt->bindParam(":foto", $foto);
            $stmt->execute();
        }
        function inserir($foto){
            $stmt = $this->bd->prepare("INSERT INTO ImagensImovel (idImovel, imagemImovel) values (1, :foto)");
            $stmt->bindParam(":foto", $foto);
            $stmt->execute();
        }

    }
?>