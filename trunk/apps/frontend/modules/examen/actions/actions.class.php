<?php

/**
 * examen actions.
 *
 * @package    edoceo
 * @subpackage examen
 * @author     Ángel Martín Latasa
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class examenActions extends sfActions
{

  public function executeIndex()
  {
    $usuario = $this->getUser();

    $tipo_examen = $usuario->getAttribute('tipo_examen', '', 'examinandose');
    if ($tipo_examen == 'sorpresa') {$this->redirect('examen/prevExamen');}
    $id_evento = $usuario->getAttribute('id_evento', '', 'examinandose');
    $evento = EventoPeer::RetrieveByPk($id_evento);
    $this->evento = $evento;
    $this->curso = CursoPeer::RetrieveByPk($evento->getIdCurso());
    $tiempo = $evento->getFechaInicio('U') - time();
    if ($tiempo <= 0) {$this->redirect('examen/prevExamen');}
    $this->tiempo = $tiempo;

  }


  public function executePrevExamen()
  {

    $usuario = $this->getUser();
    $this->tipo_examen = $usuario->getAttribute('tipo_examen', '', 'examinandose');
    $id_evento = $usuario->getAttribute('id_evento', '', 'examinandose');
    $id_alumno = $usuario->getAttribute('id_usuario', '', 'examinandose');
    $evento = EventoPeer::RetrieveByPk($id_evento);
    $c = new Criteria();
    $c->add(TareaPeer::ID_EVENTO, $evento->getId());
    $tarea = TareaPeer::DoSelectOne($c);
    $ejercicio = EjercicioPeer::RetrieveByPk($tarea->getIdEjercicio());
    $this->ejercicio = $ejercicio;

    $this->curso = CursoPeer::RetrieveByPk($evento->getIdCurso());
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_alumno);
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $tarea->getId());
    $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);
    $this->relacion = $relacion;
    $this->evento = $evento;

    $id_respuesta_ejercicio = $relacion->getIdEjercicioResuelto();

    if ($id_respuesta_ejercicio == null) {
      $id_respuesta_ejercicio = 0;
      $cadena_respuestas = 'mostrar_respuestas=0';
    } else {
      $cadena_respuestas = 'mostrar_respuestas=1&id_respuesta_ejercicio='.$id_respuesta_ejercicio;
    }
    $cadena_solucion = 'mostrar_solucion=0';
    $cadena_correccion = 'mostrar_correccion=0';
    $cadena_edicion = 'mostrar_edicion=0';
    $this->redireccion = '?id_ejercicio='.$ejercicio->getId()."&$cadena_respuestas&$cadena_solucion&$cadena_edicion&$cadena_correccion";

    if ($this->tipo_examen == 'sorpresa')
    {
      $checkpoint = $usuario->getAttribute('checkpoint', '', 'examinandose');
      $ahora = time();
      $diferencia = $ahora - $checkpoint;
      $tiempo_restante = $relacion->getTiempoRestante();
      $nuevo_restante = $tiempo_restante - $diferencia;
      if ($nuevo_restante < 0) {$nuevo_restante = 0;}
      $relacion->setTiempoRestante($nuevo_restante);
      $relacion->save();
      $usuario->setAttribute('checkpoint', $ahora, 'examinandose');
      $this->diferencia = $nuevo_restante;
    }
    else
    {
      $this->diferencia = $evento->getFechaFin('U') - time();
    }

    if ($this->hasRequestParameter('error_log'))
    {
      $this->error_log = $this->getRequestParameter('error_log');
    }
    else
    {
      $this->error_log = '';
    }

  }



  public function executeResolverExamen()
  {
    $usuario = $this->getUser();
    $this->tipo_examen = $usuario->getAttribute('tipo_examen', '', 'examinandose');
    $id_evento = $this->getUser()->getAttribute('id_evento', '', 'examinandose');
    $evento = EventoPeer::RetrieveByPk($id_evento);
    $c = new Criteria();
    $c->add(TareaPeer::ID_EVENTO, $evento->getId());
    $tarea = TareaPeer::DoSelectOne($c);
    $id_tarea = $tarea->getId();
    $id_ejercicio = $tarea->getIdEjercicio();
    $id_usuario = $this->getUser()->getAttribute('id_usuario', '', 'examinandose');
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_usuario);
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);
    $id_respuesta_ejercicio = $relacion->getIdEjercicioResuelto();

    if ($id_respuesta_ejercicio == null) {
      $id_respuesta_ejercicio = 0;
      $cadena_respuestas = 'mostrar_respuestas=2&id_respuesta_ejercicio=0';
    } else {
      $cadena_respuestas = 'mostrar_respuestas=2&id_respuesta_ejercicio='.$id_respuesta_ejercicio;
    }

      $cadena_solucion = 'mostrar_solucion=0';
      $cadena_correccion = 'mostrar_correccion=0';
      $cadena_edicion = 'mostrar_edicion=0';

    $this->ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $this->relacion = $relacion;
    $this->tarea = $tarea;
    $this->id_respuesta_ejercicio = $id_respuesta_ejercicio;

    $this->redireccion = '?id_ejercicio='.$id_ejercicio."&$cadena_respuestas&$cadena_solucion&$cadena_edicion&$cadena_correccion";

    if ($this->tipo_examen == 'sorpresa')
    {
      $checkpoint = $usuario->getAttribute('checkpoint', '', 'examinandose');
      $ahora = time();
      $diferencia = $ahora - $checkpoint;
      $tiempo_restante = $relacion->getTiempoRestante();
      $nuevo_restante = $tiempo_restante - $diferencia;
      if ($nuevo_restante < 0) {$nuevo_restante = 0;}
      $relacion->setTiempoRestante($nuevo_restante);
      $relacion->save();
      $usuario->setAttribute('checkpoint', $ahora, 'examinandose');
      $this->diferencia = $nuevo_restante;
    }
    else
    {
      $this->diferencia = $evento->getFechaFin('U') - time();
    }
  }


  public function executeGuardarResultadosExamen()
  {
    $id_evento = $this->getUser()->getAttribute('id_evento', '', 'examinandose');
    $evento = EventoPeer::RetrieveByPk($id_evento);
    $c = new Criteria();
    $c->add(TareaPeer::ID_EVENTO, $evento->getId());
    $tarea = TareaPeer::DoSelectOne($c);
    $id_tarea = $tarea->getId();
    $id_ejercicio = $tarea->getIdEjercicio();
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $id_usuario = $this->getUser()->getAttribute('id_usuario', '', 'examinandose');
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

      // Aquí guardamos el resultado del test
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

          // Comprobamos para cada checkbox de las respuestas que tenía la cuestión
          // de test que estamos explorando en esta iteración si estaba activo.
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
          $this->redirect('examen/prevExamen?error_log='.$error_log);
        }

      }

      $finalizar = $this->getRequestParameter('finalizar');
      if ($finalizar)
      {
        $this->redirect('examen/entregarExamen');
      }

      $backup = $this->getRequestParameter('backup');
      if (!$backup){
        $this->redirect('examen/prevExamen');
      }

  }


  public function executeEntregarExamen()
  {
    $id_evento = $this->getUser()->getAttribute('id_evento', '', 'examinandose');
    $evento = EventoPeer::RetrieveByPk($id_evento);
    $c = new Criteria();
    $c->add(TareaPeer::ID_EVENTO, $evento->getId());
    $tarea = TareaPeer::DoSelectOne($c);
    $id_tarea = $tarea->getId();
    $id_alumno = $this->getUser()->getAttribute('id_usuario', '', 'examinandose');
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_alumno);
    $rel_usuario_tarea = Rel_usuario_tareaPeer::DoSelectOne($c);
    if ($rel_usuario_tarea) {

      $id_ejercicio_resuelto = $rel_usuario_tarea->getIdEjercicioResuelto();
      if ($id_ejercicio_resuelto == null)
      {
        $ej_resuelto = new Ejercicio_resuelto();
        $ej_resuelto->setIdAutor($id_alumno);
        $ej_resuelto->setIdEjercicio($tarea->getIdEjercicio());
        $ej_resuelto->setRepositorio(0);
        $ej_resuelto->setTiempo(0);
        $ej_resuelto->save();
        $rel_usuario_tarea->setIdEjercicioResuelto($ej_resuelto->getId());
      }
      $rel_usuario_tarea->setEntregada(1);
      $rel_usuario_tarea->setFechaEntrega(time());
      $rel_usuario_tarea->setTiempoRestante(0);
      $rel_usuario_tarea->save();
    }
    $this->getUser()->signOut();
    $this->redirect('');

  }


  public function executeRefresh()
  {
    $id_evento = $this->getUser()->getAttribute('id_evento', '', 'examinandose');
    $evento = EventoPeer::RetrieveByPk($id_evento);
    $c = new Criteria();
    $c->add(TareaPeer::ID_EVENTO, $evento->getId());
    $tarea = TareaPeer::DoSelectOne($c);
    $id_tarea = $tarea->getId();
    $id_alumno = $this->getUser()->getAttribute('id_usuario', '', 'examinandose');
    $c = new Criteria();
    $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
    $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_alumno);
    $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);

    $checkpoint = $this->getUser()->getAttribute('checkpoint', '', 'examinandose');
    $ahora = time();
    $diferencia = $ahora - $checkpoint;
    $tiempo_restante = $relacion->getTiempoRestante();
    $nuevo_restante = $tiempo_restante - $diferencia;
    if ($nuevo_restante < 0) {$nuevo_restante = 0;}
    $relacion->setTiempoRestante($nuevo_restante);
    $relacion->save();
    $this->getUser()->setAttribute('checkpoint', $ahora, 'examinandose');
  }


}
