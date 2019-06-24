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

    $imovelModel = new ImovelModel();
    $imoveisRamdom = $imovelModel->getImovelAltoRamdom();

    $imovelModel = new ImovelModel();
    $imoveisRamdomUno = $imovelModel->getImovelAltoRamdomUno();

?>
<script>
function Mudarestado(el) {
  var display = document.getElementById(el).style.display;
  if (display == "none")
    document.getElementById(el).style.display = 'block';
  else
    document.getElementById(el).style.display = 'none';
}
</script>

<div style="padding-top: 20px; text-align: center;">
    <h2>
        QUER ANUNCIAR OU PROCURA UM IMÓVEL IDEAL PARA SER SEU NOVO LAR, INVESTIMENTO OU NEGÓCIO?
        VOCÊ ESTÁ NO LUGAR CERTO!<br>
        Gaste seu tempo  organizando a mudança, deixa que a busca nós te ajudamos!
    </h2>
</div>

<?php
if ($imoveisRamdom == null ) { ?>
<div class="row" style="padding-top: 60px;">
    <div class="offset-md-2 col-md-8">

        <!-- Search Widget -->
        <form id="buscaImovel" method="GET" action="/corretora/View/Pages/busca.php" >
        <div class="card my-12">
        <h5 class="card-header">Pesquise seu imóvel:</h5>
        <div class="card-body">
            <div class="input-group">

            <div class="form-group">
                <b><label for="transacao">O que você deseja?</label></b>
            <select id="transacao" class="form-control" name="transacao" >
                <option selected value="">Selecione a opção:</option>
                    <?php foreach($transacoes as $transacao){?>                
                        <?php if($transacao['descricaoTransacao'] == "Vender") { ?>
                            <option value="<?php echo $transacao['idTransacao'];?>"> Comprar </option>
                        <?php } else { ?>
                            <option value="<?php echo $transacao['idTransacao'];?>"> <?php echo $transacao['descricaoTransacao'];?> </option>
                        <?php } ?>
                    <?php } ?>
            </select>
            </div>
            <hr>
            <div class="form-group">
                <b><label for="tipoDeImovel">Que tipo de imóvel você proucura?</label></b>
            <select id="tipoDeImovel" class="form-control" name="tipoDeImovel" >
                <option selected value="">Selecione o tipo do imóvel:</option>
                    <?php foreach($tiposDeImovel as $tipoImovel){?>
                    <option value="<?php echo $tipoImovel['idTipoImovel'];?>"> <?php echo $tipoImovel['descricaoTipoImovel'];?> </option>
                    <?php } ?>
            </select>
            </div>
            <hr>
            <div class="form-group">
                <b><label for="endereco">Endereço:</label></b>
                    <select id="estado" class="form-control" name="estado" >
                    <option selected value="">Selecione seu estado:</option>
                        <?php foreach($estados as $estado){?>
                        <option value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                        <?php }?>
                    </select>
                    <br>
                <input type="text" class="form-control" id="cidade" placeholder="Digite a cidade aqui" name="cidade" >
                <br>
                <input type="text" class="form-control" id="bairro" placeholder="Digite o bairro aqui" name="bairro" >
            </div>
           </div>

                <div class="form-group" id="minhaDiv" style="display:none">
                        <div class="form-group">
                            <label for="quantQuarto">Quartos:</label>
                            <input type="number" class="form-control" id="quantQuarto" placeholder="0" name="quantQuarto">
                        </div>
                        <div class="form-group">
                            <label for="quantSuite">Suítes:</label>
                            <input type="number" class="form-control" id="quantSuite" placeholder="0" name="quantSuite">
                        </div>
                        <div class="form-group">
                            <label for="quantVagaGaragem">Vagas de garagem:</label>
                            <input type="number" class="form-control" id="quantVagaGaragem" placeholder="0" name="quantVagaGaragem">
                        </div>
                        <div class="form-group">
                            <label for="quantBanheiro">Banheiros:</label>
                            <input type="number" class="form-control" id="quantBanheiro" placeholder="0" name="quantBanheiro">
                        </div>
                        <div class="form-group">
                            <label for="idImovel">Código do imóvel:</label>
                            <input type="number" class="form-control" id="idImovel" placeholder="0" name="idImovel">
                        </div>
                
                </div>
                    <div class="form-group">
                    <button class="btn btn-warning" type="button" onclick="Mudarestado('minhaDiv')">Busca Avançada</button>
                    </div>

                <div class="form-group">
                    <button type="submit" value="buscar" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                </div>

            </div>   
            <br>
            <br>
            <hr>
            </div>
        </form>
    </div>
</div>

    <?php
    }
    else { 
    ?>

<div class="row" style="padding-top: 60px;">
        <div class="col-md-4">

        <!-- Search Widget -->
        <form id="buscaImovel" method="GET" action="/corretora/View/Pages/busca.php" >
        <div class="card my-12">
        <h5 class="card-header">Pesquise seu imóvel:</h5>
        <div class="card-body">
            <div class="input-group">

            <div class="form-group">
                <b><label for="transacao">O que você deseja?</label></b>
            <select id="transacao" class="form-control" name="transacao" >
                <option selected value="">Selecione a opção:</option>
                    <?php foreach($transacoes as $transacao){?>                
                        <?php if($transacao['descricaoTransacao'] == "Vender") { ?>
                            <option value="<?php echo $transacao['idTransacao'];?>"> Comprar </option>
                        <?php } else { ?>
                            <option value="<?php echo $transacao['idTransacao'];?>"> <?php echo $transacao['descricaoTransacao'];?> </option>
                        <?php } ?>
                    <?php } ?>
            </select>
            </div>
            <hr>
            <div class="form-group">
                <b><label for="tipoDeImovel">Que tipo de imóvel você proucura?</label></b>
            <select id="tipoDeImovel" class="form-control" name="tipoDeImovel" >
                <option selected value="">Selecione o tipo do imóvel:</option>
                    <?php foreach($tiposDeImovel as $tipoImovel){?>
                    <option value="<?php echo $tipoImovel['idTipoImovel'];?>"> <?php echo $tipoImovel['descricaoTipoImovel'];?> </option>
                    <?php } ?>
            </select>
            </div>
            <hr>
            <div class="form-group">
                <b><label for="endereco">Endereço:</label></b>
                    <select id="estado" class="form-control" name="estado" >
                    <option selected value="">Selecione seu estado:</option>
                        <?php foreach($estados as $estado){?>
                        <option value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                        <?php }?>
                    </select>
                    <br>
                <input type="text" class="form-control" id="cidade" placeholder="Digite a cidade aqui" name="cidade" >
                <br>
                <input type="text" class="form-control" id="bairro" placeholder="Digite o bairro aqui" name="bairro" >
            </div>
           </div>

           <div class="form-group" id="minhaDiv" style="display:none">
                <div class="form-group">
                    <label for="quantQuarto">Quartos:
                    <input type="number" class="form-control" id="quantQuarto" placeholder="0" name="quantQuarto"></label>

                    <label for="quantSuite">Suítes:
                    <input type="number" class="form-control" id="quantSuite" placeholder="0" name="quantSuite"></label>
                </div>
                <div class="form-group">
                    <label for="quantVagaGaragem">Vagas de garagem:
                    <input type="number" class="form-control" id="quantVagaGaragem" placeholder="0" name="quantVagaGaragem"></label>
                </div>
                <div class="form-group">
                    <label for="quantBanheiro">Banheiros:
                    <input type="number" class="form-control" id="quantBanheiro" placeholder="0" name="quantBanheiro"></label>
                </div>
                <div class="form-group">
                    <label for="idImovel">Código do imóvel:
                    <input type="number" class="form-control" id="idImovel" placeholder="0" name="idImovel"></label>
                </div>

           
           </div>
            <div class="form-group">
            <button class="btn btn-warning" type="button" onclick="Mudarestado('minhaDiv')">Busca Avançada</button>
            </div>
                <div class="form-group">
                    <button type="submit" value="buscar" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                </div>

            </div>   
            <hr>
            </div>
        </form>
        </div>
        
    
    <div class="col-md-8">

    <div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner">

    <?php foreach($imoveisRamdomUno as $imovelRamdomUno){?>
        <div class="carousel-item active">
                    <a onclick="window.location.href='/corretora/View/Pages/anuncio.php?id=<?php echo $imovelRamdomUno['idImovel'];?>'">    
                        <?php
                            $idImovel = $imovelRamdomUno['idImovel'];
                            $res = $imagensImovelModel->getImagemImovelIndex($idImovel);

                        if(empty($res)){
                        ?>
                            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="Files/no_image.png">
                        <?php } 

                        foreach($res as $imagem){ ?>
                            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="Files/<?php echo $imagem;?>"  >
                        <?php } ?>
                    </a>
            <div class="carousel-caption d-none d-md-block">
                    <h5><b><u>
                             <?php echo $imovelRamdomUno['descricaoTransacao'];?>
                <b>um(a)</b> <?php echo $imovelRamdomUno['descricaoTipoImovel'];?>
                    </u></b></h5>
            <p></p>
            </div>
        </div>
        <?php } ?> <!-- foreach uno fecha aki --> 

        <?php foreach($imoveisRamdom as $imovelRamdom){?>
        <div class="carousel-item">
                    <a onclick="window.location.href='/corretora/View/Pages/anuncio.php?id=<?php echo $imovelRamdom['idImovel'];?>'">    
                        <?php
                            $idImovel = $imovelRamdom['idImovel'];
                            $res = $imagensImovelModel->getImagemImovelIndex($idImovel);

                        if(empty($res)){
                        ?>
                            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="Files/no_image.png">
                        <?php } 

                        foreach($res as $imagem){ ?>
                            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="Files/<?php echo $imagem;?>"  >
                        <?php } ?>
                    </a>
            <div class="carousel-caption d-none d-md-block">
                    <h5><b><u>
                             <?php echo $imovelRamdom['descricaoTransacao'];?>
                <b>um(a)</b> <?php echo $imovelRamdom['descricaoTipoImovel'];?>
                    </u></b></h5>
            <p></p>
            </div>
        </div>
        <?php } ?> <!-- foreach ramdom fecha aki --> 

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
<hr>

</div>    <!-- finaliza o else --> 
<?php
} 
?>
                <!-- Page Content -->
                <div class="container">

                <!-- Page Heading -->
                <h1 class="my-4">Anúncios</h1>
                    
                <!-- Project One -->
                <?php $count = 0; ?>
                <?php foreach($imoveis as $imovel){?>

                <div class="row">
                <div class="col-md-7">

                        <?php
                            $idImovel = $imovel['idImovel'];
                            $res = $imagensImovelModel->getImagemImovelIndex($idImovel);

                        if(empty($res)){
                        ?>
                            <img class="img-fluid" style="width:750px;height:300px;" src="Files/no_image.png">
                        <?php } 

                        foreach($res as $imagem){ ?>
                            <img class="img-fluid" style="width:750px;height:300px;" src="Files/<?php echo $imagem;?>"  >
                        <?php } ?>  
                </div>
                <div class="col-md-5">

                        <p><b>Código do Imóvel: </b>      
                        <?php echo $imovel['idImovel'];?></p>

                        <p><b>Transação:</b>      
                        <?php echo $imovel['descricaoTransacao'];?>
                        
                        <b>um(a)</b>
                        <?php echo $imovel['descricaoTipoImovel'];?>.</p>

                        <p><b>Preço: R$</b> 
                        <?php if($imovel['precoImovel'] == null || $imovel['precoImovel'] == 0) { 
                             echo "Valor a negociar";
                        } else {
                            echo $imovel['precoImovel'];
                        }?></p>

                        <p><b>Área útil:</b>
                        <?php echo $imovel['areaUtil'];?> M² &nbsp

                        <b>Área total:</b>
                        <?php echo $imovel['areaTotal'];?> M² </p>

                        <p><img src="https://img.icons8.com/windows/32/000000/bed.png" title="Quantidade de Quartos:">:
                        <?php echo $imovel['quantQuarto'];?> quarto(s) &nbsp

                        <img src="https://img.icons8.com/metro/32/000000/shower-and-tub.png" title="Quantidade de Suítes:">:
                        <?php echo $imovel['quantSuite'];?> suíte(s) </p>

                        <p><img src="https://img.icons8.com/ios/32/000000/car.png" title="Quantidade de Vagas na Garagem:">:
                        <?php echo $imovel['quantVagaGaragem'];?> vaga(s) &nbsp

                        <img src="https://img.icons8.com/ios/32/000000/shower.png" title="Quantidade de Banheiros:">:
                        <?php echo $imovel['quantBanheiro'];?> banheiro(s) </p>

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

                                <p><b>Estado: </b>
                                <?php echo $imovel['descricaoEstado'];?>.</p>

                                <p><b>Cidade: </b>
                                <?php echo $imovel['nomeCidade'];?>.</p>

                                <p><b>Bairro: </b>
                                <?php echo $imovel['nomeBairro'];?>.</p>

                                <p><b>Rua: </b>
                                <?php echo $imovel['logradouro'];?>.</p>

                                <p><b>Número: </b>
                                <?php echo $imovel['numero'];?>.</p>                              
                               
                                <p><b>Descrição do Imóvel: </b>
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