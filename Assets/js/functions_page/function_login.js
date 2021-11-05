



const onClickIngresar = () => {

  const correo = document.getElementById("correo").value;
  const password = document.getElementById("password").value;
  if (correo !== "" && password !== "") {

    $.ajax({
      async: true,
      url: base_url + 'Login/loginUser',
      type: "POST",
      data: {
        correo,
        password
      },
      dataType: "json",
      beforeSend: () => { overlay(true) },
      success: (objData) => {
        if (objData.status === "success") {
          location.reload();
        } else if (objData.status === "error") {
          message("Ocurrió un error inesperado, por favor vuelva a intentar", "error");
        }
      },
      error: (error) => {
        message("Ocurrió un error en el sistema, por favor revisar los datos enviados", "error");
      }
    });
  } else {
    message("Los campos no pueden estar vacíos", "warning");
  }

}