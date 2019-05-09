<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImagensImovelModel.php";

    $ImagensModel = new ImagensImovelModel();

    $acao = $_GET["acao"];

    if($acao == "create"){
        try{
            $idImovel = $_POST["idImovel"];
            $imagem = $_FILES["imagens"];
            $path_dir = $_SERVER["DOCUMENT_ROOT"] . "/corretora/Files/";
    
            if (empty($imagens["name"])){
    
                $error = array();
    
                if(count($error) == 0){
                    $i = 0;
                    for($i = 0; $i < count($_FILES['imagens']['name']); $i++){
                        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"][$i], $ext);
    
                        $nome_original = md5(uniqid(time())) . "." . $ext[1];
                        $path_original =  $path_dir . $nome_original;
                        move_uploaded_file($imagem["tmp_name"][$i], $path_original);
                            
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
                        $tmp_path = $_SERVER["DOCUMENT_ROOT"] . "/corretora/Controller/" . $novo_nome;
                        $novo_path = $path_dir . $novo_nome;              
                        $imgnova = imagejpeg($img, $novo_nome, 20);
                        rename($tmp_path, $novo_path);
                        unlink($path_original);
                        $ImagensModel->inserir($idImovel, $novo_nome);
    
                    }
                    echo "<div class='card-panel teal lighten-2'>Imagens salvas</div>";
                }
            }

        } catch(Exception $e){
            echo "Erro: " . $e;
        }
    }

?>