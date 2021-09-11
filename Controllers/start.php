<?php
//============================================================+
// Carpeta: Controllers
// Nombre del archivo   : start.php
// Inicio       : 2021-09-11
// Ultima actualizacion :
//
// Description : controlador para manejar el inicio de la app
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//                    jcavila@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+
class Start extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Start()
    {
        $this->views->getView($this, 'start');
    }
}
