<?php include '../Templates/header.php'; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TelefoneModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImagensImovelModel.php";

    $idImovel = $_GET["id"];

    $ImovelModel = new ImovelModel();
    $infoImovel = $ImovelModel->getImovelById($idImovel);

    $idPessoa = $infoImovel['idpessoa'];

    $TelefoneModel = new TelefoneModel();
    $telefones = $TelefoneModel->getTelefonesById($idPessoa);

    $ImagemModel = new ImagensImovelModel();
    $imagens = $ImagemModel->listarArrayImagens($idImovel);

?>
<style>
.gallery {
    -webkit-column-count: 3;
    -moz-column-count: 3;
    column-count: 3;
    -webkit-column-width: 33%;
    -moz-column-width: 33%;
    column-width: 33%; }
    .gallery .pics {
    -webkit-transition: all 350ms ease;
    transition: all 350ms ease; }
    .gallery .animation {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1); 
}

@media (max-width: 450px) {
    .gallery {
    -webkit-column-count: 1;
    -moz-column-count: 1;
    column-count: 1;
    -webkit-column-width: 100%;
    -moz-column-width: 100%;
    column-width: 100%;
    }
}

@media (max-width: 400px) {
    .btn.filter {
    padding-left: 1.1rem;
    padding-right: 1.1rem;
    }
}
</style>
<link rel="stylesheet" href="/corretora/Config/JS/jquery.fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <div class="container-fluid">
        <h1>Detalhes do anúncio:</h1>
        <br>
        <!-- Englobar o form e esse titulo abaixo em uma div para colocar o mapa na frente -->
        <h4>Detalhes do imóvel:</h4>
        <div class="row">
            <div class="col-md-8">
                <form>
                    <div class="form-group row">
                        <label for="tipoImovelAnuncio" class="col-sm-3 col-form-label"><i class="fa fa-home"></i> Tipo do imóvel: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="tipoImovelAnuncio" value="<?php echo $infoImovel["descricaoTipoImovel"];?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descricaoImovelAnuncio" class="col-sm-3 col-form-label"><i class="fa fa-clipboard-list"></i> Descrição do imóvel: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="descricaoImovelAnuncio" value="<?php echo $infoImovel["descricaoImovel"];?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dimensoesImovelAnuncio" class="col-sm-3 col-form-label"><i class="fa fa-expand-arrows-alt"></i> Dimensões do imóvel: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="dimensoesImovelAnuncio" value="Área Util: <?php echo $infoImovel["areaUtil"];?>m², Área Total: <?php echo $infoImovel["areaTotal"];?>m².">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="quartosImovelAnuncio" class="col-sm-3 col-form-label"><i class="fa fa-bed"></i> Quantidade de quartos: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="quartosImovelAnuncio" value="<?php echo $infoImovel["quantQuarto"];?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="suitesImovelAnuncio" class="col-sm-3 col-form-label"><i class="fa fa-bath"></i> Suítes: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="suitesImovelAnuncio" value="<?php echo $infoImovel["quantSuite"];?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="quantBanheiroImovelAnuncio" class="col-sm-3 col-form-label"><i class="fa fa-shower"></i> Banheiros: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="quantBanheiroImovelAnuncio" value="<?php echo $infoImovel["quantBanheiro"];?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="vagasGaragemImovelAnuncio" class="col-sm-3 col-form-label"><i class="fa fa-car"></i> Vagas na garagem: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="vagasGaragemImovelAnuncio" value="<?php echo $infoImovel["quantVagaGaragem"];?>">
                        </div>
                    </div>
                    <br>

                    <h4>Localização:</h4>
                    <div class="form-group row">
                        <label for="enderecoImovel" class="col-sm-3 col-form-label"><i class="fa fa-map-marker-alt"></i> Endereço: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="enderecoImovel" wrap="hard"
                        value="<?php echo $infoImovel["logradouro"];?>, número <?php echo $infoImovel["numero"];?>, <?php echo $infoImovel["complemento"];?> <?php echo $infoImovel["nomeBairro"];?>, <?php echo $infoImovel["nomecidade"];?>, <?php echo $infoImovel["siglaEstado"];?>.">
                        </div>
                    </div>
                    <br>

                    <h4>Detalhes do Anunciante:</h4>
                    <div class="form-group row">
                        <label for="nomeAnunciante" class="col-sm-3 col-form-label"><i class="fa fa-user"></i> Nome: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="nomeAnunciante" value="<?php echo $infoImovel["nome"];?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="emailAnunciante" class="col-sm-3 col-form-label"><i class="fa fa-at"></i> Email de contato: </label>
                        <div class="col-sm-9">
                        <input type="text" readonly class="form-control-plaintext" id="emailAnunciante" value="<?php echo $infoImovel["usuario"];?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefoneAnunciante" class="col-sm-3 col-form-label"><i class="fa fa-phone"></i> Telefone(s) de contato: </label>
                        <div class="col-sm-9">
                        <?php foreach($telefones as $telefone) { ?>
                        <input type="text" readonly class="form-control-plaintext" id="telefoneAnunciante" value="<?php echo $telefone['telefone'] ?>">
                        <?php } ?>
                        </div>
                    </div>

                    <h4>Imagens do imóvel:</h4>
                </form>
            </div>

            <div class="gallery" id="gallery">
                <?php foreach($imagens as $imagem) { ?>
                    <div class="mb-3">
                        
                        <a class="grouped_elements" rel="group1" href="/corretora/Files/<?php echo $imagem?>">
                        <img src="/corretora/Files/<?php echo $imagem?>" alt="" width="160" height="108"/></a>
                    </div>
                <?php } ?>
            </div>
            <!--
            <div class="col-md-4">
                <div id="mapa" style="height: 500px; width: 500px"></div>
            </div>
            -->
        </div>
    </div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="/corretora/Config/JS/jquery.fancybox/fancybox/jquery.easing-1.4.pack.js"></script>
<script type="text/javascript" src="/corretora/Config/JS/jquery.fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="/corretora/Config/JS/jquery.fancybox/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>

<script>

   // var endereco = $("#enderecoImovel").val();
    $(function() {
        var selectedClass = "";

        $(".filter").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#gallery").fadeTo(100, 0.1);
            $("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
            setTimeout(function() {
                $("."+selectedClass).fadeIn().addClass('animation');
                $("#gallery").fadeTo(300, 1);
            }, 300);
        });
    });

    $(document).ready(function() {

    /* This is basic - uses default settings */
    $("a.grouped_elements").fancybox();
    
    /* Using custom settings */
        $("a#inline").fancybox({
            'hideOnContentClick': true
        });

    /* Apply fancybox to multiple items */
        $("a.group").fancybox({
            'transitionIn'	:	'elastic',
            'transitionOut'	:	'elastic',
            'speedIn'		:	600, 
            'speedOut'		:	200, 
            'overlayShow'	:	false
        });
    });

/*
Google Maps Javascript
    $(document).ready(function () {

    initialize();
    function carregarNoMapa(endereco) {
        geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
 
                    $('#txtEndereco').val(results[0].formatted_address);
                    $('#txtLatitude').val(latitude);
                    $('#txtLongitude').val(longitude);
 
                    var location = new google.maps.LatLng(latitude, longitude);
                    marker.setPosition(location);
                    map.setCenter(location);
                    map.setZoom(16);
                }
            }
        });
    }
});

var geocoder;
var map;
var marker;
 
function initialize() {
    var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
    var options = {
        zoom: 5,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
 
    map = new google.maps.Map(document.getElementById("mapa"), options);
 
    geocoder = new google.maps.Geocoder();
 
    marker = new google.maps.Marker({
        map: map,
        draggable: true,
    });
 
    marker.setPosition(latlng);
}
*/
</script>
<!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCEZWwY5xOnC3k21UwVGcO6F5IoazbDo0o&amp;sensor=false"></script>-->
<?php include "../Templates/footer.php"; ?>
