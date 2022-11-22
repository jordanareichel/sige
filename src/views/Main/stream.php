<?php $view->partial("Components/Header"); ?>

<?php if ($primeiroAcesso === true) : ?>
<div class="rest-container mt-8">
  <div class="container">
    <div class="request-notification-container map-notification offline-notification map-notification-success">
      Seu cadastro foi realizado co sucesso!
      <div class="font-weight-light">
        Este será seu dashboard, onde você poderá acompanhar tudo o que acontece na SIGE.
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php $view->partial("Components/Footer"); ?>