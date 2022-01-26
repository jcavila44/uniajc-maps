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

  const htmlModal = `
            <div class="col-mb-12 m-2 p-2" style="font-size: 14px; text-align: left; overflow: hidden;">
              <form id="formAgregarMapa">
                <div class="row">
                  <div class="col-md-12 mb-2">
                    <label for="name">${asteriskRequired} Nombre del mapa</label>
                    <input class="form-control" id="nombreMapa" name="nombreMapa" type="text" placeholder="Nombre del mapa">
                  </div>
                  <div class="col-md-12 mb-2">
                    <label for="name">${asteriskRequired} Subir archivo .zip del mapa</label>
                    <input class="form-control" id="mapaZip" name="mapaZip" type="file" accept=".zip">
                  </div>
                  <div class="col-md-12 mb-2">
                    <label for="name">${asteriskRequired} Descripción del mapa</label>
                    <textarea style="resize: none;" class="form-control" id="descripcionMapa" name="descripcionMapa" rows="2" placeholder="Descripción del mapa"></textarea>
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
    title: 'Agregar mapa',
    html: htmlModal,
    showCancelButton: false,
    showConfirmButton: false,
    showCloseButton: true,
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

  const dataForm = {
    nombreMapa: $("#nombreMapa").val() || '',
    mapaZip: $("#mapaZip")[0].files[0] || null,
    descripcionMapa: $("#descripcionMapa").val() || '',
  };

  if (validarFormularioAgregarMapa(dataForm)) {

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
      success: function ({ status = null, msg = null, data = null }) {
        message(msg, status);

        (status === "success") && (setTimeout(() => { getAllMaps() }, 300));
      },
      error: () => {
        message("Ocurrió un error, por favor revisar los datos enviados", "error");
      }
    });

  } else {
    alertaFormularioInvalido();
  }


}



const editarMapa = (allDataMapa) => {

  const { mapa_descripcion, mapa_id, mapa_nombre, mapa_ruta } = allDataMapa;


  const htmlModal = `
    <div class="col-mb-12 m-2 p-2" style="font-size: 14px; text-align: left; overflow: hidden;">
      <form id="formEditarMapa">
        <div class="row">
          <div class="col-md-12 mb-2">
            <label for="name">${asteriskRequired} Nombre del mapa</label>
            <input value="${mapa_id}" type="hidden" id="mapa" name="mapa" />
            <input value="${mapa_ruta}" type="hidden" id="mapaRuta" name="mapaRuta" />
            <input value="${mapa_nombre}" class="form-control" id="nombreMapa" name="nombreMapa" type="text" placeholder="Nombre del mapa">
          </div>
          <div class="col-md-12 mb-2">
            <label for="name"> Subir archivo .zip del mapa</label>
            <input class="form-control" id="mapaZip" name="mapaZip" type="file" accept=".zip">
          </div>
          <div class="col-md-12 mb-2">
            <label for="name">${asteriskRequired} Descripción del mapa</label>
            <textarea value="${mapa_descripcion}" style="resize: none;" class="form-control" id="descripcionMapa" name="descripcionMapa" rows="2" placeholder="Descripción del mapa">${mapa_descripcion}</textarea>
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
  });

}


const onSubmitFormularioEditarMapa = () => {

  const dataForm = {
    nombreMapa: $("#nombreMapa").val() || '',
    mapaZip: $("#mapaZip")[0].files[0] || null,
    descripcionMapa: $("#descripcionMapa").val() || '',
    mapa: $("#mapa").val() || '',
  };

  if (validarFormularioEditarMapa(dataForm)) {

    const formulario = new FormData(document.getElementById('formEditarMapa'));

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
        message(msg, status);
        (status === "success") && (setTimeout(() => { getAllMaps() }, 300));
      },
      error: () => {
        message("Ocurrió un error, por favor revisar los datos enviados", "error");
      }
    });

  } else {
    alertaFormularioInvalido();
  }



}