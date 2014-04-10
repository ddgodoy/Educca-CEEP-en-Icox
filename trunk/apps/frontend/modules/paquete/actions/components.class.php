<?php

 class paqueteComponents extends sfComponents
  {

  // Nombre del m�todo: executeFichaCurso()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Muestra la informacion de un modulo
   */
  public function executeFichaModulo()
  {
     if ($this->getRequestParameter('info'))
     {
        $this->info =  '0';
     }

     $idmodulo = $this->getRequestParameter('idmodulo');
	   $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
	   $this->cursos = $this->modulo->getRel_paquete_cursosJoinCurso();

	   $usuario = $this->getUser();
     $this->rol = $usuario->obtenerCredenciales();
  }

  // Nombre del m�todo: executeRanking()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Muestra el ranking
   */
  public function executeRanking()
  {
     $modulo = PaquetePeer::retrieveByPk($this->idmodulo);
	   $this->datos = $modulo->getRankingAlumnos();
	   $this->evaluacion = $modulo->getEvaluacion();
  }

  // Nombre del m�todo: executeListaAlumnos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Lista los alumnos de un curso determinado, si no se le pasa el id del curso muestra todos los alumnos
   */

  public function executeListaAlumnos()
  {
   $c = new Criteria();
   $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);

	 if (isset($this->idmodulo))
   { $idcurso = $this->idcurso;
     $idmodulo = $this->idmodulo;

     $this->curso = CursoPeer::retrieveByPk($idcurso);
     $this->modulo = PaquetePeer::retrieveByPk($idmodulo);

     $c->addJoin(UsuarioPeer::ID, Rel_usuario_paquetePeer::ID_USUARIO);
     $c->add(Rel_usuario_paquetePeer::ID_PAQUETE, $idmodulo);
     $this->alumnos = $this->modulo->getAlumnos($c);
    }
     else { $usuario = new Usuario();
            $this->alumnos = $usuario->getAlumnos(null,$c);
	        }

	 return;
  }
  
  public function executeSeguimientoModulo()
  {
     
    $idmodulo = $this->getRequestParameter('idmodulo');
    $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
    $this->cursos = $this->modulo->getRel_paquete_cursosJoinCurso();

    $c = new Criteria();
    $c->add(Rel_paquete_cursoPeer::ID_PAQUETE, $idmodulo);
    $c->addJoin(Rel_paquete_cursoPeer::ID_CURSO, CursoPeer::ID);
    $c->addJoin(TareaPeer::ID_CURSO, CursoPeer::ID);
    $c->add(EjercicioPeer::TIPO, 'test');
    $c->addJoin(TareaPeer::ID_EJERCICIO, EjercicioPeer::ID);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(Tipo_eventoPeer::ID, EventoPeer::ID_TIPO_EVENTO);
    $c->addAsColumn('id_tarea', TareaPeer::ID);                  // 0
    $c->addAsColumn('ejercicio', EventoPeer::DESCRIPCION);       // 1
    $c->addAsColumn('categoria', Tipo_eventoPeer::DESCRIPCION);  // 2
    $c->addAsColumn('fecha_fin', EventoPeer::FECHA_FIN);         // 3
    $c->addAsColumn('curso', CursoPeer::NOMBRE);                 // 4
    $this->relacion_tests = BasePeer::DoSelect($c);

    $c->add(EjercicioPeer::TIPO, 'cuestionario');
    $this->relacion_cuestionarios = BasePeer::DoSelect($c);

    $c->add(EjercicioPeer::TIPO, 'problemas');
    $this->relacion_problemas = BasePeer::DoSelect($c);
    
    $c = new Criteria();
    $c->add(Rel_usuario_paquetePeer::ID_PAQUETE, $idmodulo);
    $c->addJoin(Rel_usuario_paquetePeer::ID_USUARIO, UsuarioPeer::ID);
    $this->alumnos = UsuarioPeer::DoSelect($c);
    
    if($this->cursos){
        $array_cursos = array();

        foreach ($this->cursos as $curso){
             $array_cursos[] = (int)$curso->getCurso()->getId();
        }
        
        

        $c = new Criteria();
        $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $array_cursos,  Criteria::IN);
        $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
        $c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
        $c->add(RolPeer::NOMBRE, 'profesor');
        $c->addGroupByColumn(Rel_usuario_rol_cursoPeer::ID_USUARIO);
        $this->profesores = UsuarioPeer::doSelect($c);
        
    }
  }
}