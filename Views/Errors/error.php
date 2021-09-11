<?php
$data = array();
$data['page_tag'] = 'Error';
$data['page_title'] = 'Error';
$data['page_name'] = 'Pagina principal';
$data['page_functions_js'] = 'function_error.js';
?>

<!DOCTYPE html>
<html lang="es">
<?php require_once('./Views/Partials/head_admin.php'); ?>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="clearfix">
          <h1 class="float-left display-3 mr-4">404</h1>
          <h4 class="pt-3">Oops! Página no encontrada.</h4>
        </div>
      </div>
    </div>
  </div>

  <?php require_once('./Views/Partials/scripts_admin.php'); ?>
</body>

</html>