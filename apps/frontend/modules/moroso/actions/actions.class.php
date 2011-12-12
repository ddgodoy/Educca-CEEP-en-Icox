<?php
/**
 * moroso actions.
 *
 * @package    edoceo
 * @subpackage moroso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class morosoActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $moroso = $this->getUser()->getMoroso();
    $this->forward404Unless($moroso);
	  $this->cursosm = $moroso->getCursosMoroso();
	  
	  $c = new Criteria();
    $c->add(PaquetePeer::FECHA_FIN, time(), Criteria::GREATER_THAN);
    $this->paquetes = PaquetePeer::DoSelect($c);

    $c = new Criteria();
    $c->add(CursoPeer::FECHA_FIN, time(), Criteria::GREATER_THAN);
    $this->cursos = CursoPeer::DoSelect($c);
   }
}
