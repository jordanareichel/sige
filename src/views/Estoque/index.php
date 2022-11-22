<?php $view->partial("Components/Header", ['backTo' => '/']); ?>

<div class="header-icons-container text-center position-relative alunos">
  <form action="/estoque/index" id="formGet" method="get">
    <input value="<?= $search ?>" type="text" placeholder="Buscar pelo código ..." name="nome" class="form-control"
      id="nome">
    <a href="#" id="search" class="btn btn-block btn-success btn-sm mt-2"><i class="fa fa-search"></i> Buscar</a>
  </form>
</div>
<div class="rest-container-full mt-8">
  <a href="/dashboard" class="btn btn-success btn-sm mt-4"> Voltar</a>
  <a href="/estoque/cadastro" class="btn btn-success btn-sm mt-4"> CADASTRAR</a>
  <a href="/pdf/estoquePdf" class="btn btn-success btn-sm mt-4"> GERAR RELATÓRIO</a>
  <div class="all-wide-container trip-history-driver-container">
    <div class="all-sales-history-items">
      <?php foreach ($estoque as $e) : ?>
      <?php $produtoNome = $this->mysql()->row("SELECT * FROM produtos WHERE id = '$e->produto'"); ?>
      <div class="display-flex align-items-left sales-history-item">
        <div class="width-100">
          <div>Produto</div>
          <div><?= $produtoNome->nome ?></div>
        </div>
        <div class="width-100">
          <div>Código</div>
          <div>#<?= $e->codigo ?></div>
        </div>
        <div class="width-100">
          <div>Quantidade</div>
          <div><?= $e->quantidade ?></div>
        </div>
        <div class="width-100">
          <div><?= $e->localizacao ?></div>
        </div>
        <div class="width-100">
          <div>Data de Entrada</div>
          <div>
            <?= date("d-m-Y H:i:s", strtotime($e->data_entrada)); ?></div>
        </div>
        <div class="width-100">
          <div>Status</div>
          <div class="<?=($e->status == 2) ? 'text-danger' : 'text-success' ?>">
            <?=($e->status == 2) ? 'BLOQUEADO' : 'ATIVO' ?></div>
        </div>
        <a href="/estoque/editar?id=<?= $e->id ?>" class="href-decoration-none">
          <div class="float-right">
            <i class="fa fa-edit"></i>
          </div>
        </a>
        <a href="/estoque/status?id=<?= $e->id ?>&status=<?= $e->status?>"
          class=" <?=($e->status == 2) ? 'text-danger' : 'text-success' ?> href-decoration-none ml-1">
          <div class="float-right">
            <i class="fa fa-ban"></i>
          </div>
        </a>
        <a href="/estoque/delete?id=<?= $e->id ?>" class="href-decoration-none ml-1">
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