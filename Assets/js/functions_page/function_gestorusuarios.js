


const onClickAgregarUsuarios = () => {

  const htmlModal = `
    <div class="col-mb-12" style="font-size: 14px; text-align: left;">
      <div class="row">
        <div class="col-md-6 mb-2">
          <label for="name">Nombre</label>
          <input class="form-control" id="nombreUsuario" name="nombreUsuario" type="text" placeholder="Nombre del Usuario">
        </div>
        <div class="col-md-6 mb-2">
          <label for="name">Apellido</label>
          <input class="form-control" id="ApellidoUsuario" name="ApellidoUsuario" type="text" placeholder="Apellido del Usuario">
        </div>
        <div class="col-md-6 mb-2">
          <label for="name">Fecha nacimiento</label>
          <input class="form-control" id="fehcaNacimientoUsuario" name="fehcaNacimientoUsuario" type="date" >
        </div>
        <div class="col-md-6 mb-3">
          <label for="name">Correo</label>
          <input class="form-control" id="CorreoUsuario" name="CorreoUsuario" type="email" placeholder="Correo del Usuario">
        </div>
        <div class="col-md-6 mb-2">
          <button onclick="onClickGenerarPassword()" class="btn btn-info btn-block">Generar contraseña 👉🏼</button>
        </div>
        <div class="col-md-6 mb-2">
          <input disabled class="form-control"  id="GenerarContraseñaUsuario" name="GenerarContraseñaUsuario" type="email" placeholder="Contraseña Generada">
        </div>
        <div class="col-md-6 mb-3">
          <label for="name">Telefono</label>
          <input class="form-control" id="telefonoUsuario" name="telefonoUsuario" type="number" placeholder="Telefono del Usuario">
        </div>
        <div class="col-md-6 mb-2">
          <label for="select1">Rol</label>
          <select class="form-control" id="select1" name="select1">
              <option disabled selected>Seleccione...</option>
              <option value="1">Option #1</option>
              <option value="2">Option #2</option>
              <option value="3">Option #3</option>
          </select>
        </div>
      </div>
    </div>
  `;

  Swal.fire({
    title: 'Agregar Usuario',
    html: htmlModal,
    showCancelButton: true,
    confirmButtonText: 'Guardar',
    confirmButtonColor: '#4dbd74',
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#6c757d',
  }).then((result) => {

    if (result.value) {
      Swal.fire({
        icon: 'success',
        html: '<h3>Usuario agregado correctamente!</h3>',
        showConfirmButton: true,
        confirmButtonText: 'Continuar',
        confirmButtonColor: '#0069d9',
        showCancelButton: false,
      });
    }
  });

}

const onClickGenerarPassword = () => {

  console.log('se generò un password');

}