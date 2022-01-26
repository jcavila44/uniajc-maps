<!-- SCRIPTS TO PAGE -->
<script>
  const base_url = "<?= base_url(); ?>";
</script>
<script>
  const routes = JSON.parse(`<?= routes(); ?>`);
</script>
<script type="text/javascript" src="<?php echo media(); ?>plugins/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>plugins/popper.js/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>plugins/pace-progress/pace.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>plugins/@coreui/coreui/dist/js/coreui.min.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>js/popovers.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> -->
<script type="text/javascript" src="<?php echo media(); ?>js/functions_page/helpers.js"></script>
<script type="text/javascript" src="<?php echo media(); ?>js/functions_page/validadores_formularios.js"></script>
<script type="text/javascript" src="<?= media(); ?>js/functions_page/<?= $data['page_functions_js'] . "?v=" . rand() ?>"></script> <!-- Se envia un parametro random a la funcion de JS para limpiar la caché -->
<!-- SCRIPTS TO PAGE -->