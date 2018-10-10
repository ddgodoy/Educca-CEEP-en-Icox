<?php

  // Nombre del método: getRelacionTarea($id_tarea)
  // Añadida por: Ángel Martín Latasa
  // Descripción: Devuelve un objeto rel_usuario_tarea si el usuario está
  // implicado en la tarea que tiene el identificador que se pasa como parámetro
  function getRelacionUsuarioTarea($id_usuario, $id_tarea)
  {
    $c = new Criteria();

    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);

    $relacion = Rel_usuario_tareaPeer::doSelectOne($c);
    return $relacion;
  }
  

  // Nombre del método: getScoreEjercicio($id_ejercicio_resuelto)
  // Añadida por: Ángel Martín Latasa
  // Descripción: Devuelve la nota obtenida en el ejercicio resuelto con el
  // identificador dado
  function getScoreEjercicio($id_ejercicio_resuelto)
  {
    $ejercicio_resuelto = Ejercicio_resueltoPeer::RetrieveByPk($id_ejercicio_resuelto);
    return $ejercicio_resuelto->getScore();
  }
  

  // Nombre del método: contarTareasPendientes($id_usuario)
  // Añadida por: Ángel Martín Latasa
  // Descripción: Devuelve el número de tareas pendientes para el alumno
  function contarTareasPendientes($id_usuario)
  {
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
    $c->add(Rel_usuario_tareaPeer::ENTREGADA, 0);
    $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::GREATER_THAN);
    $criterion2 = $c->getNewCriterion(EventoPeer::FECHA_INICIO, time(), Criteria::LESS_THAN);
    $criterion1->addAnd($criterion2);
    $c->add($criterion1);
    $c->add(Tipo_eventoPeer::DESCRIPCION, 'Tarea');
    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(Tipo_eventoPeer::ID, EventoPeer::ID_TIPO_EVENTO);
    $c->addJoin(TareaPeer::ID_CURSO, CursoPeer::ID);
    return TareaPeer::DoCount($c);
  }
  

  // Nombre del método: contarCorreccionesPendientes($id_usuario)
  // Añadida por: Ángel Martín Latasa
  // Descripción: Devuelve el número de ejercicios pendientes de corrección para el profesor
  function contarCorreccionesPendientes($id_usuario)
  {
    $c = new Criteria();
    $c->add(TareaPeer::ID_AUTOR, $id_usuario);
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
    return TareaPeer::DoCount($c);
  }


  // Nombre del método: contarTareasEntregadas($id_tarea)
  // Añadida por: Ángel Martín Latasa
  // Descripción: Devuelve el número de alumnos que han entregado una tarea
  function contarTareasEntregadas($id_tarea)
  {
    $c = new Criteria();
    $c->add(TareaPeer::ID, $id_tarea);
    $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
    $c->addJoin(EventoPeer::ID_CURSO, CursoPeer::ID);
    $c->addJoin(EventoPeer::ID_TIPO_EVENTO, Tipo_eventoPeer::ID);
    $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);    
    $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::LESS_THAN);
    $criterion2 = $c->getNewCriterion(Rel_usuario_tareaPeer::ENTREGADA, 1);
    $criterion1->addOr($criterion2);
    $c->add($criterion1);
    $c->add(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, null, Criteria::NOT_EQUAL);
    return TareaPeer::DoCount($c);
  }


  // Nombre del método: contarAlumnosTarea($id_tarea)
  // Añadida por: Ángel Martín Latasa
  // Descripción: Devuelve el número de alumnos que están implicados en una tarea
  function contarAlumnosTarea($id_tarea)
  {
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    return Rel_usuario_tareaPeer::DoCount($c);
  }
  
  // Nombre del método: calcularMediaTarea($id_tarea)
  // Añadida por: Ángel Martín Latasa
  // Descripción: Calcula la media de los ejercicios corregidos de una tarea
  function calcularMediaTarea($id_tarea)
  {
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    $c->add(Rel_usuario_tareaPeer::CORREGIDA, 1);
    $c->addJoin(Rel_usuario_tareaPeer::ID_EJERCICIO_RESUELTO, Ejercicio_resueltoPeer::ID);
    $ejercicios = Ejercicio_resueltoPeer::DoSelect($c);
    $acumulado = 0;
    $totales = 0;
    foreach ($ejercicios as $ejercicio) {
      $acumulado += $ejercicio->getScore();
      $totales++;
    }
    if ($totales) {return ($acumulado / $totales);}
    else {return '---';}
    
  }
  
  
?>
