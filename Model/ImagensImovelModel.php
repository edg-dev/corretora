<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";

    class ImagensImovelModel{
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function inserir($idImovel, $imagemImovel){
            try{
                $insImagem = $this->bd->prepare("INSERT INTO ImagensImovel(idImovel, imagemImovel) VALUES(:idImovel, :imagemImovel)");
                $insImagem->bindParam(":idImovel", $idImovel, PDO::PARAM_INT);
                $insImagem->bindParam(":imagemImovel", $imagemImovel);
                $insImagem->execute();
            } catch (Exception $e){
                throw $e;
            }
        }

        public function listarArrayImagens($idImovel){
            $lista = $this->bd->prepare("SELECT * FROM ImagensImovel WHERE idImovel = :idImovel");
            $lista->bindParam(":idImovel", $idImovel);
            $lista->execute();

            $array = array();
            while ($res = $lista->fetch(PDO::FETCH_ASSOC)){
                array_push($array, $res['imagemImovel']);
            }        
            return $array;
        }
    }

?>