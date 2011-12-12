<?php
/**
 * paquete actions.
 *
 * @package    edoceo
 * @subpackage paquete
 * @author     jacobo chaquet
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class paqueteActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }

  public function executeMostrarPaquete()
  {
    $id = $this->getRequestParameter('id');
    $this->paquete = PaquetePeer::retrieveByPk($id);

    if (!$this->paquete->perteneceUsuario($this->getUser()->getAnyId()))
    {
       $this->redirect('login/logout');
    }

    $c = new Criteria();
	  $c->add(Rel_paquete_cursoPeer::ID_PAQUETE, $id );
	  $this->paquete_cursos = Rel_paquete_cursoPeer::doSelect($c);
  }
}