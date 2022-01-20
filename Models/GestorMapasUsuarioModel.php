<?php
//============================================================+
// Carpeta: Models
// Nombre del archivo   : GestorMapasModel.php
// Inicio       : 2021-11-13
// Ultima actualizacion :
//
// Description : Modelo para manejar los datos y querys del modulo de mapas
//
// Author: Juan José Castro Cruz
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//               jjosecastro@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+
class GestorMapasUsuarioModel extends MySQL
{

    private int $MapaID;
    private Array $UsuId;

    public function __construct()
    {
        parent::__construct();
    }

    public function addRelationMapaUser(int $mapaId, Array $usuId)
    {

        
    $this->MapaID =  $mapaId;
    $this->UsuId = $usuId;

        $query = "INSERT INTO 
            mapa_usuario(
                mapa_id,
                usu_id
            )
            VALUES
            (?,?),
            (?,?),
            (?,?)
            ";
            $lengthArray = count($usuId);
            foreach ($usuId as $key => $value) {
                $query .=  "(?,?)";
                if($lengthArray < $key){
                    $query .=  ",";
                }
            }

        $arrInformacion = array(
            $this->MapaID,
            $this->UsuId
        );

        $peticion = $this->Insert($query);

    return ($peticion > 0) ? $peticion : false;
    }
}
