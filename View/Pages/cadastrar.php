<?php include '../Templates/header.php'; ?>

        <!-- Page Content -->
        <div class="container">

        <!-- Page Heading -->
        <br>

        <h1 class="my-4">Cadastre-se para anunciar um imóvel</h1>
        <br>
        <br>
        <h3>Escolha seu perfil:</h3>
        <br>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <h4>Pessoa Física</h4>
                        </h4>
                        <p class="card-text">
                            Selecione esse perfil caso você seja uma pessoa física e queira cadastrar anúncios ou pedidos.
                        </p>
                        <p>Não tem conta ainda? <a href="../Cadastro/PessoaFisica.php">Cadastre-se aqui</a></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <h4>Pessoa Jurídica</h4>
                        </h4>
                        <p class="card-text">Selecione esse perfil caso sua empresa deseja cadastrar anúncios ou pedidos.</p>
                        <p>Não tem conta ainda? <a href="../Cadastro/PessoaJuridica.php">Cadastre-se aqui</a></p>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.row -->
        <p>Para se cadastrar como um corretor, realize o cadastro normalmente e entre em contato com a administração para a adição do cresci.</p>
        <br>
        <p>Já possui conta? <a href="/corretora/View/login/user/user.php">Entrar</a></p>
        </div>
        <!-- /.container -->


<?php include "../Templates/footer.php"; ?>
