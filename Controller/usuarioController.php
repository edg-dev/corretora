<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/UsuarioModel.php";

	$UsuarioModel = new UsuarioModel();

    $acao = $_GET['acao'];
    $idUsuario = $_GET['id'];
    #$idUsuario = $_SESSION['idUsuario'];


	if($acao == "update"){
        $senha = $_POST["senha"];
        $senhanova = $_POST["senha_nova"];
        
        $senhaSha1 = sha1($senha);
        $verificaSenha = $UsuarioModel->getSenha($idUsuario);

        if($verificaSenha['senha'] == $senhaSha1){
            $UsuarioModel->alteraSenha($senhanova, $idUsuario, $senha);
        } else {
            echo "<script>alert('Sua senha atual está incorreta.'); location.href='/corretora/View/login/user/user.php';</script>";
        }
		echo "<script>alert('Senha alterada com sucesso'); location.href='/corretora/View/login/user/user.php';</script>";

	}
?>
