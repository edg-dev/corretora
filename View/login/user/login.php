<?php session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaModel.php";

$pessoa = new PessoaModel();

include('conexao.php');
 
if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}
 
$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$teste = sha1($senha);
$query = "select * from usuario where usuario = '{$usuario}' and senha ='{$teste}'";
 
$result = mysqli_query($conexao, $query);
 
$row = mysqli_num_rows($result);
 
if($row == 1) {
	while($percorrer = mysqli_fetch_array($result)){
		$admin= $percorrer ['admin'];
		$user = $percorrer['idUsuario'];
		$nomePessoa = $pessoa->getNomePessoa($user);
		if ($admin== 1) {
			$_SESSION['idUsuario'] = $user;
			$_SESSION['usuario'] = $usuario;
			$_SESSION['admin'] = $admin;
			$_SESSION['nomePessoa'] = $nomePessoa['nome'];
			echo "<script>location.href='/corretora/View/administrador/index.php';</script>";
			# header('Location: /corretora/View/administrador/index.php');
			exit();
		} else {
			$_SESSION['idUsuario'] = $user;
			$_SESSION['usuario'] = $usuario;
			$_SESSION['nomePessoa'] = $nomePessoa['nome'];
			echo "<script>location.href='user.php';</script>";
			# header('Location: user.php');
			exit();
		}
	}
} else {
	$_SESSION['nao_autenticado'] = true;
	echo "<script>location.href='index.php';</script>";
	# header('Location: index.php');
	exit();
}


