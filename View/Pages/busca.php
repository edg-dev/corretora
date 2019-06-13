<?php include '../Templates/header.php'; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImagensImovelModel.php";

    $imagensImovelModel = new ImagensImovelModel();
    $imagens = $imagensImovelModel->getAllImagens();

    
?>

        <?php 
        require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/config/DataBase/dbConfig.php";

        // filtros da busca 
        $cidade = isset($_GET['cidade']) ? $_GET['cidade'] : '';
        $bairro = isset($_GET['bairro']) ? $_GET['bairro'] : '';

        $transacao = isset($_GET['transacao']) ? $_GET['transacao'] : '';
        $tipoDeImovel = isset($_GET['tipoDeImovel']) ? $_GET['tipoDeImovel'] : ''; 
        $estado = isset($_GET['estado']) ? $_GET['estado'] : ''; 

        // inicia a query, mas os filtros serão adicionados dinamicamente 
        // o 1=1 é adicionado no WHERE para garantir que sempre haverá uma condição na busca, 
        // evitando erro de sintaxe caso o usuário não selecione filtro algum 
        $sql = "SELECT i.idImovel, b.nomeBairro, c.nomeCidade, es.descricaoEstado, en.numero, en.logradouro,
				i.areaUtil, i.areaTotal, i.precoImovel, i.descricaoImovel, i.quantQuarto, i.quantSuite, i.quantVagaGaragem, 
				i.quantBanheiro, ti.descricaoTipoImovel, tr.descricaoTransacao from imovel as i
				inner join transacao as tr on i.idTransacao = tr.idTransacao
				inner join tipoimovel as ti on i.idTipoImovel = ti.idTipoImovel
				inner join anuncio as a on i.idImovel = a.idImovel
				inner join endereco as en on i.idEndereco = en.idEndereco
				inner join bairro as b on en.idBairro = b.idBairro
				inner join cidade as c on en.idCidade = c.idCidade
				inner join estado as es on en.idEstado = es.idEstado
				WHERE
                1=1 and a.verificado = 1 and (i.negociacao = 0 or i.negociacao is null)"; 
        // cria um array com os filtros a serem aplicados 
        $filters = []; 
        if (!empty($cidade)) 
        { 
            $filters[] = [ 
                'placeholder' => ':cidade',
                'sql' => '(c.nomeCidade LIKE :cidade)',
                'value' => '%' . $cidade . '%',
                'param_type' => PDO::PARAM_STR,
            ];
        }
        if (!empty($bairro)) 
        { 
            $filters[] = [ 
                'placeholder' => ':bairro',
                'sql' => '(b.nomeBairro LIKE :bairro)',
                'value' => '%' . $bairro . '%',
                'param_type' => PDO::PARAM_STR,
            ];
        }
        
        if (!empty($transacao))
        {
            $filters[] = [
                'placeholder' => ':transacao',
                'sql' => 'tr.idTransacao = :transacao',
                'value' => $transacao,
                'param_type' => PDO::PARAM_INT,
            ];
        }
        if (!empty($tipoDeImovel))
        {
            $filters[] = [
                'placeholder' => ':tipoDeImovel',
                'sql' => 'ti.idTipoImovel = :tipoDeImovel',
                'value' => $tipoDeImovel,
                'param_type' => PDO::PARAM_INT,
            ];
        }
        if (!empty($estado))
        {
            $filters[] = [
                'placeholder' => ':estado',
                'sql' => 'es.idEstado = :estado',
                'value' => $estado,
                'param_type' => PDO::PARAM_INT,
            ];
        }
        
        foreach ($filters as $filter)
        {
            $sql .= " AND " . $filter['sql'];
        }
        
        $bd = BancoDados::obterConexao();

        // cria o Prepared Statement
        $stmt = $bd->prepare($sql);
        
        // faz o bind dos valores dos filtros
        foreach ($filters as $filter)
        {
            $stmt->bindValue($filter['placeholder'], $filter['value'], $filter['param_type']);
        }
        
        // executa a query
        $stmt->execute();
        
        // cria um array com os resultados
        $imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

<!--Começo da view -->

                <!-- Page Content -->
                <div class="container">

                <!-- Page Heading -->
                <h1 class="my-4">Anúncios</h1>
                    
                <!-- Project One -->
                <?php $count = 0; ?>
                <?php if (count($imoveis) > 0): ?>
                <?php foreach($imoveis as $imovel){?>

                <div class="row">
                <div class="col-md-7">
                        <a href="#">

                        <?php
                            $idImovel = $imovel['idImovel'];
                            $res = $imagensImovelModel->getImagemImovelIndex($idImovel);

                        if(empty($res)){
                        ?>
                            <img class="img-fluid" style="width:750px;height:300px;" src="/corretora/Files/no_image.png">
                        <?php } ?>

                        <?php foreach($res as $imagem){ ?>
                            <img class="img-fluid" style="width:750px;height:300px;" src="/corretora/Files/<?php echo $imagem;?>"  >
                        <?php } ?>  
                        </a>
                </div>
                <div class="col-md-5">
                        <p><b>Transação:</b>      
                        <?php echo $imovel['descricaoTransacao'];?>
                        
                        <b>um(a)</b>
                        <?php echo $imovel['descricaoTipoImovel'];?></p>

                        <p><b>Preço: R$</b>        
                        <?php echo $imovel['precoImovel'];?></p>

                        <p><b>Área útil:</b>
                        <?php echo $imovel['areaUtil'];?> M² ;

                        <b>Área total:</b>
                        <?php echo $imovel['areaTotal'];?> M² ;</p>

                        <p><img src="https://img.icons8.com/windows/32/000000/bed.png" title="Quantidade de Quartos:">:
                        <?php echo $imovel['quantQuarto'];?> quartos </p>

                        <p><img src="https://img.icons8.com/metro/32/000000/shower-and-tub.png" title="Quantidade de Suítes:">:
                        <?php echo $imovel['quantSuite'];?> suítes </p>

                        <p><img src="https://img.icons8.com/ios/32/000000/car.png" title="Quantidade de Vagas na Garagem:">
                        <?php echo $imovel['quantVagaGaragem'];?> vagas </p>

                        <p><img src="https://img.icons8.com/ios/32/000000/shower.png" title="Quantidade de Banheiros:">
                        <?php echo $imovel['quantBanheiro'];?> banheiros </p>

                        <!-- Modal --> 

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo<?php echo $count; ?>">
                            <i class="fa fa-info-circle"></i> Detalhes
                        </button>

                        <button type="button" class="btn btn-success" 
                        onclick="window.location.href='/corretora/View/Pages/anuncio.php?id=<?php echo $imovel['idImovel'];?>'">
                            <i class="fa fa-arrow-right"></i> Visualizar
                        </button>

                        <div class="modal fade" id="modalExemplo<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalhes e Localização</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <p><b>Estado:</b>
                                <?php echo $imovel['descricaoEstado'];?>.</p>

                                <p><b>Cidade:</b>
                                <?php echo $imovel['nomeCidade'];?>.</p>

                                <p><b>Bairro:</b>
                                <?php echo $imovel['nomeBairro'];?>.</p>

                                <p><b>Rua:</b>
                                <?php echo $imovel['logradouro'];?>.</p>

                                <p><b>Número:</b>
                                <?php echo $imovel['numero'];?>.</p>                              
                               
                                <p><b>Descrição do Imovel:</b>
                                <?php echo $imovel['descricaoImovel'];?>.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                            </div>
                        </div>
                        </div>

                </div>
                </div>
                <!-- /.row -->
                <hr>
                    <?php $count++; ?>
                    <?php } ?> <!-- foreach fecha aki --> 
                    <?php else: ?>
                <div class="container">
                <h1>Nenhum anúncio foi encontrado!</h1>
                <br><br><br><br><br><br><br><br><br>
                </div>
                <br><br>
                    <?php endif; ?>
    </div>

<?php include "../Templates/footer.php"; ?>