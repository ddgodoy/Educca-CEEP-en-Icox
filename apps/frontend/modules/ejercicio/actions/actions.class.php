<?php

/**
 * ejercicio actions.
 *
 * @package    edoceo
 * @subpackage ejercicio
 * @author     �ngel Mart�n Latasa
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class ejercicioActions extends sfActions
{

// #############################################################################
// ##########      p�gina de bienvenida del m�dulo de ejercicios     ###########
// #############################################################################

  public function executeIndex()
  {
    $this->rol = $this->getUser()->obtenerCredenciales();
    $this->redireccion = '?idcurso='.$this->getRequestParameter('idcurso');
    $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
  }


// #############################################################################
// ##########       p�gina principal de la edici�n de ejercicios     ###########
// #############################################################################

  public function executeEjercicios()
  {
    // Recogemos el curso del que se quieren mostrar los mensajes
    if ($this->hasRequestParameter('idcurso'))
    {
      $id_curso = $this->getRequestParameter('idcurso');
    }
    else
    {
      $id_curso = 0;
    }
    $this->id_curso = $id_curso;

    $rol = $this->getUser()->obtenerCredenciales();

    if (($rol == 'profesor') && ($id_curso != 0))
    {
      if ($this->hasRequestParameter('publicar'))
      {
        $id_ejercicio = $this->getRequestParameter('publicar');
        $c = new Criteria();
        $c->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $id_ejercicio);
        $c->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $id_curso);
        if (!Publicado_ejercicio_cursoPeer::DoCount($c))
        {
          $rel = new Publicado_ejercicio_curso();
          $rel->setIdEjercicio($id_ejercicio);
          $rel->setIdCurso($id_curso);
          $rel->save();
        }
      }

      if ($this->hasRequestParameter('quitar'))
      {
        $id_ejercicio = $this->getRequestParameter('quitar');
        $c = new Criteria();
        $c->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $id_ejercicio);
        $c->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $id_curso);
        if (Publicado_ejercicio_cursoPeer::DoCount($c))
        {
          $rel = Publicado_ejercicio_cursoPeer::DoSelectOne($c);
          $rel->delete();
        }
      }

      if ($this->hasRequestParameter('publicarsol'))
      {
        $id_ejercicio = $this->getRequestParameter('publicarsol');
        $c = new Criteria();
        $c->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $id_ejercicio);
        $c->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $id_curso);
        if (Publicado_ejercicio_cursoPeer::DoCount($c))
        {
          $rel = Publicado_ejercicio_cursoPeer::DoSelectOne($c);
          $rel->setSolucion(1);
          $rel->save();
        }
      }

      if ($this->hasRequestParameter('quitarsol'))
      {
        $id_ejercicio = $this->getRequestParameter('quitarsol');
        $c = new Criteria();
        $c->add(Publicado_ejercicio_cursoPeer::ID_EJERCICIO, $id_ejercicio);
        $c->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $id_curso);
        if (Publicado_ejercicio_cursoPeer::DoCount($c))
        {
          $rel = Publicado_ejercicio_cursoPeer::DoSelectOne($c);
          $rel->setSolucion(0);
          $rel->save();
        }
      }

    }


    $cursos_temp = $this->getUser()->getCursosAny();
    $cursos = array();

    foreach($cursos_temp as $curso_temp)
    {
      $cursos[$curso_temp->getIdCurso()] = $curso_temp->getCurso()->getNombre();
    }
    $this->cursos = $cursos;

    $this->rol = $rol;
    
  }


// #############################################################################
// ##########         listado de los ejercicios de un profesor       ###########
// #############################################################################

  public function executeListarEjercicios()
  {
    // Recogemos el curso del que se quieren mostrar los mensajes
    if ($this->hasRequestParameter('filtro'))
    {
      $id_curso = $this->getRequestParameter('filtro');
    }
    else
    {
      $id_curso = 0;
    }
    $this->id_curso = $id_curso;

    $usuario = $this->getUser();
    $this->rol = $usuario->obtenerCredenciales();

    if ($this->rol == 'profesor')
    {
      $c = new Criteria();
      if ($id_curso)
      {
        $c->add(CursoPeer::ID, $id_curso);
      }
      $c->add(RolPeer::NOMBRE, 'profesor');
      $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $usuario->getAnyId());
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, CursoPeer::ID);
      $c->addJoin(CursoPeer::MATERIA_ID, EjercicioPeer::ID_MATERIA);
      $c->addGroupByColumn(EjercicioPeer::ID);
      $this->ejercicios = EjercicioPeer::DoSelect($c);
    }

    if ($this->rol == 'alumno')
    {
      $c = new Criteria();
      if ($id_curso)
      {
        $c->add(Publicado_ejercicio_cursoPeer::ID_CURSO, $id_curso);
      }
      $c->add(RolPeer::NOMBRE, 'alumno');
      $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $usuario->getAnyId());
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
      $c->addJoin(Publicado_ejercicio_cursoPeer::ID_CURSO, Rel_usuario_rol_cursoPeer::ID_CURSO);
      $c->addJoin(EjercicioPeer::ID, Publicado_ejercicio_cursoPeer::ID_EJERCICIO);
      $c->addGroupByColumn(EjercicioPeer::ID);
      $this->ejercicios = EjercicioPeer::DoSelect($c);

    }

    if ($this->rol == 'administrador')
    {
      $c = new Criteria();
      if ($id_materia) {$c->add(EjercicioPeer::ID_MATERIA, $id_materia);}
      $this->ejercicios = EjercicioPeer::DoSelect($c);
    }
    $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
  }


// #############################################################################
// #################       creaci�n de un ejercicio       ######################
// #############################################################################

  public function executeCrearEjercicio()
  {
    if ($this->hasRequestParameter('idcurso')) {
      $idcurso = $this->getRequestParameter('idcurso');
      $curso = CursoPeer::RetrieveByPk($idcurso);
      $this->id_materia = $curso->getMateriaId();
    } else {
      $this->id_materia = 0;
    }


    $materias_temp = $this->getUser()->getMateriasUsuario();
    $materias = array();
    foreach($materias_temp as $materia_temp) {
      $materias[$materia_temp->getId()] = $materia_temp->getNombre();
    }
    $tipos = array();
    $tipos['cuestionario'] = 'Cuestionario';
    $tipos['test'] = 'Test';
    $tipos['problemas'] = 'Problemas';
    $this->tipos = $tipos;
    $this->materias = $materias;

  }


// #############################################################################
// #################         guarda el ejercicio          ######################
// #############################################################################

  public function executeGuardarEjercicio()
  {

    $ejercicio = new Ejercicio();
    $ejercicio->setIdMateria($this->getRequestParameter('materia'));
    $ejercicio->setTipo($this->getRequestParameter('categoria'));
    $ejercicio->setTitulo($this->getRequestParameter('titulo'));
    $ejercicio->setIdAutor($this->getUser()->getAnyId());
    if ($this->hasRequestParameter('test_resta')){$ejercicio->setTestResta($this->getRequestParameter('test_resta'));}
    if ($this->hasRequestParameter('test_multiple')){$ejercicio->setTestMultiple($this->getRequestParameter('test_multiple'));}
    if ($this->hasRequestParameter('numero_respuestas')){$ejercicio->setNumeroRespuestas($this->getRequestParameter('numero_respuestas'));}
    if ($this->hasRequestParameter('numero_hojas')){$ejercicio->setNumeroHojas($this->getRequestParameter('numero_hojas'));}
    if ($this->hasRequestParameter('exp_mat')){$ejercicio->setExpresionesMatematicas($this->getRequestParameter('exp_mat'));}
    if ($this->getRequestParameter('categoria') == 'problemas') {$ejercicio->setExpresionesMatematicas(1);}
    $ejercicio->save();
    $this->ejercicio = $ejercicio; //test
    $this->redirect('ejercicio/mostrarEjercicio?id_ejercicio='.$ejercicio->getId());
  }


// #############################################################################
// #####     muestra un ejercicio y opciones globales del ejercicio      #######
// #############################################################################

  public function executeMostrarEjercicio()
  {
    $id_ejercicio = $this->getRequestParameter('id_ejercicio');
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $id_usuario = $this->getUser()->getAnyId();
    $rol = $this->getUser()->obtenerCredenciales();
    $this->warning = 0;
    $this->eliminar_restringido = 0;

    $solucion_ejercicio = Ejercicio_resueltoPeer::RetrieveByPk($ejercicio->getIdSolucion());

    // Para el caso del alumno
    if ($rol == 'alumno') {

      if (!$ejercicio->comprobarPermisoMostrar($id_usuario,$this->getUser()->getCursoMenu()))
      {
         $this->redirect('tareas/tareasPendientes/idcurso/'.$this->getUser()->getCursoMenu());
      }
      // Si ha respondido alguna vez al ejercicio, obtenemos la respuesta del alumno
      $c = new Criteria();
      $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $id_ejercicio);
      $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $id_usuario);
      $c->add(Ejercicio_resueltoPeer::REPOSITORIO, 1);
      $respuesta_ejercicio = Ejercicio_resueltoPeer::DoSelectOne($c);


      if ($ejercicio->getTipo() == 'test') {
        if ($ejercicio->getPublicadaSolucionCurso($this->getUser()->getCursoMenu())) {
          $cadena_solucion = 'mostrar_solucion=1';
        } else {
          $cadena_solucion = 'mostrar_solucion=0';
        }
        if ($respuesta_ejercicio) {
          $cadena_respuestas = 'mostrar_respuestas=1&id_respuesta_ejercicio='.$respuesta_ejercicio->getId();
        } else {
          $cadena_respuestas = 'mostrar_respuestas=0';
        }

      } else {
        // Mostrar solucion si | no
        if ($ejercicio->getPublicadaSolucionCurso($this->getUser()->getCursoMenu())) {
          $cadena_solucion = 'mostrar_solucion=1&id_solucion_ejercicio='.$solucion_ejercicio->getId();
        } else {
          $cadena_solucion = 'mostrar_solucion=0';
        }
        if ($respuesta_ejercicio) {
          $cadena_respuestas = 'mostrar_respuestas=1&id_respuesta_ejercicio='.$respuesta_ejercicio->getId();
        } else {
          $cadena_respuestas = 'mostrar_respuestas=0';
        }
      }

      // Mostrar edicion si | no
      $cadena_edicion = 'mostrar_edicion=0';
    }

    // Para el caso del profesor
    if ($rol == 'profesor') {

      // Mostrar respuestas edicion | si | no
      if ($ejercicio->getTipo() == 'test') {
        if ($solucion_ejercicio) {
          $cadena_respuestas = 'mostrar_respuestas=1&id_respuesta_ejercicio='.$solucion_ejercicio->getId();
        } else {
          $cadena_respuestas = 'mostrar_respuestas=0';
        }
        $cadena_solucion = 'mostrar_solucion=1';
      } else {
        // Mostrar solucion si | no
        if ($solucion_ejercicio) {
          $cadena_solucion = 'mostrar_solucion=1&id_solucion_ejercicio='.$solucion_ejercicio->getId();
        } else {
          $cadena_solucion = 'mostrar_solucion=0';
        }
        $cadena_respuestas = 'mostrar_respuestas=0';
      }

      // Mostrar edicion si | no
      $cadena_edicion = 'mostrar_edicion=0';

      if ($this->hasRequestParameter('opcion')) {

        $opcion = $this->getRequestParameter('opcion');
        switch ($opcion) {

        // Publicar ejercicio en el repositorio
        case 1:
        $ejercicio->setPublicado(1);
        $ejercicio->save();
        break;

        // Retirar ejercicio del repositorio
        case 2:
        $ejercicio->setPublicado(0);
        $ejercicio->setSolucion(0);
        $ejercicio->save();
        break;

        // Ocultar la solucion del ejercicio a los alumnos
        case 3:
        $ejercicio->setSolucion(0);
        $ejercicio->save();
        break;

        // Mostrar la solucion del ejercicio a los alumnos
        case 4:
        $ejercicio->setSolucion(1);
        $ejercicio->save();
        break;

        // Eliminar el ejercicio
        case 5:
        if ('profesor'==$rol)
        {
          if ($ejercicio->getTipo() == 'problemas')
          {
            $ejercicio->deleteSoluciones();
          }
          $ejercicio->deleteTareas();
          $c = new Criteria();
          $id_usuario = $this->getUser()->getAnyId();
          $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $id_usuario);
          $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $ejercicio->getId());
          Ejercicio_resueltoPeer::DoDelete($c);
          $ejercicio->delete();
          $this->redirect('ejercicio/ejercicios');
        }
        break;
        }
      }

      $id_profesor = $ejercicio->getIdAutor();
      $c = new Criteria();
      $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $id_ejercicio);
      $resueltos = Ejercicio_resueltoPeer::DoCount($c);
      if ($ejercicio->getIdSolucion()) {$resueltos--;}

      $c = new Criteria();
      $c->add(TareaPeer::ID_EJERCICIO, $id_ejercicio);
      $tareas = TareaPeer::DoCount($c);

      if (($tareas + $resueltos) > 0) {
        $this->eliminar_restringido = 1;
      } else {
        $this->eliminar_restringido = 0;
      }

      if ($this->hasRequestParameter('warning'))
      {
        $this->warning = $this->getRequestParameter('warning');
      }

    }


    // Para el caso del administrador
    if ($rol == 'administrador') {

      // Mostrar respuestas edicion | si | no
      if ($ejercicio->getTipo() == 'test') {
        if ($solucion_ejercicio) {
          $cadena_respuestas = 'mostrar_respuestas=1&id_respuesta_ejercicio='.$solucion_ejercicio->getId();
        } else {
          $cadena_respuestas = 'mostrar_respuestas=0';
        }
        $cadena_solucion = 'mostrar_solucion=1';
      } else {
        // Mostrar solucion si | no
        if ($solucion_ejercicio) {
          $cadena_solucion = 'mostrar_solucion=1&id_solucion_ejercicio='.$solucion_ejercicio->getId();
        } else {
          $cadena_solucion = 'mostrar_solucion=0';
        }
        $cadena_respuestas = 'mostrar_respuestas=0';
      }
      $cadena_edicion = 'mostrar_edicion=0';
    }
    $this->redireccion = '?id_ejercicio='.$ejercicio->getId()."&$cadena_respuestas&$cadena_solucion&$cadena_edicion";
    $this->ejercicio = $ejercicio;
    $this->rol = $rol;


  }


// #############################################################################
// #####     muestra un ejercicio y permite modificar sus elementos      #######
// #############################################################################

  public function executeEditarEjercicio()
  {
    $id_ejercicio = $this->getRequestParameter('id_ejercicio');
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $id_usuario = $this->getUser()->getAnyId();

    $id_profesor = $ejercicio->getIdAutor();
    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $id_ejercicio);
    $resueltos = Ejercicio_resueltoPeer::DoCount($c);
    if ($ejercicio->getIdSolucion()) {$resueltos--;}

    $c = new Criteria();
    $c->add(TareaPeer::ID_EJERCICIO, $id_ejercicio);
    $tareas = TareaPeer::DoCount($c);

    if (($tareas + $resueltos) > 0) {
      $cadena_edicion = 'mostrar_edicion=2';
    } else {
      $cadena_edicion = 'mostrar_edicion=1';
    }


    $cadena_respuestas = 'mostrar_respuestas=0';
    $cadena_solucion = 'mostrar_solucion=0';

    $this->redireccion = '?id_ejercicio='.$ejercicio->getId()."&$cadena_respuestas&$cadena_solucion&$cadena_edicion";
    $this->ejercicio = $ejercicio;

  }


// #############################################################################
// #####      muestra la parte de test que pueda tener un ejercicio      #######
// #############################################################################

  public function executeMostrarTest()
  {

    $this->rol = $this->getUser()->obtenerCredenciales();
    $id_ejercicio = $this->getRequestParameter('id_ejercicio');
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $this->ejercicio = $ejercicio;

    if ($this->hasRequestParameter('borrar')) {
      $id_cuestion_test = $this->getRequestParameter('id_cuestion_test');
      $cuestion_test = Cuestion_testPeer::RetrieveByPk($id_cuestion_test);
      $c = new Criteria();
      $c->add(Respuesta_cuestion_testPeer::ID_CUESTION_TEST, $id_cuestion_test);
      $respuestas = Respuesta_cuestion_testPeer::DoSelect($c);
      foreach ($respuestas as $respuesta_borrada)
      {
        $respuesta_borrada->delete_extendido();
      }
      $cuestion_test->delete_extendido();
    }

    if ($this->hasRequestParameter('add')) {
      $cuestion_test = new Cuestion_test();
      $cuestion_test->setIdEjercicio($id_ejercicio);
      $cuestion_test->save();
      $this->cuestion_test = $cuestion_test;

      for ($index = 0; $index < $ejercicio->getNumeroRespuestas(); $index++) {
        $respuesta = new Respuesta_cuestion_test();
        $respuesta->setIdCuestionTest($cuestion_test->getId());
        $respuesta->save();
      }
    }

    if ($this->hasRequestParameter('mostrar_solucion')) {$this->mostrar_solucion = $this->getRequestParameter('mostrar_solucion');}
    else {$this->mostrar_solucion = 0;}

    if ($this->hasRequestParameter('mostrar_respuestas')) {$this->mostrar_respuestas = $this->getRequestParameter('mostrar_respuestas');}
    else {$this->mostrar_respuestas = 0;}

    if ($this->hasRequestParameter('id_respuesta_ejercicio')) {$this->id_respuesta_ejercicio = $this->getRequestParameter('id_respuesta_ejercicio');}
    else {$this->id_respuesta_ejercicio = 0;}

    if ($this->hasRequestParameter('id_solucion_ejercicio')) {$this->id_solucion_ejercicio = $this->getRequestParameter('id_solucion_ejercicio');}
    else {$this->id_solucion_ejercicio = 0;}

    $this->mostrar_edicion = $this->getRequestParameter('mostrar_edicion');
    $c = new Criteria();
    $c->add(Cuestion_testPeer::ID_EJERCICIO, $id_ejercicio);
    $cuestiones_test = Cuestion_testPeer::DoSelect($c);
    $this->cuestiones_test = $cuestiones_test;
  }


// #############################################################################
// ####   muestra la parte de cuestionario que pueda tener un ejercicio    #####
// #############################################################################

  public function executeMostrarCuestionario()
  {
    $this->rol = $this->getUser()->obtenerCredenciales();
    $id_ejercicio = $this->getRequestParameter('id_ejercicio');
    $this->ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);

    if ($this->hasRequestParameter('id_respuesta_ejercicio')) {$id_respuesta_ejercicio = $this->getRequestParameter('id_respuesta_ejercicio');}
    else {$id_respuesta_ejercicio = 0;}

    if ($this->hasRequestParameter('borrar')) {
      $id_cuestion_corta = $this->getRequestParameter('id_cuestion_corta');
      $cuestion_corta = Cuestion_cortaPeer::RetrieveByPk($id_cuestion_corta);
      $cuestion_corta->delete();
    }

    if ($this->hasRequestParameter('add')) {
      $cuestion_corta = new Cuestion_corta();
      $cuestion_corta->setIdEjercicio($id_ejercicio);
      $cuestion_corta->save();
      $this->cuestion_corta = $cuestion_corta;
    }

    if ($this->hasRequestParameter('mostrar_solucion')) {$this->mostrar_solucion = $this->getRequestParameter('mostrar_solucion');}
    else {$this->mostrar_solucion = 0;}

    if ($this->hasRequestParameter('mostrar_respuestas')) {$this->mostrar_respuestas = $this->getRequestParameter('mostrar_respuestas');}
    else {$this->mostrar_respuestas = 0;}

    if ($this->hasRequestParameter('mostrar_correccion')) {$this->mostrar_correccion = $this->getRequestParameter('mostrar_correccion');}
    else {$this->mostrar_correccion = 0;}

    $this->mostrar_edicion = $this->getRequestParameter('mostrar_edicion');
    $this->id_respuesta_ejercicio = $id_respuesta_ejercicio;
    $c = new Criteria();
    $c->add(Cuestion_cortaPeer::ID_EJERCICIO, $id_ejercicio);
    $cuestiones_cortas = Cuestion_cortaPeer::DoSelect($c);
    $this->cuestiones_cortas = $cuestiones_cortas;
  }


// #############################################################################
// ####     muestra la parte de problemas que pueda tener un ejercicio     #####
// #############################################################################

  public function executeMostrarProblemas()
  {
    $this->rol = $this->getUser()->obtenerCredenciales();
    $id_ejercicio = $this->getRequestParameter('id_ejercicio');
    $this->ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);

    if ($this->hasRequestParameter('id_respuesta_ejercicio')) {$id_respuesta_ejercicio = $this->getRequestParameter('id_respuesta_ejercicio');}
    else {$id_respuesta_ejercicio = 0;}

    if ($this->hasRequestParameter('id_solucion_ejercicio')) {$id_solucion_ejercicio = $this->getRequestParameter('id_solucion_ejercicio');}
    else {$id_solucion_ejercicio = 0;}

    if ($this->hasRequestParameter('borrar')) {
      $id_cuestion_practica = $this->getRequestParameter('id_cuestion_practica');
      $cuestion_practica = Cuestion_practicaPeer::RetrieveByPk($id_cuestion_practica);
      $cuestion_practica->delete_extendido();
    }

    if ($this->hasRequestParameter('add')) {
      $cuestion_practica = new Cuestion_practica();
      $cuestion_practica->setIdEjercicio($id_ejercicio);
      $cuestion_practica->save();
      $this->cuestion_practica = $cuestion_practica;
    }

    if ($this->hasRequestParameter('mostrar_solucion')) {$this->mostrar_solucion = $this->getRequestParameter('mostrar_solucion');}
    else {$this->mostrar_solucion = 0;}

    if ($this->hasRequestParameter('mostrar_respuestas')) {$this->mostrar_respuestas = $this->getRequestParameter('mostrar_respuestas');}
    else {$this->mostrar_respuestas = 0;}

    if ($this->hasRequestParameter('mostrar_correccion')) {$this->mostrar_correccion = $this->getRequestParameter('mostrar_correccion');}
    else {$this->mostrar_correccion = 0;}

    $this->mostrar_edicion = $this->getRequestParameter('mostrar_edicion');
    $this->id_respuesta_ejercicio = $id_respuesta_ejercicio;
    $this->id_solucion_ejercicio = $id_solucion_ejercicio;

    /*$c = new Criteria();
    $c->add(Cuestion_practicaPeer::ID_EJERCICIO, $id_ejercicio);
    $cuestiones_practicas = Cuestion_practicaPeer::DoSelect($c);*/
    $this->cuestiones_practicas = $this->ejercicio->getCuestion_practicas();
  }


// #############################################################################
// ###############       edici�n de una pregunta de test        ################
// #############################################################################

  public function executeEditarCuestionTest()
  {
    $this->indice = $this->getRequestParameter('indice');
    $id_cuestion_test = $this->getRequestParameter('id_cuestion_test');
    $cuestion_test = Cuestion_testPeer::RetrieveByPk($id_cuestion_test);
    $ejercicio = EjercicioPeer::RetrieveByPk($cuestion_test->getIdEjercicio());
    $test_multiple = $ejercicio->getTestMultiple();
    $this->test_multiple = $test_multiple;
    $this->modificar = false;
    $numero_respuestas = $ejercicio->getNumeroRespuestas();

    if ($this->hasRequestParameter('modificar')) {$this->modificar = true;}

    if ($this->hasRequestParameter('guardar')) {
      $nuevo_contenido = $this->getRequestParameter('contenido_cuestion_test');
      $cuestion_test->setPregunta($nuevo_contenido);
      $cuestion_test->save();

      for ($index = 0; $index < $numero_respuestas; $index++) {
        $nuevo_contenido = $this->getRequestParameter("respuesta$index");
        $id_respuesta = $this->getRequestParameter("respuestaid$index");
        $respuesta = Respuesta_cuestion_testPeer::RetrieveByPk($id_respuesta);
        $respuesta->setRespuesta($nuevo_contenido);
        $respuesta->save();
      }
    }
    $this->mostrar_edicion = $this->getRequestParameter('mostrar_edicion');
    $this->cuestion_test = $cuestion_test;
    $this->expresiones_matematicas = $ejercicio->getExpresionesMatematicas();
  }


// #############################################################################
// ###############        edici�n de una pregunta corta         ################
// #############################################################################

  public function executeEditarCuestionCorta()
  {

    $this->modificar = false;

    if ($this->hasRequestParameter('modificar')) {$this->modificar = true;}

    if ($this->hasRequestParameter('guardar')) {
      $nuevo_contenido = $this->getRequestParameter('cuestion_corta');
      $id_cuestion = $this->getRequestParameter('id_cuestion_corta');
      $puntuacion = $this->getRequestParameter('puntuacion');
      $cuestion_corta = Cuestion_cortaPeer::RetrieveByPk($id_cuestion);
      $cuestion_corta->setPregunta($nuevo_contenido);
      if ($puntuacion < 0) {$puntuacion = 0;}
      $cuestion_corta->setPuntuacion($puntuacion);
      $cuestion_corta->save();
    }
    $this->mostrar_edicion = $this->getRequestParameter('mostrar_edicion');
    $this->indice = $this->getRequestParameter('indice');
    $this->cuestion_corta = Cuestion_cortaPeer::RetrieveByPk($this->getRequestParameter('id_cuestion_corta'));

  }


// #############################################################################
// ###############           edici�n de un problema             ################
// #############################################################################

  public function executeEditarCuestionPractica()
  {
    $this->indice = $this->getRequestParameter('indice');
    $id_cuestion_practica = $this->getRequestParameter('id_cuestion_practica');
    $cuestion_practica = Cuestion_practicaPeer::RetrieveByPk($id_cuestion_practica);
    $ejercicio = EjercicioPeer::RetrieveByPk($cuestion_practica->getIdEjercicio());
    $this->modificar = false;
    $this->reload = false;

    if ($this->hasRequestParameter('modificar')) {$this->modificar = true;}

    if ($this->hasRequestParameter('guardar'))
    {
      $cuestion_practica->setPuntuacion($this->getRequestParameter('puntuacion'));
      $cuestion_practica->save();
      $this->reload = TRUE;
    }

    $this->mostrar_edicion = $this->getRequestParameter('mostrar_edicion');
    $this->cuestion_practica = $cuestion_practica;
  }

// #############################################################################
// ###############            Resuelve un ejercicio            #################
// #############################################################################

  public function executeResolverEjercicio()
  {
    $id_ejercicio = $this->getRequestParameter('id_ejercicio');
    if ($this->hasRequestParameter('error_log'))
    {
      $this->error_log = $this->getRequestParameter('error_log');
    }
    else
    {
      $this->error_log = '';
    }

    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $id_usuario = $this->getUser()->getAnyId();
    $rol = $this->getUser()->obtenerCredenciales();

    $c = new Criteria();
    $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $id_ejercicio);
    $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $id_usuario);
    $c->add(Ejercicio_resueltoPeer::REPOSITORIO, 1);
    $respuesta_ejercicio = Ejercicio_resueltoPeer::DoSelectOne($c);

    if (!$respuesta_ejercicio)
    {
      $respuesta_ejercicio = new Ejercicio_resuelto();
      $respuesta_ejercicio->setIdEjercicio($id_ejercicio);
      $respuesta_ejercicio->setIdAutor($id_usuario);
      $respuesta_ejercicio->setTiempo(0);
      $respuesta_ejercicio->setRepositorio(1);

      $curso = CursoPeer::RetrieveByPk($this->getUser()->getCursoMenu());
      if (($curso) && ($rol == 'alumno'))
      {
        if ($ejercicio->getIdMateria() == $curso->getMateriaId())
        {
          $respuesta_ejercicio->setIdCurso($this->getUser()->getCursoMenu());
        }
      }

      $respuesta_ejercicio->save();
      if ($rol == 'profesor') {$ejercicio->setIdSolucion($respuesta_ejercicio->getId());}
      $ejercicio->save();
    }

    // Mostrar respuestas edicion | si | no
    $cadena_respuestas = 'mostrar_respuestas=2&id_respuesta_ejercicio='.$respuesta_ejercicio->getId();
    $this->id_respuesta_ejercicio = $respuesta_ejercicio->getId();


    $cadena_solucion = 'mostrar_solucion=0';
    $cadena_edicion = 'mostrar_edicion=0';

    $this->redireccion = '?id_ejercicio='.$ejercicio->getId()."&$cadena_respuestas&$cadena_solucion&$cadena_edicion";
    $this->ejercicio = $ejercicio;
    $this->rol = $rol;

    if ($this->hasRequestParameter('delresp'))
    {
      $numero_respuesta = $this->getRequestParameter('delresp');
      unlink(SF_ROOT_DIR.'/web/uploads/problemas/respuesta_'.$respuesta_ejercicio->getId().'_'.$numero_respuesta.'.jpg');
    }

  }


// #############################################################################
// #############          Guardar resultados ejercicio           ###############
// #############################################################################

  public function executeGuardarResultadosEjercicio()
  {

    $id_ejercicio = $this->getRequestParameter('id_ejercicio');
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $id_respuesta_ejercicio = $this->getRequestParameter('id_respuesta_ejercicio');
    $id_usuario = $this->getUser()->getAnyId();
    $tiempo_secs = $this->getRequestParameter('tiempo');

    $respuesta_ejercicio = Ejercicio_resueltoPeer::RetrieveByPk($id_respuesta_ejercicio);
    $respuesta_ejercicio->setTiempo($respuesta_ejercicio->getTiempo() + $tiempo_secs);

    $curso = CursoPeer::RetrieveByPk($this->getUser()->getCursoMenu());
    if ($curso)
    {
      if ($ejercicio->getIdMateria() == $curso->getMateriaId())
      {
        $respuesta_ejercicio->setIdCurso($this->getUser()->getCursoMenu());
      }
    }

    $respuesta_ejercicio->setIdCurso($this->getUser()->getCursoMenu());
    $respuesta_ejercicio->save();

    $rol = $this->getUser()->obtenerCredenciales();


      // Aqu� guardamos el resultado del test
      if ($this->hasRequestParameter('total_preguntas_test'))
      {
        $test_multiple = $ejercicio->getTestMultiple();
        $total_preguntas = $this->getRequestParameter('total_preguntas_test');
        $preguntas_contestadas = 0;

        $c = new Criteria();
        $c->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $id_respuesta_ejercicio);
        Seleccion_cuestion_testPeer::DoDelete($c);

        $indice = 1;
        while ($indice != $total_preguntas)
        {
          $total_respuestas = $ejercicio->getNumeroRespuestas();

          $id_cuestion = $this->getRequestParameter("id_cuestion_test$indice");
          $cuestion_test = Cuestion_testPeer::RetrieveByPk($id_cuestion);

          if ($rol == 'profesor')
          // cambiado**
          {
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
          while ($index != $total_respuestas)
          {

            $id_respuesta = $this->getRequestParameter("hiddenr$index".'c'.$indice);
            if ($this->hasRequestParameter("checkboxr$index".'c'.$indice))
            {
              array_push($marcados, $id_respuesta);
               $numero_marcados++;
            }
            else
            {
              array_push($nomarcados, $id_respuesta);
            }
            $index++;
          }

          if (($test_multiple) || ($numero_marcados <= 1))
          {
            $pregunta_contestada = false;
            foreach($marcados as $id_respuesta)
            {
              $seleccion = new Seleccion_cuestion_test();
              $seleccion->SetIdEjercicioResuelto($id_respuesta_ejercicio);
              $seleccion->SetIdRespuestaCuestionTest($id_respuesta);
              $seleccion->save();

              // Si es el profesor el que edita la solucion la ponemos como la correcta
              if ($rol == 'profesor')
              {
                if (!$pregunta_contestada)
                {
                  $pregunta_contestada = true;
                  $preguntas_contestadas++;
                }

                $respuesta = Respuesta_cuestion_testPeer::RetrieveByPk($id_respuesta);
                $respuesta->setCorrecta(1);
                $respuesta->save();

                $cuestion_test->setNumeroRespuestasCorrectas($cuestion_test->getNumeroRespuestasCorrectas() + 1);
                $cuestion_test->save();
              }
            }

            if ($rol == 'profesor')
            {

              foreach($nomarcados as $id_respuesta)
              {
                $respuesta = Respuesta_cuestion_testPeer::RetrieveByPk($id_respuesta);
                $respuesta->setCorrecta(0);
                $respuesta->save();

                $cuestion_test->setNumeroRespuestasIncorrectas($cuestion_test->getNumeroRespuestasIncorrectas() + 1);
                $cuestion_test->save();
              }

            }
          }
          else
          {
            if ($rol == 'profesor')
            {
              foreach($nomarcados as $id_respuesta)
              {
                $respuesta = Respuesta_cuestion_testPeer::RetrieveByPk($id_respuesta);
                $respuesta->setCorrecta(0);
                $respuesta->save();
              }
              foreach($marcados as $id_respuesta)
              {
                $respuesta = Respuesta_cuestion_testPeer::RetrieveByPk($id_respuesta);
                $respuesta->setCorrecta(0);
                $respuesta->save();
              }
            }
          }
          unset($marcados);
          unset($nomarcados);
          $indice++;
        }

         if (($rol == 'profesor') && (($total_preguntas - 1) > $preguntas_contestadas))
         {
           $preguntas_pendientes = $total_preguntas - $preguntas_contestadas - 1;
           $this->redirect('ejercicio/mostrarEjercicio?id_ejercicio='.$id_ejercicio.'&warning='.$preguntas_pendientes);
         }
      }

      // Aqui guardamos el resultado del cuestionario
      if ($this->hasRequestParameter('total_preguntas_cuestionario'))
      {

        $total_preguntas = $this->getRequestParameter('total_preguntas_cuestionario');
        $indice = 1;
        while ($indice != $total_preguntas)
        {
          $texto_respuesta = $this->getRequestParameter("respuesta_cuestion_corta$indice");
          $id_respuesta = $this->getRequestParameter("id_respuesta_cuestion_corta$indice");
          if ($id_respuesta)
          {
            $respuesta = Respuesta_cuestion_cortaPeer::RetrieveByPk($id_respuesta);
          }
          else
          {
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
          if ($this->getRequestParameter("id_cuestion_practica$indice"))
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
          }
          $indice++;
        }

        $ruta = SF_ROOT_DIR.'/web/uploads/problemas/'.$id_respuesta_ejercicio.'/';
        $error_log = '';
        
        if(!file_exists($ruta)){
            mkdir($ruta, 0777);
        }
        
        $max_hojas_respuesta = $ejercicio->getNumeroHojas();
        $rutas = array();
        for ($i_hojas = 1; $i_hojas <= $max_hojas_respuesta; $i_hojas++)
        {
          // Procesamos cada imagen
          $nerrores = 0;

          if ($_FILES['upfile'.$i_hojas]['name'] != '')
          {
            if ($_FILES['upfile'.$i_hojas]['size'] > 2000000)
            {
              $error_log.= 'El fichero enviado como hoja de respuestas #'.$i_hojas.' es demasiado grande, supera los 2mb.<br>';
              $nerrores++;
            }

            if (!(($_FILES['upfile'.$i_hojas]['type'] == 'image/jpg') || ($_FILES['upfile'.$i_hojas]['type'] == 'application/msword') || ($_FILES['upfile'.$i_hojas]['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') || ($_FILES['upfile'.$i_hojas]['type'] == 'application/pdf') || ($_FILES['upfile'.$i_hojas]['type'] == 'application/vnd.ms-excel') || ($_FILES['upfile'.$i_hojas]['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') || ($_FILES['upfile'.$i_hojas]['type'] == 'application/vnd.ms-powerpoint') || ($_FILES['upfile'.$i_hojas]['type'] == 'application/vnd.openxmlformats-officedocument.presentationml.presentation')))
            {
              $error_log.= 'El formato de la hoja de respuestas #'.$i_hojas.' no es compatible. Se requiere <strong>Word, Excel, PowerPoint, PDF o Imágenes JPG</strong><br>';
              $nerrores++;
            }

            if ($nerrores)
            {
              $error_log.= 'No se acepto el fichero enviado como hoja de respuestas #'.$i_hojas.' .<br>';
            }
            else
            { $rutas[]=$ruta.$i_hojas.'_respuesta_'.$id_respuesta_ejercicio.'_'.$_FILES['upfile'.$i_hojas]['name'];
              if (file_exists($ruta.$i_hojas.'_respuesta_'.$id_respuesta_ejercicio.'_'.$_FILES['upfile'.$i_hojas]['name']))
              {
                unlink($ruta.$i_hojas.'_respuesta_'.$id_respuesta_ejercicio.'_'.$_FILES['upfile'.$i_hojas]['name']);
              }
              //move_uploaded_file($_FILES['upfile'.$i_hojas]['tmp_name'], $ruta.'respuesta_'.$id_respuesta_ejercicio.'_'.$i_hojas.'.jpg');
              copy($_FILES['upfile'.$i_hojas]['tmp_name'] ,$ruta.$i_hojas.'_respuesta_'.$id_respuesta_ejercicio.'_'.$_FILES['upfile'.$i_hojas]['name'] );
            }
          }

        }$this->rutas= $rutas;//para test


        if ($error_log != '')
        {
          $this->redirect('ejercicio/resolverEjercicio?id_ejercicio='.$id_ejercicio.'&error_log='.$error_log);
        }
      }

    $respuesta_ejercicio->setRepositorio(1);
    $respuesta_ejercicio->save();

    $this->redirect('ejercicio/mostrarEjercicio?id_ejercicio='.$id_ejercicio);
  }

  public function executeMostrarFormula()
  {
    $latex_formula = $this->getRequestParameter('latex_formula');
    $tamano = $this->getRequestParameter('tamano');

  	$latexrender_path = SF_ROOT_DIR.'/web/latexrender';

  	$picture_path = SF_ROOT_DIR.'/web/images/ecuaciones';
  	$picture_path_http = '';
  	$temp_path = SF_ROOT_DIR.'/web/images/ecuaciones/tmp';
  	$picture_name = 'temp'.$this->getUser()->getAnyId();

  	include_once(SF_ROOT_DIR.'/web/latexrender/class.latexrender.php');

  	$latex = new LatexRender($picture_name, $picture_path, $picture_path_http, $temp_path);
		$latex->setFontSize($tamano);
		$url = $latex->getFormulaURL($latex_formula);

		$pic = $picture_name.'.png';
                
        $url = SF_ROOT_DIR.'/web/images/ecuaciones/'.$pic;


		if ($url != false)
  	{
  		$alt_latex_formula = htmlentities($latex_formula, ENT_QUOTES);
  		$alt_latex_formula = str_replace("\r","&#13;",$alt_latex_formula);
  		$alt_latex_formula = str_replace("\n","&#10;",$alt_latex_formula);

  	  //$dim = $latex->getDimensions(SF_ROOT_DIR.'/web'.$url);

  	  $pic.= '?check='.time();
  		$this->image = $pic;
    } else
  	{
  		 $this->image ="[Unparseable or potentially dangerous latex formula. Error $latex->_errorcode $latex->_errorextra]";
  	}

		$this->latex_formula = $latex_formula;


  }


// #############################################################################
// ################               guardar f�rmula               ################
// #############################################################################


  public function executeGuardarFormula()
  {

    $cuestion = $this->getRequestParameter('cuestion');
    $tipo = $this->getRequestParameter('tipo');
    $id = $this->getRequestParameter('id');
    $latex_formula = $this->getRequestParameter('latex_formula');
    if ($cuestion)
    {
      if ($tipo == 't')
      {
        $cuestion_test = Cuestion_testPeer::RetrieveByPk($id);
        $cuestion_test->setPregunta($latex_formula);
        $cuestion_test->save();
      }

      if ($tipo == 'p')
      {
        $cuestion_practica = Cuestion_practicaPeer::RetrieveByPk($id);
        $cuestion_practica->setContenidoLatex($latex_formula);
        $cuestion_practica->save();
      }
    }
    else
    {
      if ($tipo == 't')
      {
        $respuesta_cuestion_test = Respuesta_cuestion_testPeer::RetrieveByPk($id);
        $respuesta_cuestion_test->setRespuesta($latex_formula);
        $respuesta_cuestion_test->save();
      }
    }


  	$temp_path = SF_ROOT_DIR.'/web/images/ecuaciones/temp'.$this->getUser()->getAnyId().'.png';
  	if ($cuestion)
  	{
      $new_file_path = SF_ROOT_DIR.'/web/images/ecuaciones/cuestion'.$tipo.'_'.$id.'.png';
    }
    else
    {
      $new_file_path = SF_ROOT_DIR.'/web/images/ecuaciones/respuesta'.$tipo.'_'.$id.'.png';
    }

  	if (file_exists($temp_path))
  	{
  	  if (file_exists($new_file_path))
  	  {
                unlink($new_file_path);
          }
      copy($temp_path, $new_file_path);
    }

  }

// #############################################################################
// ################              editor matem�tico              ################
// #############################################################################


  public function executeEditorMatematico()
  {
    $cuestion = $this->getRequestParameter('cuestion');
    $tipo = $this->getRequestParameter('tipo');
    $id = $this->getRequestParameter('id');
    $divid = $this->getRequestParameter('divid');
    $this->divid = $divid;

    if ($cuestion)
    {
      if ($tipo == 't')
      {
        $ruta = SF_ROOT_DIR.'/web/images/ecuaciones/cuestion'.$tipo.'_'.$id.'.png';
        $ruta_imagen = '/images/ecuaciones/cuestion'.$tipo.'_'.$id.'.png';
        $cuestion_test = Cuestion_testPeer::RetrieveByPk($id);
        $enunciado = $cuestion_test->getPregunta();
      }

      if ($tipo == 'p')
      {
        $ruta = SF_ROOT_DIR.'/web/images/ecuaciones/cuestion'.$tipo.'_'.$id.'.png';
        $ruta_imagen = '/images/ecuaciones/cuestion'.$tipo.'_'.$id.'.png';
        $cuestion_practica = Cuestion_practicaPeer::RetrieveByPk($id);
        $enunciado = $cuestion_practica->getContenidoLatex();
      }

    }
    else
    {
      if ($tipo == 't')
      {
        $ruta = SF_ROOT_DIR.'/web/images/ecuaciones/respuesta'.$tipo.'_'.$id.'.png';
        $ruta_imagen = '/images/ecuaciones/respuesta'.$tipo.'_'.$id.'.png';
        $respuesta_cuestion_test = Respuesta_cuestion_testPeer::RetrieveByPk($id);
        $enunciado = $respuesta_cuestion_test->getRespuesta();
      }
    }


    if (file_exists($ruta))
    {
      $this->modificar = true;
      $this->enunciado = $enunciado;
    }
    else
    {
      $this->modificar = false;
      $this->enunciado = '';
    }

    $this->ruta_imagen = $ruta_imagen;

    $this->cuestion = $cuestion;
    $this->id = $id;
    $this->tipo = $tipo;

    $this->setLayout('PopUpEditorMat');
  }


// #############################################################################
// ################                    blank                    ################
// #############################################################################

  public function executeBlank()
  {
  }


// #############################################################################
// ################               delete upload                ################
// #############################################################################

  public function executeDeleteUpload()
  {
    $clave = $this->getRequestParameter('clave');
    unlink(SF_ROOT_DIR.$clave);
  }


// #############################################################################
// ################              problemas upload               ################
// #############################################################################

  public function executeMostrarImagen()
  {
    $this->ruta = '/uploads/problemas/'.$this->getRequestParameter('ruta').'.jpg';
    $this->setLayout('PopUpImagen');
  }


}// Fin del action class
