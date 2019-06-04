<?php include_once "templates/header.php"; 

      

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/UsuarioModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/AnuncioModel.php";

    $usuarioModel = new UsuarioModel();
    $users = $usuarioModel->countUsers();

    $anuncioModel = new AnuncioModel();
    $anuncios = $anuncioModel->countAnuncios();
    $anunciosAP = $anuncioModel->countAnunciosAprovacao();

    
?>


        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Visão Geral</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-user-plus"></i>
                </div>
                <div class="mr-5"><?php echo intval($users['total']);?> Usuários cadastrados</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="usuarios.php">
                <span class="float-left">Detalhes</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-bullhorn"></i>
                </div>
                <div class="mr-5"> <?php echo intVal($anunciosAP['total']); ?> Anúncios para aprovação</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="anuncios.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-bullhorn"></i>
                </div>
                <div class="mr-5"><?php echo intVal($anuncios['total']); ?> Anúncios Totais</div>
              </div>
            </div>
          </div>
<!--
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">13 New Tickets!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
-->
          </div>
        </div>

<?php include_once "templates/footer.php"; ?>