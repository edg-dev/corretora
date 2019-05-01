<?php include '../../Templates/header.php'; ?>
<div class="login-box">
  <div class="login-logo">
    
  </div>
  <!-- /logo do login -->
  <div class="login-box-body">
    <p class="login-box-msg">Faça o Login para iniciar a sessão</p>

    <form action="../../../index.php" method="post">
      <div class="form-group has-feedback">
        <input value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>" type="text" class="form-control" placeholder="Email" >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Senha" >
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
          <button type="submit" name="login" value="true" class="btn btn-success btn-block">Logar</button>
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

    if(strlen($senha) < 6 || strlen($senha) > 16)
        $erro[] = "Preencha sua <strong>senha</strong> corretamente.";

    if(count($erro) == 0){

      $sql ='SELECT senha as senha, idUsuario as valor 
      FROM Usuario WHERE emailLogin = $_SESSION[email]';
        $que = $mysqli->query($sql) or die($mysqli->error);
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

<?php include '../../Templates/footer.php'; ?>