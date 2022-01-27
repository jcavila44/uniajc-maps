<!DOCTYPE html>
<html lang="es">
<?php require_once('./Views/Partials/head_admin.php'); ?>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Forgot Password</h1>
                            <p class="text-muted">Ingresa el correo de la cuenta para recuperar la contraseña</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-user"></i>
                                    </span>
                                </div>
                                <input id="correo" name="correo" class="form-control" type="text" placeholder="Correo" value="jjosecastro@estudiante.uniajc.edu.co">
                            </div>
                            <div class="row">
                                <div class="col-8 p-0">
                                    <button onclick="onClickForgotPassword()" class="w-100 btn btn-primary px-4" type="button">Recuperar contraseña</button>
                                </div>
                                <div class="col-4 text-right p-0">
                                    <a href="<?php echo ROUTES['app']['Login'] ?>" class="btn btn-link px-0" type="button">Regresar al Login</a>
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