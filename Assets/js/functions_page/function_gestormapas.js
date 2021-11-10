
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
  }).then((result) => {
    if (result.value) {
      Swal.fire({
        icon: 'success',
        html: '<h3>Mapa cargado correctamente!</h3>',
        showConfirmButton: true,
        confirmButtonText: 'Continuar',
        confirmButtonColor: '#0069d9',
        showCancelButton: false,
      });
    }
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


const verMapa = (data) => {
  Swal.fire({
    title: `Mapa ${data}`,
    html: `<div id="divMapaLeaflet" style="height: 480px;"></div>`,
    showCancelButton: false,
    showConfirmButton: false,
    width: '800px',
    didOpen: () => {
      console.log("abrio la modal");
    },
  });
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

        if (status == 'success') {
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