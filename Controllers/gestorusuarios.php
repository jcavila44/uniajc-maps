<?php
//============================================================+
// Carpeta: Controllers
// Nombre del archivo   : gestorusuarios.php
// Inicio       : 2021-09-11
// Ultima actualizacion :
//
// Description : controlador para manejar el Gestor de Usuarios de la app
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+

class GestorUsuarios extends Controllers
{
	public function __construct()
	{
		session_start();
		if (!isset($_SESSION['login'])) {
			header('Location: ' . base_url());
		}
		parent::__construct();
	}

	public function gestorUsuarios()
	{
		$data['page_tag'] = 'GestorUsuarios';
		$data['page_title'] = 'Gestor de usuarios';
		$data['page_name'] = 'Gestor de usuarios';
		$data['page_functions_js'] = 'function_gestorusuarios.js';

		$this->views->getView($this, "gestorusuarios", $data);
	}

	//Metodo para obtener todos los usuarios
	public function obtenerUsuariosController()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$arrData = $this->model->obtenerUsuariosModel();
			$arrRespuesta = array('status' => 'success', 'data' => $arrData);
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al metodo');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}
}
