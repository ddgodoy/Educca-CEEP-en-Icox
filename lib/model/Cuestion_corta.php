<?php

/**
 * Subclass for representing a row from the 'cuestion_corta' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Cuestion_corta extends BaseCuestion_corta
{

  public function getRespuestaEjercicio($id_solucion)
  {
    if ($id_solucion) {
      $c = new Criteria();
      $c->add(Respuesta_cuestion_cortaPeer::ID_CUESTION_CORTA, $this->getId());
      $c->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $id_solucion);
      return Respuesta_cuestion_cortaPeer::DoSelectOne($c);
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
