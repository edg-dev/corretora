<?php

$host = "localhost";
$usuario = "corretora";
$senha = "";
$bd = "corretora";

$mysqli = new mysqli($host, $usuario, $senha, $bd);

if($mysqli->connect_errno)
  echo "Falha na conexão: (".$mysqli->connect_errno.") ".$mysqli->connect_error;

?>