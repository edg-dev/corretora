<?php include_once "templates/header.php"; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/AnuncioModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PrioridadeModel.php";

    $anuncio = new AnuncioModel();
    $anuncioAP = $anuncio->getAnunciosAprovacao();

    $prioridadeModel = new PrioridadeModel();
    $prioridades = $prioridadeModel->getPrioridades();
?>

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Seus anuncios</a>
          </li>
          <li class="breadcrumb-item active">Anúncios que estão em aprovação</li>
        </ol>

        <table class="table">
            <thead>
                <tr>
                    <th>✪</th>
                    
                    <th>Email</th>
                    <th>Tipo de Anúncio</th>
                    <th>Prioridade</th>
                    <th>Detalhes</th>
                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($anuncioAP as $result) { ?>
                <td id="idAnuncioval" data-idanuncio="<?php echo $result['idAnuncio'];?>"> <?php echo $result['idAnuncio'];?></td>
                <td id="idImovelval" data-idimovel="<?php echo $result['idimovel'];?>"> <?php echo $result['idimovel'];?></td>
                <td> <?php echo $result['nome'];?></td>
                <td> <?php echo $result['usuario'];?></td>
                <td> <?php echo $result['descricaoTransacao'];?></td>
                <td>
                    <select id="prioridade" class="form-control" name="prioridade" required>
                        <option value="0">Nenhuma</option>
                        <?php foreach($prioridades as $prioridade){?>
                        <option id="idPrioridade" data-prioridade="<?php echo $prioridade['idPrioridade'];?>" value="<?php echo $prioridade['idPrioridade'];?>"> 
                            <?php echo $prioridade['descricaoPrioridade'];?> </option>
                        <?php } ?>
                    </select>
                </td>
                <td> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-info-circle"></i> Detalhes
                    </button> 
                </td>
                
<!-- Modal detalhes -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
                <td> 
                    <button type="button" class="btn btn-success" onclick="aprovarAnuncio();">
                        <i class="fa fa-clipboard-check"></i> Aprovar
                    </button> 
                </td>
                <td> 
                    <button type="button" class="btn btn-danger" onclick="reprovarAnuncio();">
                        <i class="fa fa-flag"></i> Reprovar
                    </button> 
                </td>  
            </tbody>
            <?php } ?>
        </table>

<script type="text/javascript">




</script>

<?php include_once "templates/footer.php"; ?>