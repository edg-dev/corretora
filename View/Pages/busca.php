<?php include '../Templates/header.php'; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImagensImovelModel.php";

    $imovelModel = new ImovelModel();
    $buscasImovel = $imovelModel->getBuscaImovel();

    $imagensImovelModel = new ImagensImovelModel();
    $imagens = $imagensImovelModel->getAllImagens();

?>
      
                <!-- Page Content -->
                <div class="container">

                <!-- Page Heading -->
                <h1 class="my-4">Anúncios</h1>
                    
                <!-- Project One -->
                <?php $count = 0; ?>
                <?php foreach($buscasImovel as $imovel){?>

                <div class="row">
                <div class="col-md-7">
                    <a href="#">
                    <!-- TESTE TESTE TESTE TESTE -->
                    <?php foreach($imagens as $imagem){?>
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

<?php include "../Templates/footer.php"; ?>