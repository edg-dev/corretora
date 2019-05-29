<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

    class AnuncioModel{
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function inserir($idImovel){
            $inserir = $this->bd->prepare("INSERT INTO Anuncio(idImovel, verificado, idUsuario) VALUES (:idImovel, 0, 1)");
            $inserir->bindParam(":idImovel", $idImovel);
            $inserir->execute();
        }

        public function getAnunciosAprovacao(){
            $getAP = $this->bd->prepare(
                "SELECT a.idAnuncio, i.idimovel, p.nome, u.usuario, t.descricaoTransacao,
                e.logradouro, e.numero, e.complemento, cep.descricaoCep, b.nomeBairro, c.nomecidade
                FROM anuncio as a
                inner join imovel as i
                    on i.idimovel = a.idImovel 
                inner join endereco as e
                    on i.idEndereco = e.idEndereco
                inner join cidade as c
                    on e.idCidade = c.idCidade
                inner join estado as est
                    on est.idestado = e.idestado
                inner join bairro as b
                    on e.idBairro = b.idBairro
                inner join usuario as u
                    on u.idusuario = a.idusuario
                inner join pessoa as p
                    on p.idpessoa = u.idusuario
                inner join transacao as t
		            on t.idtransacao = i.idtransacao
                inner join cep
		            on cep.idcep = e.idcep
                where a.verificado = 0 and (i.pedido is null or i.pedido = 0)"
            );
            $getAP->execute();
            return $getAP->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countAnuncios(){
            $count = $this->bd->prepare("SELECT COUNT(*) as total FROM Anuncio");
            $count->execute();
            return $count->fetch(PDO::FETCH_ASSOC);
        }

        public function countAnunciosAprovacao(){
            $count = $this->bd->prepare("SELECT COUNT(*) as total FROM Anuncio inner join Imovel on Imovel.idImovel = Anuncio.idImovel
            WHERE Anuncio.verificado = 0 and (Imovel.pedido is null or Imovel.pedido = 0)");
            $count->execute();
            return $count->fetch(PDO::FETCH_ASSOC);
        }

        public function updateAprovacao($idImovel, $idPrioridade, $idAnuncio){
            $update = $this->bd->prepare("UPDATE Anuncio SET idImovel = :idImovel, verificado = 1, 
                idPrioridade = :idPrioridade, idUsuario = 1 WHERE idAnuncio = :idAnuncio");
            $update->bindParam(":idImovel", $idImovel);
            $update->bindParam(":idPrioridade", $idPrioridade);
            $update->bindParam(":idAnuncio", $idAnuncio);
            #$update->bindParam(":idUsuario", $idUsuario);          
            $update->execute();
        }

       public function delete($idAnuncio){
            $delete = $this->bd->prepare("DELETE FROM Anuncio WHERE idAnuncio = :idAnuncio");
            $delete->bindParam(":idAnuncio", $idAnuncio);
            $delete->execute();
        }
        
    }
?>