<?php

class supervisorTest
{
  protected $browser = null;
  protected $test = null;
  protected $usuario_password = null;
  protected $usuario = null;

  public function supervisorTest($b=null, $t, $user=null, $pwd = null)
  {
    $this->test =  $t;
    $this->usuario_password =  $pwd ;
    $this->usuario =  $user ;
    $this->browser = $b;
  }


  public function loggin($msg=true,$examen=false)
  { $this->test->diag(''); $this->test->diag('++++++++++++++++loggin supervisor '.$this->usuario->getNombreusuario().'++++++++++++++++');
    if ($msg)
    {
    $this->test->diag('        nombreusuario => '.$this->usuario->getNombreusuario());
    $this->test->diag('        password      => '.$this->usuario_password);
    }

    $this->browser->post('login/login', array('nombreusuario'=> $this->usuario->getNombreusuario(), 'password'=> $this->usuario_password))
                  ->isRedirected()
                  ->followRedirect()
                  ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Cursos instalados en la plataforma/');
  }

  public function logout()
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++logout supervisor '.$this->usuario->getNombreusuario().'++++++++++++++++');
    $this->test->diag('');
    $this->browser->get('/supervisor/index')
                 ->click('ln_logout')
                 ->isRedirected()
                 ->followRedirect()
                 ->isStatusCode(200);
  }


  public function checkMenu()
  {
  $this->test->diag(''); $this->test->diag('++++++++++++++++checkMenu supervisor'.$this->usuario->getNombreusuario().'++++++++++++++++');
  $this->browser->get('/supervisor/index')
        ->click('ln_inicio')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Cursos instalados en la plataforma/')
        ->click('ln_perfil')->checkResponseElement('div', '/Perfil de usuario/')
        ->click('ln_cursos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Cursos instalados en la plataforma/')
        ->click('ln_modulos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Módulos instalados en la plataforma/')
        ->click('ln_correo')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/')
        ->click('ln_profesores')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Profesores de la plataforma/')
        ->click('ln_alumnos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Alumnos de la plataforma/');
  }

 public function checkMenuCorreo()
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu correo supervisor++++++++++++++++');
  $this->browser
        ->get('/supervisor/index')
        ->click('ln_correo')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/')
                            ->click('ln_redactar')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Redactar Mensaje/')
                            ->click('ln_recibidos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Recibidos/')
                            ->click('ln_enviados')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Enviados/')
                            ->click('ln_papelera')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Mensajes Borrados/');
 }

 public function checkCursos($cursos)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Cursos supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index');

  foreach ($cursos as $curso)
  {
    $this->browser->click('ln_curso'.$curso->getId())->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
          ->back();
  }

  $this->browser->get('/supervisor/index')->click('ln_cursos');

  foreach ($cursos as $curso)
  {
    $this->browser->click('ln_curso'.$curso->getId())->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
          ->back();
  }
 }

 public function checkModulo($modulo)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Modulo supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_modulo'.$modulo->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$modulo->getNombre().'/')
       ->click('ln_modulos')
       ->click('ln_modulo'.$modulo->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$modulo->getNombre().'/');
 }

 public function checkCursosEnModulo($modulo,$cursos)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Cursos En Modulo ('.$modulo->getNombre().')++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_modulos')
       ->click('ln_modulo'.$modulo->getId());
   foreach ($cursos as $curso)
   {
     $this->browser->click('ln_curso'.$curso->getId())
          ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
          ->back();
   }
 }

 public function checkAlumnos($alumnos)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Alumnos supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_alumnos');

  foreach ($alumnos as $alumno)
  {
    $this->browser->click('ln_usuario'.$alumno->getId())
          ->checkResponseElement('table[class="tabla_show_perfil"]', '/'.$alumno->getNombre().'/')
          ->back();
  }
 }

 public function checkProfesores($profesores)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Profesores supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_profesores');

  foreach ($profesores as $profesor)
  {
    $this->browser->click('ln_usuario'.$profesor->getId())
          ->checkResponseElement('table[class="tabla_show_perfil"]', '/'.$profesor->getNombre().'/')
          ->back();
  }
 }


 public function checkAlumnosEnCurso($alumnos,$curso)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Alumnos En Curso ('.$curso->getNombre().') supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_alumnos');

  //miramos qcada alumno esta en el curso
  foreach ($alumnos as $alumno)
  {
    $this->browser->click('ln_cursos_usuario'.$alumno->getId())
          ->click('ln_curso'.$curso->getId())
          ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
          ->back()
          ->back();
  }

  //miramos que en el curso esten los alumnos
  $this->browser->get('/supervisor/index')
       ->click('ln_cursos')
       ->click('ln_alumnos_curso'.$curso->getId());

  foreach ($alumnos as $alumno)
  {
    $this->browser->click('ln_usuario'.$alumno->getId())
          ->checkResponseElement('table[class="tabla_show_perfil"]', '/'.$alumno->getNombre().'/')
          ->back();
  }
 }

 public function checkProfesoresEnCurso($profesor,$curso)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Profesor En Curso ('.$curso->getNombre().') supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_profesores_curso'.$curso->getId())
       ->click('ln_usuario'.$profesor->getId())
       ->checkResponseElement('table[class="tabla_show_perfil"]', '/'.$profesor->getNombre().'/');

  $this->browser->click('ln_profesores')
       ->click('ln_cursos_profesor'.$profesor->getId())
       ->click('ln_curso'.$curso->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
       ->checkResponseElement('div[class="c_profesor'.$profesor->getId().'"]', '/'.$profesor->getNombre().'/');
 }


 public function checkMensajesProfesor($profesor,$curso)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Mensajes Profesor ('.$profesor->getNombre().') supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_profesores_curso'.$curso->getId())
       ->click('ln_mensajes_profesor'.$profesor->getId().'_curso'.$curso->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/');

  $this->browser->click('ln_profesores')
       ->click('ln_mensajes_profesor'.$profesor->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Seguimiento/');
 }


 public function checkAlumnoEnModulo($alumno,$modulo)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Alumno En Modulo ('.$modulo->getNombre().') supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_alumnos')
       ->click('ln_usuario'.$alumno->getId().'_modulos')
       ->click('ln_modulo'.$modulo->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$modulo->getNombre().'/');

  //miramos que en el modulo este el alumno
  $this->browser->get('/supervisor/index')
       ->click('ln_modulos')
       ->click('ln_modulo'.$modulo->getId().'_alumnos')
       ->click('ln_usuario'.$alumno->getId())
       ->checkResponseElement('table[class="tabla_show_perfil"]', '/'.$alumno->getNombre().'/')
       ->back();
  }

 public function checkFichaCurso($curso,$alumnos,$profesor)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Ficha Curso ('.$curso->getNombre().') supervisor++++++++++++++++');

  $this->browser->get('/supervisor/index')
       ->click('ln_ficha_curso'.$curso->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
       ->checkResponseElement('div[class="c_profesor'.$profesor->getId().'"]', '/'.$profesor->getNombre().'/');

  foreach ($alumnos as $alumno)
  {
    $this->browser->checkResponseElement('div[class="c_alumno'.$alumno->getId().'"]', '/'.$alumno->getNombre().'/');
  }

  $this->browser->click('ln_cursos')
       ->click('ln_ficha_curso'.$curso->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
       ->checkResponseElement('div[class="c_profesor'.$profesor->getId().'"]', '/'.$profesor->getNombre().'/');

  foreach ($alumnos as $alumno)
  {
    $this->browser->checkResponseElement('div[class="c_alumno'.$alumno->getId().'"]', '/'.$alumno->getNombre().'/');
  }
 }

 public function checkFichaModulo($modulo,$cursos,$alumnos_modulo)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Ficha Modulo ('.$modulo->getNombre().') supervisor++++++++++++++++');

  $this->browser->get('/supervisor/index')
       ->click('ln_ficha_modulo'.$modulo->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$modulo->getNombre().'/');

  foreach ($cursos as $curso)
  {
    $this->browser->click('ln_curso'.$curso->getId())
         ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/');
    foreach ($alumnos_modulo as $alumno)
    {
      $this->browser->checkResponseElement('div[class="c_alumno'.$alumno->getId().'"]', '/'.$alumno->getNombre().'/');
    }
    $this->browser->back();
  }

  $this->browser->click('ln_modulos')
       ->click('ln_ficha_modulo'.$modulo->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$modulo->getNombre().'/');

  foreach ($cursos as $curso)
  {
    $this->browser->click('ln_curso'.$curso->getId())
         ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/');
    foreach ($alumnos_modulo as $alumno)
    {
      $this->browser->checkResponseElement('div[class="c_alumno'.$alumno->getId().'"]', '/'.$alumno->getNombre().'/');
    }
    $this->browser->back();
  }
 }

 public function checkTareasCurso($alumnos,$curso,$tareas,$tareas_examenes)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Tareas Curso ('.$curso->getNombre().') supervisor++++++++++++++++');

  $this->browser->get('/supervisor/index')
       ->click('ln_tareas_curso'.$curso->getId())
       ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Estadísticas de calificaciones/');

   //ordenadas por tareas
   $tareas = array_merge($tareas,$tareas_examenes);
   foreach ($tareas as $tarea)
   {
    $this->browser
         ->checkResponseElement('div[class="c_tarea'.$tarea->getId().'"]', '/'.$tarea->getEjercicio()->getTitulo().'/')
         ->click('ln_grafica_tarea'.$tarea->getId())
         ->isStatusCode(200)
         ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
         ->back();
   }

   //ordenadas por alumnos
   $this->browser->get('seguimiento/estadisticaCalificaciones/idcurso/'.$curso->getId().'/opcion/2')
        ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Ordenadas por alumno/');
   foreach ($alumnos as $alumno)
   {
    $this->browser
         ->checkResponseElement('div[class="c_alumno'.$alumno->getId().'"]', '/'.$alumno->getNombre().'/')
         ->click('ln_tareas_alumno'.$alumno->getId())
         ->isStatusCode(200)
         ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
         ->back();
   }

  $this->browser->click('ln_cursos')
       ->click('ln_tareas_curso'.$curso->getId())
       ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Estadísticas de calificaciones/');
 }

 public function checkDudasCurso($cursos)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Dudas Cursos  supervisor++++++++++++++++');

  $this->browser->get('/supervisor/index');
  foreach($cursos as $curso)
  {
     $this->browser->click('ln_dudas_curso'.$curso->getId())
         ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
         ->back();
  }

  $this->browser->click('ln_cursos');
  foreach($cursos as $curso)
  {
       $this->browser->click('ln_dudas_curso'.$curso->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
       ->back();
  }
 }

 public function checkTripartitas($cursos)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Tripartitas Cursos  supervisor++++++++++++++++');
  foreach($cursos as $curso)
  {
    $this->browser->get('supervisor/informeTripartita/idcurso/'.$curso->getId());
    $content =  $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getContext()->getResponse()->getContent();
    $pdf = substr($content,1,3);
    if ("PDF"!=$pdf)
    {
      echo "ERROR \n";
      $this->browser->throwsException('strict', 'No se ha generado el pdf para la tripartita  ');
      throw new sfException(sprintf('No se ha generado el pdf para la tripartita %s',$curso->getNombre()));
    }

    $this->browser->isStatusCode(200);
  }
 }

 public function checkTiemposAlumno($alumnos,$curso)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Tripartitas Cursos  supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_alumnos_curso'.$curso->getId());

  foreach ($alumnos as $alumno)
  {
       $this->browser->click('tiempo_alumno'.$alumno->getId())
            ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
            ->back();
  }

  $this->browser->click('ln_alumnos');
  foreach ($alumnos as $alumno)
  {
       $this->browser->click('ln_cursos_usuario'.$alumno->getId())
            ->click('ln_curso'.$curso->getId())
            ->click('tiempo_alumno'.$alumno->getId())
            ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
            ->back()
            ->back()
            ->back();
  }
 }

 public function checkEvaluacionAlumnos($alumnos,$curso,$nota_final=null)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Evaluacion Alumnos  supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_alumnos_curso'.$curso->getId());

  foreach ($alumnos as $alumno)
  {
       $this->browser->click('evaluacion_alumno'.$alumno->getId())
            ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/'.$alumno->getNombre().'/')
            ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/'.$curso->getNombre().'/');
        if ($nota_final)
        {
            $this->browser->checkResponseElement('div[class="c_nota_final"]"]', '/'.$nota_final.'.00/');
        }

        $this->browser->back();
  }

  $this->browser->click('ln_alumnos');
  foreach ($alumnos as $alumno)
  {
       $this->browser->click('ln_cursos_usuario'.$alumno->getId())
            ->click('ln_curso'.$curso->getId())
            ->click('evaluacion_alumno'.$alumno->getId())
            ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/'.$alumno->getNombre().'/')
            ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/'.$curso->getNombre().'/')
            ->back()
            ->back()
            ->back();
  }
 }

 public function  checkPesosEvaluacionModulo($modulo,$tareas,$tareas_examenes)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Pesos Evaluacion Modulo supervisor++++++++++++++++');
  $this->browser->get('/supervisor/index')
       ->click('ln_tareas_modulo'.$modulo->getId())
       ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/'.$modulo->getNombre().'/');

  $evaluacion = array('idmodulo' => $modulo->getId(),
                      'totalTest' => 0,
                      'totalCuestionarios' => 0,
                      'totalProblemas' => 0,
                     );

  $tareas=array_merge($tareas,$tareas_examenes);
  foreach($tareas as $tarea)
  {
    switch($tarea->getEjercicio()->getTipo())
    {
      case 'test': $evaluacion['test'.$evaluacion['totalTest']]=$tarea->getId();
                   $evaluacion['totalTest']++;
                   break;
      case 'cuestionario':
                   $evaluacion['cuestionario'.$evaluacion['totalCuestionarios']]=$tarea->getId();
                   $evaluacion['totalCuestionarios']++;
                   break;
      case 'problemas':
                   $evaluacion['problema'.$evaluacion['totalProblemas']]=$tarea->getId();
                   $evaluacion['totalProblemas']++;
                   break;
      default:     break;
    } // switch
  }
  if (0==$evaluacion['totalProblemas']+$evaluacion['totalCuestionarios']+$evaluacion['totalTest'])
  {
    return;
  }
  $peso= floor(100 / ($evaluacion['totalProblemas']+$evaluacion['totalCuestionarios']+$evaluacion['totalTest']));
  for ($i=0;$i<$evaluacion['totalTest'];$i++)
  {
    $evaluacion['pesoTest'.$i]=$peso;
  }
  for ($i=0;$i<$evaluacion['totalCuestionarios'];$i++)
  {
    $evaluacion['pesoCuest'.$i]=$peso;
  }
  for ($i=0;$i<$evaluacion['totalProblemas'];$i++)
  {
    $evaluacion['pesoProb'.$i]=$peso;
  }

  $this->browser->post('/evaluacion/guardarEvaluacionModulo',$evaluacion)
       ->isRedirected()
       ->followRedirect()
       ->checkResponseElement('div[class="nota_informativa"]', '/han sido guardados/');
 }

 public function checkEvaluarModulo($modulo,$alumnos)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Evaluar Modulo supervisor++++++++++++++++');
  $this->browser->get('/evaluacion/evaluarModulo/idmodulo/'.$modulo->getId());
  foreach($alumnos as $alumno)
  {
    $this->browser->checkResponseElement('body', '/'.$alumno->getNombre().'/')
          ->checkResponseElement('body', '/6/');//nota segun los datos almacenados
  }
 }

 public function checkVerRanking($modulo)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Ver Ranking Modulo supervisor++++++++++++++++');
  $this->browser->get('/seguimiento/rankingModulo/idmodulo/'.$modulo->getId())
       ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Ranking/');
 }

 public function checkEnviarRanking($modulo)
 {
  $this->test->diag(''); $this->test->diag('++++++++++++++++check Enviar Ranking Modulo supervisor++++++++++++++++');
  $this->browser->get('/notificaciones/enviarRankingModulo/idmodulo/'.$modulo->getId())
       ->isStatusCode(200)
       ->checkResponseElement('div[class="nota_informativa"]', '/enviado el ranking/')
       ->back();
  }
}


?>