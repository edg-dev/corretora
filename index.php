<?php include 'View/Templates/header.php'; ?>

    <h1>NOME DO SITE</h1>

    <div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://www.hostinger.com.br/tutoriais/wp-content/uploads/sites/12/2018/04/O-que-e-PHP-guia-basico.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>Primeiro Slide</h5>
            <p>Jotaro.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://media.idownloadblog.com/wp-content/uploads/2017/03/View-HTML.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>Segunda Slide</h5>
            <p>Kono DioDa.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://www.ed2go.com/binaries/content/gallery/ed2go/products/16434.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>Terceiro Slide</h5>
            <p>Praise The Sun.</p>
            </div>
        </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Voltar</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Proximo</span>
        </a>
    </div>
    </div>

<?php include "View/Templates/footer.php"; ?>