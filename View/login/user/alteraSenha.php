<?php



if (! isset(empty($_POST['senha']) || empty($_POST['senha'])) ) {
	header('Location: user.php');
	exit();
}
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$senha_nova = mysqli_real_escape_string($conexao, $_POST['senha_nova']);
$teste = sha1($senha);

$query = "select * from usuario where senha = '{$teste}' ";
$result = mysqli_query($conexao, $query);
$row = mysqli_num_rows($result);
echo $row;

if($row == 1) {

    $senha = "UPDATE usuario SET senha = SHA1(CONCAT('$senha_nova')) WHERE idUsuario = 1";
}