$(document).ready(function () {
  getAllUsers();
  tableGestorUsuarios = startTable("tableGestorUsuarios");

});



/*
    @descripcion    = getAllUsers() es un llamado ajax que permite mostrar todos los usuarios ingresado al sistema
    @return         = array de los usuarios del sistema
*/

const getAllUsers = () => {

  $.ajax({
    url: base_url + 'gestorusuarios/obtenerUsuariosController',
    type: "GET",
    data: {},
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      overlay(false);

      if (objData.status === "success") {
        // message("Información consultada correctamente", "success");

        let htmlTable = `
            <thead>
              <tr>
                <th>#</th>
                <th>Nombres y apellido</th>
                <th>Cédula</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Eliminar</th>
                <th>Actualizar</th>
              </tr>
            </thead>
            <tbody>
        `;

        objData.data.forEach((element, key) => {

          let jsonInfo = JSON.stringify(element);

          htmlTable += `
            <tr>
              <td> ${key} </td>
              <td> ${wordToCamelCase(element.usu_nombre)} </td>
              <td> ${element.usu_cedula} </td>
              <td> ${element.usu_correo.toLowerCase()} </td>
              <td> ${firstLetterUppercase(element.rol_descripcion)} </td>
              <td> ${firstLetterUppercase(element.estado_descripcion)} </td>
              <td> <button onclick='onClickEliminarUsuario(${jsonInfo})' class="btn btn-primary">Eliminar</button> </td>
              <td> <button onclick='onClickActualizarUsuario(${jsonInfo})' class="btn btn-primary">Actualizar</button> </td>
            </tr>
          `;
        });
        htmlTable += `</tbody>`;

        if (tableGestorUsuarios) { tableGestorUsuarios.destroy() }

        document.getElementById('tableGestorUsuarios').innerHTML = htmlTable;
        tableGestorUsuarios = startTable("tableGestorUsuarios");


      } else {
        message("Ocurrió un error inesperado, por favor vuelva a intentar", "warning");
      }

    },
    error: () => {
      message("Ocurrió un error en el consumo, por favor revisar los datos enviados", "error");
    }
  });


}


const onClickAgregarUsuarios = () => {


  const roles = consultarRolesUsuarios();

  let optionsRoles = roles.map(({ rol_id, rol_descripcion }) => {
    return `<option value="${rol_id}">${firstLetterUppercase(rol_descripcion)}</option>`;
  });

  const htmlModal = `
    <div class="col-mb-12" style="font-size: 14px; text-align: left;">
      <div class="row">
        <div class="col-md-6 mb-2">
          <label for="name">Nombres y apellido</label>
          <input class="form-control" id="nombreUsuario" name="nombreUsuario" type="text" placeholder="Nombres y apellidos del usuario">
        </div>
        <div class="col-md-6 mb-3">
          <label for="name">Cédula</label>
          <input class="form-control" id="cedulaUsuario" name="cedulaUsuario" type="text" placeholder="Cédula del usuario">
        </div>
        <div class="col-md-6 mb-3">
          <label for="name">Correo</label>
          <input class="form-control" id="CorreoUsuario" name="CorreoUsuario" type="email" placeholder="Correo del usuario">
        </div>
        <div class="col-md-6 mb-2">
          <label for="rolUsuario">Rol</label>
          <select class="form-control" id="rolUsuario" name="rolUsuario">
              <option disabled selected>Seleccione...</option>
              ${optionsRoles} 
          </select>
        </div>
      </div>
    </div>
  `;

  Swal.fire({
    title: 'Agregar usuario',
    html: htmlModal,
    showCancelButton: true,
    confirmButtonText: 'Guardar',
    confirmButtonColor: '#4dbd74',
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#6c757d',
    width: '700px'
  }).then((result) => {

    const allData = {
      nombreUsuario: $("#nombreUsuario").val(),
      cedulaUsuario: $("#cedulaUsuario").val(),
      CorreoUsuario: $("#CorreoUsuario").val(),
      rolUsuario: $("#rolUsuario").val(),
    }

    if (result.value) {

      guardarInformacionUsuario(allData);

    }


  });

}

const consultarRolesUsuarios = () => {

  let response = {};

  $.ajax({
    async: false,
    url: base_url + 'gestorusuarios/getRolesController',
    type: "GET",
    data: {},
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      if (objData.status === "success") { response = objData.data };
    },
    error: (error) => {
      console.error("Error al consumir los roles");
    }
  });

  return response;

}

const guardarInformacionUsuario = ({ nombreUsuario, cedulaUsuario, CorreoUsuario, rolUsuario }) => {

  $.ajax({
    async: true,
    url: base_url + 'gestorusuarios/saveInfoUserController',
    type: "POST",
    data: {
      nombreUsuario: String(nombreUsuario),
      cedulaUsuario: String(cedulaUsuario),
      CorreoUsuario: String(CorreoUsuario),
      rolUsuario: parseInt(rolUsuario),
    },
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      if (objData.status === "success") {
        message("Usuario guardado correctamente", "success");
        getAllUsers();

      } else {
        message("Ocurrió un error inesperado, por favor vuelva a intentar", "warning");
      }

    },
    error: (error) => {
      message("Ocurrió un error en la inserción, por favor revisar los datos enviados", "error");
    }
  });

}



const onClickEliminarUsuario = ({ usu_id, usu_nombre }) => {


  Swal.fire({
    title: 'Inhabilitar usuario',
    html: `<h4>¿Está seguro de eliminar al usuario ${wordToCamelCase(usu_nombre)}? </h4>`,
    showCancelButton: true,
    confirmButtonText: 'Eliminar',
    confirmButtonColor: '#4dbd74',
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#6c757d',
    width: '700px'
  }).then((result) => {
    if (result.value) { inhabilitarUsuario(usu_id) }
  });

}


const inhabilitarUsuario = (idUsuario) => {

  $.ajax({
    async: true,
    url: base_url + 'gestorusuarios/deleteUserController',
    type: "POST",
    data: {
      idUsuario: parseInt(idUsuario),
    },
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      if (objData.status === "success") {
        message("Usuario eliminado correctamente", "success");
        getAllUsers();

      } else {
        message("Ocurrió un error inesperado, por favor vuelva a intentar", "warning");
      }

    },
    error: (error) => {
      message("Ocurrió un error en la eliminacion, por favor revisar los datos enviados", "error");
    }
  });

}



const onClickActualizarUsuario = ({ rol_descripcion, usu_cedula, usu_correo, usu_id, usu_nombre }) => {

  let optionsRoles = consultarRolesUsuarios().map(({ rol_id, rol_descripcion: rol_desc }) => {

    return `<option ${(rol_desc === rol_descripcion) && ("selected")} value="${rol_id}">${firstLetterUppercase(rol_desc)}</option>`;
  });

  const htmlModal = `
    <div class="col-mb-12" style="font-size: 14px; text-align: left;">
      <div class="row">
        <div class="col-md-6 mb-2">
          <label for="name">Nombres y apellido</label>
          <input value="${usu_nombre}" class="form-control" id="nombreUsuario" name="nombreUsuario" type="text" placeholder="Nombres y apellidos del usuario">
        </div>
        <div class="col-md-6 mb-3">
          <label for="name">Cédula</label>
          <input value="${usu_cedula}" class="form-control" id="cedulaUsuario" name="cedulaUsuario" type="text" placeholder="Cédula del usuario">
        </div>
        <div class="col-md-6 mb-3">
          <label for="name">Correo</label>
          <input value="${usu_correo}" class="form-control" id="CorreoUsuario" name="CorreoUsuario" type="email" placeholder="Correo del usuario">
        </div>
        <div class="col-md-6 mb-2">
          <label for="rolUsuario">Rol</label>
          <select class="form-control" id="rolUsuario" name="rolUsuario">
              <option disabled selected>Seleccione...</option>
              ${optionsRoles} 
          </select>
        </div>
      </div>
    </div>
  `;

  Swal.fire({
    title: 'Actualización de usuario',
    html: htmlModal,
    showCancelButton: true,
    confirmButtonText: 'Actualizar',
    confirmButtonColor: '#4dbd74',
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#6c757d',
    width: '700px'
  }).then((result) => {

    const allData = {
      nombreUsuario: $("#nombreUsuario").val(),
      cedulaUsuario: $("#cedulaUsuario").val(),
      CorreoUsuario: $("#CorreoUsuario").val(),
      rolUsuario: $("#rolUsuario").val(),
      usu_id
    }

    if (result.value) {

      actualizarInformacionUsuario(allData);

    }


  });

}


const actualizarInformacionUsuario = ({ nombreUsuario, cedulaUsuario, CorreoUsuario, rolUsuario, usu_id }) => {

  $.ajax({
    async: true,
    url: base_url + 'gestorusuarios/actualizarInfoUserController',
    type: "POST",
    data: {
      nombreUsuario: String(nombreUsuario),
      cedulaUsuario: String(cedulaUsuario),
      CorreoUsuario: String(CorreoUsuario),
      rolUsuario: parseInt(rolUsuario),
      usu_id: parseInt(usu_id),
    },
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      if (objData.status === "success") {
        message("Usuario actualizado correctamente", "success");
        getAllUsers();

      } else {
        message("Ocurrió un error inesperado, por favor vuelva a intentar", "warning");
      }

    },
    error: (error) => {
      message("Ocurrió un error en la actualización, por favor revisar los datos enviados", "error");
    }
  });

}

