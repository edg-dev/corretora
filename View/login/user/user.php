<?php include '../../Templates/header.php'
?>
<?php
    $idUsuario = $_SESSION['idUsuario'];

    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/AnuncioModel.php";
    
    $anuncioModel = new AnuncioModel();
    $anuncios = $anuncioModel->countAnunciosUser($idUsuario);
    $anunciosAP = $anuncioModel->countAnunciosAprovacaoUser($idUsuario);
    
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/execRotina.php";
    
    $rotina = new execRotina();
    $rotina->execRotina();

?>

<?php

include('verifica_login.php');
include('conexao.php');


?>

<head>
  <title>Usuário</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<hr>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1>Olá, você esta logado com <strong> <?php echo $_SESSION['usuario'];?></strong> <?php echo $_SESSION['idUsuario'];?></h1></div>
    	<div class="col-sm-2">
        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign">
        <a href="\corretora\View\login\user\logout.php" class="pull-right"></i> Sair</a></button>
        </div>
        
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        
      </div></hr><br>

          
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Geral</li>
            <li class="list-group-item text-right"><span  class="pull-left" ><div class="mr-5"><?php echo intVal($anuncios['total']); ?> <strong>Anúncios Totais</strong></div></span> </li>
            
            <li class="list-group-item text-right"><span class="pull-left"><div class="mr-5"> <?php echo intVal($anunciosAP['total']); ?> <strong>Anúncios para aprovação</strong></div></span></li>
            
          </ul> 
               
                    
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Pessoal</a></li>             
              </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" action="\corretora\View\login\user\alteraSenha.php" method="post" id="registrationForm">
       
                      <div class="form-group">
                          
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Senha Atual</h4></label>
                              <input type="password" class="form-control" name="senha_atual" i placeholder="Senha atual" title="Insira sua senha atual." onfocus="this.value=''">
                          </div>
                      </div>
                      <div class="form-group">
                          
                         
                      </div>
                      <div class="form-group">
                        
                     
                          <div class="col-xs-6">
                              <label for="password" ><h4>Nova Senha</h4></label>
                              <input type="password" class="form-control" name="senha_nova"  placeholder="Nova senha" title="Insera sua nova senha.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Confirme a senha</h4></label>
                              <input type="password" class="form-control" name="onfirme_senha"  placeholder="Confirme a senha" title="Confirme sua nova senha.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button action="\corretora\View\login\user\alteraSenha.php" class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign">
                                <a href="\corretora\View\login\user\alteraSenha.php" class="pull-right"></i> Salvar</a></button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Refazer</button>
                            </div>
                      </div>
                </form>
                
              
              <hr>

          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->

