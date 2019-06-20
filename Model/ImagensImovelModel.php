<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

    class ImagensImovelModel{
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function inserir($idImovel, $imagemImovel){
            try{
                $insImagem = $this->bd->prepare("INSERT INTO imagensimovel(idImovel, imagemImovel) VALUES(:idImovel, :imagemImovel)");
                $insImagem->bindParam(":idImovel", $idImovel, PDO::PARAM_INT);
                $insImagem->bindParam(":imagemImovel", $imagemImovel);
                $insImagem->execute();
            } catch (Exception $e){
                throw $e;
            }
        }

        public function listarArrayImagens($idImovel){
            $lista = $this->bd->prepare("SELECT * FROM imagensimovel WHERE idImovel = :idImovel");
            $lista->bindParam(":idImovel", $idImovel);
            $lista->execute();

            $array = array();
            while ($res = $lista->fetch(PDO::FETCH_ASSOC)){
                array_push($array, $res['imagemImovel']);
            }        
            return $array;
        }

        public function listarAllImagens(){
            $lista = $this->bd->query("SELECT * FROM imagensimovel");
            $lista->execute();

            $array = array();
            while ($res = $lista->fetch(PDO::FETCH_ASSOC)){
                array_push($array, $res['imagemImovel']);
            }        
            return $array;
        }

        public function deletar($idImovel, $imagemImovel){
            $delete = $this->bd->query("DELETE FROM imagensimovel where idImovel = :idImovel and imagemImovel = :imagemImovel");
            $delete->bindParam(":idImovel", $idImovel);
            $delete->bindParam(":imagemImovel", $imagemImovel);
            $delete->execute();
        }

        public function deletarAllImagens($idImovel){
            $delete = $this->bd->prepare("DELETE FROM imagensimovel WHERE idImovel = :idImovel");
            $delete->bindParam(":idImovel", $idImovel);
            $delete->execute();
        }

        //TESTE
        public function getAllImagens(){
            $foto = $this->bd->query("SELECT imagemImovel FROM imagensimovel");
            $foto->execute();

            $array = array();
            while ($res = $foto->fetch(PDO::FETCH_ASSOC)){
                array_push($array, $res['imagemImovel']);
            }        
            return $array;
        }

        public function getImagemImovelIndex($idImovel){
            $foto = $this->bd->prepare("SELECT imagemImovel FROM imagensimovel where idImovel = :idImovel LIMIT 1");
            $foto->bindParam(":idImovel", $idImovel);
            $foto->execute();

            $array = array();
            while ($res = $foto->fetch(PDO::FETCH_ASSOC)){
                array_push($array, $res['imagemImovel']);
            }        
            return $array;
        }

        public function countImagensImovel($idImovel){
            $count = $this->bd->prepare("SELECT COUNT(*) as total FROM imagensimovel where idImovel = :idImovel");
            $count->bindParam(":idImovel", $idImovel);
            $count->execute();
            return $count->fetch(PDO::FETCH_ASSOC);
        }
    }

?>