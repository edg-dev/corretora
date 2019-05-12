<?php include '../../Templates/header.php'; ?>

<?php
session_start();
?>
<div class="login-box">
  <div class="login-logo">
    
  </div>
  <!-- /logo do login -->
  <div class="login-box-body">
    <p class="login-box-msg">Faça o Login para iniciar a sessão</p>

    <form action="\corretora\View\login\user\login.php" method="post">
      <div class="box">
        <input  name="emailLogin" type="email" class="form-control" placeholder="Email" require autofocus="">
        
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Senha" name="senha" type="password" require>
        
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Lembrar de mim
            </label>
          </div>
        </div>

        <div class="form-group col-md-4">
          <button type="submit" class="btn btn-success btn-block">Logar</button>
        </div>

        <div class="col-md-4">
          <button type="" class="btn btn-primary btn-block btn-flat">Esqueci a senha</button>
        </div>

      </div>
    </form>

    <div class="social-auth-links text-center">
      <br>
      
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook">
      </i> Inscreva-se usando o Facebook</a><br>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus">
      </i> Inscreva-se usando o  Google+</a>
    </div>
   

    <br>
    <a href=" ../../../index.php" class="text-center">Crie uma nova conta</a>

  </div>

</div>
<?php include '../../Templates/footer.php'; ?>