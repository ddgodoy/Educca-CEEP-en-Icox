<?php
/**
 * calendario actions.
 *
 * @package    edoceo
 * @subpackage calendario
 * @author     Jacobo
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class seguimientoComponents extends sfComponents
{
  /**
   * Executes index action
   *
   */
  public function executeDefault()
  {
  }

  // Nombre del método: executeListaAlumnos()
  // Añadida por: Jacobo Chaquet
  /* Descripción: muestra los alumnos en un curso
                  solo para profesores
                  NOTA: si no recibe idcurso mostrara todos los alumnos de la base de datos
   */
  public function executeListaAlumnos()
  {
   if (!$this->getUser()->hasCredential('profesor') )
   {
        	return $this->redirect('login/logout');
   }
  if (!isset($this->alumnos))
   {
      	$usuarios = new Usuario();
      	$c2 = new Criteria();
      	$c2->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
   	    $this->alumnos = $usuarios->getAlumnos($this->idcurso,$c2);
	 }
  }

  // Nombre del método: FichaEvaluacion()
  // Añadida por: Ángel Martín
  // Descripción: Muestra las calificaciones obtenidas en todos los ejercicios
  // del mismo curso, tiempo dedicado en ejercicios y revisar temario etc...
  public function executeFichaEvaluacion() {

    $id_curso = $this->idcurso;

    if ($this->getUser()->hasCredential('supervisor'))
    {
      $id_alumno = $this->idalumno;
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

  }

}