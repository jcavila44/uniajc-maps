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

  </div>

  <a onclick="onClickAgregarUsuarios()" class="btn-flotante">Agregar Usuario</a>
</div>

<?php footerAdmin($data); ?>