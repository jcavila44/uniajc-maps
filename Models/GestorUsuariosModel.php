<?php
//============================================================+
// Carpeta: Models
// Nombre del archivo   : LoginModel.php
// Inicio       : 2021-09-11
// Ultima actualizacion :
//
// Description : Modelo para manejar los datos y querys del modulo de Login
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+
class GestorUsuariosModel extends MySQL
{

  private string $strUsuCorreo;
  private string $strUsuCedula;
  private string $strUsuNombre;
  private string $strUsuPassword;
  private int $intRolId;
  private int $intEstadoId;

  public function __construct()
  {
    parent::__construct();
  }

  public function obtenerUsuariosModel()
  {
    $consulta = "SELECT 
                    usuario.usu_id,
                    usuario.usu_correo,
                    usuario.usu_nombre,
                    usuario.usu_cedula,
                    estado.estado_descripcion,
                    rol.rol_descripcion
                  FROM 
                    usuario,
                    estado,
                    rol
                  WHERE 
                    usuario.est_id = estado.estado_id AND 
                    usuario.rol_id = rol.rol_id
    ";
    $peticion = $this->SelectAll($consulta);
    return $peticion;
  }

  public function getRolesModel()
  {
    $consulta = "SELECT * FROM rol";
    $peticion = $this->SelectAll($consulta);
    return $peticion;
  }

  public function saveUsuarioModel(string $nombreUsuario, string $cedulaUsuario, string $CorreoUsuario, int $rolUsuario)
  {

    $this->strUsuNombre = $nombreUsuario;
    $this->strUsuCedula = $cedulaUsuario;
    $this->strUsuCorreo = $CorreoUsuario;
    $this->intRolId = $rolUsuario;
    $this->intEstadoId = 7;
    $this->strUsuPassword = crypt($cedulaUsuario, '123');

    $consulta = "INSERT INTO 
                  `usuario` 
                    (
                      usu_cedula, 
                      usu_correo, 
                      usu_nombre, 
                      usu_password, 
                      rol_id, 
                      est_id
                    ) VALUES (
                      ?,
                      ?,
                      ?,
                      ?,
                      ?,
                      ?
                    )";

    $arrInformacion = array(
      $this->strUsuCedula,
      $this->strUsuCorreo,
      $this->strUsuNombre,
      $this->strUsuPassword,
      $this->intRolId,
      $this->intEstadoId,
    );


    $peticion = $this->Insert($consulta, $arrInformacion);

    return $peticion;
  }
}
