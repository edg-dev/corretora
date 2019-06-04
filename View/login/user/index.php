<?php include '../../Templates/header.php'?>

<body>

    <h2>Entre aqui!</h2>
                    
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
    <form action="login.php" method="POST">
        <div class="imgcontainer">
            <img src="../../../Files/img_avatar2.png" alt="Avatar" class="avatar">
        </div>
        <div class="container">
            <label for="usuario"><b>Usuario</b></label>
            <input name="usuario" name="text" class="input is-large" placeholder="Seu usuário" autofocus="">
                                
            <label for="senha"><b>Senha</b></label>
            <input name="senha" class="input is-large" type="password" placeholder="Sua senha">
 
            <button type="submit"  class="btn btn-primary">Entrar</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Lembrar-Me
            </label>
        </div>
        <!--
        <div class="container" style="background-color:#f1f1f1">
            <span class="psw">Esqueceu a <a href="#">Senha?</a></span>
        </div>
        -->
    </form>
     
</body>
</html>