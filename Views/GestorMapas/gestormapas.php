<?php headerAdmin($data); ?>
<link href="<?php echo media(); ?>plugins/leaflet/leaflet.css" rel="stylesheet">

<div class="col-md-12">

  <div class="row">
    
    <div class="col-12 col-md-12">
      <div class="card p-4" style="max-height: 400px ; overflow: auto;">
        <table id="tableGestorMapas" class="table table-bordered table-hover"></table>
      </div>
    </div>

  </div>

  <div class="row" id="rowCardsMapas">
  </div>

  <a onclick="AddMapas()" class="btn-flotante">Agregar Mapa</a>
</div>

<?php footerAdmin($data); ?>