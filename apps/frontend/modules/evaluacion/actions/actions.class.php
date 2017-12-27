<?php
/**
 * evaluacion actions.
 *
 * @package    edoceo
 * @subpackage evaluacion
 * @author     Angel Martin Latasa
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class evaluacionActions extends sfActions
{
  public function executeIndex()
  {
    $this->rol = $this->getUser()->obtenerCredenciales();
    $this->redireccion = '?idcurso='.$this->getRequestParameter('idcurso');
    $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
  }
	//
  public function executeListarEjerciciosEntregados()
  {
    $id_tarea = $this->getRequestParameter('id_tarea');
    $this->tipo_evento = $this->getRequestParameter('tipo_evento');

    $c = new Criteria();
    $c->add(TareaPeer::ID, $id_tarea);
    $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::LESS_THAN);
    $criterion2 = $c->getNewCriterion(Rel_usuario_tareaPeer::ENTREGADA, 1);
    $criterion1->addOr($criterion2);
    $c->add($criterion1);

    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_tareaPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $c->addAsColumn('nombre', UsuarioPeer::NOMBRE);
    $c->addAsColumn('apellidos', UsuarioPeer::APELLIDOS);
    $c->addAsColumn('id_ejercicio', TareaPeer::ID_EJERCICIO);
    $c->addAsColumn('ejresuelto', Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO);
    $c->addAsColumn('entregada', Rel_usuario_tareaPeer::ENTREGADA);
    $c->addAsColumn('fecha_entrega', Rel_usuario_tareaPeer::FECHA_ENTREGA);
    $c->addAsColumn('fecha', EventoPeer::FECHA_FIN);
    $c->addAsColumn('corregida', Rel_usuario_tareaPeer::CORREGIDA);

    $this->pendientes_correccion = BasePeer::DoSelect($c);
  }
	//
  public function executeGuardarEvaluacion()
  {
    $id_ejercicio = $this->getRequestParameter('id_ejercicio');
    $id_solucion_alumno = $this->getRequestParameter('solucion_alumno');
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $solucion_alumno = Ejercicio_resueltoPeer::RetrieveByPk($id_solucion_alumno);

    $nota_total = 0;
    $nota_acumulada = 0;
    $blancos = 0;
    $aciertos = 0;
    $fallos = 0;

    // Aqui autocorregimos y evaluamos la parte del test
    if ($ejercicio->getTipo() == 'test') {

      $c = new Criteria();
      $c->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $id_solucion_alumno);
      $c->addJoin(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, Respuesta_cuestion_testPeer::ID);
      $c->addJoin(Respuesta_cuestion_testPeer::ID_CUESTION_TEST, Cuestion_testPeer::ID);
      $c->addAsColumn('ncorrectas', Cuestion_testPeer::NUMERO_RESPUESTAS_CORRECTAS);
      $c->addAsColumn('nincorrectas', Cuestion_testPeer::NUMERO_RESPUESTAS_INCORRECTAS);
      $c->addAsColumn('escorrecta', Respuesta_cuestion_testPeer::CORRECTA);
      $c->addAsColumn('id_cuestion', Cuestion_testPeer::ID);
      $resumen_test = BasePeer::DoSelect($c);
      $nota_test = 0;
      $id_comp = 0;
      $contestadas = 0;

      foreach ($resumen_test as $elemento_test) {
        if ($elemento_test[2]) {
          $nota_test += (1 / ($elemento_test[0]));
          $aciertos++;
        } else {
          if ($ejercicio->getTestResta()){
            $nota_test -= (1 / ($elemento_test[1]));
          }
          $fallos++;
        }
        if ($id_comp != ($elemento_test[3])) {
          $contestadas++; $id_comp = $elemento_test[3];
        }
      }
      // Ahora vamos a calcular la nota total del test
      $c = new Criteria();
      $c->add(Cuestion_testPeer::ID_EJERCICIO, $id_ejercicio);
      $nota_total = Cuestion_testPeer::DoCount($c);
      $blancos = $nota_total - $contestadas;
      $solucion_alumno->setBlancos($blancos);
      $solucion_alumno->setAciertos($aciertos);
      $solucion_alumno->setFallos($fallos);

      // Sumamos la nota obtenida al total (solo si la nota es positiva)
      if ($nota_test > 0) {$nota_acumulada += $nota_test;}
    }
    // Aqui el cuestionario
    if ($ejercicio->getTipo() == 'cuestionario') {
      $numero_preguntas = $this->getRequestParameter('total_preguntas_cuestionario');

      for ($index = 1; $index < $numero_preguntas; $index++) {
        $id_respuesta = $this->getRequestParameter("id_respuesta_cuestion_corta$index");
        $puntuacion = $this->getRequestParameter("puntuacion_cuestion$index");
        $respuesta = Respuesta_cuestion_cortaPeer::RetrieveByPk($id_respuesta);
        $pregunta = Cuestion_cortaPeer::RetrieveByPk($respuesta->getIdCuestionCorta());
        $puntuacion_max = $pregunta->getPuntuacion();
        if ($puntuacion > $puntuacion_max) {$puntuacion = $puntuacion_max;}
        if ($puntuacion < 0) {$puntuacion = 0;}
        $nota_total += $puntuacion_max;
        $nota_acumulada += $puntuacion;
        $respuesta->setComentario($this->getRequestParameter("comentario_cuestion_corta$index"));
        $respuesta->setPuntuacion($puntuacion);
        $respuesta->save();
      }
    }
    // Aqui el cuestionario
    if ($ejercicio->getTipo() == 'problemas') {
      $numero_preguntas = $this->getRequestParameter('total_preguntas_practicas');

      for ($index = 1; $index < $numero_preguntas; $index++) {
        $id_respuesta = $this->getRequestParameter("id_respuesta_cuestion_practica$index");
        $puntuacion = $this->getRequestParameter("puntuacion_cuestion$index");
        $respuesta = Respuesta_cuestion_practicaPeer::RetrieveByPk($id_respuesta);
        $pregunta = Cuestion_practicaPeer::RetrieveByPk($respuesta->getIdCuestionPractica());
        $puntuacion_max = $pregunta->getPuntuacion();
        if ($puntuacion > $puntuacion_max) {$puntuacion = $puntuacion_max;}
        if ($puntuacion < 0) {$puntuacion = 0;}
        $nota_total += $puntuacion_max;
        $nota_acumulada += $puntuacion;
        $respuesta->setPuntuacion($puntuacion);
        $respuesta->save();
      }
    }
    // Guardamos la nota, la fecha de correccion y el profesor que realizo la correccion en el ejercicio del alumno
    $solucion_alumno->setIdCorrector($this->getUser()->getAnyId());
    $solucion_alumno->setFechaCorreccion(time());
    $nota_final = ($nota_acumulada / $nota_total) * 10;
    $solucion_alumno->setScore($nota_final);
    $solucion_alumno->save();

    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $id_solucion_alumno);
    $rel_usuario_tarea = Rel_usuario_tareaPeer::DoSelectOne($c);
    $rel_usuario_tarea->setCorregida(1);
    $rel_usuario_tarea->save();

    $profesor = UsuarioPeer::RetrieveByPk($this->getUser()->getAnyId());

    $notificacion = new Notificacion();
    $notificacion->setIdUsuario($solucion_alumno->getIdAutor());
    $notificacion->setIdCurso($rel_usuario_tarea->getTarea()->getIdCurso());
    $notificacion->setTitulo('Evaluaci&oacute;n de "'.$ejercicio->getTitulo().'"');
    $texto_nota = sprintf("Has sacado un <strong>%.2f</strong> sobre 10.", $nota_final);
    $texto = 'El profesor '.$profesor->getNombre().' '.$profesor->getApellidos().' ha corregido el ejercicio "'.$ejercicio->getTitulo().'". <br><br>'.$texto_nota.'<br><br>Haz click en <a href="/tareas/mostrarEjercicioTarea?id_tarea='.$rel_usuario_tarea->getIdTarea().'">este enlace</a> para ver la evaluaci&oacute;n del ejercicio.';
    $notificacion->setContenido($texto);
    $notificacion->save();

    $this->redirect('evaluacion/mostrarEjercicioEvaluacion?id_respuesta_ejercicio='.$id_solucion_alumno);
  }
	//
  public function executeEvaluacionRevision()
  {
    if ($this->hasRequestParameter('idcurso')) {
      $this->id_curso = $this->getRequestParameter('idcurso');
    } else {
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
	//
  public function executeListarTareasEvaluacion()
  {
    $id_profesor = $this->getUser()->getAnyId();
    $id_curso = $this->getRequestParameter('filtro');
    $c = new Criteria();

    if ($id_curso) {$c->add(EventoPeer::ID_CURSO, $id_curso);}

    $c->add(TareaPeer::ID_AUTOR, $id_profesor);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(EventoPeer::ID_CURSO, CursoPeer::ID);
    $c->addJoin(EventoPeer::ID_TIPO_EVENTO, Tipo_eventoPeer::ID);
    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);
    $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::LESS_THAN);
    $criterion2 = $c->getNewCriterion(Rel_usuario_tareaPeer::ENTREGADA, 1);
    $criterion1->addOr($criterion2);
    $c->add($criterion1);
    $c->addGroupByColumn(TareaPeer::ID);
    $this->eventos = EventoPeer::DoSelect($c);
    $this->tareas = TareaPeer::DoSelect($c);
    $this->cursos = CursoPeer::DoSelect($c);
    $this->tipos_evento = Tipo_eventoPeer::DoSelect($c);
  }
	//
  public function executeListarTareasEvaluacionCorto()
  {
    $id_profesor = $this->getUser()->getAnyId();
    $id_curso = $this->getRequestParameter('filtro');
    $c = new Criteria();

    if ($id_curso) {$c->add(EventoPeer::ID_CURSO, $id_curso);}

    $c->add(TareaPeer::ID_AUTOR, $id_profesor);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(EventoPeer::ID_CURSO, CursoPeer::ID);
    $c->addJoin(EventoPeer::ID_TIPO_EVENTO, Tipo_eventoPeer::ID);
    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);
    $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::LESS_THAN);
    $criterion2 = $c->getNewCriterion(Rel_usuario_tareaPeer::ENTREGADA, 1);
    $criterion1->addOr($criterion2);
    $c->add($criterion1);
    $c->add(Rel_usuario_tareaPeer::CORREGIDA, 0);
    $c->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, null, Criteria::NOT_EQUAL);
    $c->addGroupByColumn(TareaPeer::ID);
    $this->eventos = EventoPeer::DoSelect($c);
    $this->tareas = TareaPeer::DoSelect($c);
    $this->cursos = CursoPeer::DoSelect($c);
  }
	//
  public function executeMostrarTareaEvaluacion()
  {
    $id_tarea = $this->getRequestParameter('id_tarea');
    $tarea = TareaPeer::RetrieveByPk($id_tarea);
    $this->tarea = $tarea;
    $this->id_ejercicio = $tarea->getIdEjercicio();
    $evento = EventoPeer::RetrieveByPk($tarea->getIdEvento());
    $this->evento = $evento;
    $this->curso = CursoPeer::RetrieveByPk($evento->getIdCurso());
    $this->tipo_evento = Tipo_eventoPeer::RetrieveByPk($evento->getIdTipoEvento());

    $ejercicio = EjercicioPeer::RetrieveByPk($this->id_ejercicio);

    if ($ejercicio->getTipo() == 'test')
    {
      $c = new Criteria();
      $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $ejercicio->getIdAutor());
      $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $ejercicio->getId());
      $solucion = Ejercicio_resueltoPeer::DoSelectOne($c);

      if ($solucion)
      {
        $this->solucion_test = true;
        $c = new Criteria();
        $c->add(Cuestion_testPeer::ID_EJERCICIO, $ejercicio->getId());
        $numero_preguntas = Cuestion_testPeer::DoCount($c);

        $c->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $solucion->getId());
        $c->addJoin(Cuestion_testPeer::ID, Respuesta_cuestion_testPeer::ID_CUESTION_TEST);
        $c->addJoin(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, Respuesta_cuestion_testPeer::ID);
        $c->setDistinct(Cuestion_testPeer::ID);
        $numero_preguntas_respondidas = Cuestion_testPeer::DoCount($c);

        if ($numero_preguntas > $numero_preguntas_respondidas) {
          $this->solucion_incompleta = true;
        } else {
          $this->solucion_incompleta = false;
        }
      } else {
        $this->solucion_test = false;
      }
    }
    $this->tipo_ejercicio = $ejercicio->getTipo();
  }
	//
  public function executeCalificaciones()
  {
    if ($this->hasRequestParameter('idcurso')) {
      $this->id_curso = $this->getRequestParameter('idcurso');
    } else {
      $this->id_curso = 0;
    }
    $cursos_temp = $this->getUser()->getCursosAny();
    $cursos = array();
    $cursos[0] = 'Elija un curso';

    foreach($cursos_temp as $curso_temp) {
      $cursos[$curso_temp->getIdCurso()] = $curso_temp->getCurso()->getNombre();
    }
    $this->cursos = $cursos;

    $modalidad = array();
    $modalidad[0] = 'Mostrar calificaciones por alumno';
    $modalidad[1] = 'Mostrar calificaciones por ejercicio';
    $this->modalidad = $modalidad;
  }
	//
  public function executeListarAlumnosEvaluacion()
  {
    $id_curso = $this->getRequestParameter('filtro');
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, 'alumno');
    $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $id_curso);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $this->alumnos = UsuarioPeer::DoSelect($c);
    $this->id_curso = $id_curso;
  }
	//
  public function executeResumenEvaluacionAlumno()
  {
    $id_curso = $this->getRequestParameter('id_curso');
    $id_alumno = $this->getRequestParameter('id_alumno');
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
    $c->add(CalificacionesPeer::ID_USUARIO, $id_alumno);
    $c->add(CalificacionesPeer::ID_CURSO, $id_curso);
    $cal = CalificacionesPeer::DoSelectOne($c);
    if ($cal) {$this->ultima_nota = $cal->getScore();}
    else {$this->ultima_nota = '';}

    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $id_alumno);
    $c->add(Ejercicio_resueltoPeer::REPOSITORIO, 0);
    $c->add(CursoPeer::ID, $id_curso);
    $c->addJoin(EjercicioPeer::ID_MATERIA, CursoPeer::MATERIA_ID);
    $c->addJoin(EjercicioPeer::ID, Ejercicio_resueltoPeer::ID_EJERCICIO);
    $resultados = Ejercicio_resueltoPeer::DoSelect($c);
    $tiempo_tareas = 0;

    foreach ($resultados as $resultado) {
      $tiempo_tareas += $resultado->getTiempo();
    }
    $c->add(Ejercicio_resueltoPeer::REPOSITORIO, 1);
    $resultados = Ejercicio_resueltoPeer::DoSelect($c);
    $tiempo_repositorio = 0;

    foreach ($resultados as $resultado) {
      $tiempo_repositorio += $resultado->getTiempo();
    }    
    $this->tiempo_estudio = $this->alumno->getTiempoTotalTeoria($id_curso);
    $this->tiempo_tareas  = $tiempo_tareas;
    $this->tiempo_repositorio = $tiempo_repositorio;
    $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
    
    $this->setLayout('PopUpEvaluacion');
  }
	//
  public function executeResumenEvaluacionEjercicio()
  {
    $id_curso = $this->getRequestParameter('filtro');
    $c = new Criteria();
    $c->add(TareaPeer::ID_CURSO, $id_curso);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(Tipo_eventoPeer::ID, EventoPeer::ID_TIPO_EVENTO);
    $c->addAsColumn('id_tarea', TareaPeer::ID);
    $c->addAsColumn('ejercicio', EventoPeer::DESCRIPCION);
    $c->addAsColumn('categoria', Tipo_eventoPeer::DESCRIPCION);
    $this->ejercicios = BasePeer::DoSelect($c);
    $this->id_curso = $id_curso;
  }
	//
  public function executeMostrarEjercicioEvaluacion()
  {
    $id_respuesta_ejercicio = $this->getRequestParameter('id_respuesta_ejercicio');
    $respuesta_ejercicio = Ejercicio_resueltoPeer::RetrieveByPk($id_respuesta_ejercicio);
    $id_ejercicio = $respuesta_ejercicio->getIdEjercicio();
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $id_respuesta_ejercicio);
    $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);

    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $ejercicio->getIdAutor());
    $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $ejercicio->getId());
    $solucion_profe = Ejercicio_resueltoPeer::DoSelectOne($c);

    if ($solucion_profe) {
      $cadena_solucion = 'mostrar_solucion=1&id_solucion_ejercicio='.$solucion_profe->getId();
    } else {
      $cadena_solucion = 'mostrar_solucion=0';
    }
    $cadena_respuestas = 'mostrar_respuestas=1&id_respuesta_ejercicio='.$id_respuesta_ejercicio;
    $cadena_edicion = 'mostrar_edicion=0';

    if ($relacion->getCorregida()) {
      $cadena_correccion = 'mostrar_correccion=1';
    } else {
      $cadena_correccion = 'mostrar_correccion=0';
    }
    $this->ejercicio = $ejercicio;
    $this->respuesta_ejercicio = $respuesta_ejercicio;

    if (!$relacion->getCorregida()) {$this->nota = '<strong>Pendiente de correci&oacute;n</strong>';}
    else {$this->nota = sprintf( "<strong>%.2f</strong> &nbsp;&nbsp;&nbsp;(sobre 10)", $respuesta_ejercicio->getScore());}

    $id_alumno = $respuesta_ejercicio->getIdAutor();
    $alumno = UsuarioPeer::RetrieveByPk($id_alumno);
    $this->nombre_alumno = $alumno->getApellidos().', '.$alumno->getNombre();

    $this->redireccion = '?id_ejercicio='.$id_ejercicio."&$cadena_respuestas&$cadena_solucion&$cadena_edicion&$cadena_correccion";
    $this->setLayout('popUpEvaltarea');
  }
	//
  public function executeEvaluarEjercicio()
  {
    $id_respuesta_ejercicio = $this->getRequestParameter('id_respuesta_ejercicio');
    $respuesta_ejercicio = Ejercicio_resueltoPeer::RetrieveByPk($id_respuesta_ejercicio);
    $id_ejercicio = $respuesta_ejercicio->getIdEjercicio();
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, $id_respuesta_ejercicio);
    $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);

    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $ejercicio->getIdAutor());
    $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $ejercicio->getId());
    $solucion_profe = Ejercicio_resueltoPeer::DoSelectOne($c);

    if ($solucion_profe) {
      $cadena_solucion = 'mostrar_solucion=1&id_solucion_ejercicio='.$solucion_profe->getId();
    } else {
      $cadena_solucion = 'mostrar_solucion=0';
    }
    $cadena_respuestas = 'mostrar_respuestas=1&id_respuesta_ejercicio='.$id_respuesta_ejercicio;
    $cadena_edicion = 'mostrar_edicion=0';
    $cadena_correccion = 'mostrar_correccion=2';

    $this->ejercicio = $ejercicio;
    $this->respuesta_ejercicio = $respuesta_ejercicio;

    if (!$relacion->getCorregida()) {$this->nota = '<strong>Pendiente de correci&oacute;n</strong>';}
    else {$this->nota = sprintf( "<strong>%.2f</strong> &nbsp;&nbsp;&nbsp;(sobre 10)", $respuesta_ejercicio->getScore());}

    $id_alumno = $respuesta_ejercicio->getIdAutor();
    $alumno = UsuarioPeer::RetrieveByPk($id_alumno);
    $this->nombre_alumno = $alumno->getApellidos().', '.$alumno->getNombre();

    $this->redireccion = '?id_ejercicio='.$id_ejercicio."&$cadena_respuestas&$cadena_solucion&$cadena_edicion&$cadena_correccion";
    $this->setLayout('popUpEvaltarea');
  }
	//
  public function executeGuardarCalificacion()
  {
    $id_alumno = $this->getRequestParameter('id_alumno');
    $id_curso = $this->getRequestParameter('id_curso');
    $nota = $this->getRequestParameter('nota_final');

    echo $nota;
    echo $id_curso;
    echo $id_alumno;
    
    
    $c = new Criteria();
    $c->add(CalificacionesPeer::ID_USUARIO, $id_alumno);
    $c->add(CalificacionesPeer::ID_CURSO, $id_curso);
    $cal = CalificacionesPeer::DoSelectOne($c);

    if ($cal) {
      $cal->getScore();
      exit();  
      $cal->setScore($nota);
    } else {
      $cal = new calificaciones();
      $cal->setIdUsuario($id_alumno);
      $cal->setIdCurso($id_curso);
      $cal->setScore($nota);
    }
    $cal->save();
    $this->setLayout('PopUpEvaluacion');
  }
	//
  public function executeCorregirTests()
  {
    $id_tarea  = $this->getRequestParameter('id_tarea');
    $tarea     = TareaPeer::RetrieveByPk($id_tarea);
    $ejercicio = EjercicioPeer::RetrieveByPk($tarea->getIdEjercicio());

    $c = new Criteria();
    $c->add(TareaPeer::ID, $id_tarea);
    $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::LESS_THAN);
    $criterion2 = $c->getNewCriterion(Rel_usuario_tareaPeer::ENTREGADA, 1);
    $criterion1->addOr($criterion2);
    $c->add($criterion1);
    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);
    $ejercicios = Ejercicio_resueltoPeer::DoSelect($c);
    
    $c = new Criteria();
    $c->add(Cuestion_testPeer::ID_EJERCICIO, $ejercicio->getId());
    $nota_total = Cuestion_testPeer::DoCount($c);
    $profesor = UsuarioPeer::RetrieveByPk($this->getUser()->getAnyId());

    foreach ($ejercicios as $solucion_alumno)
    {
      $nota_acumulada = 0;
      $blancos        = 0;
      $aciertos       = 0;
      $fallos         = 0;
      $nota_test      = 0;
      $id_comp        = 0;
      $contestadas    = 0;

      $c = new Criteria();
      $c->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $solucion_alumno->getId());
      $c->addJoin(Seleccion_cuestion_testPeer::ID_RESPUESTA_CUESTION_TEST, Respuesta_cuestion_testPeer::ID);
      $c->addJoin(Respuesta_cuestion_testPeer::ID_CUESTION_TEST, Cuestion_testPeer::ID);
      $c->addAsColumn('ncorrectas', Cuestion_testPeer::NUMERO_RESPUESTAS_CORRECTAS);
      $c->addAsColumn('nincorrectas', Cuestion_testPeer::NUMERO_RESPUESTAS_INCORRECTAS);
      $c->addAsColumn('escorrecta', Respuesta_cuestion_testPeer::CORRECTA);
      $c->addAsColumn('id_cuestion', Cuestion_testPeer::ID);
      $resumen_test = BasePeer::DoSelect($c);

      foreach ($resumen_test as $elemento_test)
      {
        if ($elemento_test[2]) {
          $nota_test += (1 / ($elemento_test[0]));
          $aciertos++;
        } else {
          if ($ejercicio->getTestResta()){
            $nota_test -= (1 / ($elemento_test[1]));
          }
          $fallos++;
        }
        if ($id_comp != ($elemento_test[3])) {
          $contestadas++; $id_comp = $elemento_test[3];
        }
      }
      // Ahora vamos a calcular la nota total del test
      $blancos = $nota_total - $contestadas;
      $solucion_alumno->setBlancos($blancos);
      $solucion_alumno->setAciertos($aciertos);
      $solucion_alumno->setFallos($fallos);

      // Sumamos la nota obtenida al total (solo si la nota es positiva)
      if ($nota_test > 0) {$nota_acumulada += $nota_test;}

      // Guardamos la nota, la fecha de correccion y el profesor que realizo la correccion en el ejercicio del alumno
      $solucion_alumno->setIdCorrector($this->getUser()->getAnyId());
      $solucion_alumno->setFechaCorreccion(time());
      $nota_final = ($nota_acumulada / $nota_total) * 10;
      $solucion_alumno->setScore($nota_final);
      $solucion_alumno->save();

      $c = new Criteria();
      $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
      $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $solucion_alumno->getIdAutor());
      $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);
      $relacion->setCorregida(1);
      $relacion->save();

      $notificacion = new Notificacion();
      $notificacion->setIdUsuario($solucion_alumno->getIdAutor());
      $notificacion->setIdCurso($relacion->getTarea()->getIdCurso());
      $notificacion->setTitulo('Evaluaci&oacute;n de "'.$ejercicio->getTitulo().'"');
      $texto_nota = sprintf("Has sacado un <strong>%.2f</strong> sobre 10.", $nota_final);
      $texto = 'El profesor '.$profesor->getNombre().' '.$profesor->getApellidos().' ha corregido el ejercicio "'.$ejercicio->getTitulo().'". <br><br>'.$texto_nota.'<br><br>Haz click en <a href="/tareas/mostrarEjercicioTarea?id_tarea='.$relacion->getIdTarea().'">este enlace</a> para ver la evaluaci&oacute;n del ejercicio.';
      $notificacion->setContenido($texto);
      $notificacion->save();
    }
    $this->redirect('evaluacion/mostrarTareaEvaluacion?id_tarea='.$id_tarea);
  }

  // Permite seleccionar los ejercicios que evaluaran el modulo
  public function executeEvaluacionModulo()
  {
    if ($this->getRequestParameter('save')) {
      $this->saveok = true;
    }
    $idmodulo = $this->getRequestParameter('idmodulo');
    $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
	  $this->forward404Unless($this->modulo);

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
  }

  // Guarda la seleccion los ejercicios que evaluaran el modulo
  public function executeGuardarEvaluacionModulo()
  {
    $idmodulo = $this->getRequestParameter('idmodulo');
    $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
	  $this->forward404Unless($this->modulo);

	  $totalTest = $this->getRequestParameter('totalTest');
	  $totalCuestionarios = $this->getRequestParameter('totalCuestionarios');
    $totalProblemas = $this->getRequestParameter('totalProblemas');
    $con = Propel::getConnection();

   	try {
      $con->begin();

      $c = new Criteria();
      $c->add(Evaluacion_paquetePeer::ID_PAQUETE, $idmodulo);
      $borrar = Evaluacion_paquetePeer::doDelete($c);  /*borramos el anterior criterio de evaluacion, para que no de problemas con las claves*/

           for ($i=0;$i<$totalTest;$i++)
	         {
	         	if ($this->getRequestParameter('test'.$i))
	         	{
              	if ($this->getRequestParameter('pesoTest'.$i))
              	{
               		$tarea = TareaPeer::retrieveByPk($this->getRequestParameter('test'.$i));
                  $this->forward404Unless($tarea);
                  $evaluacion = new Evaluacion_paquete();
                  $evaluacion->setIdPaquete($idmodulo);
                  //$evaluacion->setIdEjercicio($tarea->getEjercicio()->getId());
                  $evaluacion->setIdTarea($tarea->getId());
                  $evaluacion->setPeso($this->getRequestParameter('pesoTest'.$i));
                  $evaluacion->save();
                }
              }
            }
        	  for ($i=0;$i<$totalCuestionarios;$i++)
        	  {
        	    if ($this->getRequestParameter('cuestionario'.$i))
              {
              	if ($this->getRequestParameter('pesoCuest'.$i))
                {
                    $tarea = TareaPeer::retrieveByPk($this->getRequestParameter('cuestionario'.$i));
                    $this->forward404Unless($tarea);
                    $evaluacion = new Evaluacion_paquete();
                    $evaluacion->setIdPaquete($idmodulo);
                    //$evaluacion->setIdEjercicio($tarea->getEjercicio()->getId());
                    $evaluacion->setIdTarea($tarea->getId());
                    $evaluacion->setPeso($this->getRequestParameter('pesoCuest'.$i));

                    $evaluacion->save();
                 }
        	    }
            }
        	  for ($i=0;$i<$totalProblemas;$i++)
        	  {
        	  	if ($this->getRequestParameter('problema'.$i))
              {
              	if ($this->getRequestParameter('pesoProb'.$i))
                {
                	  $tarea = TareaPeer::retrieveByPk($this->getRequestParameter('problema'.$i));
                    $this->forward404Unless($tarea);
                    $evaluacion = new Evaluacion_paquete();
                    $evaluacion->setIdPaquete($idmodulo);
                    //$evaluacion->setIdEjercicio($tarea->getEjercicio()->getId());
                    $evaluacion->setIdTarea($tarea->getId());
                    $evaluacion->setPeso($this->getRequestParameter('pesoProb'.$i));
                    $evaluacion->save();
                  }
        	      }
             }
            $con->commit();
     }
 		 catch (Exception $e) {	$con->rollback(); throw $e; }
  	 $this->redirect('evaluacion/evaluacionModulo?idmodulo='.$idmodulo.'&save=ok');
  }

  // Actualiza las nostas de los alumnos en el modulo segun los criterios de evaluacion del paquete
  public function executeEvaluarModulo()
  {
    $idmodulo = $this->getRequestParameter('idmodulo');
    $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
	  $this->forward404Unless($this->modulo);

	  $this->tareas_evaluacion = $this->modulo->getEvaluacion();

	  $datos = $this->modulo->getEvaluacionAlumnos($this->ejercicios_evaluacion,1);
	  $this->datos = $datos;
	}

} // end class