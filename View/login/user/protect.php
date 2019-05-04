<?php
if(!function_exists("protect")){

  function protect(){

    if(!isset($_SESSION['Usuario_Logado'])){

      
      echo "<script>location.href='login.php';</script>";
      exit('Login inválido: Redirecionando...');

    }

  }

}

protect();
?>