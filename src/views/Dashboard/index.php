<?php $view->partial("Components/Header"); ?>
<div class="rest-container mt-12">
  <div class="container">
    <div class="request-notification-container map-notification offline-notification map-notification-success">
      Bem vindo ao Sige!
      <div class="font-weight-light">
        Este será seu dashboard, onde você poderá acompanhar todas as funcionalidades no SIGE.
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="container">
      <a href="/usuarios" style="color: black">
        <div class="request-notification-container map-notification offline-notification map-notification-success">
          <i class="fa fa-user"></i>
          Funcionários
          <div class="font-weight-light">
            Cadastro de usuários no sistema!
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <a href="/produtos" style="color: black">
      <div class="container">
        <div class="request-notification-container map-notification offline-notification map-notification-success">
          <i class="fa fa-cubes"></i>
          PRODUTOS
          <div class="font-weight-light">
            Cadastro de produtos no sistema!
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-6">
    <a href="/estoque" style="color: black">
      <div class="container">
        <div class="request-notification-container map-notification offline-notification map-notification-success">
          <i class="fa fa-archive"></i>
          ESTOQUE
          <div class="font-weight-light">
            Cadastro de itens no estoque!
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-6">
    <a href="/relatorios" style="color: black">
      <div class="container">
        <div class="request-notification-container map-notification offline-notification map-notification-success">
          <i class="fa fa-sticky-note"></i>
          RELATORIOS
          <div class="font-weight-light">
            Emissão de relatórios
          </div>
        </div>
      </div>
    </a>
  </div>
</div>
<?php $view->partial("Components/Footer"); ?>