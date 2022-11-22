<?php $view->partial("Components/Header", ['backTo' => '/']); ?>

<div class="rest-container-full mt-8">
  <?php if ($view->getSession('regra') != 1) : ?>
  <div class="request-notification-container map-notification offline-notification map-notification-danger">
    Ops! Você não tem permissão para cadastrar ou alterar usuários.
    <div class="font-weight-light">
      <span id="message"></span>
    </div>
  </div>
  <?php endif ?>
  <a href="/relatorios" class="btn btn-danger btn-sm mt-4"> Voltar</a>
  <a href="/pdf/usuariosDeletadosPdf" class="btn btn-danger btn-sm mt-4"> GERAR RELATÓRIO</a>
  <div class="all-wide-container trip-history-driver-container">
    <h4>Usuários deletados</h4>
    <div class="all-sales-history-items">
      <?php foreach ($usuarios as $u) : ?>
      <?php  $usuarioResponsavel = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $u->usuario_responsavel"); ?>
      <div class="display-flex align-items-center sales-history-item">
        <div class="width-100">
          <div class="<?=($u->status == 2) ? 'text-danger' : 'text-success' ?>"><?= $u->nome ?></div>
          <div class="font-weight-normal"><span class="label-title font-15 "
              font-weight-normal"><?= $u->email ?></strong></span></div>
        </div>
        <div class="width-100">
          <div class="<?=($u->status == 2) ? 'text-danger' : 'text-success' ?>">
            <?=($u->status == 2) ? 'BLOQUEADO' : 'ATIVO' ?>
          </div>
          <div class="font-weight-normal"><span class="label-title font-15 "
              font-weight-normal"><?= $u->telefone ?></strong></span></div>
        </div>
        <div class="width-100">
          <div class="<?=($u->status == 2) ? 'text-danger' : 'text-success' ?>">
            Data da exclusão
          </div>
          <div class="font-weight-normal"><span class="label-title font-15 "
              font-weight-normal"><?= date("d-m-Y H:i:s", strtotime($u->data_delete)); ?></strong></span></div>
        </div>
        <div class="width-100">
          <div class="<?=($u->status == 2) ? 'text-danger' : 'text-success' ?>">
            Usuário responsável
          </div>
          <div class="font-weight-normal"><span class="label-title font-15 "
              font-weight-normal"><?= $usuarioResponsavel->nome ?></strong></span></div>
        </div>
        <a href="/usuarios/voltarUsuario?id=<?= $u->id ?>" title="Ativar usuário"
          class=" <?=($u->status == 2) ? 'text-danger' : 'text-success' ?> href-decoration-none ml-1">
          <div class="float-right">
            <i class="fa fa-ban"></i>
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