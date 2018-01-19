<?php

/**
 * Subclass for representing a row from the 'usuario' table.
 *
 *
 *
 * @package lib.model
 */
require(sfConfig::get('sf_lib_dir')."/functions.php");

class Usuario extends BaseUsuario
{
	public function setPassword($password)
	{ //echo "baseUsuario ".$password."<br>";
	  $salt = md5(rand(100000, 999999).$this->getNombreusuario().$this->getEmail());
	  $this->setSalt($salt);
	  $this->setSha1Password(sha1($salt.$password));
	  $this->save();
	}

	public function __toString()
	{
	  return $this->getNombreusuario();
	}

  // Nombre del metodo: getTotalAlumnos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Devuelve el numero de alumnos totales que hay en la base de datos
   */
 public function getTotalAlumnos()
  {
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "alumno");
    $rol = RolPeer::doSelectOne($c);
    $id_rol = $rol->getId();

   	$c2 = new Criteria();
   	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
   	$c2->addGroupByColumn(Rel_usuario_rol_cursoPeer::ID_USUARIO);
    return Rel_usuario_rol_cursoPeer::doCount($c2);
  }


  /**
 *
 * @name        getTotalProfesores()
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  Devuelve el numero de profesores totales que hay en la base de datos
 */
 public function getTotalProfesores()
  {
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "profesor");
    $rol = RolPeer::doSelectOne($c);
    $id_rol = $rol->getId();

   	$c2 = new Criteria();
   	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
   	$c2->addGroupByColumn(Rel_usuario_rol_cursoPeer::ID_USUARIO);
    return Rel_usuario_rol_cursoPeer::doCount($c2);
  }


 /**
 *
 * @name        getAlumnos($curso =  null, $crit = null)
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  devuelve los alumnos. Si no se le pasan parametros devolvera todos los alumnos (alumno y/o moroso). Si se le pasa el curso devolvera los profesores del curso. Si se le pueden pasar valores SQL del tipo citeria
 */

 public function getAlumnos($curso =  null, $crit = null)
  {
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "alumno");
    $rol = RolPeer::doSelectOne($c);
    $id_rol = $rol->getId();

    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "moroso");
    $rol = RolPeer::doSelectOne($c);
    $id_rol2 = $rol->getId();

    $c = new Criteria();
   	$date1Criterion = $c->getNewCriterion(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    $date2Criterion = $c->getNewCriterion(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol2);
    $date1Criterion->addOr($date2Criterion);


    if (null != $crit) {
   	    $c2 = clone $crit;
   	}else $c2 = new Criteria();

   	$c2->add($date1Criterion);
   	$c2->addGroupByColumn(Rel_usuario_rol_cursoPeer::ID_USUARIO);

   	if (null != $curso) {
   	    $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);
   	}
    return Rel_usuario_rol_cursoPeer::doSelectJoinUsuario($c2);
  }

   /**
 *
 * @name        getSuperUsuarios($curso =  null, $crit = null)
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  devuelve los supersusuarios. Si no se le pasan parametros devolvera todos los superusuarios (administradores y supervisores) . Si se le pueden pasar valores SQL del tipo citeria
 */

 public function getSuperUsuarios($crit = null)
  {
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "administrador");
    $rol = RolPeer::doSelectOne($c);
    $id_rol = $rol->getId();

    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "supervisor");
    $rol = RolPeer::doSelectOne($c);
    $id_rol2 = $rol->getId();

    $c = new Criteria();
   	$date1Criterion = $c->getNewCriterion(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    $date2Criterion = $c->getNewCriterion(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol2);
    $date1Criterion->addOr($date2Criterion);


    if (null != $crit) {
   	    $c2 = clone $crit;
   	}else $c2 = new Criteria();

   	$c2->add($date1Criterion);
   	$c2->addGroupByColumn(Rel_usuario_rol_cursoPeer::ID_USUARIO);


    return Rel_usuario_rol_cursoPeer::doSelectJoinUsuario($c2);
  }

 /**
 *
 * @name        getProfesores($curso =  null, $crit = null)
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  devuelve los porfesores. Si no se le pasan parametros devolvera todos los profesores. Si se le pasa el curso devolvera los profesores del curso. Si se le pueden pasar valores SQL del tipo citeria
 */


 public function getProfesores($curso =  null, $crit = null)
  {
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "profesor");
    $rol = RolPeer::doSelectOne($c);
    $id_rol = $rol->getId();

    if (null != $crit) {
   	    $c2 = clone $crit;
   	}else $c2 = new Criteria();

   	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
   	$c2->addGroupByColumn(Rel_usuario_rol_cursoPeer::ID_USUARIO);
   	if (null != $curso) {
   	    $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);
   	}

    return Rel_usuario_rol_cursoPeer::doSelectJoinUsuario($c2);
  }


  /**
 *
 * @name        getHitos()
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  devuelve los hitos (comienzo / fin tema) de un usuario.
 *              Recibe:     1. el id del curso
                   	        2. fecha apartir de cuando se quieren ver los hitos  FORMATO: "d-m-Y"
                   	        3. fecha hasta cuando se quieren ver los hitos  FORMATO: "d-m-Y"
 */

 public function getHitos($idcurso,$fechaIni,$fechaFin)
  {

  $c = new sfEventCalendar('month', date("Y/m/d"));

  if ($fechaIni!=null) {
  		$dia=substr($fechaIni,0,2);
  		$mes=substr($fechaIni,3,2);
  		$anio=substr($fechaIni,6,4);
        $fecha = $anio."-".$mes."-".$dia; //formato sql

		if ($fechaFin==null) {
		    return null; }
        $diaFin=substr($fechaFin,0,2);
  		$mesFin=substr($fechaFin,3,2);
  		$anioFin=substr($fechaFin,6,4);
		$fechaFin = $anioFin."-".$mesFin."-".$diaFin; //formato sql

           $c = new Criteria();
   		   $date1Criterion = $c->getNewCriterion(Rel_usuario_temaPeer::FECHA_INICIO, $fecha, Criteria::GREATER_EQUAL);
           $date1Criterion->addAnd($c->getNewCriterion(Rel_usuario_temaPeer::FECHA_INICIO, $fechaFin, Criteria::LESS_EQUAL));

           $date2Criterion = $c->getNewCriterion(Rel_usuario_temaPeer::FECHA_COMPLETADO, $fecha, Criteria::GREATER_EQUAL);
           $date2Criterion->addAnd($c->getNewCriterion(Rel_usuario_temaPeer::FECHA_COMPLETADO, $fechaFin, Criteria::LESS_EQUAL));
           $date2Criterion->addAnd($c->getNewCriterion(Rel_usuario_temaPeer::ESTADO, 2)); //completado

         $date1Criterion->addOr($date2Criterion);
  }

  $curso = CursoPeer::retrieveByPk($idcurso);
  $temas = $curso->getTemas();

  $hitos = array();
  //echo "fechaIni:".$fecha."  fechaFin:".$fechaFin."<br>";

  foreach ($temas as $tema)
   { $crit = new Criteria();
     if ($fechaIni!=null)
	    {$crit->add($date1Criterion);}

     $crit->add(Rel_usuario_temaPeer::ID_USUARIO, $this->id );
     $crit->add(Rel_usuario_temaPeer::ID_TEMA, $tema->getId());
	 $hitos2 = Rel_usuario_temaPeer::doSelect($crit);
	 $hitos = array_merge($hitos, $hitos2);

   }

   return $hitos;
  }


 /**
 *
 * @name        getHitoTema()
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  devuelve el hito de ese tema (rel usuario_tema)
 */

 public function getHitoTema($idTema)
  {  $crit = new Criteria();
     $crit->add(Rel_usuario_temaPeer::ID_USUARIO, $this->id );
     $crit->add(Rel_usuario_temaPeer::ID_TEMA, $idTema);
	 return Rel_usuario_temaPeer::doSelectOne($crit);
}

  // Nombre del metodo: getSolucionEjercicio()
  // Añadida por: Angel Martin
  /* Descripcion: - devuelve la solucion que hizo el alumno del ejercicio con
   * identificador $id_ejercicio si llego a resolver dicho ejercicio
   */

  public function getSolucionEjercicio($id_ejercicio)
  {
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->getId());
    $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $id_ejercicio);
    return Ejercicio_resueltoPeer::DoSelectOne($c);
  }


 /**
 *
 * @name        getCursos()
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  Devuelve los cursos del usuario, tanto si es como profesor, alumno, moroso
 */
 public function getCursos()
  {
   	$c2 = new Criteria();
   	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->id);
    return Rel_usuario_rol_cursoPeer::doSelect($c2);
  }



 /**
 *
 * @name        getCursosProfesor()
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  Devuelve los cursos que el usuario es profesor
 */
 public function getCursosProfesor()
  {
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "profesor");
    $rol = RolPeer::doSelectOne($c);
    $id_rol = $rol->getId();

   	$c2 = new Criteria();
   	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
   	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->id);
        $c2->addDescendingOrderByColumn(CursoPeer::FECHA_INICIO);
    //return Rel_usuario_rol_cursoPeer::doSelect($c2);
    return Rel_usuario_rol_cursoPeer::doSelectJoinAll($c2);    
  }


 /**
 *
 * @name        getCursosAlumno()
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  Devuelve los cursos que el usuario es alumno
 */

 public function getCursosAlumno()
  {
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "alumno");
    $rol = RolPeer::doSelectOne($c);
    $id_rol = $rol->getId();

   	$c2 = new Criteria();
   	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
   	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->id);
    return Rel_usuario_rol_cursoPeer::doSelect($c2);

  }


 /**
 *
 * @name        getCursosMoroso()
 * @access      public
 * @author      Jacobo Chaquet
 * @deprecated  Devuelve los cursos que el usuario es moroso
 */

 public function getCursosMoroso()
  {
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, "moroso");
    $rol = RolPeer::doSelectOne($c);
    $id_rol = $rol->getId();

   	$c2 = new Criteria();
   	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
   	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->id);
    return Rel_usuario_rol_cursoPeer::doSelect($c2);
  }


 /**
 *
 * @name         esProfesor($curso)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve true si el usuario es profesor en el curso, si no se le pasa el curso devolvera TRUE si lo es en algun curso de la plataforma
 */

  public function esProfesor($curso=null)
  {
     	$c = new Criteria();
    	$c->add(RolPeer::NOMBRE, "profesor");
    	$rol = RolPeer::doSelectOne($c);
    	$id_rol = $rol->getId();

    	$c2 = new Criteria();
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    	if ($curso!=null) {
    	   $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);
    	}
    	$profesor = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
		if ($profesor)
		     {return true ;}
		else return false;
  }

 /**
 *
 * @name         esAlumno($curso)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve true si el usuario es alumno en el curso, si no se le pasa el curso devolvera TRUE si lo es en algun curso de la plataforma
 */
  public function esAlumno($curso=null)
  {
     	$c = new Criteria();
    	$c->add(RolPeer::NOMBRE, "alumno");
    	$rol = RolPeer::doSelectOne($c);
    	$id_rol = $rol->getId();

    	$c2 = new Criteria();
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    	if ($curso!=null) {
    	   $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);
    	}
    	$alumno = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
		if ($alumno)
		     {return true ;}
		else return false;
  }


 /**
 *
 * @name         esAdministrador($curso=null)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve TRUE si el usuario es administrador
 */

  public function esAdministrador($curso=null)
  {
     	$c = new Criteria();
    	$c->add(RolPeer::NOMBRE, "administrador");
    	$rol = RolPeer::doSelectOne($c);
    	$id_rol = $rol->getId();

    	$c2 = new Criteria();
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    	if ($curso!=null) {
    	   $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);
    	}
    	$administrador = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
		if ($administrador)
		     {return true ;}
		else return false;
  }

 /**
 *
 * @name         esSupervisor($curso=null)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve TRUE si el usuario es supervisor
 */

  public function esSupervisor($curso=null)
  {
     	$c = new Criteria();
    	$c->add(RolPeer::NOMBRE, "supervisor");
    	$rol = RolPeer::doSelectOne($c);
    	$id_rol = $rol->getId();

    	$c2 = new Criteria();
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    	if ($curso!=null) {
    	   $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);
    	}
    	$supervisor = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
		if ($supervisor)
		     {return true ;}
		else return false;
  }


 /**
 *
 * @name         esSupervisor($curso=null)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve TRUE si el usuario es supervisor
 */

  public function esMoroso($curso=null)
  {
     	$c = new Criteria();
    	$c->add(RolPeer::NOMBRE, "moroso");
    	$rol = RolPeer::doSelectOne($c);
    	$id_rol = $rol->getId();

    	$c2 = new Criteria();
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getId());
    	$c2->add(Rel_usuario_rol_cursoPeer::ID_ROL, $id_rol);
    	if ($curso!=null) {
    	   $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso);
    	}
    	$supervisor = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
		if ($supervisor)
		     {return true ;}
		else return false;
  }

 /**
 *
 * @name         perteneceAcurso($curso)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve TRUE si el usuario esta inscrito en el curso tanto si es profesor como si es alumno
 */
  public function perteneceAcurso($curso)
  {
     	if ($this->esAlumno($curso)) {
     	    return true ;
     	}else{ if ($this->esProfesor($curso)) {
     	         return true ;
                  }
             }
	return false;
  }


 /**
 *
 * @name         getPaquetes()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve los modulos en el que el usuario esta matriculado
 */
 public function getPaquetes()
  {

   	$c2 = new Criteria();
   	$c2->add(Rel_usuario_paquetePeer::ID_USUARIO, $this->id);
   	return Rel_usuario_paquetePeer::doSelect($c2);
  }


 /**
 *
 * @name         imparte($idcurso,$idtema)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve TRUE si es profesor del curso y el tema pertenece al curso
 */
 public function imparte($idcurso,$idtema)
  {
        if (!$this->esProfesor($idcurso)) {
        	return false;
        }

        $tema = TemaPeer::retrieveByPk($idtema);

        $c = new Criteria();
        $c->add(CursoPeer::ID,$idcurso);
        $cursosTema = $tema->getCursos($c);

        if ($cursosTema) {
        	return true;
        }else return false;
  }


  // Nombre del metodo: contarTests($id_curso)
  // Añadida por: Angel Martin Latasa
  // Descripcion: Cuenta el numero de ejercicios de test que ha realizado un alumno en un curso

  public function contarEjercicios($tipo_ejercicio, $id_curso)
  {
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->getId());
    $c->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, null, Criteria::NOT_EQUAL);
    $c->add(TareaPeer::ID_CURSO, $id_curso);
    $c->add(EjercicioPeer::TIPO, $tipo_ejercicio);
    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);
    $c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);
    $c->addJoin(EjercicioPeer::ID, Ejercicio_resueltoPeer::ID_EJERCICIO);
    return Rel_usuario_tareaPeer::DoCount($c);
  }


 /**
 *
 * @name         roles()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve un array indicando los roles que tiene el usuario (usado en aministracion gestion usuarios)
 */

  public function roles()
  {
    $rol['profesor'] = 0;
    $rol['alumno'] = 0;
    $rol['administrador'] = 0;
    $rol['supervisor'] = 0;
    $rol['moroso'] = 0;

    $c = new Criteria();
    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->id);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    $roles = RolPeer::DoSelect($c);

    foreach ($roles as $rolh) {
      $rol[$rolh->getNombre()] = 1;
    }
    return $rol;
  }

 /**
 *
 * @name         confirmar()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   pone el flag de confirmado a 1, si se le pasa un password lo cambiara
 */

  public function confirmar($pwd=null)
  {
    if ($pwd)
    {
      $this->setPassword($pwd);
    }
    $this->setConfirmado(1);
    $this->save();
    return;
  }

 /**
 *
 * @name         generarPassword()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   genera un password para el usuario
 */

  public function generarPassword()
  {
    $no_validos = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ö", "Ö", "ñ", "Ñ", "ç", "Ç");

    $nombre = strtolower(substr(str_replace($no_validos, "", $this->getNombre()),0,3));
    $apellidos = strtolower(substr(str_replace($no_validos, "", $this->getApellidos()),0,3));

    for ($i=0;$i<3;$i++)
    {
      if    ( (ord($nombre[$i])<97 ) || (ord($nombre[$i])> 122 ) )   //si el caracter no es de un caracter de 'a'  a  'z'
      {
         $nombre[$i]=rand(1,9);
      }
      if ($apellidos)
      {
         if    ( (ord($apellidos[$i])<97) || (ord($apellidos[$i])> 122 ) )   //si el caracter no es de un caracter de 'a'  a  'z'
          {
             $apellidos[$i]=rand(1,9);
          }

      }
    }

    $cad= $nombre.$apellidos;

    while(strlen($cad)<6)  // para que el pwd tenga la longitud minima
    {
      $cad.=rand(1,9);
    }
    return $cad.rand(100,999);
  }

 /**
 *
 * @name         porcentajeTeoriaSuperado($id_curso)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   devuelve el porcentaje de teoria superado (estado=terminado de los temas)
 */
  public function porcentajeTeoriaSuperado($id_curso)
  {   $curso = CursoPeer::retrieveByPk($id_curso);
     $temas = $curso->getTemas();
     $numtemas=0;
     $finalizados=0;
     foreach($temas as $tema)
     { $numtemas++;
       $c = new Criteria();
       $c->add(Rel_usuario_temaPeer::ID_USUARIO, $this->id);
       $c->add(Rel_usuario_temaPeer::ID_TEMA, $tema->getid());
       $c->add(Rel_usuario_temaPeer::ESTADO, 2);
       $rel = Rel_usuario_temaPeer::doSelect($c);
       if ($rel) { $finalizados++;  }
     }
     if ($numtemas>0) {
          return round(($finalizados / $numtemas)*100);
      } else return 0;

  }



 /**
 *
 * @name         tiempoTeoria($id_curso)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   devuelve el tiempo empleado en la teoria de un curso
 */

  public function tiempoTeoria($id_curso)
  {  $curso = CursoPeer::retrieveByPk($id_curso);
     $temas = $curso->getTemas();


     if ($curso->getMateria()->esCompo())
     {
        $tiempo = $this->tiempoTotalTeoriaScorm($curso->getMateriaId());
     }else{
             $tiempo=0;
             //tiempo dedicado a los temas
             foreach($temas as $tema)
             {
               $c = new Criteria();
               $c->add(Rel_usuario_temaPeer::ID_USUARIO, $this->id);
               $c->add(Rel_usuario_temaPeer::ID_TEMA, $tema->getId());
               $rel = Rel_usuario_temaPeer::doSelectOne($c);
               if ($rel)
               { $tiempo += $rel->getTiempo();
               }
             }
          }
     return $tiempo;
   }

 /**
 *
 * @name         tiempoEjercicios($id_curso)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   devuelve el tiempo empleado en los ejercicios de un curso
 */

  public function tiempoEjercicios($id_curso)
  {  $curso = CursoPeer::retrieveByPk($id_curso);
     $tareas = $curso->getTareas();

     $tiempo=0;
     foreach($tareas as $tarea)
     {
       $c = new Criteria();
       $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->id);
       $c->add(Rel_usuario_tareaPeer::ID_TAREA, $tarea->getId());
       $tareas_usuarios = Rel_usuario_tareaPeer::doSelect($c);

       foreach($tareas_usuarios as $tarea_usuario )
       {
         $c1 = new Criteria();
         $c1->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);
         $c1->add(Ejercicio_resueltoPeer::ID, $tarea_usuario->getIdEjercicioResuelto());
         $tareas_resueltas = Ejercicio_resueltoPeer::doSelect($c1);

         foreach($tareas_resueltas as $tarea_resuelta )
         {
           $tiempo += $tarea_resuelta->getTiempo();
         }
       }
     }
     return $tiempo;
   }

 /**
 *
 * @name         tiemposDedicados($id_curso)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   devuelve un array con los tiempos empleados en el curso
 *               - tiempos[0] = tiempo teoria
 *               - tiempos[1] = tiempo ejercicios
 *
 *  el tiempo dedicado al curso por el alumno. Incluye tiempos ejercicios y trabajos
 */
  public function tiemposDedicados($id_curso)
  {
     $tiempos[0]=$this->tiempoTeoria($id_curso);
     $tiempos[1]=$this->tiempoEjercicios($id_curso);
     return $tiempos;
  }


 /**
 *
 * @name         getTareasCorregidas($id_curso)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   devuelve las tareas corregidas del usuario para un curso determinado
 */

  public function getTareasCorregidas($id_curso)
  {
     $c = new Criteria();
     $c->add(TareaPeer::ID_CURSO, $id_curso);
     $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->id);
     $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);
     $c->addJoin(Rel_usuario_tareaPeer::ID_TAREA, TareaPeer::ID);
     $c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);
     return TareaPeer::DoSelect($c);
   }


 /**
 *
 * @name         getNotaTarea($id_tarea)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   devuelve las nota de una tarea
 */

  public function getNotaTarea($id_tarea)
  {
     $c = new Criteria();

     $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->id);
     $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
     $c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);
     $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);


     $ejercicio_resuelto = Ejercicio_resueltoPeer::DoSelectOne($c);
     if ($ejercicio_resuelto)
     {
       return $ejercicio_resuelto->getScore();
     }else return -1;


   }


 /**
 *
 * @name         getNotaTarea($id_tarea)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   devuelve la nota de un ejercicio, asumimos que si un usuario tiene dos veces el mismo ejercicio nos quedamos con la ultima nota (ultima correcion)
 *               si no ha entregado ningun ejercicio con ese id devolvera -1
 */
  public function getNotaEjercicio($idEjercicio)
  {
     $c = new Criteria();

     $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);
     $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $idEjercicio);
     $c->addDescendingOrderByColumn(Ejercicio_resueltoPeer::FECHA_CORRECCION);
     $ejercicio_resuelto = Ejercicio_resueltoPeer::DoSelectOne($c);

     if ($ejercicio_resuelto)
     {
        return $ejercicio_resuelto->getScore();
     }else return -1;

   }



  public function alta($parametros,$online=null) {
      $parametros = $parametros->getAll();
      $nombreusuario = $parametros["usuario"];
      $dni = $parametros["dni"];
      $nombre = $parametros["nombre"];
      $apellidos = $parametros["apellidos"];
      $email = $parametros["email"];
      $emailstop = $parametros["emailstop"];
      $telefono1 = $parametros["telefono"];
      $direccion = $parametros["direccion"];
      $cp = $parametros["cp"];
      $ciudad = $parametros["ciudad"];
      $pais = PaisPeer::retrieveByPk($parametros["pais"]);

      $con = Propel::getConnection();

  		try	{
  		     // Añadimos el usuario a la base de datos como NO confirmado
    			 $con->begin();
           $this->setConfirmado(0);
           $this->setNombreusuario($nombreusuario);
           $this->setDni($dni);
           $this->setNombre($nombre);
           $this->setApellidos($apellidos);
           $this->setEmail($email);
           $this->setEmailstop($emailstop);
           $this->setTelefono1($telefono1);
           $this->setDireccion($direccion);
           $this->setMatOnline(1);
           $this->setMatIp($_SERVER['REMOTE_ADDR']);
           $this->setCp($cp);
           $this->setCiudad($ciudad);
           $this->setPais($pais);
           if ($online)
           {
             $this->setPresencial(0);
           }else $this->setPresencial(1);


           $this->save($con);
    			 $con->commit();

           $idusuario = $this->getId();

           // Lo damos de alta en el curso o modulo que corresponda

          if (isset($parametros["idcurso"])) {
            $idcurso = $parametros["idcurso"];

            $curso = CursoPeer::retrieveByPk($idcurso);
            $curso->alta($idusuario,$rol='alumno');

            $idref = $curso->getId();

            $elem = 0; // Curso (para el email)

          } else if (isset($parametros["idmodulo"])) {
            $idmodulo = $parametros["idmodulo"];

            $modulo = PaquetePeer::retrieveByPk($idmodulo);
            $modulo->alta($idusuario);

            $idref = $modulo->getId();
            $elem = 1; // Modulo (para el email)
          }


           // Enviamos el email con instrucciones de pago


           $this->emailUsuario($idref,$elem,$tipo='alta');

           if ($online)
           {
            $s=sfContext::getInstance();
            $administradores= $s->getUser()->getAdministradores();
            foreach ($administradores as $administrador)
            {  $notifacacion = new Notificacion();
               $notifacacion->setInfo($administrador->getId(),null,'Matr&iacute;cula web',$this->getNombre().' '.$this->getApellidos(),date("Y-m-d H:j"),0);
            }
           }

           $con->commit();
      }
  		catch (Exception $e) {
         $con->rollback();
    	   throw $e;
  		}
  		return true;
  }

  /* Modificado por Jacobo Chaquet añadido parametro $datos para el tipo ranking, le pasamos el
     ranking ya en formato HTML a si no hay que volverlo a calcular para cada alumno
  */
  public function emailUsuario($idref,$elemento,$tipo,$datos=null)
  {

    $mail = new sfMail();

    $nombre = $this->getNombre();
    $apellidos = $this->getApellidos();

    $direccionde = sfConfig::get('app_empresa_email');
    $nombrede = sfConfig::get('app_lms_nombre');

    $direccionpara = $this->getEmail();
    $nombrepara = $this->getNombre().' '.$this->getApellidos();

    if ($elemento == 0)
    {   // Es referente a un curso
      $curso = CursoPeer::retrieveByPk($idref);
      $nombrecurso = htmlentities($curso->getNombre());
      $precio = $curso->getPrecio();
    } else {
             if ($elemento == 1)
             {    // Es referente a un modulo
               $modulo = PaquetePeer::retrieveByPk($idref);
               $nombrecurso = htmlentities($modulo->getNombre());
               $precio = $modulo->getPrecio();
             }
           }

    switch($tipo){
      case 'alta':
        $message = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
                      <html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
                      <head>
                      <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
                      </head>
                      <body>
                        Hola $nombre,<br/><br/>
                        Hemos recibido tu petici&oacute;n de matr&iacute;cula para el <strong>$nombrecurso</strong>.
                        Debes realizar el pago del importe del curso: <strong>$precio Euros</strong>, en un plazo de 4 d&iacute;as
                        para completar tu registro. Para ello puedes utilizar una de las siguientes formas de pago:<br/><br/>

                        - Transferencia bancaria con los siguientes datos:<br/><br/>

                        Titular: ".sfConfig::get('app_empresa_nombre')."<br/>
                        Cuenta: ".sfConfig::get('app_empresa_cuenta')."<br/>
                        Concepto: $nombrecurso<br/>
                        Importe: $precio Euros<br/><br/>

                        - Paypal o tarjeta de cr&eacute;dito:<br/><br/>

                        Pulsa en este enlace para pagar desde un servidor seguro.<br/><br/>

                        Una vez confirmado el pago, recibir&aacute;s en esta misma direcci&oacute;n tu nombre de usuario y
                        contrase&ntilde;a para entrar en la ".sfConfig::get('app_lms_nombre').". Recuerda que si no realizas el pago dentro de los
                        pr&oacute;ximos 4 d&iacute;as, tu registro ser&aacute; autom&aacute;ticamente borrado.<br/><br/>

                        Un cordial saludo,<br/><br/>

                        El equipo de ".sfConfig::get('app_lms_nombre')."
                      </body>
                    </html>";
          $asunto = "Bienvenido a la ".sfConfig::get('app_lms_nombre');
          //echo $message."<br>";
        break;
      case 'impago':
        $message = "<html><head></head><body></body></html>";
        $asunto = "Tu inscripci&oacute;n est&aacute; apunto de caducar";
        break;
      case 'confirmacion':
         $pwd = $this->generarPassword();
         $this->confirmar($pwd);
         $message = "<html><head></head><body>usuario: ".$this->getNombreusuario()."<br>Clave: ".$pwd."<br>
                       Un cordial saludo,<br/><br/>
                       El equipo de ".sfConfig::get('app_lms_nombre')."</body></html>";
         $asunto = "Clave de acceso";
         break;
      case 'pre-confirmacion':
         $pwd = $this->generarPassword();
         $this->setPassword($pwd);
         $this->save();
         $message = "<html><head></head><body> usuario:".$this->getNombreusuario()."<br>Clave:".$pwd."<br>
                       Un cordial saludo,<br/><br/>
                       El equipo de ".sfConfig::get('app_lms_nombre')."</body></html>";
         $asunto = "Clave de acceso";
         break;
       case 'ranking':
         $message = "<html><head></head><body>".$datos."</body></html>";
         $asunto = "Ranking $nombrecurso";
         break;
       case 'invitado':
         $message = "<html><head></head><body>".$datos."</body></html>";
         $asunto = "Peticion Prueba Educca";
         $direccionpara = sfConfig::get('app_empresa_email');
         break;
       case 'ayuda':
         $message = "<html><head></head><body>El usuario ".$this->getNombre().' '.$this->getApellidos().', ha enviado una solicitud de ayuda en la plataforma '.sfConfig::get('app_lms_nombre').'. Su petici&oacute;n se muestra a continuaci&oacute;n:<br /><br /><br />'.$datos."</body></html>";
         $asunto = "Solicitud de Ayuda en la plataforma";
         $direccionpara = sfConfig::get('app_empresa_email');
         break;

      default:
        ;
    } // switch

   /* $mail->setMailer('smtp');
    $mail->setPort('587');

    $mail->setHostname(sfConfig::get('app_empresa_serverEmail'));
    $mail->setUsername(sfConfig::get('app_empresa_userEmail'));
    $mail->setPassword(sfConfig::get('app_empresa_pwdEmail'));

    $mail->setSender($direccionde, $nombrede);
    $mail->setFrom($direccionde, $nombrede);
    $mail->addAddress($direccionpara, $nombrepara);
    $mail->setSubject($asunto);
    $mail->setContentType('text/html');
    $mail->setCharset('utf8');
    $mail->setBody($message);
    $mail->send();*/
    
    $mail->setMailer('smtp');
    $mail->setPort('587');

    $mail->setHostname('smtp.gmail.com');
    $mail->setUsername('coinyam.test@gmail.com');
    $mail->setPassword('coinyam515');
    //$mail->setEncoding('tls');

    //$mail->setSender($direccionde, $nombrede);
    $mail->setFrom('coinyam.test@gmail.com', $nombrede);
    $mail->addAddress('mauro@icox.com', $nombrepara);
    $mail->setSubject($asunto);
    $mail->setContentType('text/html');
    $mail->setCharset('utf8');
    $mail->setBody($message);
    $mail->send();
    //echo $message;

  }

 /**
 *
 * @name         actualizaOnline($idCurso)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   actualiza la tabla usuario_online con el tiempo actual, este metodo se invoca de manera periodica
 *               para tener saber todos los usuarios conectados. (Se invoca desde el layout principal)
 */
  public function actualizaOnline($idCurso)
  {
    $c = new Criteria();
    $c->add(Usuarios_onlinePeer::ID_USUARIO, $this->id);
    $c->add(Usuarios_onlinePeer::ID_CURSO, $idCurso);

    $usuario_online = Usuarios_onlinePeer::doSelectOne($c);

    if (!$usuario_online)
    {  $usuario_online = new Usuarios_online();
   		 $usuario_online->setIdUsuario(  $this->id );
       $usuario_online->setIdCurso(  $idCurso );

       if ($this->esProfesor($idCurso))
       {
         $rol='profesor';
       }else { if ($this->esAlumno($idCurso))
               {
                 $rol= 'alumno';
               }else return;
              }

        $c = new Criteria();
    	  $c->add(RolPeer::NOMBRE, $rol);
    	  $rol = RolPeer::doSelectOne($c);
    	  $id_rol = $rol->getId();

        $usuario_online->setIdRol(  $id_rol );
    }
    $usuario_online->setTiempo(time());
    $usuario_online->save();
   }

 /**
 *
 * @name         tiempoTotalTeoriaScorm($id_materia)
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   calcula el tiempo total para cusos composica
 */
  public function tiempoTotalTeoriaScorm($id_materia)
  {
    $c = new Criteria();
    $c->add(Sco12Peer::ID_MATERIA, $id_materia);
    $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $this->id);
    $c->addJoin(Sco12Peer::ID, Rel_usuario_sco12Peer::ID_SCO12);
    $rel = Rel_usuario_sco12Peer::DoSelect($c);

    if ($rel) {
    	$ttotal = 0;

    	foreach ($rel as $rel_value) {
    		$ttotal += traducir_de_fecha_scorm12($rel_value->getSessionTime()) + traducir_de_fecha_scorm12($rel_value->getTotalTime());
    	}
      return $ttotal;
    }
    else return 0;
  }

  /**
  *
  * @name         getTiempoTotalTeoria($id_curso)
  * @access       public
  * @author       Angel Martin
  * @deprecated   Devuelve el tiempo total invertido en la teoria de un curso EN SEGUNDOS (independientemente del tipo de materia)
  */
  public function getTiempoTotalTeoria($id_curso)
  {
    $curso = CursoPeer::RetrieveByPk($id_curso);
    $materia = MateriaPeer::RetrieveByPk($curso->getMateriaId());

    if (($materia->getTipo() == 'scorm1.2') || ($materia->getTipo() == 'compo'))
    // En el caso de materias de tipo SCORM
    {
      $c = new Criteria();

      $c->add(Sco12Peer::ID_MATERIA, $materia->getId());
      $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $this->id);
      $c->addJoin(Sco12Peer::ID, Rel_usuario_sco12Peer::ID_SCO12);
      $rel = Rel_usuario_sco12Peer::DoSelect($c);
      
      if ($rel) {
      	$ttotal = 0;

      	foreach ($rel as $rel_value) {
      		$ttotal += traducir_de_fecha_scorm12($rel_value->getSessionTime()) + traducir_de_fecha_scorm12($rel_value->getTotalTime());
      	}
        return $ttotal;
      }
      else return 0;
    }
    else
    // Para materias SEGMENTADAS
    {
      $c = new Criteria();
      $c->add(CursoPeer::ID, $id_curso);
      $c->add(Rel_usuario_temaPeer::ID_USUARIO, $this->id);
      $c->addJoin(TemaPeer::ID_MATERIA, CursoPeer::MATERIA_ID);
      $c->addJoin(TemaPeer::ID, Rel_usuario_temaPeer::ID_TEMA);
      $resultados = Rel_usuario_temaPeer::DoSelect($c);
      $tiempo_estudio = 0;
      foreach ($resultados as $resultado)
      {
        $tiempo_estudio += $resultado->getTiempo();
      }
      return $tiempo_estudio;
    }
  }


  /**
  *
  * @name         getTiempoTotalEjercicios($id_curso)
  * @access       public
  * @author       Angel Martin
  * @deprecated   Devuelve el tiempo total invertido en los ejercicios de un curso EN SEGUNDOS (independientemente del tipo de materia)
  */
  public function getTiempoTotalEjercicios($id_curso)
  {
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);
    $c->add(CursoPeer::ID, $id_curso);
    $c->addJoin(EjercicioPeer::ID_MATERIA, CursoPeer::MATERIA_ID);
    $c->addJoin(EjercicioPeer::ID, Ejercicio_resueltoPeer::ID_EJERCICIO);
    $resultados = Ejercicio_resueltoPeer::DoSelect($c);
    $tiempo = 0;
    foreach ($resultados as $resultado)
    {
      $tiempo += $resultado->getTiempo();
    }
    return $tiempo;
  }

  /**
  *
  * @name         getNumeroCuestionariosCurso ($id_curso)
  * @access       public
  * @author       Angel Martin
  * @deprecated   Devuelve el numero de cuestionarios realizados por el alumno en un curso
  */
  public function getNumeroCuestionariosCurso ($id_curso)
  {
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);
    $c->add(Ejercicio_resueltoPeer::ID_CURSO, $id_curso);
    $c->addJoin(EjercicioPeer::ID, Ejercicio_resueltoPeer::ID_EJERCICIO);
    $c->add(EjercicioPeer::TIPO, 'cuestionario');
    return Ejercicio_resueltoPeer::DoCount($c);
  }

  public function getNumeroTestsCurso ($id_curso)
  {
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);
    $c->add(Ejercicio_resueltoPeer::ID_CURSO, $id_curso);
    $c->addJoin(EjercicioPeer::ID, Ejercicio_resueltoPeer::ID_EJERCICIO);
    $c->add(EjercicioPeer::TIPO, 'test');
    return Ejercicio_resueltoPeer::DoCount($c);
  }

  public function getNumeroProblemasCurso ($id_curso)
  {
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);
    $c->add(Ejercicio_resueltoPeer::ID_CURSO, $id_curso);
    $c->addJoin(EjercicioPeer::ID, Ejercicio_resueltoPeer::ID_EJERCICIO);
    $c->add(EjercicioPeer::TIPO, 'problemas');
    return Ejercicio_resueltoPeer::DoCount($c);
  }

  public function getNumeroEjerciciosCurso($id_curso, $corregidos=false)
  {
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);
    $c->add(Ejercicio_resueltoPeer::ID_CURSO, $id_curso);

    if ($corregidos) {
    	$c->add(Ejercicio_resueltoPeer::ID_CORRECTOR, NULL, Criteria::NOT_EQUAL);
    }
    return Ejercicio_resueltoPeer::DoCount($c);
  }
  
  public function getSumaNotasRealizados($id_curso)
  {
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->id);
    $c->add(Ejercicio_resueltoPeer::ID_CURSO, $id_curso);
		$c->add(Ejercicio_resueltoPeer::ID_CORRECTOR, NULL, Criteria::NOT_EQUAL);
    
		$sumNota = 0;
    $results = Ejercicio_resueltoPeer::DoSelect($c);

    foreach ($results as $res) {
      $sumNota += $res->getScore();
    }
    return $sumNota;
  }
  
  public function permisoBibliotecaArchivos($id_curso)
  {
     if ( ($this->esProfesor($id_curso)  || $this->esAlumno($id_curso)))
      {return true;}                   
     
     return false;
  }


  /**
  *
  * @name         nuevoInvitado()
  * @access       public
  * @author       Jacobo Chaquet
  * @deprecated
  */
  public function nuevoInvitado()
  {
     $c = new Criteria();
     $c->add(UsuarioPeer::NOMBREUSUARIO,"usuario_prueba%", Criteria::LIKE);


     // Fase 1, creacion de n usuarios. Esto solo ocurre en la primera solicitud de prueba
     $count = 0;
     $goal = 5;
     $index = 1;
     if (UsuarioPeer::DoCount($c) < $goal)
     {
       while ($count != $goal)
       {
         $c->add(UsuarioPeer::NOMBREUSUARIO, "usuario_prueba$index");
         if (UsuarioPeer::DoCount($c) == 0)
         {
           $u = new Usuario();
           $u->setNombreusuario("usuario_prueba$index");
           $u->setUltimoacceso(date("Y-m-d H:i:s"));
           $u->save();
           $count++;
         }
         $index++;
       }
     }

     // Fase 2, resetear el usuario mas antiguo (el de "ultimoacceso" anterior)
     $s = sfContext::getInstance();
     $parametros = $s->getRequest()->getParameterHolder()->getAll();

     $c = new Criteria();
     $c->add(UsuarioPeer::NOMBREUSUARIO, "usuario_prueba%", Criteria::LIKE);
     $c->addAscendingOrderByColumn(UsuarioPeer::ULTIMOACCESO);
     $usuario = UsuarioPeer::DoSelectOne($c);

     $usuario->setNombre($parametros["nombre"]);
     $usuario->setApellidos($parametros["apellidos"]);
     $usuario->setInstitucion($parametros["empresa"]);
     $usuario->setCiudad($parametros["ciudad"]);
     $usuario->setEmail($parametros["email"]);
     $usuario->setTelefono1($parametros["telefono"]);
     $usuario->setPaisId($parametros["pais"]);
     $usuario->setUltimoacceso(date("Y-m-d H:i:s", time() + 1));
     $usuario->save();

     $c2 = new Criteria();
     $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $usuario->getId());
     Rel_usuario_rol_cursoPeer::DoDelete($c2);

     $c4 = new Criteria();
     $c4->add(RolPeer::NOMBRE, 'alumno');
     $alumno = RolPeer::DoSelectOne($c4);

     $c3 = new Criteria();
     $c3->add(CursoPeer::NOMBRE, '%demo %', Criteria::LIKE);
     $cursos = CursoPeer::DoSelect($c3);

     foreach ($cursos as $curso)
     {
       $rel = new Rel_usuario_rol_curso();
       $rel->setIdUsuario($usuario->getId());
       $rel->setIdCurso($curso->getId());
       $rel->setIdRol($alumno->getId());
       $rel->save();
     }
     $usuario->emailUsuario(null, -1, "confirmacion", null);

     $datos = "Nombre: ".$usuario->getNombre()." ".$usuario->getApellidos()."<br>
               Empresa: ".$usuario->getInstitucion()."<br /><br />
               Ciudad: ".$usuario->getCiudad()."<br />
               Pais: ".  $usuario->getPais()->getNombre()."<br><br />
               Email: ".$usuario->getEmail()."<br>
               Telefono: ".$usuario->getTelefono1()."<br>
               Como nos conocio: ".$parametros["conocio"];
     $usuario->emailUsuario(null, -1, "invitado", $datos);
  }
//
  public static function isSupervisorTripartita($user_id)
  {
  	$f = false; $c = new Criteria();

    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $user_id);
    $c->add(Rel_usuario_rol_cursoPeer::ID_ROL, 3);
    $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, 1);

    $r = Rel_usuario_rol_cursoPeer::doSelectOne($c);

    if ($r) { if ($r->getTripartita()) { $f = true; } }

    return $f;
  }
  
} // end class