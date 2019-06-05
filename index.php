<?php include 'View/Templates/header.php'; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImagensImovelModel.php";
    
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EstadoModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TransacaoModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TipoImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/BannerModel.php";

    $estadoModel = new EstadoModel();
    $estados = $estadoModel->getAllEstado();

    $transacaoModel = new TransacaoModel();
    $transacoes = $transacaoModel->getAllTransacao();
    
    $tipoImovelModel = new TipoImovelModel();
    $tiposDeImovel = $tipoImovelModel->getAllTipoImovel();

    $imovelModel = new ImovelModel();
    $imoveis = $imovelModel->getAllImovel();

    $imagensImovelModel = new ImagensImovelModel();
    $imagens = $imagensImovelModel->getAllImagens();

    $bannerModel = new BannerModel();
    $banner = $bannerModel->getRandomBanner();
    $banner2 = $bannerModel->getRandomBanner();
?>
<div style="padding-top: 20px; text-align: center;">
    <h3>Quer anunciar seu imóvel ou procurar um negócio? Você veio ao lugar certo!</h3>
</div>
<div class="row" style="padding-top: 60px;">
        <div class="col-md-4">

        <!-- Search Widget -->
        <form id="buscaImovel" method="GET" action="/corretora/View/Pages/busca.php" >
        <div class="card my-12">
        <h5 class="card-header">Pesquise seu imóvel:</h5>
        <div class="card-body">
            <div class="input-group">

            <div class="form-group">
                <b><label for="transacao">Você deseja alugar ou comprar um imóvel?</label></b>
            <select id="transacao" class="form-control" name="transacao" >
                    <?php foreach($transacoes as $transacao){?>
                    <option value="<?php echo $transacao['idTransacao'];?>"> <?php echo $transacao['descricaoTransacao'];?> </option>
                    <?php } ?>
            </select>
            </div>

            <div class="form-group">
                <b><label for="tipoDeImovel">Que tipo de imóvel você proucura?</label></b>
            <select id="tipoDeImovel" class="form-control" name="tipoDeImovel" >
                    <?php foreach($tiposDeImovel as $tipoImovel){?>
                    <option value="<?php echo $tipoImovel['idTipoImovel'];?>"> <?php echo $tipoImovel['descricaoTipoImovel'];?> </option>
                    <?php } ?>
            </select>
            </div>

            <div class="form-group">
                <b><label for="endereco">Endereço:</label></b>
                    <select id="estado" class="form-control" name="estado" >
                        <?php foreach($estados as $estado){?>
                        <option value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                        <?php }?>
                    </select>
                <input type="text" class="form-control" id="cidade" placeholder="Digite a cidade aqui" name="cidade" >
                <input type="text" class="form-control" id="bairro" placeholder="Digite o bairro aqui" name="bairro" >
            </div>
           </div>
                <div class="form-group">
                    <button type="submit" value="buscar" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                </div>

            </div>
            </div>
        </form>
        </div>
        
    
    <div class="col-md-8">

    <div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="http://www.verdemarimoveis.com/smart2/modulos/casas/imagens/grande/acapulco_1181-154-57208.jpg"  alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>Primeiro Slide</h5>
            <p>Casa com Piscina.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="https://s01.video.glbimg.com/x720/6166808.jpg" alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>Segunda Slide</h5>
            <p>Casa Luxuosa.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="https://thumbs.jusbr.com/filters:format(webp)/imgs.jusbr.com/publications/artigos/451460204/images/condominio11493087337.jpg"  alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>Terceiro Slide</h5>
            <p>Condominio.</p>
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
</div>
<!-- Banner 1 -->
<?php if($banner != false) { ?>
    <div class="offset-md-2 col-md-8" style="padding-top: 20px;">
    <a href="<?php echo $banner['link']?>">
        <img class="d-block w-100 img-fluid" style="width:450px;height:150px;" src="/corretora/Files/banners/<?php echo $banner['imagemBanner']?>" alt="Anuncie aqui">
    </a>
    </div>
<?php } ?>
                <!-- Page Content -->
                <div class="container">

                <!-- Page Heading -->
                <h1 class="my-4">Anúncios</h1>
                    
                <!-- Project One -->
                <?php $count = 0; ?>
                <?php foreach($imoveis as $imovel){?>

                <div class="row">
                <div class="col-md-7">
                    <a href="#">
                    <!-- TESTE TESTE TESTE TESTE -->
                    <?php
                        $idImovel = $imovel['idImovel'];
                        $res = $imagensImovelModel->getImagemImovelIndex($idImovel);
                        
                        foreach($res as $imagem){?>
                        <img class="img-fluid" style="width:750px;height:300px;" src="Files/<?php echo $imagem;?>"  >
                    <?php } ?> 
                    <!-- TESTE TESTE TESTE TESTE -->
                    </a>
                </div>
                <div class="col-md-5">
                        <p><b>Transação:</b>      
                        <?php echo $imovel['descricaoTransacao'];?>
                        
                        <b>um(a)</b>
                        <?php echo $imovel['descricaoTipoImovel'];?></p>

                        <p><b>Preço: R$</b>        
                        <?php echo $imovel['precoImovel'];?></p>

                        <p><b>Área útil:</b>
                        <?php echo $imovel['areaUtil'];?> M² ;

                        <b>Área total:</b>
                        <?php echo $imovel['areaTotal'];?> M² ;</p>

                        <p><img src="https://img.icons8.com/windows/32/000000/bed.png" title="Quantidade de Quartos:">:
                        <?php echo $imovel['quantQuarto'];?> quartos </p>

                        <p><img src="https://img.icons8.com/metro/32/000000/shower-and-tub.png" title="Quantidade de Suítes:">:
                        <?php echo $imovel['quantSuite'];?> suítes </p>

                        <p><img src="https://img.icons8.com/ios/32/000000/car.png" title="Quantidade de Vagas na Garagem:">
                        <?php echo $imovel['quantVagaGaragem'];?> vagas </p>

                        <p><img src="https://img.icons8.com/ios/32/000000/shower.png" title="Quantidade de Banheiros:">
                        <?php echo $imovel['quantBanheiro'];?> banheiros </p>

                        <!-- Modal --> 

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo<?php echo $count; ?>">
                            <i class="fa fa-info-circle"></i> Detalhes
                        </button>

                        <button type="button" class="btn btn-success" 
                        onclick="window.location.href='/corretora/View/Pages/anuncio.php?id=<?php echo $imovel['idImovel'];?>'">
                            <i class="fa fa-arrow-right"></i> Visualizar
                        </button>

                        <div class="modal fade" id="modalExemplo<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalhes e Localização</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <p><b>Estado:</b>
                                <?php echo $imovel['descricaoEstado'];?>.</p>

                                <p><b>Cidade:</b>
                                <?php echo $imovel['nomeCidade'];?>.</p>

                                <p><b>Bairro:</b>
                                <?php echo $imovel['nomeBairro'];?>.</p>

                                <p><b>Rua:</b>
                                <?php echo $imovel['logradouro'];?>.</p>

                                <p><b>Número:</b>
                                <?php echo $imovel['numero'];?>.</p>                              
                               
                                <p><b>Descrição do Imovel:</b>
                                <?php echo $imovel['descricaoImovel'];?>.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                            </div>
                        </div>
                        </div>

                </div>
                </div>
                <!-- /.row -->
                <hr>
                <?php $count++; ?>
                <?php } ?> <!-- foreach fecha aki --> 

                </div>
                <!-- /.container -->
    </div>
<!-- Banner 2-->
<?php if($banner2 != false) { ?>
    <div class="offset-md-2 col-md-8" style="padding-top: 20px; padding-bottom: 20px;">
    <a href="<?php echo $banner2['link']?>">
        <img class="d-block w-100 img-fluid" style="width:450px;height:150px;" src="/corretora/Files/banners/<?php echo $banner2['imagemBanner']?>" alt="Anuncie aqui">
    </a>
    </div>
<?php } ?>
<?php include "View/Templates/footer.php"; ?>