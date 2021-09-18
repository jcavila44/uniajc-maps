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

  private $strUsuCorreo;
  private $strUsuNombre;
  private $strUsuPassword;
  private $intRolId;
  private $intEstadoId;

  public function __construct()
  {
    parent::__construct();
  }

  public function obtenerUsuariosModel()
  {
    $consulta = "
                  SELECT
                      *
                  FROM
                      usuario
    ";
    $peticion = $this->SelectAll($consulta);
    return $peticion;
  }
}
