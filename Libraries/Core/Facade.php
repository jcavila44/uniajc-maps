<?php

require_once('Models/HomeModel.php');
require_once('Models/LoginModel.php');
require_once('Models/StartModel.php');
require_once('Models/GestorUsuariosModel.php');
require_once('Models/GestorMapasModel.php');
require_once('Models/GestorMapasUsuarioModel.php');
require_once('Models/GestorTokenModel.php');

class Facade
{

  protected $HomeModel;
  protected $GestorUsuariosModel;
  protected $GestorMapasModel;
  protected $GestorTokenModel;
  protected $StartModel;
  protected $LoginModel;

  public function __construct()
  {
    $this->HomeModel = new HomeModel();
    $this->GestorUsuariosModel = new GestorUsuariosModel();
    $this->GestorMapasModel = new GestorMapasModel();
    $this->GestorMapasUsuarioModel = new GestorMapasUsuarioModel();
    $this->GestorTokenModel = new GestorTokenModel();
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

  public function enableUsuario($idUsuario)
  {
    return $this->GestorUsuariosModel->enableUsuarioModel($idUsuario);
  }

  public function updateUsuario($nombreUsuario, $cedulaUsuario, $CorreoUsuario, $rolUsuario, $usu_id)
  {
    return $this->GestorUsuariosModel->updateUsuarioModel($nombreUsuario, $cedulaUsuario, $CorreoUsuario, $rolUsuario, $usu_id);
  }

  public function updatePassword($usu_id, $password)
  {
    return $this->GestorUsuariosModel->updatePassword($usu_id, $password);
  }

  public function consultarUsuarioLogin($CorreoUsuario)
  {
    return $this->LoginModel->consultarUsuarioLoginModel($CorreoUsuario);
  }

  public function consultarUsuarioRecoverPassword($CorreoUsuario)
  {
    return $this->LoginModel->consultarUsuarioRecoverPasswordModel($CorreoUsuario);
  }

  public function saveTokenModel($token_fecha, $token_vencido, $token, $usu_id)
  {
    return $this->GestorTokenModel->saveTokenModel($token_fecha, $token_vencido, $token, $usu_id);
  }

  public function consultarTokenRecoverPassword($Token)
  {
    return $this->GestorTokenModel->consultarTokenRecoverPassword($Token);
  }

  public function guardarCapas(string $jsonData)
  {
    return $this->GestorMapasModel->guardarCapas($jsonData);
  }

  public function guardarMapa(string $nombreMapa, string $descripcionMapa, string $ruta)
  {
    return $this->GestorMapasModel->guardarMapa($nombreMapa, $descripcionMapa, $ruta);
  }

  public function guardarMapaUsuario(int $mapaId, Array $usuId )
  {
    return $this->GestorMapasUsuarioModel->addRelationMapaUser($mapaId, $usuId);
  }

  public function guardarMapaCapa(int $idMapa, int $idCapa)
  {
    return $this->GestorMapasModel->guardarMapaCapa($idMapa, $idCapa);
  }

  public function obtenerMapas(bool $Is_Admin = true, int $user_id = null)
  {
    return $this->GestorMapasModel->obtenerMapasModel($Is_Admin, $user_id );
  }

  public function getDataMapa(int $idMapa)
  {
    return $this->GestorMapasModel->obtenerCapasModel($idMapa);
  }

  public function eliminarMapa(int $idMapa)
  {
    return $this->GestorMapasModel->eliminarMapa($idMapa);
  }

  public function habilitarMapa(int $idMapa)
  {
    return $this->GestorMapasModel->habilitarMapa($idMapa);
  }

  public function editarMapaController(int $mapaId, string $nombreMapa, string $descripcionMapa, string $ruta)
  {
    return $this->GestorMapasModel->editarMapaController($mapaId, $nombreMapa, $descripcionMapa, $ruta);
  }
}
