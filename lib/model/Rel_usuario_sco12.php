<?php

/**
 * Subclass for representing a row from the 'rel_usuario_sco12' table.
 *
 *
 *
 * @package lib.model
 */
class Rel_usuario_sco12 extends BaseRel_usuario_sco12
{

  public function getTiempoTotal()
  {
    require_once(sfConfig::get('sf_lib_dir').'/functions.php');
    //require_once("__FILE__/../functions.php");
    return (traducir_de_fecha_scorm12($this->session_time) + traducir_de_fecha_scorm12($this->total_time));
  }

  // Devuelve un string con Horas:Minutos  invertidos en el Sco
  public function showTiempoTotal()
  {
    $t = $this->getTiempoTotal();
    $result = sprintf("%02d:%02d", floor($t / 3600), (floor($t / 60) % 60));
    return $result;
  }
}