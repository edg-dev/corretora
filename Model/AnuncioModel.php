<?php

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";

    class AnuncioModel{
        private $bd;

        function __construct(){
            $this->bd = BancoDados::obterConexao();
        }

        public function inserir($idImovel, $idUsuario){
            $inserir = $this->bd->prepare("INSERT INTO anuncio(idImovel, verificado, idUsuario, idPrioridade) VALUES (:idImovel, 0, :idUsuario, 3)");
            $inserir->bindParam(":idImovel", $idImovel);
            $inserir->bindParam(":idUsuario", $idUsuario);
            $inserir->execute();
        }

        public function getAnunciosAprovacao(){
            $getAP = $this->bd->prepare(
                "SELECT a.idAnuncio, a.idUsuario, i.idimovel, p.nome, u.usuario, t.descricaoTransacao,
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
            $count = $this->bd->prepare("SELECT COUNT(*) as total FROM anuncio");
            $count->execute();
            return $count->fetch(PDO::FETCH_ASSOC);
        }

        public function countAnunciosAprovacao(){
            $count = $this->bd->prepare("SELECT COUNT(*) as total FROM anuncio inner join imovel on imovel.idImovel = anuncio.idImovel
            WHERE anuncio.verificado = 0 and (imovel.pedido is null or imovel.pedido = 0)");
            $count->execute();
            return $count->fetch(PDO::FETCH_ASSOC);
        }

        public function updateAprovacao($idImovel, $idPrioridade, $idAnuncio, $idUsuario){
            $update = $this->bd->prepare("UPDATE anuncio SET idImovel = :idImovel, verificado = 1, 
                idPrioridade = :idPrioridade, idUsuario = :idUsuario WHERE idAnuncio = :idAnuncio");
            $update->bindParam(":idImovel", $idImovel);
            $update->bindParam(":idPrioridade", $idPrioridade);
            $update->bindParam(":idAnuncio", $idAnuncio);
            $update->bindParam(":idUsuario", $idUsuario);          
            $update->execute();
        }

       public function delete($idAnuncio){
            $delete = $this->bd->prepare("DELETE FROM anuncio WHERE idAnuncio = :idAnuncio");
            $delete->bindParam(":idAnuncio", $idAnuncio);
            $delete->execute();
        }
        public function listar($idUsuario){
            $listar = $this->bd->prepare("SELECT FROM usuario WHERE idUsuario = :idUsuario");
            $listar->bindParam(":idAUsuario", $idUsuario);
            $listar->execute();
        }
        public function getAllAnuncios(){
            $getAP = $this->bd->prepare(
                "SELECT a.idAnuncio, a.idUsuario, i.idimovel, p.nome, u.usuario, t.descricaoTransacao,
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
                where a.verificado = 1"
            );
            $getAP->execute();
            return $getAP->fetchAll(PDO::FETCH_ASSOC);
        }

        public function countAnunciosUser($idUsuario){
            $count = $this->bd->prepare("SELECT COUNT(*) as total FROM anuncio where idUsuario = :idUsuario");
            $count->bindParam(":idUsuario", $idUsuario);
            $count->execute();
            return $count->fetch(PDO::FETCH_ASSOC);
        }

        public function countAnunciosAprovacaoUser($idUsuario){
            $count = $this->bd->prepare("SELECT COUNT(*) as total FROM anuncio inner join imovel on imovel.idImovel = anuncio.idImovel
            WHERE anuncio.verificado = 0 and (imovel.pedido is null or imovel.pedido = 0) and anuncio.idUsuario = :idUsuario");
            $count->bindParam(":idUsuario", $idUsuario);
            $count->execute();
            return $count->fetch(PDO::FETCH_ASSOC);
        }

        public function countAnunciosAtivosUser($idUsuario){
            $count = $this->bd->prepare("SELECT COUNT(*) as total FROM anuncio where idUsuario = :idUsuario AND verificado = 1");
            $count->bindParam(":idUsuario", $idUsuario);
            $count->execute();
            return $count->fetch(PDO::FETCH_ASSOC);
        }

        public function getAnunciosByUser($idUsuario){
            $get = $this->bd->prepare(
                "SELECT a.idAnuncio, a.idUsuario, i.idimovel, t.descricaoTransacao, ti.descricaoTipoImovel,
                e.logradouro, e.numero, e.complemento, cep.descricaoCep, b.nomeBairro, c.nomecidade, a.verificado, i.negociacao
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
                inner join tipoimovel ti
                    on ti.idTipoImovel = i.idTipoImovel
                where a.idUsuario = :idUsuario ORDER BY a.idAnuncio"
            );
            $get->bindParam(":idUsuario", $idUsuario);
            $get->execute();
            return $get->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>