<?php

/**
 * Subclass for representing a row from the 'historico_cursos_usuarios_activos' table.
 *
 *
 *
 * @package lib.model
 */
class Historico_cursos_usuarios_activos extends BaseHistorico_cursos_usuarios_activos
{
  public function updateCurso($curso)
  {
       $this->setIdCurso($curso->getId());
       $this->setNombre($curso->getNombre());
       $this->setFechaInicio($curso->getFechaInicio());
       $this->setFechaFin($curso->getFechaFin());
       $this->setDuracion($curso->getDuracion());
       $this->setPrecio($curso->getPrecio());
       $this->save();
  }
}
