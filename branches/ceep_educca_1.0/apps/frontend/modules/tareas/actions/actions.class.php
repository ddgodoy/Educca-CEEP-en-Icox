<?php

/**
 * tareas actions.
 *
 * @package    edoceo
 * @subpackage tareas
 * @author     �ngel Mart�n Latasa
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class tareasActions extends sfActions
{

// #############################################################################
// ##########         p�gina de bienvenida del m�dulo tareas         ###########
// #############################################################################
  public function executeIndex()
  {
    $this->rol = $this->getUser()->obtenerCredenciales();
    $this->redireccion = '?idcurso='.$this->getRequestParameter('idcurso');
  }


// #############################################################################
// ###############        Poner tareas y ex�menes paso1        #################
// #############################################################################

  public function executeTareasExamenes()
  {
    // Se obtienen los cursos que ense�a el profesor que est� conectado
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
    foreach($cursos_temp as $curso_temp) {
      $cursos[$curso_temp->getIdCurso()] = $curso_temp->getCurso()->getNombre();
    }
    $this->cursos = $cursos;

    $tipos_caracter = array();
    $tipos_caracter['Obligatorio'] = 'Obligatorio';
    $tipos_caracter['Opcional'] = 'Opcional';
    $this->tipos_caracter = $tipos_caracter;

    $tipos_prueba = array();
    $tipos_prueba['Tarea'] = 'Tarea';
    $tipos_prueba['Examen'] = 'Examen';
    $this->tipos_prueba = $tipos_prueba;
  }


// #############################################################################
// ###############       Poner tareas y ex�menes paso 2        #################
// #############################################################################

  public function executeTareasExamenesPaso2()
  {
    $this->tipo_prueba = $this->getRequestParameter('tipo_prueba');
    $this->id_curso = $this->getRequestParameter('curso');
    $this->caracter = $this->getRequestParameter('caracter');
    if ($this->hasRequestParameter('sorpresa')) {$this->sorpresa = $this->getRequestParameter('sorpresa');}
    else {$this->sorpresa = 0;}
    $curso = CursoPeer::RetrieveByPk($this->id_curso);
    $this->id_materia = $curso->getMateriaId();

    $this->nombre_curso = $curso->getNombre();
    if ($this->hasRequestParameter('peso')) {
      $this->peso = $this->getRequestParameter('peso');
    } else {
      $this->peso = 0;
    }
  }




// #############################################################################
// ###############       Poner tareas y ex�menes paso 3        #################
// #############################################################################

  public function executeTareasExamenesPaso3()
  {
    $this->tipo_prueba = $this->getRequestParameter('tipo_prueba');
    $this->id_curso = $this->getRequestParameter('id_curso');
    $this->caracter = $this->getRequestParameter('caracter');
    $this->nombre_curso = $this->getRequestParameter('nombre_curso');
    $this->sorpresa = $this->getRequestParameter('sorpresa');
    $this->peso = $this->getRequestParameter('peso');
    $id_ejercicio = $this->getRequestParameter('seleccion');
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $this->nombre_ejercicio = $ejercicio->getTitulo();
    $this->id_ejercicio = $id_ejercicio;

    $opcionesHora = array();
    for($i=8;$i<10;$i++) {
      $opcionesHora["0".$i.":00:00"] = "0".$i.":00";
      $opcionesHora["0".$i.":30:00"] = "0".$i.":30";
	  }
	  for($i=10;$i<20;$i++) {
      $opcionesHora[$i.":00:00"] = $i.":00";
      $opcionesHora[$i.":30:00"] = $i.":30";
	  }
	  $this->opcionesHora = $opcionesHora;

  }


// #############################################################################
// ####   lista los ejercicios de un profesor para ponerlos en un examen   #####
// #############################################################################

  public function executeListarEjerciciosExamen()
  {
    $id_materia = $this->getRequestParameter('filtro');
    $this->id_curso = $this->getRequestParameter('id_curso');
    $this->ejercicios = $this->getUser()->getEjerciciosProfesorMateria($id_materia);
  }


// #############################################################################
// ###############       Poner tareas y ex�menes paso 4        #################
// #############################################################################

  public function executeTareasExamenesPaso4()
  {
    $this->peso = $this->getRequestParameter('peso');
    $this->tipo_prueba = $this->getRequestParameter('tipo_prueba');
    $this->id_curso = $this->getRequestParameter('id_curso');
    $this->caracter = $this->getRequestParameter('caracter');
    $this->nombre_curso = $this->getRequestParameter('nombre_curso');
    $this->sorpresa = $this->getRequestParameter('sorpresa');
    $this->id_ejercicio = $this->getRequestParameter('id_ejercicio');
    $this->nombre_ejercicio = $this->getRequestParameter('nombre_ejercicio');
    $this->horaInicio = $this->getRequestParameter('horaInicio');
    $this->fechaInicio = $this->getRequestParameter('fechaInicio');
    $this->horaFin = $this->getRequestParameter('horaFin');
    $this->fechaFin = $this->getRequestParameter('fechaFin');
    $this->duracion = $this->getRequestParameter('duracion');

    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, 'alumno');
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->id_curso);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $this->alumnos = UsuarioPeer::DoSelect($c);
  }


// #############################################################################
// ###############         Poner tareas y ex�menes Fin         #################
// #############################################################################

  public function executeTareasExamenesFin()
  {
    $this->tipo_prueba = $this->getRequestParameter('tipo_prueba');
    $id_curso = $this->getRequestParameter('id_curso');
    $id_materia = $this->getRequestParameter('id_materia');
    $this->caracter = $this->getRequestParameter('caracter');
    $this->nombre_curso = $this->getRequestParameter('nombre_curso');
    $id_ejercicio = $this->getRequestParameter('id_ejercicio');
    $this->nombre_ejercicio = $this->getRequestParameter('nombre_ejercicio');
    $this->sorpresa = $this->getRequestParameter('sorpresa');
    $this->horaInicio = $this->getRequestParameter('horaInicio');
    $this->fechaInicio = $this->getRequestParameter('fechaInicio');
    $this->horaFin = $this->getRequestParameter('horaFin');
    $this->fechaFin = $this->getRequestParameter('fechaFin');
    $this->duracion = $this->getRequestParameter('duracion');
    $this->peso = $this->getRequestParameter('peso');

    $tarea = new Tarea();
    $tarea->setIdCurso($id_curso);
    $tarea->setIdEjercicio($id_ejercicio);
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    
    $id_profesor = $this->getUser()->getAnyId();
    $tarea->setIdAutor($id_profesor);

    $evento = new Evento();
    $evento->setTitulo($this->tipo_prueba." - ".$this->nombre_curso);
    $evento->setIdCurso($id_curso);
    $evento->setDescripcion($this->nombre_ejercicio);
    $fechaInicio = $this->fechaInicio;
    $evento->setFechaInicio($fechaInicio." ".$this->horaInicio);

    $curso = CursoPeer::RetrieveByPk($id_curso);
    if ($this->tipo_prueba == 'Examen')
    {
      if ($this->sorpresa)
      {
        $evento->setFechaFin($this->fechaFin." ".$this->horaFin);
      }
      else
      {
        $minutos_total = $this->duracion + substr($this->horaInicio, 3, 2);
        $auxhorafin = substr($this->horaInicio, 0, 2) + floor($minutos_total / 60);
        if ($auxhorafin > 23) {$auxhorafin = 23;}
        $auxminfin = $minutos_total % 60;
        $auxfin = $auxhorafin.':'.$auxminfin.':00';
        $evento->setFechaFin($fechaInicio." ".$auxfin);
      }
    }
    else
    {
      $evento->setFechaFin($this->fechaFin." ".$this->horaFin);
    }

    $c = new Criteria();
    if ($this->sorpresa) {$c->add(Tipo_eventoPeer::DESCRIPCION, 'Examen sorpresa');}
    else {$c->add(Tipo_eventoPeer::DESCRIPCION, $this->tipo_prueba);}
    $tipo_evento = Tipo_eventoPeer::DoSelectOne($c);
    $evento->setIdTipoEvento($tipo_evento->getId());

    $evento->setPrivado(1);
    $evento->save();
    $tarea->setIdEvento($evento->getId());
    $tarea->setTiempoDisponible($this->duracion);
    $tarea->save();
    $total_alumnos = $this->getRequestParameter('total_alumnos');
    $array_nombres = array();
    for ($index = 0; $index < $total_alumnos; $index++) {
      if ($this->hasRequestParameter("id_alumno$index")) {
        $id_alumno = $this->getRequestParameter("id_alumno$index");
        $alumno = UsuarioPeer::RetrieveByPk($id_alumno);
        $array_nombres[] = $alumno->getApellidos().', '.$alumno->getNombre();
        $relacion_evento = new Rel_usuario_evento();
        $relacion_evento->setIdUsuario($id_alumno);
        $relacion_evento->setIdEvento($evento->getId());
        $relacion_evento->save();
        $relacion_tarea = new Rel_usuario_tarea();
        $relacion_tarea->setIdUsuario($id_alumno);
        $relacion_tarea->setIdTarea($tarea->getId());
        $relacion_tarea->setEntregada(0);
        $relacion_tarea->setTiempoRestante($this->duracion * 60);
        $relacion_tarea->save();
      }
    }
    $this->tarea = $tarea;
    /*a�adimos el evento tb a los profesores
      Jacobo Chaquet 04-06-2008
    */
    $rel_profs = $curso->getProfesores();

    foreach ($rel_profs as $rel_prof)
    { $con = Propel::getConnection();
  		try	{
              $relacion_evento = new Rel_usuario_evento();
              $relacion_evento->setIdUsuario($rel_prof->getIdUsuario());
              $relacion_evento->setIdEvento($evento->getId());

              $relacion_evento->save($con);
    			    $con->commit();
           }
            catch (Exception $e) {
                                   $con->rollback();
    	                             throw $e;
  		                            }
    }

    /*Fin modifiacion Jacobo Chaquet*/

    $this->implicados = $array_nombres;
  }

// #############################################################################
// ###############              Tareas pendientes              #################
// #############################################################################

  public function executeTareasPendientes()
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


// #############################################################################
// ###############          Listar tareas pendientes           #################
// #############################################################################

  public function executeListarTareasPendientes()
  {
    $id_curso = $this->getRequestParameter('filtro');
    $c = new Criteria();
    $id_usuario = $this->getUser()->getAnyId();

    if ($this->hasRequestParameter('corto')) {$this->corto = 1;}
    else {$this->corto = 0;}

    if ($id_curso) {$c->add(TareaPeer::ID_CURSO, $id_curso);}
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
    $c->add(Rel_usuario_tareaPeer::ENTREGADA, 0);
    $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::GREATER_THAN);
    $criterion2 = $c->getNewCriterion(EventoPeer::FECHA_INICIO, time(), Criteria::LESS_THAN);
    $criterion1->addAnd($criterion2);
    $c->add($criterion1);
    $c->add(Tipo_eventoPeer::DESCRIPCION, 'Tarea');
    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(EventoPeer::ID_TIPO_EVENTO, Tipo_eventoPeer::ID);
    $c->addJoin(TareaPeer::ID_CURSO, CursoPeer::ID);
    $this->tareas = TareaPeer::DoSelect($c);
    $this->eventos = EventoPeer::DoSelect($c);
    $this->cursos = CursoPeer::DoSelect($c);
    $this->info_tareas = Rel_usuario_tareaPeer::DoSelect($c);
  }


// #############################################################################
// ####################          Entregar tarea           ######################
// #############################################################################

  public function executeEntregarTarea()
  {
    $id_respuesta_ejercicio = $this->getRequestParameter('id_respuesta_ejercicio');
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $id_respuesta_ejercicio);
    $rel_usuario_tarea = Rel_usuario_tareaPeer::DoSelectOne($c);
    if ($rel_usuario_tarea) {
      $rel_usuario_tarea->setEntregada(1);
      $rel_usuario_tarea->setFechaEntrega(time());
      $rel_usuario_tarea->save();
    }
    $this->redirect('tareas/historialEntregas');

  }


// #############################################################################
// ###############             Estado de las tareas            #################
// #############################################################################

  public function executeCambiarTareas()
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


// #############################################################################
// ###############                Listar tareas                #################
// #############################################################################

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


// #############################################################################
// ###############                Mostrar tarea                #################
// #############################################################################

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


// #############################################################################
// ###############             Cancelar tarea                  #################
// #############################################################################

  public function executeCancelarTarea()
  {
    $id_evento = $this->getRequestParameter('id_evento');
    $evento = EventoPeer::RetrieveByPk($id_evento);
    $evento->delete();
    $this->redirect('tareas/cambiarTareas');
  }


// #############################################################################
// ###############            Historial de entregas            #################
// #############################################################################

  public function executeHistorialEntregas()
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

// #############################################################################
// ###############        Listar Historial de Entregas          ################
// #############################################################################

  public function executeListarHistorialEntregas()
  {
    $id_curso = $this->getRequestParameter('filtro');
    $c = new Criteria();
    $id_usuario = $this->getUser()->getAnyId();

    if ($id_curso) {$c->add(TareaPeer::ID_CURSO, $id_curso);}
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
    $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::LESS_THAN);
    $criterion2 = $c->getNewCriterion(Rel_usuario_tareaPeer::ENTREGADA, 1);
    $criterion1->addOr($criterion2);
    $c->add($criterion1);


    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(TareaPeer::ID_CURSO, CursoPeer::ID);

    $c->addAsColumn('ejercicio', EventoPeer::DESCRIPCION);
    $c->addAsColumn('curso', CursoPeer::NOMBRE);
    $c->addAsColumn('entregada', Rel_usuario_tareaPeer::ENTREGADA);
    $c->addAsColumn('fecha_entrega', Rel_usuario_tareaPeer::FECHA_ENTREGA);
    $c->addAsColumn('fecha_limite', EventoPeer::FECHA_FIN);
    $c->addAsColumn('id_tarea', TareaPeer::ID);
    $c->addAsColumn('id_ejercicio_resuelto', Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO);
    $c->addAsColumn('corregida', Rel_usuario_tareaPeer::CORREGIDA);

    $this->historial_entregas = BasePeer::DoSelect($c);

  }


// #############################################################################
// ###############              Modificar tarea                 ################
// #############################################################################

  public function executeModificarTarea()
  {
    $id_tarea = $this->getRequestParameter('id_tarea');
    $id_evento = $this->getRequestParameter('id_evento');
    $tarea = TareaPeer::RetrieveByPk($id_tarea);
    $evento = EventoPeer::RetrieveByPk($id_evento);
    $tipo_evento = Tipo_eventoPeer::RetrieveByPk($evento->getIdTipoEvento());
    $this->evento = $evento;
    $this->tipo_evento = $tipo_evento;
    $this->id_tarea = $id_tarea;
    $mensaje_error = '';

    if ($this->hasRequestParameter('opcion')) {

      $opcion = $this->getRequestParameter('opcion');

      switch ($opcion) {

        case 0: $this->titulo = 'Cambiar fecha del examen';
        break;

        case 1: $this->titulo = 'Cambiar plazo de la tarea';
        break;

        case 2: $this->titulo = 'Cambiar fecha de entrega de la tarea';
        break;

        case 3:
          $this->titulo = 'A&ntilde;adir alumnos para que realicen la tarea';

          if (!$this->hasRequestParameter('modificar')) {
            $id_curso = $tarea->getIdCurso();

            $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);

            $sql = "SELECT usuario.* FROM usuario JOIN rel_usuario_rol_curso ON usuario.id = rel_usuario_rol_curso.id_usuario JOIN rol ON rel_usuario_rol_curso.id_rol = rol.id WHERE NOT EXISTS (SELECT rel_usuario_tarea.id_usuario FROM rel_usuario_tarea WHERE rel_usuario_tarea.id_usuario = usuario.id AND rel_usuario_tarea.id_tarea = '$id_tarea') AND rel_usuario_rol_curso.id_curso = '$id_curso' AND rol.nombre = 'alumno' ORDER BY usuario.apellidos";
            $stmt = $con->createStatement();
            $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);

            $this->usuarios = UsuarioPeer::populateObjects($rs);
          }

        break;

        default: $this->titulo = '';
        break;

      }
      $this->opcion = $opcion;
    }

    if ($this->hasRequestParameter('modificar')) {

      $modificar = $this->getRequestParameter('modificar');
      $ahora = time();

      if ($this->hasRequestParameter('fechaInicio')) { $fechaInicio = $this->getRequestParameter('fechaInicio');}
      if ($this->hasRequestParameter('horaInicio')) { $horaInicio = $this->getRequestParameter('horaInicio');}
      if ($this->hasRequestParameter('fechaFin')) { $fechaFin = $this->getRequestParameter('fechaFin');}
      if ($this->hasRequestParameter('horaFin')) { $horaFin = $this->getRequestParameter('horaFin');}

      switch ($modificar) {

        case 0:
          $evento->setFechaInicio($fechaInicio." ".$horaInicio);
          $evento->setFechaFin($fechaInicio." ".$horaFin);
          if ($ahora > $evento->getFechaInicio('U')) {
            $mensaje_error = 'Debe especificar un momento futuro para la fecha y hora del examen';
          } else {
            $evento->save();
            $this->redirect('tareas/mostrarTarea?id_tarea='.$id_tarea);
          }
        break;

        case 1:
          $evento->setFechaInicio($fechaInicio." ".$horaInicio);
          $evento->setFechaFin($fechaFin." ".$horaFin);
          if ($ahora > $evento->getFechaInicio('U')) {
            $mensaje_error = 'Debe especificar un momento futuro para el comienzo del plazo de entrega de la tarea.';
          } else {
            if ($evento->getFechaFin('U') <= $evento->getFechaInicio('U')) {
              $mensaje_error = 'La fecha l&iacute;mite de entrega para la tarea debe ser posterior a la fecha de inicio del plazo.';
            } else {
              $evento->save();
              $this->redirect('tareas/mostrarTarea?id_tarea='.$id_tarea);
            }
          }
        break;

        case 2:
          $evento->setFechaFin($fechaFin." ".$horaFin);
          if ($ahora > $evento->getFechaFin('U')) {
            $mensaje_error = 'Debe especificar un momento futuro para la fecha l&iacute;mite de entrega de la tarea';
          } else {
            $evento->save();
            $this->redirect('tareas/mostrarTarea?id_tarea='.$id_tarea);
          }
        break;

        case 3:
          $total_usuarios = $this->getRequestParameter('total_usuarios');
          for ($index = 0; $index < $total_usuarios; $index++) {
            if ($this->hasRequestParameter("usuario$index")) {
              $id_usuario = $this->getRequestParameter("usuario$index");
              $rel = new Rel_usuario_tarea();
              $rel->setIdUsuario($id_usuario);
              $rel->setIdTarea($id_tarea);
              $rel->save();
            }
          }
          $this->redirect('tareas/mostrarTarea?id_tarea='.$id_tarea);
        break;

        default:
        break;
      }
    }

    $opcionesHora = array();
    for($i=8;$i<10;$i++) {
      $opcionesHora["0".$i.":00:00"] = "0".$i.":00";
      $opcionesHora["0".$i.":30:00"] = "0".$i.":30";
	  }
	  for($i=10;$i<23;$i++) {
      $opcionesHora[$i.":00:00"] = $i.":00";
      $opcionesHora[$i.":30:00"] = $i.":30";
	  }
	  $this->opcionesHora = $opcionesHora;
	  $this->mensaje_error = $mensaje_error;

  }


// #############################################################################
// #############           Mostrar Ejercicio Tarea                 #############
// #############################################################################

  public function executeMostrarEjercicioTarea()
  {
    $id_tarea = $this->getRequestParameter('id_tarea');
    $tarea = TareaPeer::RetrieveByPk($id_tarea);
    $id_ejercicio = $tarea->getIdEjercicio();
    $id_usuario = $this->getUser()->getAnyId();

    if (! $tarea->comprobarPermisoMostrar($id_usuario) )
    {
      $this->redirect('tareas/tareasPendientes/idcurso/'.$this->getUser()->getCursoMenu());
    }

    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);
    $id_respuesta_ejercicio = $relacion->getIdEjercicioResuelto();

    if ($id_respuesta_ejercicio == null) {
      $id_respuesta_ejercicio = 0;
      $cadena_respuestas = 'mostrar_respuestas=0';
      $this->estado = 'Sin intentar';
      $this->nota = '';
      $this->nombre_alumno = '';
    } else {
      $cadena_respuestas = 'mostrar_respuestas=1&id_respuesta_ejercicio='.$id_respuesta_ejercicio;
      $this->estado = 'En desarrollo';
      $respuesta_ejercicio = Ejercicio_resueltoPeer::RetrieveByPk($id_respuesta_ejercicio);
      if (!$relacion->getCorregida()) {$this->nota = '<strong>Pendiente de correci&oacute;n</strong>';}
      else {$this->nota = sprintf( "<strong>%.2f</strong> &nbsp;&nbsp;&nbsp;(sobre 10)", $respuesta_ejercicio->getScore());}
      $id_alumno = $respuesta_ejercicio->getIdAutor();
      $alumno = UsuarioPeer::RetrieveByPk($id_alumno);
      $this->nombre_alumno = $alumno->getApellidos().', '.$alumno->getNombre();
    }

    if ($relacion->getEntregada()) {$this->estado = 'Entregada';}

    if ($relacion->getCorregida()) {
      $cadena_solucion = 'mostrar_solucion=1';
      $cadena_correccion = 'mostrar_correccion=1';
    } else {
      $cadena_solucion = 'mostrar_solucion=0';
      $cadena_correccion = 'mostrar_correccion=0';
    }

    $cadena_edicion = 'mostrar_edicion=0';
    $this->ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $this->relacion = $relacion;
    $this->tarea = $tarea;
    $this->id_respuesta_ejercicio = $id_respuesta_ejercicio;

    $this->redireccion = '?id_ejercicio='.$id_ejercicio."&$cadena_respuestas&$cadena_solucion&$cadena_edicion&$cadena_correccion";

    if ($this->hasRequestParameter('error_log'))
    {
      $this->error_log = $this->getRequestParameter('error_log');
    }
    else
    {
      $this->error_log = '';
    }
  }


// #############################################################################
// #############           Resolver Ejercicio Tarea                #############
// #############################################################################

  public function executeResolverEjercicioTarea()
  {
    $id_tarea = $this->getRequestParameter('id_tarea');
    $tarea = TareaPeer::RetrieveByPk($id_tarea);
    $id_usuario = $this->getUser()->getAnyId();

    if (! $tarea->comprobarPermisoResolver($id_usuario) )
    {
      $this->redirect('tareas/mostrarEjercicioTarea?id_tarea='.$id_tarea);
    }

    $id_ejercicio = $tarea->getIdEjercicio();

    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);
    $id_respuesta_ejercicio = $relacion->getIdEjercicioResuelto();

    if ($id_respuesta_ejercicio == null) {
      $id_respuesta_ejercicio = 0;
      $cadena_respuestas = 'mostrar_respuestas=2&id_respuesta_ejercicio=0';
      $this->estado = 'Sin intentar';
    } else {
      $cadena_respuestas = 'mostrar_respuestas=2&id_respuesta_ejercicio='.$id_respuesta_ejercicio;
      $this->estado = 'En desarrollo';
    }

      $cadena_solucion = 'mostrar_solucion=0';
      $cadena_correccion = 'mostrar_correccion=0';
      $cadena_edicion = 'mostrar_edicion=0';

    $this->ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $this->relacion = $relacion;
    $this->tarea = $tarea;
    $this->id_respuesta_ejercicio = $id_respuesta_ejercicio;

    $this->redireccion = '?id_ejercicio='.$id_ejercicio."&$cadena_respuestas&$cadena_solucion&$cadena_edicion&$cadena_correccion";
  }


// #############################################################################
// #############            Guardar resultados tarea             ###############
// #############################################################################

  public function executeGuardarResultadosTarea()
  {
    $id_tarea = $this->getRequestParameter('id_tarea');
    $tarea = TareaPeer::RetrieveByPk($id_tarea);
    $id_ejercicio = $tarea->getIdEjercicio();
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $id_usuario = $this->getUser()->getAnyId();
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);
    $id_respuesta_ejercicio = $relacion->getIdEjercicioResuelto();
    $tiempo_secs = $this->getRequestParameter('tiempo');

    if ($id_respuesta_ejercicio == null)
    {
      $respuesta_ejercicio = new Ejercicio_resuelto();
      $respuesta_ejercicio->setIdEjercicio($id_ejercicio);
      $respuesta_ejercicio->setIdAutor($id_usuario);
      $respuesta_ejercicio->setTiempo($tiempo_secs);
      $respuesta_ejercicio->setIdCurso($tarea->getIdCurso());
      $respuesta_ejercicio->save();
      $id_respuesta_ejercicio = $respuesta_ejercicio->getId();
      $relacion->setIdEjercicioResuelto($id_respuesta_ejercicio);
      $relacion->save();
    } else {
      $respuesta_ejercicio = Ejercicio_resueltoPeer::RetrieveByPk($id_respuesta_ejercicio);
      $respuesta_ejercicio->setIdCurso($tarea->getIdCurso());
      $respuesta_ejercicio->setTiempo($respuesta_ejercicio->getTiempo() + $tiempo_secs);
      $respuesta_ejercicio->save();
    }


      // Aqu� guardamos el resultado del test
      if ($this->hasRequestParameter('total_preguntas_test')) {
        $test_multiple = $ejercicio->getTestMultiple();
        $total_preguntas = $this->getRequestParameter('total_preguntas_test');
        $c = new Criteria();
        $c->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $id_respuesta_ejercicio);
        Seleccion_cuestion_testPeer::DoDelete($c);

        $indice = 1;
        while ($indice != $total_preguntas) {
          $total_respuestas = $ejercicio->getNumeroRespuestas();
          $id_cuestion = $this->getRequestParameter("id_cuestion_test$indice");
          $cuestion_test = Cuestion_testPeer::RetrieveByPk($id_cuestion);

          if ($ejercicio->getIdAutor() == $respuesta_ejercicio->getIdAutor()){
            $cuestion_test->setNumeroRespuestasCorrectas(0);
            $cuestion_test->setNumeroRespuestasIncorrectas(0);
            $cuestion_test->save();
          }

          $marcados = array();
          $nomarcados = array();

          // Comprobamos para cada checkbox de las respuestas que ten�a la cuesti�n
          // de test que estamos explorando en esta iteraci�n si estaba activo.
          // Si estaba activo guardamos el identificador de la respuesta correspondiente
          // en el array $pendientes_crear.
          $index = 0;
          $numero_marcados = 0;
          while ($index != $total_respuestas) {
            $id_respuesta = $this->getRequestParameter("hiddenr$index".'c'.$indice);
            if ($this->hasRequestParameter("checkboxr$index".'c'.$indice)) {
              array_push($marcados, $id_respuesta);
               $numero_marcados++;
            } else {
              array_push($nomarcados, $id_respuesta);
            }
            $index++;
          }

          if (($test_multiple) || ($numero_marcados <= 1)) {

            foreach($marcados as $id_respuesta) {
              $seleccion = new Seleccion_cuestion_test();
              $seleccion->SetIdEjercicioResuelto($id_respuesta_ejercicio);
              $seleccion->SetIdRespuestaCuestionTest($id_respuesta);
              $seleccion->save();
            }

          }

          unset($marcados);
          unset($nomarcados);
          $indice++;
        }
      }

      // Aqui guardamos el resultado del cuestionario
      if ($this->hasRequestParameter('total_preguntas_cuestionario')) {
        $total_preguntas = $this->getRequestParameter('total_preguntas_cuestionario');
        $indice = 1;
        while ($indice != $total_preguntas) {
          $texto_respuesta = $this->getRequestParameter("respuesta_cuestion_corta$indice");
          $id_respuesta = $this->getRequestParameter("id_respuesta_cuestion_corta$indice");
          if ($id_respuesta) {
            $respuesta = Respuesta_cuestion_cortaPeer::RetrieveByPk($id_respuesta);
          } else {
            $respuesta = new Respuesta_cuestion_corta();
            $respuesta->setIdEjercicioResuelto($id_respuesta_ejercicio);
            $respuesta->setIdCuestionCorta($this->getRequestParameter("id_cuestion_corta$indice"));
          }
            $respuesta->setRespuesta($texto_respuesta);
            $respuesta->save();
            $indice++;
        }
      }

      // Aqui guardamos el resultado de los problemas
      if ($this->hasRequestParameter('total_preguntas_practicas'))
      {

        $id_respuesta_ejercicio = $respuesta_ejercicio->getId();
        $total_preguntas = $this->getRequestParameter('total_preguntas_practicas');
        $indice = 1;
        while ($indice != $total_preguntas)
        {
          $id_cuestion_practica = $this->getRequestParameter("id_cuestion_practica$indice");
          $c = new Criteria();
          $c->add(Respuesta_cuestion_practicaPeer::ID_EJERCICIO_RESUELTO, $id_respuesta_ejercicio);
          $c->add(Respuesta_cuestion_practicaPeer::ID_CUESTION_PRACTICA, $id_cuestion_practica);
          $respuesta = Respuesta_cuestion_practicaPeer::DoSelectOne($c);

          if (!$respuesta)
          {
            $respuesta = new Respuesta_cuestion_practica();
            $respuesta->setIdEjercicioResuelto($id_respuesta_ejercicio);
            $respuesta->setIdCuestionPractica($this->getRequestParameter("id_cuestion_practica$indice"));
            $respuesta->save();
          }
          $indice++;
        }

        $ruta = SF_ROOT_DIR.'/web/uploads/problemas/';
        $error_log = '';

        $max_hojas_respuesta = $ejercicio->getNumeroHojas();
        $rutas = array();
        for ($i_hojas = 1; $i_hojas <= $max_hojas_respuesta; $i_hojas++)
        {

          // Procesamos cada imagen
          $nerrores = 0;

          if ($_FILES['upfile'.$i_hojas]['name'] != '')
          {
            if ($_FILES['upfile'.$i_hojas]['size'] > 300000)
            {
              $error_log.= 'El fichero enviado como hoja de respuestas #'.$i_hojas.' es demasiado grande, supera los 300Kb.<br>';
              $nerrores++;
            }

            if (!(($_FILES['upfile'.$i_hojas]['type'] == 'image/jpg') || ($_FILES['upfile'.$i_hojas]['type'] == 'image/jpeg') || ($_FILES['upfile'.$i_hojas]['type'] == 'image/pjpeg')))
            {
              $error_log.= 'El formato de la hoja de respuestas #'.$i_hojas.' no es compatible. Se requiere JPG o equivalente.<br>';
              $nerrores++;
            }

            if ($nerrores)
            {
              $error_log.= 'No se acepto el fichero enviado como hoja de respuestas #'.$i_hojas.' .<br>';
            }
            else
            {
              $rutas[]=$ruta.'respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas.'.jpg';
              if (file_exists($ruta.'respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas.'.jpg'))
              {
                unlink($ruta.'respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas.'.jpg');
              }
              //move_uploaded_file($_FILES['upfile'.$i_hojas]['tmp_name'], $ruta.'respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas.'.jpg');
              copy($_FILES['upfile'.$i_hojas]['tmp_name'], $ruta.'respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas.'.jpg');
            }
          }
        }
        $this->rutas = $rutas;

        if ($error_log != '')
        {
          $this->redirect('tareas/mostrarEjercicioTarea?id_tarea='.$id_tarea.'&error_log='.$error_log);
        }
      }

  $this->redirect('tareas/mostrarEjercicioTarea?id_tarea='.$id_tarea);
  }


// #############################################################################
// ##########                       Reclamar                         ###########
// #############################################################################
  public function executeReclamar()
  {
    $id_tarea = $this->getRequestParameter('id_tarea');
    $tarea = TareaPeer::RetrieveByPk($id_tarea);
    $id_ejercicio = $tarea->getIdEjercicio();
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $id_profesor = $ejercicio->getIdAutor();
    $id_alumno = $this->getUser()->getAnyId();
    $alumno = UsuarioPeer::RetrieveByPk($id_alumno);
    $profesor = UsuarioPeer::RetrieveByPk($id_profesor);

    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_alumno);
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);
    $id_respuesta_ejercicio = $relacion->getIdEjercicioResuelto();

    if ($id_respuesta_ejercicio)
    {
      $notificacion = new Notificacion();
      $notificacion->setIdUsuario($id_profesor);
      $notificacion->setIdCurso($tarea->getIdCurso());
      $notificacion->setTitulo('Reclamaci&oacute;n '.$ejercicio->getTitulo());
      $texto = 'El alumno '.$alumno->getNombre().' '.$alumno->getApellidos().' ha solicitado reclamaci&oacute;n del ejercicio '.$ejercicio->getTitulo().'. <br>Haga click en <a onclick="'."var w=window.open(this.href,'','width=780,height=740,toolbar=0,location=0,status=0,menubar=0,resizable=0,scrollbars=1,top=0,left=200');w.focus();return false;".'" href="/evaluacion/mostrarEjercicioEvaluacion?id_respuesta_ejercicio='.$id_respuesta_ejercicio.'">este enlace</a> para ver la soluci&oacute;n del alumno.';
      $notificacion->setContenido($texto);
      $notificacion->save();
    }

  }

}
