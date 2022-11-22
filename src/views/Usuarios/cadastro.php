<?php $view->partial("Components/Header", ['backTo' => '/main/stream']); ?>
<div class="rest-container mt-8">
    <div class="address-title">Novo usuário:</div>
      <div class="all-container all-container-with-classes">
        <div class="hide request-notification-container map-notification offline-notification map-notification-danger">
            Ops! Algo deu errado.
            <div class="font-weight-light">
                <span id="message"></span>
            </div>
        </div>
        <form class="width-100" method="POST" action="#" id="submitForm">
            <div class="form-group">
                <label for="">Nome</label>
                <input data-validation="required" class="form-control" type="text" name="nome" placeholder="Nome completo">
            </div>

            <div class="form-group">
                <label for="">E-mail</label>
                <input data-validation="required"  class="form-control" type="text" name="email" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="">Telefone</label>
                <input data-validation="required" data-mask="(51) 99999-9999" class="form-control" type="text" name="telefone" placeholder="Telefone">
            </div>
            <div class="form-group">
                <label for="">Senha</label>
                <input data-validation="required" class="form-control" type="password" name="senha" placeholder="*******">
            </div>
            <div class="form-group">
              <label for="">Status</label>
                <select name="status" id="" class="selectpicker form-control">
                  <option value="1">ATIVO</option>
                  <option value="2">BLOQUEADO</option>
                </select>
            </div>
            <div class="form-group">
              <label for="">Regra</label>
                <select name="regra" id="" class="selectpicker form-control">
                  <option value="1">SUPER-ADMIN</option>
                  <option value="2">ADMIN</option>
                </select>
            </div>
            <div class="form-group">
              <label for="">Regra</label>
                <select name="sexo" id="" class="selectpicker form-control">
                  <option value="1">MASCULINO</option>
                  <option value="2">FEMININO</option>
                </select>
            </div>
            <div class="form-submit-button text-center">
                <input id="submitButton" type="submit" class="btn btn-dark text-uppercase" value="CADASTRAR">
            </div>
        </form>
      </div>
    </div>
</div>

<script>
  $("#submitForm").submit(function(e) {
      e.preventDefault();

      var form = $(this);
      var formData = form.serialize();
      var url = '/Usuarios/cadastro';
      $.ajax({
          url: url,
          type: "post",
          data: formData,
          success: function(response) {
              data = JSON.parse(response);
              console.log(data)
              if (!data.error) {
                  window.location.href = "/usuarios";
              } else {
                  $("#message").text(data.msg);
                  $(".request-notification-container").removeClass("hide");
              }
          }
      });
  });
</script>

<?php $view->partial("Components/Footer"); ?>