<?php include '../Templates/header.php'; 
    
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EstadoModel.php";

    $acao = "create";

    $estadoModel = new EstadoModel();
    $estados = $estadoModel->getAllEstado();

?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<h2> Cadastro de Pessoa Jurídica </h2>

<form method="POST" id="cadastroPessoaJuridica" action="/corretora/Controller/PessoaJuridicaController.php?acao=<?=$acao?>">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <div class="form-group">
        <label for="nome"><span>*</span>Nome Completo</label>
        <input type="text" class="form-control" id="nome" placeholder="Informe o Nome Completo" required>
	</div>
	
	<div class="form-group">
        <label for="razaoSocial"><span>*</span>Razão Social</label>
        <input type="text" class="form-control" id="razaoSocial" placeholder="Informe a Razão Social" required>
    </div>

    <div class="form-group">
        <label for="email"><span>*</span>E-mail:</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Informe seu E-mail" name="email">
        <small id="emailHelp" class="form-text text-muted">Esse email será para usado para contatos.</small>
    </div>

    <div class="form-group">
        <label for="senha"><span>*</span>Senha</label>
        <input type="password" class="form-control" id="senha" placeholder="Informe sua Senha de acesso" required>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="telefone1">Telefone Empresarial 1</label>
            <input type="text" class="form-control" id="telefone1" placeholder="Telefone 1">
        </div>
        <div class="form-group col-md-6">
            <label for="telefone2">Telefone Empresarial 2</label>
            <input type="text" class="form-control" id="telefone2" placeholder="Telefone 2">
        </div>
    </div>

    <div class="form-group">
        <label for="cnpj"><span>*</span>CNPJ</label>
        <input type="text" class="form-control" id="cnpj" placeholder="Informe o CNPJ">
    </div>

    <!--Endereco Completo com uma funcao de Buscar Atomaticamente-->
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="cep"><span>*</span>CEP:</label>
            <input type="text" class="form-control" id="cep" placeholder="Informe sua cidade" name="cep">
        </div>

        <div class="form-group col-md-4">
            <label for="cidade"><span>*</span>Cidade:</label>
            <input type="text" class="form-control" id="cidade" placeholder="Informe sua cidade" name="cidade">
        </div>

        <div class="form-group col-md-4">
        <label for="uf"><span>*</span>Estado</label>
		<select class="form-control" id="uf" placeholder="Informe seu Estado">
			<?php foreach($estados as $estado){?>
                <option value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                <?php }?>
		</select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="logradouro"><span>*</span>Logradouro:</label>
            <input type="text" class="form-control" id="logradouro" placeholder="Rua, Avenida, etc..." name="logradouro">
        </div>

        <div class="form-group col-md-2">
            <label for="numero"><span>*</span>Numero:</label>
            <input type="text" class="form-control" id="numero" name="numero">
        </div>
    </div>

    <div class="form-group">
        <label for="cpf">Complemento:</label>
        <input type="text" class="form-control" id="complemento" placeholder="Opcional" name="complemento">
    </div>


	<button type="button" class="btn btn-primary btn-lg btn-block" value="submit">Cadastrar</button>
	
</form>
<br>
<p style="text-align:center">Já possui uma conta?	<a href="../login/user/login.php">Entre Aqui</a>

<!--JS do CEP -->
<script type="text/javascript">
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