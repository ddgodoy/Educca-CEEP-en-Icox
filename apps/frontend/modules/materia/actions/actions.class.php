<?php

/**
 * materia actions.
 *
 * @package    edoceo
 * @subpackage materia
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class materiaActions extends sfActions
{
  // Nombre del método: executeFichaMateria()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Muestra la informacion de una materia
   */
  public function executeFichaMateria()
  {
      $idmateria = $this->getRequestParameter('idmateria');
	    $this->materia = MateriaPeer::retrieveByPk($idmateria);
	    $this->forward404Unless($this->materia);

       $c2 = new Criteria();
       $c2->addAscendingOrderByColumn(TemaPeer::NUMERO_TEMA);
       $this->temas = $this->materia->getTemas($c2);

       $usuario = $this->getUser();
      $this->rol = $usuario->obtenerCredenciales();
  }
}