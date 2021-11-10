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

	private string $strUsuCorreo;

	public function __construct()
	{
		parent::__construct();
	}

	public function consultarUsuarioLoginModel(string $CorreoUsuario)
	{

		$this->strUsuCorreo = $CorreoUsuario;

		$query = "SELECT 
										usuario.usu_id,
										usuario.usu_correo,
										usuario.usu_password,
										usuario.usu_nombre,
										usuario.usu_cedula,
										estado.estado_descripcion,
										rol.rol_descripcion,
										estado.estado_id
							FROM 
										usuario,
										estado,
										rol
							WHERE 
										usuario.est_id = estado.estado_id AND
										usuario.rol_id = rol.rol_id AND 
										estado.estado_id = 7 AND 
										usuario.usu_correo LIKE '%" . $this->strUsuCorreo . "%'
    ";

		$peticion = $this->Select($query);
		return $peticion;
	}


	public function consultarUsuarioRecoverPasswordModel(string $CorreoUsuario)
	{

		$this->strUsuCorreo = $CorreoUsuario;

		$query = "SELECT 
										usuario.usu_id,
										usuario.usu_correo,
										rol.rol_descripcion,
										estado.estado_id
							FROM 
										usuario,
										estado,
										rol
							WHERE 
										usuario.est_id = estado.estado_id AND
										usuario.rol_id = rol.rol_id AND 
										estado.estado_id = 7 AND 
										usuario.usu_correo LIKE '%" . $this->strUsuCorreo . "%'
    ";

		$peticion = $this->Select($query);
		return $peticion;
	}
}
