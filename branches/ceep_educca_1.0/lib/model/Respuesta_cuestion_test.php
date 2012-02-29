<?php

/**
 * Subclass for representing a row from the 'respuesta_cuestion_test' table.
 *
 *
 *
 * @package lib.model
 */
class Respuesta_cuestion_test extends BaseRespuesta_cuestion_test
{

  public function getSeleccionEjercicio($id_solucion)
  {
    if ($id_solucion) {
      $c = new Criteria();
      $c->add(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, $this->getId());
      $c->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $id_solucion);
      return Seleccion_cuestion_testPeer::DoSelectOne($c);
    } else { return 0;}
  }

  // Esta funcion ejecuta el delete normal y además borra las imagenes asociadas
	// a la respuesta si existia alguna
	public function delete_extendido()
	{
    $this->delete();
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/images/ecuaciones/respuestat_'.$this->getId().'.png'))
		{
       unlink($_SERVER['DOCUMENT_ROOT'].'/images/ecuaciones/respuestat_'.$this->getId().'.png');
    }
  }

}
