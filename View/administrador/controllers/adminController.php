<?php
    session_start();
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/UsuarioModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/BannerModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/AnuncioModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImagensImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PerfisModel.php";

    $users = new UsuarioModel();
    $banners = new BannerModel();
    $anuncio = new AnuncioModel();
    $imovel = new ImovelModel();
    $imagens = new ImagensImovelModel();
    $perfis = new PerfisModel();

    $acao = $_GET['acao'];

    if($acao == "create"){

        $link = $_POST["link"];
        $descricao = $_POST["nome"];
        $imagem = $_FILES["banner"];
        $path_dir = $_SERVER["DOCUMENT_ROOT"] . "/corretora/Files/Banners/";

        if(!($imagem['name'] == "")){

            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);
        
            $nome_original = md5(uniqid(time())) . "." . $ext[1];
            $path_original =  $path_dir . $nome_original;
            move_uploaded_file($imagem["tmp_name"], $path_original);
                
            if($ext[1] == 'jpeg' || $ext[1] == 'jpg'){
                $img = imagecreatefromjpeg($path_original);
            }
            else if($ext[1] == 'png'){
                $img = imagecreatefrompng($path_original);                  
            }
            else if($ext[1] == 'gif'){
                $img = imagecreatefromgif($path_original);
            } else {
                return null;
            }
            $novo_nome = md5(uniqid(time())) . "." . $ext[1];
            $tmp_path = $_SERVER["DOCUMENT_ROOT"] . "/corretora/View/administrador/controllers/" . $novo_nome;
            $novo_path = $path_dir . $novo_nome;              
            $imgnova = imagejpeg($img, $novo_nome, 40);
            rename($tmp_path, $novo_path);
            unlink($path_original);

            $banners->inserir($link, $descricao, $novo_nome);
            echo "<script>alert('Banner cadastrado com sucesso'); location.href='/corretora/View/administrador/banners.php';</script>";
        } else {
            $nopath = "";
            $banners->inserir($link, $descricao, $nopath);
            echo "<script>alert('Banner cadastrado (sem imagem) com sucesso'); location.href='/corretora/View/administrador/banners.php';</script>";
        }
    }

    if($acao == "delete"){
        $id = $_GET['id'];

        $imagem = $banners->selectImageBanner($id);
        $banners->deletar($id, $imagem);

        echo "<script>alert('Banner deletado com sucesso'); location.href='/corretora/View/administrador/banners.php';</script>";
    }

    if($acao == "updateVerificado"){
        $idAnuncio = $_POST['idAnuncio'];
        $idImovel = $_POST['idImovel'];
        $idPrioridade = $_POST['idPrioridade'];

        $idUsuario = $_SESSION['idUsuario'];

        $anuncio->updateAprovacao($idImovel, $idPrioridade, $idAnuncio, $idUsuario);

        
    }

    if($acao == "reprovar"){
        $idAnuncio = $_POST['idAnuncio'];
        $idImovel = $_POST['idImovel'];

        $anuncio->delete($idAnuncio);
        $imagensImovel = $imagens->listarArrayImagens($idImovel);

        foreach($imagensImovel as $imagem){
            $path = $_SERVER["DOCUMENT_ROOT"] . "/corretora/Files/" . $imagem;
            unlink($path);
        }
        $imagens->deletarAllImagens($idImovel);
        $imovel->deleteImovel($idImovel);
        
        
    }

    if($acao == "updatePerfil"){
        $idPessoa = $_POST['idPessoaUpdatePerfil'];
        $perfil = $_POST['perfis'];
        $cresci = $_POST['cresci'];

        if(!isset($cresci)){
            $cresci = "";
        }
        if($perfil == 3){
            $perfis->updateUsuarioAdmin($idPessoa);
        }

        $perfis->insertPerfil($idPessoa, $perfil, $cresci);
        echo "<script>alert('Perfil atualizado com sucesso!'); location.href='/corretora/View/administrador/usuarios.php';</script>";
    }


?>