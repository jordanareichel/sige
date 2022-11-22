<?php $view->partial("Components/Header", ['backTo' => '/']); ?>
<div class="header-icons-container text-center position-relative alunos">
  <form action="/usuarios/index" id="formGet" method="get">
    <input value="<?= $search ?>" type="text" placeholder="Buscar ..." name="nome" class="form-control" id="nome">
    <a href="#" id="search" class="btn btn-block btn-success btn-sm mt-2"><i class="fa fa-search"></i> Buscar</a>
  </form>
</div>
<div class="rest-container-full mt-8">
  <?php if ($view->getSession('regra') != 1) : ?>
  <div class="request-notification-container map-notification offline-notification map-notification-danger">
    Ops! Você não tem permissão para cadastrar ou alterar usuários.
    <div class="font-weight-light">
      <span id="message"></span>
    </div>
  </div>
  <?php endif ?>
  <a href="/dashboard" class="btn btn-success btn-sm mt-4"> Voltar</a>
  <a href="/usuarios/cadastro" class="btn btn-success btn-sm mt-4"> Novo usuário</a>
  <a href="/pdf/usuariosPdf" class="btn btn-success btn-sm mt-4"> GERAR RELATÓRIO</a>
  <div class="all-wide-container trip-history-driver-container">
    <div class="all-sales-history-items">
      <?php foreach ($usuarios as $u) : ?>
      <div class="display-flex align-items-center sales-history-item">
        <div class="width-100">
          <div class="<?=($u->status == 2) ? 'text-danger' : 'text-success' ?>"><?= $u->nome ?></div>
          <div class=font-weight-normal"><span
              class="label-title font-15 font-weight-normal"><?= $u->email ?></strong></span></div>
        </div>
        <a href="/usuarios/editar?id=<?= $u->id ?>" class="href-decoration-none" title="Editar">
          <div class="float-right">
            <i class="fa fa-edit"></i>
          </div>
        </a>
        <a href="/usuarios/status?id=<?= $u->id ?>&status=<?= $u->status?>"
          title="<?=($u->status == 2) ? 'Ativar' : 'Bloquear' ?>"
          class=" <?=($u->status == 2) ? 'text-danger' : 'text-success' ?> href-decoration-none ml-1">
          <div class="float-right">
            <i class="fa fa-ban"></i>
          </div>
        </a>
        <a href="/usuarios/delete?id=<?= $u->id ?>" class="href-decoration-none ml-1" title="Deletar">
          <div class="float-right">
            <i class="fa fa-trash"></i>
          </div>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script>
$("#search").on('click', (e) => {
  $("#formGet").submit();
});
</script>
<?php $view->partial("Components/Footer"); ?>