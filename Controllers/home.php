<?php
//============================================================+
// Carpeta: Controllers
// Nombre del archivo   : home.php
// Inicio       : 2021-09-11
// Ultima actualizacion :
//
// Description : controlador para manejar el home de la app
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+


class Home extends Facade
{
	public function __construct()
	{
		session_start();
		if (!isset($_SESSION['login'])) {
			header('Location: ' . base_url() . "/Logout");
		}
		parent::__construct();
	}

	public function home()
	{
		$_SESSION['login'] = true;
		$data['page_tag'] = 'Home';
		$data['page_title'] = 'Home';
		$data['page_name'] = 'Pagina principal';
		$data['page_functions_js'] = 'function_home.js';

		$this->views->getView($this, "home", $data);
	}
}
