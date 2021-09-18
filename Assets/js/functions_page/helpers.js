
const overlay = (show = true) => {
  if (show === true) {
    Swal.showLoading();
  } else {
    Swal.close();
  }
}

function message(message, type) {
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