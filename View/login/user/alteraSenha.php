<?php

if ($senha_nova == $confirmacao){
$teste = sha1($senha);
$id = $_SESSION['usuario'];
$atualiza - "UPDATE usuario SET senha ='{$teste}' WHERE id = "$id"";

$confirmacao = mysql_query($atualiza, $conexao)
echo "SEU ARQUIVO FOI ATUALIZADO";
} else{
echo "sua nova senha não confirma com a cionfirmacao,"; 



?>