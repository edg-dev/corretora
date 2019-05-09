$(function () {
    $('#inputImage').change(function () {
        $("#canvas").hide();
        $('#imagemResize').hide()
        $('#imagemAtual').hide();
        mostraOuEscondeSalvar();
        $("#workspaceResize").html('');
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#workspaceResize").prepend('<img id="imagemResize" src="" alt=""/>')
            $('#imagemResize').show();
            $('#imagemResize').attr("src", e.target.result);
            $('#imagemResize').Jcrop({
                onChange: SetCoordinates,
                onSelect: SetCoordinates,
                aspectRatio: 3/2,
                setSelect:   [50, 50, 500,500],
                boxWidth: 400, 
               // boxHeight: 200
            });

        }
        reader.readAsDataURL($(this)[0].files[0]);
    });

});
function mostraOuEscondeSalvar(){
    if($('#imgWidth').val() != 0 && $('#imgHeight').val() != 0){
        $('#salvar').show();
    }else{
        $('#salvar').hide();
    }
}
function SetCoordinates(c) {
    $('#imgX1').val(c.x);
    $('#imgY1').val(c.y);
    $('#imgWidth').val(c.w);
    $('#imgHeight').val(c.h);
    mostraOuEscondeSalvar();
    loadImagemData();
};
function loadImagemData(){
    var x1 = $('#imgX1').val();
    var y1 = $('#imgY1').val();
    var width = $('#imgWidth').val();
    var height = $('#imgHeight').val();
    var canvas = $("#canvas")[0];

    var oc = document.createElement('canvas');
    var context = canvas.getContext('2d');
    var octx = oc.getContext('2d');
    var img = new Image();

    img.onload = function () {

        canvas.height = height;
        canvas.width = width;
        context.drawImage(img, x1, y1, width, height, 0, 0, width, height);

        var oc = document.createElement('canvas');

        oc.width = 900;
        oc.height = 600;

        var octx = oc.getContext('2d');

        octx.drawImage(canvas, 0, 0, canvas.width, canvas.height, 0, 0, oc.width, oc.height);
        $('#imagem').val(oc.toDataURL("image/jpeg", 0.5)); 

        mostraOuEscondeSalvar();
    };
    img.src = $('#imagemResize').attr("src");
}