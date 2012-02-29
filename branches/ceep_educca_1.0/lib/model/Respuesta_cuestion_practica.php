<?php

/**
 * Subclass for representing a row from the 'respuesta_cuestion_practica' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Respuesta_cuestion_practica extends BaseRespuesta_cuestion_practica
{

  // Esta funcion ejecuta el delete normal y además borra las imagenes asociadas
	// a la respuesta si existia alguna
	public function delete_extendido()
	{
    $this->delete();

  }

}
