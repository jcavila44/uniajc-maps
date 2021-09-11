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
class LoginModel extends MySQL
{
	private $intIdUsuario;
	private $strUsuario;
	private $strPassword;
	private $strToken;

	public function __construct()
	{
		parent::__construct();
	}

}
