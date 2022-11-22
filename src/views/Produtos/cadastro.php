<?php $view->partial("Components/Header", ['backTo' => '/main/stream']); ?>
<div class="rest-container mt-8">
  <div class="address-title">Novo produto:</div>
  <div class="all-container all-container-with-classes">
    <div class="hide request-notification-container map-notification offline-notification map-notification-danger">
      Ops! Algo deu errado.
      <div class="font-weight-light">
        <span id="message"></span>
      </div>
    </div>
    <form class="width-100" method="POST" action="#" id="submitForm">
      <div class="form-group">
        <label for="">Código</label>
        <input data-validation="required" class="form-control" type="number" name="codigo" placeholder="Código">
      </div>
      <div class="form-group">
        <label for="">Nome</label>
        <input data-validation="required" class="form-control" type="text" name="nome" placeholder="Nome">
      </div>
      <div class="form-group">
        <label for="">Status</label>
        <select name="status" id="" class="selectpicker form-control">
          <option value="1">ATIVO</option>
          <option value="2">BLOQUEADO</option>
        </select>
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
  var url = '/Produtos/cadastro';
  $.ajax({
    url: url,
    type: "post",
    data: formData,
    success: function(response) {
      data = JSON.parse(response);
      console.log(data)
      if (!data.error) {
        window.location.href = "/produtos";
      } else {
        $("#message").text(data.msg);
        $(".request-notification-container").removeClass("hide");
      }
    }
  });
});
</script>

<?php $view->partial("Components/Footer"); ?>