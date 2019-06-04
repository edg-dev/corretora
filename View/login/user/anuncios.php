<?php include '../../Templates/header.php'
?>
<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/AnuncioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PrioridadeModel.php";

$anuncio = new AnuncioModel();
$anuncioAP = $anuncio->getAnunciosAprovacao();
$listar = $anuncio->getAnunciosAprovacao();

$prioridadeModel = new PrioridadeModel();
$prioridades = $prioridadeModel->getPrioridades();
?>

<?php

include('verifica_login.php');
?><link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
  <title>Usuário</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<hr>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1>Para voltar <strong> </strong></h1></div>
    	<div class="col-sm-2">
        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign">
        <a href="\corretora\View\login\user\user.php" class="pull-right"></i> Voltar</a></button>
        </div>
        
    </div>           
        <h2></h2>
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
                <?php foreach($listar as $result) { ?>
                <td id="idAnuncioval" data-idanuncio="<?php echo $result['idAnuncio'];?>"> <?php echo $result['idAnuncio'];?></td>
                <td id="idImovelval" data-idimovel="<?php echo $result['idimovel'];?>"> <?php echo $result['idimovel'];?></td>
                <td> <?php echo $result['nome'];?></td>
                <td> <?php echo $result['usuario'];?></td>
                <td> <?php echo $result['descricaoTransacao'];?></td>
                <td>
                    
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
                 
            </tbody>
            <?php } ?>
        </table>

<script type="text/javascript">

</script>

            		
               	
                  <hr>
                  
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->


        