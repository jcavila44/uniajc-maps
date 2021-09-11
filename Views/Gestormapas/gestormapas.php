<?php headerAdmin($data); ?>

<style>
  .btn-flotante {
    font-size: 14px;
    text-transform: uppercase;
    font-weight: bold;
    color: #ffffff !important;
    border-radius: 5px;
    letter-spacing: 2px;
    background-color: #e91e63;
    padding: 10px 20px;
    cursor: pointer;
    position: fixed;
    bottom: 40px;
    right: 40px;
    transition: all 300ms ease 0ms;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    z-index: 99;
  }

  .btn-flotante:hover {
    background-color: #2c2fa5;
    box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
    transform: translateY(-7px);
  }

  #mapid {
    height: 580px;
  }

  @media only screen and (max-width: 600px) {
    .btn-flotante {
      font-size: 14px;
      padding: 12px 20px;
      bottom: 20px;
      right: 20px;
    }
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
                    <div class="col-6 col-md-6 mb-2">
                      <button type="button" class="btn btn-outline-success btn-block">
                        <i class="icon-pencil icons font-2xl d-block"></i>
                      </button>
                    </div>
                    <div class="col-6 col-md-6 mb-2">
                      <button onclick="eliminarMapa(<?php echo $i; ?>);" type="button" class="btn btn-outline-danger btn-block">
                        <i class="icon-trash icons font-2xl d-block"></i>
                      </button>
                    </div>
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