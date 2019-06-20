<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

    class BannerModel{

        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function inserir($link, $descricaoBanner, $imagemBanner){
            try{
            $insert = $this->bd->prepare("INSERT INTO banners(link, descricaoBanner, imagemBanner) 
            VALUES (:link, :descricaoBanner, :imagemBanner)");
            $insert->bindParam(":link", $link);
            $insert->bindParam(":descricaoBanner", $descricaoBanner);
            $insert->bindParam(":imagemBanner", $imagemBanner);
            $insert->execute();
            } catch (Exception $ex){
                throw $ex;
            }
        }

        public function getAllBanners(){
            $getBanners = $this->bd->prepare("SELECT * FROM banners");
            $getBanners->execute();
            return $getBanners->fetchAll();
        }

        public function selectImageBanner($id){
            $select = $this->bd->prepare("SELECT imagemBanner FROM banners WHERE idBanner = :id");
            $select->bindParam(":id", $id);
            $select->execute();
            return $select->fetch();
        }

        public function deletar($id, $imagem){
            $path = $_SERVER["DOCUMENT_ROOT"] . "/corretora/Files/banners/";
            $deleteBanner = $this->bd->prepare("DELETE FROM banners WHERE idBanner = :id");
            $deleteBanner->bindParam(":id", $id);
            $deleteBanner->execute();
            if($imagem != null || $imagem != ""){
                unlink($path . $imagem['imagemBanner']);
            }
        }

        public function getRandomBanner(){
            $getBanner = $this->bd->prepare("SELECT * from banners order by RAND() LIMIT 1");
            $getBanner->execute();
            return $getBanner->fetch(PDO::FETCH_ASSOC);
        }
    }
?>