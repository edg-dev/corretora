<?php include '../../Templates/header.php'?><br><br><br><br><br>
<?php
include('conexao.php');

$conn = new conecta();
$chave = $conn->geraChaveAcesso();
$usuario= $_POST["usuario"];
if ($chave){
    echo'<a href:"\corretora\View\login\user\esqueciSenha.php?chave='.$chave.' ">
    \corretora\View\login\user\esqueciSenha.php?chave='.$chave.'</a>';
}else{

}



?>


<?php include '../../Templates/footer.php'?>