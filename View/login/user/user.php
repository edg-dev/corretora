<?php include '../../Templates/header.php'
?>
<?php

    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/AnuncioModel.php";
    $anuncioModel = new AnuncioModel();
    $anuncios = $anuncioModel->countAnuncios();
    $anunciosAP = $anuncioModel->countAnunciosAprovacao();
                  
?>

<?php

include('verifica_login.php');
include('conexao.php');


?><link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
  <title>Usuário</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<hr>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1>Olá, você esta logado com <strong> <?php echo $_SESSION['usuario'];?></strong></h1></div>
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
                <li><a data-toggle="tab" href="#messages">Anuncios</a></li>
                
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
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="messages">
               
               <h2></h2>
               
               
               <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-bullhorn"></i>
                </div>
                <div class="mr-5"> <?php echo intVal($anunciosAP['total']); ?> Anúncios em aprovação</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="anuncios.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-bullhorn"></i>
                </div>
                <div class="mr-5"><?php echo intVal($anuncios['total']); ?> Anúncios já cadastrados</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="/corretora/View/Cadastro/Imovel.php">
                <span class="float-left">Cadastre Um novo anúncio</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
            </div>
          </div>
             </div><!--/tab-pane-->
             <div class="tab-pane" id="settings">
            		
               	
                  <hr>
                  
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->

