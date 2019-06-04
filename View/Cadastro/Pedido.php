<?php include '../Templates/header.php'; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EstadoModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TransacaoModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TipoImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";

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
    <b><h1>Cadastro de Pedido:</h1></b> 
</div>

<form method="post" id="formImovel" method="POST" action="/corretora/Controller/ImovelController.php?acao=pedir&idUsuario=1">
    <div class="form-group col-md-6">
        <b><label for="tipoDeImovel">Que tipo de imóvel você quer pedir?</label></b>
        <select id="tipoDeImovel" class="form-control" name="tipoDeImovel" required>
                <option selected>Selecione o tipo do imóvel:</option>
                <?php foreach($tiposDeImovel as $tipoImovel){?>
                <option value="<?php echo $tipoImovel['idTipoImovel'];?>"> <?php echo $tipoImovel['descricaoTipoImovel'];?> </option>
                <?php } ?>
        </select>
    </div>
 
    <div class="form-group col-md-6">
        <b><label for="transacao">Qual a transação do pedido?</label></b>
        <select id="transacao" class="form-control" name="transacao" required>
                <option selected>Selecione a opção de transação:</option>
                <?php foreach($transacoes as $transacao){?>
                <option value="<?php echo $transacao['idTransacao'];?>"> <?php 
                    if($transacao['idTransacao'] == 2){
                        echo 'Comprar';
                    } else {
                        echo $transacao['descricaoTransacao'];
                    }
                    ?> </option>
                <?php } ?>
        </select>
    </div>

    <div class="form-group col-md-6">
        <b><label for="tipoDeImovel">Preferência de localização?</label></b>
		<select id="estado" class="form-control" name="estado" required>
                <option selected>Selecione seu estado</option>
                <?php foreach($estados as $estado){?>
                <option value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                <?php }?>
            </select>
        <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade" required>
        <input type="text" class="form-control" id="bairro" placeholder="Bairro" name="bairro" required>
    </div>

    <br>
    <div class="form-group col-md-6">
        <b><label for="tipoDeImovel">Dados sobre o pedido:</label></b>
    </div>
    <div class="form-group col-md-6">
        <label for="quantQuarto">Quartos:</label>
        <input type="number" class="form-control" id="quantQuarto" placeholder="0" name="quantQuarto" required>
    </div>
    <div class="form-group col-md-6">
        <label for="quantSuite">Suítes (Opcional):</label>
        <input type="number" class="form-control" id="quantSuite" placeholder="0" name="quantSuite" required>
    </div>
    <div class="form-group col-md-6">
        <label for="quantVagaGaragem">Vagas de garagem (Opcional):</label>
        <input type="number" class="form-control" id="quantVagaGaragem" placeholder="0" name="quantVagaGaragem" required>
    </div>
    <div class="form-group col-md-6">
        <label for="quantBanheiro">Banheiros:</label>
        <input type="number" class="form-control" id="quantBanheiro" placeholder="0" name="quantBanheiro" required>
    </div>

    <b><label>Digite uma faixa de preço:</label></b>
    <div class="form-group row ">
    
    <div class="form-group col-md-3">
        <label>Preço mímino:</label>
        <input type="text" class="form-control" id="precoMin" placeholder="000 000" name="precoMin" required>
    </div>
    <div class="form-group col-md-3">
        <label>Preço máximo:</label>
        <input type="text" class="form-control" id="precoMax" placeholder="000 000" name="precoMax" required>
    </div>
    </div>


    <div class="form-group col-md-6">
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Salvar</button>
    </div>

</form>

<script type="text/javascript">
    $('#precoMin').mask('000.000.000.000,00 ', {reverse: true});
    $('#precoMax').mask('000.000.000.000,00 ', {reverse: true});
</script>

<?php include '../Templates/footer.php'; ?>