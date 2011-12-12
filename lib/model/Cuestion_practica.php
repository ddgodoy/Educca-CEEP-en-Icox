<?php

/**
 * Subclass for representing a row from the 'cuestion_practica' table.
 *
 *
 *
 * @package lib.model
 */
class Cuestion_practica extends BaseCuestion_practica
{

  // Esta funcion ejecuta el delete normal y además borra las imagenes asociadas
	// a la respuesta si existia alguna
  public function delete_extendido()
	{
    $this->delete();
    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/images/ecuaciones/cuestionp_'.$this->getId().'.png'))
		{
      unlink($_SERVER['DOCUMENT_ROOT'].'/images/ecuaciones/cuestionp_'.$this->getId().'.png');
    }
  }
  
  
  public function getRespuestaEjercicio($id_solucion)
  {
    if ($id_solucion) {
      $c = new Criteria();
      $c->add(Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA, $this->getId());
      $c->add(Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO, $id_solucion);
      return Respuesta_cuestion_practicaPeer::DoSelectOne($c);
    } else { return 0;}
  }
  
  
  public function getSolucion()
  {
    $id_ejercicio = $this->getIdEjercicio();
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $ejercicio->getIdAutor());
    $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $ejercicio->getId());
    $ejercicio_resuelto = Ejercicio_resueltoPeer::DoSelectOne($c);
    
    if ($ejercicio_resuelto) {
      $c = new Criteria();
      $c->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $ejercicio_resuelto->getId());
      $c->add(Respuesta_cuestion_cortaPeer::ID_CUESTION_CORTA, $this->getId());
      $solucion = Respuesta_cuestion_cortaPeer::DoSelectOne($c);
      return $solucion;
    }
  }



}
