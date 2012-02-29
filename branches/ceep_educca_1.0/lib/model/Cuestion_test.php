<?php

/**
 * Subclass for representing a row from the 'cuestion_test' table.
 *
 *
 *
 * @package lib.model
 */
class Cuestion_test extends BaseCuestion_test
{

	public function getRespuestas()
	{

		$c = new Criteria();
		$c->add(Respuesta_cuestion_testPeer::ID_CUESTION_TEST, $this->getId());
		return Respuesta_cuestion_testPeer::DoSelect($c);
	}



	// Esta funcion ejecuta el delete normal y además borra las imagenes asociadas
	// a la cuestión de test si existia alguna
	public function delete_extendido()
	{
    $this->delete();
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/images/ecuaciones/cuestiont_'.$this->getId().'.png'))
		{
       unlink($_SERVER['DOCUMENT_ROOT'].'/images/ecuaciones/cuestiont_'.$this->getId().'.png');
    }
  }

}
