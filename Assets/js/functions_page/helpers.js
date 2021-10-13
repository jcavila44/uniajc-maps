
const overlay = (show = true) => {
  if (show === true) {
    Swal.showLoading();
  } else {
    Swal.close();
  }
}

const message = (message, type) => {
  var icon;
  var title;
  if (type == 'success') {
    title = 'Excelente'
    icon = 'success'
  } else if (type == 'error') {
    title = 'Error'
    icon = 'error'
  } else {
    title = 'Advertencia'
    icon = 'warning'
  }

  Swal.fire({
    icon: icon,
    html: `<h3>${message}</h3>`,
    showCloseButton: true,
    showCancelButton: false,
    cancelButtonText: "Cerrar",
    showConfirmButton: false,
  });
}

const startTable = (idTabla) => {
  var tableGeneral = $('#' + idTabla + '').DataTable({
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": " _MENU_ ",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando del 0 al 0 de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    },
    "pageLength": 10,
    "aaSorting": [],
  });

  return tableGeneral;
}



const wordToCamelCase = (str) => {
  return str
    .toLowerCase()
    .split(' ')
    .map(function (Word) {
      return Word[0].toUpperCase() + Word.substr(1);
    })
    .join(' ');
}

const firstLetterUppercase = (data) => {
  return data.charAt(0).toUpperCase() + data.toLowerCase().slice(1);
}

