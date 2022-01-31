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

    public function __construct()
    {
        parent::__construct();
    }

    public function addRelationMapaUser(int $mapaId = 23, Array $usuId = array(1,2))
    {

         $arrInformacion = [];

        $this->MapaID =  $mapaId;
        
        $query = "INSERT INTO 
            mapa_usuario(
                mapa_id,
                usu_id
            )
            VALUES ";
        $lengthArray = count($usuId);
        
        foreach ($usuId as $key => $value) {
            $query .=  "(?,?)";
            $test = array_push($arrInformacion, $this->MapaID, $value);
            if ($key < $lengthArray - 1 ) {
                $query .=  ", ";
            }else{
                $query .=  ";";
            }
        }
        
        $peticion = $this->Insert($query, $arrInformacion);
        return ($peticion > 0) ? $peticion : false;
    }

    public function getRelationMapaUser(int $mapaId)
    {
        $this->MapaID =  $mapaId;
        
        $query = "SELECT * FROM mapa_usuario WHERE mapa_id = $mapaId;";
        $peticion = $this->SelectAll($query);
        return $peticion;

    }

    public function deleteRelationMapaUser(int $mapaId = 23){
        $this->MapaID =  $mapaId;
        
        $query = "DELETE FROM mapa_usuario WHERE mapa_id = $mapaId;";
        $peticion = $this->Delete($query);
        return $peticion;
    }
}
