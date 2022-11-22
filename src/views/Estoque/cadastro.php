<?php $view->partial("Components/Header", ['backTo' => '/']); ?>
<?php $produtos = $this->mysql()->table("SELECT * FROM produtos WHERE id > 0 AND deletado is Null $query ORDER BY status ASC, nome ASC") ?>

<div class="rest-container mt-8">
  <div class="address-title"></div>
  <div class="all-container all-container-with-classes">
    <div class="hide request-notification-container map-notification offline-notification map-notification-danger">
      Ops! Algo deu errado.
      <div class="font-weight-light">
        <span id="message"></span>
      </div>
    </div>
    <form class="width-100" method="POST" action="#" id="submitForm">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for="">Código</label>
            <input data-validation="required" class="form-control" type="text" name="codigo" placeholder="Código">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Produto</label>
            <select name="produto" id="" class="selectpicker form-control">
              <?php foreach ($produtos as $p) : ?>
              <option value="<?= $p->id?>"><?= $p->nome ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="">Quantidade</label>
            <input data-validation="required" class="form-control" type="text" name="quantidade"
              placeholder="Quantidade">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Localização</label>
            <input data-validation="required" class="form-control" type="text" name="localizacao"
              placeholder="Localização">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="selectpicker form-control">
              <option value="1">ATIVO</option>
              <option value="2">INATIVO</option>
            </select>
          </div>
        </div>
        <input type="hidden" name="data_entrada">
      </div>
      <div class="form-submit-button text-center">
        <input id="submitButton" type="submit" class="btn btn-dark text-uppercase" value="CADASTRAR">
      </div>
    </form>
  </div>
</div>

<script>
$("#submitForm").submit(function(e) {
  e.preventDefault();

  var form = $(this);
  var formData = form.serialize();
  var url = '/Estoque/cadastro';
  $.ajax({
    url: url,
    type: "post",
    data: formData,
    success: function(response) {
      data = JSON.parse(response);
      console.log(data)
      if (!data.error) {
        window.location.href = "/estoque";
      } else {
        $("#message").text(data.msg);
        $(".request-notification-container").removeClass("hide");
      }
    }
  });
});
</script>

<?php $view->partial("Components/Footer"); ?>