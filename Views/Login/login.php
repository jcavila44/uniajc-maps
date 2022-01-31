<?php
$data = array();
$data['page_tag'] = 'Login';
$data['page_title'] = 'Login';
$data['page_name'] = 'Login';
$data['page_functions_js'] = 'function_login.js';
?>

<!DOCTYPE html>
<html lang="es">
<?php require_once('./Views/Partials/head_admin.php'); ?>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>Inicio de sesión</h1>
              <p class="text-muted">Ingresa el correo y la contraseña para ingresar al sistema.</p>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-user"></i>
                  </span>
                </div>
                <input id="correo" name="correo" class="form-control" type="text" placeholder="Correo">
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="icon-lock"></i>
                  </span>
                </div>
                <input id="password" name="password" class="form-control" type="password" placeholder="Contraseña">
              </div>
              <div class="row">
                <div class="col-6">
                  <button onclick="onClickIngresar()" class="btn btn-primary px-4" type="button">Ingresar</button>
                </div>
                <div class="col-6 text-right">
                  <a href="<?php echo ROUTES['app']['ForgotPassword'] ?>" class="btn btn-link px-0" type="button">Recuperar contraseña</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once('./Views/Partials/scripts_admin.php'); ?>
</body>

</html>