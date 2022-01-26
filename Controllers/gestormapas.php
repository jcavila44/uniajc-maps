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


	public function getAllMapas()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			if($_SESSION['rol_id']!= 1){
				$Is_Admin = FALSE; 
				$user_id= $_SESSION['idusuario'];
			}else{
				$Is_Admin = true;
				$user_id= null;
			}
			
			$arrData = $this->obtenerMapas($Is_Admin, $user_id);
			$arrRespuesta = array('status' => 'success', 'data' => $arrData);
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
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
					$nombreFolder = './temp/' . date("Y-m-d_H-i-s") . '/';

					if ($tipo == "application/x-zip-compressed") {

						if ($zip->open($ruta) === TRUE) {

							$validarEstructuraZip = false;

							for ($i = 0; $i < $zip->numFiles; $i++) {
								($zip->getNameIndex($i) === "index.html") && ($validarEstructuraZip = true);
							}

							if ($validarEstructuraZip) {
								$archivoExtraido = $zip->extractTo($nombreFolder);
								$zip->close();
	
								if ($archivoExtraido) {
	
									$mapaSave = $this->guardarMapaController($nombreMapa, $descripcionMapa, $nombreFolder . 'index.html');
	
									if ($mapaSave != false) {
										$arrRespuesta = array('status' => 'success', 'msg' => 'Se guardó el mapa correctemente', 'idRegistered' => $mapaSave);
									} else {
										$arrRespuesta = array('status' => 'error', 'msg' => 'Ocurrió un error en la inserción, por favor validar de nuevo');
									}
								}
							} else {
								$arrRespuesta = array('status' => 'warning', 'msg' => 'El archivo .zip no contiene la estructura correspondiente. <br> Recuerda que las carpetas del mapa deben de estar en la raiz del archivo.');
							}
						} else {
							$arrRespuesta = array('status' => 'warning', 'msg' => 'No se logró descomprimir el archivo .zip');
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

	public function addRelationMapaUser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			if(isset($_POST['FirstDeleteRelation'])){
				$peticion = $this->EliminarMapaUsuario($_POST['mapaId']);
				($peticion != false) ? $arrRespuesta = array('status' => 'success', 'msg' => 'Se editó el mapa correctemente') : false;
			}
			if(isset($_POST['usuId'])){
				$peticion = $this->guardarMapaUsuario($_POST['mapaId'], json_decode($_POST['usuId']));
				($peticion != false) ? $arrRespuesta = array('status' => 'success', 'msg' => 'Se editó el mapa correctemente') : false;
			}
			echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método.');
			echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		}
	}

	public function GetRelationMapaUser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$peticion = $this->obtenerRelacionMapaUsuario($_GET['mapaId']);
			$arrData = $this->obtenerUsuarios(True);

			$arrRespuesta = array('status' => 'success', 'data' => $peticion, 'allUsers' => $arrData );
			echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método.');
			echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		}
	}

	public function addMapa2()
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
					$nombreFolder = './temp/' . date("Y-m-d_H-i-s") . '/';

					if ($tipo == "application/x-zip-compressed") {

						if ($zip->open($ruta) === TRUE) {
							$archivoExtraido = $zip->extractTo($nombreFolder);
							$zip->close();

							if ($archivoExtraido) {

								$todosLosArchivos = $this->obtenerArchivosDeCarpeta($nombreFolder . 'data/');
								$idsCapas = [];

								foreach ($todosLosArchivos as $key => $rutaArchivo) {
									$nombreArchivoJs = explode('data', $rutaArchivo);
									$dataArchivo  = $this->leerArchivo($nombreFolder . 'data/' . $nombreArchivoJs[1]);
									$extraidoSinVariable = strtolower("{" . explode('= {', strval($dataArchivo))[1]);

									$idsCapas[] = ($this->guardarCapasMap($extraidoSinVariable));
								}

								$idMapa = $this->guardarMapaController($nombreMapa, $descripcionMapa, '');

								if ($idMapa != false && count($idsCapas) > 0) {
									$responseFinal = $this->guardarMapaCapaController($idMapa, $idsCapas);

									if ($responseFinal) {
										$arrRespuesta = array('status' => 'success', 'msg' => 'Se guardó el mapa correctemente');
									} else {
										$arrRespuesta = array('status' => 'error', 'msg' => 'Ocurrió un error en la inserción, por favor validar de nuevo');
									}
								} else {
									$arrRespuesta = array('status' => 'error', 'msg' => 'Ocurrió un error en la inserción, por favor validar de nuevo');
								}
							}
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


	private function leerArchivo($nombre_fichero)
	{
		$fichero_texto = fopen($nombre_fichero, "r"); //abrimos el archivo de texto con la letra "r" en modo lectura
		$contenido_fichero = fread($fichero_texto, filesize($nombre_fichero));
		return $contenido_fichero;
	}

	private function obtenerArchivosDeCarpeta($dir, &$results = array())
	{
		$files = scandir($dir);

		foreach ($files as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path)) {
				$results[] = $path;
			} else if ($value != "." && $value != "..") {
				$this->obtenerArchivosDeCarpeta($path, $results);
				$results[] = $path;
			}
		}

		return $results;
	}

	private function guardarCapasMap(string $jsonData)
	{
		$peticion = $this->guardarCapas(strval($jsonData));
		return ($peticion != false) ? $peticion : false;
	}

	private function guardarMapaController(string $nombreMapa, string $descripcionMapa, string $ruta)
	{
		$peticion = $this->guardarMapa($nombreMapa, $descripcionMapa, $ruta);
		return ($peticion != false) ? $peticion : false;
	}


	private function guardarMapaCapaController(int $idMapa, array $idsCapas)
	{

		foreach ($idsCapas as $key => $idCapa) {
			$peticion[] = $this->guardarMapaCapa($idMapa, $idCapa);
		}

		return (in_array(false, $peticion)) ? false : true;
	}

	public function getDataMapaController()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$arrData = $this->getDataMapa(limpiar_cadena($_POST['mapa']));

			foreach ($arrData as $key => $value) {
				$arrData[$key]['capa_propiedades'] = json_decode($value['capa_propiedades']);
			}

			$arrRespuesta = array('status' => 'success', 'data' => $arrData);
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}


	public function eliminarMapaController()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$mapaId = limpiar_cadena($_POST['mapa']);

			if (!empty($mapaId) && $mapaId !== null) {
				$peticion = $this->eliminarMapa($mapaId);

				if ($peticion > 0) {
					$arrRespuesta = array('status' => 'success', 'msg' => 'Mapa eliminado correctamente');
				} else {
					$arrRespuesta = array('status' => 'error', 'msg' => 'Ocurrió un error en la eliminación, por favor validar de nuevo');
				}
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'Debes de enviar el mapa que deseas eliminar');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}

	public function habilitarMapaController()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$mapaId = limpiar_cadena($_POST['mapa']);

			if (!empty($mapaId) && $mapaId !== null) {
				$peticion = $this->habilitarMapa($mapaId);

				if ($peticion > 0) {
					$arrRespuesta = array('status' => 'success', 'msg' => 'Mapa eliminado correctamente');
				} else {
					$arrRespuesta = array('status' => 'error', 'msg' => 'Ocurrió un error en la eliminación, por favor validar de nuevo');
				}
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'Debes de enviar el mapa que deseas eliminar');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}



	public function editarMapa()
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$zip = new ZipArchive;
			$mapaRuta = limpiar_cadena($_POST['mapaRuta']);
			$mapaId = limpiar_cadena($_POST['mapa']);
			$nombreMapa = limpiar_cadena($_POST['nombreMapa']);
			$descripcionMapa = limpiar_cadena($_POST['descripcionMapa']);

			if (!empty($_FILES['mapaZip']) && $_FILES['mapaZip'] !== null && $_FILES['mapaZip']['type']) {

				if ($_FILES['mapaZip']['error'] !== 0) {
					$arrRespuesta = array('status' => 'error', 'msg' => $this->ErrorFile($_FILES['mapaZip']['error']));
					echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
					die();
				} else {

					date_default_timezone_set("America/Bogota");
					$nombre = $_FILES["mapaZip"]["name"];
					$ruta = $_FILES["mapaZip"]["tmp_name"];
					$tipo = $_FILES["mapaZip"]["type"];
					$nombreFolder = './temp/' . date("Y-m-d_H-i-s") . '/';

					if ($tipo == "application/x-zip-compressed") {
						if ($zip->open($ruta) === TRUE) {

							$validarEstructuraZip = false;

							for ($i = 0; $i < $zip->numFiles; $i++) {
								($zip->getNameIndex($i) === "index.html") && ($validarEstructuraZip = true);
							}

							if ($validarEstructuraZip) {
								$archivoExtraido = $zip->extractTo($nombreFolder);
								$zip->close();

								$rutaLimpia = str_replace("./", "", $mapaRuta);
								$rutaLimpia = str_replace("/index.html", "", $rutaLimpia);

								if ($archivoExtraido) {
									if (!empty($mapaRuta) && $mapaRuta !== null && is_dir($rutaLimpia)) {
										$this->deleteDirectory($rutaLimpia);
									}

									$mapaRuta = $nombreFolder . 'index.html';
								}
							} else {
								$arrRespuesta = array('status' => 'warning', 'msg' => 'El archivo .zip no contiene la estructura correspondiente. <br> Recuerda que las carpetas del mapa deben de estar en la raiz del archivo');
								echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
								die();
							}
						} else {
							$arrRespuesta = array('status' => 'warning', 'msg' => 'No se logró descomprimir el archivo .zip');
							echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
							die();
						}
					} else {
						$arrRespuesta = array('status' => 'warning', 'msg' => 'Solo se permiten archivos con extension .zip');
						echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
						die();
					}
				}
			}
			
			$peticion = $this->editarMapaController($mapaId, $nombreMapa, $descripcionMapa, $mapaRuta);
			
			if ($peticion > 0) {
				$arrRespuesta = array('status' => 'success', 'msg' => 'Mapa actualizado correctamente');
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'Ocurrió un error en la actualización, por favor validar de nuevo');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al método.');
		}

		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
		die();
	}


	private function deleteDirectory($dir)
	{
		if (!file_exists($dir)) {
			return true;
		}

		if (!is_dir($dir)) {
			return unlink($dir);
		}

		foreach (scandir($dir) as $item) {
			if ($item == '.' || $item == '..') {
				continue;
			}

			if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
				return false;
			}
		}

		return rmdir($dir);
	}
}
