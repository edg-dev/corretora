<?php

$host = "projetohom.000webhostapp.com";
$usuario = "id9478593_edgdev";
$senha = "projeto2019";
$bd = "id9478593_corretora";

$mysqli = new mysqli($host, $usuario, $senha, $bd);

if($mysqli->connect_errno)
  echo "Falha na conexão: (".$mysqli->connect_errno.") ".$mysqli->connect_error;

?>