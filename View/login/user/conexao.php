<?php

define("host" ,"localhost");
define("usuario" , "root");
define("senha" , "");
define("bd" , "corretora");

$conexao = mysqli_connect(host, usuario, senha, bd) or die('Não foi possivel fazer Login');


?>