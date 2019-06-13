<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";

    class BannerModel{

        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function inserir($link, $descricaoBanner, $imagemBanner){
            $insert = $this->bd->prepare("INSERT INTO Banners(link, descricaoBanner, imagemBanner) 
            VALUES (:link, :descricaoBanner, :imagemBanner)");
            $insert->bindParam(":link", $link);
            $insert->bindParam(":descricaoBanner", $descricaoBanner);
            $insert->bindParam(":imagemBanner", $imagemBanner);
            $insert->execute();
        }

        public function getAllBanners(){
            $getBanners = $this->bd->prepare("SELECT * FROM Banners");
            $getBanners->execute();
            return $getBanners->fetchAll();
        }

        public function selectImageBanner($id){
            $select = $this->bd->prepare("SELECT imagemBanner FROM Banners WHERE idBanner = :id");
            $select->bindParam(":id", $id);
            $select->execute();
            return $select->fetch();
        }

        public function deletar($id, $imagem){
            $path = $_SERVER["DOCUMENT_ROOT"] . "/corretora/Files/Banners/";
            $deleteBanner = $this->bd->prepare("DELETE FROM Banners WHERE idBanner = :id");
            $deleteBanner->bindParam(":id", $id);
            $deleteBanner->execute();
            if($imagem != null || $imagem != ""){
                unlink($path . $imagem['imagemBanner']);
            }
        }

        public function getRandomBanner(){
            $getBanner = $this->bd->prepare("SELECT * from Banners order by RAND() LIMIT 1");
            $getBanner->execute();
            return $getBanner->fetch(PDO::FETCH_ASSOC);
        }
    }
?>