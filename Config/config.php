<?php
//Zona horaria de la región
date_default_timezone_set('America/Bogota');

//Nombre del proyecto
const PROJECT_NAME = "UNIAJC MAPS";

//Ruta del proyecto
const BASE_URL = "http://localhost/uniajc-maps/";


//Datos de conexion Base de datos
const DB_HOST = "";
const DB_USER = "";
const DB_PASSWORD = "";
const DB_NAME = "";
const DB_CHARSET = "";
const DB_DRIVER = "";

const ROUTES =
[
  'app' => array(
    'Home' => BASE_URL . 'home',
    'Start' => BASE_URL . 'start',
    'Login' => BASE_URL . 'login',
    'Logout' => BASE_URL . 'login/logout',
    'UserProfile' => BASE_URL . 'login/userprofile',
    'GestorUsuario' => BASE_URL . 'gestorusuarios',
    'GestorMapas' => BASE_URL . 'gestormapas',
    'NotFound' => BASE_URL . 'notfound',
  )
];