<?php $view->partial("Components/Header", ['backTo' => '/']); ?>

<div class="rest-container mt-8">
  <div class="address-title">Acesse sua conta:</div>
  <div class="all-container all-container-with-classes">
    <div class="hide request-notification-container map-notification offline-notification map-notification-danger">
      Ops! Algo deu errado.
      <div class="font-weight-light">
        <span id="message"></span>
      </div>
    </div>
    <form class="width-100" method="post" action="#" id="submitForm">
      <div class="form-group form-control-margin">
        <label class="label-title">E-mail</label>
        <div class="input-group">
          <input data-validation="required" class="form-control form-control-with-padding" type="text" name="email"
            autocomplete="off" placeholder="E-mail">
        </div>
      </div>
      <div class="form-group form-control-margin">
        <label class="label-title">Senha</label>
        <div class="input-group">
          <input data-validation="required" class="form-control form-control-with-padding" type="password" name="senha"
            autocomplete="off" placeholder="*****">
        </div>
      </div>
      <div class="form-submit-button text-center">
        <input id="submitButton" type="submit" class="btn btn-dark text-uppercase" value="ACESSE SUA CONTA">
      </div>
    </form>
  </div>
</div>

<script>
$("#submitForm").submit(function(e) {
  e.preventDefault();

  var form = $(this);
  var formData = form.serialize();
  var url = '/main/login';
  $.ajax({
    url: url,
    type: "post",
    data: formData,
    success: function(response) {
      data = JSON.parse(response);
      if (data.success) {
        window.location.href = "/";
      } else {
        console.log(data.message);
        $("#message").text(data.message);
        $(".request-notification-container").removeClass("hide");
      }
    }
  });
});
</script>

<?php $view->partial("Components/Footer"); ?>