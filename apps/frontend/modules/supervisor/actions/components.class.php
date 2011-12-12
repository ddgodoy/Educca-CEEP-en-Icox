<?php

/**
 * calendario actions.
 *
 * @package    edoceo
 * @subpackage supervisor
 * @author     Jacobo
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class supervisorComponents extends sfComponents
{
  /**
   * Executes index action
   *
   */
  public function executeDefault()
  {
  }

  /***************************************
   ** Lista todos los cursos y paquetes **
   ** para poder gestionarlos           **
   **************************************/

  public function executeMostrarCursos()
  {
     $c = new Criteria();
	   $this->cursos = CursoPeer::doSelect($c);
     return;
  }

  public function executeMostrarModulos()
  {
    $c = new Criteria();
	  $this->modulos = PaquetePeer::doSelect($c);
    return;
  }

}
