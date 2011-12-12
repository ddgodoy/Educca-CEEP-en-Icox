<?php

 class cursoComponents extends sfComponents
  {

  // Nombre del método: ListaCursosAlumno()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Devuelve los paquetes en los que esta matriculado un alumno, y los cursos que esta matriculado qno pertenezcan a un paquete
  */
  public function executeListaCursosAlumno()
  {
       $this->paquetes = $this->getUser()->getPaquetesAlumnoNoMoroso();
       $idusario = $this->getUser()->getAnyId();
       $cursosEnPaquete = array();
       foreach($this->paquetes as $paquete)
       {   $c = new Criteria();
		       $c->add(Rel_paquete_cursoPeer::ID_PAQUETE, $paquete->getPaquete()->getId() );
		       $rel_paquete_cursos = Rel_paquete_cursoPeer::doSelect($c);
		       foreach($rel_paquete_cursos as $rel_paquete_curso)
            {
	       			$cursosEnPaquete[]=  $rel_paquete_curso->getIdCurso();
            }

	    }

      $c = new Criteria();
  	  $c->add(RolPeer::NOMBRE, "alumno");
	    $id_rol = RolPeer::doSelectOne($c);

      $criteria = new Criteria();
	    $criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol->getId());
	    $criteria->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusario);
	    $criteria->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$cursosEnPaquete, Criteria::NOT_IN);
      $this->cursos = Rel_usuario_rol_cursoPeer::doSelect($criteria);

      return;
     }

  public function executeListaCursosProfesor()
  {
       $this->cursos = $this->getUser()->getCursosProfesor();
  }

  public function executeMostrarCursos()
  {
      $criteria = new Criteria();
	    $this->cursos = CursoPeer::doSelectJoinAll($criteria);
	    $this->paquetes = PaquetePeer::doSelect($criteria);
      return ;
   }


  // Nombre del método: executeFichaCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Muestra la informacion de un curso
   */


  public function executeFichaCurso()
  {
      if (!isset($this->info))
      {
        $this->info =  '0';
      }
      if (!isset($this->eliminar))
      {
        $this->eliminar =  '0';
      }

      if (!isset($this->idcurso))
      { echo "entra";
        $this->idcurso = $this->getRequestParameter('idcurso');
      }
	    $this->curso = CursoPeer::retrieveByPk($this->idcurso);

      $this->profesores = $this->curso->getProfesores();

      $c2 = new Criteria();
      $c2->addAscendingOrderByColumn(TemaPeer::ID);
      $this->temas = $this->curso->getMateria()->getTemas($c2);

      $usuario = $this->getUser();
      $this->rol = $usuario->obtenerCredenciales();
  }


}
