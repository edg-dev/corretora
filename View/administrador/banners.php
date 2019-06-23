<?php 
  include_once "templates/header.php"; 

  require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/BannerModel.php";

  $bannerModel = new BannerModel();
  $banners = $bannerModel->getAllBanners();

?>

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Banners</li>
        </ol>

        <h1>Cadastro de banners</h1>
        <div class="row">
          <div class="col-md-4">
            <h3>Novo banner</h3>
            <form method="POST" id="cadastroBanner" action="controllers/adminController.php?acao=create" enctype="multipart/form-data">

              <div class="form-group">
                  <label for="nome"><span>*</span>Nome do acesso:</label>
                  <input type="text" class="form-control" id="nome" placeholder="Informe o nome do site" name="nome" required>
              </div>

              <div class="form-group">
                  <label for="link"><span>*</span>Link para acesso:</label>
                  <input type="text" class="form-control" id="link" placeholder="Informe o link para redirecionamento" name="link" required>
              </div>

              <div class="form-group">
                  <label for="banner"><span>*</span>Imagem:</label>
                  <input type="file" class="form-control" id="banner" name="banner">
              </div>

              <button type="submit" class="btn btn-success" id="btn-Banner"><i class="fa fa-check-circle"></i> Cadastrar</button>
            </form>
          </div>
          <div class="col-md-8">
            <h3>Banners já cadastrados</h3>
              <table class="table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Nome</th>
                      <th>Link</th>
                      <th>Contem imagem?</th>
                      <th>Excluir</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($banners as $result) { ?>
                  <td id="idBanner" value="<?php echo $result['idBanner'];?>"><?php echo $result['idBanner'];?></td>
                  <td><?php echo $result['descricaoBanner'];?></td>
                  <td><?php echo $result['link'];?></td>
                  <?php if(($result['imagemBanner'] == "")){ ?> <td>Não</td> <?php } else {?> <td>Sim</td> <?php } ?>
                  <td> <button type="button"id="btn-ExcluirBanner" class="btn btn-danger" 
                      onclick="window.location.href='controllers/adminController.php?acao=delete&id=<?php echo $result['idBanner'];?>'">
                      <i class="fa fa-times-circle"></i> Excluir</button> 
                </td>  
              </tbody>
              <?php } ?>
              </table>

          </div>
        </div>

<?php include_once "templates/footer.php"; ?>