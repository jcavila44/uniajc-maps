<?php headerAdmin($data); ?>

<style>


  #mapid {
    height: 580px;
  }

</style>

<div class="col-md-12">
  <div class="row">
    <?php
    for ($i = 0; $i <  10; $i++) {
    ?>
      <div class="col-md-4 cardMapas">
        <div class="row">
          <div class="col-md-12">
            <div class="card p-3 hover-card">
              <div class="row">
                <div class="col-md-4" style="display: flex; align-items: center;">
                  <img class="card-img-top" src="<?php echo media(); ?>img/gestor-mapas/map.svg" alt="Card image cap" width="100%" />
                </div>
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-12 text-center mb-2">
                      <h4>
                        Mapa # <?php echo $i; ?>
                      </h4>
                    </div>
                    <?php if($_SESSION['rol_id'] == "1" || $_SESSION['rol_id'] == "2" ): ?>
                    <div class="col-6 col-md-6 mb-2">
                      <button type="button" class="btn btn-outline-success btn-block">
                        <i class="icon-pencil icons font-2xl d-block"></i>
                      </button>
                    </div>
                    <?php endif ?>

                    <?php if($_SESSION['rol_id'] == "1"): ?>
                    <div class="col-6 col-md-6 mb-2">
                      <button onclick="eliminarMapa(<?php echo $i; ?>);" type="button" class="btn btn-outline-danger btn-block">
                        <i class="icon-trash icons font-2xl d-block"></i>
                      </button>
                    </div>
                    <?php endif ?>
                    
                    <div class="col-6 col-md-6 mb-2">
                      <button type="button" class="btn btn-outline-success btn-block">
                        <i class="icon-layers icons font-2xl d-block"></i>
                      </button>
                    </div>
                    <div class="col-6 col-md-6 mb-2">
                      <button onclick="verMapa(<?php echo $i; ?>);" type="button" class="btn btn-outline-success btn-block">
                        <i class="icon-eye icons font-2xl d-block"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>

  <a onclick="AddMapas()" class="btn-flotante">Agregar Mapa</a>
</div>

<?php footerAdmin($data); ?>