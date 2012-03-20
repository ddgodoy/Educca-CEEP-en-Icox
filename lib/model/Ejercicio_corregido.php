<?php

/**
 * Subclass for representing a row from the 'ejercicio_corregido' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Ejercicio_corregido extends BaseEjercicio_corregido
{
  public static  function getEjerciciosCursoEstado($id_usuario, $id_ejercicio, $corregidos=false)
  {
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $id_usuario);
    $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $id_ejercicio);

    if ($corregidos) {
    	$c->add(Ejercicio_resueltoPeer::ID_CORRECTOR, NULL, Criteria::NOT_EQUAL);
    }
    return Ejercicio_resueltoPeer::DoCount($c);
  }
}
