<?php $view->partial("Components/Header", ['backTo' => '/main/stream']); ?>
<div class="row h-100 mt-8">
  <div class="col-xs-12 col-sm-12">
    <div class="rest-container">
      <div class="sign-up-form-container">
        <form class="width-100" method="POST" action="">
          <div class="form-group">
            <label for="">Alterar senha</label>
            <br>
            <small>Preencher somente caso queira realizar a alteração.</small>
            <input class="form-control" type="text" name="senha">
          </div>
          <hr>
          <div class="form-group">
            <label for="">Nome</label>
            <input value="<?= ($usuario->nome) ? $usuario->nome : '' ?>" class="form-control" type="text" name="nome"
              placeholder="Nome completo">
          </div>
          <div class="form-group">
            <label for="">WhatsApp</label>
            <input disabled data-mask="(51) 99999-9999" value="<?= ($usuario->telefone) ? $usuario->telefone : '' ?>"
              class="form-control" type="text" name="telefone" placeholder="WhatsApp">
          </div>
          <div class="form-group">
            <label for="">E-mail</label>
            <input value="<?= ($usuario->email) ? $usuario->email : '' ?>" class="form-control" type="email"
              name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="selectpicker form-control">
              <option value="1" <?= ($usuario->status == 1) ? 'selected' : '' ?>>ATIVO</option>
              <option value="2" <?= ($usuario->status == 2) ? 'selected' : '' ?>>BLOQUEADO</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Regra</label>
            <select name="regra" id="" class="selectpicker form-control">
              <option value="1" <?= ($usuario->regra == 1) ? 'selected' : '' ?>>SUPER-ADM</option>
              <option value="2" <?= ($usuario->regra == 2) ? 'selected' : '' ?>>ADMIN</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Sexo</label>
            <select name="sexo" id="" class="selectpicker form-control">
              <option value="1" <?= ($usuario->sexo == 1) ? 'selected' : '' ?>>Masculino</option>
              <option value="2" <?= ($usuario->sexo == 2) ? 'selected' : '' ?>>Feminino</option>
            </select>
          </div>
          <hr>
          <div class="form-submit-button">
            <a href="/usuarios" class="btn btn-dark btn-block text-uppercase ">SALVAR<span
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
    url: '/usuarios/editar?id=<?= $usuario->id ?>',
    type: 'POST',
    data: data,
    success: (response) => {
      console.log(response);
    }
  });
})
</script>
<?php $view->partial("Components/Footer"); ?>