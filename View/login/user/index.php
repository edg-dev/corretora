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
            <label for="usuario">Usuário</label>
            <input name="usuario" id="inputEmail" class="form-control" name="text" placeholder="Seu usuário" autofocus required>
        </div>
        <br>
        <div class="form-label-group">      
            <label for="senha">Senha</label>               
            <input name="senha" id="inputPassword" class="form-control" type="password" placeholder="Sua senha" required>
        </div>
        <br>

        <button type="submit"  class="btn btn-lg btn-primary btn-block text-uppercase">Entrar</button>
        
        <hr class="my-4">
    </form>
    <form class="form-signin" action="esqueciSenha.php" >
        <button type="submit"  class="btn btn-lg btn-primary btn-block text-uppercase">Esqueci a senha</button>
    </form>
        </div>
        </div>
      </div>
    </div>
</div>  
<br>
<br>   
<br>
</body>
<?php include '../../Templates/footer.php'?>
</html>