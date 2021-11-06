<?php

require_once('Models/HomeModel.php');
require_once('Models/LoginModel.php');
require_once('Models/StartModel.php');
require_once('Models/GestorUsuariosModel.php');

class Facade
{

  protected $HomeModel;
  protected $GestorUsuariosModel;
  protected $StartModel;
  protected $LoginModel;

  public function __construct()
  {
    $this->HomeModel = new HomeModel();
    $this->GestorUsuariosModel = new GestorUsuariosModel();
    $this->StartModel = new StartModel();
    $this->LoginModel = new LoginModel();
    $this->views = new Views();
  }

  public function obtenerUsuarios()
  {
    return $this->GestorUsuariosModel->obtenerUsuariosModel();
  }

  public function getRoles()
  {
    return $this->GestorUsuariosModel->getRolesModel();
  }

  public function saveUsuario($nombreUsuario, $cedulaUsuario, $CorreoUsuario, $rolUsuario)
  {
    return $this->GestorUsuariosModel->saveUsuarioModel($nombreUsuario, $cedulaUsuario, $CorreoUsuario, $rolUsuario);
  }

  public function deleteUsuario($idUsuario)
  {
    return $this->GestorUsuariosModel->deleteUsuarioModel($idUsuario);
  }

  public function updateUsuario($nombreUsuario, $cedulaUsuario, $CorreoUsuario, $rolUsuario, $usu_id)
  {
    return $this->GestorUsuariosModel->updateUsuarioModel($nombreUsuario, $cedulaUsuario, $CorreoUsuario, $rolUsuario, $usu_id);
  }

  public function consultarUsuarioLogin($CorreoUsuario)
  {
    return $this->LoginModel->consultarUsuarioLoginModel($CorreoUsuario);
  }
}
