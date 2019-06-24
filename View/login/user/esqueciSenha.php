<?php include '../../Templates/header.php'?>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Esqueci a Senha</h5>
        <form class="form-signin" action="/corretora/Controller/esqueciSenhaController.php?acao=update&usuario=" method="POST" id="registrationForm">
                <div class="form-label-group">
                    <label for="nome">Insira seu nome ( O mesmo usado em seu cadastro)</label>
                    <input name="nome" id="nome" class="form-control" placeholder="Insira seu nome" title="Insira seu nome." autofocus required>
                </div>
                <br>
                <div class="form-label-group">      
                    <label for="email">Insira seu Email</label>               
                    <input name="usuario" id="usuario" class="form-control" type="text" placeholder="Insira seu email" required>
                </div>
                <br>
                <div class="form-label-group">
                    <label for="password">Insira a nova Senha</label>
                    <input type="password" name="senha_nova" id="senha_nova" class="form-control" placeholder="Insira seu nome" title="Insera sua nova senha." autofocus required>
                </div>
                <br>
                <button type="submit"  class="btn btn-lg btn-primary btn-block text-uppercase">Salvar</button>
                
                <hr class="my-4">
            </form>
            <form class="form-signin" action="index.php" >
                <button type="submit"  class="btn btn-lg btn-primary btn-block text-uppercase">Entrar</button>
                <br>
            </form>
            <form class="form-signin" action="../../Cadastro/PessoaFisica.php" >
                <button type="submit"  class="btn btn-lg btn-primary btn-block text-uppercase">Cadastre-se (PF)</button>
                <br>
            </form>
            <form class="form-signin" action="../../Cadastro/PessoaJuridica.php" >
                <button type="submit"  class="btn btn-lg btn-primary btn-block text-uppercase">Cadastre-se (PJ)</button>
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
