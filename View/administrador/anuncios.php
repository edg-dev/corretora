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
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Anúncios para aprovação</li>
        </ol>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>id Imovel</th>
                    <th>Anunciante</th>
                    <th>Email</th>
                    <th>Tipo de Anúncio</th>
                    <th>Prioridade</th>
                    <th>Detalhes</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($anuncioAP as $result) { ?>
                <td id="teste" value="<?php echo $result['idAnuncio'];?>"> <?php echo $result['idAnuncio'];?></td>
                <td id="idImovelval" value="<?php echo $result['idimovel'];?>"> <?php echo $result['idimovel'];?></td>
                <td> <?php echo $result['nome'];?></td>
                <td> <?php echo $result['usuario'];?></td>
                <td> <?php echo $result['descricaoTransacao'];?></td>
                <td>
                    <select id="prioridade" class="form-control" name="prioridade" required>
                        <option selected>Nenhuma</option>
                        <?php foreach($prioridades as $prioridade){?>
                        <option value="<?php echo $prioridade['idPrioridade'];?>"> <?php echo $prioridade['descricaoPrioridade'];?> </option>
                        <?php } ?>
                    </select>
                </td>
                <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Detalhes</button> </td>
                <td> 
                    <button type="button" class="btn btn-success" onclick="aprovarAnuncio();">
                        Aprovar
                    </button> </td>  
            </tbody>
            <?php } ?>
        </table>

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
<script type="text/javascript">

function aprovarAnuncio(){
    debugger
    var idAnuncio = $("#teste").val();
    alert(idAnuncio);
    var idImovel = $("#idImovelval").val();
    var idPrioridade = $("#idPrioridade").val();

    $.ajax({
        url: 'controllers/adminController.php?acao=updateVerificado',
        type: "POST",
        data: {
            idAnuncio: idAnuncio,
            idImovel: idImovel,
            idPrioridade: idPrioridade
        },
        dataType: "json",
        success: function (data) {
            notificar(data.message, data.type);
            if (data.type == "success") {
                alert("Anúncio aprovado com sucesso!");
                window.location.href="anuncios.php";
            }
        }
    })
}

</script>

<?php include_once "templates/footer.php"; ?>