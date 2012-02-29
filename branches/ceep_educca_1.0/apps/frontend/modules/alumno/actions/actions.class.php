<?php

/**
 * alumno actions.
 *
 * @package    edoceo
 * @subpackage alumno
 * @author     Jacobo Chaquet
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class alumnoActions extends sfActions
{
  public function executeIndex()
  {
       $this->getUser()->getAttributeHolder()->remove('idcurso','alumno');
       $this->user = $this->getUser();
        return ;
  }


 public function executeMisCursos()  /* desde su template se redirige al componente de cursos */
  {
      $this->getUser()->getAttributeHolder()->remove('idcurso','alumno');
      return ;
  }


 public function executeMostrarTemas() /* desde su template se redirige al componente de materia */
  {
     $this->id = $this->getRequestParameter('id');
     return ;
  }

 public function executeVerTemas() /* desde su template se redirige al componente de materia */
  {
     $this->id = $this->getRequestParameter('id');
     return ;
  }

  public function executeAltaCursos() /* desde su template se redirige al componente alta de curso para que el layout siga teniendo el aspecto de alumno */
  {
     return ;
  }
  
  public function executeMoroso() /* El alumno llega aqui si tiene cursos pendientes de pagar */
  {    
    $moroso = $this->getUser()->getAlumno();
    $this->cursosm = $moroso->getCursosMoroso();
  }

}
