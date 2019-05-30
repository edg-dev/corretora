<?php
   include("conexao.php");
   session_start();

   $login = $_SESSION["usuario"];

   $senha = isset($_POST['senha_atual'])?$_POST['senha_atual']:"";
   $senha_nova = $_POST['senha_nova'];
   $confirme_senha = $_POST['confirme_senha'];

   $sql=mysql_query("select senha from usuario where usuario='$login' ");
   $row= mysql_fetch_array($sql);
   $senha_banco = $row['senha'];  

   if(($senha_nova=="") && ($confirme_senha=="") && ($senha_banco==""))
   {
	   echo"<script>alert('Os campos das senhas não podem ser Nulos!');
			   window.location='index.php?ver=alterar_senha.php';
			   </script>";
	   return false;
   }
	  else
	   {			
		   if(($senha != $senha_banco) && ($senha_nova != $confirme_senha))
		  {
			   echo"<script>alert('Senhas Digitadas não conhecidem!');
				  window.location='index.php?ver=alterar_senha.php';
				  </script>";
		  }
		  else
		  {
			  if($result=mysql_query("update utilizadores set passe='$confirme_senha' where login='$login'"))
	   		{	
					echo"<script>alert('Senha Alterada com Sucesso!');
					   window.location='index.php?ver=conta.php';
					  </script>";
			   }
		   }  
	   }		
  ?>