<?php
if(!$_SESSION['usuario']) {
	header('Location: \corretora\View\login\user\index.php');
	exit();
}