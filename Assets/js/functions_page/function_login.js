



const onClickIngresar = () => {

  const correo = document.getElementById("correo").value;
  const password = document.getElementById("password").value;
  const dataForm = { correo, password };

  if (validarFormularioLogin(dataForm)) {

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
        } else {
          message(objData.msg, objData.status);
        }
      },
      error: (error) => {
        message("Ocurrió un error en el sistema, por favor revisar los datos enviados", "error");
      }
    });

  } else {
    alertaFormularioInvalido();
  }

}

const onClickForgotPassword = () => {

  const correo = document.getElementById("correo").value;

  if (validarFormularioForgetPassword({ correo })) {

    $.ajax({
      async: true,
      url: base_url + 'Login/recoverPassword',
      type: "POST",
      data: {
        correo
      },
      dataType: "json",
      beforeSend: () => { overlay(true) },
      success: (objData) => {
        if (objData.status === "success") {
          location.reload();

        } else if (objData.status === "error") {
          message("Ocurrió un error inesperado: " + objData.msg + ", por favor vuelva a intentarlo.", "error");
        }
      },
      error: (error) => {
        message("Ocurrió un error en el sistema, por favor revisar los datos enviados" + error, "error");
      }
    });

  } else {
    alertaFormularioInvalido();
  }

}

const onClickViewPassword = (idElement, idIcon) => {
  const tipo = document.getElementById(idElement);
  const Icon = document.getElementById(idIcon);

  if (tipo.type == "password") {
    Icon.setAttribute('class', 'icon-magnifier-remove');
    tipo.type = "text";

  } else {
    Icon.setAttribute('class', 'icon-magnifier-add');
    tipo.type = "password";
  }

}

const saveRecoverPassword = () => {
  const password = document.getElementById("password").value || '';
  const passwordConfirmation = document.getElementById("passwordConfirmation").value || '';

  if (password !== '' && passwordConfirmation !== '') {
    if (password == passwordConfirmation) {
      const usu_id = document.getElementById("usu_id").value;
      $.ajax({
        async: true,
        url: base_url + 'Login/saveRecoverPassword',
        type: "POST",
        data: {
          password,
          usu_id
        },
        dataType: "json",
        beforeSend: () => { overlay(true) },
        success: (objData) => {
          message("La contraseña se actualizó correctamente", "success");
          setTimeout(function () {
            location.reload();
          }, 3000);
        },
        error: (error) => {
          message("Ocurrió un error en el sistema, por favor revisar los datos enviados", error);
        }
      });
    } else {
      document.getElementById("alert-diferrent-password").style.display = "block";
    }
  } else {
    alertaFormularioInvalido();
  }



}



