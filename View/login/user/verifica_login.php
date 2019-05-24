<?php

include('login.php');
if(!$_SESSION['usuario']) {
	header('Location: index.php');
	exit();
}