<!doctype html>
<html>
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

        <title>Título teste</title>

        <!-- CSS  -->
        <link href="/Projeto-Integrador-V/Config/Bootstrap/bootstrap.css" type="text/css" rel="stylesheet">

        <!-- JavaScript  -->
        <script src="/Projeto-Integrador-V/Config/JS/jquery-3.2.1.min.js"></script>
        <script src="/Projeto-Integrador-V/Config/JS/bootstrap.js"></script>
        <script src="/Projeto-Integrador-V/Config/JS/init.js"></script>
      
    </head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../../index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Anúncios</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cadastros
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="View/Cadastro/PessoaFisica.php">Pessoa Física</a>
                        <a class="dropdown-item" href="View/Cadastro/PessoaJuridica.php">Pessoa Juridica</a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>
