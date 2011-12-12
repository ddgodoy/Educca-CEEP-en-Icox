<?php

/**
 * columna_derecha componente. Desde este componente se mostrarán los módulos
 * necesarios a la derecha de la interfaz de cada usuario
 *
 * @package    edoceo
 * @subpackage columna_derecha
 * @author     Todor Blajev
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class columna_derechaComponents extends sfComponents
{
  /**
   * Executes default action
   *
   */
  public function executeDefault()
  {
  }

  public function executeAlumno()
  {
      $this->alumno = $this->getUser()->getAlumno();
      $this->id = $this->getUser()->getAlumnoId();
      $this->foto = $this->id.'.jpg';
  }

  public function executeProfesor()
  {
      $this->profesor = $this->getUser()->getProfesor();
      $this->id = $this->getUser()->getAlumnoId();
      $this->foto = $this->id.'.jpg';
  }
  
  public function executeOferta()
  {
  }
}
