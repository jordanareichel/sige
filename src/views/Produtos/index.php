<?php $view->partial("Components/Header", ['backTo' => '/main/stream']); ?>
<div class="header-icons-container text-center position-relative alunos">
  <form action="/produtos/index" id="formGet" method="get">
    <input value="<?= $search ?>" type="text" placeholder="Buscar ..." name="nome" class="form-control" id="nome">
    <a href="#" id="search" class="btn btn-block btn-success btn-sm mt-2"><i class="fa fa-search"></i> Buscar</a>
  </form>
</div>
<div class="rest-container-full mt-8">
  <a href="/dashboard" class="btn btn-success btn-sm mt-4"> Voltar</a>
  <a href="/produtos/cadastro" class="btn btn-success btn-sm mt-4"> Novo produto</a>
  <a href="/pdf/produtosPdf" class="btn btn-success btn-sm mt-4"> GERAR RELATÓRIO</a>
  <div class="all-wide-container trip-history-driver-container">
    <div class="all-sales-history-items">
      <?php foreach ($produtos as $p) : ?>
      <div class="display-flex align-items-center sales-history-item">
        <div class="width-100">
          <div>Código</div>
          <div class=font-weight-normal"><span
              class="label-title font-15 font-weight-normal"><?= $p->codigo ?></strong></span></div>
        </div>
        <div class="width-100">
          <div>Produto</div>
          <div class=font-weight-normal"><span
              class="label-title font-15 font-weight-normal"><?= $p->nome ?></strong></span></div>
        </div>
        <div class="width-100">
          <div>Status</div>
          <div class=font-weight-normal"><span
              class="<?=($p->status == 2) ? 'text-danger' : 'text-success' ?> label-title font-15 font-weight-normal">
              <?=($p->status == 2) ? 'BLOQUEADO' : 'ATIVO' ?>
              </strong></span>
          </div>
        </div>
        <a href="/produtos/editar?id=<?= $p->id ?>" class="href-decoration-none" title="Editar Produto">
          <div class="float-right">
            <i class="fa fa-edit"></i>
          </div>
        </a>
        <a href="/produtos/status?id=<?= $p->id ?>&status=<?= $p->status?>"
          title="<?=($p->status == 2) ? 'Ativar' : 'Bloquear' ?>"
          class="<?=($p->status == 2) ? 'text-danger' : 'text-success' ?> href-decoration-none ml-1">
          <div class="float-right">
            <i class="fa fa-ban"></i>
          </div>
        </a>
        <a href="/produtos/delete?id=<?= $p->id ?>" class="href-decoration-none ml-1 text-danger"
          title="Deletar Produto">
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