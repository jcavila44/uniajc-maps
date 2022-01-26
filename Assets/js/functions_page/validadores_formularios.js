
const exprRegNumerosPositivos = /^[0-9]+$/;                                                 //el formato de solo numeros
const exprRegSoloLetras = /^[a-zA-ZÑñáéíóúÁÉÍÓÚÄËÏÖÜäëïöü\s+]+$/;                   		//solo letras sin caracteres especiales ni acentos
const exprRegLetrasyAcentos = /^([\w\s\d\n&ÑñáéíóúÁÉÍÓÚ.,\-_@?¿/#%<>])+$/;      //texto largos de 1000 caracteres con puntaciacion y acentos 
const exprRegHorasSinSegundos = /^(0[0-9]|1\d|2[0-3]):([0-5]\d)$/;
const exprRegFecha = /^\d{2,4}-\d{1,2}\-\d{1,2}$/;
const exprRegEmail = /^([a-zA-Z0-9_\.-]+)@([\da-zA-Z0-9\.-]+)\.([a-zA-Z\.]{2,6})$/;    		//correos electronicos



const validarFormularioAgregarUsuarios = (dataForm) => {

  const {
    nombreUsuario,
    cedulaUsuario,
    CorreoUsuario,
    rolUsuario,
  } = dataForm;

  let responses = [];

  (!exprRegSoloLetras.test(nombreUsuario.trim())) && (responses.push(false));
  (!exprRegNumerosPositivos.test(cedulaUsuario.trim())) && (responses.push(false));
  (!exprRegEmail.test(CorreoUsuario.trim())) && (responses.push(false));
  (!exprRegNumerosPositivos.test(rolUsuario)) && (responses.push(false));

  return (responses.includes(false)) ? false : true;

}


const validarFormularioActualizacionUsuarios = (dataForm) => {

  const {
    nombreUsuario,
    cedulaUsuario,
    CorreoUsuario,
    rolUsuario,
    usu_id,
  } = dataForm;

  let responses = [];

  (!exprRegSoloLetras.test(nombreUsuario.trim())) && (responses.push(false));
  (!exprRegNumerosPositivos.test(cedulaUsuario.trim())) && (responses.push(false));
  (!exprRegEmail.test(CorreoUsuario.trim())) && (responses.push(false));
  (!exprRegNumerosPositivos.test(rolUsuario)) && (responses.push(false));
  (!exprRegNumerosPositivos.test(usu_id)) && (responses.push(false));

  return (responses.includes(false)) ? false : true;

}



const validarFormularioAgregarMapa = (dataForm) => {

  const {
    nombreMapa,
    mapaZip,
    descripcionMapa,
  } = dataForm;

  let responses = [];

  (!exprRegSoloLetras.test(nombreMapa.trim())) && (responses.push(false));
  (mapaZip?.type !== "application/x-zip-compressed") && (responses.push(false));
  (!exprRegLetrasyAcentos.test(descripcionMapa.trim())) && (responses.push(false));

  return (responses.includes(false)) ? false : true;

}


const validarFormularioEditarMapa = (dataForm) => {

  const {
    nombreMapa,
    mapaZip,
    descripcionMapa,
    mapa,
  } = dataForm;

  let responses = [];

  (!exprRegSoloLetras.test(nombreMapa.trim())) && (responses.push(false));
  (mapaZip !== null && mapaZip?.type !== "application/x-zip-compressed") && (responses.push(false));
  (!exprRegLetrasyAcentos.test(descripcionMapa.trim())) && (responses.push(false));
  (!exprRegNumerosPositivos.test(mapa.trim())) && (responses.push(false));

  return (responses.includes(false)) ? false : true;

}


const validarFormularioLogin = (dataForm) => {

  const {
    correo,
    password,
  } = dataForm;

  let responses = [];

  (!exprRegEmail.test(correo.trim())) && (responses.push(false));
  (password === null || password.trim() === "") && (responses.push(false));

  return (responses.includes(false)) ? false : true;

}


const validarFormularioForgetPassword = (dataForm) => {

  const {
    correo,
  } = dataForm;

  let responses = [];

  (!exprRegEmail.test(correo.trim())) && (responses.push(false));

  return (responses.includes(false)) ? false : true;

}