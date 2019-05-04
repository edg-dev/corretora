<?php include '../Templates/header.php'; ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<h2> Cadastro de Pessoa Física </h2>

<form>
    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="nomeCompleto"><span>*</span>Nome completo:</label>
            <input type="text" class="form-control" id="nome" placeholder="Informe seu nome completo" name="nome">
        </div>
        <div class="form-group col-md-2">
            <label for="sexo"><span>*</span>Sexo</label>
		    <select class="form-control" id="sexo" placeholder="Selecione seu Sexo">
			    <option value="masculino">Masculino</option>
			    <option value="feminino">Feminino</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="email"><span>*</span>E-mail:</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Informe seu e-mail" name="email">
        <small id="emailHelp" class="form-text text-muted">Esse email será para usado para contatos.</small>
    </div>

    <div class="form-group">
        <label for="senha"><span>*</span>Senha:</label>
        <input type="text" class="form-control" id="senha" placeholder="Informe sua Senha de acesso" name="senha">
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="telefone1">Telefone residencial:</label>
            <input type="text" class="form-control" placeholder="Telefone 1" name="telefone1">
        </div>
        <div class="form-group col-md-6">
            <label for="telefone2">Telefone pessoal:</label>
            <input type="text" class="form-control" placeholder="Telefone 2" name="telefone2">
        </div>
    </div>

    <div class="form-group">
        <label for="rg"><span>*</span>RG:</label>
        <input type="text" class="form-control" id="rg" placeholder="Informe seu RG" name="rg">
    </div>

    <div class="form-group">
        <label for="cpf"><span>*</span>CPF:</label>
        <input type="text" class="form-control" id="cpf" placeholder="Informe seu CPF" name="cpf">
    </div>
    
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
			<option value="AC">Acre</option>
			<option value="AL">Alagoas</option>
			<option value="AP">Amapá</option>
			<option value="AM">Amazonas</option>
			<option value="BA">Bahia</option>
			<option value="CE">Ceará</option>
			<option value="DF">Distrito Federal</option>
			<option value="ES">Espírito Santo</option>
			<option value="GO">Goiás</option>
			<option value="MA">Maranhão</option>
			<option value="MT">Mato Grosso</option>
			<option value="MS">Mato Grosso do Sul</option>
			<option value="MG">Minas Gerais</option>
			<option value="PA">Pará</option>
			<option value="PB">Paraíba</option>
			<option value="PR">Paraná</option>
			<option value="PE">Pernambuco</option>
			<option value="PI">Piauí</option>
			<option value="RJ">Rio de Janeiro</option>
			<option value="RN">Rio Grande do Norte</option>
			<option value="RS">Rio Grande do Sul</option>
			<option value="RO">Rondônia</option>
			<option value="RR">Roraima</option>
			<option value="SC">Santa Catarina</option>
			<option value="SP">São Paulo</option>
			<option value="SE">Sergipe</option>
			<option value="TO">Tocantins</option>
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

    <div class="form-group">
        <label>Estado Civil:</label>
        <select class="form-control" id="estadoCivil" placeholder="Informe seu Estado Civil">
        <option value="Casado">Casado</option>
        <option value="Solteiro">Solteiro</option>
        <option value="Divorciado">Divorciado</option>
        <option value="Viuvo">Viuvo</option>
        </select>
    </div>

    <div class="form-group">
        <label for="profissao"><span>*</span>Profissão:</label>
        <input type="text" class="form-control" id="profissao" placeholder="Informe sua profissão" name="profissao">
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
