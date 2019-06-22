<?php include '../Templates/header.php'; 
    
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EstadoModel.php";

    $acao = "create";

    $estadoModel = new EstadoModel();
    $estados = $estadoModel->getAllEstado();

?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<div class="row">
        <div class="col-md-2"></div>
            <div class="form-group col-md-8">

        <h1 class="titulo my-4">
            Cadastro de Pessoa Jurídica 
        </h1>
        
<form method="POST" id="cadastroPessoaJuridica" action="/corretora/Controller/PessoaJuridicaController.php?acao=<?=$acao?>">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <div class="form-group">
        <label for="nome"><span>*</span>Nome Completo</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o Nome Completo" required>
	</div>
	
	<div class="form-group">
        <label for="razaoSocial"><span>*</span>Razão Social</label>
        <input type="text" class="form-control" id="razaoSocial" name="razaoSocial" placeholder="Informe a Razão Social" required>
    </div>

    <div class="form-group">
        <label for="email"><span>*</span>E-mail:</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Informe seu E-mail" >
        <small id="emailHelp" class="form-text text-muted">Esse email será para usado para contatos.</small>
    </div>

    <div class="form-group">
        <label for="senha"><span>*</span>Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe sua Senha de acesso" required>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="telefone1">Telefone Empresarial 1</label>
            <input type="text" class="form-control" id="telefone1" name="telefone1" placeholder="Ex.: (00) 0000-0000">
        </div>
        <div class="form-group col-md-6">
            <label for="telefone2">Telefone Empresarial 2</label>
            <input type="text" class="form-control" id="telefone2" name="telefone2" placeholder="Ex.: (00) 0000-0000">
        </div>
    </div>

    <div class="form-group">
        <label for="cnpj"><span>*</span>CNPJ</label>
        <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Ex.: 00.000.000/0000-00">
        <small id="cpf" class="form-text text-muted">Digite apenas os números.</small>
    </div>

    <!--Endereco Completo com uma funcao de Buscar Atomaticamente-->
    <div class="form-row">

        <div class="form-group col-md-4">
            <label for="cep"><span>*</span>CEP:</label>
            <input type="text" class="form-control" id="cep" placeholder="Ex.: 00000-000" name="cep" required>
            <small id="cep" class="form-text text-muted">Se o CEP preenchido for válido, alguns dados serão preenchidos automaticamente.</small>
        </div>

        <div class="form-group col-md-7">
            <label for="logradouro"><span>*</span>Logradouro:</label>
            <input type="text" class="form-control" id="logradouro" placeholder="Rua, Avenida, etc..." name="logradouro" required>

        </div>

        <div class="form-group col-md-1">
            <label for="numero"><span>*</span>Número:</label>
            <input type="number" class="form-control" id="numero" name="numero" required>
        </div>
    </div>

    <div class="form-group">
        <label for="complemento">Complemento:</label>
        <input type="text" class="form-control" id="complemento" aria-describedby="complemento" placeholder="Apartamento, fundos, etc..." name="complemento">
        <small id="complemento" class="form-text text-muted">Esse campo é opcional.</small>
    </div>
  
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="bairro"><span>*</span>Bairro:</label>
            <input type="text" class="form-control" id="bairro" placeholder="Informe seu bairro" name="bairro" required>
        </div>
	    
        <div class="form-group col-md-4">
            <label for="cidade"><span>*</span>Cidade:</label>
            <input type="text" class="form-control" id="cidade" placeholder="Informe sua cidade" name="cidade" required>
        </div>

        <div class="form-group col-md-4">
            <label for="estado"><span>*</span>Estado:</label>
            <select id="estado" class="form-control" name="estado" required>
                <option selected>Selecione seu estado</option>
                <?php foreach($estados as $estado){?>
                <option value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                <?php }?>
            </select>
        </div>

    </div>
	<button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-building"></i> Cadastrar</button>
	
</form>
<br>
<div> 
    <p style="text-align:center">Já possui uma conta?	<a href="../login/user/login.php">Entre Aqui</a>
    </div>
    </div>

   
</div>
<!--JS do CEP -->
<script src="/corretora/Config/JS/jquery.mask.js"></script>

<script type="text/javascript">

        $('#telefone1').mask('(00) 0000-00000');
        $('#telefone2').mask('(00) 0000-00000');
        $('#cep').mask('00000-000');
        $('#cnpj').mask('00.000.000/0000-00', {reverse: true});

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
				$("#uf").val(resposta.uf);
				//Vamos incluir para que o Número seja focado automaticamente
				//melhorando a experiência do usuário
				$("#numero").focus();
			}
		});
	});
		$("#cadastroPessoaFisica").on("submit", function(event){
			event.preventDefault();

			$.ajax({
				url: $("#cadastroPessoaFisica").attr("action"),
				method: $("#cadastroPessoaFisica").attr("method"),
				data: $("#cadastroPessoaFisica").serialize(),
				success: function(data){
					$("#mensagem").html(data);
				}
			})
        });
</script>
<?php include "../Templates/footer.php"; ?>
<style>
    input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
