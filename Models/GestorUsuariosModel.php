<?php
//============================================================+
// Carpeta: Models
// Nombre del archivo   : GestorUsuariosModel.php
// Inicio       : 2021-09-11
// Ultima actualizacion :
//
// Description : Modelo para manejar los datos y querys del modulo de usuarios
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
  private string $strSaltCrypt = "4c9458523191fcafdc35990b85ee868a";    //Codigo Un14Jc_M4p$* generado bajo el hash MD5 
  private int $intRolId;
  private int $intEstadoId;
  private int $intUsuId;

  public function __construct()
  {
    parent::__construct();
  }

  public function obtenerUsuariosModel( bool $withOutAdmins = False)
  {
    $query = "SELECT 
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
                    usuario.rol_id = rol.rol_id";

                    ($withOutAdmins)? $query .= " AND usuario.rol_id != 1":'';

                    $query .=" GROUP BY usuario.usu_id DESC";

    $peticion = $this->SelectAll($query);
    return $peticion;
  }

  public function getRolesModel()
  {
    $query = "SELECT * FROM rol";
    $peticion = $this->SelectAll($query);
    return $peticion;
  }

  public function saveUsuarioModel(string $nombreUsuario, string $cedulaUsuario, string $CorreoUsuario, int $rolUsuario)
  {

    $this->strUsuNombre = $nombreUsuario;
    $this->strUsuCedula = $cedulaUsuario;
    $this->strUsuCorreo = $CorreoUsuario;
    $this->intRolId = $rolUsuario;
    $this->intEstadoId = 7;
    $this->strUsuPassword = crypt($cedulaUsuario, $this->strSaltCrypt);

    $query = "INSERT INTO 
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


    $peticion = $this->Insert($query, $arrInformacion);

    return $peticion;
  }

  public function deleteUsuarioModel(int $idUsuario)
  {

    $this->intEstadoId = 8;
    $this->intUsuId = $idUsuario;

    $query = "UPDATE 
                  usuario 
                 SET 
                  est_id = ?
                 WHERE 
                  usuario.usu_id = ?
                ";

    $arrInformacion = array($this->intEstadoId, $this->intUsuId);
    $peticion = $this->Update($query, $arrInformacion);

    return $peticion;
  }

  public function enableUsuarioModel(int $idUsuario)
  {

    $this->intEstadoId = 7;
    $this->intUsuId = $idUsuario;

    $query = "UPDATE 
                  usuario 
                 SET 
                  est_id = ?
                 WHERE 
                  usuario.usu_id = ?
                ";

    $arrInformacion = array($this->intEstadoId, $this->intUsuId);
    $peticion = $this->Update($query, $arrInformacion);

    return $peticion;
  }

  public function updateUsuarioModel(string $nombreUsuario, string $cedulaUsuario, string $CorreoUsuario, int $rolUsuario, int $usu_id)
  {

    $this->strUsuNombre = $nombreUsuario;
    $this->strUsuCedula = $cedulaUsuario;
    $this->strUsuCorreo = $CorreoUsuario;
    $this->intRolId = $rolUsuario;
    $this->intUsuId = $usu_id;

    $query = "UPDATE  
                usuario
              SET
                usuario.usu_nombre = ?,
                usuario.usu_cedula = ?,
                usuario.usu_correo = ?,
                usuario.rol_id = ?
              WHERE 
                usuario.usu_id = ?
";

    $arrInformacion = array(
      $this->strUsuNombre,
      $this->strUsuCedula,
      $this->strUsuCorreo,
      $this->intRolId,
      $this->intUsuId
    );


    $peticion = $this->Update($query, $arrInformacion);

    return $peticion;
  }

  public function updatePassword($usu_id, $password)
  {
    $this->intUsuId = $usu_id;
    $this->strUsuPassword = $password;

    $query = "UPDATE 
                usuario
              SET
                usuario.usu_password = ?
              WHERE
              usuario.usu_id = ?
              ";
    $arrInformacion = array(
      $this->strUsuPassword,
      $this->intUsuId,
    );

    $peticion = $this->Update($query, $arrInformacion);

    return $peticion;
  }
}
