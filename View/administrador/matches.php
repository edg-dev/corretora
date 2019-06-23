<?php include_once "templates/header.php"; ?>

<?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/Rotina.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/execRotina.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TelefoneModel.php";
    
    $rotina = new Rotina();
    $exec = new execRotina();
    $telefoneModel = new TelefoneModel();

    $pedido = $rotina->selectAllPedidos();
?>

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Matches</li>
        </ol>

<h3>Lista de pedidos que tem anúncios semelhantes cadastrados.</h3>

<table class="table">
    <thead>
        <tr>
            <th>ID Usuário</th>
            <th>Nome usuário</th>
            <th>Email Usuário</th>
            <th>Telefones</th>
            <th>Detalhes</th>
            <th>ID Anunciante</th>
            <th>Nome do Anunciante</th>
            <th>Email do Anunciante</th>
            <th>Telefones</th>
        </tr>
    </thead>

    <tbody>
        <?php $count = 0; ?>
        <?php foreach($pedido as $res) { 
            $anuncio = $exec->execMatches($res);
        ?>

        <td><?php echo $res['idUsuario']?></td>
        <td><?php echo $res['nome']?></td>
        <td><?php echo $res['emailContato']?></td>
        <td>
            <?php 
                $telefones = $telefoneModel->getTelefonesById($res['idUsuario']);

                foreach($telefones as $telefone) { ?>
                    <?php echo $telefone['telefone'];?> <br>
                <?php } ?>
        </td>
        <td> 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo<?php echo $count; ?>">
                <i class="fa fa-info-circle"></i> Detalhes
            </button> 
        </td>

				<!-- Modal detalhes -->
		<div class="modal fade" id="modalExemplo<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		    <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				    <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Match</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
                    </div>
                    
				    <div class="modal-body">
                        <div class="row">

                            <!-- Pedido -->

                            <div class="col-md-6">
                                <h4>Pedido:</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        Tipo do Imóvel:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $res['descricaoTipoImovel']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Transação:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $res['descricaoTransacao']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Bairro:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $res['nomeBairro']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Cidade:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $res['nomeCidade']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Estado:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $res['descricaoEstado']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Quantidade de quartos:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $res['quantQuarto']; ?>
                                    </div>
                                </div><hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        Quantidade de suítes:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $res['quantSuite']; ?>
                                    </div>
                                </div><hr>
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        Quantidade de banheiros:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $res['quantBanheiro']; ?>
                                    </div>
                                </div><hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        Vagas na garagem:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $res['quantVagaGaragem']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Faixa de preço:
                                    </div>
                                    <div class="col-md-6">
                                        Preço mínimo: <?php echo $res['precoMin']; ?> <br> 
                                        Preço máximo: <?php echo $res['precoMax']; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Anúncio -->

                            <div class="col-md-6">
                                <h4>Anúncio:</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        Tipo do Imóvel:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['descricaoTipoImovel']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Transação:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['descricaoTransacao']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Bairro:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['nomeBairro']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Cidade:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['nomeCidade']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Estado:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['descricaoEstado']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Quantidade de quartos:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['quantQuarto']; ?>
                                    </div>
                                </div><hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        Quantidade de suítes:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['quantSuite']; ?>
                                    </div>
                                </div><hr>
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        Quantidade de banheiros:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['quantBanheiro']; ?>
                                    </div>
                                </div><hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        Vagas na garagem:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['quantVagaGaragem']; ?>
                                    </div>
                                </div><hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        Preço do imóvel:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['precoImovel']; ?>
                                    </div>
                                </div><hr>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        Descrição do imóvel:
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $anuncio[0]['descricaoImovel']; ?>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>

				    <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				    </div>
				</div>
			</div>
		</div>

        <td><?php echo $anuncio[0]['idUsuario']?></td>
        <td><?php echo $anuncio[0]['nome']?></td>
        <td><?php echo $anuncio[0]['emailContato']?></td>
        <td>
            <?php 
                $telefones = $telefoneModel->getTelefonesById($anuncio[0]['idUsuario']);

                foreach($telefones as $telefone) { ?>
                    <?php echo $telefone['telefone'];?> <br>
                <?php } ?>
        </td>

    </tbody>
        <?php $count++; ?>
        <?php } ?>
</table>

<?php include_once "templates/footer.php"; ?>