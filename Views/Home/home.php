<?php headerAdmin($data); ?>

<div class="row">
  <div class="col-12 col-md-12">
    <div class="card p-4">
      <div class="row">
        <div class="col-12 text-center col-md-4">
          <h4>Home </h4>
        </div>
        <div class="col">
          <hr />
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-12">
    <div class="card p-4">
      <div class="row">
        <div class="col-12 col-md-12 text-center">
          <?php echo showRolToHome($_SESSION); ?>
        </div>
        <div class="col-12 col-md-12 text-center">
          <img class="img-fluid w-50" src="<?php echo media(); ?>img/home/logo-uniajc-azul.png" alt="logo uniajc">
        </div>
      </div>
    </div>
  </div>


</div>

<?php footerAdmin($data); ?>