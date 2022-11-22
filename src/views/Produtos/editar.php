<?php $view->partial("Components/Header", ['backTo' => '/']); ?>

<div class="row h-100 mt-8">
  <div class="col-xs-12 col-sm-12">
    <div class="rest-container">
      <div class="sign-up-form-container">
        <form class="width-100" method="POST" action="">
          <div class="form-group">
            <label for="">Código</label>
            <input disabled value="<?= ($produto->codigo) ? $produto->codigo : '' ?>" class="form-control" type="text"
              name="codigo" placeholder="Código">
          </div>
          <div class="form-group">
            <label for="">Nome</label>
            <input value="<?= ($produto->nome) ? $produto->nome : '' ?>" class="form-control" type="text" name="nome"
              placeholder="Nome completo">
          </div>
          <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="selectpicker form-control">
              <option value="1" <?= ($produto->status == 1) ? 'selected' : '' ?>>ATIVO</option>
              <option value="2" <?= ($produto->status == 2) ? 'selected' : '' ?>>BLOQUEADO</option>
            </select>
          </div>
          <input type="hidden" name="data_atualizacao" value="<?= date("Y-m-d H:i:s") ?>">
          <hr>
          <div class="form-submit-button">
            <a href="/produtos" class="btn btn-dark btn-block text-uppercase ">SALVAR<span
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
    url: '/produtos/editar?id=<?= $produto->id ?>',
    type: 'POST',
    data: data,
    success: (response) => {
      console.log(response);
    }
  });
})
</script>
<?php $view->partial("Components/Footer"); ?>