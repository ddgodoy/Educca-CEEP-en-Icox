<?php

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Nick Winfield <enquiries@superhaggis.com>
 * @version    SVN: $Id$
 */

// autoloading for plugin lib actions is broken as at symfony-1.0.2
require_once(sfConfig::get('sf_plugins_dir'). '/sfSimpleForumPlugin/modules/sfSimpleForum/lib/BasesfSimpleForumActions.class.php');

class sfSimpleForumActions extends BasesfSimpleForumActions
{

  // Nombre del método: executeNoEnCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Sirve por si un usuario intenta escribir o borrar en un foro en el que no esta inscrito, se le redirige a esta accion
  */

  public function executeNoEnCurso()
  { $this->forum = $this->getRequestParameter('forum_name');
  }

  // Nombre del método: executeForoCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripción: nos lleva directamente al foro de un curso
  */

  public function executeForoCurso()
  {
    $idcurso = $this->getRequestParameter('idcurso');


    $c = new Criteria();
  	$c->add(sfSimpleForumForumPeer::CURSO_ID, $idcurso);
	  $foroCurso = sfSimpleForumForumPeer::doSelectOne($c);
	  $this->forward404Unless($foroCurso);
	  $forum_name = $foroCurso->getStrippedName();
    $this->redirect('sfSimpleForum/forum?forum_name='.$forum_name);
  }





}

