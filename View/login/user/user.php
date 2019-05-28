<?php include '../../Templates/header.php'?>

<?php

include('verifica_login.php');
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
  		<div class="col-sm-10"><h1>Olá, <?php echo $_SESSION['usuario'];?></h1></div>
    	<div class="col-sm-2"><a href="\corretora\View\login\user\logout.php" class="pull-right">
        <img title="Fazer Logout" class="img-circle img-responsive" 
        src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a>
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
            <li class="list-group-item text-right"><span class="pull-left"><strong>Total de Anuncios</strong></span> 5</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Mensagens</strong></span> 99</li>
            
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
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Nome</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Segundo nome</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Telefone</h4></label>
                              <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="usuario" placeholder="you@email.com" title="Insira seu email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                         
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="password"><h4>Senha</h4></label>
                              <input type="password" class="form-control" name="password" id="senha" placeholder="password" title="Insera sua senha.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Confirme a senha</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Salvar</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Refazer</button>
                            </div>
                      </div>
              	</form>
              
              <hr>
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="messages">
               
               <h2></h2>
               
               //
               
             </div><!--/tab-pane-->
             <div class="tab-pane" id="settings">
            		
               	
                  <hr>
                  
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->

