<?php include '../../Templates/header.php'
?>
<?php
    $idUsuario = $_SESSION['idUsuario'];

    $acao = "update";

    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/AnuncioModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/UsuarioModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/ImagensImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/UsuarioModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/corretora/Model/ImovelModel.php";



    $imagensImovelModel = new ImagensImovelModel();
    $anuncioModel = new AnuncioModel();
    $usuarioModel = new UsuarioModel();
    $imovelModel = new ImovelModel();

    $anuncios = $anuncioModel->countAnunciosAtivosUser($idUsuario);
    $anunciosAP = $anuncioModel->countAnunciosAprovacaoUser($idUsuario);
    $allAnuncios = $anuncioModel->getAnunciosByUser($idUsuario);
    $pedidos = $imovelModel->getAllPedidos($idUsuario);
    
    $info = $usuarioModel->userInfo($idUsuario);

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/execRotina.php";
    
    $rotina = new execRotina();
    $rotina->execRotina($idUsuario);

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
<div class="bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1>Olá, você está logado com <strong> <?php echo $_SESSION['usuario'];?></strong></h1></div>
    	<div class="col-sm-2">
            <a href="\corretora\View\login\user\logout.php" class="btn btn-danger btn-lg">Sair</a>
        </div>
        
    </div>
    <div class="row">
  		<div class="col-sm-2"><!--left col-->
              

      <div class="text-center">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        
      </div></hr><br>

          <ul class="list-group">
            <li class="list-group-item text-muted">Geral</li>
            <li class="list-group-item text-right"><span  class="pull-left" ><div class="mr-3"><?php echo intVal($anuncios['total']); ?> <strong>Anúncios ativos.</strong></div></span> </li>        
            <li class="list-group-item text-right"><span class="pull-left"><div class="mr-3"> <?php echo intVal($anunciosAP['total']); ?> <strong>Anúncios para aprovação.</strong></div></span></li>
            <?php if(isset($info['cresci'])) { ?>
            <li class="list-group-item text-right"><span  class="pull-left" ><div class="mr-3"><strong>Creci: </strong><?php echo $info['cresci'] ?></div></span> </li>        
            <?php } ?>
          </ul> 
               
                    
        </div><!--/col-3-->
    	<div class="col-sm-10">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="#anuncios">Anúncios</a>                
                </li>    

                <li class="nav-item">
                    <a class="nav-link" href="#home">Pessoal</a>                
                </li>     
                <li class="nav-item">
                    <a class="nav-link" href="#pedidos">Pedidos</a>                
                </li>  
            </ul>

            <div class="tab-content">
                <div class="tab-pane container active" id="anuncios"> <!-- Tab Anúncios -->
                <hr>      
                    <h4>Seus Anúncios</h4>
                    <table class="table table-striped"> 
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 10%;">✪</th>
                                <th style="width: 10%;">✪</th>
                                <th style="width: 10%;">Tipo de Anúncio</th>
                                <th style="width: 10%;">Tipo de Imóvel</th>
                                <th style="width: 40%;">Endereço</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 10%;">Ações</th>
                                <th style="width: 10%;"></th>
                                <th style="width: 10%;"></th>
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
                                    <button type="button" class="btn btn-warning" 
                                        onclick="window.location.href='/corretora/View/Pages/edit.php?idImovel=<?php echo $anuncioUser['idimovel']?>&idAnuncio=<?php echo $anuncioUser['idimovel']?>'">
                                        <i class="fa fa-edit"></i> Editar Anúncio
                                    </button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-warning" disabled>
                                        <i class="fa fa-edit"></i> Aguarde Aprovação
                                    </button>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($anuncioUser['verificado'] == 1){ ?>
                                    <button type="button" class="btn btn-danger" onclick="reprovarAnuncio();">
                                        <i class="fa fa-flag"></i> Remover Anúncio
                                    </button>
                                <?php } else { ?> 
                                    <button type="button" class="btn btn-danger" disabled>
                                        <i class="fa fa-flag"></i> Aguarde Aprovação
                                    </button>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if($anuncioUser['negociacao'] == 1){ ?>
                                    <button type="button" class="btn btn-success" onclick="window.location.href='/corretora/Controller/ImovelController.php?acao=anuncio&idImovel=<?php echo $anuncioUser['idimovel']?>'">
                                        <i class="fa fa-bullhorn"></i> Colocar em anúncio
                                    </button>
                                <?php } else { ?> 
                                    <button type="button" class="btn btn-success" onclick="window.location.href='/corretora/Controller/ImovelController.php?acao=negociar&idImovel=<?php echo $anuncioUser['idimovel']?>'">
                                        <i class="fa fa-handshake"></i> Colocar em negociação
                                    </button>
                                <?php } ?>
                            </td>
                        </tbody>
                        <?php } ?>
                    </table>              
                <hr>
                    <div>
                        <h4>
                            <i class="fa fa-exclamation-triangle"></i> 
                            Atenção! O botão [Colocar em Anúncio/Colocar em negociação] serve para ativar/desativar a exibição do anúncio publicamente.
                            O mesmo deve ser usado para que ninguém encontre o anúncio enquanto em período de negociações. 
                            Em caso de sucesso na venda/aluguel do imóvel, o anúncio deve ser manualmente removido para não ser mais exibido.
                        </h4>
                    </div>
                </div> <!-- (close) Tab Anúncios -->

                <div class="tab-pane container" id="home"> <!-- Tab Pessoal -->
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
                </div> <!-- (Close) Tab Pessoal -->

                <div class="tab-pane container" id="pedidos"> <!-- Tab Pedidos -->
                    <hr>
                    <h4>Seus Pedidos</h4>
                    <table class="table table-striped">                        
                        <thead class="thead-dark">
                            <tr>
                                <th>✪</th>
                                <th>Tipo de Anúncio</th>
                                <th>Tipo de Imóvel</th>
                                <th>Local</th>
                                <th>Comodos</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($pedidos as $pedido) { ?>
                            <td data-idanuncio="<?php echo $pedido['idpedido']?>"><?php echo $pedido['idpedido']?></td>
                            <td><?php echo $pedido['descricaoTransacao'];?></td>
                            <td><?php echo $pedido['descricaoTipoImovel'];?></td>
                            <td>
				                <?php echo $pedido['nomeBairro'];?>, <br> 
                                <?php echo $pedido['nomeCidade'];?>, <br> 
                                <?php echo $pedido['descricaoEstado'];?>    
                            </td>
                            <td>
                                Quartos: <?php echo $pedido['quantQuarto'];?> <br>
                                Suítes: <?php echo $pedido['quantSuite'];?> <br>
                                Vagas na Garagem: <?php echo $pedido['quantVagaGaragem'];?> <br>
                                Banheiros: <?php echo $pedido['quantBanheiro'];?> <br>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="window.location.href='/corretora/Controller/ImovelController.php?acao=deletePedido&idPedido=<?php echo $pedido['idpedido']?>'">
                                        <i class="fa fa-flag"></i> Remover Pedido
                                </button>
                            </td>
                        </tbody>
                        <?php } ?>
                    </table>
                </div> <!-- (Close) Tab Pedidos -->

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
    e.preventDefault();
    var idAnuncio = $(this).closest('tr').find('td[data-idanuncio]').data('idanuncio');
    var idImovel = $(this).closest('tr').find('td[data-idimovel]').data('idimovel');
    var url = '/corretora/View/administrador/controllers/adminController.php?acao=reprovar';
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