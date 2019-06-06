<?php include '../Templates/header.php'; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/BannerModel.php";

    $bannerModel = new BannerModel();
    $banner = $bannerModel->getRandomBanner();
    $banner2 = $bannerModel->getRandomBanner();
?>

<!-- Banner 1 -->
<div class="row form-group">
    <div class="col-md-4">
        <h4>Texto de Teste Intuitivo de Disney SUperio a Dois elevado ao quadrado</h4>
    </div>
    <?php if($banner != false) { ?>
        <div class="col-md-8">
            <a href="<?php echo $banner['link']?>">
                <img class="d-block w-100 img-fluid" style="width:400px;height:150px;" src="/corretora/Files/banners/<?php echo $banner['imagemBanner']?>" alt="Anuncie aqui">
            </a>
        </div>
        
<?php } ?>

<!-- Banner 2-->
<?php if($banner2 != false) { ?>
    <div class="offset-md-2 col-md-8" style="padding-top: 20px; padding-bottom: 20px;">
    <a href="<?php echo $banner2['link']?>">
        <img class="d-block w-100 img-fluid" style="width:450px;height:150px;" src="/corretora/Files/banners/<?php echo $banner2['imagemBanner']?>" alt="Anuncie aqui">
    </a>
    </div>
<?php } ?>


<?php include '../Templates/footer.php'; ?>