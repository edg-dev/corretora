<?php include '../../Templates/header.php'; ?>

<?php
session_start();
include('conexao.php');
 
if(empty($_POST['emailLogin']) || empty($_POST['senha'])) {
	header('Location: indexLogin.php');
	exit();
}
 
$emailLogin = mysqli_real_escape_string($conexao, $_POST['emailLogin']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
 
$query = "select emailLogin from usuario where emailLogin = '{$emailLogin}' and senha = '{$senha}";
 
$result = mysqli_query($conexao, $query);
 
if($result == null) {
	$_SESSION['verifica_login'] = true;
	header('Location: indexLogin.php');
	exit();
	
} else {
	$_SESSION['emailLogin'] = $emailLogin;
	header('Location: perfil.php');
	exit();
}
?>
<?php include '../../Templates/footer.php'; ?>