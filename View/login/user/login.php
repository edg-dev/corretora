
<?php
session_start();
include('conexao.php');
 
if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}
 
$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
 
$query = "select * from usuario where usuario = '{$usuario}' and senha ='{$senha}'";
 
$result = mysqli_query($conexao, $query);
 
$row = mysqli_num_rows($result);
echo $row;
 
if($row == 1) {
	while($percorrer = mysqli_fetch_array($result)){
		$admin= $percorrer ['admin'];
		if ($admin== 1){
		$_SESSION['usuario'] = $usuario;
	header('Location:\corretora\View\administrador\index.php');
	exit();
		}
		else{
			$_SESSION['usuario'] = $usuario;
			header('Location: user.php');
			exit();
		}
	}
	
}else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}