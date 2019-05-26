<?php include_once "templates/header.php"; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaFisicaModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PessoaJuridicaModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/PerfisModel.php";

    $pessoaFisicaModel = new PessoaFisicaModel();
    $pessoaFisica = $pessoaFisicaModel->getUsuarioInfo();

    $pessoaJuridicaModel = new PessoaJuridicaModel();
    $pessoaJuridica = $pessoaJuridicaModel->getPessoaJuridicaInfo();

    $PerfisModel = new PerfisModel();
    $perfis = $PerfisModel->getPerfis();
?>

<h3>Lista de usuários</h3>
<br>
<h4>Pessoas Físicas</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome do Usuário</th>
                    <th>Email</th>
                    <th>Estado Civil</th>
                    <th>RG</th>
                    <th>CPF</th>
                    <th>Profissão</th>
                    <th>Perfil</th>
                    <th>Cresci (Corretores)</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($pessoaFisica as $result) {?>
                <td data-idpessoa="<?php echo $result['idPessoa'];?>"><?php echo $result['idPessoa'];?></td>
                <td><?php echo $result['nome'];?></td>
                <td><?php echo $result['emailContato'];?></td>
                <td><?php echo $result['descricaoEstadoCivil'];?></td>
                <td><?php echo $result['rg'];?></td>
                <td><?php echo $result['cpf'];?></td>
                <td><?php echo $result['descricaoProfissao'];?></td>
                <td><?php echo $result['descricaoPerfil'];?></td>
                <td><?php echo $result['cresci'];?></td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"
                         id="btn-updatePerfil" onclick="pegaid();">
                         <i class="fa fa-edit"></i> Alterar Perfil
                    </button>
                </td>
            </tbody>
            <?php } ?>
        </table>
<br>
<h4>Pessoas Jurídicas</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Razão Social</th>
                    <th>Email</th>
                    <th>Cnpj</th>
                    <th>Perfil</th>
                    <th>Cresci (Caso Imobiliária/Construtora)</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($pessoaJuridica as $result2) {?>
                <td data-idpessoa="<?php echo $result2['idpessoa'];?>"><?php echo $result2['idpessoa'];?></td>
                <td><?php echo $result2['razaoSocial'];?></td>
                <td><?php echo $result2['emailContato'];?></td>
                <td><?php echo $result2['cnpj'];?></td>
                <td><?php echo $result2['descricaoperfil'];?></td>
                <td><?php echo $result2['cresci'];?></td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal"
                         id="btn-updatePerfil" onclick="pegaid();">
                        <i class="fa fa-edit"></i> Alterar Perfil
                    </button>
                </td>
            </tbody>
            <?php } ?>
        </table>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Atualizar perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="controllers/adminController.php?acao=updatePerfil">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Selecionar novo perfil:</label>
            <input type="hidden" class="form-control" id="idPessoaUpdatePerfil" name="idPessoaUpdatePerfil">
          </div>

          <select id="perfis" class="form-control" name="perfis" required>
                <option selected>Selecione o perfil</option>
                <?php foreach($perfis as $perfil) { ?>
                <option value="<?php echo $perfil['idPerfil'];?>"> <?php echo $perfil['descricaoPerfil'];?> </option>
                <?php } ?>
          </select>

          <div class="form-group">
            <label for="cresci" class="col-form-label">Cresci (caso perfil seja Corretor): </label>
            <input type="text" class="form-control" id="cresci" name="cresci">
          </div>

         <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Enviar</button>
         </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times-circle"></i> Cancelar</button>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

function pegaid(){

$(document).on('click', '.btn-warning', function(e) {
        e.preventDefault;
        var idPessoa = $(this).closest('tr').find('td[data-idpessoa]').data('idpessoa');
        $('.modal-body #idPessoaUpdatePerfil').val( idPessoa );
    });
}
</script>

<?php include_once "templates/footer.php"; ?>

