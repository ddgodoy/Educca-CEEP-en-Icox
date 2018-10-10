<?php
//require_once('sfMyTestBrowser.class.php');
//require_once($sf_symfony_lib_dir.'/vendor/lime/lime.php');;
//sfLoader::loadHelpers('Text');
class profesorTest
{
  protected $browser = null;
  protected $test = null;
  protected $usuario_password = null;
  protected $usuario = null;

  public function profesorTest($b=null, $t, $user=null, $pwd = null)
  {
    $this->test =  $t;
    $this->usuario_password =  $pwd ;
    $this->usuario =  $user ;
    $this->browser = $b;
  }


  public function loggin($msg=true)
  { //$this->browser->
    $this->test->diag(''); $this->test->diag('++++++++++++++++loggin para profesor '.$this->usuario->getNombreusuario().'++++++++++++++++');
    if ($msg)
    {
        $this->test->diag('        nombreusuario => '.$this->usuario->getNombreusuario());
        $this->test->diag('        password      => '.$this->usuario_password);
    }

    $this->browser->post('login/login', array('nombreusuario'=> $this->usuario->getNombreusuario(), 'password'=> $this->usuario_password))
                  ->isRedirected()
                  ->followRedirect()
                  ->checkResponseElement('div[class="tit_box_cursos"] h2[class="titbox"]', 'Mis Cursos');
  }

  public function logout()
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++loggout profesor '.$this->usuario->getNombreusuario().'++++++++++++++++');
    $this->browser->get('/profesor/index')
                 ->click('ln_logout')
                 ->isRedirected()
                 ->followRedirect()
                 ->isStatusCode(200);
  }


  public function checkMenu()
  {
  $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu principal profesor'.$this->usuario->getNombreusuario().'++++++++++++++++');
  $this->browser
        ->get('/profesor/index')
        // se chequean en otro menus
        //->click('ln_correo')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/')
        //->click('ln_mis_cursos')->checkResponseElement('div[class="tit_box_cursos"] h2[class="titbox"]', '/Mis Cursos/')
        ->click('ln_perfil')->checkResponseElement('div', '/Perfil de usuario/');
  }

 public function checkMenuCorreo()
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu correo profesor++++++++++++++++');
  $this->browser
        ->get('/profesor/index')
        ->click('ln_correo')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/')
                            ->click('ln_redactar')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Redactar Mensaje/')
                            ->click('ln_recibidos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/')
                            ->click('ln_enviados')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Enviados/')
                            ->click('ln_papelera')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Borrados/');
 }

 public function checkMenuMisCursos($curso)
  {
  $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu mis cursos profesor++++++++++++++++');
  $this->browser
        ->get('/profesor/index')
        ->click('ln_mis_cursos')->checkResponseElement('div[class="tit_box_cursos"] h2[class="titbox"]', '/Mis Cursos/')
                                ->click('ln_mi_curso'.$curso->getId())->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/curso_test_/')
                                        ->click('ln_info_ico')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/General y Normativa/')->back()
                                        ->click('ln_info_texto')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/General y Normativa/')->back()
                                        ->click('ln_temario_ico')->checkResponseElement('div [class="temario"]', '/Temario/')->back()
                                        ->click('ln_temario_texto')->checkResponseElement('div [class="temario"]', '/Temario/')->back()
                                        ->click('ln_biblioteca_archivos_ico')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Biblioteca de archivos/')->back()
                                        ->click('ln_biblioteca_archivos_texto')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Biblioteca de archivos/')->back()
                                        ->click('ln_biblio_ico')->checkResponseElement('div [class="editorial"]', '/Editorial/')->back()
                                        ->click('ln_biblio_texto')->checkResponseElement('div [class="editorial"]', '/Editorial/')->back()
                                        ->click('ln_seguimiento_ico')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Seguimiento/')->back()
                                        ->click('ln_seguimiento_texto')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Seguimiento/')->back()
                                        ->click('ln_eventos_ico')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')->back()
                                        ->click('ln_eventos_texto')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')->back()
                                        //->click('ln_chat_ico')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')->back()
                                        //->click('ln_chat_ico')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')->back()
                                        ->click('ln_foro_ico')->isRedirected()->followRedirect()->checkResponseElement('body', '/Foro -/')->back()->back()
                                        ->click('ln_foro_texto')->isRedirected()->followRedirect()->checkResponseElement('body', '/Foro -/')->back()->back()
                                        ->click('ln_ejercicios_ico')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Editor de Ejercicios/')->back()
                                        ->click('ln_ejercicios_texto')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Editor de Ejercicios/')->back()
                                        ->click('ln_evaluacion_ico')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Evaluación/')->back()
                                        ->click('ln_evaluacion_texto')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Evaluación/')->back()
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
                                        ->click('ln_ejercicios')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Editor de Ejercicios/')
                                        //->click('ln_foro')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Gestor de Ejercicios/')
                                        ->click('ln_evaluacion')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Evaluación/')
                                        ->click('ln_tareas')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Tareas/');
  }

  public function checkMenuSeguimiento($curso)
  {
   $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu Seguimiento profesor++++++++++++++++');
   $this->browser
        ->get('/profesor/index')
        ->click('ln_mis_cursos')
             ->click('ln_mi_curso'.$curso->getId())
                ->click('ln_seguimiento')
                    ->click('ln_segAlumnos_ico')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Listado de Alumnos/')->back()
                    ->click('ln_segAlumnos_texto')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Listado de Alumnos/')->back()
                    ->click('ln_segTemas_ico')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Tiempos invertidos/')->back()
                    ->click('ln_segTemas_texto')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Tiempos invertidos/')
                            ->click('ln_segAlumno0')->back()->back()
                    ->click('ln_segTareas_ico')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Seguimiento de tareas/')->back()
                    ->click('ln_segTareas_texto')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Seguimiento de tareas/')->back()
                    ->click('ln_segCalificaciones_ico')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Estadísticas de calificaciones/')->back()
                    ->click('ln_segCalificaciones_texto')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Estadísticas de calificaciones/')

                    ->click('ln_segAlumnos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Listado de Alumnos/')
                    ->click('ln_segTemas')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Tiempos invertidos/')
                    ->click('ln_segTareas')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Seguimiento de tareas/')
                    ->click('ln_segCalificaciones')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Estadísticas de calificaciones/')
                    ->click('ln_segInicio');
  }


  public function checkSiteMap()
  {
  }

  public function checkMenuEventos($curso)
  {
   $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu Eventos profesor++++++++++++++++');
   $this->browser
        ->get('/profesor/index')
        ->click('ln_mis_cursos')
             ->click('ln_mi_curso'.$curso->getId())
                  ->click('ln_eventos')
                      ->click('ln_ultimosEventos')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Eventos/')
                      ->click('ln_nuevoEventos')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Nuevo evento/')
                      ->click('ln_eliminarEventos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Eliminar Eventos/')
                      ->click('ln_confEventos')->checkResponseElement('div[class="tit_box_calendario"] h2[class="titbox"]', '/Configuración calendario/');

  }

  public function nuevoEvento($curso)
  {
    //evento 2 dias despues a hoy
    $this->test->diag(''); $this->test->diag('++++++++++++++++nuevo Evento profesor'.$this->usuario->getNombreusuario().'++++++++++++++++');
    $c = new sfEventCalendar('month', date("Y/m/d"));
    $fecha = $c->getCalendar()->NextDay(date("d"), date("m"), date("Y"), '%d-%m-%Y');
    $dia=substr($fecha,0,2);
   	$mes=substr($fecha,3,2);
    $anio=substr($fecha,6,4);
    echo $dia.'-'.$mes.'-'.$anio."\n";
    $fecha = $c->getCalendar()->NextDay($dia, $mes, $anio, '%d-%m-%Y');
    $array_evento = array(
                         'titulo'      => "Titulo evento prueba test",
                         'descripcion' => "Descripcion evento prueba test",
                         'horaInicio'  => "07:00:00",
                         'horaFin'     => "22:30:00",
                         'fechaInicio' => $fecha,
                         'fechaFin'    => $fecha,
                         'tipo'        => 4, //tutoria
                         'curso'       =>$curso->getId(),
                         'popUp'       => 0,
                         'alumno'    => -1 //todos
                         );

   $this->browser->post('calendario/guardarEvento', $array_evento);
   $evento =  $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('evento');
   //comprobar
   $this->browser->click('ln_ultimosEventos')
          ->checkResponseElement('table[class="listaeventos"]', '/'.$fecha.'/')
          ->checkResponseElement('table[class="listaeventos"]', '/'.$array_evento['titulo'].'/')
          ->checkResponseElement('table[class="listaeventos"]', '/'.$array_evento['descripcion'].'/');

   $this->browser
        ->get('/calendario/verEventoId/id/'.$evento->getId())
        ->checkResponseElement('table[class="c_ver_evento"]', '/'.$fecha.'/')
        ->checkResponseElement('table[class="c_ver_evento"]', '/'.substr($array_evento['horaInicio'],0,5).'/')
        ->checkResponseElement('table[class="c_ver_evento"]', '/'.substr($array_evento['horaFin'],0,5).'/')
        ->checkResponseElement('table[class="c_ver_evento"]', '/'.$curso->getNombre().'/')
        ->checkResponseElement('table[class="c_ver_evento"]', '/Tutoría/');

    return $evento;
  }

  public function configurarEventos($curso)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++configurar Eventos'.$this->usuario->getNombreusuario().'++++++++++++++++');
    $this->browser
        ->post('calendario/guardarConfiguracion/',array('diasAntes'=>1,'diasDespues'=>1,'idcurso'=>$curso->getId()));

    $this->browser->get('calendario/mostrarCalendario/idcurso/'.$curso->getId())
    ->checkResponseElement('span[class="txtinfo"]', '/No tiene ningún evento próximo./');
  }

  public function eliminarEvento($evento)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++eliminar evento '.$evento->getTitulo().' del curso.'.$evento->getCurso()->getNombre().'++++++++++++++++');
    $this->browser
        ->get('/profesor/index')
        ->click('ln_mis_cursos')
             ->click('ln_mi_curso'.$evento->getIdCurso())
                    ->click('ln_eventos')
                      ->click('ln_eliminarEventos')
                        ->click('ln_eliminar_evento'.$evento->getId())
                            ->isRedirected()
                            ->followRedirect()
                            ->checkResponseElement('span[class="txtinfo"]', '/No hay eventos./');

  }

 public function checkTemario($curso,$compo=true)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++profesor check Temario '.$curso->getNombre().' '.$this->usuario->getNombreusuario().'++++++++++++');
  if ($compo)
  {
    $this->browser
        ->get('/profesor/index')
        ->click('ln_mis_cursos')
        ->click('ln_mi_curso'.$curso->getId())
        ->click('ln_temas')
        ->click('ln_mostrar_tema0')
        ->isStatusCode(200);
        //->checkResponseElement('div[class="content"]', '/Cargando…/');

        $ruta =  $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('ruta');
        //es un iframe la pagina contenedora siempre dara status 200
        //habria qcomprobar contenido del iframe;
  }
 }


 public function checkBibliotecaArchivos($curso)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++profesor check BibliotecaArchivos '.$curso->getNombre().' '.$this->usuario->getNombreusuario().'++++++++++++');
    $this->browser
        ->get('/profesor/index')
        ->click('ln_mis_cursos')
        ->click('ln_mi_curso'.$curso->getId())
        ->click('ln_biblioteca_archivos')
        ->isStatusCode(200)
        ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Biblioteca de archivos/');
 }
 
  public function subirBibliotecaArchivos($curso,$validateFile=false,$validateDescripcion=false)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++ subir BibliotecaArchivos '.$curso->getNombre().' '.$this->usuario->getNombreusuario().'++++++++++++');
    
  $this->test->diag(''); $this->test->diag('++++++++++++++++ comprobando validacion subir BibliotecaArchivos '.$curso->getNombre().' ++++++++++++');     
    $this->browser
        ->get('/biblioteca_archivos/nuevo/idcurso/'.$curso->getId())
        ->isStatusCode(200)
        ->setField('fichero',null)
        ->click('guardar')
            ->isStatusCode(200);
    if ($validateFile)  
       { $this->browser->checkResponseElement('body', '/Por favor, introduzca el fichero/');}

    if ($validateDescripcion)  
       { $this->browser->checkResponseElement('body', '/Introduce la descripcion/');}       
            
        $this->browser    
            ->setField('descripcion', 'Descripcion del fichero subido para la biblioteca')
            ->setField('fichero', sfConfig::get('sf_test_dir').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."tmateria.zip")
            ->click('guardar');
     
            $ba =  $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('ba');
     
            $this->browser
                ->isRedirected()->followRedirect()->isStatusCode(200)
                ->checkResponseElement('body', '/tmateria.zip/');


     $fichero = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'biblioteca_archivos'.DIRECTORY_SEPARATOR.$curso->getId().DIRECTORY_SEPARATOR.$ba->getNombre();
     if (!file_exists($fichero))
      {
        echo "ERROR \n";
        $this->browser->throwsException('strict', 'No se subido el fichero de la biblioteca de ficheros del curso '.$curso->getId());
        throw new sfException(sprintf('No se subido el fichero de la biblioteca de ficheros del curso "%s" .', $curso->getId()));
      }
      return $ba;   
 }

  public function modificarBibliotecaArchivos($archivo)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++ modificar BibliotecaArchivos '.$archivo->getNombre().' '.$this->usuario->getNombreusuario().'++++++++++++');
    
  $this->test->diag(''); $this->test->diag('++++++++++++++++ comprobando validacion modificar BibliotecaArchivos '.$archivo->getNombre().' ++++++++++++');     
    $this->browser
        ->get('/biblioteca_archivos/index/idcurso/'.$archivo->getIdCurso())
        ->click('modificar_biblioteca_archivos'.$archivo->getId())
        ->isStatusCode(200)
        ->setField('descripcion', '')
        ->click('guardar')
            ->isStatusCode(200)
            ->checkResponseElement('body', '/Introduce la descripcion/')
            ->setField('fichero', sfConfig::get('sf_test_dir').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."ejercicio.xml")
            ->click('guardar');
     
            $ba =  $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('ba');
     
            $this->browser
                ->isRedirected()->followRedirect()->isStatusCode(200)
                ->checkResponseElement('body', '/ejercicio.xml/');


     $fichero = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'biblioteca_archivos'.DIRECTORY_SEPARATOR.$archivo->getIdCurso().DIRECTORY_SEPARATOR.$ba->getNombre();
     if (!file_exists($fichero))
      {
        echo "ERROR \n";
        $this->browser->throwsException('strict', 'No se subido el fichero de la biblioteca de ficheros del curso '.$curso->getId());
        throw new sfException(sprintf('No se subido el fichero de la biblioteca de ficheros del curso "%s" .', $curso->getId()));
      }
      return $ba;   
 }


  public function borrarBibliotecaArchivos($archivo)
  {
    
    $this->test->diag(''); $this->test->diag('++++++++++++++++  borrar Biblioteca Archivos '.$archivo->getNombre().' '.$this->usuario->getNombreusuario().'++++++++++++');
    $this->browser
        ->get('/biblioteca_archivos/index/idcurso/'.$archivo->getIdCurso())
        ->isStatusCode(200)
        ->click('delete_biblioteca_archivos'.$archivo->getId())
        ->isRedirected()->followRedirect()->isStatusCode(200)
        ->checkResponseElement('body', '!/'.$archivo->getNombreFichero().'/');

    $fichero = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'biblioteca_archivos'.DIRECTORY_SEPARATOR.$archivo->getIdCurso().DIRECTORY_SEPARATOR.$archivo->getNombre();
     if (file_exists($fichero))
      {
        echo "ERROR \n";
        $this->browser->throwsException('strict', 'No se ha borrado el fichero de la biblioteca de ficheros del curso '.$archivo->getCurso()->getNombre());
        throw new sfException(sprintf('No se ha borrado el fichero de la biblioteca de ficheros del curso "%s" .', $archivo->getCurso()->getNombre()));
      }
  }

  public function nuevoTemaForo($curso,$titulo='Post_prueba_foro',$msg='msj_prueba_foro')
  {
       $this->test->diag(''); $this->test->diag('++++++++++++++++nuevoTemaForo Profesor  '.$this->usuario->getNombreusuario().' '.$curso->getNombre().'++++++');
       $this->browser
        ->get('/profesor/index')
          ->click('ln_mis_cursos')
            ->click('ln_mi_curso'.$curso->getId())
              ->click('ln_foro')
                  ->isRedirected()->followRedirect()
                    ->click('ln_foro_nuevo_tema')
                      ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Crear nuevo tema/')
                      ->setField('title', $titulo)
                      ->setField('body', $msg)
                      ->click('Guardar');

   $post =  $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('post');


   $this->browser->isRedirected()->followRedirect()
                      ->isStatusCode(200)
                      ->checkResponseElement('div[class="post_details"]', "/$titulo/");

    return $post;

  }

  public function eliminarPostForo($post)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++eliminar Post('.$post->getTitle().') Profesor '.$this->usuario->getNombreusuario().'+++');
    $this->browser
        ->get('sfSimpleForum/topic/id/'.$post->getId())
        ->click('ln_borrar_post'.$post->getId())
        ->isRedirected()
        ->followRedirect()
        ->checkResponseElement('div[class="post_details"]', '!/'.$post->getTitle().'/');
  }


  public function redactarMensaje($curso,$alumnos,$asunto=1,$contenidomsj="Prueba <br /> Correo de Test")
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++redactar Mensaje('.$curso->getNombre().') Profesor '.$this->usuario->getNombreusuario().' '.$curso->getNombre().'+++');
    $this->browser->get('/profesor/index')
         ->click('ln_correo')
         ->click('ln_redactar')
         ->isStatusCode(200);

    $array_msj = array(  'curso'      => $curso->getId(),
                         'asunto'     => $asunto,
                         'contenidomsj' => $contenidomsj,
                         'numero_destinatarios' => count($alumnos),
                      );
    $i=0;
    $this->test->diag('Destinatarios:');
    foreach ($alumnos as $alumno)
    {
      $array_msj['usuario'.$i]= $alumno->getId();
      $this->test->diag('            '.$alumno->getNombreusuario());
      $i++;
    }

    $this->browser->post('mensaje/enviarMensaje', $array_msj);

    $msj = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('mensaje');
    $this->browser
         ->isRedirected()
         ->followRedirect()
         ->isStatusCode(200)
         ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Enviados/');

    return $msj;
  }

  public function editarPerfil()
  {
   $this->test->diag(''); $this->test->diag('++++++++++++++++editar Perfil Profesor '.$this->usuario->getNombreusuario().'+++++++');
   $array_usuario = array(  'dni'          => '123456789',
                            'nombre'       => 'nombretest_mod',
                            'apellidos'    => 'test_mod',
                            'email'        => 'usuario-mod@prueba-test.es',
                            'emailstop'    => 0,
                            'telefono1'     => '912345646-mod',
                            'telefono2'    => '912345647-mod',
                            'institucion'  => 'samarco-mod',
                            'departamento' => 'pruebas-mod',
                            'direccion'    => 'balle del tormes-mod',
                            'cp'           => '28003',
                            'ciudad'       => 'madrid-mod',
                            'pais'         => 74
                          );

    $this->usuario->setNombre($array_usuario['nombre']);
    $this->usuario->setApellidos($array_usuario['apellidos']);

    $this->browser
        ->get('/usuario/editarPerfil')
        ->isStatusCode(200)
        ->post('/usuario/editarPerfil', $array_usuario)
        ->isStatusCode(200);

    $this->browser
        ->get('/usuario/mostrarPerfil')
        ->checkResponseElement('table[class="tabla_show_perfil"]', '/nombretest_mod test_mod/')
        ->checkResponseElement('table[class="tabla_show_perfil"]', '/usuario-mod@prueba-test.es/')
        ->checkResponseElement('table[class="tabla_show_perfil"]', '/912345646-mod/')
        ->checkResponseElement('table[class="tabla_show_perfil"]', '/912345647-mod/')
        ->checkResponseElement('table[class="tabla_show_perfil"]', '/samarco-mod/')
        ->checkResponseElement('table[class="tabla_show_perfil"]', '/pruebas-mod/')
        ->checkResponseElement('table[class="tabla_show_perfil"]', '/balle del tormes-mod/')
        ->checkResponseElement('table[class="tabla_show_perfil"]', '/28003/')
        ->checkResponseElement('table[class="tabla_show_perfil"]', '/madrid-mod/');

   $this->test->diag(''); $this->test->diag('            --------modificando imagen usuario -------');
   $this->browser
        ->get('/usuario/modificarFoto')
        ->isStatusCode(200)
        ->setField('file', sfConfig::get('sf_test_dir').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."usuario.jpg")
        ->click("guardar")
        ->isStatusCode(200);


    $this->test->diag(''); $this->test->diag('           --------modificando pwd -------');
    $array_pwd = array( 'pwd'          => $this->usuario_password,
                        'pwd1'       => $this->usuario_password."_mod",
                        'pwd2'       => $this->usuario_password."_mod",
                      );
    $this->usuario_password = $this->usuario_password."_mod";

    $this->browser
        ->get('/usuario/modificarPassword')
        ->isStatusCode(200)
        ->post('/usuario/modificarPassword', $array_pwd)
        ->isStatusCode(200);
    $this->logout();
    $this->loggin();
  }

  public function modificarInfoCurso($curso)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++modificar Info Curso('.$curso->getNombre().') Profesor '.$this->usuario->getNombreusuario().'+++');
    $array_info = array( 'normativa'          => 'normativa_mod',
                         'info'       => 'info_mod',
                         'infoextendida'       => 'extendida_mod',
                         'idcurso' => $curso->getId()
                      );

    $this->browser
        ->get('curso/modificarNormativa/idcurso/'.$curso->getId())
        ->isStatusCode(200)
        ->post('curso/modificarNormativa/idcurso/'.$curso->getId(), $array_info)
        ->isRedirected()
        ->followRedirect()
        ->checkResponseElement('div [class="divinfo"]', '/'.$array_info['normativa'].'/')
        ->checkResponseElement('div [class="divinfo"]', '/'.$array_info['info'].'/')
        ->checkResponseElement('div [class="divinfo"]', '/'.$array_info['infoextendida'].'/');
  }

  public function modificarBiblio($curso)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++modificar Bibliografia Curso('.$curso->getNombre().') Profesor '.$this->usuario->getNombreusuario().' '.$curso->getNombre().'+++');
    $array_curso = array( 'nombre'          => 'nombre_libro',
                         'autor'       => 'autor_libro',
                         'editorial'       => '_libro',
                         'publicacion' => 'pub',
                         'isbn' => '123456789',
                         'idcurso'  => $curso->getId()
                      );

    $this->browser
        ->get('curso/nuevoLibro/idcurso/'.$curso->getId())
        ->isStatusCode(200)
        ->post('curso/nuevoLibro/idcurso/'.$curso->getId(), $array_curso) //modificamos
        ->isStatusCode(200)
        ->get('curso/mostrarBibliografia/idcurso/'.$curso->getId()) //comprobamos cambios
        ->checkResponseElement('div [class="listado_tabla_general"]', '/'.$array_curso['nombre'].'/')
        ->checkResponseElement('div [class="listado_tabla_general"]', '/'.$array_curso['autor'].'/')
        ->checkResponseElement('div [class="listado_tabla_general"]', '/'.$array_curso['editorial'].'/')
        ->checkResponseElement('div [class="listado_tabla_general"]', '/'.$array_curso['publicacion'].'/')
        ->checkResponseElement('div [class="listado_tabla_general"]', '/'.$array_curso['isbn'].'/');
  }

  public function checkMenuEjercicios($curso)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++editar Cuestionario Curso('.$curso->getNombre().') Profesor '.$this->usuario->getNombreusuario().'+++');
    $this->browser
        ->get('/profesor/index')
          ->click('ln_mis_cursos')
            ->click('ln_mi_curso'.$curso->getId())
              ->click('ln_ejercicios')
                ->click('ln_crear_ejercicio_texto')->checkResponseElement('div [class="titulo_principal"] h2[class="titbox"]', '/Creación de ejercicios/')->back()
                ->click('ln_crear_ejercicio_ico')->checkResponseElement('div [class="titulo_principal"] h2[class="titbox"]', '/Creación de ejercicios/')->back()
                ->click('ln_editar_ejercicio_texto')->checkResponseElement('div [class="titulo_principal"] h2[class="titbox"]', '/Edición de ejercicios/')->back()
                ->click('ln_editar_ejercicio_ico')->checkResponseElement('div [class="titulo_principal"] h2[class="titbox"]', '/Edición de ejercicios/')->back()

                ->click('ln_crear_ejercicio')->checkResponseElement('div [class="titulo_principal"] h2[class="titbox"]', '/Creación de ejercicios/')
                ->click('ln_editar_ejercicio')->checkResponseElement('div [class="titulo_principal"] h2[class="titbox"]', '/Edición de ejercicios/')
                ->click('ln_inicio_ejercicio')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Editor de Ejercicios/');
  }

  public function editarCuestionario($curso,$nombre='ejercicio_cuestionario_test')
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++editar Cuestionario Curso('.$curso->getNombre().') Profesor '.$this->usuario->getNombreusuario().'+++');

    $array_ejercicio = array(  'titulo'          => $nombre,
                                'materia'       => $curso->getMateriaId(),
                                'categoria'       => 'cuestionario'
                              );
    $this->browser
        ->post('ejercicio/guardarEjercicio/', $array_ejercicio);

    $ejercicio = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('ejercicio');
    $this->browser
         ->isRedirected()
         ->followRedirect()
         ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/ejercicio_cuestionario_test/');

    $this->browser
        ->get('ejercicio/editarEjercicio/id_ejercicio/'.$ejercicio->getId())
        ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Edición de contenido - '.$array_ejercicio['titulo'].'/');

   $this->browser
        ->get('ejercicio/mostrarCuestionario/add/1/mostrar_edicion/1/id_ejercicio/'.$ejercicio->getId());

   $cuestion = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('cuestion_corta');

   $array_cuestion = array(  'cuestion_corta' => 'pregunta cuestion corta',
                                 'id_cuestion_corta' => $cuestion->getId(),
                                 'puntuacion' => 5 );

   $this->browser
        ->post('ejercicio/editarCuestionCorta/guardar/1/mostrar_edicion/1',$array_cuestion);

   $this->browser
        ->get('ejercicio/mostrarCuestionario/id_ejercicio/'.$ejercicio->getId())
        ->checkResponseElement('td[class="td2"]', '/'.$array_cuestion['cuestion_corta'].'/')
        ->checkResponseElement('th[class="td2"]', '/'.$array_cuestion['puntuacion'].' puntos/');

   $this->browser
        ->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
        ->checkResponseElement('div[class="listado_tabla_general"]', '/'.$ejercicio->getTitulo().'/');

   return  $cuestion;
  }

  public function editarSolucionCuestionario($cuestionario)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++editar Solucion Cuestionario '.$cuestionario->getId().') Profesor '.$this->usuario->getNombreusuario().'+++');

    $this->browser
         ->post('ejercicio/resolverEjercicio/id_ejercicio/'.$cuestionario->getIdEjercicio());

    $id_respuesta = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('id_respuesta_ejercicio');

    $array_respuesta = array( 'id_ejercicio' => $cuestionario->getIdEjercicio(),
                              'id_respuesta_ejercicio' => $id_respuesta,
                              'total_preguntas_cuestionario' => 2,
                              'respuesta_cuestion_corta1' => 'respuesta cuestionario',
                              'id_cuestion_corta1' => $cuestionario->getId());

    $this->browser
         ->post('ejercicio/guardarResultadosEjercicio',$array_respuesta)
         ->isRedirected()
         ->followRedirect();

   $this->browser
        ->get('ejercicio/mostrarCuestionario/id_ejercicio/'.$cuestionario->getIdEjercicio().'&mostrar_respuestas=0&mostrar_solucion=1&id_solucion_ejercicio='.$id_respuesta.'&mostrar_edicion=0')
        ->checkResponseElement('body', '/'.$array_respuesta['respuesta_cuestion_corta1'].'/')
        ;

  }

  public function editarSolucionProblema($problema)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++editar Solucion Problema '.$problema->getId().') Profesor '.$this->usuario->getNombreusuario().'+++');

    $this->browser
         ->get('ejercicio/resolverEjercicio/id_ejercicio/'.$problema->getIdEjercicio())
         ->setField('upfile1', sfConfig::get('sf_test_dir').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."sol_problema.jpg")
         ->click("guardarEjercicio");

  $rutas = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('rutas');
  if (!$rutas)
  {
    echo "ERROR \n";
    $this->browser->throwsException('strict', '1.(rutas)No se ha subido la imagen de la solucion del problema ');
    throw new sfException(sprintf('1. (rutas) No se ha subido la imagen de la solucion del problema '));

  }

  for ($i=0;$i<count($rutas);$i++)
  { if (!file_exists($rutas[$i]))
    {
        echo "ERROR \n";
        $this->browser->throwsException('strict', 'No se ha subido la imagen de la solucion del problema ');
        throw new sfException(sprintf('No se ha subido la imagen de la solucion del problema %s',$rutas[$i]));
    }
  }
  $this->browser
         ->isRedirected()
         ->followRedirect();

  }

  public function eliminarEjercicio($ejercicio,$curso)
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++eliminar Ejercicio '.$ejercicio->getId().' Profesor '.$this->usuario->getNombreusuario().'+++');
    $this->browser
        ->get('ejercicio/mostrarEjercicio/opcion/5/id_ejercicio/'.$ejercicio->getId())
        ->isRedirected()
        ->followRedirect()
        ->isStatusCode(200);

    $this->browser
        ->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
        ->checkResponseElement('div[class="listado_tabla_general"]', '!/'.$ejercicio->getTitulo().'/');
  }


  public function editarEjercicio($curso,$tipo,$nombre='ejercicio_test',$num_respuestas=4,$test_resta=0,$test_multiple=0,$exp_mat=0)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++editar '.$tipo.' Curso('.$curso->getNombre().') Profesor '.$this->usuario->getNombreusuario().'+++');

    $array_ejercicio = array(  'titulo'            => $nombre,
                               'materia'           => $curso->getMateriaId(),
                               'numero_respuestas' => $num_respuestas,
                             );

    switch($tipo)
    {
      case 'cuestionario':
                   $array_ejercicio['categoria'] = 'cuestionario' ;
                   $tipo_latex = 'c';
                   break;
      case 'test':
                   $array_ejercicio['categoria'] = 'test' ;
                   $array_ejercicio['numero_respuestas'] =$num_respuestas;
                   $array_ejercicio['test_resta'] = $test_resta;
                   $array_ejercicio['test_multiple'] = $test_multiple;
                   $array_ejercicio['exp_mat'] = $exp_mat;
                   $tipo_latex = 't';
                   break;
      case 'problemas':
                   $array_ejercicio['categoria'] = 'problemas' ;
                   $array_ejercicio['numero_hojas']=1;
                   $tipo_latex = 'p';
      default:;
    } // switch
    $this->browser
        ->post('ejercicio/guardarEjercicio/', $array_ejercicio);

    $ejercicio = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('ejercicio');

    $this->browser
        ->get('ejercicio/editarEjercicio/id_ejercicio/'.$ejercicio->getId())
        ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Edición de contenido - '.$array_ejercicio['titulo'].'/');

    $ejercicio = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('ejercicio');

    $this->browser
         ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/'.$nombre.'/');

    $this->browser
        ->get('ejercicio/editarEjercicio/id_ejercicio/'.$ejercicio->getId())
        ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Edición de contenido - '.$array_ejercicio['titulo'].'/');

   if (1==$exp_mat)
    { $cad_mat=" \int_{3}^{9}\sqrt[5]{\frac{{x}^{5}+7x}{{4}^{3x}}}";  }
   else $cad_mat="";

    switch($tipo)
    {
      case 'cuestionario':
                          $this->browser->get('ejercicio/mostrarCuestionario/add/1/mostrar_edicion/1/id_ejercicio/'.$ejercicio->getId());
                          $cuestion = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('cuestion_corta');
                          $array_cuestion = array(  'cuestion_corta' => 'pregunta cuestion corta '.$cad_mat,
                                                    'id_cuestion_corta' => $cuestion->getId(),
                                                    'puntuacion' => 5 );

                          $this->browser->post('ejercicio/editarCuestionCorta/guardar/1/mostrar_edicion/1',$array_cuestion);

                           $this->browser
                                ->get('ejercicio/mostrarCuestionario/id_ejercicio/'.$ejercicio->getId())
                                ->checkResponseElement('td[class="td2"]', '/'.$array_cuestion['cuestion_corta'].'/')
                                ->checkResponseElement('th[class="td2"]', '/'.$array_cuestion['puntuacion'].' puntos/');

                           $this->browser
                                ->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
                                ->checkResponseElement('div[class="listado_tabla_general"]', '/'.$ejercicio->getTitulo().'/');

                          return  $cuestion;
                          break;
      case 'test':
                   $array_ejercicio['numero_respuestas'] =$num_respuestas;
                   $array_ejercicio['test_resta'] = $test_resta;
                   $array_ejercicio['test_multiple'] = $test_multiple;
                   $array_ejercicio['exp_mat'] = $exp_mat;

                   $this->browser->get('ejercicio/mostrarTest/add/1/mostrar_edicion/1/id_ejercicio/'.$ejercicio->getId());
                   $cuestion = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('cuestion_test');

                   $cuestiones_test = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('cuestiones_test');
                   $array_cuestion = array(  'indice' => $num_respuestas-1, //la ultima respesta es la correcta
                                             'id_cuestion_test' => $cuestion->getId(),
                                             'contenido_cuestion_test' => $nombre.$cad_mat,
                                             'guardar'=> 1 );

                  if ($exp_mat)
                  {
                      $array_exp = array(  'latex_formula' => $cad_mat, //la ultima respesta es la correcta
                                           'id' => $cuestion->getId(),
                                           'tipo'=>$tipo_latex,
                                           'cuestion'=>'1'
                                         );
                      $this->browser->post('/ejercicio/mostrarFormula/tamano/11/latex_formula/'.$cad_mat);
                      $this->browser->post('/ejercicio/guardarFormula',$array_exp);
                  }

                  $array_resultado = array( 'id_ejercicio' => $ejercicio->getId(), //la ultima respesta es la correcta
                                             'id_cuestion_test1' => $cuestion->getId(),
                                             'checkboxr0c1'=>'1', // la primera la correcta
                                             'total_preguntas_test' =>'2' //indice mas 1 actionclass
                                             );

                   for($i=0; $i<$num_respuestas; $i++)
                   { $array_cuestion['respuesta'.$i]=$cad_mat.'respuesta '.$i.' ';  }
                   foreach($cuestiones_test as $cues)
                   {
                        $respuestas = $cues->getRespuestas();
                        $j=0;
                        foreach ($respuestas as $respuesta)
                        {
                          $array_cuestion['respuestaid'.$j]=$respuesta->getId();
                          if ($exp_mat)
                          {
                            $array_exp['cuestion']=0;
                            $array_exp['id']=$respuesta->getId();
                            $this->browser->post('/ejercicio/guardarFormula',$array_exp);
                          }
                          $array_resultado['hiddenr'.$j.'c1']=$respuesta->getId();
                          $j++;
                        }

                   }
                   $this->browser->post('ejercicio/editarCuestionTest/',$array_cuestion);

                   $this->browser->post('ejercicio/resolverEjercicio/id_ejercicio/'.$ejercicio->getId());
                   $array_resultado['id_respuesta_ejercicio']=$id_respuesta_ejercicio = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('id_respuesta_ejercicio');

                   $this->browser->post('ejercicio/guardarResultadosEjercicio/',$array_resultado);
                   $this->browser->get('ejercicio/mostrarTest/id_ejercicio/'.$ejercicio->getId().'/mostrar_respuestas/1/id_respuesta_ejercicio/'.$array_resultado['id_respuesta_ejercicio'].'/mostrar_solucion/1/mostrar_edicion/0')
                                 ->checkResponseElement('div[class="correcta"]', '/correcta'.$array_resultado['hiddenr0c1'].'/');

                  if ($exp_mat)
                  {
                    $imagen = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'ecuaciones'.DIRECTORY_SEPARATOR.'cuestion'.$tipo_latex.'_'.$cuestion->getId().'.png';
                    if (!file_exists($imagen))
                          {
                            echo "ERROR \n";
                            $this->browser->throwsException('strict', 'No se ha creado la imagen con el editor matematico ');
                            throw new sfException(sprintf('No se ha creado la imagen con el editor matematico'));
                          }
                  }
                   return $cuestion;
                   break;
      case 'problemas':
                   $this->browser->get('ejercicio/mostrarProblemas/add/1/mostrar_edicion/1/id_ejercicio/'.$ejercicio->getId());
                   $cuestion_practica = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('cuestion_practica');
                   $cuestiones_practicas = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('cuestiones_practicas');

                   $array_exp = array(  'latex_formula' => $cad_mat, //la ultima respesta es la correcta
                                           'id' => $cuestion_practica->getId(),
                                           'tipo'=>$tipo_latex,
                                           'cuestion'=>'1'
                                         );
                   $this->browser->post('/ejercicio/mostrarFormula/tamano/11/latex_formula/'.$cad_mat);
                   $this->browser->post('/ejercicio/guardarFormula',$array_exp);

                   $array_cuestion = array(  'indice' => '1', //la ultima respesta es la correcta
                                             'id_cuestion_practica' => $cuestion_practica->getId(),
                                             'contenido_cuestion_test' => $nombre.$cad_mat,
                                             'guardar'=> 1,
                                             'puntuacion' => '10' );

                   $this->browser->post('ejercicio/editarCuestionPractica/modificar/1/mostrar_edicion/1',$array_cuestion);
                   return $cuestion_practica;
                   break;

      default:;
    } // switch
  }

  public function publicarEjercicio($curso,$ejercicio)
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++publicar Ejercicio ('.$ejercicio->getId().') en el curso '.$curso->getNombre().'+++');
      $this->browser->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
            ->click('ln_publicar_'.$ejercicio->getId());
      $this->browser->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
            ->checkResponseElement('div[class="d_publicado_'.$ejercicio->getId().'"]', '/Sí/');
  }

  public function despublicarEjercicio($curso,$ejercicio)
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++des-publicar Ejercicio ('.$ejercicio->getId().') en el curso '.$curso->getNombre().'+++');
      $this->browser->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
            ->click('ln_despublicar_'.$ejercicio->getId());
      $this->browser->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
            ->checkResponseElement('div[class="d_no_publicado_'.$ejercicio->getId().'"]', '/No/');
  }

  public function publicarSolucion($curso,$ejercicio)
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++publicar solucion Ejercicio ('.$ejercicio->getId().') en el curso '.$curso->getNombre().'+++');
      $this->browser->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
            ->click('ln_publicar_solucion_'.$ejercicio->getId());
      $this->browser->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
            ->checkResponseElement('div[class="d_publicada_solucion_'.$ejercicio->getId().'"]', '/Sí/');
  }

  public function despublicarSolucion($curso,$ejercicio)
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++des-publicar Ejercicio ('.$ejercicio->getId().') en el curso '.$curso->getNombre().'+++');
      $this->browser->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
            ->click('ln_despublicar_solucion_'.$ejercicio->getId());
      $this->browser->get('ejercicio/listarEjercicios?filtro='.$curso->getId())
            ->checkResponseElement('div[class="d_no_publicada_solucion_'.$ejercicio->getId().'"]', '/No/');
  }

  public function ponerTarea($curso,$ejercicio,$tipo='Tarea',$caracter='Obligatorio',$sorpresa=0,$duracion=0, $peso=0)
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++poner Tarea ('.$ejercicio->getId().') en el curso '.$curso->getNombre().'+++');

      $c = new sfEventCalendar('month', date("Y/m/d"));
      $fecha_inicio = $c->getCalendar()->NextDay(date("d"), date("m"), date("Y"), '%Y-%m-%d');
      list($anioInicio, $mesInicio, $diaInicio) = split("[-]", $fecha_inicio);
      $fecha_fin = $c->getCalendar()->NextDay($diaInicio, $mesInicio, $anioInicio, '%Y-%m-%d');

      $tarea = array('id_curso' => $curso->getId(),
                     'nombre_curso' => $curso->getNombre(),
                     'id_materia' => $ejercicio->getIdMateria(),
                     'id_ejercicio' => $ejercicio->getId(),
                     'nombre_ejercicio' => $ejercicio->getTitulo(),
                     'caracter' => $caracter,
                     'sorpresa' => $sorpresa,
                     'tipo_prueba' => $tipo,
                     'horaInicio'=>'08:00:00',
                     'horaFin'=>'19:00:00',
                     'fechaInicio' => $fecha_inicio,
                     'fechaFin' => $fecha_fin ,
                     'duracion'=> $duracion,
                     'peso' => $peso);

       $alumnos = $curso->getAlumnos();
       $i=0;
       foreach ($alumnos as $alumno)
       {
         $tarea['id_alumno'.$i] = $alumno->getUsuario()->getId();
         $tarea['nombre_alumno'.$i] = $alumno->getUsuario()->getApellidos();
         $i++;
       }
       $tarea['total_alumnos']=$i;
       $this->browser->post('/tareas/tareasExamenesFin/',$tarea);
       $tarea_obj = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('tarea');

       $this->browser->checkResponseElement('table[class="tabla_resumen_tarea"]', '/'.$tarea['nombre_curso'].'/')
            ->checkResponseElement('table[class="tabla_resumen_tarea"]', '/'.$tarea['nombre_ejercicio'].'/')
            ->checkResponseElement('table[class="tabla_resumen_tarea"]', '/'.$tarea['tipo_prueba'].'/');

       for($i=0;$i<$tarea['total_alumnos'];$i++)
       {
        $this->browser->checkResponseElement('table[class="tabla_resumen_tarea"]', '/'.$tarea['nombre_alumno'.$i].'/');
       }

      $tarea_obj->getEvento()->setFechaInicio(date("Y-m-d H:i")); //truco para que los alumnos puedan hacer la tarea
      $tarea_obj->save();
      return $tarea_obj ;

  }

  public function checkEstadoTarea($tareas,$alumnos,$estado)
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++check Estado Tareas ('.$estado.')++++++++++++');

      foreach($tareas as $tarea)
      {
        $this->browser->get('/seguimiento/listarTareas?filtro='.$tarea->getIdCurso())
             ->click('ln_tarea_'.$tarea->getId())
             ->checkResponseElement('td[class="descripcion"]', '/'.$tarea->getEvento()->getDescripcion().'/');

        foreach ($alumnos as $alumno)
        {
          $this->browser->checkResponseElement('div[class="d_usuario'.$alumno->getId().'"]', '/'.$estado.'/');
        }
      }
  }


  public function corregirTarea($tarea,$revisar=false)
  {   /* si nota = 10 se asigna a la respuesta la maxima puntuacion
         si nota = 0 se asigna a la respuesta 0
         este metodo se usa tanto para corregir tarea como para revisar*/

      if ($revisar)
      {
        $this->test->diag('');$this->test->diag('++++++++++++++++revisar Tarea ('.$tarea->getId().') en el curso '.$tarea->getCurso()->getNombre().'+++');
      }else $this->test->diag('');$this->test->diag('++++++++++++++++corregir Tarea ('.$tarea->getId().') en el curso '.$tarea->getCurso()->getNombre().'+++');


      $this->browser->get('evaluacion/listarTareasEvaluacion/filtro/'.$tarea->getIdCurso())
            ->click('ln_evaluacion_tarea'.$tarea->getId())
            ->checkResponseElement('td[class="descripcion"]', '/'.$tarea->getEvento()->getDescripcion().'/');

      $ejercicios_entregados = $tarea->getRel_usuario_tareasJoinEjercicio_resuelto();
      foreach( $ejercicios_entregados as  $ejercicio_entregado )
      {
         $array_ejercicio = array('id_ejercicio'=> $ejercicio_entregado->getEjercicio_resuelto()->getEjercicio()->getId(),
                                  'solucion_alumno' => $ejercicio_entregado->getIdEjercicioResuelto(),
                                  );

         switch($ejercicio_entregado->getEjercicio_resuelto()->getEjercicio()->getTipo())
         {
          case 'cuestionario':
                              $i=1;
                              foreach ($ejercicio_entregado->getEjercicio_resuelto()->getRespuesta_cuestion_cortas() as $respuesta )
                              {
                                $array_ejercicio['id_respuesta_cuestion_corta'.$i]=$respuesta->getId();
                                if (!$revisar)
                                {
                                  $array_ejercicio['puntuacion_cuestion'.$i]=$respuesta->getCuestion_corta()->getPuntuacion();
                                  $nota_final =  10;
                                }else {$array_ejercicio['puntuacion_cuestion'.$i]=0;
                                       $nota_final = 0;
                                      }

                                $array_ejercicio['comentario_cuestion_corta'.$i]='comentario ejercicio';
                                $i++;
                              }
                              $array_ejercicio['total_preguntas_cuestionario']=$i;
                              break;
          case 'test':
                            $this->browser->click('b_corregir_test');
                            $this->browser->get('evaluacion/listarEjerciciosEntregados?id_tarea='.$tarea->getId())
                                  ->checkResponseElement('td[class="td3"]', '/10/');
                            return;
                            break;
          case 'problemas':   $i=1;
                              foreach ($ejercicio_entregado->getEjercicio_resuelto()->getRespuesta_cuestion_practicas() as $respuesta )
                              {
                                $array_ejercicio['id_respuesta_cuestion_practica'.$i]=$respuesta->getId();
                                if (!$revisar)
                                {
                                  $array_ejercicio['puntuacion_cuestion'.$i]=$respuesta->getCuestion_practica()->getPuntuacion();
                                  $nota_final =  10;
                                }else {$array_ejercicio['puntuacion_cuestion'.$i]=0;
                                       $nota_final = 0;
                                      }

                                $array_ejercicio['comentario_cuestion_corta'.$i]='comentario ejercicio';
                                $i++;
                              }
                              $array_ejercicio['total_preguntas_practicas']=$i;


          break;
          default: ;
         }

         $this->browser->get('evaluacion/listarEjerciciosEntregados/id_tarea/'.$tarea->getId().'/tipo_evento/Tarea');

         if ($revisar)
         {
           $this->browser->click('ln_revisar_ejercicio'.$ejercicio_entregado->getIdEjercicioResuelto())
           ->checkResponseElement('td[class="nota"]', '/'.$nota_final.'/')
           ->get('evaluacion/evaluarEjercicio/id_respuesta_ejercicio/'.$ejercicio_entregado->getIdEjercicioResuelto())
           ->checkResponseElement('td[class="nota"]', '/'.$nota_final.'/');
         }else{
                $this->browser->click('ln_corregir_ejercicio'.$ejercicio_entregado->getIdEjercicioResuelto())
                ->checkResponseElement('td[class="nota"]', '/Pendiente/')
                ->get('evaluacion/evaluarEjercicio/id_respuesta_ejercicio/'.$ejercicio_entregado->getIdEjercicioResuelto())
                ->checkResponseElement('td[class="nota"]', '/Pendiente/');
              }

         $this->browser
              ->post('evaluacion/guardarEvaluacion',$array_ejercicio)
              ->isRedirected()
              ->followRedirect()
              ->isStatusCode(200)
              ->checkResponseElement('td[class="nota"]', '/'.$nota_final.'/');
      }
  }


  public function cancelarTarea($tarea)
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++cancelar Tarea ('.$tarea->getId().') en el curso '.$tarea->getCurso()->getNombre().'+++');

      $this->browser->get('tareas/listarTareas/filtro/'.$tarea->getIdCurso())
            ->checkResponseElement('div[class="listado_tabla_general"]', '/'.$tarea->getEjercicio()->getTitulo().'/')
            ->click('ln_tarea_'.$tarea->getId())
            ->click('ln_eliminar_tarea'.$tarea->getId());

      $this->browser->get('tareas/listarTareas/filtro/'.$tarea->getIdCurso())
           ->checkResponseElement('div[class="listado_tabla_general"]', '!/'.$tarea->getEjercicio()->getTitulo().'/');
  }


  public function verReclamaciones()
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++ ver Reclamaciones  +++++++++++++++++++++++++++++++++++++');

      $this->browser->get('notificaciones/mostrarNotificaciones');
      $notificaciones = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('notificaciones');
      $this->browser->checkResponseElement('td[class="td1"]', '/Reclamación/');
      return $notificaciones;
  }

  public function borrarNotificacion($notificacion)
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++ borrar Notificacion ('.$notificacion->getId().') +++++++++++++++++++++++++++++++++++++');
      $this->browser->get('notificaciones/borrarNotificacion/id_notificacion/'.$notificacion->getId())
           ->isRedirected()
           ->followRedirect();
      $this->browser->get('notificaciones/mostrarNotificaciones')
           ->checkResponseElement('div[class="c_notificacion_'.$notificacion->getId().'"]', '!/'.substr($notificacion->getTitulo(),0,5).'/');
  }

  public function evaluar($alumno,$curso,$nota_final=6)
  {
      $this->test->diag('');$this->test->diag('++++++++++++++++ evaluar ('.$alumno->getNombre().') en el curso ('.$curso->getNombre().') +++++++++++++++++++++++++++++++++++++');

      $this->browser->get('evaluacion/listarAlumnosEvaluacion/filtro/'.$curso->getId())
           ->click('ln_evaluar_alumno'.$alumno->getId())
           ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/'.$alumno->getNombre().'/');

      $this->browser->post('evaluacion/guardarCalificacion?id_alumno='.$alumno->getId().'&id_curso='.$curso->getId(), array('nota_final' => $nota_final));
      $this->browser->get('evaluacion/listarAlumnosEvaluacion/filtro/'.$curso->getId())
           ->checkResponseElement('div[class="c_nota_usuario'.$alumno->getId().'"]', '/'.$nota_final.'/');

  }



}
?>