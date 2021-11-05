<?php
//============================================================+
// Carpeta: Controllers
// Nombre del archivo   : gestormapas.php
// Inicio       : 2021-09-11
// Ultima actualizacion :
//
// Description : controlador para manejar el Gestor de mapas de la app
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+


class GestorMapas extends Facade
{
	public function __construct()
	{
		session_start();
		if (!isset($_SESSION['login'])) {
			header('Location: ' . base_url() . "/Logout");
		}
		
		parent::__construct();
	}

	public function gestorMapas()
	{
		$data['page_tag'] = 'GestorMapas';
		$data['page_title'] = 'Gestor de mapas';
		$data['page_name'] = 'Gestor de mapas';
		$data['page_functions_js'] = 'function_gestormapas.js';

		$this->views->getView($this, "gestormapas", $data);
	}
}
