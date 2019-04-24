<?php include '../Templates/header.php'; ?>

    <div class="form-group col-md-6">
        <b><h1>Cadastro do Imóvel:</h1></b> 
    </div>

<form action="">
    <div class="form-group col-md-6">
        <b><label for="transacao">Transação</label></b>
        <select id="transacao" class="form-control">
            <option selected>Opções de transação:</option>
            <option>Alugar</option>
            <option>Vender</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <b><label for="tipoDeImovel">Que tipo de imóvel você quer anunciar?</label></b>
        <select id="tipoDeImovel" class="form-control">
            <option selected>Escolha o tipo de imóvel:</option>
            <option>Apartamento Padrão</option>
            <option>Kitchenette/Conjugados</option>
            <option>Loft</option>
            <option>Casa Padrão</option>
            <option>Terreno Padrão</option>
            <option>Box/Garagem</option>
            <option>Casa Comercial</option>
            <option>Casa de Condomínio</option>
            <option>Casa de Vila</option>
            <option>Chácara</option>
            <option>Conjunto Comercial/Sala</option>
            <option>Fazenda</option>
            <option>Flat</option>
            <option>Galpão/Deposito/Armazém</option>
            <option>Haras</option>
            <option>Hotel</option>
            <option>Indústria</option>
            <option>Loja Shopping/Ct Comercial</option>
            <option>Loja/Salão</option>
            <option>Loteamento/Condomínio</option>
            <option>Motel</option>
            <option>Pousada/Chalé</option>
            <option>Prédio Interno</option>
            <option>Sítio</option>
            <option>Studio</option>
        </select>
    </div>

    <div class="form-group col-md-6">
        <b><h1>Onde fica seu imóvel?</h1></b> 
    </div>
    <div class="form-group col-md-6">
        <label for="cep"><span>*</span>Cep:</label>
        <input type="text" class="form-control" id="cep" placeholder="00000-000">
        <input type="text" class="form-control" id="estado" placeholder="Estado">
        <input type="text" class="form-control" id="cidade" placeholder="Cidade">
    </div>
    <div class="form-group col-md-6">
        <label for="endereco">Endereço:</label>
        <input type="text" class="form-control" id="bairro" placeholder="Bairro">
        <input type="text" class="form-control" id="rua" placeholder="Rua">
        <input type="text" class="form-control" id="complemento" placeholder="Complemento">
    </div>

    <div class="form-group col-md-6">
        <b><h1 for="localImovel">Dados principais do imóvel:</h1></b>
    </div>
    <div class="form-group col-md-6">
        <label for="quarto">Quartos:</label>
        <input type="text" class="form-control" id="quarto" placeholder="0">
    </div>
    <div class="form-group col-md-6">
        <label for="suite">Suítes (Opcional):</label>
        <input type="text" class="form-control" id="suite" placeholder="0">
    </div>
    <div class="form-group col-md-6">
        <label for="vagaGaragem">Vagas de garagem (Opcional):</label>
        <input type="text" class="form-control" id="vagaGaragem" placeholder="0">
    </div>
    <div class="form-group col-md-6">
        <label for="banheiro">Banheiros:</label>
        <input type="text" class="form-control" id="banheiro" placeholder="0">
    </div>
    <div class="form-group col-md-6">
        <label for="areaUtil">Área útil (M²):</label>
        <input type="text" class="form-control" id="areaUtil" placeholder="000">
    </div>
    <div class="form-group col-md-6">
        <label for="areaTotal">Área total (M²) (Opcional):</label>
        <input type="text" class="form-control" id="areaTotal" placeholder="000">
    </div>
    <div class="form-group col-md-6">
        <label for="descricao">Descrição (Opcional):</label>
        <input type="text" class="form-control" id="descricao" placeholder="Descrição do imóvel">
    </div>

    <div class="form-group col-md-6">
        <b><h1>Quanto custa seu imóvel?</h1></b> 
    </div>
    <div class="form-group col-md-6">
        <label for="precoImovel">Valor total de venda (R$):</label>
        <input type="text" class="form-control" id="precoImovel" placeholder="000 000">
    </div>
    
    <div class="form-group col-md-6">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>

</form>

<?php include "../Templates/footer.php"; ?>
