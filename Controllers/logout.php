<?php
//============================================================+
// Carpeta: Controllers
// Nombre del archivo   : logout.php
// Inicio       : 2021-11-04
// Ultima actualizacion :
//	
// Description : controlador para manejar el logout de la app
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+
class Logout extends Facade
{
	public function __construct()
	{
		session_start();
		session_unset();
		session_destroy();
		header('location: ' . base_url() . 'login');
	}
}
