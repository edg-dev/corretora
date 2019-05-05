<?php include '../Templates/header.php'; 
    
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EstadoModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EstadoCivilModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/SexoModel.php";

    $acao = "create";

    $estadoModel = new EstadoModel();
    $estados = $estadoModel->getAllEstado();

    $estadoCivilModel = new EstadoCivilModel();
    $estadosCivil = $estadoCivilModel->getAllEstadoCivil();
    
    $sexoModel = new SexoModel();
    $sexo = $sexoModel->getAllSexo();
?>

<h2> Cadastro de Pessoa Física </h2>
<form method="POST" id="cadastroPessoaFisica" action="/corretora/Controller/PessoaFisicaController.php?acao=<?=$acao?>">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nomeCompleto"><span>*</span>Nome completo:</label>
            <input type="text" class="form-control" id="nome" placeholder="Informe seu nome completo" name="nome" required>
        </div>
   
        <div class="form-group col-md-4">
            <label for="estadoCivil"><span>*</span>Estado civil:</label>
            <select id="estadoCivil" class="form-control" name="estadoCivil" required>
                <option selected>Selecione seu estado civil</option>
                <?php foreach($estadosCivil as $estadoCivil){?>
                <option value="<?php echo $estadoCivil['idEstadoCivil'];?>"> <?php echo $estadoCivil['descricaoEstadoCivil'];?> </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-md-2">
            <label for="sexo"><span>*</span>Sexo:</label>
            <select id="sexo" class="form-control" name="sexo" required>
                <option selected>Selecione seu sexo</option>
                <?php foreach($sexo as $opcao) { ?>
                <option value="<?php echo $opcao['codigoSexo'];?>"> <?php echo $opcao['descricaoSexo'];?> </option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="email"><span>*</span>E-mail:</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Informe seu e-mail" name="email" required>
        <small id="emailHelp" class="form-text text-muted">Esse email será para usado para contatos.</small>
    </div>

    <div class="form-group">
        <label for="senha"><span>*</span>Senha:</label>
        <input type="password" class="form-control" id="senha" placeholder="Informe sua senha de acesso" name="senha" required>
    </div>

    <div class="row">
        <div class="col">
            <label for="telefone1">Telefone residencial:</label>
            <input type="text" class="form-control" placeholder="Telefone 1" name="telefone1">
        </div>
        <div class="col">
            <label for="telefone2">Telefone pessoal:</label>
            <input type="text" class="form-control" placeholder="Telefone 2" name="telefone2">
        </div>
    </div>

    <div class="form-group">
        <label for="rg"><span>*</span>RG:</label>
        <input type="text" class="form-control" id="rg" placeholder="Informe seu RG" name="rg" required>
    </div>

    <div class="form-group">
        <label for="cpf"><span>*</span>CPF:</label>
        <input type="number" class="form-control" id="cpf" placeholder="Informe seu CPF" name="cpf" required>
    </div>

    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="logradouro">Logradouro:</label>
            <input type="text" class="form-control" id="logradouro" placeholder="Rua, Avenida, etc..." name="logradouro" required>
        </div>

        <div class="form-group col-md-2">
            <label for="numero"><span>*</span>Numero:</label>
            <input type="number" class="form-control" id="numero" name="numero" required>
        </div>
    </div>

    <div class="form-group">
        <label for="cpf">Complemento:</label>
        <input type="text" class="form-control" id="complemento" placeholder="Opcional" name="complemento">
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="cep"><span>*</span>CEP:</label>
            <input type="number" class="form-control" id="cep" placeholder="Informe seu CEP" name="cep" required>
        </div>

        <div class="form-group col-md-4">
            <label for="bairro"><span>*</span>Bairro:</label>
            <input type="text" class="form-control" id="bairro" placeholder="Informe seu bairro" name="bairro" required>
        </div>

        <div class="form-group col-md-4">
            <label for="cidade"><span>*</span>Cidade:</label>
            <input type="text" class="form-control" id="cidade" placeholder="Informe sua cidade" name="cidade" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="estado"><span>*</span>Estado:</label>
            <select id="estado" class="form-control" name="estado" required>
                <option selected>Selecione seu estado</option>
                <?php foreach($estados as $estado){?>
                <option value="<?php echo $estado['idEstado'];?>"> <?php echo $estado['descricaoEstado'];?> </option>
                <?php }?>
            </select>
        </div>

        <div class="form-group col-md-8">
            <label for="profissao"><span>*</span>Profissão:</label>
            <input type="text" class="form-control" id="profissao" placeholder="Informe sua profissão" name="profissao" required>
        </div>
    </div>  

    <button type="submit" class="btn btn-primary">Cadastrar Usuário</button>
    <div id="mensagem"></div>
</form>

<script type="text/javascript">
		
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

