<?php headerAdmin($data); ?>
<link href="<?php echo media(); ?>plugins/leaflet/leaflet.css" rel="stylesheet">

<div class="col-md-12">

  <div class="row">

    <div class="col-12 col-md-12">
      <div class="card p-4" style="max-height: 400px ; overflow: auto;">
        <table id="tableGestorMapas" class="table table-bordered table-hover"></table>
        <input type="hidden" id="rol_id" name="rol_id" value="<?php echo $_SESSION['rol_id'] ?>">
      </div>
    </div>

  </div>

  <div class="row" id="rowCardsMapas">
  </div>

  <?php if ($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == 2) : ?>
    <a onclick="AddMapas()" class="btn-flotante">Agregar Mapa</a>
  <?php endif ?>
</div>

<?php footerAdmin($data); ?>