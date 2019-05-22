<!doctype html>
<html>

  <head>
      <?php
        if(!isset($_SESSION))
            session_start();

        //Login de Usários
        if(isset($_POST['emailLogin'])){
          include('conexao.php');
          //require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/View/login/conexao.php";
        
        $erro = array();

        // Captação de dados
            $senha = $_POST['senha'];
            $_SESSION['senha'] = $mysqli->escape_string($_POST['senha']);

            // Validação de dados
            if(!filter_var($_SESSION['emailLogin'], FILTER_VALIDATE_EMAIL))
                $erro[] = "Preencha seu <strong>e-mail</strong> corretamente.";

            if(strlen($senha) < 6 || strlen($senha) > 32)
                $erro[] = "Preencha sua <strong>senha</strong> corretamente.";

            if(count($erro) == 0){
            $email = $_SESSION['emailLogin'];
            $sql ='SELECT emailLogin, idUsuario as valor 
            FROM usuario WHERE emailLogin =:email';

            $mysqli->prepare->query($sql);
            $mysqli->bindParam(":emailLogin", $email);
            
                $mysqli = $mysqli->execute() or die($mysqli->error);
                $dado = $que->fetch_assoc();
                
                
                if($mysqli->num_rows == 0)
                    $erro[] = "Nenhum usuário possui o <strong>e-mail</strong> informado.";
                    

                elseif(strcmp($dado['emailLogin'], ($email)) == 0){
                    $_SESSION['verica_login.php'] = $dado[valor];
                }else
                    $erro[] = "<strong>Senha</strong> incorreta.";

                if(count($erro) == 0){
                    echo "<script>location.href='index.php=';</script>";
                    exit();
                    unset($_SESSION['emailLogin']);
                }
            }
        }
      ?>

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
  
  <form action="/corretora/View/login/user/login.php" method="post">
    <div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
              <div class="card-body">
                <h5 class="card-title text-center">Entre aqui!</h5>
                <form class="form-signin">
                  <div class="form-label-group">
                    <input value ="<?php if(isset($_SESSION['emailLogin'])) echo $_SESSION['emailLogin']; ?>" name="emailLogin"
                        type="email" id="inputEmail" class="form-control" placeholder="email@email.com" required autofocus>
                    <label for="inputEmail">E-mail</label>
                  </div>

                  <div class="form-label-group">
                    <input value="<?php if(isset($_SESSION['senha'])) echo $_SESSION['senha']; ?>" name="password"
                        type="password" id="inputPassword" class="form-control" placeholder="senha" required>
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
    </form>

