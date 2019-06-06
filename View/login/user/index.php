<?php include '../../Templates/header.php'?>

<body>

    <div class="container">
        <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Logar</h5>
                    
    <?php
        if(isset($_SESSION['nao_autenticado'])):
    ?>
    <div class="notification is-danger">
        <p>ERRO: Usuário ou senha inválidos.</p>
    </div>
    <?php
        endif;
        unset($_SESSION['nao_autenticado']);
    ?>
    <form class="form-signin" action="login.php" method="POST">
        <div class="form-label-group">
            <label for="usuario">Usuario</label>
            <input name="usuario" id="inputEmail" class="form-control" name="text" placeholder="Seu usuário" autofocus required>
        </div>
        <br>
        <div class="form-label-group">      
            <label for="senha">Senha</label>               
            <input name="senha" id="inputPassword" class="form-control" type="password" placeholder="Sua senha" required>
        </div>
        <br>
        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">Relembrar Senha</label>
        </div>
 
        <button type="submit"  class="btn btn-lg btn-primary btn-block text-uppercase">Entrar</button>
        <hr class="my-4">
    </form>
    <p>Esqueceu a senha ?<a href="esqueciSenha.php"> Clique aqui!</a></p>
        </div>
        </div>
      </div>
    </div>
</div>     
</body>
<?php include '../../Templates/footer.php'?>
</html>