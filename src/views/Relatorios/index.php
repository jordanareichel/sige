<?php $view->partial("Components/Header"); ?>
<div class="rest-container mt-12">
  <div class="container">
    <div class="request-notification-container map-notification offline-notification map-notification-danger">
      Bem vindo a parte de relatórios!
      <div class="font-weight-light">
        Este será seu dashboard, onde você poderá acompanhar todas os itens excluídos do sistema.
      </div>
      <a href="/dashboard" style="color: red">Voltar a Dashboard</a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <div class="container">
      <a href="/usuarios/deletados" style="color: black">
        <div class="request-notification-container map-notification offline-notification map-notification-danger">
          <i class="fa fa-user"></i>
          Funcionarios
        </div>
      </a>
    </div>
  </div>
  <div class="col-md-4">
    <a href="/produtos/deletados" style="color: black">
      <div class="container">
        <div class="request-notification-container map-notification offline-notification map-notification-danger">
          <i class="fa fa-cubes"></i>
          PRODUTOS
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="/estoque/deletados" style="color: black">
      <div class="container">
        <div class="request-notification-container map-notification offline-notification map-notification-danger">
          <i class="fa fa-archive"></i>
          ESTOQUE
        </div>
      </div>
    </a>
  </div>
</div>

<?php $view->partial("Components/Footer"); ?>