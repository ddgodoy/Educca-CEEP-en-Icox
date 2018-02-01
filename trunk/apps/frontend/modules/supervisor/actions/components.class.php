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
    $this->iPage      =$this->getRequestParameter('page',1);  
    $this->str_module = $this->getModuleName();
    $this->str_action = $this->getActionName();
    $this->index_url  = $this->str_module.'/'.$this->str_action;
    $this->head_link  = $this->index_url.'?page='.$this->iPage;
    
    $c = new Criteria();
    $c->add(CursoPeer::NOMBRE, 'vacio', Criteria::ALT_NOT_EQUAL);
    $c->addDescendingOrderByColumn(CursoPeer::FECHA_INICIO);
    //$this->cursos = CursoPeer::doSelect($c);
    $pager = new sfPropelPager('Curso',20); //nombre de la classepeer y numero de registro por pagina
    $pager->setCriteria($c);
    $pager->setPage($this->iPage);
    $pager->init();
    $this->cursos = $pager;
    return;
  }

  public function executeMostrarModulos()
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn(PaquetePeer::FECHA_INICIO);
    $this->modulos = PaquetePeer::doSelect($c);
    return;
  }

}
