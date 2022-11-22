<?php $view->partial("Components/Header", ['backTo' => '/main/stream']); ?>
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
  <a href="/pdf/produtosDeletadosPdf" class="btn btn-danger btn-sm mt-4"> GERAR RELATÓRIO</a>
  <div class="all-wide-container trip-history-driver-container">
    <h4>Produtos deletados</h4>
    <div class="all-sales-history-items">
      <?php foreach ($produtos as $p) : ?>
      <?php $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $p->usuario_responsavel"); ?>
      <div class="display-flex align-items-center sales-history-item">
        <div class="width-100">
          <div class="<?=($p->status == 2) ? 'text-danger' : 'text-success' ?>">Produto</div>
          <div class=font-weight-normal"><span
              class="label-title font-15 font-weight-normal"><?= $p->nome ?></strong></span></div>
        </div>
        <div class="width-100">
          <div class="<?=($p->status == 2) ? 'text-danger' : 'text-success' ?>">Status</div>
          <div class="<?=($p->status == 2) ? 'text-danger' : 'text-success' ?>">
            <?=($p->status == 2) ? 'BLOQUEADO' : 'ATIVO' ?>
          </div>
        </div>
        <div class="width-100">
          <div class="<?=($p->status == 2) ? 'text-danger' : 'text-success' ?>">
            Data da exclusão
          </div>
          <div class=font-weight-normal"><span
              class="label-title font-15 font-weight-normal"><?= date("d-m-Y H:i:s", strtotime($p->data_exclusao)); ?></strong></span>
          </div>
        </div>
        <div class="width-100">
          <div class="<?=($p->status == 2) ? 'text-danger' : 'text-success' ?>">
            Usuário responsável
          </div>
          <div class=font-weight-normal"><span
              class="label-title font-15 font-weight-normal"><?= $usuario->nome ?></strong></span></div>
        </div>
        <a href="/produtos/voltarProduto?id=<?= $p->id ?>" title="Ativar produto"
          class=" <?=($p->status == 2) ? 'text-danger' : 'text-success' ?> href-decoration-none ml-1">
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