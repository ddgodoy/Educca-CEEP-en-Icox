<?php

/**
 * calendario actions.
 *
 * @package    edoceo
 * @subpackage calendario
 * @author     Jacobo
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class calendarioActions extends sfActions
{
  /**
   * Executes index action
   *
   */


  public function executeIndex()
  {
  }

   // Nombre del método:MostrarCalendarioAvisos()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Obtiene los eventos proximos la opcion de avisos de "mi escritorio"
   */
  public function executeMostrarCalendarioAvisos()
  {
    $result = $this->getUser()->getDiasConfCalendario();
  	$eventosProximos = $this->getUser()->getEventosDiasProximos(0,7);
    $eventosProximos = $this->getUser()->quitaEventosRepetidos($eventosProximos);
    if (count($eventosProximos)>3)
    {
    	$i=0;
    	$aux = array();
    	for ($i=0;$i<3;$i++)
    	{
        $aux[$i]= $eventosProximos[$i];
      }
		  $this->eventosProximos= $aux;
	   }else  $this->eventosProximos=  $eventosProximos;
  }



  // Nombre del método:MostrarCalendario()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Mediante la libreria sfEventCalendar creamos un calendario, y añadimos los eventos publicos y privados para el usuario
   */
  public function executeMostrarCalendario()
  {
    $meses["01"]='Enero';
    $meses["02"]='Febrero';
    $meses["03"]='Marzo';
    $meses["04"]='Abril';
    $meses["05"]='Mayo';
    $meses["06"]='Junio';
    $meses["07"]='Julio';
    $meses["08"]='Agosto';
    $meses["09"]='Septiembre';
    $meses["10"]='Octubre';
    $meses["11"]='Noviembre';
    $meses["12"]='Diciembre';


    if($this->getRequestParameter('fecha'))
    { $fecha = $this->getRequestParameter('fecha');
        $fechaBD = str_replace('/','-',$fecha);
	  }
	  else { $fecha = date("Y/").date("m/")."01";
	         $fechaBD = date("Y-").date("m-")."01";
	       }

    if( ($this->getRequestParameter('idcurso')) && (!$this->getRequestParameter('principal') ) )
    {
      $this->idcurso = $this->getRequestParameter('idcurso');
      $this->curso = CursoPeer::retrieveByPk($this->idcurso);
      $this->forward404Unless($this->curso);

      $this->getUser()->comprobarPermiso($this->idcurso);

      $result = $this->getUser()->getDiasConfCalendario($this->idcurso);
      $this->eventosProximos = $this->getUser()->getEventosDiasProximosCurso($this->idcurso,$result[0],$result[1]);
     }
     else{  $result = $this->getUser()->getDiasConfCalendario();
	          $this->eventosProximos = $this->getUser()->getEventosDiasProximos($result[0],$result[1]);
          }

     $this->eventosProximos = $this->getUser()->quitaEventosProximosRepetidos($this->eventosProximos);

     $c = new sfEventCalendar('month', $fecha); // The style of the calendar, any date within the specified time period

     $mes = substr($fecha,5,2);
     $anio = substr($fecha,0,4);

     $this->anterior = $c->getCalendar()->beginOfPrevMonth('1', $mes, $anio, '%Y-%m-%d');
     $this->siguiente = $c->getCalendar()->beginOfNextMonth('1', $mes, $anio, '%Y-%m-%d');
     $this->semana = $c->getCalendar()->weekOfYear();
     $this->anio = $anio;
     $this->nombreMes = $meses[$mes] ;
     if ($this->getRequestParameter('principal'))
     { //para saber si calendario princpal o de un curso (viene del enlace de menu)
      	$this->principal = $this->getRequestParameter('principal');
     }
  }


  // Nombre del método: VerEvento()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Muestra todos los eventos para un usuario en una determinada fecha tanto los privados como los publicos
   */
    public function executeVerEvento()
  {
    $fecha = $this->getRequestParameter('fecha');
    if ($this->getRequestParameter('idcurso'))
    {
    	$this->idcurso = $this->getRequestParameter('idcurso');
    }

    $this->eventosPrivados = $this->getUser()->getEventosPrivadosFecha($fecha);
	  $this->eventosPublicos = $this->getUser()->getEventosPublicosFecha($fecha);

	  $this->eventosPrivados = $this->getUser()->quitaEventosRepetidos($this->eventosPrivados);
	  $this->eventosPublicos = $this->getUser()->quitaEventosRepetidos($this->eventosPublicos);
  }

  // Nombre del método: verEventoId()
  // Añadida por: Jacobo Chaquet
  /* Descripción: muestra un evento segun su ID
   */
   public function executeVerEventoId()
   {
    $id = $this->getRequestParameter('id');
    $this->idcapa = $this->getRequestParameter('idcapa');
    if ($this->getRequestParameter('idcurso'))
    {
    	$this->idcurso = $this->getRequestParameter('idcurso');
    }

    $crit = new Criteria();
    $crit->add(EventoPeer::ID,  $id);
    $this->evento = EventoPeer::doSelectOne($crit);
   }

  // Nombre del método: verCerrar()
  // Añadida por: Jacobo Chaquet
  /* Descripción: hace desaparecer la capa con informacion de un evento
   */
   public function executeCerrar()
   {
    return;
   }

  // Nombre del método: NuevoEventoCita()
  // Añadida por: Jacobo Chaquet
  /* Descripción: sirve para generar el template de nuevas citas para la agenda
   */
  public function executeNuevoEventoCita()
  {
    $c2 = new Criteria();
	  $tipoCitas = Tipo_citaPeer::doSelect($c2);

    $opciones = array();
   	foreach ($tipoCitas as $tipoCita)
    {
     	$opciones[$tipoCita->getId()] = $tipoCita->getDescripcion();
	 	 }
	  $this->opciones = $opciones;

    $opcionesHora = array();
    for($i=0;$i<10;$i++)
    {
      $opcionesHora["0".$i.":00:00"] = "0".$i.":00";
      $opcionesHora["0".$i.":30:00"] = "0".$i.":30";
	   }
	  for($i=10;$i<24;$i++)
    {
      $opcionesHora[$i.":00:00"] = $i.":00";
      $opcionesHora[$i.":30:00"] = $i.":30";
	  }
	  $this->opcionesHora = $opcionesHora;
  }

  // Nombre del método: GuardarEvento()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Valida el formulario de nuevo evento
  				  Se mostrara en capa mediante AJAX*/
   public function validateGuardarCita()
  {
   	$ok = true ;
   	if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
     		$fechaInicio = $this->getRequestParameter('fechaInicio');
     		$fechaFin = $this->getRequestParameter('fechaFin');
     		$horaInicio = $this->getRequestParameter('horaInicio');
      	$horaFin = $this->getRequestParameter('horaFin');
     		$titulo = $this->getRequestParameter('titulo');
     		$descripcion = $this->getRequestParameter('descripcion');
     		$tipo = $this->getRequestParameter('tipo');

     		if (! $titulo)
    		{
          $this->getRequest()->setError('titulo', 'Debe indicar el titulo');
      	  $ok = false ;
         }

     		if (! $fechaInicio)
     		{
            $this->getRequest()->setError('fechaIncio', 'Debe indicar la fecha inicio del Evento');
       		  $ok = false ;
     		}else{ $c = new sfEventCalendar('month', date("Y-m-d"));
     		       list($diaInicio,$mesInicio, $anioInicio) = split("[-]", $fechaInicio);
  	        	 $compFechas = $c->getCalendar()->compareDates($diaInicio,$mesInicio,$anioInicio,
  														  date("d"),date("m"),date("Y"));

  	        	 if (-1==$compFechas)
               {
      	   	     $this->getRequest()->setError('fecha inicio', 'La fecha de inicio debe ser mayor que la fecha actual '.date("d-m-Y"));
      	         $ok= false;
  	           	}
  	          }

     		if (! $fechaFin)
        {
          $this->getRequest()->setError('fechaFin', 'Debe indicar la fecha fin del Evento');
          $ok = false ;
        }


     		if ($fechaInicio && $fechaFin)
         {
           list($diaFin,$mesFin, $anioFin) = split("[-]", $fechaFin);
  	       $compFechas = $c->getCalendar()->compareDates($diaFin,$mesFin,$anioFin,
  							                         $diaInicio,$mesInicio,$anioInicio);

  	       //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
      	   if (-1==$compFechas)
           {
      		   $this->getRequest()->setError('fechas', 'La fecha de fin debe ser mayor que la de inicio');
      		   $ok = false;
      	   }else if (0==$compFechas)
                 {
                    list( $hf, $mf, $sf ) = split( '[:]', $horaFin );
                    list( $hi, $mi, $si ) = split( '[:]', $horaInicio );
                    if ($hf<$hi)
                    {
                       $this->getRequest()->setError('horas', 'La hora de fin debe ser mayor que la de inicio');
      		             $ok = false;
                     }else{ if ( ($hf==$hi) && ($mf<$mi) )
                            {
                                $this->getRequest()->setError('horas', 'La hora de fin debe ser mayor que la de inicio');
      		                      $ok = false;
                             }
                          }
                 }

         }
    }
    return $ok;
  }

  // Nombre del método: GuardarCita()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Guarda una cita en la base de datos, este tipo de evento PRIVADO por lo que hay que actualizar las
     tablas   Rel_usuario_evento y evento
   */
  public function executeGuardarCita()
  {
   if ($this->getRequestParameter('horaInicio'))
       {  $horaInicio = $this->getRequestParameter('horaInicio');}
   else   $horaInicio = "00:00:00";

   if ($this->getRequestParameter('horaFin'))
       {  $horaFin = $this->getRequestParameter('horaFin');}
   else   $horaFin = "00:00:00";

   $fechaInicio = $this->getRequestParameter('fechaInicio');
   $fechaFin = $this->getRequestParameter('fechaFin');
   list($diaInicio,$mesInicio, $anioInicio) = split("[-]", $fechaInicio);
   list($diaFin,$mesFin, $anioFin) = split("[-]", $fechaFin);
   $fechaInicio = $anioInicio."-".$mesInicio."-".$diaInicio;
   $fechaFin = $anioFin."-".$mesFin."-".$diaFin;

   $con = Propel::getConnection();
	 try
   {
    	$con->begin();
   		$evento = new Evento();
   		$evento->setPrivado(1);
   		$evento->setFechaInicio($fechaInicio." ".$horaInicio);
   		$evento->setFechaFin($fechaFin." ".$horaFin);
   		$evento->setTitulo($this->getRequestParameter('titulo'));
   		$evento->setDescripcion($this->getRequestParameter('descripcion'));
   		$evento->setIdTipoCita($this->getRequestParameter('tipo'));
   		$evento->save($con);

   		$Rel_usuario_evento = new Rel_usuario_evento();
   		$Rel_usuario_evento->setIdUsuario($this->getUser()->getAnyId());
   		$Rel_usuario_evento->setIdEvento($evento->getId());
   		$Rel_usuario_evento->save($con);
		  $con->commit();
   }
  	catch (Exception $e)
  			{	$con->rollback();
    			throw $e;
  			}
  }


  // Nombre del método: NuevoEvento()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Sirve para generar el template de nuevo evento
  				  Puede recibir parametros:
					  -idcurso y idalumno: si los recibe en su template no apareceran los select de estos
					  -popUp :	quiere decir que se abrira en un pop-up por lo que hay que quitar el template (para qno aparezca el menu)
   */
  public function executeNuevoEvento()
  {
    if (!$this->getUser()->hasCredential('profesor') )
    {
        	return $this->redirect('login/logout');
    }

    $cursos = $this->getUser()->getCursosProfesor();

    if ($this->getRequestParameter('idcurso'))
    {
         $this->idcurso =  	$this->getRequestParameter('idcurso');

    }else $this->idcurso = "-1";

    if ($this->getRequestParameter('idalumno'))
    {
         $this->idalumno =  	$this->getRequestParameter('idalumno');
    }else $this->idalumno = "-1";

    if ($this->getRequestParameter('popUp'))
    {
	   $this->setLayout('eventoPopUp');
	   $this->popUp = 1;
    }
    else $this->popUp = 0;


    $opciones = array();
   	$opciones[-1] = "Todos";
    foreach ($cursos as $curso)
			{	$opciones[$curso->getIdCurso()] = $curso->GetCurso()->getNombre();	}

    $this->opciones = $opciones;
    $c = new Criteria();
    $c2 = new Criteria();

    $criterion = $c2->getNewCriterion(Tipo_eventoPeer::CLASE,'examen',Criteria::NOT_EQUAL);
    $criterionAux = $c2->getNewCriterion(Tipo_eventoPeer::CLASE,'examensorpresa',Criteria::NOT_EQUAL);
    $criterion->addAnd($criterionAux);
    $criterionAux = $c2->getNewCriterion(Tipo_eventoPeer::CLASE,'ejopcional',Criteria::NOT_EQUAL);
    $criterion->addAnd($criterionAux);
    $c->add($criterion);
    $tipoEventos = Tipo_eventoPeer::doSelect($c);

    $opciones = array();
   	foreach ($tipoEventos as $tipoEvento)
   	{
     		$opciones[$tipoEvento->getId()] = $tipoEvento->getDescripcion();
	 	}
    $this->opcionesEvento = $opciones;

    $opcionesHora = array();
    for($i=0;$i<10;$i++)
      { $opcionesHora["0".$i.":00:00"] = "0".$i.":00";
        $opcionesHora["0".$i.":30:00"] = "0".$i.":30";
	    }
    for($i=10;$i<24;$i++)
      { $opcionesHora[$i.":00:00"] = $i.":00";
        $opcionesHora[$i.":30:00"] = $i.":30";
	    }
    $this->opcionesHora = $opcionesHora;

    if ( $this->idcurso==-1)
    {
  		//todos los cursos
  		$repe = array();
  		$cursos = $this->getUser()->getCursosProfesor();
  		$alumnosAux = array();
  		foreach($cursos as $elcurso)
      {
  	  		$alum = $this->getUser()->getAlumnosCurso($elcurso->getCurso()->getId());
  	      $alumnosAux = array_merge($alumnosAux, $alum);  // concateno los array resultados para simular el OR
  	   }
  			//si un alumno pertenece a varios cursos del mismo profesor qsolo salga una vez
  	    foreach($alumnosAux as $alumnoAux)
        {
  	     	if (!isset($repe[$alumnoAux->getId()]))
         				{
                   $repe[$alumnoAux->getId()]= 1;
        	   			 $alumnos[]=$alumnoAux;
  					    }
  	    }
	  }
    else   $alumnos = $this->getUser()->getAlumnosCurso( $this->idcurso);

    $opcionesAlum = array(); //opciones del selecet en template
   	$opcionesAlum[-1] = "Todos";
    foreach ($alumnos as $alumno)
    { $alum = UsuarioPeer::retrieveByPk($alumno->getId());
      $opcionesAlum[$alum->getId()] = $alum->getNombre()." ".$alum->getApellidos();
    }
    $this->opcionesAlum = $opcionesAlum;
  }

  // Nombre del método: SeleccionAlumno()
  // Añadida por: Jacobo Chaquet
  /* Descripción: (Usado en capa AJAX)Selecciona todos los alumnos matriculados en ese curso, para poderles poner un evento
   */
   public function executeSeleccionAlumno()
   {
     if (!$this->getUser()->hasCredential('profesor') )
     {
        	return $this->redirect('login/logout');
     }

 		$curso = $this->getRequestParameter('cursos');

     if ($curso==-1)
     {
  		//todos los cursos
  		$repe = array();
  		$cursos = $this->getUser()->getCursosProfesor();
  		$alumnosAux = array();
  		foreach($cursos as $elcurso)
      {
  	  	$alum = $this->getUser()->getAlumnosCurso($elcurso->getCurso()->getId());
  	    $alumnosAux = array_merge($alumnosAux, $alum);  // concateno los array resultados para simular el OR
  	   }

  		//si un alumno pertenece a varios cursos del mismo profesor qsolo salga una vez
  		foreach($alumnosAux as $alumnoAux)
      {
  	   	if (!isset($repe[$alumnoAux->getUsuario()->getId()]))
        {
          $repe[$alumnoAux->getUsuario()->getId()]= 1;
        	$alumnos[]=$alumnoAux;
  			}
      }
     }
     else   $alumnos = $this->getUser()->getAlumnosCurso($curso);

   	$opciones = array(); //opciones del selecet en template
   	$opciones[-1] = "Todos";
	  foreach ($alumnos as $alumno)
	  {
      $alum = UsuarioPeer::retrieveByPk($alumno->getId());
      $opciones[$alum->getId()] = $alum->getNombre()." ".$alum->getApellidos();
	  }
    $this->opciones = $opciones;
   }


  // Nombre del método: executeEliminarEventos
  // Añadida por: Jacobo Chaquet
  /* Descripción: Muestra la lista de eventos de un curso solo los profesores del curso pueden hacerlo
  */
  public function executeEliminarEventos()
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
  		    $curso = CursoPeer::retrieveByPk($this->idcurso);
  			  $this->forward404Unless($curso);
  		    $eventos = $curso->getEventos();
		    }else return $this->redirect('login/logout');
    }else {$cursos = $this->getUser()->getCursosProfesor();

            $eventos = array();
            foreach($cursos as $curso)
            {
        	  	$eventosAux = $curso->getCurso()->getEventos();
        	    $eventos = array_merge($eventos, $eventosAux);  // concateno los array resultados para simular el OR
            }
          }
    $this->eventos=$eventos;

    if ($this->getRequestParameter('principal'))
    { //para saber si venimos del calendario general o de un curso
		  $this->principal=$this->getRequestParameter('principal');
	  }
  }

  // Nombre del método: executeEliminaEventoId()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Elimina el evento de un curso solo los profesores del curso pueden hacerlo
  */
  public function executeEliminarEventoId()
  {
    if (!$this->getUser()->hasCredential('profesor') )
    {
        	return $this->redirect('login/logout');
    }

    if ($this->getRequestParameter('idevento'))
    {
        $idevento =  	$this->getRequestParameter('idevento');
        $evento = EventoPeer::retrieveByPk($idevento);
        $this->forward404Unless($evento);

        $profesor = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
        $this->forward404Unless($profesor);

		    if (!$profesor->esProfesor($evento->getIdCurso()))
        {
		   	  return $this->redirect('login/logout');
	 	    }
    }

    $idcurso = $evento->getIdCurso();
    $con = Propel::getConnection();
    try
    {
    			$con->begin();
    			if (1==$evento->getPrivado())
          {
    			  //es privado
    			  $c = new criteria();
            $c->add(Rel_usuario_eventoPeer::ID_EVENTO,$evento->getId());
            $rel = Rel_usuario_eventoPeer::doSelectOne($c);
					  $rel->delete($con);
				   }

			    $evento->delete($con);
				  $con->commit();
		}
  	catch (Exception $e)
  				{	$con->rollback();
  				    throw $e;
  				}

  	if ($this->getRequestParameter('principal'))
    { //para saber si venimos del calendario general o de un curso
		  $principal=$this->getRequestParameter('principal');
		  return $this->redirect('calendario/eliminarEventos?principal=1');
	  }else return $this->redirect('calendario/eliminarEventos?idcurso='.$idcurso);
  }


  // Nombre del método: executeEliminarCitas
  // Añadida por: Jacobo Chaquet
  /* Descripción: Muestra la lista de citas de un usuario
  */
  public function executeEliminarCitas()
  {
    $c = new Criteria();
    $c->add(Rel_usuario_eventoPeer::ID_USUARIO,$this->getUser()->getAnyId());
    $c->addJoin(Rel_usuario_eventoPeer::ID_EVENTO,EventoPeer::ID);
    $c->add(EventoPeer::ID_TIPO_CITA, NULL, Criteria::NOT_EQUAL);
  	$this->eventos=Rel_usuario_eventoPeer::DoSelect($c);

	  if ($this->getRequestParameter('principal'))
    { //para saber si venimos del calendario general o de un curso
		  $this->principal=$this->getRequestParameter('principal');
	  }else if ($this->getRequestParameter('idcurso'))
          {
		       $this->idcurso=$this->getRequestParameter('idcurso');
	        }
  }

  // Nombre del método: executeEliminaCitaId()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Elimina cita del usuario
  */
  public function executeEliminarCitaId()
  {
    if ($this->getRequestParameter('idevento'))
    {
        $idevento =  	$this->getRequestParameter('idevento');
    		$c = new Criteria();
        $c->add(Rel_usuario_eventoPeer::ID_USUARIO,$this->getUser()->getAnyId());
        $c->add(Rel_usuario_eventoPeer::ID_EVENTO,$idevento);
        $c->addJoin(Rel_usuario_eventoPeer::ID_EVENTO,EventoPeer::ID);
        $c->add(EventoPeer::ID_TIPO_CITA, NULL, Criteria::NOT_EQUAL);
	      $evento = Rel_usuario_eventoPeer::DoSelectOne($c);
        if ($evento)
        {
          $con = Propel::getConnection();
  	      try
      		{
        			$con->begin();
        			$c = new criteria();
              $c->add(Rel_usuario_eventoPeer::ID_EVENTO,$idevento);
              $c->add(Rel_usuario_eventoPeer::ID_USUARIO,$this->getUser()->getAnyId());
              $rel = Rel_usuario_eventoPeer::doSelectOne($c);
    				  $rel->delete($con);

              $evento = EventoPeer::retrieveByPk($idevento);
    			    $evento->delete($con);
    				  $con->commit();
    		  }
  	      catch (Exception $e)
  				{	 $con->rollback();
  				   throw $e;
  				}
        }
    }
	 if ($this->getRequestParameter('principal'))
   {
     //para saber si venimos del calendario general o de un curso
	 	 $principal=$this->getRequestParameter('principal');
		 //return $this->redirect('calendario/EliminarCitas?principal=1');
		 return $this->redirect('calendario/mostrarCalendario?principal=1');
	 }else {  if ($this->getRequestParameter('idcurso'))
            {
        	     $idcurso = $this->getRequestParameter('idcurso');
            }
	          //return $this->redirect('calendario/EliminarCitas?idcurso='.$idcurso);
	          return $this->redirect('calendario/mostrarCalendario?idcurso='.$idcurso);
	       }
  }

  // Nombre del método: GuardarEvento()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Valida el formulario de nuevo evento
  				  Se mostrara en capa mediante AJAX*/

  public function validateGuardarEvento()
  {
   	$ok = true ;
   	if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
     		$fechaInicio = $this->getRequestParameter('fechaInicio');
     		$fechaFin = $this->getRequestParameter('fechaFin');
     		$horaInicio = $this->getRequestParameter('horaInicio');
      	$horaFin = $this->getRequestParameter('horaFin');
     		$titulo = $this->getRequestParameter('titulo');
     		$descripcion = $this->getRequestParameter('descripcion');
     		$tipo = $this->getRequestParameter('tipo');
     		$curso = $this->getRequestParameter('curso');
     		$alumno= $this->getRequestParameter('alumno');

     		if (! $alumno)
     		{
          $this->getRequest()->setError('alumno', 'Debe indicar el Alumno');
          $ok = false ;
        }

     		if (! $titulo)
     		{
          $this->getRequest()->setError('titulo', 'Debe indicar el titulo');
          $ok = false ;
        }

     		if (! $curso)
        {
          $this->getRequest()->setError('curso', 'Debe indicar el curso');
          $ok = false ;
        }

     		if (! $fechaInicio)
     		{  $this->getRequest()->setError('fechaIncio', 'Debe indicar la fecha inicio del Evento');
           $ok = false ;
     	  }else{ $c = new sfEventCalendar('month', date("Y-m-d"));
     	         list($diaInicio,$mesInicio, $anioInicio) = split("[-]", $fechaInicio);

  	           $compFechas = $c->getCalendar()->compareDates($diaInicio,$mesInicio,$anioInicio,
  						                                							  date("d"),date("m"),date("Y"));

  	           if (-1==$compFechas)
               {
      		      $this->getRequest()->setError('fecha inicio', 'La fecha de inicio debe ser mayor que la fecha actual '.date("d-m-Y"));
      		      $ok= false;
  	           }

  	           if (-1!=$curso)
               {
                 $cursoObj = CursoPeer::retrieveByPk($curso);
                 $this->forward404Unless($cursoObj);

  	             $compFechas = $c->getCalendar()->compareDates($diaInicio,$mesInicio,$anioInicio,
  							                                               $cursoObj->getFechaFin("d"),$cursoObj->getFechaFin("m"),$cursoObj->getFechaFin("Y"));
                 //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
      	         if (1==$compFechas)
                 {
      		           $this->getRequest()->setError('fechas inicio', 'La fecha de inicio debe ser menor que la fecha de fin del curso');
      		           $ok = false;
                 }

                 $compFechas = $c->getCalendar()->compareDates($diaInicio,$mesInicio,$anioInicio,
  							                                               $cursoObj->getFechaInicio("d"),$cursoObj->getFechaInicio("m"),$cursoObj->getFechaInicio("Y"));

                 //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
      	         if (-1==$compFechas)
                 {
      		           $this->getRequest()->setError('fecha inicio', 'La fecha de inicio debe ser mayor que la fecha de inicio del curso');
      		           $ok = false;
                 }
               }
  	          }

     	  if (! $fechaFin)
        {
          $this->getRequest()->setError('fechaFin', 'Debe indicar la fecha fin del Evento');
          $ok = false ;
         }
         else { list($diaFin,$mesFin, $anioFin) = split("[-]", $fechaFin);

               if (-1!=$curso)
                 { $curso = CursoPeer::retrieveByPk($curso);
                   $this->forward404Unless($curso);
    	             $compFechas = $c->getCalendar()->compareDates($diaFin,$mesFin,$anioFin,
  	                         						                         $curso->getFechaFin("d"),$curso->getFechaFin("m"),$curso->getFechaFin("Y"));
                   //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
      	           if (1==$compFechas)
                   {
      		           $this->getRequest()->setError('fechas fin', 'La fecha de fin debe ser menor que la fecha de fin del curso');
      		           $ok = false;
                   }

                   $compFechas = $c->getCalendar()->compareDates($diaFin,$mesFin,$anioFin,
  							                                                 $curso->getFechaInicio("d"),$curso->getFechaInicio("m"),$curso->getFechaInicio("Y"));

                   //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
      	           if (-1==$compFechas)
                   {
      		           $this->getRequest()->setError('fecha fin', 'La fecha de fin debe ser mayor que la fecha de inicio del curso');
      		           $ok = false;
                   }else if (0==$compFechas)
                         {
                          //echo $horaFin;
                         }
                 }
             }

     	  if ($fechaInicio && $fechaFin)
        {

      	   $compFechas = $c->getCalendar()->compareDates($diaFin,$mesFin,$anioFin,
      							                                     $diaInicio,$mesInicio,$anioInicio);

          	//Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
          	if (-1==$compFechas)
            {
          		$this->getRequest()->setError('fechas', 'La fecha de fin debe ser mayor que la de inicio');
          		$ok = false;
          	}else if (0==$compFechas)
                  {
                       list( $hf, $mf, $sf ) = split( '[:]', $horaFin );
                       list( $hi, $mi, $si ) = split( '[:]', $horaInicio );
                       if ($hf<$hi)
                       {
                           $this->getRequest()->setError('horas', 'La hora de fin debe ser mayor que la de inicio');
          		             $ok = false;
                        }else{ if ( ($hf==$hi) && ($mf<$mi) )
                               {
                                  $this->getRequest()->setError('horas', 'La hora de fin debe ser mayor que la de inicio');
          		                    $ok = false;
                                }
                              }
                  }
        }
    }
  return $ok;
  }

  // Nombre del método: GuardarEvento()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Guarda los eventos puestos por un profesor
                  - si el parametro curso es -1 significa que es para todos los cursos
				  - si el parametro alumno es -1 significa que es para todos los alumnos de un curso o de todos los cursos
				  - en caso de que estos parametros no sean -1 indicaran el Id del alumno y del curso
				  - En el caso que el parametro alumno sea distinto de -1(a un alumno en concreto) el evento sera PRIVADO
				    y habra que actualizar las tablas Rel_usuario_evento y evento. Si el evento es publico solo se guarda en
				    la tabla evento
   */
  public function executeGuardarEvento()
  {
   if (!$this->getUser()->hasCredential('profesor') )
   {
        	return $this->redirect('login/logout');
   }

   if ($this->getRequestParameter('horaInicio'))
   {  $horaInicio = $this->getRequestParameter('horaInicio');}
   else   $horaInicio = "00:00:00";

   if ($this->getRequestParameter('horaFin'))
   {  $horaFin = $this->getRequestParameter('horaFin');}
   else   $horaFin = "00:00:00";

    if (0!=$this->getRequestParameter('popUp'))
 	  {
      $this->setLayout('eventoPopUp');
      $this->PopUp="true";
     }

     $fechaInicio = $this->getRequestParameter('fechaInicio');
     $fechaFin = $this->getRequestParameter('fechaFin');
     list($diaInicio,$mesInicio, $anioInicio) = split("[-]", $fechaInicio);
     list($diaFin,$mesFin, $anioFin) = split("[-]", $fechaFin);
     $fechaInicio = $anioInicio."-".$mesInicio."-".$diaInicio;
     $fechaFin = $anioFin."-".$mesFin."-".$diaFin;

     $con = Propel::getConnection();
	   try
  	 {    $evento = new Evento();
  		    $evento->setFechaInicio($fechaInicio." ".$horaInicio);
   		    $evento->setFechaFin($fechaFin." ".$horaFin);
   		    $evento->setTitulo($this->getRequestParameter('titulo'));
   	  		$evento->setDescripcion($this->getRequestParameter('descripcion'));
  		    $evento->setIdTipoEvento($this->getRequestParameter('tipo'));

  		    if (-1!=$this->getRequestParameter('alumno'))
          {
    	      /* evento privado para un alumno*/
            $evento->setPrivado(1);
   	  		  if(-1!= $this->getRequestParameter('curso'))
   			    {  $evento->setIdCurso($this->getRequestParameter('curso'));			   }
   			    $evento->save($con);
			    	$Rel_usuario_evento = new Rel_usuario_evento();
       			$Rel_usuario_evento->setIdUsuario($this->getRequestParameter('alumno'));
       			$Rel_usuario_evento->setIdEvento($evento->getId());
       			$Rel_usuario_evento->save($con);
          }
          else{	if (-1==$this->getRequestParameter('curso'))
                {
        					//todos los cursos
        					$cursos = $this->getUser()->getCursosProfesor();

        					foreach($cursos as $elcurso)
                  {
        					 $evento = new evento();
        					 $evento->setPrivado(0); /*como es para todos los alumnos es publico*/
        					 $evento->setFechaInicio($fechaInicio." ".$horaInicio);
           		     $evento->setFechaFin($fechaFin." ".$horaFin);
           		     $evento->setTitulo($this->getRequestParameter('titulo'));
           	  		 $evento->setDescripcion($this->getRequestParameter('descripcion'));
          		     $evento->setIdTipoEvento($this->getRequestParameter('tipo'));
        	  			 $evento->setIdCurso($elcurso->getCurso()->getId());
           		 		 $evento->save($con);
        	         }
                }
	              else{	 $evento->setPrivado(0); /*es para todos */
   		    		         $evento->setIdCurso($this->getRequestParameter('curso'));
   					           $evento->save($con);
   					           $this->evento = $evento;
			               }
			         }
          $con->commit();
  	 }
  	 catch (Exception $e)
  			{	$con->rollback();
    			throw $e;
  			}

     $this->fechaInicio = $fechaInicio." ".$horaInicio;
     $this->fechaFin = $fechaFin." ".$horaInicio;
     $this->curso = $this->getRequestParameter('curso');
     $this->alumno = $this->getRequestParameter('alumno');
     $this->titulo = $this->getRequestParameter('titulo');
     $this->descipcion = $this->getRequestParameter('descripcion');
     $this->tipo = $this->getRequestParameter('tipo');

 }

   // Nombre del método:verCalendarioAjax
  // Añadida por: Jacobo Chaquet
  /* Descripción: Mediante la libreria sfEventCalendar creamos un calendario, y añadimos los eventos publicos y privados para el usuario
   */
  public function executeVerCalendarioAjax()
  {
    $meses["01"]='Enero';
    $meses["02"]='Febrero';
    $meses["03"]='Marzo';
    $meses["04"]='Abril';
    $meses["05"]='Mayo';
    $meses["06"]='Junio';
    $meses["07"]='Julio';
    $meses["08"]='Agosto';
    $meses["09"]='Septiembre';
    $meses["10"]='Octubre';
    $meses["11"]='Noviembre';
    $meses["12"]='Diciembre';

    if($this->getRequestParameter('fecha'))
    { $fecha = $this->getRequestParameter('fecha');
       $fechaBD = str_replace('/','-',$fecha);
	  }
	  else { $fecha = date("Y/").date("m/")."01";
	         $fechaBD = date("Y-").date("m-")."01";
	       }

    if($this->getRequestParameter('idcurso'))
    {  $idcurso = $this->getRequestParameter('idcurso');
    	 $c = new Criteria();
    	 $c->add(CursoPeer::ID, $idcurso);
    	 $this->curso = CursoPeer::doSelectOne($c);
    	 $this->idcurso = $idcurso;
    	 $eventosPrivados = $this->getUser()->getEventosPrivadosCurso($idcurso,$fechaBD);
       $eventosPublicos = $this->getUser()->getEventosPublicosCurso($idcurso,$fechaBD);
	  }
    else{ $eventosPrivados = $this->getUser()->getEventosPrivados($fechaBD);
          $eventosPublicos = $this->getUser()->getEventosPublicos($fechaBD);
        }

    $eventosPrivados = $this->getUser()->quitaEventosRepetidos($eventosPrivados);
	  $eventosPublicos = $this->getUser()->quitaEventosRepetidos($eventosPublicos);

    $result= $this->getUser()->setEventosCalendario($fecha,$eventosPrivados,$eventosPublicos);

    $this->calendar = $result[0]->getEventCalendar();
    $mes = substr($fecha,5,2);
    $anio = substr($fecha,0,4);
    $this->anio = $anio;
    $this->nombreMes = $meses[$mes] ;

    $this->anterior = $result[0]->getCalendar()->beginOfPrevMonth('1', $mes, $anio, '%Y-%m-%d');
    $this->siguiente = $result[0]->getCalendar()->beginOfNextMonth('1', $mes, $anio, '%Y-%m-%d');
    $this->semana = $result[0]->getCalendar()->weekOfYear();
    $this->arrayFechas = $result[1];
    $this->cadOverLib = $result[2];
  }

/************************************************/
/*       metodos configuracion calendario		*/
/************************************************/


  // Nombre del método:Configuracion()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Permite configurar el calendario al usuario
                   - Avisar de eventos dias antes y despues
   */
  public function executeConfiguracion()
  {
      if ($this->getRequestParameter('idcurso'))
      { //para saber de que materia viene
      	    $this->idcurso = $this->getRequestParameter('idcurso');
      	    $curso = CursoPeer::retrieveByPk($this->idcurso);
      	    $this->forward404Unless($curso);
      	    $this->getUser()->comprobarPermiso($this->idcurso);
      	    $this->nombre = $curso->getNombre();
      	    $result = $this->getUser()->getDiasConfCalendario($this->idcurso);
    	 }
       else	  {$this->idcurso = -1 ; //calendario general
               $this->nombre = "General";
			         $result = $this->getUser()->getDiasConfCalendario();
			         $this->principal='1';}

       $this->diasAntes = $result[0];
       $this->diasDespues = $result[1];

       $maxDiasConfiguracion = 15; //numero de dias antes y despues que el usuario puede elegir
       $opciones = array();
       for($i=1;$i<=$maxDiasConfiguracion;$i++)
       { $opciones[$i]=$i; }
   	   $this->opciones = $opciones;
  }

  // Nombre del método:executeGuardarConfiguracion()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Guarda los valores de la configuracion
   */
  public function executeGuardarConfiguracion()
  {
    if (!$this->getRequestParameter('diasAntes'))
          $this->redirect('calendario/configuracion');

    if (!$this->getRequestParameter('diasDespues'))
          $this->redirect('calendario/configuracion');

    if (!$this->getRequestParameter('idcurso'))
          $this->redirect('calendario/configuracion');

    if ( ($this->getRequestParameter('idcurso')) && ($this->getRequestParameter('idcurso')!= -1)  )
    { //calendario curso
    	$idcurso = $this->getRequestParameter('idcurso');

    	$c2 = new Criteria();
      $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getUser()->getAnyId() );
      $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $idcurso);
      $rel = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
      $this->forward404Unless($rel);
      $rel->setCalDiasAntes($this->getRequestParameter('diasAntes'));
      $rel->setCalDiasDespues($this->getRequestParameter('diasDespues'));
      $rel->save();
      }
     else{ $preferencias = Preferencia_usuarioPeer::retrieveByPk($this->getUser()->getAnyId());
           if ($preferencias)
		       {
              $preferencias->setCalDiasAntes($this->getRequestParameter('diasAntes'));
              $preferencias->setCalDiasDespues($this->getRequestParameter('diasDespues'));
              $preferencias->save();
            }
            else{
                  $preferencias = new Preferencia_usuario();
                  $preferencias->setUsuarioId($this->getUser()->getAnyId());
                  $preferencias->setCalDiasAntes($this->getRequestParameter('diasAntes'));
                  $preferencias->setCalDiasDespues($this->getRequestParameter('diasDespues'));
                  $preferencias->save();
		             }
		   $this->principal="OK";
	    }
  }
/********************************************************/
/* 				FIN metodos configuracion				*/
/********************************************************/
}


