<?php 
    session_start();
    include "../Templates/header.php"; 

    $acao = "create";
    if(isset($_SESSION['idteste'])){
        $id = $_SESSION['idteste'];
    } else {
        $id = 0;
    }
?>
<div class="container-fluid">

    <div>
        <h3>Adicionar Imagens</h3>
    </div>

    <div> 
        <p>
        Que tal adicionar algumas imagens para seu anúncio? Apenas arraste as imagens ou clique no espaço.
        Suas imagens serão enviadas após clicar em finalizar. Se não gostar ou enviou alguma imagem errada, apenas clique
        em "Remover Imagem" que ela será removida.
        </p>
    </div>
        <!-- Formulário do dropzone. Não modificar sob qualquer circunstância -->
        <div class="container-form-dropzone">
            <div class="content-form-dropzone">
                <form action="/corretora/Controller/ImagensImovelController.php?acao=<?=$acao?>" 
                    class="dropzone" method="POST">
                    <input type="hidden" name="idImovel" value="<?php echo $id?>" id="idImovel">
                </form>
            </div>
        </div>

        <button type="button" class="btn btn-primary" id="btn-Finalizar">Finalizar!</button>
        <button type="button" class="btn btn-secondary" id="btn-AgoraNao">Agora não</button>
    </div>

<script type="text/javascript">

    $("#btn-AgoraNao").on("click", function(e){
        window.location.href='/corretora/index.php';
    });

    Dropzone.autoDiscover = false;
    Dropzone.autoProcessQueue = false;

    var submitButton = document.querySelector("#btn-Finalizar")
        myDropzone = this;

    $(".dropzone").dropzone({
        addRemoveLinks: true,
        maxFilesize: 5,
        maxFiles: 10,
        parallelUploads: 10,
        autoProcessQueue: false,
        acceptedFiles: '.jpg,.jpeg,.JPEG,.JPG,.png,.PNG',
        removedfile: function(file) {
            var name = file.name; 
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        init: function(){
            var submitButton = document.querySelector("#btn-Finalizar")
                myDropzone = this; // closure

            submitButton.addEventListener("click", function() {
                myDropzone.processQueue(); // Tell Dropzone to process all queued files.
            });
        }
    });

</script>

<?php include "../Templates/footer.php"; ?>