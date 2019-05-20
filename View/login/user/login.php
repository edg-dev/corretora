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




<?php
session_start();
include('conexao.php');
 
if(empty($_POST['emailLogin']) || empty($_POST['senha'])) {
	header('Location: indexLogin.php');
	exit();
}
 
$emailLogin = mysqli_real_escape_string($conexao, $_POST['emailLogin']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
 
$query = "select emailLogin from usuario where emailLogin = '{$emailLogin}' and senha = '{$senha}";
 
$result = mysqli_query($conexao, $query);
 
if($result =! null) {
	$_SESSION['verifica_login'] = true;
	header('Location: indexLogin.php');
	exit();
	
} else {
	$_SESSION['emailLogin'] = $emailLogin;
	header('Location: perfil.php');
	exit();
}
?>
<?php include '../../Templates/footer.php'; ?>
