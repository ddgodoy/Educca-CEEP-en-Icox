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
}