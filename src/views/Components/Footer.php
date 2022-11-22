<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/main.js"></script>
<script src="/assets/js/jquery.mask.js"></script>
<script src="/assets/js/form-validator/jquery.form-validator.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
<?php if ($view->getSession('error')) : ?>
Swal.fire({
  title: 'Ops!',
  text: '<?= $view->getSession('error') ?>',
  type: 'error',
  confirmButtonText: 'Ok'
});
<?php $view->setSession('error', false) ?>
<?php endif; ?>

<?php if ($view->getSession('success')) : ?>
Swal.fire({
  title: 'Parabéns!',
  text: '<?= $view->getSession('success') ?>',
  type: 'success',
  confirmButtonText: 'Ok'
});
<?php $view->setSession('success', false) ?>
<?php endif; ?>
</script>
<script>
$(document).ready(function() {
  $.validate({
    modules: 'security',
    lang: 'pt'
  });
});
</script>
</div>
</body>

</html>