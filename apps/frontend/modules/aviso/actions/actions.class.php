<?php

/**
 * avisos actions.
 *
 * @package    edoceo
 * @subpackage aviso
 * @author     Todor Blajev
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class avisoActions extends sfActions
{
  /**
   * Executes default
   *
   */
  public function executeDefault()
  {

  }

  /**
   * Executes mostrar Avisos
   *
   */
  public function executeMostrarAvisos()
  {
      $this->avisos = $this->getUser()->getAvisos();
  }

}
