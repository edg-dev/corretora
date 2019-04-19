<?php include '../Templates/header.php'; ?>

<form>

    <div class="form-group">
        <label for="nomeCompleto"><span>*</span>Nome completo:</label>
        <input type="text" class="form-control" id="nome" placeholder="Informe seu nome completo">
    </div>

    <div class="form-group">
        <label for="email"><span>*</span>E-mail:</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Informe seu e-mail">
        <small id="emailHelp" class="form-text text-muted">Esse email será para usado para contatos.</small>
    </div>

    <div class="form-group">
        <label for="senha"><span>*</span>Senha:</label>
        <input type="text" class="form-control" id="senha" placeholder="Informe sua senha de acesso">
    </div>

    <div class="row">
        <div class="col">
            <label for="telefone1">Telefone residencial:</label>
            <input type="text" class="form-control" placeholder="Telefone 1">
        </div>
        <div class="col">
            <label for="telefone2">Telefone pessoal:</label>
            <input type="text" class="form-control" placeholder="Telefone 2">
        </div>
    </div>

    <div class="form-group">
        <label for="rg"><span>*</span>RG:</label>
        <input type="text" class="form-control" id="rg" placeholder="Informe seu RG">
    </div>

    <div class="form-group">
        <label for="cpf"><span>*</span>RG:</label>
        <input type="text" class="form-control" id="cpf" placeholder="Informe seu CPF">
    </div>

    <div class="form-row">
        <div class="form-group col-md-10">
            <label for="logradouro">Logradouro:</label>
            <input type="text" class="form-control" id="logradouro" placeholder="Rua, Avenida, etc...">
        </div>

        <div class="form-group col-md-2">
            <label for="numero">Numero:</label>
            <input type="text" class="form-control" id="numero">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" class="form-control" id="cidade" placeholder="Informe sua cidade">
        </div>

        <div class="form-group col-md-4">
            <label for="estado">Estado:</label>
            <select id="estado" class="form-control">
                <option selected>Selecione seu estado</option>
                <option>...</option>
            </select>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label for="estadoCivil">Estado civil:</label>
        <select id="estadoCivil" class="form-control">
            <option selected>Selecione seu estado civil</option>
            <option>...</option>
        </select>
    </div>

    <div class="form-group">
        <label for="profissao"><span>*</span>Profissão:</label>
        <input type="text" class="form-control" id="profissao" placeholder="Informe sua profissão">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include "../Templates/footer.php"; ?>