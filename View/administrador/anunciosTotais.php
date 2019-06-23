<?php include_once "templates/header.php"; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/AnuncioModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PrioridadeModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TelefoneModel.php";
    
    $anuncio = new AnuncioModel();
    $anuncioAP = $anuncio->getAllAnuncios();
    
    $telefoneModel = new TelefoneModel();
?>

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Anúncios totais</li>
        </ol>

        <table class="table">
            <thead>
                <tr>
                    <th>✪</th>
                    <th>id Imovel</th>
                    <th>Anunciante</th>
                    <th>Email</th>
                    <th>Telefones</th>
                    <th>Tipo de Anúncio</th>
                    <th>Detalhes</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php $count = 0; ?>
                <?php foreach($anuncioAP as $result) { ?>

                <td id="idAnuncioval" data-idanuncio="<?php echo $result['idAnuncio'];?>"> <?php echo $result['idAnuncio'];?></td>
                <td id="idImovelval" data-idimovel="<?php echo $result['idimovel'];?>"> <?php echo $result['idimovel'];?></td>
                <td> <?php echo $result['nome'];?></td>
                <td> <?php echo $result['usuario'];?></td>
                <td>
                <?php 
                $idPessoa = $result['idUsuario'];
                $telefones = $telefoneModel->getTelefonesById($idPessoa);
                foreach($telefones as $telefone) { ?>
                <?php echo $telefone['telefone'];?> <br>
                <?php } ?>
                </td>
                <td> <?php echo $result['descricaoTransacao'];?></td>
                <td> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo<?php echo $count; ?>"
                        onclick="getIdImovel();">
                        <i class="fa fa-info-circle" ></i> Detalhes
                    </button> 
                </td>
                
				<!-- Modal detalhes -->
				<div class="modal fade" id="modalExemplo<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Anúncio</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
                          
				          <h4>Endereço completo do imóvel:</h4>
				          <br> 
				          <?php echo $result['logradouro'];?>, número <?php echo $result['numero'];?> <?php echo $result['complemento'];?>
				          <br>
				          <?php echo $result['nomeBairro'];?>, <?php echo $result['nomecidade'];?>   
				          <br>     
                          CEP: <?php echo $result['descricaoCep'];?>
                          <input type="hidden" class="form-control" id="idImovelVisualizacao2" name="idImovelVisualizacao2">
				      </div>
				      <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="irParaAnuncio();">
                            <i class="fa fa-arrow-right"></i> Visualizar anúncio
                        </button>
				        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
				      </div>
				    </div>
				  </div>
				</div>
				
                <td> 
                    <button type="button" class="btn btn-danger" onclick="reprovarAnuncio();">
                        <i class="fa fa-flag"></i> Excluir Anúncio
                    </button> 
                </td>  
            </tbody>
            <?php $count++; ?>
            <?php } ?>
        </table>

<script type="text/javascript">


function reprovarAnuncio(){

    $(document).on('click', '.btn-danger', function(e) {
        e.preventDefault;
        var idAnuncio = $(this).closest('tr').find('td[data-idanuncio]').data('idanuncio');
        var idImovel = $(this).closest('tr').find('td[data-idimovel]').data('idimovel');
        $.ajax({
            url: 'controllers/adminController.php?acao=reprovar',
            type: "POST",
            data: {
                idAnuncio: idAnuncio,
                idImovel: idImovel,
            },
            dataType: "html",
            success: function (data) {
                alert("Anúncio excluido com sucesso!");
                window.location.href="anuncios.php";    
            }
        });
    });
}

function irParaAnuncio(){
    var idImovel = $("#idImovelVisualizacao2").val();
    window.location.href='/corretora/View/Pages/anuncio.php?id=' + idImovel;
}

function getIdImovel(){
    $(document).on('click', '.btn-primary', function(e) {
        var idImovel = $(this).closest('tr').find('td[data-idimovel]').data('idimovel');
        $('.modal-body #idImovelVisualizacao2').val( idImovel );
    });
}

</script>

<?php include_once "templates/footer.php"; ?>