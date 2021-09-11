<?php
//============================================================+
// Carpeta: Controllers
// Nombre del archivo   : login.php
// Inicio       : 2021-09-11
// Ultima actualizacion :
//
// Description : controlador para manejar todo lo relacionado al login de la app
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+

class Login extends Controllers
{
	public function __construct()
	{
		session_start();
		// if (isset($_SESSION['login'] )) {
		// 	header('Location: ' . base_url() . 'home');
		// }
		parent::__construct();
	}

	public function login()
	{
		$_SESSION['login'] = true;
		$data['page_id'] = 1;
		$data['page_tag'] = 'Login';
		$data['page_title'] = 'Login';
		$data['page_name'] = 'Pagina principal';
		$data['page_functions_js'] = 'function_login.js';
		$data['page_header'] = 0;

		$this->views->getView($this, "login", $data);
	}

	public function logout()
	{
		session_start();
		session_unset();
		session_destroy();
		header('location: ' . base_url() . 'login');
	}

	public function userprofile()
	{
		$_SESSION['login'] = true;
		$data['page_id'] = 1;
		$data['page_tag'] = 'Perfil de usuario';
		$data['page_title'] = 'Perfil de usuario';
		$data['page_name'] = 'Pagina principal';
		$data['page_functions_js'] = 'function_user_profile.js';
		$data['page_header'] = 0;

		$this->views->getView($this, "userprofile", $data);
	}

}
