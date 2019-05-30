<?php 
    include '../Templates/header.php'; 
    

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EstadoModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TransacaoModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TipoImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";

    $acao = "create";

    $estadoModel = new EstadoModel();
    $estados = $estadoModel->getAllEstado();

    $transacaoModel = new TransacaoModel();
    $transacoes = $transacaoModel->getAllTransacao();
    
    $tipoImovelModel = new TipoImovelModel();
    $tiposDeImovel = $tipoImovelModel->getAllTipoImovel();

?>

<?php

if(!$_SESSION['usuario' ]) {
	header('Location: \corretora\View\login\user\index.php');
	exit();
}?>
<style>
    
    input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
    
    .container-form-dropzone{
    margin: 0 auto;
    }

    .content-form-dropzone{
    padding: 5px;
    margin: 0 auto;
    }
    .content-form-dropzone span{
    width: 250px;
    }

    .dz-message{
    text-align: center;
    font-size: 28px;
    }

    .dz-max-files-reached {background-color: red};
</style>

<div class="form-group col-md-6">
    <b><h1>Cadastro do Imóvel:</h1></b> 
</div>

<form method="post" id="formImovel" method="POST" action="/corretora/Controller/ImovelController.php?acao=<?=$acao?>">
    <div class="form-group col-md-6">
        <b><label for="tipoDeImovel">Que tipo de imóvel você quer anunciar?</label></b>
        <select id="tipoDeImovel" class="form-control" name="tipoDeImovel" required>
                <option selected>Selecione o tipo do imóvel:</option>
                <?php foreach($tiposDeImovel as $tipoImovel){?>
                <option value="<?php echo $tipoImovel['idTipoImovel'];?>"> <?php echo $tipoImovel['descricaoTipoImovel'];?> </option>
                <?php } ?>
        </select>
    </div>

    <div class="form-group col-md-6">
    <b><label for="tipoDeImovel">Onde fica seu imóvel?</label></b>
    </div>
    <div class="form-group col-md-6">
        <label for="cep"><span>*</span>Cep:</label>
        <input type="text" class="form-control cep-mask" id="cep" placeholder="Ex.: 00000-000" name="cep" require>
		<select id="estado" class="form-control" name="estado" required>
                <option selected>Selecione seu estado</option>
                <?php foreach($estados as $estado){?>
                <option value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                <?php }?>
            </select>
        <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade" required>
    </div>
    <div class="form-group col-md-6">
        <label for="endereco">Endereço:</label>
        <input type="text" class="form-control" id="bairro" placeholder="Bairro" name="bairro" required>
        <input type="text" class="form-control" id="rua" placeholder="Rua" name="rua" required>
        <input type="text" class="form-control" id="complemento" placeholder="Complemento" name="complemento">
        <input type="number" class="form-control" id="numero" placeholder="Número" name="numero" required>
    </div>

    <div class="form-group col-md-6">
        <b><h1 for="localImovel">Dados principais do imóvel:</h1></b>
    </div>
    <div class="form-group col-md-6">
        <label for="quantQuarto">Quartos:</label>
        <input type="number" class="form-control" id="quantQuarto" placeholder="0" name="quantQuarto" required>
    </div>
    <div class="form-group col-md-6">
        <label for="quantSuite">Suítes (Opcional):</label>
        <input type="number" class="form-control" id="quantSuite" placeholder="0" name="quantSuite" >
    </div>
    <div class="form-group col-md-6">
        <label for="quantVagaGaragem">Vagas de garagem (Opcional):</label>
        <input type="number" class="form-control" id="quantVagaGaragem" placeholder="0" name="quantVagaGaragem" >
    </div>
    <div class="form-group col-md-6">
        <label for="quantBanheiro">Banheiros:</label>
        <input type="number" class="form-control" id="quantBanheiro" placeholder="0" name="quantBanheiro" required>
    </div>
    <div class="form-group col-md-6">
        <label for="areaUtil">Área útil (M²):</label>
        <input type="number" class="form-control" id="areaUtil" placeholder="000" name="areaUtil" required>
    </div>
    <div class="form-group col-md-6">
        <label for="areaTotal">Área total (M²) (Opcional):</label>
        <input type="number" class="form-control" id="areaTotal" placeholder="000" name="areaTotal" required>
    </div>
    <div class="form-group col-md-6">
        <label for="descricaoImovel">Descrição do imovel :</label>
        <input type="text" class="form-control" id="descricaoImovel" placeholder="Descrição do imóvel" 
                                                                     name="descricaoImovel" >
    </div>

    <div class="form-group col-md-6">
        <b><h1>Quanto custa seu imóvel?</h1></b> 
    </div>
    <div class="form-group col-md-6">
        <label for="precoImovel">Valor da transação (R$):</label>
        <input type="text" class="form-control" id="precoImovel" placeholder="000 000" name="precoImovel" required>
    </div>

    <div class="form-group col-md-6">
        <b><label for="transacao">Transação</label></b>
        <select id="transacao" class="form-control" name="transacao" required>
                <option selected>Selecione a opção de transação:</option>
                <?php foreach($transacoes as $transacao){?>
                <option value="<?php echo $transacao['idTransacao'];?>"> <?php echo $transacao['descricaoTransacao'];?> </option>
                <?php } ?>
        </select>
    </div>

    <div class="form-group col-md-6">
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Salvar</button>
    </div>

</form>
<script src="/corretora/Config/JS/jquery.mask.js"></script>

<script type="text/javascript">
    $('#precoImovel').mask('000.000.000.000,00 ', {reverse: true});
    $('#cep').mask('00000-000');
</script>
<?php include "../Templates/footer.php"; ?>