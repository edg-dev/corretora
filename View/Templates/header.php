<?php session_start();?>
<!doctype html>
<html lang="pt-br">
    <head> 
 
        
        <meta charset="ISO-8859-1"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

        <title>Gabriela Guimarães Corretora de Imóveis</title>

        <link rel="shortcut icon" href="/corretora/View/visual/favicon2.ico" />

        <!-- CSS  -->
        <link href="/corretora/Config/CSS/style.css" type="text/css" rel="stylesheet">
        <link href="/corretora/Config/Bootstrap/bootstrap.css" type="text/css" rel="stylesheet">

        <!-- JavaScript  -->
        <script src="/corretora/Config/JS/bootstrap.bundle.min.js"></script>
        <script src="/corretora/Config/JS/jquery-3.2.1.min.js"></script>
        <script src="/corretora/Config/JS/bootstrap.min.js"></script>
        <script src="/corretora/Config/JS/bootstrap.js"></script>
        <script src="/corretora/Config/JS/init.js"></script>
        <script src="/corretora/Config/JS/jquery.mask.min.js"></script>
        
        <!-- Dropzonejs -->
        <script src="/corretora/Config/JS/dropzone.js"></script>
        <link href="/corretora/Config/CSS/dropzone.css" type="text/css" rel="stylesheet">
        <link href="/corretora/Config/CSS/basic.css" type="text/css" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="/corretora/Config/CSS/FontAwesome/css/fontawesome.min.css" type="text/css" rel="stylesheet">

        <!-- Fontes -->
        <link href="https://fonts.googleapis.com/css?family=Zilla+Slab&display=swap" rel="stylesheet">
    </head>

<body>
<style>
    .bg-dark {
        background-color: #ef7f1b !important;
    }
    body {
        font-family: 'Zilla Slab', serif;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="margin-bottom: 100px;">

        <a class="navbar-brand" href="/corretora/index.php"><img src="\corretora\View\visual\logo2.png" alt="Logo" width=64 height=64></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active" >
                    <a class="nav-link btn-outline-success" href="/corretora/index.php">Inicio<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link btn-outline-success" href="/corretora/View/Cadastro/Imovel.php">Anunciar</a>
                </li>

                <?php if(!isset($_SESSION['idUsuario'])) { ?>
                <li class="nav-item">
                    <a class="nav-link btn-outline-success" href="/corretora/View/Pages/cadastrar.php">Cadastre-se</a>
                </li>
                <?php } ?>

                <?php if(isset($_SESSION['idUsuario'])) { ?>
                <li class="nav-item">
                    <a class="nav-link btn-outline-success" href="/corretora/View/Cadastro/Pedido.php">Cadastrar Pedido</a>
                </li>
                <?php } ?>

            </ul>

                <img class="nav-link" style="width:200px;height:64px;" src="/corretora/View/visual/title.png" alt="Anuncie aqui">
                
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <?php if(!isset($_SESSION['idUsuario'])) { ?>
                <li class="nav-item">
                    <a class="nav-link btn-outline-success" href="/corretora/View/login/user/index.php">Entrar</a>
                </li>
                <?php } ?>

                <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1 ) { ?>
                <li class="nav-item">
                    <a class="nav-link btn-outline-primary" href="/corretora/View/administrador/index.php">Administrativo</a>
                </li>
                <?php } ?>

                <?php if(isset($_SESSION['idUsuario'])) { ?>
                <li class="nav-item">
                    <a class="nav-link btn-outline-success" href="/corretora/View/login/user/user.php">Perfil</a>
                </li>
                <?php } ?>

                <?php if(isset($_SESSION['idUsuario'])) { ?>
                <li class="nav-item">
                    <a class="nav-link btn-outline-danger" href="\corretora\View\login\user\logout.php">Sair</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <div class="container-fluid" style="padding-top: 100px !important;">
