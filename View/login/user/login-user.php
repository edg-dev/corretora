<?php include '../../Templates/header.php'; ?>
<div class="login-box">
  <div class="login-logo">
    
  </div>
  <!-- /logo do login -->
  <div class="login-box-body">
    <p class="login-box-msg">Faça o Login para iniciar a sessão</p>

    <form action="../../../index.html" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Login" name="deslogin">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="despassword">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
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
          <button type="submit" href="index.html" class="btn btn-primary btn-block btn-flat">Logar</button>
        </div>

        <div class="col-md-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Esqueci a senha</button>
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
    <a href=" exemplo-registro.html" class="text-center">Crie uma nova conta</a>

  </div>

</div>

<?php include '../../Templates/footer.php'; ?>