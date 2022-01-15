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
        // message("Información consultada correctamente", "success");

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

          let jsonInfo = JSON.stringify(mapaProp);

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
                    <button class="dropdown-item" type="button">Editar <i class="icon-settings fa-lg ml-2 text-dark"></i> </button>
                    <button onclick="eliminarMapa(${mapaProp.mapa_id});" class="dropdown-item" type="button">Eliminar <i class="fa fa-trash-o fa-lg ml-2 text-dark"></i> </button>
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


const generarCardsMapas = (objData) => {

  let cardsMapas = ``;

  objData.forEach(mapaProp => {

    cardsMapas += `
      <div class="col-md-4 cardMapas">
        <div class="row">
          <div class="col-md-12">
            <div class="card p-3 hover-card">
              <div class="row">
                <div class="col-md-4" style="display: flex; align-items: center;">
                  <img class="card-img-top" src="${base_url}/Assets/img/gestor-mapas/map.svg" alt="Card image cap" width="100%" />
                </div>
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-12 text-center mb-2">
                      <h4>
                        ${wordToCamelCase(mapaProp.mapa_nombre)}
                      </h4>
                    </div>
                    <div class="col-6 col-md-6 mb-2">
                      <button type="button" class="btn btn-outline-success btn-block">
                        <i class="icon-pencil icons font-2xl d-block"></i>
                      </button>
                    </div>
                    <div class="col-6 col-md-6 mb-2">
                      <button onclick="eliminarMapa(${mapaProp.mapa_id});" type="button" class="btn btn-outline-danger btn-block">
                        <i class="icon-trash icons font-2xl d-block"></i>
                      </button>
                    </div>
                    <div class="col-6 col-md-6 mb-2">
                      <button type="button" class="btn btn-outline-success btn-block">
                        <i class="icon-layers icons font-2xl d-block"></i>
                      </button>
                    </div>
                    <div class="col-6 col-md-6 mb-2">
                      <button onclick="verMapa(${mapaProp.mapa_id},'${mapaProp.mapa_nombre}');" type="button" class="btn btn-outline-success btn-block">
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
    `;

  });

  $('#rowCardsMapas').html(cardsMapas);

}


const AddMapas = () => {

  const htmlModal = `
            <div class="col-mb-12 m-2 p-2" style="font-size: 14px; text-align: left; overflow: hidden;">
              <form id="formAgregarMapa">
                <div class="row">
                  <div class="col-md-12 mb-2">
                    <label for="name">Nombre del mapa</label>
                    <input class="form-control" id="nombreMapa" name="nombreMapa" type="text" placeholder="Nombre del mapa">
                  </div>
                  <div class="col-md-12 mb-2">
                    <label for="name">Subir mapa</label>
                    <input class="form-control" id="mapaZip" name="mapaZip" type="file" accept=".zip">
                  </div>
                  <div class="col-md-12 mb-2">
                    <label for="name">Descripción del mapa</label>
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
    title: 'Agregar Mapa',
    html: htmlModal,
    showCancelButton: false,
    showConfirmButton: false,
    showCloseButton: true,
  });
}



const eliminarMapa = (data) => {
  Swal.fire({
    icon: 'info',
    html: `<h3>¿Seguro que deseas eliminar el mapa ${data}?</h3>`,
    showCancelButton: true,
    confirmButtonText: 'Si, eliminar',
    confirmButtonColor: '#4dbd74',
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#6c757d',
  }).then((result) => {
    if (result.value) {
      Swal.fire({
        icon: 'success',
        html: '<h3>Mapa Eliminado correctamente!</h3>',
        showConfirmButton: true,
        confirmButtonText: 'Continuar',
        confirmButtonColor: '#0069d9',
        showCancelButton: false,
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

const verMapa2 = (idMapa, nombreMapa) => {

  $.ajax({
    url: base_url + 'gestormapas/getDataMapaController',
    type: "POST",
    data: { mapa: idMapa },
    dataType: "json",
    beforeSend: () => { overlay(true) },
    success: (objData) => {
      overlay(false);

      if (objData.status === "success") {

        console.log("all data", objData.data);
        Swal.fire({
          title: `Mapa ${wordToCamelCase(nombreMapa)}`,
          html: `<div id="map" style="height: 480px;"></div>`,
          showCancelButton: false,
          showConfirmButton: false,
          width: '800px',
          didOpen: () => initMap2(),
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

const initMap = () => {



  var map = L.map('map', {
    zoomControl: true, maxZoom: 28, minZoom: 1
  }).fitBounds([[1.0822409915458289, -78.75020908626198], [3.480087817397578, -74.45806326798734]]);
  var hash = new L.Hash(map);

  // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  //   maxZoom: 19,
  // }).addTo(map);


}

const initMap2 = () => {

  var map = L.map('map', { zoomControl: true, maxZoom: 28, minZoom: 1 }).fitBounds([[1.0822409915458289, -78.75020908626198], [3.480087817397578, -74.45806326798734]]);
  var autolinker = new Autolinker({ truncate: { length: 30, location: 'smart' } });
  var bounds_group = new L.featureGroup([]);

  // Capa #1
  function pop_COL_adm2_0(feature, layer) {       //Data modal
    var popupContent = '<table>\
            <tr>\
                <td colspan="2">Data capa 1</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['ID_0'] !== null ? autolinker.link(feature.properties['ID_0'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['ISO'] !== null ? autolinker.link(feature.properties['ISO'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['NAME_0'] !== null ? autolinker.link(feature.properties['NAME_0'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['ID_1'] !== null ? autolinker.link(feature.properties['ID_1'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['NAME_1'] !== null ? autolinker.link(feature.properties['NAME_1'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['ID_2'] !== null ? autolinker.link(feature.properties['ID_2'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['NAME_2'] !== null ? autolinker.link(feature.properties['NAME_2'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['TYPE_2'] !== null ? autolinker.link(feature.properties['TYPE_2'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['ENGTYPE_2'] !== null ? autolinker.link(feature.properties['ENGTYPE_2'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['NL_NAME_2'] !== null ? autolinker.link(feature.properties['NL_NAME_2'].toLocaleString()) : '') + '</td>\
            </tr>\
            <tr>\
                <td colspan="2">' + (feature.properties['VARNAME_2'] !== null ? autolinker.link(feature.properties['VARNAME_2'].toLocaleString()) : '') + '</td>\
            </tr>\
        </table>';
    layer.bindPopup(popupContent, { maxHeight: 400 });
  }

  function style_COL_adm2_0_0() {
    return {
      pane: 'mapaPruebas',
      opacity: 1,
      color: 'rgba(35,35,35,1.0)',
      dashArray: '',
      lineCap: 'butt',
      lineJoin: 'miter',
      weight: 1.0,
      fill: true,
      fillOpacity: 1,
      fillColor: 'rgba(243,240,151,1.0)',
      interactive: true,
    }
  }
  map.createPane('mapaPruebas');
  map.getPane('mapaPruebas').style.zIndex = 400;
  map.getPane('mapaPruebas').style['mix-blend-mode'] = 'normal';
  var layer_COL_adm2_0 = new L.geoJson(json_COL_adm2_0, {
    attribution: '',
    interactive: true,
    dataVar: 'json_COL_adm2_0',
    layerName: 'layer_COL_adm2_0',
    pane: 'mapaPruebas',
    onEachFeature: pop_COL_adm2_0,
    style: style_COL_adm2_0_0,
  });
  bounds_group.addLayer(layer_COL_adm2_0);
  map.addLayer(layer_COL_adm2_0);


}


const onMapClick = (element) => {
  alert('You clicked the map at ' + element.latlng);
}

const onSubmitFormularioAgregarMapa = () => {

  try {

    var formulario = new FormData(document.getElementById('formAgregarMapa'));
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

        Swal.fire({
          icon: status,
          html: `<h3>${msg}</h3>`,
          showCloseButton: true,
          showCancelButton: false,
          cancelButtonText: "Cerrar",
          showConfirmButton: false,
        }).then(() => {
          if (status === "success") {
            getAllMaps();
          }
        });

      },
      error: () => {
        message("Ocurrió un error, por favor revisar los datos enviados", "error");
      }
    });

  } catch (e) {
    throw new Error(e.message);
  }


}