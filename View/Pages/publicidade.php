<?php include '../Templates/header.php'; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/BannerModel.php";

    $bannerModel = new BannerModel();
    $banner = $bannerModel->getRandomBanner();
    $banner2 = $bannerModel->getRandomBanner();
?>
<div class="text-center">
    <h1> Publicidade e Propagandas </h1>
    <h4>Entre em Contato conosco para anunciar o Banner de seu Site aqui!</h4>
<div>
<!-- Banner 1 -->
<?php foreach($banner as $banners){ ?>
<div class="row " style="padding-top: 60px;">
        <div class="col-md-12 text-center">
        <h3>Banner</h3>
            <a href="<?php echo $banners['link']?>">
                <img class="d-block w-100 img-fluid" style="width:600px;height:150px;" src="/corretora/Files/banners/<?php echo $banner['imagemBanner']?>" alt="Anuncie aqui">
            </a>
        <hr>
        </div>
</div>
    <?php } ?>



<?php include '../Templates/footer.php'; ?>