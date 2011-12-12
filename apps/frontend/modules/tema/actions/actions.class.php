<?php
/**
 * tema actions.
 *
 * @package    edoceo
 * @subpackage tema
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class temaActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }

  // Nombre del método: executeFichaTema()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Muestra la informacion de un tema
   */
  public function executeFichaTema()
  {   $idtema = $this->getRequestParameter('idtema');
	    $this->tema = TemaPeer::retrieveByPk($idtema);
	    $this->forward404Unless($this->tema);
  }
}