<?php include '../../Templates/header.php'
?>
<?php
    $idUsuario = $_SESSION['idUsuario'];

    $acao = "update";

    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/AnuncioModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/ImagensImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/UsuarioModel.php";



    $imagensImovelModel = new ImagensImovelModel();
    $anuncioModel = new AnuncioModel();
    $anuncios = $anuncioModel->countAnunciosAtivosUser($idUsuario);
    $anunciosAP = $anuncioModel->countAnunciosAprovacaoUser($idUsuario);
    $allAnuncios = $anuncioModel->getAnunciosByUser($idUsuario);
    
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/execRotina.php";
    
    $rotina = new execRotina();
    $rotina->execRotina();

?>

<?php

include('verifica_login.php');
include('conexao.php');



?>

<head>
  <title>Usuário</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>


<hr>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1>Olá, você esta logado com <strong> <?php echo $_SESSION['usuario'];?></strong></h1></div>
    	<div class="col-sm-2">
            <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign">
            <a href="\corretora\View\login\user\logout.php" class="pull-right"></i> Sair</a></button>
        </div>
        
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              

      <div class="text-center">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        
      </div></hr><br>

          <ul class="list-group">
            <li class="list-group-item text-muted">Geral</li>
            <li class="list-group-item text-right"><span  class="pull-left" ><div class="mr-5"><?php echo intVal($anuncios['total']); ?> <strong>Anúncios ativos.</strong></div></span> </li>        
            <li class="list-group-item text-right"><span class="pull-left"><div class="mr-5"> <?php echo intVal($anunciosAP['total']); ?> <strong>Anúncios para aprovação.</strong></div></span></li>
            
          </ul> 
               
                    
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="#anuncios">Anúncios</a>                
                </li>    

                <li class="nav-item">
                    <a class="nav-link" href="#home">Pessoal</a>                
                </li>     
            </ul>

            <div class="tab-content">
                <div class="tab-pane active container" id="anuncios">
                <hr>      
                    <h4>Seus Anúncios</h4>
                    <table class="table"> 
                        <thead>
                            <tr>
                                <th>✪</th>
                                <th>✪</th>
                                <th>Tipo de Anúncio</th>
                                <th>Tipo de Imóvel</th>
                                <th>Endereço</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($allAnuncios as $anuncioUser) { ?>
                            <td data-idanuncio="<?php echo $anuncioUser['idAnuncio']?>"><?php echo $anuncioUser['idAnuncio']?></td>
                            <td data-idimovel="<?php echo $anuncioUser['idimovel']?>"><?php echo $anuncioUser['idimovel']?></td>
                            <td><?php echo $anuncioUser['descricaoTransacao'];?></td>
                            <td><?php echo $anuncioUser['descricaoTipoImovel'];?></td>
                            <td> <?php echo $anuncioUser['logradouro'];?>, número <?php echo $anuncioUser['numero'];?> <?php echo $anuncioUser['complemento'];?>
				                <br>
				                <?php echo $anuncioUser['nomeBairro'];?>, <?php echo $anuncioUser['nomecidade'];?>   
				                <br>     
                                CEP: <?php echo $anuncioUser['descricaoCep'];?>
                            </td>
                            <?php if($anuncioUser['verificado'] == 1){?> <td>Verificado</td> <?php } ?>
                            <?php if($anuncioUser['verificado'] == 0){?> <td>Em Aprovação</td> <?php } ?>
                            <td>
                                <?php if($anuncioUser['verificado'] == 1){ ?>
                                    <button type="button" class="btn btn-danger" onclick="reprovarAnuncio();">
                                        <i class="fa fa-flag"></i> Deletar Anúncio
                                    </button>
                                <?php } else { ?> 
                                    <button type="button" class="btn btn-danger" disabled>
                                        <i class="fa fa-flag"></i> Aguarde Aprovação
                                    </button>
                                <?php } ?>
                            </td>
                        </tbody>
                        <?php } ?>
                    </table>              
                <hr>
                </div>

                <div class="tab-pane container" id="home">
                    <hr>
                    <form class="form" action="/corretora/Controller/usuarioController.php?acao=update&id=<?php echo $idUsuario?>" method="POST" id="registrationForm">
        
                        <div class="form-group">
                            
                        </div>
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="email"><h4>Senha Atual</h4></label>
                                <input type="password" class="form-control" name="senha"  placeholder="Senha atual" title="Insira sua senha atual.">
                            </div>
                        </div>
                        <div class="form-group">
                            
                            
                        </div>
                        <div class="form-group">
                            
                        
                            <div class="col-xs-6">
                                <label for="password" ><h4>Nova Senha</h4></label>
                                <input type="password" class="form-control" name="senha_nova"  placeholder="Nova senha" title="Insera sua nova senha.">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-xs-12">
                                    <br>
                                    <button  class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign">
                                    <a class="pull-right"></i> Salvar</a></button>
                                    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Refazer</button>
                                </div>
                        </div>
                    </form>
                    <hr>
                </div>
            </div>

       



        </div><!--/col-9-->
    </div><!--/row-->
<script>
$(document).ready(function(){
  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });
});

function reprovarAnuncio(){

$(document).on('click', '.btn-danger', function(e) {
    e.preventDefault;
    var idAnuncio = $(this).closest('tr').find('td[data-idanuncio]').data('idanuncio');
    var idImovel = $(this).closest('tr').find('td[data-idimovel]').data('idimovel');
    var url = '/corretora/View/administrador/controllers/adminController.php?acao=reprovar';
    alert(idAnuncio);
    $.ajax({
        url: url,
        type: "POST",
        data: {
            idAnuncio: idAnuncio,
            idImovel: idImovel,
        },
        dataType: "html",
        success: function (data) {
            alert("Anúncio reprovado com sucesso!");
            window.location.href="/corretora/View/login/user/user.php";    
        }
    });
});
}
</script>