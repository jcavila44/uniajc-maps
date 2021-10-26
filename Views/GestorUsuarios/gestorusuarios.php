<?php headerAdmin($data); ?>

<style>
  .swal2-html-container {
    overflow: unset;
  }
</style>

<div class="col-md-12 mb-5">
  <div class="row">

    <div class="col-12 col-md-12">
      <div class="card p-4">
        <div class="row">
          <div class="col-12 text-center col-md-4">
            <h4>Gestor de usuarios </h4>
          </div>
          <div class="col">
            <hr />
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-12">
      <div class="card p-4" style="max-height: 400px ; overflow: auto;">
        <table id="tableGestorUsuarios" class="table table-bordered table-hover"></table>
      </div>
    </div>


  </div>

  <a onclick="onClickAgregarUsuarios()" class="btn-flotante">Agregar Usuario</a>
</div>

<?php footerAdmin($data); ?>