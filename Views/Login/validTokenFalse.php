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
                            <h1>Token invalido</h1>
                            <p class="text-muted">El link que haz usado ha vencido o no estás usando el ultimo que se generó</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('./Views/Partials/scripts_admin.php'); ?>
</body>

</html>