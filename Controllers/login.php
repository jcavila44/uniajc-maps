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


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Login extends Facade
{
	public function __construct()
	{
		session_start();
		if (isset($_SESSION['login'])) {
			header('Location: ' . base_url() . 'home');
		} else {

			if (isset($_SESSION['ForgotEmailSended']) && $_SESSION['ForgotEmailSended'] == 1) {
				header('Location: ' . base_url() . 'login/emailSendForgotPassword');
			}
		}
		parent::__construct();
	}

	public function login()
	{
		$data['page_id'] = 1;
		$data['page_tag'] = 'Login';
		$data['page_title'] = 'Login';
		$data['page_name'] = 'Pagina principal';
		$data['page_functions_js'] = 'function_login.js';
		$data['page_header'] = 0;

		$this->views->getView($this, "login", $data);
	}

	public function forgotPassword()
	{
		$data['page_id'] = 1;
		$data['page_tag'] = 'Forgot Password';
		$data['page_title'] = 'Forgot Password';
		$data['page_name'] = 'Pagina principal';
		$data['page_functions_js'] = 'function_login.js';
		$data['page_header'] = 0;

		$this->views->getView($this, "forgotPassword", $data);
	}

	public function emailSendForgotPassword()
	{
		$data['page_id'] = 1;
		$data['page_tag'] = 'Email Sended';
		$data['page_title'] = 'Email Sended';
		$data['page_name'] = 'Pagina principal';
		$data['page_functions_js'] = 'function_login.js';
		$data['page_header'] = 0;
		$data['emailUser'] = $_SESSION['emailUser'];
		$_SESSION['ForgotEmailSended'] = 0;


		$this->views->getView($this, "emailSendForgotPassword", $data);
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

	public function loginUser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (!empty($_POST['correo']) || !empty($_POST['contrasena'])) {

				$correo = limpiar_cadena($_POST['correo']);
				$contrasena = limpiar_cadena($_POST['password']);
				$ObtenerUsuario = $this->consultarUsuarioLogin($correo);

				if (
					$ObtenerUsuario &&
					$correo == $ObtenerUsuario['usu_correo'] &&
					password_verify($contrasena, $ObtenerUsuario['usu_password'])
				) {
					if ($ObtenerUsuario['estado_id'] == 7) {

						$_SESSION['login'] = true;
						$_SESSION['idusuario'] = $ObtenerUsuario['usu_id'];
						$_SESSION['correo'] = $ObtenerUsuario['usu_correo'];
						$_SESSION['nombre'] = $ObtenerUsuario['usu_nombre'];
						$_SESSION['cedula'] = $ObtenerUsuario['usu_cedula'];
						$_SESSION['rol'] = $ObtenerUsuario['rol_descripcion'];
						$arrRespuesta = array('status' => 'success', 'msg' => 'Inicio de sesión exitoso');
					} else {
						$arrRespuesta = array('status' => 'success', 'msg' => 'Usuario inhabilitado');
					}
				} else {
					$arrRespuesta = array('status' => 'warning', 'msg' => 'Usuario no encontrado o credenciales no coinciden');
				}
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'Los datos estan vacios');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al metodo');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
	}

	public function recoverPassword()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$correo = $_POST['correo'];

			$ObtenerUsuario = $this->consultarUsuarioRecoverPassword($correo);
			if ($ObtenerUsuario && $correo == $ObtenerUsuario['usu_correo']) {
				$_SESSION['ForgotEmailSended'] = 1;
				$_SESSION['emailUser'] = $correo;

				$mail = new PHPMailer(true);

				try {
					// $mail->SMTPDebug = 2;
					$mail->isSMTP();
					$mail->Host       = 'smtp.office365.com;';
					$mail->SMTPAuth   = true;
					$mail->Username   = 'jjosecastro@estudiante.uniajc.edu.co';
					$mail->Password   = '990804Cafeto6';
					$mail->SMTPSecure = 'tls';
					$mail->Port       = 587;

					$mail->setFrom('jjosecastro@estudiante.uniajc.edu.co', 'Juan Jose Castro Cruz');
					$mail->addAddress('juanjosecastrocruz@gmail.com');
					$mail->addAddress('jjcastro601@misena.edu.co', 'Juanjo');

					$mail->isHTML(true);
					$mail->Subject = 'Subject';
					$mail->Body    = 'Hola ' . $correo . ' este es tu link de recuperacion de la contraseña <b>www.google.com/</b> ';
					$mail->AltBody = 'Body in plain text for non-HTML mail clients';
					$enviar = $mail->send();

					$arrRespuesta = array('status' => 'success', 'msg' => 'El correo se ha enviado correctamente2', 'data' => $enviar);
				} catch (Exception $e) {
					$arrRespuesta = array('status' => 'error', 'msg' => 'El correo no se ha enviado correctamente ' . $mail->ErrorInfo . '');
				}
			} else {
				$arrRespuesta = array('status' => 'error', 'msg' => 'El usuario no fue encontrado');
			}
		} else {
			$arrRespuesta = array('status' => 'error', 'msg' => 'La peticion HTTP, no corresponde al metodo');
		}
		echo json_encode($arrRespuesta, JSON_UNESCAPED_UNICODE);
	}
}
