<?php include '../Templates/header.php'; ?>
<h2> Cadastro de Pessoa Física </h2>
<form>
    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="nomeCompleto"><span>*</span>Nome completo:</label>
            <input type="text" class="form-control" id="nome" placeholder="Informe seu nome completo" name="nome">
        </div>
        <div class="form-group col-md-2">
            <label for="sexo"><span>*</span>Sexo:</label>
            <select id="sexo" class="form-control" name="sexo">
                <option selected>Selecione seu sexo</option>
                <option>...</option>
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
        <input type="text" class="form-control" id="senha" placeholder="Informe sua senha de acesso" name="senha">
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
        <input type="text" class="form-control" id="rg" placeholder="Informe seu RG" name="rg">
    </div>

    <div class="form-group">
        <label for="cpf"><span>*</span>CPF:</label>
        <input type="text" class="form-control" id="cpf" placeholder="Informe seu CPF" name="cpf">
    </div>

    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="logradouro">Logradouro:</label>
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
            <label for="estado"><span>*</span>Estado:</label>
            <select id="estado" class="form-control" name="estado">
                <option selected>Selecione seu estado</option>
                <option>...</option>
            </select>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label for="estadoCivil"><span>*</span>Estado civil:</label>
        <select id="estadoCivil" class="form-control" name="estadoCivil">
            <option selected>Selecione seu estado civil</option>
            <option>...</option>
        </select>
    </div>

    <div class="form-group">
        <label for="profissao"><span>*</span>Profissão:</label>
        <input type="text" class="form-control" id="profissao" placeholder="Informe sua profissão" name="profissao">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include "../Templates/footer.php"; ?>
