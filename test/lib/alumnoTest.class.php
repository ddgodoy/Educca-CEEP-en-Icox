<?php
//require_once('sfMyTestBrowser.class.php');
//require_once($sf_symfony_lib_dir.'/vendor/lime/lime.php');;
//sfLoader::loadHelpers('Text');
class alumnoTest
{
  protected $browser = null;
  protected $test = null;
  protected $usuario_password = null;
  protected $usuario = null;

  public function alumnoTest($b=null, $t, $user=null, $pwd = null)
  {
    $this->test =  $t;
    $this->usuario_password =  $pwd ;
    $this->usuario =  $user ;
    $this->browser = $b;
  }


  public function loggin($msg=true,$examen=false)
  { //$this->browser->
    $this->test->diag(''); $this->test->diag('++++++++++++++++loggin alumno '.$this->usuario->getNombreusuario().'++++++++++++++++');
    if ($msg)
    {
    $this->test->diag('        nombreusuario => '.$this->usuario->getNombreusuario());
    $this->test->diag('        password      => '.$this->usuario_password);
    }


    $this->browser->post('login/login', array('nombreusuario'=> $this->usuario->getNombreusuario(), 'password'=> $this->usuario_password))
                  ->isRedirected()
                  ->followRedirect();

   if (!$examen)
   {
     $this->browser->checkResponseElement('div[class="tit_box_cursos"] h2[class="titbox"]', 'Mis Cursos');
   }
   else {
          $this->browser->isRedirected()
               ->followRedirect()->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Examen/');
        }
  }

  public function logout()
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++logout alumno '.$this->usuario->getNombreusuario().'++++++++++++++++');
    $this->test->diag('');
    $this->browser->get('/alumno/index')
                 ->click('ln_logout')
                 ->isRedirected()
                 ->followRedirect()
                 ->isStatusCode(200);
  }

   public function checkMenuCorreo()
   {
    $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu correo alumno++++++++++++++++');
    $this->browser
          ->get('/profesor/index')
          ->click('ln_correo')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/')
                              ->click('ln_redactar')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Redactar Mensaje/')
                              ->click('ln_recibidos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/')
                              ->click('ln_enviados')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Enviados/')
                              ->click('ln_papelera')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Borrados/');
   }


  public function checkMenu()
  {
  $this->test->diag(''); $this->test->diag('++++++++++++++++checkMenu '.$this->usuario->getNombreusuario().'++++++++++++++++');
  $this->browser->get('/alumno/index')
     ->click('ln_perfil')->checkResponseElement('div', '/Perfil de usuario/');

  }

   public function checkMenuMisCursos($curso)
  {
  $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu mis cursos alumno++++++++++++++++');
  $this->browser
        ->get('/alumno/index')
        ->click('ln_mis_cursos')->checkResponseElement('div[class="tit_box_cursos"] h2[class="titbox"]', '/Mis Cursos/')
                                ->click('ln_mi_curso'.$curso->getId())->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/curso_test_/')
                                        ->click('ln_info_ico')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/General y Normativa/')->back()
                                        ->click('ln_info_texto')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/General y Normativa/')->back()
                                        ->click('ln_temario_ico')->checkResponseElement('div [class="temario"]', '/Temario/')->back()
                                        ->click('ln_temario_texto')->checkResponseElement('div [class="temario"]', '/Temario/')->back()
                                        ->click('ln_biblio_ico')->checkResponseElement('div [class="editorial"]', '/Editorial/')->back()
                                        ->click('ln_biblio_texto')->checkResponseElement('div [class="editorial"]', '/Editorial/')->back()
                                        ->click('ln_biblioteca_archivos_ico')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Biblioteca de archivos/')->back()
                                        ->click('ln_biblioteca_archivos_texto')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Biblioteca de archivos/')->back()
                                        ->click('ln_seguimiento_ico')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Seguimiento/')->back()
                                        ->click('ln_seguimiento_texto')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Seguimiento/')->back()
                                        ->click('ln_eventos_ico')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')->back()
                                        ->click('ln_eventos_texto')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')->back()
                                        //->click('ln_chat_ico')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')->back()
                                        //->click('ln_chat_ico')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')->back()
                                        ->click('ln_foro_ico')->isRedirected()->followRedirect()->checkResponseElement('body', '/Foro -/')->back()->back()
                                        ->click('ln_foro_texto')->isRedirected()->followRedirect()->checkResponseElement('body', '/Foro -/')->back()->back()
                                        ->click('ln_repositorio_ico')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Repositorio de ejercicios/')->back()
                                        ->click('ln_repositorio_texto')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Repositorio de ejercicios/')->back()
                                        ->click('ln_tarea_ico')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Tareas/')->back()
                                        ->click('ln_tarea_texto')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Tareas/')

                                        //enlaces del menu de columna derecha
                                        ->click('ln_inicio')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/curso_test_/')
                                        ->click('ln_normativa')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/General y Normativa/')
                                        ->click('ln_temas')->checkResponseElement('div [class="temario"]', '/Temario/')
                                        ->click('ln_biblioteca_archivos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Biblioteca de archivos/')
                                        ->click('ln_bibliografia')->checkResponseElement('div [class="editorial"]', '/Editorial/')
                                        ->click('ln_seguimiento')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Seguimiento/')
                                        ->click('ln_eventos')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')
                                        //->click('ln_chat')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')
                                        ->click('ln_foro')->isRedirected()->followRedirect()->checkResponseElement('body', '/Foro -/')
                                        ->click('ln_ejercicios')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Repositorio de ejercicios/')
                                        //->click('ln_foro')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Gestor de Ejercicios/')
                                        ->click('ln_tareas')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Tareas/');
  }

  public function checkMenuEventos($curso)
  {
   $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu Eventos alumno++++++++++++++++');
   $this->browser
        ->get('/alumno/index')
        ->click('ln_mis_cursos')
             ->click('ln_mi_curso'.$curso->getId())
                  ->click('ln_eventos')
                      ->click('ln_ultimosEventos')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')
                      ->click('ln_confEventos')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Configuración calendario/');

  }

  public function checkBibliotecaArchivos($archivo)
  {
   $this->test->diag(''); $this->test->diag('++++++++++++++++check Biblioteca Archivos alumno++++++++++++++++');
   $this->browser
        ->get('/alumno/index')
        ->click('ln_mis_cursos')
             ->click('ln_mi_curso'.$archivo->getIdCurso())
                ->click('ln_biblioteca_archivos')
                  ->isStatusCode(200)
                  ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Biblioteca de archivos/')
                  ->checkResponseElement('body', '/'.$archivo->getNombreFichero().'/');
  }

  public function checkListarBibliotecaArchivosNoPermitida($curso)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++check intentar listar los ficheros de un curso no matriculado alumno++++++++++++');
    $this->browser
        ->get('/biblioteca_archivos/index/idcurso/'.$curso->getId())
           ->isRedirected()
           ->followRedirect()
           ->isRedirected()
           ->followRedirect()
           ->isStatusCode(200)
           ->checkResponseElement('body', '/Mis Cursos/');
  }

  public function checkDownloadBibliotecaArchivosNoPermitida($archivo)
  {
   $this->test->diag(''); $this->test->diag('++++++++++++check Download Biblioteca Archivos No Permitida++++++++++++');
    $this->browser
        ->get('/biblioteca_archivos/download/id/'.$archivo->getId())
           ->isRedirected()
           ->followRedirect()
           ->isRedirected()
           ->followRedirect()
           ->isStatusCode(200)
           ->checkResponseElement('body', '/Mis Cursos/');
  }



  public function checkEliminarBibliotecaArchivos($archivo)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++check intentar elimiar ficheros alumno++++++++++++');
    $this->browser
        ->get('/biblioteca_archivos/eliminar/id/'.$archivo->getId())
           ->checkResponseElement('body', '/Oferta/');
  }


  public function MensajeRecibidos($curso,$msj)
  {
     $this->test->diag(''); $this->test->diag('++++++++++++++++Mensaje Recibidos '.$this->usuario->getNombreusuario().'++++++++++++++++');
     $databaseManager = sfDatabaseManager::initialize();
     $c = new Criteria();
     $c->add(MensajePeer::CONTENIDO, $msj->getContenido());
     $c->add(MensajePeer::ID_PROPIETARIO, $this->usuario->getId());
     $mensaje = MensajePeer::doSelectOne($c);

     $this->browser->get('/alumno/index')
         ->click('ln_correo')
         ->click('ln_recibidos')
         ->isStatusCode(200)
         ->get('/mensaje/listarMensajesRecibidos')
         ->click('ln_mensaje'.$mensaje->getId())
         ->checkResponseElement('body', '/Correo de Test/')
         ;
     return $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('mensaje');
  }

  public function eliminarMensaje($msj)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' Mensaje '.$msj->getId().'++++++++++++++++');

    $this->browser->post('mensaje/mostrarMensajeRecibido/id_mensaje/'.$msj->getId(),array('opcion' => 'Eliminar'))
         ->isRedirected()
         ->followRedirect()
         ->isStatusCode(200)
         ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/');;

  }

  public function eliminarMensaje2($msj)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' Eliminando mensaje checkbox '.$msj->getId().'+++++');
    $this->browser->post('mensaje/borrarMensajesRecibidos',array('mensaje0' => $msj->getId(), 'total_mensajes' => 1))
         ->isStatusCode(200);
  }

  public function recuperarMensaje($msj)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' recuperando mensaje '.$msj->getId().'+++++');

    $this->browser->post('mensaje/mostrarMensajeRecibido/id_mensaje/'.$msj->getId(),array('opcion' => 'Recuperar'))
         ->isRedirected()
         ->followRedirect()
         ->isStatusCode(200)
         ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/');;

  }

  public function recuperarMensaje2($msj)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' recuperando mensaje '.$msj->getId().' checkbox+++');

    $this->browser->post('mensaje/recuperarMensajesPapelera',array('mensaje0' => $msj->getId(), 'total_mensajes' => 1))
         ->isStatusCode(200);

  }

  public function eliminarMensajePapelera($msj)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' Eliminando mensaje de papelera checkbox+++');

    $this->browser->post('mensaje/borrarMensajesPapelera',array('mensaje0' => $msj->getId(), 'total_mensajes' => 1))
         ->isStatusCode(200);
  }

  public function checkEvento($evento,$tutoria=true)
  {
  $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' chekenado evento '.$evento->getTitulo().'+++');
  $this->browser
      ->get('/curso/index/idcurso/'.$evento->getIdCurso())
              ->click('ln_eventos')
                   ->checkResponseElement('table[class="listaeventos"]', '/'.$evento->getFechaInicio("d-m-Y").'/')
                   ->checkResponseElement('table[class="listaeventos"]', '/'.$evento->getTitulo().'/')
                   ->checkResponseElement('table[class="listaeventos"]', '/'.$evento->getDescripcion().'/');

   $this->browser
        ->get('/calendario/verEventoId/id/'.$evento->getId())
            ->checkResponseElement('table[class="c_ver_evento"]', '/'.$evento->getFechaFin("d-m-Y").'/')
            ->checkResponseElement('table[class="c_ver_evento"]', '/'.$evento->getFechaInicio("H:i").'/')
            ->checkResponseElement('table[class="c_ver_evento"]', '/'.$evento->getFechaFin("H:i").'/')
            ->checkResponseElement('table[class="c_ver_evento"]', '/'.$evento->getCurso()->getNombre().'/');

   if ($tutoria)
   {
      $this->browser->checkResponseElement('table[class="c_ver_evento"]', '/Tutoría/');
   }

  }

  public function NoTieneEventos($curso)
  {
  $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' chekenado eventos curso '.$curso->getNombre().'+++');
  $this->browser
      ->get('/curso/index/idcurso/'.$curso->getId())
              ->click('ln_eventos')
                   ->checkResponseElement('span[class="txtinfo"]', '/No tiene ningún evento próximo./');
  }

  public function checkForo($curso,$post,$titulo='Post_prueba_foro',$msg='msj_prueba_foro')
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' checkForo '.$titulo.'+++');
    $this->browser
      ->get('/curso/index/idcurso/'.$curso->getId())
          ->click('ln_foro')
              ->isRedirected()->followRedirect()
              ->checkResponseElement('td[class="thread_name"]', "/$titulo/")
                ->click('ln_foro_topic'.$post->getId())
                  ->checkResponseElement('div[class="post_details"]', "/$titulo/")
                  ->checkResponseElement('div[class="cont_mensaje"]', "/$msg/");
  }

  public function checkNoPostForo($curso,$titulo='Post_prueba_foro')
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' checkNoPostForo '.$titulo.'+++');
      $this->browser
      ->get('/curso/index/idcurso/'.$curso->getId())
          ->click('ln_foro')
              ->isRedirected()->followRedirect()
              ->checkResponseElement('td[class="thread_name"]', "!/$titulo/");
  }


  public function resolverTarea($tarea)
  {
     $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' resolver Tarea '.$tarea->getId().'+++');
     $this->browser->get('tareas/listarTareasPendientes?filtro='.$tarea->getIdCurso())
          ->click('ln_tarea_pendiente'.$tarea->getId())
          ->checkResponseElement('td[class="tipo"]', '/'.$tarea->getEjercicio()->getTipo().'/');

     $this->browser->get('tareas/resolverEjercicioTarea/id_tarea/'.$tarea->getId())
          ->checkResponseElement('td[class="tipo"]', '/'.$tarea->getEjercicio()->getTipo().'/');

     $array_tarea=array( 'id_tarea' => $tarea->getId());

     switch($tarea->getEjercicio()->getTipo())
     {
       case 'test':
                  $cuestiones_test = $tarea->getEjercicio()->getCuestion_tests();
                  $i=1;
                  foreach( $cuestiones_test as $cuestion_test)
                  {
                     $array_tarea['id_cuestion_test'.$i] = $cuestion_test->getId(); //respuesta nueva
                     $respuestas = $cuestion_test->getRespuesta_cuestion_tests();
                     $array_tarea['hiddenr0c'.$i] = $respuestas[0]->getId(); //contesta la primera opcion del test
                     $array_tarea['checkboxr0c'.$i] = 1;
                     $i++;
                  }
                  $array_tarea['total_preguntas_test'] = $i++;
                  break;
       case 'cuestionario':
                  $cuestiones_cortas = $tarea->getEjercicio()->getCuestion_cortas();
                  $i=1;
                  foreach( $cuestiones_cortas as $cuestion_corta)
                  {
                     $array_tarea['respuesta_cuestion_corta'.$i] = 'respuesta cuestion corta'.$i;
                     $array_tarea['id_respuesta_cuestion_corta'.$i] = 0; //respuesta nueva
                     $array_tarea['id_cuestion_corta'.$i] =$cuestion_corta->getId();
                     $i++;
                  }
                  $array_tarea['total_preguntas_cuestionario'] = $i++;
                  break;
       case 'problemas':
                  $cuestiones_practicas = $tarea->getEjercicio()->getCuestion_practicas();
                  $this->browser
                        ->get('/tareas/resolverEjercicioTarea/id_tarea/'.$tarea->getId())
                        ->setField('id_cuestion_practica1',$cuestiones_practicas[0]->getId())
                        ->setField('upfile1', sfConfig::get('sf_test_dir').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."sol_problema.jpg")
                        ->click("guardarTarea");

                  $rutas = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('rutas');
                  if (!$rutas)
                  {
                    echo "ERROR \n";
                    $this->browser->throwsException('strict', '1.(rutas)No se ha subido la imagen de la solucion del problema del alumno');
                    throw new sfException(sprintf('1. (rutas) No se ha subido la imagen de la solucion del problema %s del alumno',$rutas[$i]));

                  }

                  for ($i=0;$i<count($rutas);$i++)
                  { if (!file_exists($rutas[$i]))
                    {
                        echo "ERROR \n";
                        $this->browser->throwsException('strict', 'No se ha subido la imagen de la solucion del problema del alumno');
                        throw new sfException(sprintf('No se ha subido la imagen de la solucion del problema %s del alumno',$rutas[$i]));
                    }
                  }
                  $this->browser
                         ->isRedirected()
                         ->followRedirect();
                break;
       default:
         ;
     } //

     if ('problemas'!=$tarea->getEjercicio()->getTipo())
     {
       $this->browser->post('tareas/guardarResultadosTarea/',$array_tarea)
            ->isRedirected()->followRedirect();
     }

     return $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('relacion');


  }

  public function entregarTarea($resuelto)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' entregar Tarea '.$resuelto->getIdTarea().'+++');

    $this->browser->get('tareas/entregarTarea/id_respuesta_ejercicio/'.$resuelto->getIdEjercicioResuelto());

    $this->browser->get('tareas/listarHistorialEntregas?filtro='.$resuelto->getTarea()->getCurso()->getId())
         ->checkResponseElement('div[class="correccion_'.$resuelto->getTarea()->getId().'"]', '/pendiente/');
  }

  public function reclamarTarea($tarea)
  {
   $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' reclamar Tarea '.$tarea->getId().'+++');

    $this->browser->get('/tareas/reclamar/id_tarea/'.$tarea->getId())
         ->checkResponseElement('div[class="nota_informativa"]', '/La solicitud de reclamación se ha procesado correctamente/');
  }

  public function prohibidoResolverTarea($tarea)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' prohibido Resolver Tarea '.$tarea->getId().'(ya la entrego)+++');

    $this->browser->get('tareas/resolverEjercicioTarea/id_tarea/'.$tarea->getId())
          ->isRedirected()->followRedirect()
          ->checkResponseElement('td[class="estado'.$tarea->getId().'"]', '/Entregada/');
  }

  public function resolverExamen($examen)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' resolver Examen '.$examen->getEjercicio()->getTipo().' +++');

    $this->browser->get('examen/resolverExamen')
         ->checkResponseElement('td[class="tipo"]', '/'.$examen->getEjercicio()->getTipo().'/');

    $array_tarea=array( 'id_tarea' => $examen->getId());

    switch($examen->getEjercicio()->getTipo())
     {
       case 'test':
                  $cuestiones_test = $examen->getEjercicio()->getCuestion_tests();
                  $i=1;
                  foreach( $cuestiones_test as $cuestion_test)
                  {
                     $array_tarea['id_cuestion_test'.$i] = $cuestion_test->getId(); //respuesta nueva
                     $respuestas = $cuestion_test->getRespuesta_cuestion_tests();
                     $array_tarea['hiddenr0c'.$i] = $respuestas[0]->getId(); //contesta la primera opcion del test
                     $array_tarea['checkboxr0c'.$i] = 1;
                     $i++;
                  }
                  $array_tarea['total_preguntas_test'] = $i++;
                   break;
       case 'cuestionario':
                  $cuestiones_cortas = $examen->getEjercicio()->getCuestion_cortas();
                  $i=1;
                  foreach( $cuestiones_cortas as $cuestion_corta)
                  {
                     $array_tarea['respuesta_cuestion_corta'.$i] = 'respuesta cuestion corta examen'.$i;
                     $array_tarea['id_respuesta_cuestion_corta'.$i] = 0; //respuesta nueva
                     $array_tarea['id_cuestion_corta'.$i] =$cuestion_corta->getId();
                     $i++;
                  }
                  $array_tarea['total_preguntas_cuestionario'] = $i++;
                  break;
       case 'problemas':
                  $cuestiones_practicas = $examen->getEjercicio()->getCuestion_practicas();
                  $this->browser
                        ->get('/examen/resolverExamen/')
                        ->setField('id_cuestion_practica1',$cuestiones_practicas[0]->getId())
                        ->setField('upfile1', sfConfig::get('sf_test_dir').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."sol_problema.jpg")
                        ->click('guardarExamen');

                  $rutas = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('rutas');
                  if (!$rutas)
                  {
                    echo "ERROR \n";
                    $this->browser->throwsException('strict', '1.(rutas)No se ha subido la imagen de la solucion del problema del alumno');
                    throw new sfException(sprintf('1. (rutas) No se ha subido la/s imagen/es de la solucion del problema del alumno'));

                  }

                  for ($i=0;$i<count($rutas);$i++)
                  { if (!file_exists($rutas[$i]))
                    {
                        echo "ERROR \n";
                        $this->browser->throwsException('strict', 'No se ha subido la imagen de la solucion del problema del alumno');
                        throw new sfException(sprintf('No se ha subido la imagen de la solucion del problema %s del alumno',$rutas[$i]));
                    }
                  }
                  $this->browser
                         ->isRedirected()
                         ->followRedirect();

                  break;
     }

     if ('problemas'!=$examen->getEjercicio()->getTipo())
     {
       $this->browser->post('examen/guardarResultadosExamen/',$array_tarea)
            ->isRedirected()->followRedirect();
     }
     return $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('relacion');
  }

  public function entregarExamen($resuelto)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++'.$this->usuario->getNombreusuario().' entregar Examen +++');

    $this->browser->get('examen/entregarExamen/')
         ->isRedirected()->followRedirect()
         ->checkResponseElement('div[class="tit_box_ecursos"]  h2[class="titbox"]', '/Oferta/');
  }



}
?>