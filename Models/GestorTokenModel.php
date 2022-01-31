<?php
//============================================================+
// Carpeta: Models
// Nombre del archivo   : GestorTokenModel.php
// Inicio       : 2021-11-10
// Ultima actualizacion :
//
// Description : Modelo para manejar los datos y querys de la tabla Token
//
// Author: Juan Jose Castro Cruz
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//               jjosecastro@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+

class GestorTokenModel extends MySQL
{

    private String $token_fecha;
    private String $token_vencido;
    private String $token;
    private int $usu_id;

    public function __construct()
    {
        parent::__construct();
    }

    public function saveTokenModel(String $token_fecha, String $token_vencido, String $token, int $usu_id)
    {
        $this->updateEstadoToken($usu_id);

        $this->token_fecha = $token_fecha;
        $this->token_vencido = $token_vencido;
        $this->token = $token;
        $this->usu_id = $usu_id;

        $query = "INSERT INTO `token` 
                    (
                      token_fecha, 
                      token_fecha_vencido, 
                      token,
                      usu_id,
                      est_id
                    ) VALUES (
                      ?,
                      ?,
                      ?,
                      ?,
                      ?
                    )";

        $arrInformacion = array(
            $this->token_fecha,
            $this->token_vencido,
            $this->token,
            $this->usu_id,
            13
        );


        $peticion = $this->Insert($query, $arrInformacion);

        return $peticion;
    }

    public function consultarTokenRecoverPassword(string $Token)
    {

        $this->token = $Token;
        $dateNow =  date('Y-m-d H:i:s');

        $query = "SELECT 
                            token_fecha, 
                            token_fecha_vencido,
                            usu_id		
                FROM 
                            token
                WHERE 
                            token.token =  '$Token'  AND
                            token.token_fecha_vencido > '$dateNow' AND 
                            token.est_id = 13
                ";

        $peticion = $this->Select($query);
        return $peticion;
    }


    private function updateEstadoToken($idUsuario)
    {
  
      $query = "UPDATE 
                  token
                SET
                  token.est_id = ?
                WHERE
                  token.usu_id = ?
                ";
      $arrInformacion = array(
        14, //Token inhabilitado
        $idUsuario,
      );
  
      $peticion = $this->Update($query, $arrInformacion);
  
      return $peticion;
    }

}
