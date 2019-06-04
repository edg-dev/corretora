<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

    class PerfisModel {
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function getPerfis(){
            $select = $this->bd->prepare("SELECT * FROM perfis");
            $select->execute();
            return $select->fetchAll();
        }

        public function insertPerfilDefault($idUsuario){
            $insert = $this->bd->prepare("INSERT INTO UsuarioPerfil(idUsuario, idPerfil) VALUES (:idUsuario, 1)");
            $insert->bindParam(":idUsuario", $idUsuario);
            $insert->execute();
        }

        public function insertPerfil($idUsuario, $idPerfil, $cresci){
            $update = $this->bd->prepare("UPDATE UsuarioPerfil SET idUsuario = :idUsuario, idPerfil = :idPerfil, cresci = :cresci
                WHERE idUsuario = :idUsuario");
            $update->bindParam(":idUsuario", $idUsuario);
            $update->bindParam(":idPerfil", $idPerfil);
            $update->bindParam(":cresci", $cresci);
            $update->execute();
        }

        public function updateUsuarioAdmin($idUsuario){
            $update = $this->bd->prepare("UPDATE Usuario SET admin = 1 WHERE idUsuario = :idUsuario");
            $update->bindParam(":idUsuario", $idUsuario);
            $update->execute();
        }
    }

?>