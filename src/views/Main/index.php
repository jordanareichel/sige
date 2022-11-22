<?php $view->partial("Components/Header"); ?>
<div class="rest-container">
  <div class="text-center header-icon-logo-margin header-icon-logo-margin-extra">
    <div class="profile-picture-container">
      <img src="/assets/imgs/logo_sige.svg" width="220px" alt="logo">
    </div>
  </div>
  <div class="address-title">---</div>
  <div class="sign-up-form-container">
    <div class="width-100">
      <div class="border-bottom-primary ">
        <a href="/main/login" class="home-options-list href-decoration-none">
          Acesse sua conta
          <span class="fas fa-check icon chosen hidden"></span>
          <span class="icon choose float-right">
            <img src="/assets/imgs/angle-right.svg" alt="Angle Right Icon">
          </span>
        </a>
      </div>
    </div>
  </div>
</div>
<?php $view->partial("Components/Footer"); ?>