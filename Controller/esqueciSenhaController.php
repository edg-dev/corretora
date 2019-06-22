<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/UsuarioModel.php";
    

    $UsuarioModel = new UsuarioModel();
    

    $acao = $_GET['acao'];
    $usuario = $_GET['usuario'];
    
	if($acao == "update"){
        $nome = $_POST["nome"];
        $usuario = $_POST["usuario"];
        $senhanova = $_POST["senha_nova"];
        #$senha = $_POST["senha"];
        
        $senhaSha1 = sha1($senhanova);
        $verificaSenha = $UsuarioModel->recuperaSenha($nome, $usuario);

        if($verificaSenha['senha'] == $senhaSha1){
            $UsuarioModel->esqueciSenha($senhanova, $usuario, $nome, $senha);
        } else {
            echo "<script>alert('Seu nome ou email está incorreto.'); location.href='/corretora/View/login/user/index.php';</script>";
        }
		echo "<script>alert('Senha alterada com sucesso'); location.href='/corretora/View/login/user/index.php';</script>";

    }
    

?>
