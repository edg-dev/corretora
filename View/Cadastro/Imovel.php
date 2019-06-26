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
include($_SERVER["DOCUMENT_ROOT"] . '/corretora/View/login/user/verifica_login.php');
?>

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

<div class="row">
    <div class="col-md-2"></div>
<div class="form-group col-md-8">

    <b><h1 class="titulo my-4">
        Cadastro do Imóvel:
    </h1></b>

    <form method="post" id="formImovel" method="POST" action="/corretora/Controller/ImovelController.php?acao=<?=$acao?>">
        <div class="form-group">
            <b><label for="tipoDeImovel">Que tipo de imóvel você quer anunciar?</label></b>
            <select id="tipoDeImovel" class="form-control" name="tipoDeImovel" required>
                    <option selected>Selecione o tipo do imóvel:</option>
                    <?php foreach($tiposDeImovel as $tipoImovel){?>
                    <option value="<?php echo $tipoImovel['idTipoImovel'];?>"> <?php echo $tipoImovel['descricaoTipoImovel'];?> </option>
                    <?php } ?>
            </select>
        </div>

        <b><label for="tipoDeImovel">Onde fica seu imóvel?</label></b>
        <div class="form-row">
            <div class="form-group col-md-4">            
                <label for="cep"><span>*</span>Cep:</label>
                <input type="text" class="form-control cep" id="cep"  aria-describedby="cep" placeholder="Ex.: 00000-000" name="cep" required>
                <small id="cep" class="form-text text-muted">Se o CEP preenchido for válido, alguns dados serão preenchidos automaticamente.</small>
            </div>

            <div class="form-group col-md-7">
                <label for="logradouro"><span>*</span>Logradouro:</label>
                <input type="text" class="form-control" id="logradouro" placeholder="Rua, Avenida, etc..." name="rua" required>
            </div>

            <div class="form-group col-md-1">
                <label for="numero"><span>*</span>Número:</label>
                <input type="number" class="form-control" id="numero" name="numero" required>
            </div> 
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="complemento">Complemento:</label>
                <input type="text" class="form-control" id="complemento" aria-describedby="complemento" placeholder="Apartamento, fundos, etc..." name="complemento">
                <small id="complemento" class="form-text text-muted">Esse campo é opcional.</small>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="bairro"><span>*</span>Bairro:</label>
                <input type="text" class="form-control" id="bairro" placeholder="Bairro" name="bairro" required>
            </div>

            <div class="form-group col-md-4">
                <label for="cidade"><span>*</span>Cidade:</label>
                <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade" required>
            </div>

            <div class="form-group col-md-4">
                <label for="estado"><span>*</span>Estado:</label>
                <select id="estado" class="form-control" name="estado" required>
                    <option selected>Selecione seu estado</option>
                    <?php foreach($estados as $estado){?>
                        <option data-uf="<?php echo $estado['siglaEstado'];?>" value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                    <?php }?>
                </select> 
            </div>
        </div>

        <div class="form-group">
            <b><h1 for="localImovel">Dados principais do imóvel:</h1></b>
        </div>
        <div class="form-group">
            <label for="quantQuarto">Quartos:</label>
            <input type="number" class="form-control" id="quantQuarto" placeholder="0" name="quantQuarto">
        </div>
        <div class="form-group">
            <label for="quantSuite">Suítes (Opcional):</label>
            <input type="number" class="form-control" id="quantSuite" placeholder="0" name="quantSuite">
        </div>
        <div class="form-group">
            <label for="quantVagaGaragem">Vagas de garagem (Opcional):</label>
            <input type="number" class="form-control" id="quantVagaGaragem" placeholder="0" name="quantVagaGaragem">
        </div>
        <div class="form-group">
            <label for="quantBanheiro">Banheiros:</label>
            <input type="number" class="form-control" id="quantBanheiro" placeholder="0" name="quantBanheiro">
        </div>
        <div class="form-group">
            <label for="areaUtil">Área útil (M²):</label>
            <input type="number" class="form-control" id="areaUtil" placeholder="000" name="areaUtil">
        </div>
        <div class="form-group">
            <label for="areaTotal">Área total (M²) (Opcional):</label>
            <input type="number" class="form-control" id="areaTotal" placeholder="000" name="areaTotal">
        </div>
        <div class="form-group">
            <label for="descricaoImovel">Descrição do imovel :</label>
            <input type="text" class="form-control" id="descricaoImovel" placeholder="Descrição do imóvel" 
                                                                        name="descricaoImovel">
            <small id="descricaoImovel" class="form-text text-muted">Adicione aqui o estado do imóvel(novo, usado, em construção, etc..) e/ou detalhes como churrasqueira, piscina, área de lazer ou serviço, etc...</small>
        </div>

        <div class="form-group">
            <b><h1>Quanto custa seu imóvel?</h1></b> 
        </div>
        <div class="form-group">
            <label for="precoImovel">Valor da transação (R$):</label>
            <input type="number" class="form-control" id="precoImovel" placeholder="000 000" name="precoImovel">
	    <small id="precoImovel" class="form-text text-muted">Se não adicionado, o valor será exibido como "Valor a negociar".</small>
        </div>

        <div class="form-group">
            <b><label for="transacao">Transação</label></b>
            <select id="transacao" class="form-control" name="transacao" required>
                    <option selected>Selecione a opção de transação:</option>
                    <?php foreach($transacoes as $transacao){?>
                    <option value="<?php echo $transacao['idTransacao'];?>"> <?php echo $transacao['descricaoTransacao'];?> </option>
                    <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Salvar</button>
        </div>

    </form>

</div>
</div>
                
<script src="/corretora/Config/JS/jquery.mask.js"></script>

<script type="text/javascript">
    $('#cep').mask('00000-000');

    $("#cep").focusout(function(){
		//Início do Comando AJAX
		$.ajax({
			//O campo URL diz o caminho de onde virá os dados
			//É importante concatenar o valor digitado no CEP
			url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
			//Aqui você deve preencher o tipo de dados que será lido,
			//no caso, estamos lendo JSON.
			dataType: 'json',
			//SUCESS é referente a função que será executada caso
			//ele consiga ler a fonte de dados com sucesso.
			//O parâmetro dentro da função se refere ao nome da variável
			//que você vai dar para ler esse objeto.
			success: function(resposta){
				//Agora basta definir os valores que você deseja preencher
				//automaticamente nos campos acima.
				$("#logradouro").val(resposta.logradouro);
				$("#complemento").val(resposta.complemento);
				$("#bairro").val(resposta.bairro);
				$("#cidade").val(resposta.localidade);
				$("#estado option[data-uf="+resposta.uf+"]").attr("selected", true);
				//Vamos incluir para que o Número seja focado automaticamente
				//melhorando a experiência do usuário
				$("#numero").focus();
			}
		});
	});
</script>
<?php include "../Templates/footer.php"; ?>
