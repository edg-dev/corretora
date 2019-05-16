<?php include 'View/Templates/header.php'; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";
    
    $imovelModel = new ImovelModel();
    $imoveis = $imovelModel->getAllImovel();

?>
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


                        <!-- Page Content -->
                    <div class="container">

                <!-- Page Heading -->
                <h1 class="my-4">Anúncios
                
                </h1>

                <!-- Project One -->
                <?php foreach($imoveis as $imovel){?>
                <div class="row">
                <div class="col-md-7">
                    <a href="#">
                    <img class="img-fluid rounded mb-3 mb-md-0" src="http://placehold.it/700x300" alt="">
                    </a>
                </div>
                <div class="col-md-5">
                    <p> 
                        <?php echo $imovel['descricaoTransacao'];?>
                        <?php echo $imovel['descricaoTipoImovel'];?>
                        <?php echo $imovel['precoImovel'];?>
                        <?php echo $imovel['areaUtil'];?>
                        <?php echo $imovel['areaTotal'];?>
                        <?php echo $imovel['quantQuarto'];?>
                        <?php echo $imovel['quantSuite'];?>
                        <?php echo $imovel['quantVagaGaragem'];?>
                        <?php echo $imovel['quantBanheiro'];?>
                        <?php echo $imovel['descricaoImovel'];?>

                    </p>                
                    <a class="btn btn-primary" href="#">Detalhes</a>
  
                </div>
                </div>
                <!-- /.row -->
                <hr>
                <?php } ?>

                <!-- Pagination -->

                <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                    </a>
                </li>
                </ul>

                </div>
                <!-- /.container -->
    </div>
    </div>

<?php include "View/Templates/footer.php"; ?>