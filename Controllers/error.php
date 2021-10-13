<?php
//============================================================+
// Carpeta: Controllers
// Nombre del archivo   : error.php
// Inicio       : 2021-09-11
// Ultima actualizacion :
//
// Description : controlador para manejar los errores de la app
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//                    jcavila@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+
class Errors extends Facade
{
    public function __construct()
    {
        parent::__construct();
    }

    public function notFound()
    {
        $this->views->getView($this, "error");
    }
}
$notFound = new Errors();
$notFound->notFound();
