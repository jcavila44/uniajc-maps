<!-- SCRIPTS TO PAGE -->
<script> const base_url = "<?= base_url(); ?>"; </script>
<script> const routes = JSON.parse(`<?= routes(); ?>`); </script>
<script src="<?php echo media(); ?>plugins/jquery/dist/jquery.min.js"></script>
<script src="<?php echo media(); ?>plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo media(); ?>plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo media(); ?>plugins/pace-progress/pace.min.js"></script>
<script src="<?php echo media(); ?>plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="<?php echo media(); ?>plugins/@coreui/coreui/dist/js/coreui.min.js"></script>
<script src="<?php echo media(); ?>js/popovers.js"></script>
<!-- Se envia un parametro random a la funcion de JS para limpiar la caché -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="<?= media(); ?>js/functions_page/<?= $data['page_functions_js'] . "?v=" . rand() ?>"></script>
<!-- SCRIPTS TO PAGE -->