<?php

/**
 * Subclass for representing a row from the 'curso' table.
 * @package lib.model
 */
class Curso extends BaseCurso
{
    // Nombre del metodo: getTotalCursos()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve el numero de cursos totales que hay en la base de datos
     */
  public function truncate_text($text, $length = 30, $truncate_string = '...', $truncate_lastspace = false)
  {
    if ($text == '')
    {
      return '';
    }

    $mbstring = extension_loaded('mbstring');
    if($mbstring)
    {
     @mb_internal_encoding(mb_detect_encoding($text));
    }
    $strlen = ($mbstring) ? 'mb_strlen' : 'strlen';
    $substr = ($mbstring) ? 'mb_substr' : 'substr';

    if ($strlen($text) > $length)
    {
      $truncate_text = $substr($text, 0, $length - $strlen($truncate_string));
      if ($truncate_lastspace)
      {
        $truncate_text = preg_replace('/\s+?(\S+)?$/', '', $truncate_text);
      }

      return $truncate_text.$truncate_string;
    }
    else
    {
      return $text;
    }
  }
//
    public function getNombre($long=null)
    {
     	if($long==null)
     	{
     	  return parent::getNombre();
      }
      else return $this->truncate_text($this->getNombre(),$long);
    }
//
   public function getTotalCursos()
    {
     	$c2 = new Criteria();
      return CursoPeer::doCount($c2);
    }

    // Nombre del metodo: getTotalCursos()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve los cursos totales que hay en la base de datos
     */
   public function getCursos()
   {
     	$c2 = new Criteria();
      return CursoPeer::doSelect($c2);
   }

    // Nombre del metodo: getNumeroAlumnos()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve el numero de alumnos en el curso
     */
   public function getNumeroAlumnos($crit = null)
    {
      $c = new Criteria();
      $c->add(RolPeer::NOMBRE, "alumno");
      $rol = RolPeer::doSelectOne($c);
      $id_rol = $rol->getId();

      if (null != $crit) {
     	    $c2 = clone $crit;
     	}else $c2 = new Criteria();

     	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
     	$c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->id);
     	return Rel_usuario_rol_cursoPeer::doCount($c2);
     	}

    // Nombre del metodo: getNumeroProfesores()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve el numero de alumnos en el curso
     */
   public function getNumeroProfesores($crit = null)
    {
      $c = new Criteria();
      $c->add(RolPeer::NOMBRE, "profesor");
      $rol = RolPeer::doSelectOne($c);
      $id_rol = $rol->getId();

      if (null != $crit) {
     	    $c2 = clone $crit;
     	}else $c2 = new Criteria();

     	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
     	$c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->id);
     	return Rel_usuario_rol_cursoPeer::doCount($c2);
     	}

    // Nombre del metodo: getAlumnos()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve los alumnos en el curso
     */
   public function getAlumnos($crit = null)
    {
      $c = new Criteria();
      $c->add(RolPeer::NOMBRE, "alumno");
      $rol = RolPeer::doSelectOne($c);
      $id_rol = $rol->getId();

      if (null != $crit) {
     	    $c2 = clone $crit;
     	}else $c2 = new Criteria();

     	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
     	$c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->id);
     	return Rel_usuario_rol_cursoPeer::doSelect($c2);
     	}

    // Nombre del metodo: getProfesores()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve los profesores en el curso
     */
   public function getProfesores($crit = null)
    {
      $c = new Criteria();
      $c->add(RolPeer::NOMBRE, "profesor");
      $rol = RolPeer::doSelectOne($c);
      $id_rol = $rol->getId();

      if (null != $crit) {
     	    $c2 = clone $crit;
     	}else $c2 = new Criteria();

     	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
     	$c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->id);
     	return Rel_usuario_rol_cursoPeer::doSelect($c2);
     	}

     /**
     *
     * @name         esProfesor($curso)
     * @access       public
     * @author       Jacobo Chaquet
     * @deprecated   Devuelve true si el usuario es profesor en el curso
     */
  public function esProfesor($id_usuario=null)
  {
     	$c = new Criteria();
    	$c->add(RolPeer::NOMBRE, "profesor");
    	$rol = RolPeer::doSelectOne($c);
    	$id_rol = $rol->getId();

    	$c2 = new Criteria();
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario);
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
  	  $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->id);

      $profesor = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
		if ($profesor)
		     {return true ;}
		else return false;
  }

    // Nombre del metodo: getTemas()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve los Temas del curso
     */
   public function getTemas($crit = null)
     {
       if (null != $crit)
       {
     	    $c2 = clone $crit;
     	 }else $c2 = new Criteria();

       $materia = MateriaPeer::retrieveByPk($this->materia_id);
       return $materia->getTemasMateria($c2);
     	}

    // Nombre del metodo: getHitosPlanificacion()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve la planificacion de los temas en un curso (Usado para el modulo de seguimiento, grafica de Hitos)
     */
   public function getHitosPlanificacion($crit = null)
     {
       if (null != $crit) {
     	    $c2 = clone $crit;
     	 }else $c2 = new Criteria();

      $c2->add(Rel_curso_temaPeer::ID_CURSO, $this->id);
     	return Rel_curso_temaPeer::doSelect($c2);

     	}

    // Nombre del metodo: vacio()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: comprueba que un curso esta limpio, esto es:
                    - sin alumnos
                    - sin profesores
                    - no esta en ningun modulo
     */
   public function vacio()
   {
     if (0!=$this->getNumeroAlumnos())
     {
        return false;
     }
     if (0!=$this->getNumeroProfesores())
     {
        return false;
     }
     if ($this->getEnModulo())
     {
       return false;
     }
     return true;
   }

    // Nombre del metodo: borrarUsuario($id)
    // Añadida por: Jacobo Chaquet
    /* Descripcion: elimina usuario matriculados en el curso (Rel_usuario_rol_curso)
     */
   public function borrarUsuario($id_usuario)
     {
       $c2 = new Criteria();
    	 $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario);
  	   $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->id);
  	   $usuario = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
  	   if ($usuario)
       {
  	     $usuario->delete();
  	   }
     }

    // Nombre del metodo: eliminarAlumnos($con=null)
    // Añadida por: Jacobo Chaquet
    /* Descripcion: elimina alumnos matriculados en el curso (Rel_usuario_rol_curso)
     */
   public function eliminarAlumnos($con=null)
     {
        $alumnos = $this->getAlumnos(); //Rel_usuario_rol_curso
        foreach($alumnos as $alumno)
        {
          $alumno->delete($con)  ;
        }
		    return;
     }

    // Nombre del metodo: eliminarProfesores($con=null)
    // Añadida por: Jacobo Chaquet
    /* Descripcion: elimina los profesores matriculados en el curso (Rel_usuario_rol_curso)
     */
   public function eliminarProfesores($con=null)
     {
        $profesores = $this->getProfesores(); //Rel_usuario_rol_curso
        foreach($profesores as $profesor)
        {
            $profesor->delete($con)  ;
        }
		    return;
     }

    // Nombre del metodo: eliminarDeModulo($con=null)
    // Añadida por: Jacobo Chaquet
    /* Descripcion: elimina los profesores matriculados en el curso (Rel_paquete_cursoPeer)
     */
   public function eliminarDeModulo($con=null,$actualizarModulo)
     {
        $modulos = $this->getEnModulo(); //Rel_paquete_cursoPeer
        foreach($modulos as $rel_modulo)
        {
            //echo $modulo->getPaquete()->getNombre();
            $modulo = PaquetePeer::retrieveByPk($rel_modulo->getPaquete()->getId());
            $rel_modulo->delete($con)  ;
            if ($actualizarModulo)
            {
              $modulo->actualiza($con);
            }

        }
		    return;
     }
//
    public function eliminarBibliotecaArchivos($con=null)
    {
      
      $archivos = $this->getBiblioteca_archivoss();
      foreach ($archivos as $archivo)
      {
        $archivo->customDelete();
      }
      
      $dir_raiz = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'biblioteca_archivos';
      $carpeta = $dir_raiz.DIRECTORY_SEPARATOR.$this->getId();
      
      if (file_exists($carpeta))
      { rmdir ($carpeta);}
      
    }

    // Nombre del metodo: geteliminarAll()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: elimina todo lo referente a un curso
                    - alumnos matriculados en el
                    - profesores
                    - Si pertenece algun modulo elimina el curso y actualiza el curso
     */
   public function eliminarAll($actualizarModulo=true)
     {
         $con = Propel::getConnection();

         	try
  				{
      			 $con->begin();
             $this->eliminarAlumnos($con);
             $this->eliminarProfesores($con);
             $this->eliminarDeModulo($con,$actualizarModulo);
             $this->eliminarBibliotecaArchivos($con);
             $this->delete($con);
      			 $con->commit();
  				}
  			catch (Exception $e)
  				{	$con->rollback();
    				throw $e;
  				}

		    return;
     }

    // Nombre del metodo: EliminarEjerciciosResueltos($id_usuario)
    // Añadida por: Jacobo Chaquet
    /* Descripcion: elimina los ejercicios Resueltos como autor de usuario
     */
   public function EliminarEjerciciosResueltos($id_usuario)
   {
       $c2 = new Criteria();
    	 $c2->add(Ejercicio_resueltoPeer::ID_AUTOR, $id_usuario);
  	   $c2->add(Ejercicio_resueltoPeer::ID_CURSO, $this->id);
  	   $ejercicios = Ejercicio_resueltoPeer::doSelect($c2);

  	   foreach ($ejercicios as $ejercio)
  	   {
  	     $ejercio->delete();
  	   }
   }

    // Nombre del metodo: getModulo()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve el/los nombre/s del modulo al que pertenece dicho curso por un usuario que le pasamos como parametro
     */
   public function getModulo($idusuario)
     {
      $c2 = new Criteria();
      $c2->add(Rel_usuario_paquetePeer::ID_USUARIO, $idusuario);
      $c2->addJoin(Rel_usuario_paquetePeer::ID_PAQUETE,Rel_paquete_cursoPeer::ID_PAQUETE);
      $c2->add(Rel_paquete_cursoPeer::ID_CURSO,$this->id);
      return Rel_usuario_paquetePeer::doSelect($c2);
     }

    // Nombre del metodo: getEnModulo($crit = null)
    // Añadida por: Jacobo Chaquet
    /* Descripcion: Devuelve los modulos/paquetes donde esta al qpertenece el curso
     */
   public function getEnModulo($crit = null)
     {
       if (null != $crit) {
     	    $c2 = clone $crit;
     	 }else $c2 = new Criteria();

      $c2->add(Rel_paquete_cursoPeer::ID_CURSO,$this->id);
      return Rel_paquete_cursoPeer::doSelect($c2);
     }

    // Nombre del metodo: esModulo()
    // Añadida por: Jacobo Chaquet
    /* Descripcion: indica si un usuario es moroso en el curso
     */
   public function esMoroso($idusuario)
     {

     $c = new Criteria();
     $c->add(RolPeer::NOMBRE, "moroso");
     $rol = RolPeer::doSelectOne($c);
     $id_rol = $rol->getId();

      $c2 = new Criteria();
      $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
      $c2->add(Rel_usuario_rol_cursoPeer::ID_ROL,$id_rol);
      $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$this->id);
      if (Rel_usuario_rol_cursoPeer::doSelect($c2)) {
      	return true;
      } else return false;
     }


    // Nombre del metodo: tieneAlumnos()
    // Autor: Jacobo Chaquet
    /* Descripciñn: indica si un curso tiene alumnos o esta vacio, necesario para saber si se puede borrar un curso
     */
   public function tieneAlumnos()
     {
      $c2 = new Criteria();
      $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->id);

      if (Rel_usuario_rol_cursoPeer::doSelect($c2)) {
      	return true;
      } else return false;
     }

   /********************************
    ** Alta de usuarios en curso ***
    ** Autor: Todor Todorov      ***
    *******************************/
   public function alta($idusuario,$tipo)
   {
      $c = new Criteria();
      $c->add(RolPeer::NOMBRE, $tipo);
      $rol = RolPeer::doSelectOne($c);
      $idrol = $rol->getId();

      $rel = new Rel_usuario_rol_curso();

      $con = Propel::getConnection();
  		try
  		{
        $con->begin();
        $rel->setIdCurso($this->getId());
        $rel->setIdRol($idrol);
        $rel->setIdUsuario($idusuario);
        $rel->save($con);

        $con->commit();
      }
  		catch (Exception $e)
  		{
        $con->rollback();
				throw $e;
  		}
  		return true;
   }

  // Nombre del metodo: numeroDudas($idcurso)
  // Añadida por: Jacobo Chaquet
  /* Descripcion: - devuelve un array con el numero de dudas
                    formato array:
                          dudas[0]= duda_teoria
                          dudas[1]= duda_ejercicio
                          dudas[2]= duda_planificacion
                          dudas[3]= tutoria
                          dudas[4]= otros
   */
   public function numeroDudas()
   {
      $c = new Criteria();
	    $c->add(Asunto_mensajePeer::NOMBRE, "duda_teoria");
  	  $id_r = Asunto_mensajePeer::doSelectOne($c);
    	$id_asunto= $id_r ->getId();

      $c2 = new Criteria();
      $c2->add(MensajePeer::ID_ASUNTO, $id_asunto);
      $c2->add(MensajePeer::ID_CURSO, $this->id);
      $c2->add(MensajePeer::ID_DESTINATARIO,NULL, Criteria::EQUAL  ); //para que solo coja el original y no los mensajes de la lista de destinatarios
      $dudasTeoria = MensajePeer::doSelect($c2);
      $dudas[0] = count($dudasTeoria);

      $c = new Criteria();
  	  $c->add(Asunto_mensajePeer::NOMBRE, "duda_ejercicio");
  	  $id_r = Asunto_mensajePeer::doSelectOne($c);
    	$id_asunto= $id_r ->getId();

      $c2 = new Criteria();
      $c2->add(MensajePeer::ID_ASUNTO, $id_asunto);
      $c2->add(MensajePeer::ID_CURSO, $this->id);
      $c2->add(MensajePeer::ID_DESTINATARIO,NULL, Criteria::EQUAL  );
      $dudasEjercicio = MensajePeer::doSelect($c2);
      $dudas[1] = count($dudasEjercicio);

      $c = new Criteria();
  	  $c->add(Asunto_mensajePeer::NOMBRE, "duda_planificacion");
  	  $id_r = Asunto_mensajePeer::doSelectOne($c);
    	$id_asunto= $id_r ->getId();
      $c2 = new Criteria();
      $c2->add(MensajePeer::ID_ASUNTO, $id_asunto);
      $c2->add(MensajePeer::ID_CURSO, $this->id);
      $c2->add(MensajePeer::ID_DESTINATARIO,NULL, Criteria::EQUAL  );
      $dudasPlanificacion = MensajePeer::doSelect($c2);
      $dudas[2] = count($dudasPlanificacion);

      $c = new Criteria();
  	  $c->add(Asunto_mensajePeer::NOMBRE, "tutoria");
  	  $id_r = Asunto_mensajePeer::doSelectOne($c);
    	$id_asunto= $id_r ->getId();
      $c2 = new Criteria();
      $c2->add(MensajePeer::ID_ASUNTO, $id_asunto);
      $c2->add(MensajePeer::ID_CURSO, $this->id);
      $c2->add(MensajePeer::ID_DESTINATARIO,NULL, Criteria::EQUAL  );
      $dudasTutoria = MensajePeer::doSelect($c2);
      $dudas[3] = count($dudasTutoria);

      $c = new Criteria();
  	  $c->add(Asunto_mensajePeer::NOMBRE, "otros");
  	  $id_r = Asunto_mensajePeer::doSelectOne($c);
    	$id_asunto= $id_r ->getId();

      $c2 = new Criteria();
      $c2->add(MensajePeer::ID_ASUNTO, $id_asunto);
      $c2->add(MensajePeer::ID_CURSO, $this->id);
      $c2->add(MensajePeer::ID_DESTINATARIO,NULL, Criteria::EQUAL  );
      $dudasOtros = MensajePeer::doSelect($c2);
      $dudas[4] = count($dudasOtros);

      return $dudas;
   }

 /**
 *
 * @name         getUsuarioOnline()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve los usuarios del curso que estan conectados si se le passa es el id  del usuario este no aparecera
 */
  public function getUsuarioOnline($idUsuario=null)
  {
    $c = new Criteria();
    $c->add(Usuarios_onlinePeer::ID_CURSO, $this->id);
    $c->add(Usuarios_onlinePeer::TIEMPO, time()-(3), Criteria::GREATER_THAN); //este tiempo tiene qser mayor qel puesto en /online/javascript_periodico

    $usuarios= Usuarios_onlinePeer::doSelect($c);

    return $usuarios;
  }

 /**
 *
 * @name         getUsuarioOnline()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve el num usuarios del curso que estan conectados
 */
  public function getNumUsuarioOnline()
  {
    $c = new Criteria();
    $c->add(Usuarios_onlinePeer::ID_CURSO, $this->id);
    $c->add(Usuarios_onlinePeer::TIEMPO, time()-(3), Criteria::GREATER_THAN); //este tiempo tiene qser mayor qel puesto en /online/javascript_periodico

    $usuarios= Usuarios_onlinePeer::doCount($c);

    return $usuarios;
  }
  
  /**
   * Verificar el acceso al curso segun sus fechas de inicio y final
   *
   * @param string $_fecha_inicio
   * @param string $_fecha_ending
   * @return string
   */
  public function checkAccesoSegunFechasLimite($_fecha_inicio, $_fecha_ending)
  {
  	$_tiene_acceso = 'si';
  	$_fecha_actual = date('Y-m-d');

  	if (!empty($_fecha_inicio)) {
			if ($_fecha_inicio > $_fecha_actual) { $_tiene_acceso = 'El curso no ha iniciado todav&iacute;a'; }
  	}
  	if (!empty($_fecha_ending)) {
			if (date('Y-m-d', strtotime("+15 days", strtotime($_fecha_ending))) < $_fecha_actual) { $_tiene_acceso = 'El curso ya se encuentra finalizado'; }
  	}
  	return $_tiene_acceso;
  }

} // end class