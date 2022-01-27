

<!DOCTYPE html>
<html lang="es">
<?php require_once('./Views/Partials/head_admin.php'); 

?>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h1>Hemos enviado el link de recuperacion</h1>
                            <p class="text-muted">Al correo <?php echo $data['emailUser'] ?> Ahí encontrarás las instrucciones de recuperacion de tu contraseña.</p>
                            <div class="row">
                                <div class="col-6">
                                    <a href="<?php echo ROUTES['app']['Login'] ?>" class="btn btn-primary px-4" type="button">Regresar al Login</a>
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