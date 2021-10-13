<?php 
//============================================================+
// Carpeta: Models
// Nombre del archivo   : HomeModel.php
// Inicio       : 2021-09-11
// Ultima actualizacion :
//
// Description : Modelo para manejar los datos y querys del modulo de Start
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//		Institución Universitaria Antonio Jose Camacho
//============================================================+

class HomeModel extends MySQL
{
    public function __construct(){
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
