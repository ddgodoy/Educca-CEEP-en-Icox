<?php

/**
 * seguimiento actions.
 *
 * @package    edoceo
 * @subpackage seguimiento
 * @author     Jacobo Chaquet
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class seguimientoActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  // Nombre del m�todo: executeIndex()
  // A�adida por: Santiago Mart�nez de la Riva
  /* Descripci�n: muestra la pantalla inicial del seguimiento de los alumnos para un curso.
   */
  public function executeIndex()
  {
    $this->idcurso = $this->getRequestParameter('idcurso');

    $usuario = $this->getUser();

    if ( $usuario->hasCredential('alumno') )
    {
	        $this->rol = 'alumno';
	  } else if ($usuario->hasCredential('profesor'))
           {
	          $this->rol = 'profesor';
           } else if ($usuario->hasCredential('supervisor'))
                  {   $this->rol = 'supervisor';
                   } else {      /*No deber�a llegar aqu� */     }

    if (!$this->idcurso)
    {
       $this->redirect('/'.$this->rol.'/index');
    }
    $this->getUser()->comprobarPermiso($this->idcurso);
    $this->getUser()->setCursoMenu($this->idcurso);
    $c = new Criteria();
    $c->add(CursoPeer::ID, $this->idcurso);
    $this->curso = CursoPeer::doSelectOne($c);
    $this->forward404Unless($this->curso);
    $this->idusuario = $usuario->getAnyId();
  }

  // Nombre del m�todo: executeListarAlumnosCurso()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: muestra los alumnos en un curso
                  NOTA: si no recibe idcurso mostrara todos los alumnos de la base de datos
   */
  public function executeListarAlumnosCurso()
  {
   $usuario = $this->getUser();
   if ($usuario->hasCredential('profesor'))
   {
     if ($this->getRequestParameter('idcurso'))
     { //para saber de que materia viene
        $this->idcurso = $this->getRequestParameter('idcurso');
        $this->getUser()->comprobarPermiso($this->idcurso);
      	$this->curso = CursoPeer::retrieveByPk($this->idcurso);
      	$this->forward404Unless($this->curso);
     }
   }
   else  $this->redirect('login/logout');
  }

  // Nombre del m�todo: executeSeguimientoPorTemas()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: muestra los alumnos en un curso
                  NOTA: si no recibe idcurso devolver� NULL
   */
  public function executeSeguimientoPorTemas()
  {
    $opciones[0] = 'Por nombre';
    //$opciones[1] = 'Por estado';
    $opciones[2] = 'Por temas';
    //$opciones[3] = 'Por tiempo y temas';
    
    $this->opciones = $opciones;
    $usuarios = new Usuario();
    
    if ($this->getRequestParameter('idcurso'))
    {
      $this->idcurso = $this->getRequestParameter('idcurso');
      $this->curso = CursoPeer::retrieveByPk($this->idcurso);
      $this->forward404Unless($this->curso);
      
      $this->getUser()->comprobarPermiso($this->idcurso);
      
      if($this->curso->getMateriaId())
      {
        $materia = MateriaPeer::retrieveByPk($this->curso->getMateriaId());
        $this->forward404Unless($this->curso);
        
        $this->num = $materia->getNumeroTemas();
        $c2 = new Criteria();
        $c2->addAscendingOrderByColumn(TemaPeer::NUMERO_TEMA);
        $this->temas = $materia->getTemas($c2);
        $c3 = new Criteria();
        $c3->add(Sco12Peer::ID_MATERIA, $materia->getId());
        $this->scos12 = Sco12Peer::doSelect($c3);
        
        $c2 = new Criteria();
        if ($this->getUser()->hasCredential('supervisor') && ($this->getRequestParameter('idusuario')))
        {
          $usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('idusuario'));
          $this->forward404Unless($usuario);
          $c2->add(UsuarioPeer::ID,$this->getRequestParameter('idusuario'));
          $this->idusuario=$this->getRequestParameter('idusuario');
        }
        else 
        {
          $c2->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
        }
        $this->alumnos = $usuarios->getAlumnos($this->idcurso,$c2);
      }
    }
    else	{$this->alumnos = null; // $usuarios->getAlumnos();
           $this->curso = null;
          }
  }
  /**
   *
   */
  public function executeSeguimientoTiempos()
  {
    $c = new Criteria();
    $this->cursos = CursoPeer::doSelect($c);
    $this->idcurso = 0;

    $usuarios = new Usuario();
    
    if ($this->getRequestParameter('idcurso'))
    {
      $this->idcurso = $this->getRequestParameter('idcurso');
      $this->curso = CursoPeer::retrieveByPk($this->idcurso);
      $this->forward404Unless($this->curso);
      
      $this->getUser()->comprobarPermiso($this->idcurso);
      
      if($this->curso->getMateriaId())
      {
        $materia = MateriaPeer::retrieveByPk($this->curso->getMateriaId());
        $this->forward404Unless($this->curso);
        
        $this->num = $materia->getNumeroTemas();
        $c2 = new Criteria();
        $c2->addAscendingOrderByColumn(TemaPeer::NUMERO_TEMA);
        $this->temas = $materia->getTemas($c2);
        $c3 = new Criteria();
        $c3->add(Sco12Peer::ID_MATERIA, $materia->getId());
        $this->scos12 = Sco12Peer::doSelect($c3);
        
        $c2 = new Criteria();
        /*if ($this->getUser()->hasCredential('supervisor') && ($this->getRequestParameter('idusuario')))
        {
          $usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('idusuario'));
          $this->forward404Unless($usuario);
          $c2->add(UsuarioPeer::ID,$this->getRequestParameter('idusuario'));
          $this->idusuario=$this->getRequestParameter('idusuario');
        }
        else 
        {*/
          $c2->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
        /*}*/
        $this->alumnos = $usuarios->getAlumnos($this->idcurso,$c2);
      }
    }     
  }

  public function executeEditarTiempos()
  {
      $this->usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('iduser'));
      $this->materia = MateriaPeer::retrieveByPk($this->getRequestParameter('idmateria'));
      $this->curso = CursoPeer::retrieveByPk($this->getRequestParameter('idcurso'));
      $this->array_tiempo_ejercicios = array();
      
      /***************************************************Tiempo Tiempo teoria*/
      
      $c = new Criteria();
      $c->add(Sco12Peer::ID_MATERIA, $this->materia->getId());
      $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $this->usuario->getId());
      $c->addJoin(Sco12Peer::ID, Rel_usuario_sco12Peer::ID_SCO12);
      $this->rel = Rel_usuario_sco12Peer::DoSelectOne($c);
      
      /***********************************************Tiempo Tiempo ejercicios*/
      $this->ejercicios_array = array();
      $tareas = $this->curso->getTareas();

      $tiempo=0;
      foreach($tareas as $tarea)
      {
           $ejercicio = EjercicioPeer::retrieveByPK($tarea->getIdEjercicio());

           $this->ejercicios_array[$ejercicio->getId()]['titulo'] = $ejercicio->getTitulo();
      }
      foreach($tareas as $tarea)
      {
           $c = new Criteria();
           $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $this->usuario->getId());
           $c->add(Rel_usuario_tareaPeer::ID_TAREA, $tarea->getId());
           $tareas_usuarios = Rel_usuario_tareaPeer::doSelect($c);

           foreach($tareas_usuarios as $tarea_usuario )
           {
             $c1 = new Criteria();
             $c1->add(Ejercicio_resueltoPeer::ID_AUTOR, $this->usuario->getId());
             $c1->add(Ejercicio_resueltoPeer::ID, $tarea_usuario->getIdEjercicioResuelto());

             $tareas_resueltas = Ejercicio_resueltoPeer::doSelect($c1);

             foreach($tareas_resueltas as $tarea_resuelta )
             {
               $k = $tarea_resuelta->getId();
               $ejercicios = EjercicioPeer::retrieveByPK($tarea_resuelta->getIdEjercicio());
               $id_ejer = $tarea_resuelta->getIdEjercicio();
               if(!empty($this->ejercicios_array[$id_ejer]))
               {
                unset($this->ejercicios_array[$id_ejer]);
               }
               $this->array_tiempo_ejercicios[$k]['ejercicio'] = $ejercicios->getTitulo();
               $this->array_tiempo_ejercicios[$k]['tiempo'] = $tarea_resuelta->getTiempo();
               
               $this->tiempo_total += $tarea_resuelta->getTiempo();

             }
           }

           
      }
      if($this->getRequest()->getMethod() == sfRequest::POST)
      {

         $rel_session = traducir_scorm12_a_fecha($this->getRequestParameter('rel_session',''));
         $rel_total_time = traducir_scorm12_a_fecha($this->getRequestParameter('rel_total_time',''));

         if($this->getRequestParameter('id-ejercicio-relacion'))
         {
             $c3 = new Criteria();
             $c3->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$this->curso->getId());
             $c3->add(Rel_usuario_rol_cursoPeer::ID_ROL, 2);
             $profesor = Rel_usuario_rol_cursoPeer::doSelectOne($c3);



             $ejercicio = EjercicioPeer::retrieveByPK($this->getRequestParameter('id-ejercicio-relacion'));

             $c4 = new Criteria();
             $c4->add(TareaPeer::ID_EJERCICIO,$ejercicio->getId());
             $c4->add(TareaPeer::ID_CURSO,$this->curso->getId());
             $tarea_ejercicio = TareaPeer::doSelectOne($c4);


             $ejer_resuelto = new Ejercicio_resuelto();
             $ejer_resuelto->setIdAutor($this->usuario->getId());
             $ejer_resuelto->setIdEjercicio($ejercicio->getId());
             $ejer_resuelto->setIdCorrector($profesor->getIdUsuario());
             $ejer_resuelto->setIdCurso($this->curso->getId());
             $ejer_resuelto->save();

             $rel_usuario_tarea = new Rel_usuario_tarea();
             $rel_usuario_tarea->setIdUsuario($this->usuario->getId());
             $rel_usuario_tarea->setIdTarea($tarea_ejercicio->getId());
             $rel_usuario_tarea->setIdEjercicioResuelto($ejer_resuelto->getId());
             $rel_usuario_tarea->setEntregada(1);
             $rel_usuario_tarea->setCorregida(1);
             $rel_usuario_tarea->save();

             $this->getUser()->setAttribute('notice', 'El alumno fue relacionado con el curso');

         }
         else
         {
                 $ejercicios_request = $this->getRequestParameter('ejercicio','');

                 if($rel_session!='' && $rel_total_time!='')
                 {
                     $this->rel->setSessionTime($rel_session);
                     $this->rel->setTotalTime($rel_total_time);
                     $this->rel->save();
                 }

                 if($ejercicios_request!='')
                 {
                     foreach ($ejercicios_request as $k=>$v)
                     {
                        $new_time=Ejercicio_resueltoPeer::retrieveByPK($k);
                        $new_time->setTiempo($v);
                        $new_time->save();
                     }
                 }

                 $this->getUser()->setAttribute('notice', 'Los tiempos fueron actualizados');      
         }
         $this->redirect('/seguimiento/editarTiempos?idcurso='.$this->curso->getId().'&iduser='.$this->usuario->getId().'&idmateria='.$this->curso->getMateriaId());
      }
  }

  public function executeAuditoriaSRE()
  {
       $this->usuario = UsuarioPeer::retrieveByPk(329);
       $this->array_evento = array();

       $c = new Criteria();
       $c->add(Rel_usuario_eventoPeer::ID_USUARIO, $this->usuario->getId());
       $c->addDescendingOrderByColumn(Rel_usuario_eventoPeer::ID_EVENTO);
       $eventos_usuario = Rel_usuario_eventoPeer::doSelect($c);

       foreach ($eventos_usuario as $evento_usuario)
       {
           $evento = EventoPeer::retrieveByPK($evento_usuario->getIdEvento());

           $this->array_evento[$evento->getId()]['fecha_inicio'] = $evento->getFechaInicio();
           $this->array_evento[$evento->getId()]['fecha_fin'] = $evento->getFechaFin();
           $this->array_evento[$evento->getId()]['titulo'] = $evento->getTitulo();
           $tipo_evento = Tipo_eventoPeer::retrieveByPK($evento->getIdTipoEvento());
           $this->array_evento[$evento->getId()]['tipo'] = $tipo_evento->getDescripcion();
           
       }

  }

  // Nombre del m�todo: executeOrdenar()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n:
   */
  public function executeOrdenar()
  {
   // $opciones[0] = 'Por nombre';
   // $opciones[1] = 'Por estado';
   // $opciones[2] = 'Por temas';
   // $opciones[3] = 'Por tiempo por temas';

     $usuarios = new Usuario();
     $this->ordenar = $this->getRequestParameter('ordenar');
     if ($this->getRequestParameter('idcurso'))
     {
      		$this->idcurso = $this->getRequestParameter('idcurso');
      		$curso = CursoPeer::retrieveByPk($this->idcurso);
      		$this->curso = $curso;
      		$this->forward404Unless($curso);

          $this->getUser()->comprobarPermiso($this->idcurso);

  	     	if($curso->getMateriaId())
        	{
                   $materia = MateriaPeer::retrieveByPk($curso->getMateriaId());
        	     		 $this->forward404Unless($materia);

        	            $this->num = $materia->getNumeroTemas();
        	            $c2 = new Criteria();
        	            $c2->addAscendingOrderByColumn(TemaPeer::NUMERO_TEMA);
        	            $this->temas = $materia->getTemas($c2);
        	            $c3 = new Criteria();
                      $c3->add(Sco12Peer::ID_MATERIA, $materia->getId());
                      $this->scos12 = Sco12Peer::doSelect($c3);

        	            $c2 = new Criteria();
        	            $c2->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
        	            if ($this->getRequestParameter('idusuario'))
                      {
        	                $this->idusuario = $this->getRequestParameter('idusuario');
                          $usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('idusuario'));
        	     		        $this->forward404Unless($usuario);
        	     		        $c2->add(UsuarioPeer::ID,$this->getRequestParameter('idusuario'));
        	     		        $this->idusuario= $this->getRequestParameter('idusuario');
                      }
     	                $this->alumnos = $usuarios->getAlumnos($this->idcurso,$c2);
  			   }
  	}
    else	$this->alumnos = $usuarios->getAlumnos();
  }

  // Nombre del m�todo: executeGrafica()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n:
   */
  public function executeGrafica()
  {

     if ($this->getRequestParameter('tipo'))
     {
      	$this->tipo = $this->getRequestParameter('tipo');
     }

     if ($this->getRequestParameter('idcurso'))
     {
      	$this->idcurso = $this->getRequestParameter('idcurso');
     }

     if ( $this->getUser()->hasCredential('alumno') )
     {
         // para que los alumnos solo puedan ver sus tiempos
	        $this->idusuario = $this->getUser()->getAnyId();
	    }else  if ($this->getRequestParameter('idusuario'))
             {
      	       $this->idusuario = $this->getRequestParameter('idusuario');
             }

      if ($this->getRequestParameter('idtema'))
      {
      	$this->idtema = $this->getRequestParameter('idtema');
      }
      
      if ($this->hasRequestParameter('idsco12'))
      {
      	$this->idsco12 = $this->getRequestParameter('idsco12');
      }

      if ($this->getRequestParameter('tipo'))
      {
      	$this->tipo = $this->getRequestParameter('tipo');
      }

      if ($this->getRequestParameter('idtarea'))
      {
      	$this->idtarea = $this->getRequestParameter('idtarea');
      }

    return sfView::SUCCESS;
  }

  // Nombre del m�todo: executeRankingModulo()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: genera el template q contendra la grafica del ranking de un modulo, solo los supervisores podran hacerlo
   */
  public function executeRankingModulo()
  {
    $idmodulo = $this->getRequestParameter('idmodulo');
    $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
	  $this->forward404Unless($this->modulo);
  }


  // Nombre del m�todo: executeBuscar()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Busca alumnos de un curso
   */
  public function executeBuscar()
  {
   if ($this->getRequest()->getMethod() == sfRequest::POST)
   {
      $tipo = $this->getRequestParameter('tipo');

      $c = new Criteria();
      $c->add(RolPeer::NOMBRE, "alumno");
      $rol = RolPeer::doSelectOne($c);
      $id_rol = $rol->getId();

			$c = new Criteria();
			$c2 = new Criteria();

      if ($this->getRequestParameter('usuario'))
      {
				$criterion = $c->getNewCriterion(UsuarioPeer::NOMBREUSUARIO,"%".$this->getRequestParameter('usuario')."%",Criteria::LIKE);
			}

      if ($this->getRequestParameter('dni'))
      {
				if (!isset($criterion))
        {
				      $criterion = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
				}else { $criterionAux = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
						    if ("Or"==$tipo[0])
                {
				         	 $criterion->addOr($criterionAux);
				        }else  $criterion->addAnd($criterionAux);
			        }
			}

      if ($this->getRequestParameter('nombre'))
      {
				if (!isset($criterion))
        {
				   $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
				}else { $criterionAux = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
				    		if ("Or"==$tipo[0])
                {
				         	 $criterion->addOr($criterionAux);
				        }else  $criterion->addAnd($criterionAux);
			          }
			}

		  if ($this->getRequestParameter('apellidos'))
      {
			  if (!isset($criterion))
        {
				  $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
				}else { $criterionAux = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
				    		if ("Or"==$tipo[0])
                {
				         	 $criterion->addOr($criterionAux);
				        }else  $criterion->addAnd($criterionAux);
			        }
			}

			if ($this->getRequestParameter('email'))
      {
				if (!isset($criterion))
        {
				  $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
				}else { $criterionAux = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
				      	if ("Or"==$tipo[0])
                {
				         	 $criterion->addOr($criterionAux);
				        }else  $criterion->addAnd($criterionAux);
			        }
			}

      if (isset($criterion))
      {
       	 $c2->add($criterion);
      }

		  if ($this->getRequestParameter('idcurso'))
      {
		       $this->curso = CursoPeer::retrieveByPk($this->getRequestParameter('idcurso'));
		       $this->forward404Unless($this->curso);
           $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$this->getRequestParameter('idcurso'));}
		       $c2->add(Rel_usuario_rol_cursoPeer::ID_ROL,$id_rol);
		       $c2->addGroupByColumn(Rel_usuario_rol_cursoPeer::ID_USUARIO);
		       $this->alumnos = Rel_usuario_rol_cursoPeer::doSelectJoinUsuario($c2);

           $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
           return;

      } else {
               /* Hay que mostrar el formulario con los cursos que el usuario no tiene con ese rol */
              if ($this->getRequestParameter('idcurso'))
              {
		            $this->curso = CursoPeer::retrieveByPk($this->getRequestParameter('idcurso'));
		            $this->forward404Unless($this->curso);
		          }

            }

      return;
  }

    /**
   * Executes source action
   *
   */
  public function executeSource()
  {
    if ($this->getRequestParameter('datos'))
    {
      $datos = $this->getRequestParameter('datos');
		  $parametros = explode("@", $datos);
		  foreach ($parametros as $parametro)
		    {
          $parametrosAux = explode("=", $parametro);
		      ${$parametrosAux[0]} = $parametrosAux[1];
        }
		}

    if ( $this->getUser()->hasCredential('alumno') )
    {
      // para que los alumnos solo puedan ver sus tiempos
	    $idusuario = $this->getUser()->getAnyId();
	  }
	  
	  
    $curso = CursoPeer::retrieveByPk($idcurso);
 	  $this->forward404Unless($curso);

    $this->getUser()->comprobarPermiso($idcurso);
    $sfSwfChart = new sfSwfChart();

     if ('alumno'==$tipo)
     {
         if($curso->getMateriaId())
      	 {
             $width = 650;
             $height = 400;
        	   $materia = MateriaPeer::retrieveByPk($curso->getMateriaId());
      	     $this->forward404Unless($materia);

      	     $alumno = UsuarioPeer::retrieveByPk($idusuario);

             $arrayTemas[0] ="";
          	 $arrayTiempos[0] ="Tiempo (minutos)";

              if ($materia->getTipo() == 'segmentada')
              {
                $this->num = $materia->getNumeroTemas();
                $c2 = new Criteria();
                $c2->addAscendingOrderByColumn(TemaPeer::NUMERO_TEMA);
                $temas = $materia->getTemas($c2);

                if (11 > $materia->getNumeroTemas())
                {
                  $leyenda = "Tema";
                } else $leyenda ="";
                //$tema->getDuracionAlumno($alumno->getUsuario()->getId())
                $i=1;
                foreach ($temas as $tema)
                {
                  $arrayTemas[$i] = $leyenda.$tema->getNumeroTema();
                  $arrayTiempos[$i++] = $tema->getDuracionAlumno($idusuario) / 60; //en la base de datos se guarda en segundos
                }

                $arrayTemas[$i] = "Ejercicios"; //ejercicios
                $arrayTiempos[$i++] = $alumno->tiempoEjercicios($idcurso) / 60; //en la base de datos se guarda en segundos
              }

              if ($materia->getTipo() == 'compo')
              {
                $arrayTemas[1] = utf8_encode("Teor�a");
                $arrayTemas[2] = "Ejercicios";

                $arrayTiempos[1] =   $alumno->tiempoTotalTeoriaScorm($materia->getId())/ 60;
                $arrayTiempos[2] = $alumno->tiempoEjercicios($idcurso) / 60; //en la base de datos se guarda en segundos
              }

              if ($materia->getTipo() == 'scorm1.2')
              {
                $c2 = new Criteria();
                $c2->add(Sco12Peer::ID_MATERIA, $materia->getId());
                $sco12_list = Sco12Peer::DoSelect($c2);
                $c3 = new Criteria();

                $i = 1;
                foreach ($sco12_list as $sco12)
                {
                  $c3->add(Rel_usuario_sco12Peer::ID_SCO12, $sco12->getId());
                  $c3->add(Rel_usuario_sco12Peer::ID_USUARIO, $alumno->getId());
                  $rel = Rel_usuario_sco12Peer::DoSelectOne($c3);
                  if ($rel) {$arrayTiempos[$i] = floor($rel->getTiempoTotal() / 60);}
                  else {$arrayTiempos[$i] = 0;}

                  $arrayTemas[$i] = $i;
                  $i++;
                }
                if ($i > 10)
                {
                  $arrayTemas[$i] = 'Ej.';
                }
                else
                {
                  $arrayTemas[$i] = 'Ejercicios';
                }
                $arrayTiempos[$i] =  round($alumno->tiempoEjercicios($idcurso) / 60);
              }

			     }
           $chart[ 'axis_category' ] = array ( 'size'=>12, 'color'=>"000000", 'alpha'=>50, 'font'=>"arial", 'bold'=>true, 'skip'=>0 ,'orientation'=>"horizontal" );
        	 $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>false, 'category_ticks'=>false );
        	 $chart[ 'axis_value' ] = array ( 'alpha'=>0 );

        	 $chart[ 'chart_border' ] = array ( 'top_thickness'=>0, 'bottom_thickness'=>0, 'left_thickness'=>0, 'right_thickness'=>0 );
        	 $chart[ 'chart_data' ] = array ( $arrayTemas, $arrayTiempos  );
        	 $chart[ 'chart_grid_h' ] = array ( 'thickness'=>0 );
        	 $chart[ 'chart_pref' ] = array ( 'rotation_x'=>15, 'rotation_y'=>30 );
        	 $chart[ 'chart_rect' ] = array ( 'x'=>-60, 'y'=>30, 'width'=>$width, 'height'=>$height , 'positive_alpha'=>0, 'negative_alpha'=>25 );
        	 $chart[ 'chart_type' ] = "3d column" ;
        	 $chart[ 'chart_value' ] = array ( 'hide_zero'=>true, 'color'=>"000000", 'alpha'=>80, 'size'=>10, 'position'=>"over", 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>true );

        	 $chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'font'=>"arial", 'bold'=>true, 'size'=>12, 'color'=>"000000", 'alpha'=>50 );
        	 $chart[ 'legend_rect' ] = array ( 'x'=>50, 'y'=>35, 'width'=>100, 'height'=>40, 'margin'=>5, 'fill_color'=>"000066", 'fill_alpha'=>0, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );

        	 //$chart[ 'live_update' ] = array ( 'url'=>"php/Gallery_3D_Column_1.php?time=".time(), 'delay'=>5 );

        	 $chart[ 'series_color' ] = array ("768bb3" );
        	 $chart[ 'series_gap' ] = array ( 'bar_gap'=>10, 'set_gap'=>20) ;
     }
     
     
     if ('tema'==$tipo)
      {
      //tama�o flash
      $width = 0;
      $height = 0;
      
      $tema = TemaPeer::retrieveByPk($idtema);
      $this->forward404Unless($tema);
      
      $c2 = new Criteria();
      $c2->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
      $usuarios = new Usuario();
      $alumnos = $usuarios->getAlumnos($idcurso,$c2);
      
      $arrayAlumnos[0] ="";
      $arrayTiempos[0] ="tiempo (minutos)";
      
      $i=1;
      foreach ($alumnos as $alumno)
      { $arrayAlumnos[$i] = $alumno->getUsuario()->getApellidos()." ".$alumno->getUsuario()->getNombre();
        $arrayTiempos[$i++] = $tema->getDuracionAlumno($alumno->getUsuario()->getId()) / 60;
      }
      
      $numeroAlumnos = $curso->getNumeroAlumnos();  //para saber el tama�o de la grafica
      $tamanioEjeY = $numeroAlumnos * 20; // 20 px por alumno*/
      
      //         -----codigo para pruebas con muchos alumnos -----
      /*$numeroAlumnos = 220;
      $tamanioEjeY = $numeroAlumnos * 20;
      $arrayAlumnos[1] = "primero";
      $arrayTiempos[1] = 23;
      $nombres = array ('Luis','Antonio','Cesar','Maria Antonia','Luisa','Ana Maria','Jose Luis','Jose Maria','Alvaro','Jaime','Marta','Eva','Beatriz','Manuel','Manolo','Ramon Alejandrin','Alejandro','Esperanza','Patricia','Maria Jesus','Ianire','Lia','Irene','Juan','Francisco Javier');
      $apellidos = array ('Sanchez','Gonzalez','Matinez','Verdasco','Sanz','Benito','Summers','De la Cruz','Guttierrez','Matesanz','Perez','Rodrigez','Sancho','Santamaria','Santas','Mansilla','Carrion','Taberner','Santalla','Reyes','Valdenebro','Cantero','De los dolores','Erranz','Cabeza');
      for($i=2;$i<=$numeroAlumnos-1;$i++)
      {
      $arrayAlumnos[$i] = $apellidos[rand(0, count($apellidos)-1 )]." ".$apellidos[rand(0, count($apellidos)-1 )].", ".$nombres[rand(0, count($nombres)-1 )]." ".$i;
      $arrayTiempos[$i] = rand ( 0, 999 );
      }
      $arrayAlumnos[$numeroAlumnos] = "ultimo";
      $arrayTiempos[$numeroAlumnos] = 50;*/
      
      $chart[ 'axis_category' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ff8844", 'alpha'=>50, 'skip'=>0 );
      $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>true, 'category_ticks'=>true, 'major_thickness'=>2, 'minor_thickness'=>1, 'minor_count'=>1, 'major_color'=>"222222", 'minor_color'=>"222222" ,'position'=>"centered" );
      $chart[ 'axis_value' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ffffff", 'alpha'=>30, 'steps'=>6, 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'show_min'=>true );
      
      $chart[ 'chart_border' ] = array ( 'color'=>"000000", 'top_thickness'=>1, 'bottom_thickness'=>1, 'left_thickness'=>3, 'right_thickness'=>1 );
      //$chart[ 'chart_data' ] = array ( array ( "", "2005", "2006", "2007" ),  array ( "region A", -25, 45, 100 ), array ( "region B", -35, 65, 80 ), array ( "region C", 10, 30, 55 ) );
      $chart[ 'chart_data' ] = array ($arrayAlumnos,   $arrayTiempos );
      $chart[ 'chart_grid_h' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1, 'type'=>"dashed" );
      $chart[ 'chart_grid_v' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1 );
      $chart[ 'chart_rect' ] = array ( 'x'=>200, 'y'=>0, 'width'=> 490, 'height'=>$tamanioEjeY, 'positive_color'=>"ffffff", 'negative_color'=>"ff0000", 'positive_alpha'=>35, 'negative_alpha'=>10 );
      $chart[ 'chart_transition' ] = array ( 'type'=>"scale", 'delay'=>.1, 'duration'=>.1, 'order'=>"category" );
      $chart[ 'chart_type' ] = "bar";
      $chart[ 'chart_value' ] = array ( 'color'=>"ff8844", 'alpha'=>50, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'position'=>"center", 'prefix'=>"", 'suffix'=>" minutos", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>false );
      
      if ($numeroAlumnos>=5)
      {
       	$sizeAlumnos = 15;
      }else $sizeAlumnos = 0;
      
      $chart[ 'draw' ] = array ( array ( 'type'=>"text", 'color'=>"eeeeff", 'alpha'=>35, 'size'=>10, 'x'=>-300, 'y'=>$height, 'width'=>50, 'height'=>50, 'text'=>"growth", 'h_align'=>"left", 'v_align'=>"bottom" ),
          			               array ( 'type'=>"text", 'color'=>"000044", 'alpha'=>35, 'rotation'=>90, 'size'=>$sizeAlumnos, 'x'=>350, 'y'=>0, 'width'=>500, 'height'=>350, 'text'=>"a l u m n o s", 'h_align'=>"left", 'v_align'=>"bottom" ) );
      
      //$chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>0, 'width'=>10, 'height'=>10 );
      $chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"000000", 'alpha'=>50 );
      $chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>-30, 'width'=>10, 'height'=>10,'size'=>10, 'margin'=>5, 'fill_color'=>"000066", 'fill_alpha'=>0, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );
      $chart[ 'series_color' ] = array ( "4e627c", "c89341", "4c6b41" );
      
      }
         
         
    if ($tipo == 'sco12')
    {
       //tama�o flash
       $width = 0;
       $height = 0;
      
       $sco = Sco12Peer::retrieveByPk($idsco12);


       $c2 = new Criteria();
	     $c2->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
       $usuarios = new Usuario();
       $alumnos = $usuarios->getAlumnos($idcurso, $c2);

       $arrayAlumnos[0] = "";
	     $arrayTiempos[0] = "tiempo (minutos)";

	     $i = 1;
	     foreach ($alumnos as $alumno)
	     { 
         $arrayAlumnos[$i] = $alumno->getUsuario()->getApellidos()." ".$alumno->getUsuario()->getNombre();
         $temp = $sco->getRelacionAlumno($alumno->getUsuario()->getId());
         if ($temp)
         {
           $arrayTiempos[$i++] = floor($temp->getTiempoTotal() / 60);
         }
	       else
	       {
           $arrayTiempos[$i++] = 0;
         }
	     }

       $numeroAlumnos = $curso->getNumeroAlumnos();  //para saber el tama�o de la grafica
       $tamanioEjeY = $numeroAlumnos * 20; // 20 px por alumno*/

       //         -----codigo para pruebas con muchos alumnos -----
       /*$numeroAlumnos = 220;
       $tamanioEjeY = $numeroAlumnos * 20;
			 $arrayAlumnos[1] = "primero";
	     $arrayTiempos[1] = 23;
	     $nombres = array ('Luis','Antonio','Cesar','Maria Antonia','Luisa','Ana Maria','Jose Luis','Jose Maria','Alvaro','Jaime','Marta','Eva','Beatriz','Manuel','Manolo','Ramon Alejandrin','Alejandro','Esperanza','Patricia','Maria Jesus','Ianire','Lia','Irene','Juan','Francisco Javier');
	     $apellidos = array ('Sanchez','Gonzalez','Matinez','Verdasco','Sanz','Benito','Summers','De la Cruz','Guttierrez','Matesanz','Perez','Rodrigez','Sancho','Santamaria','Santas','Mansilla','Carrion','Taberner','Santalla','Reyes','Valdenebro','Cantero','De los dolores','Erranz','Cabeza');
       for($i=2;$i<=$numeroAlumnos-1;$i++)
       {
        $arrayAlumnos[$i] = $apellidos[rand(0, count($apellidos)-1 )]." ".$apellidos[rand(0, count($apellidos)-1 )].", ".$nombres[rand(0, count($nombres)-1 )]." ".$i;
	      $arrayTiempos[$i] = rand ( 0, 999 );
       }
       $arrayAlumnos[$numeroAlumnos] = "ultimo";
	     $arrayTiempos[$numeroAlumnos] = 50;*/

			$chart[ 'axis_category' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ff8844", 'alpha'=>50, 'skip'=>0 );
			$chart[ 'axis_ticks' ] = array ( 'value_ticks'=>true, 'category_ticks'=>true, 'major_thickness'=>2, 'minor_thickness'=>1, 'minor_count'=>1, 'major_color'=>"222222", 'minor_color'=>"222222" ,'position'=>"centered" );
			$chart[ 'axis_value' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ffffff", 'alpha'=>30, 'steps'=>6, 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'show_min'=>true );

			$chart[ 'chart_border' ] = array ( 'color'=>"000000", 'top_thickness'=>1, 'bottom_thickness'=>1, 'left_thickness'=>3, 'right_thickness'=>1 );
			//$chart[ 'chart_data' ] = array ( array ( "", "2005", "2006", "2007" ),  array ( "region A", -25, 45, 100 ), array ( "region B", -35, 65, 80 ), array ( "region C", 10, 30, 55 ) );
			$chart[ 'chart_data' ] = array ($arrayAlumnos,   $arrayTiempos );
			$chart[ 'chart_grid_h' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1, 'type'=>"dashed" );
			$chart[ 'chart_grid_v' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1 );
			$chart[ 'chart_rect' ] = array ( 'x'=>200, 'y'=>0, 'width'=> 490, 'height'=>$tamanioEjeY, 'positive_color'=>"ffffff", 'negative_color'=>"ff0000", 'positive_alpha'=>35, 'negative_alpha'=>10 );
			$chart[ 'chart_transition' ] = array ( 'type'=>"scale", 'delay'=>.1, 'duration'=>.1, 'order'=>"category" );
			$chart[ 'chart_type' ] = "bar";
			$chart[ 'chart_value' ] = array ( 'color'=>"ff8844", 'alpha'=>50, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'position'=>"center", 'prefix'=>"", 'suffix'=>" minutos", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>false );

      if ($numeroAlumnos>=5)
      {
         	$sizeAlumnos = 15;
      }else $sizeAlumnos = 0;

			$chart[ 'draw' ] = array ( array ( 'type'=>"text", 'color'=>"eeeeff", 'alpha'=>35, 'size'=>10, 'x'=>-300, 'y'=>$height, 'width'=>50, 'height'=>50, 'text'=>"growth", 'h_align'=>"left", 'v_align'=>"bottom" ),
            			               array ( 'type'=>"text", 'color'=>"000044", 'alpha'=>35, 'rotation'=>90, 'size'=>$sizeAlumnos, 'x'=>350, 'y'=>0, 'width'=>500, 'height'=>350, 'text'=>"a l u m n o s", 'h_align'=>"left", 'v_align'=>"bottom" ) );

			//$chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>0, 'width'=>10, 'height'=>10 );
			$chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"000000", 'alpha'=>50 );
		  $chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>-30, 'width'=>10, 'height'=>10,'size'=>10, 'margin'=>5, 'fill_color'=>"000066", 'fill_alpha'=>0, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );
			$chart[ 'series_color' ] = array ( "4e627c", "c89341", "4c6b41" );

    }

    $xml = $sfSwfChart->convertArray($chart);
    $this->setLayout(false);
    $this->getContext()->getResponse()->setContent($xml);

    return sfView::NONE;
  }

  // Nombre del m�todo: executeSourceHitos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: - Muestra los hitos logrados por un alumno (comienzo/fin tema)
                  - si la llamada a este metodo no es por ajax, se carga el template, y se vuelve a llamar al metodo con ajax
                    de este forma aparece un aviso de cargando datos (puede tardar un poco si el curso es muy largo y tiene muchos alumnos)
                  - desde frontend_dev puede haber desbordamiento de memoria (si el curso es muy largo y tiene muchos alumnos)

   */
  public function executeSourceHitos()
  {
    if ($this->getRequestParameter('idcurso'))
    {
      $this->idcurso = $this->getRequestParameter('idcurso');
      $curso = CursoPeer::retrieveByPk($this->idcurso);
 	    $this->forward404Unless($curso);
      $this->getUser()->comprobarPermiso($this->idcurso);
 	  }

    if ($this->getRequestParameter('idusuario'))
    {
       $this->idusuario = $this->getRequestParameter('idusuario');
    	 $usuario = UsuarioPeer::retrieveByPk($this->idusuario);
 	     $this->forward404Unless($usuario);
		 }

  	if (!$this->getRequest()->isXmlHttpRequest()) // si no viene de peticion ajax
 	  { return; 	 }

    $this->ajax="si";
    $c2 = new Criteria();
    $usuarios = new Usuario();

    if ( $this->getUser()->hasCredential('alumno') )
    {
      // para que los alumnos solo puedan ver sus tiempos
    	$c2->add(UsuarioPeer::ID,$this->getUser()->getAnyId());
	  }else { if ($this->getRequestParameter('idusuario'))
            {
	          	$c2->add(UsuarioPeer::ID,$this->getRequestParameter('idusuario'));
	          }else  $c2->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);}

    $this->alumnos = $usuarios->getAlumnos($this->idcurso,$c2);


    $c = new sfEventCalendar('month', date("Y-m-d"));
    //dateDiff( string $day1, string $month1, string $year1, string $day2, string $month2, string $year2)
    $numeroDiasCurso = $c->getCalendar()->dateDiff($curso->getFechaInicio("d"),$curso->getFechaInicio("m"),$curso->getFechaInicio("Y"),
					 			                                   $curso->getFechaFin("d"),$curso->getFechaFin("m"),$curso->getFechaFin("Y"));

    if (63>$numeroDiasCurso)
	  { //2 meses
      $this->periodo="Semana";
    }else $this->periodo="Quincena";

	  $dia = (int) $curso->getFechaInicio("d");
    $mes = $curso->getFechaInicio("m");
    $anio = $curso->getFechaInicio("Y");

    $compFechas = $c->getCalendar()->compareDates("01",$mes,$anio,$curso->getFechaFin("d"),$curso->getFechaFin("m"),$curso->getFechaFin("Y"));
    //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
    ////de aqui
    $i=0;
    while( (-1==$compFechas)  || (0==$compFechas) )
  	{ $finMes = false;
	    $ultimoDiaMes=$c->getCalendar()->daysInMonth($mes,$anio);
      if ("Semana"==$this->periodo)
      {
          switch($dia){
                     case ($dia<7) :  $diaFin ="07" ;
                                      $diaSig = 8;
                                      break;
                     case ($dia<14) : $diaFin ="14" ;
                                      $diaSig = 15;
                                      break;
                     case ($dia<22) : $diaFin ="22" ;
                                      $diaSig = 23;
                                      break;
                     case ($dia<29) :  if ($ultimoDiaMes<=28)
                                       {
                                          $diaFin = $ultimoDiaMes;
                                  	  	  $diaSig = 1;
                                          $finMes = true;
                                  	   }else{ $diaFin ="29" ;
                                  	          $diaSig = 30;
                                  	        }
                     case ($dia<31) :  $diaFin = $ultimoDiaMes;
                                  	   $diaSig = 1;
                                       $finMes = true;
                                       break;
                     default: break                  ;
                   } // switch

	     }else {
	               switch($dia){
                     case ($dia<15) : $diaFin ="15" ;
                                      $diaSig = 16;
                                      break;
                     case ($dia<=31) :    $diaFin = $ultimoDiaMes;
                                  	  	  $diaSig = 1;
                                          $finMes = true;
                     default:         break;
                   } // switch
	            }

             if ($dia<10)
             {
               $arrayFechas[$i][0]= "0".$dia."-".$mes."-".$anio;
             }else  $arrayFechas[$i][0]= $dia."-".$mes."-".$anio;

             if ( ($curso->getFechaFin("d")<=$diaFin) && ($curso->getFechaFin("m")==$mes) && ($curso->getFechaFin("Y")==$anio))
             {  $arrayFechas[$i++][1]=$curso->getFechaFin("d")."-".$mes."-".$anio;
                break;
             }

            $arrayFechas[$i++][1]=$diaFin."-".$mes."-".$anio;
            $dia = $diaSig;
            if ($finMes)
            {   $compFechas = $c->getCalendar()->compareDates("01",$c->getCalendar()->NextDay($ultimoDiaMes, $mes, $anio, '%m'),$c->getCalendar()->NextDay($ultimoDiaMes, $mes, $anio, '%Y'),
	                                                                                           $curso->getFechaFin("d"),$curso->getFechaFin("m"),$curso->getFechaFin("Y"));

                $mesAux = $c->getCalendar()->NextDay($ultimoDiaMes, $mes, $anio, '%m');
                $anioAux = $c->getCalendar()->NextDay($ultimoDiaMes, $mes, $anio, '%Y');
                $mes = $mesAux;
                $anio = $anioAux;
            }


  	}


   $this->fechas = $arrayFechas;
   $this->c = $c;
  }

  public function executeDudas()
  {
    $idcurso = $this->getRequestParameter('idcurso');
    $this->curso = CursoPeer::retrieveByPk($idcurso);
    $this->forward404Unless($this->curso);

    $dudas = $this->curso->numeroDudas();
    $width = 650;
    $height = 380;

    $arraydudas = array("","teoria","ejercicio","planificacion","tutoria","otros");
    $arraydatos = array("dudas",$dudas[0],$dudas[1],$dudas[2],$dudas[3],$dudas[4]);

    $sfSwfChart = new sfSwfChart();

    $chart[ 'axis_category' ] = array ( 'size'=>12, 'color'=>"000000", 'alpha'=>50, 'font'=>"arial", 'bold'=>true, 'skip'=>0 ,'orientation'=>"horizontal" );
	  $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>false, 'category_ticks'=>false );
	  $chart[ 'axis_value' ] = array ( 'alpha'=>0 );

	  $chart[ 'chart_border' ] = array ( 'top_thickness'=>0, 'bottom_thickness'=>0, 'left_thickness'=>0, 'right_thickness'=>0 );
  	$chart[ 'chart_data' ] = array ( $arraydudas,$arraydatos );
  	$chart[ 'chart_grid_h' ] = array ( 'thickness'=>0 );
  	$chart[ 'chart_pref' ] = array ( 'rotation_x'=>15, 'rotation_y'=>30 );
  	$chart[ 'chart_rect' ] = array ( 'x'=>-60, 'y'=>30, 'width'=>$width, 'height'=>$height , 'positive_alpha'=>0, 'negative_alpha'=>25 );
  	$chart[ 'chart_type' ] = "3d column" ;
  	$chart[ 'chart_value' ] = array ( 'hide_zero'=>true, 'color'=>"000000", 'alpha'=>80, 'size'=>10, 'position'=>"over", 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>true );

  	$chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'font'=>"arial", 'bold'=>true, 'size'=>12, 'color'=>"000000", 'alpha'=>50 );
  	$chart[ 'legend_rect' ] = array ( 'x'=>50, 'y'=>35, 'width'=>100, 'height'=>40, 'margin'=>5, 'fill_color'=>"000066", 'fill_alpha'=>0, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );

  	$chart[ 'series_color' ] = array ("768bb3" );
  	$chart[ 'series_gap' ] = array ( 'bar_gap'=>10, 'set_gap'=>20) ;

  	$xml = $sfSwfChart->convertArray($chart);
    $this->setLayout(false);
    $this->getContext()->getResponse()->setContent($xml);

    return sfView::NONE;
  }

  // Nombre del m�todo: executeSeguimientoMensajes()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Muestra el porcentaje de los mensajes respondidos
   */
  public function executeMensajes()
  {
     $idusuario = $this->getRequestParameter('idusuario');
	   $this->usuario =UsuarioPeer::retrieveByPk($idusuario);

     $c = new Criteria();
     $c->add(Seguimiento_mensajePeer::ID_PROFESOR, $idusuario);
     $this->mensajesTotales = Seguimiento_mensajePeer::doCount($c);

     $c = new Criteria();
	   $c->add(Seguimiento_mensajePeer::ID_PROFESOR, $idusuario);
	   $c->add(Seguimiento_mensajePeer::FECHA_RESPUESTA,NULL, Criteria::NOT_EQUAL  );
	   $c->add(Seguimiento_mensajePeer::CREATED_AT, NULL, Criteria::NOT_EQUAL  );
     $mensajes =  Seguimiento_mensajePeer::doSelect($c);

     $cont=1;
     $tiempo=0;
     foreach ($mensajes as $mensaje)
     {
         $tiempo += $mensaje->getFechaRespuesta("U")-$mensaje->getCreatedAt("U");
         $cont++;
	   }
     $this->tiempoMedio= ($tiempo / $cont) / (24*60*60); //tiempo medio en dias

     $width = 320;
     $height = 275;

     $arraydudas = array("","tiempo medio");
     $arraydatos = array("dias", $this->tiempoMedio);

     $sfSwfChart = new sfSwfChart();
     $chart[ 'axis_category' ] = array ( 'size'=>12, 'color'=>"000000", 'alpha'=>50, 'font'=>"arial", 'bold'=>true, 'skip'=>0 ,'orientation'=>"horizontal" );
  	 $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>false, 'category_ticks'=>false );
  	 $chart[ 'axis_value' ] = array ( 'alpha'=>0 );

  	 $chart[ 'chart_border' ] = array ( 'top_thickness'=>0, 'bottom_thickness'=>0, 'left_thickness'=>0, 'right_thickness'=>0 );
     $chart[ 'chart_data' ] = array ( $arraydudas,$arraydatos );
     $chart[ 'chart_grid_h' ] = array ( 'thickness'=>0 );
     $chart[ 'chart_pref' ] = array ( 'rotation_x'=>15, 'rotation_y'=>30 );
     $chart[ 'chart_rect' ] = array ( 'x'=>-60, 'y'=>30, 'width'=>$width, 'height'=>$height , 'positive_alpha'=>0, 'negative_alpha'=>25 );
     $chart[ 'chart_type' ] = "3d column" ;
     $chart[ 'chart_value' ] = array ( 'hide_zero'=>true, 'color'=>"000000", 'alpha'=>80, 'size'=>10, 'position'=>"over", 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>true );

     $chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'font'=>"arial", 'bold'=>true, 'size'=>12, 'color'=>"000000", 'alpha'=>50 );
     $chart[ 'legend_rect' ] = array ( 'x'=>50, 'y'=>35, 'width'=>100, 'height'=>40, 'margin'=>5, 'fill_color'=>"000066", 'fill_alpha'=>0, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );

     $chart[ 'series_color' ] = array ("768bb3" );
     $chart[ 'series_gap' ] = array ( 'bar_gap'=>10, 'set_gap'=>20) ;

     $xml = $sfSwfChart->convertArray($chart);
     $this->getContext()->getResponse()->setContent($xml);

     $this->setLayout(false);

     return sfView::NONE;
  }

  // Nombre del m�todo: executeAlumnoVStareas()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Muestra la grafica Alumno VS tareas
   */
  public function executeAlumnoVStareas()
  {
    if ($this->getRequestParameter('datos'))
    {
      $datos = $this->getRequestParameter('datos');
		  $parametros = explode("@", $datos);
		  foreach ($parametros as $parametro)
		  {
          $parametrosAux = explode("=", $parametro);
		      ${$parametrosAux[0]} = $parametrosAux[1];
      }

      $curso = CursoPeer::retrieveByPk($idcurso);
 	    $this->forward404Unless($curso);

 	    $usuario = UsuarioPeer::retrieveByPk($idusuario);
 	    $this->forward404Unless($usuario);

 	    $width = 650;
      $height = 380;

      $sfSwfChart = new sfSwfChart();

      $arrayTareas[0] = "";
      $arrayDatos[0] = "";

      $tareas = $usuario->getTareasCorregidas($idcurso);
      $numtareas = count($tareas);
      foreach($tareas as $tarea)
      {
         $arrayTareas[] = $tarea->getEjercicio()->getTitulo();
         $arrayDatos[] =$usuario->getNotaTarea($tarea->getId());
      }

 	    $chart[ 'axis_category' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ff8844", 'alpha'=>50, 'skip'=>0 );
      $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>true, 'category_ticks'=>true, 'major_thickness'=>2, 'minor_thickness'=>1, 'minor_count'=>1, 'major_color'=>"222222", 'minor_color'=>"222222" ,'position'=>"centered" );
      $chart[ 'axis_value' ] = array ('min'=>0,'max'=>10, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"000000", 'alpha'=>30, 'steps'=>10, 'prefix'=>"", 'suffix'=>"", 'decimals'=>2, 'separator'=>"", 'show_min'=>true );

      $chart[ 'chart_border' ] = array ( 'color'=>"000000", 'top_thickness'=>1, 'bottom_thickness'=>1, 'left_thickness'=>3, 'right_thickness'=>1 );
      $chart[ 'chart_data' ] = array ($arrayTareas,   $arrayDatos );

      $chart[ 'chart_grid_h' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1, 'type'=>"dashed" );
      $chart[ 'chart_grid_v' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1 );
      $chart[ 'chart_rect' ] = array ( 'x'=>200, 'y'=>0, 'width'=> 490, 'height'=>20*$numtareas, 'positive_color'=>"ffffff", 'negative_color'=>"ff0000", 'positive_alpha'=>35, 'negative_alpha'=>10 );
      $chart[ 'chart_transition' ] = array ( 'type'=>"scale", 'delay'=>.1, 'duration'=>.1, 'order'=>"category" );
      $chart[ 'chart_type' ] = "bar";
      $chart[ 'chart_value' ] = array ( 'color'=>"000000", 'alpha'=>50, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'position'=>"center", 'prefix'=>"", 'suffix'=>" puntos", 'decimals'=>2, 'separator'=>"", 'as_percentage'=>false );

      $chart[ 'draw' ] = array ( array ( 'type'=>"text", 'color'=>"eeeeff", 'alpha'=>35, 'size'=>10, 'x'=>-300, 'y'=>$height, 'width'=>50, 'height'=>50, 'text'=>"growth", 'h_align'=>"left", 'v_align'=>"bottom" ),
                      			               array ( 'type'=>"text", 'color'=>"000044", 'alpha'=>35, 'rotation'=>90, 'size'=>15, 'x'=>350, 'y'=>0, 'width'=>500, 'height'=>350, 'text'=>"alumno VS tareas", 'h_align'=>"left", 'v_align'=>"bottom" ) );

      //$chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>0, 'width'=>10, 'height'=>10 );
      $chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"000000", 'alpha'=>50 );
      $chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>-30, 'width'=>10, 'height'=>10,'size'=>100, 'margin'=>5, 'fill_color'=>"000066", 'fill_alpha'=>0, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );
      $chart[ 'series_color' ] = array ("768bb3" );

      $xml = $sfSwfChart->convertArray($chart);
      $this->setLayout(false);
      $this->getContext()->getResponse()->setContent($xml);

      return sfView::NONE;
		}
  }

  // Nombre del m�todo: executeTareaVSalumnos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Muestra la grafica Alumno VS tareas
   */
  public function executeTareaVSalumnos()
  {
    if ($this->getRequestParameter('datos'))
    {
      $datos = $this->getRequestParameter('datos');
		  $parametros = explode("@", $datos);
		  foreach ($parametros as $parametro)
		    {
          $parametrosAux = explode("=", $parametro);
		      ${$parametrosAux[0]} = $parametrosAux[1];
        }

      $curso = CursoPeer::retrieveByPk($idcurso);
 	    $this->forward404Unless($curso);

 	    $tarea = TareaPeer::retrieveByPk($idtarea);
 	    $this->forward404Unless($tarea);

 	    $width = 650;
      $height = 380;

      $sfSwfChart = new sfSwfChart();

      $arrayTareas[0] = "";
      $arrayDatos[0] = "";

      $usuarios = $tarea->getEntregas($idcurso);
      $numusuarios = count($usuarios);
      foreach($usuarios as $usuario)
      {
         $arrayTareas[] = $usuario->getApellidos().', '.$usuario->getNombre();
         $arrayDatos[] =  $usuario->getNotaTarea($idtarea);
      }

 	    $chart[ 'axis_category' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ff8844", 'alpha'=>50, 'skip'=>0 );
      $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>true, 'category_ticks'=>true, 'major_thickness'=>2, 'minor_thickness'=>1, 'minor_count'=>1, 'major_color'=>"222222", 'minor_color'=>"222222" ,'position'=>"centered" );
      $chart[ 'axis_value' ] = array ('min'=>0,'max'=>10, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"000000", 'alpha'=>30, 'steps'=>10, 'prefix'=>"", 'suffix'=>"", 'decimals'=>2, 'separator'=>"", 'show_min'=>true );

      $chart[ 'chart_border' ] = array ( 'color'=>"000000", 'top_thickness'=>1, 'bottom_thickness'=>1, 'left_thickness'=>3, 'right_thickness'=>1 );
      $chart[ 'chart_data' ] = array ($arrayTareas,   $arrayDatos );

      $chart[ 'chart_grid_h' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1, 'type'=>"dashed" );
      $chart[ 'chart_grid_v' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1 );
      $chart[ 'chart_rect' ] = array ( 'x'=>200, 'y'=>0, 'width'=> 490, 'height'=>20*$numusuarios, 'positive_color'=>"ffffff", 'negative_color'=>"ff0000", 'positive_alpha'=>35, 'negative_alpha'=>10 );
      $chart[ 'chart_transition' ] = array ( 'type'=>"scale", 'delay'=>.1, 'duration'=>.1, 'order'=>"category" );
      $chart[ 'chart_type' ] = "bar";
      $chart[ 'chart_value' ] = array ( 'color'=>"000000", 'alpha'=>50, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'position'=>"center", 'prefix'=>"", 'suffix'=>" puntos", 'decimals'=>2, 'separator'=>"", 'as_percentage'=>false );

      $chart[ 'draw' ] = array ( array ( 'type'=>"text", 'color'=>"eeeeff", 'alpha'=>35, 'size'=>10, 'x'=>-300, 'y'=>200, 'width'=>50, 'height'=>50, 'text'=>"growth", 'h_align'=>"left", 'v_align'=>"bottom" ),
                      			               array ( 'type'=>"text", 'color'=>"000044", 'alpha'=>35, 'rotation'=>90, 'size'=>15, 'x'=>350, 'y'=>0, 'width'=>500, 'height'=>350, 'text'=>"alumno VS tareas", 'h_align'=>"left", 'v_align'=>"bottom" ) );

      //$chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>0, 'width'=>10, 'height'=>10 );
      $chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"000000", 'alpha'=>50 );
      $chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>-30, 'width'=>10, 'height'=>10,'size'=>100, 'margin'=>5, 'fill_color'=>"000066", 'fill_alpha'=>0, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );
      $chart[ 'series_color' ] = array ("768bb3" );

      $xml = $sfSwfChart->convertArray($chart);
      $this->setLayout(false);
      $this->getContext()->getResponse()->setContent($xml);

      return sfView::NONE;
		}
  }


  // Nombre del m�todo: executeSeguimientoMensajesTiempos()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Muestra el porcentaje de los mensajes respondidos
   */
  public function executeMensajesTiempos()
  {
     $idusuario = $this->getRequestParameter('idusuario');
	   $this->usuario =UsuarioPeer::retrieveByPk($idusuario);

     $c = new Criteria();
     $c->add(Seguimiento_mensajePeer::ID_PROFESOR, $idusuario);
     $this->mensajesTotales =Seguimiento_mensajePeer::doCount($c);

     $c = new Criteria();
	   $c->add(Seguimiento_mensajePeer::ID_PROFESOR, $idusuario);
	   $c->add(Seguimiento_mensajePeer::FECHA_RESPUESTA, NULL );
     $this->mensajesContestados = $this->mensajesTotales - Seguimiento_mensajePeer::doCount($c);

      if (0!=$this->mensajesTotales)
      {
         $this->porcentaje = ((100 * $this->mensajesContestados) / $this->mensajesTotales);
      }
      else $this->porcentaje = "";

      $c = new Criteria();
	    $c->add(Seguimiento_mensajePeer::ID_PROFESOR, $idusuario);
	    $c->add(Seguimiento_mensajePeer::FECHA_RESPUESTA,NULL, Criteria::NOT_EQUAL  );
	    $c->add(Seguimiento_mensajePeer::CREATED_AT, NULL, Criteria::NOT_EQUAL  );
      $mensajes =  Seguimiento_mensajePeer::doSelect($c);

      $cont=1;
      $tiempo=0;
      foreach ($mensajes as $mensaje)
       {
         $tiempo += $mensaje->getFechaRespuesta("U")-$mensaje->getCreatedAt("U");
         $cont++;
		   }
  	  $this->tiempoMedio= $tiempo / $cont;

      $width = 650;
      $height = 400;

      $arraydudas = array("","Recibidos","contestados","tiempo_medio");
      $arraydatos = array("mensajes",$this->mensajesTotales,$this->mensajesContestados, $this->tiempoMedio);

      $sfSwfChart = new sfSwfChart();

      $chart2[ 'chart_data' ] = array ( array ( "", "No Contestados","Contestados"), array ( "", $this->mensajesTotales-$this->mensajesContestados,$this->mensajesContestados ) );
      $chart2[ 'chart_pref' ] = array ( 'rotation_x'=>60 );
      $chart2[ 'chart_rect' ] = array ( 'x'=>100, 'y'=>150, 'width'=>130, 'height'=>130, 'positive_alpha'=>0 );
      $chart2[ 'chart_transition' ] = array ( 'type'=>"dissolve", 'delay'=>.1, 'duration'=>.3, 'order'=>"category" );
      $chart2[ 'chart_type' ] = "3d pie";
      $chart2[ 'chart_value' ] = array ( 'as_percentage'=>true, 'size'=>9, 'color'=>"ffffff", 'alpha'=>85 );

      $chart2[ 'legend_label' ] = array ( 'layout'=>"vertical", 'bullet'=>"circle", 'size'=>11, 'color'=>"000000", 'alpha'=>85 );
      $chart2[ 'legend_rect' ] = array ( 'x'=>20, 'y'=>150, 'width'=>20, 'height'=>40, 'fill_alpha'=>0 );

      $chart2[ 'series_color' ] = array ( "cc6600", "aaaa22", "8800dd", "666666", "4488aa" );
      $chart2[ 'series_explode' ] = array ( 0, 50 );

    	$xml = $sfSwfChart->convertArray($chart2);
      $this->getContext()->getResponse()->setContent($xml);

      $this->setLayout(false);

      return sfView::NONE;
  }

  // Nombre del m�todo: executeNumeroMensajes()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Muestra el nuemero de mensajes contestados/no contestados
   */
  public function executeNumeroMensajes()
  {
     $idusuario = $this->getRequestParameter('idusuario');
	   $this->usuario =UsuarioPeer::retrieveByPk($idusuario);

     $c = new Criteria();
     $c->add(Seguimiento_mensajePeer::ID_PROFESOR, $idusuario);
     $this->mensajesTotales =Seguimiento_mensajePeer::doCount($c);

     $c = new Criteria();
	   $c->add(Seguimiento_mensajePeer::ID_PROFESOR, $idusuario);
	   $c->add(Seguimiento_mensajePeer::FECHA_RESPUESTA, NULL );
     $this->mensajesContestados = $this->mensajesTotales - Seguimiento_mensajePeer::doCount($c);
     $this->mensajesNoContestados = $this->mensajesTotales - $this->mensajesContestados;

      $width = 650;
      $height = 200;

      $arrayLeyenda = array("","Recibidos","contestados","NO contestados");
      $arraydatos = array("mensajes",$this->mensajesTotales,$this->mensajesContestados,$this->mensajesNoContestados);

      $sfSwfChart = new sfSwfChart();

			$chart[ 'axis_category' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ff8844", 'alpha'=>50, 'skip'=>0 );
      $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>true, 'category_ticks'=>true, 'major_thickness'=>2, 'minor_thickness'=>1, 'minor_count'=>1, 'major_color'=>"222222", 'minor_color'=>"222222" ,'position'=>"centered" );
      $chart[ 'axis_value' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"ffffff", 'alpha'=>30, 'steps'=>6, 'prefix'=>"", 'suffix'=>"", 'decimals'=>0, 'separator'=>"", 'show_min'=>true );

      $chart[ 'chart_border' ] = array ( 'color'=>"000000", 'top_thickness'=>1, 'bottom_thickness'=>1, 'left_thickness'=>3, 'right_thickness'=>1 );
      $chart[ 'chart_data' ] = array ( array ( "", "Mensajes" ), array ( "No contestados", $this->mensajesNoContestados), array ( "Contestados", $this->mensajesContestados),  array ( "Recibidos", $this->mensajesTotales ));

			$chart[ 'chart_grid_h' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1, 'type'=>"dashed" );
			$chart[ 'chart_grid_v' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1 );
			$chart[ 'chart_rect' ] = array ( 'x'=>200, 'y'=>0, 'width'=> 490, 'height'=>100, 'positive_color'=>"ffffff", 'negative_color'=>"ff0000", 'positive_alpha'=>35, 'negative_alpha'=>10 );
			$chart[ 'chart_transition' ] = array ( 'type'=>"scale", 'delay'=>.1, 'duration'=>.1, 'order'=>"category" );
			$chart[ 'chart_type' ] = "bar";
			$chart[ 'chart_value' ] = array ( 'color'=>"000000", 'alpha'=>50, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'position'=>"center", 'prefix'=>"", 'suffix'=>" mensajes", 'decimals'=>0, 'separator'=>"", 'as_percentage'=>false );

			$chart[ 'draw' ] = array ( array ( 'type'=>"text", 'color'=>"eeeeff", 'alpha'=>35, 'size'=>10, 'x'=>-300, 'y'=>100, 'width'=>50, 'height'=>50, 'text'=>"growth", 'h_align'=>"left", 'v_align'=>"bottom" ),
            			               array ( 'type'=>"text", 'color'=>"000044", 'alpha'=>35, 'rotation'=>90, 'size'=>10, 'x'=>350, 'y'=>0, 'width'=>500, 'height'=>350, 'text'=>"m e n s a j e s", 'h_align'=>"left", 'v_align'=>"bottom" ) );

			$chart[ 'legend_label' ] = array ( 'layout'=>"vertical", 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"000000", 'alpha'=>50 );
		  $chart[ 'legend_rect' ] = array ( 'x'=>0, 'y'=>0, 'width'=>10, 'height'=>10,'size'=>10, 'margin'=>5, 'fill_color'=>"000066", 'fill_alpha'=>0, 'line_color'=>"000000", 'line_alpha'=>0, 'line_thickness'=>0 );
			$chart[ 'series_color' ] = array (   "cc6600", "aaaa22", "768bb3");//4c6b41

    	$xml = $sfSwfChart->convertArray($chart);
      $this->getContext()->getResponse()->setContent($xml);

      $this->setLayout(false);

      return sfView::NONE;
  }


  // Nombre del m�todo: executeEstadisticaCalificaciones()
  // A�adida por: �ngel Mart�n
  /* Descripci�n: - Muesta la pantalla principal de las estad�sticas por calificaciones
   */
  public function executeEstadisticaCalificaciones()
  {
    $display = 1;
    if ($this->hasRequestParameter('opcion'))
    {
      $display = $this->getRequestParameter('opcion');
    }
    if ($this->hasRequestParameter('idcurso'))
    {
      $idcurso = $this->getRequestParameter('idcurso');
      $curso = CursoPeer::retrieveByPk($idcurso);
      $this->forward404Unless($curso);
      $this->curso = $curso;
    }
    else
    {
      $this->forward404();
    }

    if ($display == 1)
    {
      $curso = CursoPeer::retrieveByPk($idcurso);
      $this->tareas = $curso->getTareas();
    }

    if ($display == 2)
    {
      $c = new Criteria();
      $c->add(RolPeer::NOMBRE, 'alumno');
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $idcurso);
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
      $this->alumnos = UsuarioPeer::DoSelect($c);
    }

    $this->display = $display;
    $this->id_curso = $idcurso;
  }


  // Nombre del m�todo: executeSeguimientoTareas()
  // A�adida por: �ngel Mart�n
  // Descripci�n: Eleccion de las tareas de los cursos
  public function executeSeguimientoTareas()
  {
    if ($this->hasRequestParameter('idcurso'))
    {
      $this->id_curso = $this->getRequestParameter('idcurso');
    }
    else
    {
      $this->id_curso = 0;
    }
    $cursos_temp = $this->getUser()->getCursosAny();
    $cursos = array();
    $cursos[0] = 'Todos los cursos';
    foreach($cursos_temp as $curso_temp) {
      $cursos[$curso_temp->getIdCurso()] = $curso_temp->getCurso()->getNombre();
    }
    $this->cursos = $cursos;
  }


  // Nombre del m�todo: ListarTareas()
  // A�adida por: �ngel Mart�n
  // Descripci�n: Listado de las tareas de los cursos
  public function executeListarTareas()
  {
    $id_profesor = $this->getUser()->getAnyId();
    $id_curso = $this->getRequestParameter('filtro');
    $c = new Criteria();

    if ($id_curso) {$c->add(EventoPeer::ID_CURSO, $id_curso);}

    $c->add(TareaPeer::ID_AUTOR, $id_profesor);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(EventoPeer::ID_CURSO, CursoPeer::ID);
    $c->addJoin(EventoPeer::ID_TIPO_EVENTO, Tipo_eventoPeer::ID);
    $c->addAscendingOrderByColumn(EventoPeer::FECHA_FIN);
    $this->eventos = EventoPeer::DoSelect($c);
    $this->tareas = TareaPeer::DoSelect($c);
    $this->cursos = CursoPeer::DoSelect($c);
    $this->tipos_evento = Tipo_eventoPeer::DoSelect($c);
  }

  // Nombre del m�todo: MostrarTarea()
  // A�adida por: �ngel Mart�n
  // Descripci�n: muestra los detalles de una tarea
  public function executeMostrarTarea()
  {
    $id_tarea = $this->getRequestParameter('id_tarea');
    if ($this->hasRequestParameter('eliminar')) {
      $id_usuario = $this->getRequestParameter('eliminar');
      $c = new Criteria();
      $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
      $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
      Rel_usuario_tareaPeer::DoDelete($c);
    }

    $tarea = TareaPeer::RetrieveByPk($id_tarea);
    $this->tarea = $tarea;
    $this->id_ejercicio = $tarea->getIdEjercicio();
    $evento = EventoPeer::RetrieveByPk($tarea->getIdEvento());
    $this->evento = $evento;
    $this->curso = CursoPeer::RetrieveByPk($evento->getIdCurso());
    $this->tipo_evento = Tipo_eventoPeer::RetrieveByPk($evento->getIdTipoEvento());
    $this->ahora = time();
    $this->inicio = $evento->getFechaInicio('U');
    $this->fin = $evento->getFechaFin('U');
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_tareaPeer::ID_USUARIO);
    $c->addAsColumn('nombre', UsuarioPeer::NOMBRE);
    $c->addAsColumn('apellidos', UsuarioPeer::APELLIDOS);
    $c->addAsColumn('solucion', Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO);
    $c->addAsColumn('entregada', Rel_usuario_tareaPeer::ENTREGADA);
    $c->addAsColumn('fecha_entrega', Rel_usuario_tareaPeer::FECHA_ENTREGA);
    $c->addAsColumn('id_usuario', UsuarioPeer::ID);
    $this->elementos_lista = BasePeer::DoSelect($c);
    $implicados = 0;
    foreach ($this->elementos_lista as $elemento) {$implicados++;}
    $c2 = new Criteria();
    $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $tarea->getIdCurso());
    $c2->add(RolPeer::NOMBRE, 'alumno');
    $c2->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $totales = Rel_usuario_rol_cursoPeer::DoCount($c2);
    if ($implicados < $totales) {$this->add_more = true;}
    else {$this->add_more = false;}
  }

  // Nombre del m�todo: executeSeguimientoTemas()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: mostrara las fechas previstas para terminar los temas, desde aqui se podra modificar las fechas
  */
  public function executeSeguimientoTemas()
  {
   if (!$this->getUser()->hasCredential('profesor') )
   {
        	return $this->redirect('login/logout');
   }

   if ($this->getRequestParameter('idcurso'))
   {
      $this->idcurso =  	$this->getRequestParameter('idcurso');
      $profesor = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
      $this->forward404Unless($profesor);
	  	if ($profesor->esProfesor($this->idcurso))
      {
		    $this->curso = CursoPeer::retrieveByPk($this->idcurso);
			  $this->forward404Unless($this->curso);
		    $this->temas = $this->curso->getTemas();
		  }else return $this->redirect('login/logout');
   }else return $this->redirect('login/logout');
 }

  // Nombre del m�todo: validateModificarFechaTema()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Valida el formulario de nuevo evento
  				  Se mostrara en capa mediante AJAX*/
  public function validateModificarFechaTema()
  {
   	$ok = true ;
   	if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
    		$fechaFin = $this->getRequestParameter('fechaFin');

     		$this->idcurso =  	$this->getRequestParameter('idcurso');
        $this->curso = CursoPeer::retrieveByPk($this->idcurso);

        $profesor = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
        $this->forward404Unless($profesor);
        $this->idtema =  $this->getRequestParameter('idtema');

        $c = new sfEventCalendar('month', date("Y-m-d"));
        if (! $fechaFin)
  	    { $this->getRequest()->setError('fechaFin', 'Debe indicar la fecha fin del Evento');
      	  $ok = false ;
  	    }else { list($diaFin,$mesFin, $anioFin) = split("[-]", $fechaFin);

  	            $compFechas = $c->getCalendar()->compareDates($diaFin,$mesFin,$anioFin,
  							                         $this->curso->getFechaInicio("d"),$this->curso->getFechaInicio("m"),$this->curso->getFechaInicio("Y"));

      	         //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
      	          if (-1==$compFechas)
                  {
      		           $this->getRequest()->setError('fechas', 'La fecha debe ser mayor que la de inicio del curso');
      		           $ok = false;
      	           }

                  $compFechas = $c->getCalendar()->compareDates($diaFin,$mesFin,$anioFin,
  					                                                     $this->curso->getFechaFin("d"),$this->curso->getFechaFin("m"),$this->curso->getFechaFin("Y"));

      	           //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
      	           if (1==$compFechas)
                   {
      		              $this->getRequest()->setError('fechas', 'La fecha debe ser menor que la fecha de fin del curso');
      		              $ok = false;
      	           }
                }
    }
     return $ok;
  }


  // Nombre del m�todo: executeModificarFechaTema()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: modifica las fechas previstas para terminar los temas
  */
  public function executeModificarFechaTema()
  {
   if (!$this->getUser()->hasCredential('profesor') )
   {
        	//return $this->redirect('login/logout');
    }

    if ($this->getRequestParameter('idcurso'))
    {
        $this->idcurso =  	$this->getRequestParameter('idcurso');
        $this->curso = CursoPeer::retrieveByPk($this->idcurso);
        $profesor = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
        $this->forward404Unless($profesor);

        $this->idtema =  $this->getRequestParameter('idtema');
        $this->tema = TemaPeer::retrieveByPk($this->idtema);
        $this->forward404Unless($this->tema);

        if ($profesor->imparte($this->idcurso,$this->idtema))
        {
            $c = new Criteria();
            $c->add(Rel_curso_temaPeer::ID_CURSO,$this->idcurso);
            $c->add(Rel_curso_temaPeer::ID_TEMA,$this->idtema);
            $this->temaCurso = Rel_curso_temaPeer::doSelectOne($c);
         }
        $this->temaCurso = Rel_curso_temaPeer::doSelectOne($c);
    }
    //else return $this->redirect('login/logout');

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
        $fechaFin = $this->getRequestParameter('fechaFin');
        list($diaFin,$mesFin, $anioFin) = split("[-]", $fechaFin);
        $fechaFin = $anioFin."-".$mesFin."-".$diaFin;

       	$con = Propel::getConnection();
  	    try
  		  {
    			$con->begin();

    			if ($this->temaCurso)
          {
    				$this->temaCurso->setFechaCompletado($fechaFin);
    			}
    			else{$this->temaCurso = new Rel_curso_tema();
    			     $this->temaCurso->setFechaCompletado($fechaFin);
    			     $this->temaCurso->setIdCurso($this->idcurso);
    			     $this->temaCurso->setIdTema($this->idtema);
				    }
    			 $this->temaCurso->save($con);
				 $con->commit();
  		  }
  	    catch (Exception $e)
  				{	$con->rollback();
  				    throw $e;
  				}

       	$this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
    }
  }


  // Nombre del m�todo: FichaEvaluacion()
  // A�adida por: �ngel Mart�n
  // Descripci�n: Muestra las calificaciones obtenidas en todos los ejercicios
  // del mismo curso, tiempo dedicado en ejercicios y revisar temario etc...
  //
  /* Modificado por Jacobo para que se calculo el tiempo total empleado en la teoria
     para cursos composica
  */
  public function executeFichaEvaluacion() {

    $id_curso = $this->getRequestParameter('idcurso');

    if ($this->getUser()->hasCredential('supervisor'))
    {
      $id_alumno = $this->getRequestParameter('idalumno');
    }else  $id_alumno = $this->getUser()->getAnyId();

    $this->alumno = UsuarioPeer::RetrieveByPk($id_alumno);
    $this->curso = CursoPeer::RetrieveByPk($id_curso);

    $c = new Criteria();
    $c->add(TareaPeer::ID_CURSO, $id_curso);
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_alumno);
    $c->add(EjercicioPeer::TIPO, 'test');
    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);
    $c->addJoin(TareaPeer::ID_EJERCICIO, EjercicioPeer::ID);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(Tipo_eventoPeer::ID, EventoPeer::ID_TIPO_EVENTO);
    $c->addAsColumn('id_tarea', TareaPeer::ID);
    $c->addAsColumn('ejercicio', EventoPeer::DESCRIPCION);
    $c->addAsColumn('categoria', Tipo_eventoPeer::DESCRIPCION);
    $c->addAsColumn('solucion', Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO);
    $c->addAsColumn('corregida', Rel_usuario_tareaPeer::CORREGIDA);
    $c->addAsColumn('entregada', Rel_usuario_tareaPeer::ENTREGADA);
    $c->addAsColumn('fecha_fin', EventoPeer::FECHA_FIN);
    $this->relacion_tests = BasePeer::DoSelect($c);

    $c->add(EjercicioPeer::TIPO, 'cuestionario');
    $this->relacion_cuestionarios = BasePeer::DoSelect($c);

    $c->add(EjercicioPeer::TIPO, 'problemas');
    $this->relacion_problemas = BasePeer::DoSelect($c);

    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $id_alumno);
    $c->add(Ejercicio_resueltoPeer::REPOSITORIO, 0);
    $c->add(CursoPeer::ID, $id_curso);
    $c->addJoin(EjercicioPeer::ID_MATERIA, CursoPeer::MATERIA_ID);
    $c->addJoin(EjercicioPeer::ID, Ejercicio_resueltoPeer::ID_EJERCICIO);
    $resultados = Ejercicio_resueltoPeer::DoSelect($c);
    $tiempo_tareas = 0;
    foreach ($resultados as $resultado)
    {
      $tiempo_tareas += $resultado->getTiempo();
    }

    $c->add(Ejercicio_resueltoPeer::REPOSITORIO, 1);
    $resultados = Ejercicio_resueltoPeer::DoSelect($c);
    $tiempo_repositorio = 0;
    foreach ($resultados as $resultado)
    {
      $tiempo_repositorio += $resultado->getTiempo();
    }

  if ($this->curso->getMateria()->getTipo() != 'segmentada')
  {
     $tiempo_estudio = $this->alumno->tiempoTotalTeoriaScorm($this->curso->getMateriaId());
  }
  else
  {
          $c = new Criteria();
          $c->add(CursoPeer::ID, $id_curso);
          $c->add(Rel_usuario_temaPeer::ID_USUARIO, $id_alumno);
          $c->addJoin(TemaPeer::ID_MATERIA, CursoPeer::MATERIA_ID);
          $c->addJoin(TemaPeer::ID, Rel_usuario_temaPeer::ID_TEMA);
          $resultados = Rel_usuario_temaPeer::DoSelect($c);
          $tiempo_estudio = 0;
          foreach ($resultados as $resultado)
          {
            $tiempo_estudio += $resultado->getTiempo();
          }
       }

    $this->tiempo_estudio = $tiempo_estudio;
    $this->tiempo_tareas = $tiempo_tareas;
    $this->tiempo_repositorio = $tiempo_repositorio;

    $c = new Criteria();
    $c->add(CalificacionesPeer::ID_USUARIO, $id_alumno);
    $c->add(CalificacionesPeer::ID_CURSO, $id_curso);
    $cal = CalificacionesPeer::DoSelectOne($c);
    if ($cal)
    {
      $this->nota = sprintf("%.2f", $cal->getScore());
    }
    else
    {
      $this->nota = 'No asignada';
    }

    $this->setLayout('PopUpEvaluacion');

  }

  public function executeSourceRanking()
  {
     $idmodulo = $this->getRequestParameter('idmodulo');
     $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
	   $this->forward404Unless($this->modulo);

	   $datos = $this->modulo->getRankingAlumnos(1);

	   $nombres[]="";
	   $nombresAux=array();
	   $sup[]="hi";
	   $inf[]="lo";
	   $colores=array();
	   $alumnos=0;

	   foreach($datos as $dato => $clave)
     {
         $nombres[]=$dato;
         $sup[]=$clave;
         $inf[]="";
         $colores[]="aaaa22";// "aaaa22", "768bb3"";
         $nombresAux="";
         $alumnos++;
      }
     $colores[$alumnos-1]="00bb66";  //primero
     $colores[0]="cc6600";  //ultimo

     $sfSwfChart = new sfSwfChart();

     $chart[ 'axis_category' ] = array ( 'font'=>"arial", 'bold'=>true, 'size'=>11, 'color'=>"000000", 'alpha'=>50, 'skip'=>0 );
     $chart[ 'axis_ticks' ] = array ( 'value_ticks'=>true, 'category_ticks'=>true, 'major_thickness'=>2, 'minor_thickness'=>1, 'minor_count'=>1, 'major_color'=>"222222", 'minor_color'=>"222222" ,'position'=>"centered" );
     $chart[ 'axis_value' ] = array ('min'=>0,'max'=>10, 'font'=>"arial", 'bold'=>true, 'size'=>10, 'color'=>"000000", 'alpha'=>30, 'steps'=>10, 'prefix'=>"", 'suffix'=>"", 'decimals'=>2, 'separator'=>"", 'show_min'=>true );

     $chart[ 'chart_border' ] = array ( 'color'=>"000000", 'top_thickness'=>1, 'bottom_thickness'=>1, 'left_thickness'=>3, 'right_thickness'=>1 );
     $chart[ 'chart_data' ] = array ( $nombres,//array ( "", "Bob", "Kim", "Joe", "Mark", "Sue" ),
                                           $sup,//array ( "hi", 24, 16, 16, 16, 8),
                                           $inf//array ( "lo", 16, 8, 8, 8, 0 )
                                           );
     $chart[ 'chart_grid_h' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1, 'type'=>"dashed" );
     $chart[ 'chart_grid_v' ] = array ( 'alpha'=>20, 'color'=>"000000", 'thickness'=>1 );
     $chart[ 'chart_rect' ] = array ( 'x'=>200, 'y'=>0, 'width'=> 490, 'height'=>20*$alumnos, 'positive_color'=>"ffffff", 'negative_color'=>"ff0000", 'positive_alpha'=>35, 'negative_alpha'=>10 );
     $chart[ 'chart_transition' ] = array ( 'type'=>"scale", 'delay'=>.1, 'duration'=>.1, 'order'=>"category" );
     $chart[ 'chart_type' ] = "floating bar";
     $chart[ 'chart_value' ] = array ( 'color'=>"FFFFFF", 'alpha'=>75, 'size'=>10, 'position'=>"inside", 'prefix'=>"", 'suffix'=>"", 'decimals'=>2, 'separator'=>"", 'as_percentage'=>false );
     $chart[ 'chart_value_text' ] = array ( $nombresAux,// ( "", "", "", "", "", "" ),
                                                 $sup,//array ( "", "12:00 am", "4:00 pm", "4:00 pm", "4:00 pm", "8:00 am"),
                                                 //array ( "", "4:00 pm", "8:00 am", "8:00 am", "8:00 am", "12:00 am" )
                                                 );

     $chart[ 'draw' ] = array ( array ( 'type'=>"text", 'transition'=>"none", 'delay'=>0, 'duration'=>1, 'color'=>"eeeeff", 'alpha'=>35, 'size'=>36, 'x'=>42, 'y'=>16, 'width'=>350, 'height'=>240, 'text'=>"" ) );
     $chart[ 'series_color' ] = $colores;
     $chart[ 'series_gap' ] = array ( 'set_gap'=>20, 'bar_gap'=>0 );
     $chart[ 'series_switch' ] = true;

   	 $xml = $sfSwfChart->convertArray($chart);
     $this->getContext()->getResponse()->setContent($xml);

     $this->setLayout(false);

     return sfView::NONE;
  }
}
