<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="Jordana Reichel <jordanavazreichel@gmail.com>" />

  <title>Sige - Sistema de gerenciamento de estoque</title>
  <link type="image/png" href="/assets/imgs/fv.png" rel="icon">
  <!-- Bootstrap core CSS -->
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/css/fontawesome.css" rel="stylesheet" />
  <link href="/assets/css/styles.css" rel="stylesheet" />

  <script src="/assets/js/jquery-3.4.1.js"></script>
  <script src="/assets/js/jquery.loading.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


</head>

<body>
  <div id="load" class="loading-overlay display-flex flex-column justify-content-center align-items-center">
    <div class="primary-color font-28 fas fa-spinner fa-spin"></div>
  </div>
  <div class="row h-100">
    <div class="col-xs-12 col-sm-12">
      <div class="header-icons-container">
        <span>
          <img src="/assets/imgs/logo_sige.svg" width="120px" height="50px" alt="logo">
        </span>
        <?php if ($view->getSession('id')) : ?>
        <a href="#">
          <span class="float-right menu-open closed">
            <img src="/assets/imgs/menu.svg" alt="Menu Hamburger Icon">
          </span>
        </a>
        <?php endif; ?>
      </div>
      <div class="container">
        <?php if ($view->getSession('id')) : ?>
        <div class="header clearfix">
          <div class="main-menu hidden-soft">
            <div class="mini-profile-info">
              <div class="menu-close">
                <span class="float-right">
                  <img src="/assets/imgs/close.svg" alt="Close Icon">
                </span>
              </div>
              <div class="profile-picture text-center">
                <?php
                        $id = $view->getSession('id');
                        $logadoInfo = $view->retornaUsuarioInfo($id);
                    ?>
                <img class="perfil" src="/storage/alunos/<?= $logadoInfo->foto ?>"
                  onerror="this.onerror=null;this.src='/assets/imgs/avatar-default.svg';"
                  alt="<?= $logadoInfo->nome ?>">
              </div>
              <div class="profile-info">
                <div class="profile-name text-center"><?= $logadoInfo->nome ?></div>
                <div class="profile-email text-center"><?= $logadoInfo->email ?></div>
              </div>
            </div>
            <div class="menu-items">
              <div class="all-menu-items">
                <a class="menu-item" href="/produtos">
                  <span class="menu-item-title profile">Produtos</span>
                  <span class="menu-item-click fas fa-arrow-right"></span>
                </a>
                <a class="menu-item" href="/estoque">
                  <span class="menu-item-title profile">Estoque</span>
                  <span class="menu-item-click fas fa-arrow-right"></span>
                </a>
                <h4 class="admin-title-menu"> Área Administrativa</h4>
                <a class="menu-item" href="/usuarios">
                  <span class="menu-item-title profile">Usuários</span>
                  <span class="menu-item-click fas fa-arrow-right"></span>
                </a>
                <h4 class="admin-title-menu">Itens Deletados</h4>
                <a class="menu-item" href="/usuarios/deletados">
                  <span class="menu-item-title profile">Usuários</span>
                  <span class="menu-item-click fas fa-arrow-right"></span>
                </a>
                <a class="menu-item" href="/produtos/deletados">
                  <span class="menu-item-title profile">Produtos</span>
                  <span class="menu-item-click fas fa-arrow-right"></span>
                </a>
                <a class="menu-item" href="/estoque/deletados">
                  <span class="menu-item-title profile">Estoque</span>
                  <span class="menu-item-click fas fa-arrow-right"></span>
                </a>
                <a href="/main/logout" class="menu-item margin-top-auto">
                  <span class="menu-item-icon menu-dark logout">
                    <img src="/assets/imgs/logout.svg" alt="Logout Icon">
                  </span>
                  <span class="menu-item-icon menu-light logout">
                    <img src="/assets/imgs/logout-light.svg" alt="Logout Icon">
                  </span>
                  <span class="menu-item-title logout">Sair</span>
                  <span class="menu-item-click fas fa-arrow-right"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>