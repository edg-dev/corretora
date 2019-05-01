<?php
session_start();
unset($_SESSION['Usuario_Logado']);
session_destroy();
?>
<script>location.href='../login.php';</script> 
<?php exit('Redirecionando...'); ?>