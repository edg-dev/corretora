<!doctype html>
<html>

  <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title>Login</title>

        <!-- CSS  -->
        <link href="/corretora/Config/CSS/login.css" type="text/css" rel="stylesheet">
        <link href="/corretora/Config/Bootstrap/bootstrap.css" type="text/css" rel="stylesheet">

        <!-- JavaScript  -->
        <script src="/corretora/Config/JS/jquery-3.2.1.min.js"></script>
        <script src="/corretora/Config/JS/bootstrap.js"></script>
        <script src="/corretora/Config/JS/init.js"></script>

  </head>

    <div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
              <div class="card-body">
                <h5 class="card-title text-center">Entre aqui!</h5>
                <form class="form-signin">
                  <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="email@email.com" required autofocus>
                    <label for="inputEmail">E-mail</label>
                  </div>

                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="senha" required>
                    <label for="inputPassword">Senha</label>
                  </div>

                  <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Lembrar minha senha!</label>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
                  <hr class="my-4">
                  <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Entrar com Google</button>
                  <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Entrar com Facebook</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>




<div class="login-box">
  <div class="login-logo">
    
  </div>
  <!-- /logo do login -->
  <div class="login-box-body">
    <p class="login-box-msg">Faça o Login para iniciar a sessão</p>

    <form action="../../../index.php" method="post">
      <div class="form-group has-feedback">
        <input value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>" name="emailLogin" type="email" class="form-control" placeholder="Email" >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input value="<?php if(isset($_SESSION['senha'])) echo $_SESSION['senha']; ?>" class="form-control" required placeholder="Senha" name="password" type="password" >
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
          <button type="submit" name="login"  class="btn btn-success btn-block">Logar</button>
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
<?php
if(!isset($_SESSION))
    session_start();

//Login de Usários
if(isset($_POST['login'])){

  include('../conexao.php');
  
  $erro = array();

  // Captação de dados
    $senha = $_POST['password'];
    $_SESSION['email'] = $mysqli->escape_string($_POST['email']);

    // Validação de dados
    if(!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL))
        $erro[] = "Preencha seu <strong>e-mail</strong> corretamente.";

    if(strlen($senha) < 6 || strlen($senha) > 32)
        $erro[] = "Preencha sua <strong>senha</strong> corretamente.";

    if(count($erro) == 0){
      $email = $_SESSION['email'];
      $sql ='SELECT senha as senha, idUsuario as valor 
      FROM Usuario WHERE emailLogin =:email';
      $mysqli->prepare->query($sql);
      $mysqli->bindParam(":email", $email);
        $que = $mysqli->execute() or die($mysqli->error);
        $dado = $que->fetch_assoc();
        
        if($que->num_rows == 0)
            $erro[] = "Nenhum usuário possui o <strong>e-mail</strong> informado.";

        elseif(strcmp($dado['senha'], ($senha)) == 0){
            $_SESSION['Usuario_Logado'] = $dado[valor];
        }else
            $erro[] = "<strong>Senha</strong> incorreta.";

        if(count($erro) == 0){
            echo "<script>location.href='index.php=';</script>";
            exit();
            unset($_SESSION['email']);
        }
    }
}
?>
