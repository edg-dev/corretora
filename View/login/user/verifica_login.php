<?php
if(!$_SESSION['idUsuario']) {
	#header('Location: /corretora/View/login/user/index.php');
	echo "<script>location.href='/corretora/View/login/user/index.php';</script>";
	exit();
}