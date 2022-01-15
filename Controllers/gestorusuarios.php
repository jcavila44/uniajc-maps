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

class GestorUsuarios extends Facade
{
	public function __construct()
	{
		session_start();
		if (!isset($_SESSION['login'])) {
			header('Location: ' . base_url() . "/Logout");
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

			$arrData = $this->obtenerUsuarios();
			$arrRespuesta = array('status' => 'success', 'data' => $arrData);
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}

	//Metodo para obtener todos los usuarios
	public function getRolesController()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {

			$arrData = $this->getRoles();
			$arrRespuesta = array('status' => 'success', 'data' => $arrData);
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}
	//Metodo para obtener todos los usuarios
	public function saveInfoUserController()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$nombreUsuario = limpiar_cadena($_POST['nombreUsuario']);
			$cedulaUsuario = limpiar_cadena($_POST['cedulaUsuario']);
			$CorreoUsuario = limpiar_cadena($_POST['CorreoUsuario']);
			$rolUsuario = limpiar_cadena($_POST['rolUsuario']);

			$peticion = $this->saveUsuario($nombreUsuario, $cedulaUsuario, $CorreoUsuario, $rolUsuario);

			if ($peticion > 0) {
				$arrRespuesta = array('status' => 'success', 'msg' => 'Usuario agregado satisfactoriamente');
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'No se ha podido registrar');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}

	//Metodo para obtener todos los usuarios
	public function deleteUserController()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$idUsuario = limpiar_cadena($_POST['idUsuario']);

			$peticion = $this->deleteUsuario($idUsuario);

			if ($peticion > 0) {
				$arrRespuesta = array('status' => 'success', 'msg' => 'Usuario agregado satisfactoriamente');
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'No se ha podido registrar');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}

	//Metodo para obtener todos los usuarios
	public function enableUserController()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$idUsuario = limpiar_cadena($_POST['idUsuario']);

			$peticion = $this->enableUsuario($idUsuario);

			if ($peticion > 0) {
				$arrRespuesta = array('status' => 'success', 'msg' => 'Usuario agregado satisfactoriamente');
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'No se ha podido registrar');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}


	//Metodo para obtener todos los usuarios
	public function actualizarInfoUserController()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$nombreUsuario = limpiar_cadena($_POST['nombreUsuario']);
			$cedulaUsuario = limpiar_cadena($_POST['cedulaUsuario']);
			$CorreoUsuario = limpiar_cadena($_POST['CorreoUsuario']);
			$rolUsuario = limpiar_cadena($_POST['rolUsuario']);
			$usu_id = limpiar_cadena($_POST['usu_id']);

			$peticion = $this->updateUsuario($nombreUsuario, $cedulaUsuario, $CorreoUsuario, $rolUsuario, $usu_id);

			if ($peticion > 0) {
				$arrRespuesta = array('status' => 'success', 'msg' => 'Usuario actualizaco correctamente');
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'No se logró actualizar');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}
}
