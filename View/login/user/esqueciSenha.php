<?php include '../../Templates/header.php'?>

<body>

    <div class="container">
        <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Esqueci a senha</h5>
                    
    
    <form class="form-signin" action="enviaNovaSenha.php" method="POST">
        <div class="form-label-group">
            <label for="usuario">Usuario</label>
            <input name="usuario" id="inputEmail" class="form-control" name="text" placeholder="Seu email" autofocus required>
        </div>
        <br>
             
        <button type="submit"  class="btn btn-lg btn-primary btn-block text-uppercase">Enviar</button>
        <hr class="my-4">
    </form>
   
        </div>
        </div>
      </div>
    </div>
</div>     
</body>
<?php include '../../Templates/footer.php'?>
</html>