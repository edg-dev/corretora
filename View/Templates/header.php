<!doctype html>
<html>
    <head> 
    <?php
    session_start();
    ?> 
        
        <meta charset="ISO-8859-1"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

        <title>Corretora</title>

        <!-- CSS  -->
        <link href="/corretora/Config/CSS/style.css" type="text/css" rel="stylesheet">
        <link href="/corretora/Config/Bootstrap/bootstrap.css" type="text/css" rel="stylesheet">

        <!-- JavaScript  -->
        
        <script src="/corretora/Config/JS/bootstrap.bundle.min.js"></script>
        <script src="/corretora/Config/JS/jquery-3.2.1.min.js"></script>
        <script src="/corretora/Config/JS/bootstrap.min.js"></script>
        <script src="/corretora/Config/JS/bootstrap.js"></script>
        <script src="/corretora/Config/JS/init.js"></script>
        
        <!-- Dropzonejs -->
        <script src="/corretora/Config/JS/dropzone.js"></script>
        <link href="/corretora/Config/CSS/dropzone.css" type="text/css" rel="stylesheet">
        <link href="/corretora/Config/CSS/basic.css" type="text/css" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="/corretora/Config/CSS/FontAwesome/css/fontawesome.min.css" type="text/css" rel="stylesheet">

    </head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/corretora/index.php">(Logo)</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active" >
                    <a class="nav-link" href="/corretora/index.php">Inicio<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/corretora/View/buscar/index.php">Buscar</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/corretora/View/Pages/anunciar.php">Anunciar</a>
                </li>

                

                <li class="nav-item">
                    <a class="nav-link" href="/corretora/View/administrador/index.html">Adm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/corretora/View/login/user/user.php">Usuario </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cadastrar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        
                        <a class="dropdown-item" href="/corretora/View/Cadastro/PessoaFisica.php">Pessoa Física</a>
                        <a class="dropdown-item" href="/corretora/View/Cadastro/PessoaJuridica.php">Pessoa Jurídica</a>
                        <a class="dropdown-item" href="/corretora/View/Cadastro/Imovel.php">Imóvel</a>

                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/corretora/View/Templates/template_padrao/index.html">Template Teste</a>
                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/corretora/View/login/user/index.php">Entrar</a>
                </li>
               

            </ul>
        </div>
    </nav>
    <div class="container" style="padding-top: 60px !important;">
