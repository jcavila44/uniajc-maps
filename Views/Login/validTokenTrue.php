<!DOCTYPE html>
<html lang="es">
<?php require_once('./Views/Partials/head_admin.php'); ?>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Restablecer contraseña</h1>
                            <p class="text-muted mb-1">Ingresa la nueva contraseña</p>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-lock"></i>
                                    </span>
                                </div>
                                <input id="password" name="password" class="form-control" type="password" placeholder="Contraseña">
                                <input id="usu_id" name="usu_id" class="form-control" type="hidden" placeholder="Contraseña" value="<?php echo $data['info_token']['usu_id'] ?>">
                                <div class="input-group-append">

                                    <span onclick="onClickViewPassword('password', 'passwordIcon')" class="input-group-text cursor-pointer">
                                        <i class="icon-magnifier-add" id="passwordIcon"></i>
                                    </span>

                                </div>
                            </div>
                            <p class="text-muted mb-1">Confirma la nueva contraseña</p>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-lock"></i>
                                    </span>
                                </div>
                                <input id="passwordConfirmation" name="passwordConfirmation" class="form-control" type="password" placeholder="Contraseña">
                                <div class="input-group-append">

                                    <span onclick="onClickViewPassword('passwordConfirmation', 'passwordConfirmationIcon')" class="input-group-text cursor-pointer">
                                        <i class="icon-magnifier-add" id="passwordConfirmationIcon"></i>
                                    </span>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button onclick="saveRecoverPassword()" class="btn btn-primary px-4" type="button">Guardar</button>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="<?php echo ROUTES['app']['Login'] ?>" class="btn btn-link px-0" type="button">Regresar al Login</a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="alert alert-danger" style="display:none" id="alert-diferrent-password" role="alert">Las contraseñas no coinciden</div>
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