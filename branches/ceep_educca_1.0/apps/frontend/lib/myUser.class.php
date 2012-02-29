<?php

class myUser extends sfBasicSecurityUser
{
   // Nombre del metodo: comprobarPermiso($curso)
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Comprueba que el usuario tiene permiso para ver contenidos, si no los tiene logout
   */
  public function comprobarPermiso($curso)
  {
    if (!$this->hasCredential('supervisor')) 
    {
      if(!$this->hasCredential('administrador'))
      {
          $usuario = UsuarioPeer::retrieveByPk($this->getAnyId());
          if (!$usuario)
          {
            $this->getContext()->getController()->forward('login','logout');
          }

          $permiso = $usuario->perteneceAcurso($curso);
          if (!$permiso)
          {
            $this->getContext()->getController()->forward('login','logout');
          }
      }
    }
  }


  // asignarCredenciales($rol)
  // Añadida por: Angel Martin Latasa
  // Descripcion: Asigna al usuario las variables de sesion correspondientes a su rol
  public function asignarCredenciales ($usuario, $rol)
  {

    $this->setAuthenticated(true);
    $this->clearCredentials();
    $this->getAttributeHolder()->clear();


    switch ($rol)
      {

        case 'profesor':
          $this->addCredential('profesor');
          $this->setAttribute('profesor_id', $usuario->getId(), 'profesor');
          $this->setAttribute('nombreusuario', $usuario->getNombreusuario(), 'profesor');

        break;


        case 'alumno':
          $this->addCredential('alumno');
          $this->setAttribute('alumno_id', $usuario->getId(), 'alumno');
          $this->setAttribute('nombreusuario', $usuario->getNombreusuario(), 'alumno');

        break;


        case 'moroso':
          $this->addCredential('moroso');
          $this->setAttribute('moroso_id', $usuario->getId(), 'moroso');
          $this->setAttribute('nombreusuario', $usuario->getNombreusuario(), 'moroso');
        break;


        case 'supervisor':
          $this->addCredential('supervisor');
          $this->addCredential('moderator');//foro
          $this->setAttribute('supervisor_id', $usuario->getId(), 'supervisor');
          $this->setAttribute('nombreusuario', $usuario->getNombreusuario(), 'supervisor');
        break;


        case 'administrador':
          $this->addCredential('administrador');
          $this->setAttribute('administrador_id', $usuario->getId(), 'administrador');
          $this->setAttribute('nombreusuario', $usuario->getNombreusuario(), 'administrador');
        break;

        default: break;

      }
  }


  public function signIn($usuario)
  {
    $c = new Criteria();
    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $usuario->getId());
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    $c->setDistinct();

    $nroles = RolPeer::DoCount($c);

    if ($nroles == 1)
    // Si el usuario solo tiene un rol, le asignamos los credenciales de ese rol
    {
      $rol = RolPeer::DoSelectOne($c);
      $this->asignarCredenciales($usuario, $rol->getNombre());
    }

    if ($nroles == 2)
    // Caso excepcional, si se tienen 2 roles y son alumno y moroso. Solo se cuenta como alumno
    {
      $c = new Criteria();
      $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $usuario->getId());
      $c->add(RolPeer::NOMBRE, 'moroso');
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

      $c2 = new Criteria();
      $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $usuario->getId());
      $c2->add(RolPeer::NOMBRE, 'alumno');
      $c2->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

      $n_cursos_moroso = Rel_usuario_rol_cursoPeer::DoCount($c);
      $n_cursos_alumno = Rel_usuario_rol_cursoPeer::DoCount($c2);

      if (($n_cursos_moroso) && ($n_cursos_alumno))
      {
        // Esto es para que no se meta en el siguiente if
        $nroles = 1;
        // Asignacion de credenciales de alumno
        $this->asignarCredenciales($usuario, 'alumno');
        $this->setAttribute('pendientes_pago', $n_cursos_moroso);
      }
    }

    if ($nroles > 1)
    // Si el usuario tiene mas de un rol le damos un credencial de 'seleccion'
    // para que pueda elegir con cual de sus roles va a entrar
    {
      $this->setAuthenticated(true);
      $this->clearCredentials();
      $this->getAttributeHolder()->clear();

      $this->addCredential('seleccion');
      $this->setAttribute('usuario_id', $usuario->getId(), 'seleccion');
    }

    if (!$nroles)
    {
      $this->setAuthenticated(true);
      $this->clearCredentials();
      $this->getAttributeHolder()->clear();
      $this->asignarCredenciales($usuario, 'moroso');
    }
  }


  public function signOut()
  { $this->getAttributeHolder()->clear();
    $this->setAuthenticated(false);
    $this->clearCredentials();
  }

  public function getAlumnoId()
  { return $this->getAttribute('alumno_id', '', 'alumno');
  }

  public function getProfesorId()
  {
    return $this->getAttribute('profesor_id', '', 'profesor');
  }

  public function getSupervisorId()
  {
    return $this->getAttribute('supervisor_id', '', 'supervisor');
  }

  public function getAdministradorId()
  {
    return $this->getAttribute('administrador_id', '', 'administrador');
  }

  public function getMorosoId()
  {
    return $this->getAttribute('moroso_id', '', 'moroso');
  }

  public function getCursos()
  {
    $usuario = $this->getAlumno();

    $cursos = $usuario->getRel_usuario_rol_cursosJoinCurso($criteria = null, $con = null);


    return $cursos;
  }

  public function getAvisos()
  {
    $usuario = UsuarioPeer::retrieveByPk($this->getAnyId());
    $c = new Criteria();
    $c->add(NotificacionPeer::ID_USUARIO, $usuario->getId());
    $notificaciones = NotificacionPeer::doSelect($c);

    return $notificaciones;
  }


  public function getCursosAlumno()
  {

    $usuarioId = $this->getAlumnoId();
    $usuario = $this->getAlumno();

    $c = new Criteria();
	  $c->add(RolPeer::NOMBRE, "alumno");
	  $id_r = RolPeer::doSelectOne($c);
  	$id_rol= $id_r ->getId();

    $criteria = new Criteria();
	  $criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    $cursos = $usuario->GetRel_usuario_rol_cursosJoinCurso($criteria, $con = null);

    return $cursos;
  }

  public function getCursosProfesor()
  {
    $user = $this->getProfesor();

    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "profesor");
    $roles_handler = RolPeer::doSelect($c);
    $role_handler = $roles_handler[0];
    $role_id = $role_handler->getId();

    $criteria = new Criteria();
    $criteria->add(Rel_usuario_rol_cursoPeer::ID_ROL, $role_id);

    $courses = $user->getRel_usuario_rol_cursosJoinCurso($criteria, $con = null);
    return $courses;
  }

  public function getAlumno()
  {
    return UsuarioPeer::retrieveByPk($this->getAlumnoId());
  }

  public function getSupervisor()
  {
    return UsuarioPeer::retrieveByPk($this->getSupervisorId());
  }

  public function getProfesor()
  {
    return UsuarioPeer::retrieveByPk($this->getProfesorId());
  }

  public function getAdministrador()
  {
    return UsuarioPeer::retrieveByPk($this->getAdministradorId());
  }

  public function getMoroso()
  {
    return UsuarioPeer::retrieveByPk($this->getMorosoId());
  }

  public function getNombreAlumno()
  {
    return $this->getAttribute('nombreusuario', '', 'alumno');
  }

  public function getNombreSupervisor()
  {
    return $this->getAttribute('nombreusuario', '', 'supervisor');
  }

  public function getNombreProfesor()
  {
    return $this->getAttribute('nombreusuario', '', 'profesor');
  }

  // Nombre del metodo: getAnyId()
  // Añadida por: Angel Martin Latasa
  // Descripcion: Busca el identificador (entre sus credenciales) del usuario
  // que esta conectado y lo devuelve (el identificador que tiene este usuario
  // en la base de datos)
  public function getAnyId()
  {
    if ($this->hasCredential('alumno')) {
      return $this->getAlumnoId();
    }
    if ($this->hasCredential('profesor')) {
      return $this->getProfesorId();
    }
    if ($this->hasCredential('supervisor')) {
      return $this->getSupervisorId();
    }

    if ($this->hasCredential('administrador')) {
      return $this->getAdministradorId();
    }
    if ($this->hasCredential('moroso')) {
      return $this->getMorosoId();
    }
    return null;
  }



  // Nombre del metodo: setCursoMenu()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: guardamos el curso en el que esta el usuario
  */
  public function setCursoMenu($id)
  {  $rol='';
     if ($this->hasCredential('alumno'))
     {
       $rol = 'alumno';
     } else {
              if ($this->hasCredential('profesor'))
              {
                $rol = 'profesor';
              }
            }
    $this->setAttribute('idcurso', $id, $rol );
  }

  // Nombre del metodo: getCursoMenu()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: devuelve el curso en el que esta el usuario
  */
  public function getCursoMenu()
  {  $rol= '';
     if ($this->hasCredential('alumno'))
     {
       $rol = 'alumno';
     } else {
              if ($this->hasCredential('profesor'))
              {
                $rol = 'profesor';
              }
            }
      return $this->getAttribute('idcurso', '', $rol );
  }

  // Nombre del metodo: deleteCursoMenu()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: borra el curso en el que esta el usuario sirve para menu
  */
  public function deleteCursoMenu()
  {  $rol='';
     if ($this->hasCredential('alumno'))
     {
       $rol = 'alumno';
     } else {
              if ($this->hasCredential('profesor'))
              {
                $rol = 'profesor';
              }
            }

    $this->getAttributeHolder()->remove('idcurso', $rol );
  }

  // Nombre del metodo: getPaqueteAlumno()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Devuelve los paquetes en los que esta matriculado un alumno
  */
  public function getPaquetesAlumno()
  {
    if ($this->hasCredential('alumno')) {
          $id = $this->getAnyId();
          $c = new Criteria();
          $c->add(Rel_usuario_paquetePeer::ID_USUARIO, $id);
          return Rel_usuario_paquetePeer::doSelect($c);
    }
  }

    // Nombre del metodo: getPaqueteAlumnoNoMoroso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Devuelve los paquetes en los que esta matriculado un alumno
  */
  public function getPaquetesAlumnoNoMoroso()
  {
    if ($this->hasCredential('alumno')) {
          $id = $this->getAnyId();
          $c = new Criteria();
          $c->add(Rel_usuario_paquetePeer::ID_USUARIO, $id);
          $rel_paquete_cursos = Rel_usuario_paquetePeer::doSelect($c);
          $paquetes = array();

           foreach($rel_paquete_cursos as $rel_paquete_curso){
	       			if (!$rel_paquete_curso->getPaquete()->esMoroso($this->getAnyId()) ) {
	       			  $paquetes[]=  $rel_paquete_curso ;   			}
	       			}
	      return $paquetes;

    }
  }


  // Nombre del metodo: getCursosAny()
  // Añadida por: Angel Martin Latasa
  // Descripcion: Devuelve la lista de cursos del usuario que esta conectado
  // sean cuales sean sus credenciales (la comprobacion es interna).
  public function getCursosAny()
  {
    if ($this->hasCredential('alumno')) {
      return $this->getCursosAlumno();
    }
    if ($this->hasCredential('profesor')) {
      return $this->getCursosProfesor();
    }
    if ($this->hasCredential('supervisor')) {
       $c = new Criteria();
       return Rel_usuario_rol_cursoPeer::doSelect($c);
    }
  }

  public function getAsignaturasAlumno()
  {
    return $this->getAttribute('asignaturas_alumno', '', 'alumno');
  }

  public function getAsignaturasProfesor()
  {
    return $this->getAttribute('asignaturas_profesor', '', 'profesor');
  }

  // Nombre del metodo: estaEnCurso($curso)
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Dado un $curso, devuelve true o false, si el usuario esta en un curso
                  el usuario puede ser profesor o alumno
  */
  public function estaEnCurso($curso)
  {
    $id = $this->getAnyId();

	$c2 = new Criteria();
    $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id);
    $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);

    $esta = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
    if ($esta) {
    	return true;
    } else return false;
  }

  // Nombre del metodo: esAlumnoCurso($curso)
  // Añadida por: Jacobo Chaquet
  /* Descripcion: - Metodo necesario para el foro
                  - Dado un $curso, devuelve true o false, si el usuario es alumno del curso
                    $curso no es el id de curso, si no el nombre qtb es unico (RAZON = pluggin de foro lo maneja asi)
  */
  public function esAlumnoCurso($curso)
  {
   $this->forum = sfSimpleForumForumPeer::retrieveByStrippedName($curso);

    if ($this->forum->getCursoId()) { //el foro pertenece a un curso
     	$cursoId = $this->forum->getCursoId();

     	$c = new Criteria();
    	$c->add(RolPeer::NOMBRE, "alumno");
    	$rol = RolPeer::doSelectOne($c);
    	$id_rol = $rol->getId();

    	$c2 = new Criteria();
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getAnyId());
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $cursoId);
    	$alumno = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
		if ($alumno)
		     {return true ;}
		else return false;
    }
	else { return false;    }
  }


  // Nombre del metodo: esProfesorCurso($curso)
  // Añadida por: Jacobo Chaquet
  /* Descripcion: - Metodo necesario para el foro
                  - Dado un $curso, devuelve true o false, si el usuario es profesor del curso
                    $curso no es el id de curso, si no el nombre qtb es unico (RAZON = pluggin de foro lo maneja asi)
  */
  public function esProfesorCurso($curso)
  {
   $this->forum = sfSimpleForumForumPeer::retrieveByStrippedName($curso);
   //$this->forward404Unless($this->forum);

    if ($this->forum->getCursoId()) { //el foro pertenece a un curso
     	$cursoId = $this->forum->getCursoId();

     	$c = new Criteria();
    	$c->add(RolPeer::NOMBRE, "profesor");
    	$rol = RolPeer::doSelectOne($c);
    	$id_rol = $rol->getId();

    	$c2 = new Criteria();
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getAnyId());
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $cursoId);
    	$profesor = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
		if ($profesor)
		     {return true ;}
		else return false;
    }
	else return false;
  }


  // Nombre del metodo: getAlumnosCurso($curso)
  // Añadida por: Angel Martin Latasa
  // Descripcion: Dado un $curso, devuelve una lista de los usuarios que son
  // alumnos de dicho curso. Si yo (el usuario que esta conectado) soy alumno
  // de dicho curso, no aparecera incluido en la lista. (Para alumno devuelve la
  // lista de los compañeros, para profesor de todos mis alumnos en ese curso)
  public function getAlumnosCurso($curso)
  {
    $id_usuario = $this->getAnyId();
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, 'alumno');
    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario, CRITERIA::NOT_EQUAL);
    $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $alumnos = UsuarioPeer::doSelect($c);
    return $alumnos;
  }

  // Nombre del metodo: getProfesoresCurso($curso)
  // Añadida por: Angel Martin Latasa
  // Descripcion: Dado un $curso, devuelve una lista de los usuarios que son
  // profesores de dicho curso. Si yo (el usuario que esta conectado) soy profesor
  // de dicho curso, no aparecera incluido en la lista. (Para alumno devuelve la
  // lista de los profesores, para profesor de los compañeros profesores)
  public function getProfesoresCurso($curso)
  {
    $id_usuario = $this->getAnyId();
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, 'profesor');
    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario, CRITERIA::NOT_EQUAL);
    $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $profesores = UsuarioPeer::doSelect($c);
    return $profesores;
  }


  // Nombre del metodo: getSupervisores()
  // Añadida por: Jacobo Chaquet
  // Descripcion: Devuelve una lista de los usuarios que son supervisores

  public function getSupervisores()
  {  	
    $id_usuario = $this->getAnyId();

    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, 'supervisor');
    $c->add(Rel_usuario_rol_cursoPeer::TRIPARTITA, 0);
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);

    $supervisores = UsuarioPeer::doSelect($c);

    return $supervisores;
  }

  // Nombre del metodo: getAdministradores()
  // Añadida por: Jacobo Chaquet
  // Descripcion: Devuelve una lista de los usuarios que son administradores

  public function getAdministradores()
  {
    $id_usuario = $this->getAnyId();
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, 'administrador');
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $administradores = UsuarioPeer::doSelect($c);

    return $administradores;
  }

  // Nombre del metodo: getMensajesRecibidosRolCursos($borrados)
  // Añadida por: Angel Martin Latasa
  // Descripcion: Devuelve la lista de los mensajes rebididos del usuario que
  // esta conectado y que estan asociados a los cursos para los que ese usuario
  // es alumno o profesor segun los credenciales que tenga en la sesion.
  // Si la variable $borrados es 0 (false) obtendremos la lista de mensajes
  // recibidos. Si es 1 (true) obtendremos la lista de mensajes recibidos que
  // han sido borrados (es decir, los que estan en la papelera)
  public function getMensajesRecibidosRolCursos($borrados,$noleidosPrimero=0)
  {

    $c = new Criteria();

    if ($this->hasCredential('alumno')) {
      $id = $this->getAlumnoId();
      $c->add(RolPeer::NOMBRE, 'alumno');
    }
    if ($this->hasCredential('profesor')) {
      $id = $this->getProfesorId();
      $c->add(RolPeer::NOMBRE, 'profesor');
    }
    if ($this->hasCredential('supervisor'))
    {
      $id = $this->getSupervisorId();
      $c->add(MensajePeer::ID_PROPIETARIO, $id);
      $c->add(MensajePeer::ID_DESTINATARIO, $id);
      $c->add(MensajePeer::BORRADO, $borrados);
      if ($noleidosPrimero)
      {
      	$c->addAscendingOrderByColumn(MensajePeer::LEIDO);
      }
      $c->addDescendingOrderByColumn(MensajePeer::CREATED_AT);
      $c->add(MensajePeer::SUPERVISOR, 1);
      $mensajes = MensajePeer::doSelect($c);
      return $mensajes;
    }else $c->add(MensajePeer::SUPERVISOR, 0);

    $c->add(MensajePeer::ID_PROPIETARIO, $id);
    $c->add(MensajePeer::ID_DESTINATARIO, $id);
    $c->add(MensajePeer::BORRADO, $borrados);
    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id);
    $c->addJoin(MensajePeer::ID_CURSO, Rel_usuario_rol_cursoPeer::ID_CURSO);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    if ($noleidosPrimero) {
    	$c->addAscendingOrderByColumn(MensajePeer::LEIDO);
    }
    $c->addDescendingOrderByColumn(MensajePeer::CREATED_AT);
    $mensajes = MensajePeer::doSelect($c);
    return $mensajes;
  }

  // Nombre del metodo: getMensajesRecibidosCurso($curso, $borrados)
  // Añadida por: Angel Martin Latasa
  // Descripcion: Devuelve la lista de los mensajes rebididos del usuario que
  // esta conectado y que estan asociados al curso que se pasa como parametro
  // Si la variable $borrados es 0 (false) obtendremos la lista de mensajes
  // recibidos. Si es 1 (true) obtendremos la lista de mensajes recibidos que
  // han sido borrados (es decir, los que estan en la papelera)
  public function getMensajesRecibidosCurso($curso, $borrados)
  {

    $c = new Criteria();

    $id = $this->getAnyId();

    $c->add(MensajePeer::ID_PROPIETARIO, $id);
    $c->add(MensajePeer::ID_DESTINATARIO, $id);
    $c->add(MensajePeer::ID_CURSO, $curso);
    $c->add(MensajePeer::BORRADO, $borrados);
    if ($this->hasCredential('supervisor'))
    { $c->add(MensajePeer::SUPERVISOR, 1);
    }else $c->add(MensajePeer::SUPERVISOR, 0);
    $c->addDescendingOrderByColumn(MensajePeer::CREATED_AT);

    $mensajes = MensajePeer::doSelect($c);
    return $mensajes;
  }

  // Nombre del metodo: getMensajesEnviadosRolCursos()
  // Añadida por: Angel Martin Latasa
  // Descripcion: Devuelve la lista de los mensajes enviados por el usuario que
  // esta conectado y que estan asociados a los cursos para los que ese usuario
  // es alumno o profesor segun los credenciales que tenga en la sesion.
  public function getMensajesEnviadosRolCursos()
  {

    $c = new Criteria();

    if ($this->hasCredential('alumno')) {
      $id = $this->getAlumnoId();
      $c->add(RolPeer::NOMBRE, 'alumno');
    }
    if ($this->hasCredential('profesor')) {
      $id = $this->getProfesorId();
      $c->add(RolPeer::NOMBRE, 'profesor');
    }
    if ($this->hasCredential('supervisor')) {
      $id = $this->getSupervisorId();
      $c->add(RolPeer::NOMBRE, 'supervisor');
    }

    $c->add(MensajePeer::ID_PROPIETARIO, $id);
    $c->add(MensajePeer::ID_EMISOR, $id);
    $c->add(MensajePeer::BORRADO, '0');
    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id);
    $c->addJoin(MensajePeer::ID_CURSO, Rel_usuario_rol_cursoPeer::ID_CURSO);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    $c->addDescendingOrderByColumn(MensajePeer::CREATED_AT);
    $mensajes = MensajePeer::doSelect($c);
    return $mensajes;
  }

  // Nombre del metodo: getMensajesEnviadosCurso($curso)
  // Añadida por: Angel Martin Latasa
  // Descripcion: Devuelve la lista de los mensajes enviados por el usuario que
  // esta conectado y que estan asociados al curso que se pasa como parametro
  public function getMensajesEnviadosCurso($curso)
  {

    $c = new Criteria();

    $id = $this->getAnyId();

    $c->add(MensajePeer::ID_PROPIETARIO, $id);
    $c->add(MensajePeer::ID_EMISOR, $id);
    $c->add(MensajePeer::ID_CURSO, $curso);
    $c->add(MensajePeer::BORRADO, '0');
    $c->addDescendingOrderByColumn(MensajePeer::CREATED_AT);

    $mensajes = MensajePeer::doSelect($c);
    return $mensajes;
  }

  // Nombre del metodo: getNumeroMensajesNuevos()
  // Añadida por: Angel Martin Latasa
  // Descripcion: Devuelve el numero de mensajes nuevos que tenemos
  public function getNumeroMensajesNuevos()
  {

    $c = new Criteria();

    if ($this->hasCredential('alumno')) {
      $id = $this->getAlumnoId();
      $c->add(RolPeer::NOMBRE, 'alumno');
    }
    if ($this->hasCredential('profesor')) {
      $id = $this->getProfesorId();
      $c->add(RolPeer::NOMBRE, 'profesor');
    }
    if ($this->hasCredential('supervisor')) {
      $id = $this->getSupervisorId();
      $c->add(RolPeer::NOMBRE, 'supervisor');
    }

    $c->add(MensajePeer::ID_PROPIETARIO, $id);
    $c->add(MensajePeer::ID_DESTINATARIO, $id);
    $c->add(MensajePeer::LEIDO, '0');
    $c->add(MensajePeer::BORRADO, '0');
    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id);
    $c->addJoin(MensajePeer::ID_CURSO, Rel_usuario_rol_cursoPeer::ID_CURSO);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    $numero = MensajePeer::doCount($c);
    return $numero;
  }

  // Nombre del metodo: getMateriasUsuario()
  // Añadida por: Angel Martin Latasa
  // Descripcion: Se obtienen las materias relacionadas a los cursos en los
  // que el usuario es profesor o alumno, segun el rol con el que esta conectado.
  public function getMateriasUsuario()
  {
    $c = new Criteria();

    if ($this->hasCredential('alumno')) {
      $id = $this->getAlumnoId();
      $c->add(RolPeer::NOMBRE, 'alumno');
    }
    if ($this->hasCredential('profesor')) {
      $id = $this->getProfesorId();
      $c->add(RolPeer::NOMBRE, 'profesor');
    }
    if ($this->hasCredential('supervisor')) {
      $id = $this->getSupervisorId();
      $c->add(RolPeer::NOMBRE, 'supervisor');
    }

    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);
    $c->addJoin(CursoPeer::MATERIA_ID, MateriaPeer::ID);
    $c->addGroupByColumn(MateriaPeer::ID);

    $materias = MateriaPeer::doSelect($c);
    return $materias;
  }

  // Nombre del metodo: getEjerciciosProfesor()
  // Añadida por: Angel Martin Latasa
  // Descripcion: Se obtienen los ejercicios que ha creado un profesor para
  // todas las materias que imparte
  public function getEjerciciosProfesor()
  {
    $c = new Criteria();

    $id = $this->getProfesorId();


    $ejercicios = EjercicioPeer::doSelect($c);
    return $ejercicios;
  }

  // Nombre del metodo: getEjerciciosProfesorMateria($materia)
  // Añadida por: Angel Martin Latasa
  // Descripcion: Se obtienen los ejercicios que ha creado un profesor para
  // todas las materias que imparte
  public function getEjerciciosProfesorMateria($materia)
  {
    $c = new Criteria();

    $id = $this->getProfesorId();

    $c->add(EjercicioPeer::ID_MATERIA, $materia);

    $ejercicios = EjercicioPeer::doSelect($c);
    return $ejercicios;
  }

  /*******************************************************************/
  /*  			FUNCIONALIDADES para CALENDARIO                      */
  /*******************************************************************/


   // Nombre del metodo:GetEventosPrivadosCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos privados de un usuario rn un curso de un mes desterminado
   */
  public function getEventosPrivadosCurso($curso,$fecha)
  {	$fecha = substr($fecha,0,7); /*de la fecha me quedo cn el año y el mes*/
    return $this->getEventosPrivadosFechaCurso($curso,$fecha);
  }

  // Nombre del metodo:GetEventosPublicosCurso($curso,$fecha)
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos publicos de un usuario para un curso
   */
  public function getEventosPublicosCurso($curso,$fecha)
  {  $fecha = substr($fecha,0,7); /*de la fecha me quedo cn el año y el mes*/
      return $this->getEventosPublicosFechaCurso($curso,$fecha);
  }

  // Nombre del metodo:GetEventosPrivadosFechaCurso($curso,$fecha)
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos privados de un usuario en un curso en una determinada fecha
                  este metodo al usar LIKE para las fechas servira tanto para fechas completas (2007-08-15) como para seleccion de
				  los eventos de un mes en concreto (2007-08) esta forma se usa en el metodo privado getEventosPrivados($fecha)
   */
  public function getEventosPrivadosFechaCurso($curso,$fecha)
  { $crit = new Criteria();
    $crit->add(EventoPeer::ID_CURSO, $curso);
    return $this->getEventosPrivadosFecha($fecha,$crit);
  }

  // Nombre del metodo:GetEventosPublicosFechaCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos publicos de un usuario para un curso  en una determinada fecha
  				  este metodo al usar LIKE para las fechas servira tanto para fechas completas (2007-08-15) como para seleccion de
				  los eventos de un mes en concreto (2007-08) esta forma se usa en el metodo privado getEventosPublicos($fecha)
   */

  public function getEventosPublicosFechaCurso($curso,$fecha)
  {
    return $this->getEventosPublicosFecha($fecha,$curso);
  }

 // Nombre del metodo:getEventosDiasProximos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos(publicos y privados) proximos en una fecha de un determinado curso
   */
  public function getEventosDiasProximosCurso($curso,$diasAntes,$diasDespues)
  {
   return $this->getEventosDiasProximos($diasAntes,$diasDespues,$curso);
  }

  // Nombre del metodo:getEventosDiasProximos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos(publicos y privados) proximos en una fecha

   */
  public function getEventosDiasProximos($diasAntes,$diasDespues,$curso=null)
  {
   $c = new sfEventCalendar('month', date("Y/m/d"));

   $dia=date("d");
   $mes=date("m");
   $anio=date("Y");
   $eventos = array();

   if (!$curso)
   {
     $eventos = $this->getEventosPrivadosFecha($anio."-".$mes."-".$dia);
     $eventos2 = $this->getEventosPublicosFecha($anio."-".$mes."-".$dia);
   }else{
          $eventos = $this->getEventosPrivadosFechaCurso($curso,$anio."-".$mes."-".$dia);
          $eventos2 = $this->getEventosPublicosFechaCurso($curso,$anio."-".$mes."-".$dia);
         }

   $eventos = array_merge($eventos, $eventos2);

   for($i=$diasDespues;$i>0;$i--)
      {
        $fecha = $c->getCalendar()->NextDay($dia, $mes, $anio, '%Y-%m-%d');
        $dia=substr($fecha,8,2);
   		  $mes=substr($fecha,5,2);
     		$anio=substr($fecha,0,4);
     		if (!$curso)
         {
      		$eventos2 = $this->getEventosPrivadosFecha($anio."-".$mes."-".$dia);
       		$eventos = array_merge($eventos, $eventos2);
       		$eventos2 = $this->getEventosPublicosFecha($anio."-".$mes."-".$dia);
     		 }else{
     		     		$eventos2 = $this->getEventosPrivadosFechaCurso($curso,$anio."-".$mes."-".$dia);
             		$eventos = array_merge($eventos, $eventos2);
       	      	$eventos2 = $this->getEventosPublicosFechaCurso($curso,$anio."-".$mes."-".$dia);
              }
     		$eventos = array_merge($eventos, $eventos2);
      }

    $dia=date("d");
    $mes=date("m");
    $anio=date("Y");
      for($i=$diasAntes;$i>0;$i--)
      {
        $fecha = $c->getCalendar()->PrevDay($dia, $mes, $anio, '%Y-%m-%d');
        $dia=substr($fecha,8,2);
     		$mes=substr($fecha,5,2);
     		$anio=substr($fecha,0,4);
     		if (!$curso)
        {
         		$eventos2 = $this->getEventosPrivadosFecha($anio."-".$mes."-".$dia);
         		$eventos = array_merge($eventos, $eventos2);
         		$eventos2 = $this->getEventosPublicosFecha($anio."-".$mes."-".$dia);
        }else {
                 		$eventos2 = $this->getEventosPrivadosFechaCurso($curso,$anio."-".$mes."-".$dia);
                		$eventos = array_merge($eventos, $eventos2);
                		$eventos2 = $this->getEventosPublicosFechaCurso($curso,$anio."-".$mes."-".$dia);

               }
     		$eventos = array_merge($eventos, $eventos2);
      }

   return $eventos;
  }

  // Nombre del metodo:quitaEventosRepetidos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: elimina los eventos repetidos de un array
   */
  public function quitaEventosRepetidos($eventos)
  {

    $repe = array();
    $eventosProximos = array();

   //Si un evento dura dos dias y esta dentro del rango de dias proximos que no aparezca dos veces
    foreach($eventos as $evento){//echo $evento->getId()."<br>";
      if (!isset($repe[$evento->getId()]))
      	  { $repe[$evento->getId()]= 1;
      	    $eventosProximos[]=$evento;
      	    }
     /* else { if ( ($evento->getFechaInicio()!=$evento->getFechaFin()) && ($repe[$evento->getId()]<2))
	           { $repe[$evento->getId()]++;
	             $evento->setTitulo($evento->getTitulo()." (FINALIZACION)"); // No modificamos la base de datos, solo modificamos para el template
                 $evento->setFechaInicio($evento->getFechaFin());
      	         $eventosProximos[]=$evento;
	           }
	        }*/
      }
  return $eventosProximos;

  }

    // Nombre del metodo:quitaEventosRepetidos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: elimina los eventos repetidos de un array
   */
  public function quitaEventosProximosRepetidos($eventos)
  {

    $repe = array();
    $eventosProximos = array();

   //Si un evento dura dos dias y esta dentro del rango de dias proximos que no aparezca dos veces
    foreach($eventos as $evento){//echo $evento->getId()."<br>";
      if (!isset($repe[$evento->getId()]))
      	  { $repe[$evento->getId()]= 1;
      	    $eventosProximos[]=$evento;
      	   }
      else { if ( ($evento->getFechaInicio("d-m-Y")!=$evento->getFechaFin("d-m-Y")) && ($repe[$evento->getId()]==1))
	           { $repe[$evento->getId()]++;
	             $evento->setTitulo($evento->getTitulo()." (FINALIZACION)"); // No modificamos la base de datos, solo modificamos para el template
               $evento->setFechaInicio($evento->getFechaFin());
      	       $eventosProximos[]=$evento;
	           }
	        }
      }
  return $eventosProximos;

  }

  // Nombre del metodo:GetEventosPrivados()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos privados de un usuario de un mes desterminado
   */
  public function getEventosPrivados($fecha)
  {	$fecha = substr($fecha,0,7); /*de la fecha me quedo cn el año y el mes*/
    return $this->getEventosPrivadosFecha($fecha);
  }

  // Nombre del metodo:GetEventosPublicos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos publicos de un usuario para todos sus cursos de un usuario de un mes desterminado
   */
  public function getEventosPublicos($fecha)
  {  $fecha = substr($fecha,0,7); /*de la fecha me quedo cn el año y el mes*/
      return $this->getEventosPublicosFecha($fecha);
  }

  // Nombre del metodo:GetEventosPrivadosFecha()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos privados (distintos de examen sorpresa) de un usuario en una determinada fecha
                  este metodo al usar LIKE para las fechas servira tanto para fechas completas (2007-08-15) como para seleccion de
				  los eventos de un mes en concreto (2007-08) esta forma se usa en el metodo privado getEventosPrivados($fecha)
   */
  public function getEventosPrivadosFecha($fecha, $c=null)
  {

    $crit = new Criteria();
    $crit->add(Tipo_eventoPeer::CLASE, "examensorpresa");
    $sorpresa = Tipo_eventoPeer::doSelectOne($crit);

    if (null != $c) {
   	    $crit = clone $c;
   	}else $crit = new Criteria();

    $crit->addJoin(Rel_usuario_eventoPeer::ID_EVENTO,EventoPeer::ID);
    $crit->add(Rel_usuario_eventoPeer::ID_USUARIO, $this->getAnyID());
    $crit->add(EventoPeer::PRIVADO,1 );

    $c1=  new Criteria();
    $criterion1 = $c1->getNewCriterion(EventoPeer::FECHA_INICIO, "%$fecha%", Criteria::LIKE);
    $criterion2 = $c1->getNewCriterion(EventoPeer::FECHA_FIN, "%$fecha%", Criteria::LIKE);

    $criterion1->addOr($criterion2);
    $crit->add($criterion1);
    $eventosPrivados = EventoPeer::doSelect($crit);

    $resul= array();
    foreach($eventosPrivados as $eventosPrivado )
    {
      if (!$this->hasCredential('profesor'))
      {
          if ($sorpresa->getId()!=$eventosPrivado->getIdTipoEvento())
          {
            $resul[]=  $eventosPrivado;
          }
      }else { if ($eventosPrivado->getCurso())
              {
                    if ($eventosPrivado->getCurso()->esProfesor($this->getAnyId()))
                    {
                      $resul[]=  $eventosPrivado;
                    }
               }
               else $resul[]=  $eventosPrivado;
            }
    }


    return $resul;

  }

  // Nombre del metodo:GetEventosPublicosFecha()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: seleccion de los eventos publicos de un usuario para todos sus cursos en una determinada fecha
  				  este metodo al usar LIKE para las fechas servira tanto para fechas completas (2007-08-15) como para seleccion de
				  los eventos de un mes en concreto (2007-08) esta forma se usa en el metodo privado getEventosPublicos($fecha)
   */

  public function getEventosPublicosFecha($fecha,$curso = null)
  {
    $cursos_ids = array();
    if (!$curso)
    {
      $cursos =  $this->getCursosAny();
      foreach($cursos as $curso)
      {
        $cursos_ids[] = $curso->getIdCurso();
      }
    }else $cursos_ids[] = $curso;

    $crit = new Criteria();
    $crit->add(EventoPeer::PRIVADO,0 );

    $c1=  new Criteria();
    $criterion1 = $c1->getNewCriterion(EventoPeer::FECHA_INICIO, "%$fecha%", Criteria::LIKE);
    $criterion2 = $c1->getNewCriterion(EventoPeer::FECHA_FIN, "%$fecha%", Criteria::LIKE);

    $criterion1->addOr($criterion2);
    $crit->add($criterion1);
    $crit->add($criterion1);
    $crit->add(EventoPeer::ID_CURSO,$cursos_ids,Criteria::IN);

    return EventoPeer::doSelect($crit);

  }


// Nombre del metodo: setEventosCalendario()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: - inserta en el objeto sfEventCalendar los eventos privados y publicos de un determinado mes
  				  - devuelve $result
						$result[0] = objeto sfEventCalendar con los eventos
						$result[1] = arrayDeFechas para saber cuantos eventos tiene cada fecha (ej: $result[1][01/22/2006] = 2)
						$result[2] = array de cadenas de String que contiene la informacion necesarioa para el overLib
   */
  public function setEventosCalendario($fecha,$eventosPrivados,$eventosPublicos)
  {
  	// Initialize the event calendar with two parameters
	// 1.) The style of the calendar (day, week, month, year)
	// 2.) Any date within the specified time period. The script will automatically determine the best calendar days to return.
	//     For example, if you choose "month" and pass 1/15/2006, the calendar will return all dates and events from 01/01/2006 - 01/31/2006.
	//     If you choose "week" and pass 1/18/2006, the calender will return all dates and events from 01/16/2006 - 01/22/2006.
	$c = new sfEventCalendar('month', $fecha); // The style of the calendar, any date within the specified time period
    $longDescripcion = 150; //configuracion
	// Add an event to the calendar
	// You must enter a date for the calendar event.
	// You can enter as many options as you'd like that best fit your circumstances.
	// For example, i've passed a title, and url to the calendar.
	// You can pass these, or any number of parameters you'd like to associate with the event
	//$c->addEvent('28/8/2007', array('title' => 'Doctor Appointment', 'url' => '/module/action?id=1'));

    //$arrayFechas[]   para controlar si en un dia hay mas de un evento, no salga dos veces en el template el numero del dia

    $arrayFechas = array();
    $cadOverLib = array();

	foreach( $eventosPrivados as $evento){
	    $fechaEventoIni = $evento->getFechaInicio("d-m-Y");

	     if (null != $evento->getTipo_evento()){
	  		   	  $tipo = $evento->getTipo_evento()->getDescripcion();
				  $clase = $evento->getTipo_evento()->getClase();
					   }
	  		   else {if (null != $evento->getTipo_cita()){
	  		   	      $tipo = $evento->getTipo_cita()->getDescripcion();
	  		   	      $clase = $evento->getTipo_cita()->getClase();
						   }
					 else {$tipo ='otros';
					       $clase ='otros'; }
					 }
				if (null!=$evento->getCurso())
				      {$cadCurso = "<tr class=\\'tr2\\'><td>".$evento->getCurso()->getNombre()."</td></tr>";}
				else   $cadCurso = "";

				if (null!=$evento->getDescripcion())
				      {$descripcion = "<tr class=\\'tr3\\'><td>".substr($evento->getDescripcion(),0,$longDescripcion)."</td></tr>";}
				else   $descripcion = "";

	    if (!isset($arrayFechas[$fechaEventoIni])) {
	    	   $arrayFechas[$fechaEventoIni]=1;
			   $cadOverLib[$fechaEventoIni]="<table class=\\'toverlib\\'><tr class=\\'tr1\\'><td  class=\\'".$clase."\\'>".$tipo."</td></tr>".$cadCurso."".$descripcion."</table>";
			   $c->addEvent($fechaEventoIni, array('title' => '', 'url' => '/calendario/verEvento?fecha='.$evento->getFechaInicio("Y-m-d"),'fecha'=> $fechaEventoIni,'clase' => $clase ));
	    }
	    else {$arrayFechas[$fechaEventoIni]++;
	          $cadOverLib[$fechaEventoIni].="<br><table class=\\'toverlib\\'><tr class=\\'tr1\\'><td  class=\\'".$clase."\\'>".$tipo."</td></tr>".$cadCurso."".$descripcion."</table>";
	          //<hr><br><b>tipo:</b> ".$tipo."".$cadCurso."".$descripcion;
			  }

		 $fechaEventoFin = $evento->getFechaFin("d-m-Y");
		 if ($fechaEventoFin != $fechaEventoIni)
			     { if (!isset($arrayFechas[$fechaEventoFin])) {
	                    $arrayFechas[$fechaEventoFin]=1;
	                    $cadOverLib[$fechaEventoFin]="<table class=\\'toverlib\\'><tr class=\\'tr1\\'><td  class=\\'".$clase."\\'>(FINALIZACI&Oacute;N) ".$tipo."</td></tr>".$cadCurso."".$descripcion."</table>";
	              		$c->addEvent($fechaEventoFin, array('title' => '', 'url' => '/calendario/verEvento?fecha='.$evento->getFechaFin("Y-m-d"),'fecha'=> $fechaEventoFin,'clase' => $clase  ));
			       }
				   else {$arrayFechas[$fechaEventoFin]++;
				         $cadOverLib[$fechaEventoFin].="<br><table class=\\'toverlib\\'><tr class=\\'tr1\\'><td  class=\\'".$clase."\\'>(FINALIZACI&Oacute;N) ".$tipo."</td></tr>".$cadCurso."".$descripcion."</table>";
				         }
		}
	  }


	foreach( $eventosPublicos as $evento){
	    $fechaEventoIni = $evento->getFechaInicio("d-m-Y");

	    if (null!=$evento->getCurso())
			{$cadCurso = "<tr  class=\\'tr2\\'><td>".$evento->getCurso()->getNombre()."</td></tr>";}
		else   $cadCurso = "";
		if (null!=$evento->getDescripcion())
				      {$descripcion = "<tr class=\\'tr3\\'><td>".substr($evento->getDescripcion(),0,$longDescripcion)."</td></tr>";}
		else   $descripcion = "";

	    if (!isset($arrayFechas[$fechaEventoIni])) {
	           //echo "entra IF1: ".$evento->getFechaInicio("d-m-Y")."<br>";
	    	   $arrayFechas[$fechaEventoIni]=1;
	    	   $cadOverLib[$fechaEventoIni]="<table class=\\'toverlib\\'><tr class=\\'tr1\\'><td  class=\\'".$evento->getTipo_evento()->getClase()."\\'>".$evento->getTipo_evento()->getDescripcion()."</td></tr>".$cadCurso."".$descripcion."</table>";
	    	   $c->addEvent($fechaEventoIni, array('title' => '', 'url' => '/calendario/verEvento?fecha='.$evento->getFechaInicio("Y-m-d"),'fecha'=> $fechaEventoIni, 'clase' => $evento->getTipo_evento()->getClase()  ));

	    }
	    else {$arrayFechas[$fechaEventoIni]++;
	    //echo "entra ELSE1: ".$evento->getFechaInicio("d-m-Y")."<br>";
	          $cadOverLib[$fechaEventoIni].="<br><table class=\\'toverlib\\'><tr class=\\'tr1\\'><td  class=\\'".$evento->getTipo_evento()->getClase()."\\'>".$evento->getTipo_evento()->getDescripcion()."</td></tr>".$cadCurso."".$descripcion."</table>";
			  }

       $fechaEventoFin = $evento->getFechaFin("d-m-Y");
	   if ($fechaEventoFin != $fechaEventoIni)
			     { if (!isset($arrayFechas[$fechaEventoFin])) {
			            //echo "entra IF2: ".$evento->getFechaFin("d-m-Y")."<br>";
	                    $arrayFechas[$fechaEventoFin]=1;
	                    $cadOverLib[$fechaEventoFin]="<table class=\\'toverlib\\'><tr class=\\'tr1\\'><td  class=\\'".$evento->getTipo_evento()->getClase()."\\'>(FINALIZACI&Oacute;N) ".$evento->getTipo_evento()->getDescripcion()."</td></tr>".$cadCurso."".$descripcion."</table>";
	                    $c->addEvent($fechaEventoFin, array('title' => '', 'url' => '/calendario/verEvento?fecha='.$evento->getFechaFin("Y-m-d"),'fecha'=> $fechaEventoFin,'clase' => $evento->getTipo_evento()->getClase()  ));
			       }
				   else {//echo "entra ELSE2: ".$evento->getFechaFin("d-m-Y")."<br>";
				         $arrayFechas[$fechaEventoFin]++;
				         $cadOverLib[$fechaEventoFin].="<br><table class=\\'toverlib\\'><tr class=\\'tr1\\'><td  class=\\'".$evento->getTipo_evento()->getClase()."\\'>(FINALIZACI&Oacute;N) ".$evento->getTipo_evento()->getDescripcion()."</td></tr>".$cadCurso."".$descripcion."</table>";}
				}
	}
    $result[0] = $c;
    $result[1] = $arrayFechas;
    $result[2] = $cadOverLib;
    return $result;


  }


  // Nombre del metodo:getDiasConfCalendario()
  // Añadida por: Jacobo Chaquet
  /* Descripcion:  - Devuelve los dias antes y despues que tiene configurado un usuario
                   - Devuelve un array
				            $result[0]=  diasAntes;
	 						$result[1]=  diasDespues;
   */

  public function getDiasConfCalendario($idcurso = null)
  {
    $this->diasAntes = 2;
    $this->diasDespues = 5; //valores por defecto

    if (null != $idcurso) { //calendario curso
    	$c2 = new Criteria();
        $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getAnyId() );
        $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $idcurso);
        $rel = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
        if ($rel) {
            if ($rel->getCalDiasAntes()) {
            	$this->diasAntes = $rel->getCalDiasAntes();            }
            if ($rel->getCalDiasDespues()) {
            	$this->diasDespues = $rel->getCalDiasDespues();            }
           }
    }
    else{ //calendario general
          $preferencias = Preferencia_usuarioPeer::retrieveByPk($this->getAnyId());
          if ($preferencias)
		     { $this->diasAntes = $preferencias->getCalDiasAntes();
               $this->diasDespues = $preferencias->getCalDiasDespues();
             }
	     }
	 $result[0]=  $this->diasAntes;
	 $result[1]=  $this->diasDespues;
	 return $result;

  }

 /********************************************************************/
  /*  			FIN FUNCIONALIDADES para CALENDARIO                  */
  /*******************************************************************/


  // Nombre del metodo: obtenerCredenciales()
  // Añadida por: Angel Martin Latasa
  // Descripcion: Devuelve el permiso que tiene el usuario
  public function obtenerCredenciales() {

    $resultado = '';
    if ($this->hasCredential('alumno')) {$resultado = 'alumno';}
    if ($this->hasCredential('profesor')) {$resultado = 'profesor';}
    if ($this->hasCredential('supervisor')) {$resultado = 'supervisor';}
    if ($this->hasCredential('administrador')) {$resultado = 'administrador';}
    if ($this->hasCredential('moroso')) {$resultado = 'moroso';}
    return $resultado;

  }

   // Nombre del metodo: getNumUsuariosConectados($idcurso)
  // Añadida por: Jacobo Chaquet
  // Descripcion: Devuelve el numero de usuarios conectados en un curso/modulo
  public function getNumUsuariosConectados($id_curso=null)
  {
     if (!$id_curso)
     {
        $id_curso=$this->getCursoMenu();
     }

     $tot = 0;
     if ($id_curso)
         { $curso = CursoPeer::retrieveByPk($id_curso);
           $modulos = $curso->getModulo($this->getAnyId());

           if ($modulos)
           { foreach ($modulos as $modulo)
             {
               $tot += $modulo->getPaquete()->getNumUsuarioOnline($this->getAnyId());
             }
           } else { $tot = $curso->getNumUsuarioOnline();    }
          }
      return $tot;
  }

}



