<?php
session_start();
if(!$_SESSION['emailogin']) {
	header('Location: indexLogin.php');
	exit();
}
?>