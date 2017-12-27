<?php

/**
 * Subclass for representing a row from the 'paquete' table.
 *
 *
 *
 * @package lib.model
 */
class Paquete extends BasePaquete
{

// Nombre del m�todo: getTotalPaquetes()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Devuelve el numero de modulos totales que hay en la base de datos
   */

 public function getTotalPaquetes()
  {
   	$c2 = new Criteria();
    return PaquetePeer::doCount($c2);
  }


// Nombre del m�todo: getTodosPaquetes()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: evuelve los modulos totales que hay en la base de datos
   */

 public function getTodosPaquetes()
  {
   	$c2 = new Criteria();
    return PaquetePeer::doSelect($c2);
  }


  // Nombre del m�todo: getCursos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Devuelve el los cursos que  hay en un paquete
   */

 public function getCursos()
  {
   	$c2 = new Criteria();
   	$c2->add(Rel_paquete_cursoPeer::ID_PAQUETE,$this->id);
    return Rel_paquete_cursoPeer::doSelect($c2);
  }

    // Nombre del m�todo: estaVacio()
    // A�adida por: Jacobo Chaquet
    /* Descripci�n: comprueba que un curso esta limpio, esto es, si usuarios
     */

   public function estaVacio()
   {
     if ($this->tieneAlumnos())
     {
        return false;
     }
     return true;
    }

    // Nombre del m�todo: geteliminarAll()
    // A�adida por: Jacobo Chaquet
    /* Descripci�n: elimina todo lo referente a un modulos
                    - cursos
                    - alumnos matriculados en el
                    - profesores
     */

   public function eliminarAll()
     {
         $con = Propel::getConnection();
         $cursos = $this->getCursos(); //Rel_paquete_cursoPeer
         $alumnos = $this->getRel_Alumnos(); //Rel_usuario_paquetePeer

         	try
  				{
  				  $con->begin();

             foreach ($alumnos as $alumno)
             {  foreach ($cursos as $curso)
  		   			  {
                  $curso->getCurso()->borrarUsuario($alumno->getUsuario()->getId());
                  $curso->getCurso()->EliminarEjerciciosResueltos($alumno->getUsuario()->getId());
                }
               $alumno->delete($con);
             }

             foreach ($cursos as $curso)
		   			  {
               $curso->delete($con);
              }



            $this->delete($con);
      			$con->commit();
  				}
  			catch (Exception $e)
  				{	$con->rollback();
    				throw $e;
  				}
		    return;
     }


  // Nombre del m�todo: actualiza($con=null)
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: actualiza la informacion de un paquete (fechas inicio, fecha fin, scan)
   */

 public function actualiza($con=null)
  {   $diaInicioPaquete = $this->getFechaInicio("d");
			$mesInicioPaquete = $this->getFechaInicio("m");
			$anioInicioPaquete = $this->getFechaInicio("Y");

			$diaFinPaquete = $this->getFechaFin("d");
			$mesFinPaquete = $this->getFechaFin("m");
			$anioFinPaquete = $this->getFechaFin("Y");

			$c = new sfEventCalendar('month', date("Y-m-d"));
      $cursos = $this->getCursos();

			$scan = 0;
			$i=0;
			foreach ($cursos as $curso)
			{ if ($i==0)
        { $this->setFechaInicio($curso->getCurso()->getFechaInicio());
			    $this->setFechaFin($curso->getCurso()->getFechaFin());
			    $i++;
			  }
        if (1==$curso->getCurso()->getScan())
        {
          $scan++;
        }
        $diaInicioCurso = $curso->getCurso()->getFechaInicio("d");
  			$mesInicioCurso = $curso->getCurso()->getFechaInicio("m");
  			$anioInicioCurso = $curso->getCurso()->getFechaInicio("Y");

  			$diaFinCurso = $curso->getCurso()->getFechaFin("d");
  			$mesFinCurso = $curso->getCurso()->getFechaFin("m");
  			$anioFinCurso = $curso->getCurso()->getFechaFin("Y");

	  		$compFechas = $c->getCalendar()->compareDates($diaInicioCurso,$mesInicioCurso,$anioInicioCurso,
							                                         $diaInicioPaquete,$mesInicioPaquete,$anioInicioPaquete);

          //echo "Entra 1 CURSO: ".$diaInicioCurso."-".$mesInicioCurso."-".$anioInicioCurso." smaller   Paquete:".$diaInicioPaquete."-".$mesInicioPaquete."-".$anioInicioPaquete."<br>";
    			//Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
    			if (-1==$compFechas)
          {
    			  //actualizar fecha inicio paquete
    			  $this->setFechaInicio($curso->getCurso()->getFechaInicio());
	          $this->save($con);
    		   }

    			 $compFechas = $c->getCalendar()->compareDates($diaFinCurso,$mesFinCurso,$anioFinCurso,
					     		                                      $diaFinPaquete,$mesFinPaquete,$anioFinPaquete);

    			 //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
 			     if (1==$compFechas)
           {
            $this->setFechaFin($curso->getCurso()->getFechaFin());
	          $this->save($con);
           }

      }
      if ($scan>0)
      {
        $this->setScan(1);
      }else $this->setScan(0);
      $this->save($con);
  }


  // Nombre del m�todo: getRel_Alumnos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve los alumnos del paquete //Rel_usuario_paquetePeer
   */

 public function getRel_Alumnos()
   {
    $c2 = new Criteria();
    $c2->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->id);

    return Rel_usuario_paquetePeer::doSelect($c2);
   }

  // Nombre del m�todo: tieneAlumnos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: indica si un paquete tiene alumnos o esta vacio, necesario para saber si se puede borrar un modulo
   */

 public function tieneAlumnos()
   {
    $c2 = new Criteria();
    $c2->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->id);

    if (Rel_usuario_paquetePeer::doSelect($c2)) {
    	return true;
    } else return false;
   }

  // Nombre del m�todo: esModulo()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: indica si un usuario es moroso en el modulo
   */

 public function esMoroso($idusuario)
   {

   $c = new Criteria();
   $c->add(RolPeer::NOMBRE, "moroso");
   $rol = RolPeer::doSelectOne($c);
   $id_rol = $rol->getId();

   $c2 = new Criteria();
   $c2->add(Rel_paquete_cursoPeer::ID_PAQUETE, $this->id);
   $rel = Rel_paquete_cursoPeer::doSelectOne($c2);
   if (!$rel) {
    	return false;
    } else {  $c2 = new Criteria();
    		  $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
    		  $c2->add(Rel_usuario_rol_cursoPeer::ID_ROL,$id_rol);
    		  $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$rel->getIdCurso());
    		  if (Rel_usuario_rol_cursoPeer::doSelect($c2)) {
    				return true;
    		} else return false;
	       }


   }

  // Nombre del m�todo: esModulo()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: indica si un usuario esta esta en inscrito en paquete
   */

 public function perteneceUsuario($idusuario)
   {

   $c = new Criteria();
   $c->add(Rel_usuario_paquetePeer::ID_USUARIO, $idusuario);
   $c->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->id);
   $rel = Rel_usuario_paquetePeer::doSelectOne($c);
   if ($rel) {
    	return true;
    } else {  return false;
	       }
   }

  // Nombre del m�todo: evaluacionPesoTarea($idtarea)
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve el peso de un ejercicio en la evaluacion
   */


 public function evaluacionPesoTarea($idtarea)
   {
     $c = new Criteria();
     $c->add(Evaluacion_paquetePeer::ID_PAQUETE, $this->id);
     $c->add(Evaluacion_paquetePeer::ID_TAREA, $idtarea);
     $rel = Evaluacion_paquetePeer::doSelectOne($c);
     return $rel?$rel->getPeso():'';
   }


  // Nombre del m�todo: evaluacionEjercico($idejercicio)
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve true si el ejercicio pertencece a la evaluacion del modulo. tabla evaluacion_paquete
   */

 public function evaluacionTarea($idtarea)
   {
     $c = new Criteria();
     $c->add(Evaluacion_paquetePeer::ID_PAQUETE, $this->id);
     $c->add(Evaluacion_paquetePeer::ID_TAREA, $idtarea);
     $rel = Evaluacion_paquetePeer::doSelect($c);

     if ($rel) {
      	return true;
      } else {  return false;
  	         }
   }

  // Nombre del m�todo: getEvaluacion()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve los ejercicios que evaluan y sus peso, es decir la tabla evaluacion_paquete
   */

 public function getEvaluacion()
   {
     $c = new Criteria();
     $c->add(Evaluacion_paquetePeer::ID_PAQUETE, $this->id);
     return Evaluacion_paquetePeer::doSelect($c);
   }

  // Nombre del m�todo: getAlumnos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve los alumnos matriculados en el paquete
   */

 public function getAlumnos($crit = null)
   {
     if (null != $crit) {
     	    $c = clone $crit;
     	}else $c = new Criteria();
     $c->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->id);
     $c->addJoin(Rel_usuario_paquetePeer::ID_USUARIO, UsuarioPeer::ID);
     return Rel_usuario_paquetePeer::doSelect($c);
   }

  // Nombre del m�todo: getNumeroAlumnos($crit = null)
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve el numero de alumnos matriculados en el paquete
   */

 public function getNumeroAlumnos($crit = null)
   {
     if (null != $crit) {
     	    $c = clone $crit;
     	}else $c = new Criteria();
     $c->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->id);
     $c->addJoin(Rel_usuario_paquetePeer::ID_USUARIO, UsuarioPeer::ID);
     return Rel_usuario_paquetePeer::doCount($c);
   }

  // Nombre del m�todo: getEvaluacionAlumnos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve un array con la evaluacion de los alumnos
                   Si parametro $guardar == 1 guarda las notas en la tabla
                   formato array
                   datos[alumno]=arrayNotas[];
                      arrayNotas=en cada indice esta la nota del ejercicio correspondiente al indice del array $ejerciciosEvaluacion,
                                la ultima posicion es la nota total teniendo en cuenta los pesos
                   Ej datos["jacobo"]=array('7','6','8','7.3')
   */

 public function getEvaluacionAlumnos($tareas_evaluacion=null,$guardar=null)
   {

	  $c = new Criteria();
	  $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
	  $alumnos = $this->getAlumnos($c);

    if (null==$tareas_evaluacion)
    {
      $tareas_evaluacion = $this->getEvaluacion();
    }

    $datos=array();
    foreach($alumnos as $alumno)
    {  $notaFinal=0;
       $nombre=$alumno->getUsuario()->getApellidos().", ".$alumno->getUsuario()->getNombre();
       $datos[$nombre]=array();
	     foreach($tareas_evaluacion as $tarea_evaluacion)
	     { //$datos[$nombre][]=$ejercicio_evaluacion->getEjercicio()->getTitulo();
	       $nota = $alumno->getUsuario()->getNotaTarea($tarea_evaluacion->getTarea()->getId());

         if (-1!=$nota)
         {  $datos[$nombre][]=$nota;
	       }else { $datos[$nombre][]="-1";
	               $nota=0;
               }

         $notaFinal += ($nota * $tarea_evaluacion->getPeso())/100;
         if (1==$guardar)
         {
              $con = Propel::getConnection();
             	try
          		{
                     $con->begin();

                     $c = new Criteria();
                     $c->add(Rel_usuario_paquetePeer::ID_PAQUETE, $this->id);
                     $c->add(Rel_usuario_paquetePeer::ID_USUARIO,  $alumno->getUsuario()->getId());
                     $rel = Rel_usuario_paquetePeer::doSelectOne($c);
                     if ($rel)
                     {
                        $rel->setScore($notaFinal);
                        $rel->save();
                      }

                      $con->commit();
               }
           		 catch (Exception $e)
            		      {	$con->rollback();
            			      throw $e;
            		      }
                   }
       }
       $datos[$nombre][]=$notaFinal;
	  }
	  return $datos;
   }

  // Nombre del m�todo: getNotasAlumno()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve un array con la evaluacion de un alumno
                   formato array:  result[]=(arrayNotas[],notaFinal);
                      arrayNotas=en cada indice esta la nota del ejercicio correspondiente al indice del array $ejerciciosEvaluacion,
                                la ultima posicion es la nota total teniendo en cuenta los pesos
                   Ej: arrayNotas["ej1"]=array(60,7); // peso,nota,total
                       arrayNotas["ej2"]=array(40,7);

                       arrayNotas[]=( array(60,7),
                                      array(40,7),
                                      7
                                    )

   */

 public function getNotasAlumno($idusuario,$tareas_evaluacion=null)
   {
    $alumno = UsuarioPeer::retrieveByPk($idusuario);

    //echo "paquete.php getNotasAlumni<br>";

    if (null==$tareas_evaluacion)
    {
      $tareas_evaluacion = $this->getEvaluacion();
    }

    $datos=array();
    $notaFinal=0;
    $nombre=$alumno->getApellidos().", ".$alumno->getNombre();
    $datos=array();
	  foreach($tareas_evaluacion as $tarea_evaluacion)
	  {
	      $nota = $alumno->getNotaTarea($tarea_evaluacion->getTarea()->getId());

        $datos[$tarea_evaluacion->getTarea()->getEjercicio()->getTitulo()][]=$tarea_evaluacion->getPeso();
        if (-1!=$nota)
        {  $datos[$tarea_evaluacion->getTarea()->getEjercicio()->getTitulo()][]=$nota;
	      }else { $datos[$tarea_evaluacion->getTarea()->getEjercicio()->getTitulo()][]="No entregado";
	              $nota=0;
              }
        $datos[$tarea_evaluacion->getTarea()->getEjercicio()->getTitulo()][]=($nota * $tarea_evaluacion->getPeso())/100;
        $notaFinal += ($nota * $tarea_evaluacion->getPeso())/100;
    }
    $result[0]=$datos;
    $result[1]=$notaFinal;

	  return $result;
   }



  // Nombre del m�todo: getRankingAlumnos
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: devuelve un array ordenado
                  $modo = indica tipo de ordenacion
                  $modo = 1 de menor a mayor
                          e.o.c. de mayor a menor

                   formato array
                   datos[alumno]=Nota_final;

                   Ej datos["jacobo"]='7.3'
   */

 public function getRankingAlumnos($modo=null)
   {

	  $datos = $this->getEvaluacionAlumnos();
	  $rankig = array();

	  foreach($datos as $dato => $clave)
    {
         $ranking[$dato]=$clave[count($clave)-1];
    }

    if (1==$modo)
    {
      asort($ranking,SORT_NUMERIC); //de menor a mayor
    } else arsort($ranking,SORT_NUMERIC); // //de mayor a menor

    reset($ranking);

	  return $ranking;
   }

   /************************************
    ** Alta de usuarios en m�dulo     **
    ** Autor: Todor Todorov           **
    ** Modificado por: Jacobo Chaquet **
    ***********************************/

   public function alta($idusuario)
   {

      $rel = new Rel_usuario_paquete();

      $con = Propel::getConnection();
  		try
  		{
        $con->begin();
        $rel->setIdPaquete($this->getId());
        $rel->setIdUsuario($idusuario);
        $rel->save($con);

        $cursos = $this->getCursos();
        foreach ($cursos as $curso)
        {
          $curso->getCurso()->alta($idusuario,$rol='alumno');
        }

        $con->commit();
      }
  		catch (Exception $e)
  		{
        $con->rollback();
				throw $e;
  		}
  		return true;
   }

 /**
 *
 * @name         getUsuarioOnline()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve los usuarios del modulo que estan conectados si se le pasa es el id  del usuario este no aparecera
 */
  public function getUsuarioOnline($idUsuario=null)
  {
    $cursos =  $this->getCursos();

    $c = new Criteria();
    $c->add(Usuarios_onlinePeer::TIEMPO, time()-(160), Criteria::GREATER_THAN); //este tiempo tiene qser mayor qel puesto en /online/javascript_periodico

    /*if ($idUsuario)
    {
      $c->add(Usuarios_onlinePeer::ID_USUARIO, $idUsuario, Criteria::NOT_EQUAL );
    }*/

    foreach($cursos as $curso)
    {
      if ( (isset($criterion))  )
      {
        $criterion2 = $c->getNewCriterion(Usuarios_onlinePeer::ID_CURSO,$curso->getCurso()->getId());
        $criterion->addOr($criterion2);
      } else $criterion = $c->getNewCriterion(Usuarios_onlinePeer::ID_CURSO,$curso->getCurso()->getId());
    }
    $c->add($criterion);

    $c->addGroupByColumn(Usuarios_onlinePeer::ID_USUARIO);

    $usuarios= Usuarios_onlinePeer::doSelect($c);

    return $usuarios;

  }

 /**
 *
 * @name         getNumUsuarioOnline()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Devuelve el numero de usuarios del modulo
 */
  public function getNumUsuarioOnline($idUsuario=null)
  {
    $cursos =  $this->getCursos();

    $c = new Criteria();
    $c->add(Usuarios_onlinePeer::TIEMPO, time()-(160), Criteria::GREATER_THAN); //este tiempo tiene qser mayor qel puesto en /online/javascript_periodico

    /*if ($idUsuario)
    {
      $c->add(Usuarios_onlinePeer::ID_USUARIO, $idUsuario, Criteria::NOT_EQUAL );
    }*/

    foreach($cursos as $curso)
    {
      if ( (isset($criterion))  )
      {
        $criterion2 = $c->getNewCriterion(Usuarios_onlinePeer::ID_CURSO,$curso->getCurso()->getId());
        $criterion->addOr($criterion2);
      } 
      else
      {    
          $criterion = $c->getNewCriterion(Usuarios_onlinePeer::ID_CURSO,$curso->getCurso()->getId());
      }    
    }
    $c->add($criterion);

    $c->addGroupByColumn(Usuarios_onlinePeer::ID_USUARIO);

    $usuarios= Usuarios_onlinePeer::doSelect($c);
    
    /*$num = 0;
    $id_user = 0;
    
    foreach ($usuarios as $user){
        if($id_user != $user->getIdUsuario()){
            $num++;
            $id_user = $user->getIdUsuario();
        }
    }*/
    
    $num = count($usuarios);

    return $num;

  }

}
