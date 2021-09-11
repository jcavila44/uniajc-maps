
const AddMapas = () => {

  const htmlModal = `
            <div class="col-mb-12" style="font-size: 14px; text-align: left;">
              <div class="row">
                <div class="col-md-12 mb-2">
                  <label for="name">Nombre del mapa</label>
                  <input class="form-control" id="nombreMapa" name="nombreMapa" type="text" placeholder="Nombre del mapa">
                </div>
                <div class="col-md-12 mb-2">
                  <label for="name">Capa</label>
                  <div class="row">
                    <div class="col-md-12 mb-2">
                      <input class="form-control" id="nombreCapa" name="nombreCapa" type="text" placeholder="Nombre de la capa">
                    </div>
                    <div class="col-md-12">
                      <input id="fileMapa" name="fileMapa" type="file">
                    </div>
                  </div>
                </div>
                <div class="col-md-12 mb-2">
                  <label for="name">Descripción del mapa</label>
                  <textarea style="resize: none;" class="form-control" id="descripcionMapa" name="descripcionMapa" rows="2" placeholder="Descripción del mapa"></textarea>
                </div>
                <div class="col-md-12 mb-2">
                  <label for="select1">Estado</label>
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
    title: 'Agregar Mapa',
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