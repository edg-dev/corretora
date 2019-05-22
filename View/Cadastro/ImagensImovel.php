<?php include "../Templates/header.php"; 
    $acao = "create";
?>

<form method="POST" id="formImagens" class="dropzone" style="padding-top: 60px; !important"
      action="/corretora/Controller/ImagensImovelController.php?acao=<?=$acao?>">

    <h1>Adicione imagens referentes ao seu imóvel.</h1>

    <div class="form-group">
    <input type="number" name="idImovel" required>
    </div>

    <div id="dropZone" class="file-field">
        <h1>Arraste arquivos até aqui</h1>
        <div class="btn btn-primary btn-sm float-left">
            <input type="file" id="file" name="file" multiple
                   class="file-path validate" placeholder="Ou escolha de seus arquivos" />
        </div>
    </div>

    <h1 id="progress"></h1>
    <h1 id="error"></h1>
    <div id="files" class="form-group"></div>

    <button class="btn btn-primary btn-lg btn-block form-group">Adicionar</button>
    <div id="mensagem"></div>
</form>


<?php include "../Templates/footer.php"; ?>