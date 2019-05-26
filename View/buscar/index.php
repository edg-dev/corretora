<?php 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EstadoModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TransacaoModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TipoImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";

    $acao = "busca";

    $estadoModel = new EstadoModel();
    $estados = $estadoModel->getAllEstado();

    $transacaoModel = new TransacaoModel();
    $transacoes = $transacaoModel->getAllTransacao();
    
    $tipoImovelModel = new TipoImovelModel();
    $tiposDeImovel = $tipoImovelModel->getAllTipoImovel();

    $imovelModel = new ImovelModel();
    $buscasImovel = $imovelModel->getBuscaImovel();

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Corretora</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/blog-home.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Nome do site</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="\corretora\index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Anunciar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Entrar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">Anúncios
        </h1>

        <!-- Colocar foreach aki de retorno da buscas -->
        <?php $count = 0; ?>
        <?php foreach($buscasImovel as $buscaImovel){?>

        <div class="card mb-4">
          <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">Post Title</h2>
            <p><b>Transação:</b>      
                        <?php echo $buscaImovel['descricaoTransacao'];?>
                        
                        <b>um(a)</b>
                        <?php echo $buscaImovel['descricaoTipoImovel'];?>;</p>

                        <p><b>Preço: R$</b>        
                        <?php echo $buscaImovel['precoImovel'];?>;</p>

                        <p><b>Área útil:</b>
                        <?php echo $buscaImovel['areaUtil'];?>;

                        <b>Área total:</b>
                        <?php echo $buscaImovel['areaTotal'];?>;</p>

                        <p><b>Quant de quarto:</b>
                        <?php echo $buscaImovel['quantQuarto'];?>;

                        <b>Quant de suítes:</b> 
                        <?php echo $buscaImovel['quantSuite'];?>;</p>

                        <p><b>Quant de vagas na garagem:</b> 
                        <?php echo $buscaImovel['quantVagaGaragem'];?>;

                        <b>Quant de banheiro:</b> 
                        <?php echo $buscaImovel['quantBanheiro'];?>;</p>

            <a href="#" class="btn btn-primary">Read More &rarr;</a>
          </div>
        </div>

      </div>

      <?php $count++; ?>
      <?php } ?> <!-- foreach fecha aki --> 

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
      <form method="post" id="buscaImovel" method="POST" action="../Controller/ImovelController.php?acao=<?=$acao?>">
        <div class="card my-4">
          <h5 class="card-header">Pesquise seu imóvel:</h5>
          <div class="card-body">
            <div class="input-group">

              <div class="form-group">
                <b><label for="transacao">Você deseja alugar ou comprar um imóvel?</label></b>
            <select id="transacao" class="form-control" name="transacao" required>
                    <option selected>Selecione a opção de transação:</option>
                    <?php foreach($transacoes as $transacao){?>
                    <option value="<?php echo $transacao['idTransacao'];?>"> <?php echo $transacao['descricaoTransacao'];?> </option>
                    <?php } ?>
            </select>
              </div>

              <div class="form-group">
                <b><label for="tipoDeImovel">Que tipo de imóvel você proucura?</label></b>
            <select id="tipoDeImovel" class="form-control" name="tipoDeImovel" required>
                    <option selected>Selecione o tipo do imóvel:</option>
                    <?php foreach($tiposDeImovel as $tipoImovel){?>
                    <option value="<?php echo $tipoImovel['idTipoImovel'];?>"> <?php echo $tipoImovel['descricaoTipoImovel'];?> </option>
                    <?php } ?>
            </select>
              </div>

              <div class="form-group">
                <b><label for="endereco">Endereço:</label></b>
                    <select id="estado" class="form-control" name="estado" >
                        <option selected>Selecione seu estado</option>
                        <?php foreach($estados as $estado){?>
                        <option value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                        <?php }?>
                    </select>
                  <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade" >
                  <input type="text" class="form-control" id="bairro" placeholder="Bairro" name="bairro" >
                  <input type="text" class="form-control" id="rua" placeholder="Rua" name="rua" >
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Buscar</button>
              </div>
            </div>
          </div>
        </div>
      </form>

      </div>

    </div>
    <!-- /.row -->

  </div>

  <?php include '../Templates/footer.php'; ?>
