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


	public function addMapa()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$nombreMapa = limpiar_cadena($_POST['nombreMapa']);
			$descripcionMapa = limpiar_cadena($_POST['descripcionMapa']);
			$mapaZip = $_FILES['mapaZip'];
			$zip = new ZipArchive;

			if (
				!empty($nombreMapa) && $nombreMapa !== null &&
				!empty($descripcionMapa)  && $descripcionMapa !== null &&
				!empty($mapaZip) && $mapaZip !== null
			) {
				if ($mapaZip['error'] !== 0) {
					$arrRespuesta = array('status' => 'error', 'msg' => $this->ErrorFile($mapaZip['error']));
				} else {
					date_default_timezone_set("America/Bogota");
					$nombre = $_FILES["mapaZip"]["name"];
					$ruta = $_FILES["mapaZip"]["tmp_name"];
					$tipo = $_FILES["mapaZip"]["type"];
					$nombreFolder = date("Y-m-d_H-i-s");

					if ($tipo == "application/x-zip-compressed") {

						if ($zip->open($ruta) === TRUE) {
							$zip->extractTo('./temp/' . $nombreFolder . '/');
							$zip->close();

							$arrRespuesta = array('status' => 'success', 'msg' => 'El archivo se guardo correctemente');
						} else {
							$arrRespuesta = array('status' => 'warning', 'msg' => 'No se logró descomprimir el archivo ZIP');
						}
					} else {
						$arrRespuesta = array('status' => 'warning', 'msg' => 'Solo se permiten archivos con extension .zip');
					}
				}
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'No se permiten campos vacíos.');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método.');
		}

		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}


	private function ErrorFile($error)
	{
		$phpFileUploadErrors = array(
			'No hay ningún error, el archivo se cargó correctamente.',
			'El archivo cargado excede la directiva upload_max_filesize en php.ini.',
			'El archivo cargado excede la directiva MAX_FILE_SIZE que se especificó en el formulario HTML.',
			'El archivo cargado solo se cargó parcialmente.',
			'Ningun archivo fue subido.',
			'Falta una carpeta temporal.',
			'No se pudo escribir el archivo en el disco.',
			'Una extensión PHP detuvo la carga del archivo.',
		);

		return $phpFileUploadErrors[$error];
	}
}
