<?php
session_start();
if(!$_SESSION['emailLogin']) {
	header('Location: ..\login.php');
	exit();
}
?>