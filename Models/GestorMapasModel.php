<?php
//============================================================+
// Carpeta: Models
// Nombre del archivo   : GestorMapasModel.php
// Inicio       : 2021-11-13
// Ultima actualizacion :
//
// Description : Modelo para manejar los datos y querys del modulo de mapas
//
// Author: Jose Carlos Avila Perea
//
// (c) Copyright:
//               jcavila@estudiante.uniajc.edu.co
//               jjosecastro@estudiante.uniajc.edu.co
//				Institución Universitaria Antonio Jose Camacho
//============================================================+
class GestorMapasModel extends MySQL
{

  private string $strCapaPropiedades;
  private string $strCapaGeometria;
  private string $strCapaTipo;
  private string $strMapaNombre;
  private string $strMapaDescripcion;
  private string $strMapaRuta;
  private int $intEstId;
  private int $intMapaId;
  private int $intCapaId;

  public function __construct()
  {
    parent::__construct();
  }

  public function guardarCapas(string $jsonData)
  {

    $this->strCapaPropiedades = strval($jsonData);
    $this->strCapaGeometria = 'JS';
    $this->strCapaTipo = 'JSON';

    $query = "INSERT INTO 
                capa(
                    capa_propiedades,
                    capa_geometria,
                    capa_tipo
                )
                VALUES(?, ?, ?);
    ";

    $arrInformacion = array(
      $this->strCapaPropiedades,
      $this->strCapaGeometria,
      $this->strCapaTipo
    );

    $peticion = $this->Insert($query, $arrInformacion);

    return ($peticion > 0) ? $peticion : false;
  }

  public function guardarMapa(string $nombreMapa, string $descripcionMapa, string $ruta)
  {

    $this->strMapaNombre = $nombreMapa;
    $this->strMapaDescripcion = $descripcionMapa;
    $this->strMapaRuta = $ruta;
    $this->intEstId = 9; // mapa activo

    $query = "INSERT INTO 
                mapa(
                    mapa_nombre,
                    mapa_descripcion,
                    mapa_ruta,
                    est_id
                )
              VALUES (?, ?, ?, ?);
    ";

    $arrInformacion = array(
      $this->strMapaNombre,
      $this->strMapaDescripcion,
      $this->strMapaRuta,
      $this->intEstId
    );

    $peticion = $this->Insert($query, $arrInformacion);

    return ($peticion > 0) ? $peticion : false;
  }

  public function guardarMapaCapa(int $idMapa, int $idCapa)
  {

    $this->intMapaId = $idMapa;
    $this->intCapaId = $idCapa;
    $this->intEstId = 9; // mapa activo

    $query = "INSERT INTO 
                menu_capa_mapa(
                    menu_capa_id,
                    menu_mapa_id
                )
              VALUES (?, ?);
    ";

    $arrInformacion = array(
      $this->intCapaId,
      $this->intMapaId
    );

    $peticion = $this->Insert($query, $arrInformacion);

    return ($peticion > 0) ? $peticion : false;
  }

  public function obtenerMapasModel()
  {
    $query = "SELECT
                  *
              FROM
                  mapa
              WHERE
                  mapa.est_id = 9 or mapa.est_id = 10
              ORDER BY mapa.mapa_id DESC
              ;
    ";
    $peticion = $this->SelectAll($query);
    return $peticion;
  }

  public function obtenerCapasModel(int $idMapa)
  {
    $query = "SELECT
                  *
              FROM
                  capa,
                  mapa,
                  menu_capa_mapa
              WHERE
                  mapa.mapa_id = " . $idMapa . " AND
                  mapa.est_id = 9 AND
                  menu_capa_mapa.menu_capa_id = capa.capa_id AND
                  menu_capa_mapa.menu_mapa_id = mapa.mapa_id
    ";
    $peticion = $this->SelectAll($query);
    return $peticion;
  }

  public function eliminarMapa(int $idMapa)
  {

    $this->intEstadoId = 10;
    $this->intMapaId = $idMapa;

    $query = "UPDATE
                  mapa
              SET
                  est_id = ?
              WHERE
                  mapa_id = ?
    ";

    $arrInformacion = array($this->intEstadoId, $this->intMapaId);
    $peticion = $this->Update($query, $arrInformacion);
    return $peticion;
  }

  public function habilitarMapa(int $idMapa)
  {

    $this->intEstadoId = 9;
    $this->intMapaId = $idMapa;

    $query = "UPDATE
                  mapa
              SET
                  est_id = ?
              WHERE
                  mapa_id = ?
    ";

    $arrInformacion = array($this->intEstadoId, $this->intMapaId);
    $peticion = $this->Update($query, $arrInformacion);
    return $peticion;
  }

  public function editarMapaController(int $mapaId, string $nombreMapa, string $descripcionMapa, string $ruta)
  {

    $this->intMapaId= $mapaId;
    $this->strMapaNombre = $nombreMapa;
    $this->strMapaDescripcion = $descripcionMapa;
    $this->strMapaRuta = $ruta;

    $query = "UPDATE 
                  mapa
              SET
                  mapa_nombre = ?,
                  mapa_descripcion = ?,
                  mapa_ruta = ?
              WHERE
                  mapa_id = ?
    ";

    $arrInformacion = array(
      $this->strMapaNombre,
      $this->strMapaDescripcion,
      $this->strMapaRuta,
      $this->intMapaId
    );

    $peticion = $this->Update($query, $arrInformacion);

    return ($peticion > 0) ? $peticion : false;
  }
}
