<?php $view->partial("Components/Header", ['backTo' => '/']); ?>
<?php $produtoNome = $this->mysql()->row("SELECT * FROM produtos WHERE id = '$estoque->produto'"); ?>

<div class="row h-100 mt-8">
  <div class="col-xs-12 col-sm-12">
    <div class="rest-container">
      <div class="text-center header-icon-logo-margin">
        <div class="display-flex flex-column">
          <span class="profile-name"><?= $estoque->codigo ?></span>
          <span class="profile-email font-weight-light"><?= $estoque->nome ?></span>
        </div>
      </div>
      <div class="sign-up-form-container">
        <form class="width-100" method="POST" action="">
          <div class="form-group">
            <label for="">Código</label>
            <input disabled value="<?= ($estoque->codigo) ? $estoque->codigo : '' ?>" class="form-control" type="text"
              name="codigo" placeholder="Código">
          </div>
          <div class="form-group">
            <label for="">Produto</label>
            <input value="<?= ($estoque->produto) ? $estoque->produto : '' ?>" class="form-control" type="hidden"
              name="produto" placeholder="Nome completo">
            <input value="<?= ($estoque->produto) ? $produtoNome->nome : '' ?>" class="form-control" type="text">
          </div>
          <div class="form-group">
            <label for="">Quantidade</label>
            <input value="<?= ($estoque->quantidade) ? $estoque->quantidade : '' ?>" class="form-control" type="text"
              name="quantidade" placeholder="Quantidade">
          </div>
          <div class="form-group">
            <label for="">Localização</label>
            <input value="<?= ($estoque->localizacao) ? $estoque->localizacao : '' ?>" class="form-control" type="text"
              name="localizacao" placeholder="Localização">
          </div>
          <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="selectpicker form-control">
              <option value="1" <?= ($estoque->status == 1) ? 'selected' : '' ?>>ATIVO</option>
              <option value="2" <?= ($estoque->status == 2) ? 'selected' : '' ?>>BLOQUEADO</option>
            </select>
          </div>
          <input type="hidden" name="data_atualizacao" value="<?= date("Y-m-d H:i:s") ?>">
          <input type="hidden" name="data_entrada" value="<?= $estoque->data_entrada ?>">
          <hr>
          <div class="form-submit-button">
            <a href="/estoque" class="btn btn-dark btn-block text-uppercase ">SALVAR<span
                class="far fa-save margin-left-10"></span></a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(".form-control").on('change', (e) => {
  e.preventDefault();
  let form = $(e.target).closest('form');
  let data = form.serialize();
  $.ajax({
    url: '/estoque/editar?id=<?= $estoque->id ?>',
    type: 'POST',
    data: data,
    success: (response) => {
      console.log(response);
    }
  });
})
</script>

<?php $view->partial("Components/Footer"); ?>