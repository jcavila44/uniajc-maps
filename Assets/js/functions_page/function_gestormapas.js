$(document).ready(function () {
  getAllMaps();
  tableGestorMapas = startTable("tableGestorMapas");


});


const getAllMaps = () => {

  $.ajax({
    url: base_url + 'gestormapas/getAllMapas',
    type: "GET",
    data: {},
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      overlay(false);

      if (objData.status === "success") {

        let htmlTable = `
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
        `;

        objData.data.forEach((mapaProp, key) => {

          const jsonInfo = JSON.stringify(mapaProp);

          const btnActualizarOEliminar = (mapaProp.est_id === "9") ?
            `<button onclick="eliminarMapa(${mapaProp.mapa_id},'${mapaProp.mapa_nombre}')" class="dropdown-item" type="button">Desactivar <i class="fa fa-lock fa-lg ml-2 text-dark"></i> </button>`
            :
            `<button onclick="habilitarMapa(${mapaProp.mapa_id},'${mapaProp.mapa_nombre}')" class="dropdown-item" type="button">Activar <i class="fa fa-unlock fa-lg ml-2 text-dark"></i> </button>`
            ;

          htmlTable += `
            <tr>
              <td> ${key} </td>
              <td> ${wordToCamelCase(mapaProp.mapa_nombre)} </td>
              <td> ${firstLetterUppercase(mapaProp.mapa_descripcion)} </td>
              <td class="text-center"> <span class="badge pr-4 pl-4 pt-2 pb-2 badge-${(mapaProp.est_id == 9) ? 'success' : 'secondary'}">${(mapaProp.est_id == 9) ? 'Activo' : 'Inactivo'}</span> </td>
              <td> 
                <div class="dropdown">
                  <button class="btn btn-outline-primary dropdown-toggle w-100" id="dropdownMenu2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestionar</button>
                  <div class="dropdown-menu w-100" aria-labelledby="dropdownMenu2" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <button onclick='verMapa(${jsonInfo});' class="dropdown-item" type="button">Ver <i class="fa fa-eye fa-lg ml-2 text-dark"></i> </button>
                    <button onclick='editarMapa(${jsonInfo});' class="dropdown-item" type="button">Editar <i class="icon-settings fa-lg ml-2 text-dark"></i> </button>
                    ${btnActualizarOEliminar}
                  </div>
                </div>
              </td>
            </tr>
          `;
        });

        htmlTable += `</tbody>`;

        if (tableGestorMapas) { tableGestorMapas.destroy() }

        document.getElementById('tableGestorMapas').innerHTML = htmlTable;
        tableGestorMapas = startTable("tableGestorMapas");


      } else {
        message("Ocurrió un error inesperado, por favor vuelva a intentar", "warning");
      }

    },
    error: () => {
      message("Ocurrió un error en el consumo, por favor revisar los datos enviados", "error");
    }
  });


}


const AddMapas = () => {
  $.ajax({
    url: base_url + 'gestorusuarios/obtenerUsuariosControllerMap',
    type: "GET",
    data: {},
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      let htmlModal = `
                <div class="col-mb-12 m-2 p-2" style="font-size: 14px; text-align: left; overflow: hidden;">
                  <form id="formAgregarMapa">
                    <div class="row">
                      <div class="col-md-12 mb-2">
                        <label for="name">Nombre del mapa</label>
                        <input class="form-control" id="nombreMapa" name="nombreMapa" type="text" placeholder="Nombre del mapa">
                      </div>
                      <div class="col-md-12 mb-2">
                        <label for="name">Subir archivo .zip del mapa</label>
                        <input class="form-control" id="mapaZip" name="mapaZip" type="file" accept=".zip">
                       </div>
                      <div class="col-md-12 mb-2">
                        <label for="name">Descripción del mapa</label>
                        <textarea style="resize: none;" class="form-control" id="descripcionMapa" name="descripcionMapa" rows="2" placeholder="Descripción del mapa"></textarea>
                      </div>
                      <div class="col-md-12 mb-2">
                        <label>Permisos de usuario</label>
                        <div class="col-md-12">
                        <div class="input-group">
                        
                        <select id="UserList" data-size="5" data-live-search="true" multiple style="width: 100%">
                        <option disabled>Choose...</option>`;

      objData.data.forEach((User) => {

        htmlModal += `<option value="${User.usu_id}" dataName="${User.usu_nombre}">${User.usu_nombre}</option>`
      });

      htmlModal += `</select>
                   </div>
                     
                      <div class="col-md-12 mb-2">
                        <br>
                        <button onclick="onSubmitFormularioAgregarMapa()" type="button" class="btn btn-success">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>
        `;

      Swal.fire({
        title: 'Agregar Mapa',
        html: htmlModal,
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true,
      });
      $('#UserList').selectpicker();

    }
  });

}



const eliminarMapa = (mapaId, mapaNombre) => {
  Swal.fire({
    icon: 'info',
    html: `<h3>¿Seguro que deseas eliminar el mapa "${wordToCamelCase(mapaNombre)}" ?</h3>`,
    showCancelButton: true,
    confirmButtonText: 'Si, eliminar',
    confirmButtonColor: '#4dbd74',
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#6c757d',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: base_url + 'gestormapas/eliminarMapaController',
        type: "POST",
        data: { mapa: mapaId },
        dataType: "json",
        beforeSend: () => { overlay(true) },
        success: (objData) => {

          overlay(false);

          if (objData.status === "success") {
            Swal.fire({
              icon: 'success',
              html: '<h3>Mapa eliminado correctamente!</h3>',
              showConfirmButton: true,
              confirmButtonText: 'Continuar',
              confirmButtonColor: '#0069d9',
              showCancelButton: false,
            }).then(() => {
              setTimeout(() => { getAllMaps() }, 300);
            });

          } else {
            message("Ocurrió un error inesperado, por favor vuelva a intentar", "warning");
          }
        },
        error: () => {
          message("Ocurrió un error en el consumo, por favor revisar los datos enviados", "error");
        }
      });
    }
  });
}


const habilitarMapa = (mapaId, mapaNombre) => {
  Swal.fire({
    icon: 'info',
    html: `<h3>¿Seguro que deseas habilitar el mapa "${wordToCamelCase(mapaNombre)}" ?</h3>`,
    showCancelButton: true,
    confirmButtonText: 'Si, habilitar',
    confirmButtonColor: '#4dbd74',
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#6c757d',
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: base_url + 'gestormapas/habilitarMapaController',
        type: "POST",
        data: { mapa: mapaId },
        dataType: "json",
        beforeSend: () => { overlay(true) },
        success: (objData) => {

          overlay(false);

          if (objData.status === "success") {
            Swal.fire({
              icon: 'success',
              html: '<h3>Mapa habilitado correctamente!</h3>',
              showConfirmButton: true,
              confirmButtonText: 'Continuar',
              confirmButtonColor: '#0069d9',
              showCancelButton: false,
            }).then(() => {
              setTimeout(() => { getAllMaps() }, 300);
            });

          } else {
            message("Ocurrió un error inesperado, por favor vuelva a intentar", "warning");
          }
        },
        error: () => {
          message("Ocurrió un error en el consumo, por favor revisar los datos enviados", "error");
        }
      });
    }
  });
}


const verMapa = (allDataMapa) => {

  const { est_id, mapa_descripcion, mapa_id, mapa_nombre, mapa_ruta } = allDataMapa;

  $.ajax({
    url: base_url + 'gestormapas/getDataMapaController',
    type: "POST",
    data: { mapa: mapa_id },
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      overlay(false);

      if (objData.status === "success") {

        Swal.fire({
          title: `Mapa ${wordToCamelCase(mapa_nombre)}`,
          html: `
            <div id="map" class="w-100">
              <iframe frameborder="0" height="500" width="100%" scrolling="no" src="${mapa_ruta}">
              </iframe>
            </div>
          `,
          showCancelButton: false,
          showConfirmButton: false,
          showCloseButton: true,
          width: '100%',
        });

      } else {
        message("Ocurrió un error inesperado, por favor vuelva a intentar", "warning");
      }
    },
    error: () => {
      message("Ocurrió un error en el consumo, por favor revisar los datos enviados", "error");
    }
  });


}

const onSubmitFormularioAgregarMapa = () => {


  const formulario = new FormData(document.getElementById('formAgregarMapa'));
  $.ajax({
    type: 'POST',
    url: base_url + 'gestormapas/addMapa',
    data: formulario,
    cache: false,
    contentType: false,
    processData: false,
    method: 'POST',
    async: false,
    enctype: 'multi part/form-data',
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: function ({ status = null, msg = null, idRegistered = null, data = null }) {
      if (status != "success") {
        message(msg, status);
        Swal.fire({
          icon: status,
          html: `<h3>${msg}</h3>`,
          showCloseButton: true,
          showCancelButton: false,
          cancelButtonText: "Cerrar",
          showConfirmButton: false,
        }).then(() => {
          if (status === "success") {
            setTimeout(() => { getAllMaps() }, 300);
          }
        });
      } else {
        $('#UserList').on('hidden.bs.select', function (e) {

          let usuarios = [];

          $.each(e.target.selectedOptions, function (index, obj) {
            usuarios[index] = obj.value;
          });

          let formData1 = new FormData();
          formData1.append("mapaId", idRegistered);
          formData1.append("usuId", JSON.stringify(usuarios));


          $.ajax({
            type: 'POST',
            url: base_url + 'gestormapas/addRelationMapaUser',
            data: formData1,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            async: false,
            enctype: 'multi part/form-data',
            dataType: "json",
            beforeSend: () => { overlay(true) },
            success: function ({ status = null, msg = null, peticion = null }) {
              message(msg, status);
              Swal.fire({
                icon: status,
                html: `<h3>${msg}</h3>`,
                showCloseButton: true,
                showCancelButton: false,
                cancelButtonText: "Cerrar",
                showConfirmButton: false,
              }).then(() => {
                if (status === "success") {
                  setTimeout(() => { getAllMaps() }, 300);
                }
              });
            },
            error: (err) => {
              message("Ocurrió un error, por favor revisar los datos enviados", "error");
            }
          });

        });

      }

    },
    error: () => {
      message("Ocurrió un error, por favor revisar los datos enviados", "error");
    }
  });
}



const editarMapa = (allDataMapa) => {


  $.ajax({
    url: base_url + 'gestormapas/GetRelationMapaUser',
    type: "GET",
    data: {
      'mapaId': allDataMapa.mapa_id
    },
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      const { mapa_descripcion, mapa_id, mapa_nombre, mapa_ruta } = allDataMapa;



      let htmlModal = `
        <div class="col-mb-12 m-2 p-2" style="font-size: 14px; text-align: left; overflow: hidden;">
          <form id="formEditarMapa">
            <div class="row">
              <div class="col-md-12 mb-2">
                <label for="name">Nombre del mapa</label>
                <input value="${mapa_id}" type="hidden" id="mapa_id" name="mapa" />
                <input value="${mapa_ruta}" type="hidden" id="mapaRuta" name="mapaRuta" />
                <input value="${mapa_nombre}" class="form-control" id="nombreMapa" name="nombreMapa" type="text" placeholder="Nombre del mapa">
              </div>
              <div class="col-md-12 mb-2">
                <label for="name">Subir archivo .zip del mapa</label>
                <input class="form-control" id="mapaZip" name="mapaZip" type="file" accept=".zip">
              </div>
              <div class="col-md-12 mb-2">
                <label for="name">Descripción del mapa</label>
                <textarea value="${mapa_descripcion}" style="resize: none;" class="form-control" id="descripcionMapa" name="descripcionMapa" rows="2" placeholder="Descripción del mapa">${mapa_descripcion}</textarea>
              </div>
              <div class="col-md-12 mb-2">
              <select id="UserListEdit" data-size="5" data-live-search="true" multiple style="width: 100%">
              <option disabled>Elegir Usuarios...</option>`;

      objData.allUsers.forEach((UserAll) => {
        if (objData.data.length != 0) {
          objData.data.forEach((UserSelected) => {
            if (UserSelected.usu_id == UserAll.usu_id) {
              htmlModal += `<option selected value="${UserAll.usu_id}" dataName="${UserAll.usu_id}">${UserAll.usu_id}</option>`
            } else {
              htmlModal += `<option value="${UserAll.usu_id}" dataName="${UserAll.usu_id}">${UserAll.usu_id}</option>`
            }

          })
        } else {
          htmlModal += `<option value="${UserAll.usu_id}" dataName="${UserAll.usu_id}">${UserAll.usu_id}</option>`
        }
      });

      htmlModal += `</select>
              </div>
              <div class="col-md-12 mb-2">
                <br>
                <button onclick="onSubmitFormularioEditarMapa()" type="button" class="btn btn-success">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      `;


      Swal.fire({
        title: 'Actualizar mapa',
        html: htmlModal,
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true,
        didOpen() {
          $('#UserListEdit').selectpicker({
            placeholder: "Select User",
            size: '5',
            multipleSeparator: ', '
          });
          $('#UserListEdit').selectpicker("refresh");
        }
      });
    },
    error: (err) => {
      message("Ocurrió un error en el consumo, por favor revisar los datos enviados", "error");
    }
  });
}


const onSubmitFormularioEditarMapa = () => {

  try {

    const formulario = new FormData(document.getElementById('formEditarMapa'));
    const idRegistered = document.getElementById('mapa_id').value;

    $.ajax({
      type: 'POST',
      url: base_url + 'gestormapas/editarMapa',
      data: formulario,
      cache: false,
      contentType: false,
      processData: false,
      method: 'POST',
      async: false,
      enctype: 'multi part/form-data',
      dataType: "json",
      beforeSend: () => { overlay(true) },
      success: function ({ status = null, msg = null, data = null }) {

        if (status != "success") {
          message(msg, status);
          Swal.fire({
            icon: status,
            html: `<h3>${msg}</h3>`,
            showCloseButton: true,
            showCancelButton: false,
            cancelButtonText: "Cerrar",
            showConfirmButton: false,
          }).then(() => {
            if (status === "success") {
              setTimeout(() => { getAllMaps() }, 300);
            }
          });
        } else {
          if (document.getElementById("UserListEdit").selectedOptions.length == 0) {
            
            addOrRemoveRelationMapaUser(idRegistered);  

          } else {

            $('#UserListEdit').on('hidden.bs.select', function (e) {
              let usuarios = [];
              $.each(e.target.selectedOptions, function (index, obj) {
                usuarios[index] = obj.value;
              });

              addOrRemoveRelationMapaUser(idRegistered, 'True',usuarios );

            });
          }

        }
      },
      error: () => {
        message("Ocurrió un error, por favor revisar los datos enviados", "error");
      }
    });

  } catch (e) {
    throw new Error(e.message);
  }

}

const addOrRemoveRelationMapaUser = (idRegistered, usu = null, usuarios = null ) => {
  let formData = new FormData();
  formData.append("mapaId", idRegistered);
  formData.append("FirstDeleteRelation", 'TRUE');
  (usu)&&formData.append("usuId", JSON.stringify(usuarios));

  $.ajax({
    type: 'POST',
    url: base_url + 'gestormapas/addRelationMapaUser',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    method: 'POST',
    async: false,
    enctype: 'multi part/form-data',
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: function ({ status = null, msg = null, peticion = null }) {
      message(msg, status);
      Swal.fire({
        icon: status,
        html: `<h3>Se editó correctamente el mapa</h3>`,
        showCloseButton: true,
        showCancelButton: false,
        cancelButtonText: "Cerrar",
        showConfirmButton: false,
      }).then(() => {
        if (status === "success") {
          setTimeout(() => { getAllMaps() }, 300);
        }
      });
    },
    error: (err) => {
      message("Ocurrió un error, por favor revisar los datos enviados", "error");
    }
  });
}