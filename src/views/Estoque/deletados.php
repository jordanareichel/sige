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
  <a href="/pdf/estoqueDeletadosPdf" class="btn btn-danger btn-sm mt-4"> GERAR RELATÓRIO</a>
  <div class="all-wide-container trip-history-driver-container">
    <h4>Itens deletados do estoque</h4>
    <div class="all-sales-history-items">
      <?php foreach ($estoque as $e) : ?>
      <?php $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $e->usuario_responsavel"); ?>
      <?php $produtoNome = $this->mysql()->row("SELECT * FROM produtos WHERE id = $e->produto"); ?>
      <div class="display-flex align-items-center sales-history-item">
        <div class="width-100">
          <div class="<?=($e->status == 2) || ($e->deletado == 1) ? 'text-danger' : 'text-success' ?>">Produto</div>
          <div class="font-weight-normal"><span
              class="<?=($e->status == 2) || ($e->deletado == 1) ? 'text-danger' : 'text-success' ?> label-title font-15 font-weight-normal"><?= $produtoNome->nome ?></strong></span>
          </div>
        </div>
        <div class="width-100">
          <div class="<?=($e->status == 2) || ($e->deletado == 1) ? 'text-danger' : 'text-success' ?>">Status</div>
          <div class="<?=($e->status == 2) || ($e->deletado == 1) ? 'text-danger' : 'text-success' ?>">
            <?=($e->status == 2) ? 'BLOQUEADO' : 'ATIVO' ?>
          </div>
        </div>
        <div class="width-100">
          <div class="<?=($e->status == 2) || ($e->deletado == 1) ? 'text-danger' : 'text-success' ?>">
            Data da exclusão
          </div>
          <div class="font-weight-normal"><span
              class="<?=($e->status == 2) || ($e->deletado == 1) ? 'text-danger' : 'text-success' ?> label-title font-15 font-weight-normal"><?= date("d-m-Y H:i:s", strtotime($e->data_exclusao)); ?></strong></span>
          </div>
        </div>
        <div class="width-100">
          <div class="<?=($e->status == 2) || ($e->deletado == 1) ? 'text-danger' : 'text-success' ?>">
            Usuário responsável
          </div>
          <div class="font-weight-normal"><span
              class="<?=($e->status == 2) || ($e->deletado == 1) ? 'text-danger' : 'text-success' ?> label-title font-15 font-weight-normal"><?= $usuario->nome ?></strong></span>
          </div>
        </div>
        <a href="/estoque/voltarEstoque?id=<?= $e->id ?>" title="Ativar produto"
          class=" <?=($e->status == 2) ? 'text-danger' : 'text-success' ?> href-decoration-none ml-1">
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