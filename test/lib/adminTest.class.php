<?php
//require_once('sfMyTestBrowser.class.php');
//require_once($sf_symfony_lib_dir.'/vendor/lime/lime.php');;
//sfLoader::loadHelpers('Text');
class adminTest
{
  protected $browser = null;
  protected $test = null;
  protected $nombre_usuario = null;
  protected $usuario_password = null;
  protected $array_curso;
  protected $array_modulo;
  protected $array_usuario;


  public function adminTest($b=null, $t, $nombre=null, $pwd = null)
  {
    $this->test =  $t;
    $this->usuario_password =  $pwd ;
    $this->nombre_usuario =  $nombre ;
    $this->browser = $b;

    $anio = date("Y");
    $anioSig = $anio + 1;
    $this->array_curso = array( 'fechaInicio'           => date("d")."-".date("m")."-".$anio,
                                'fechaFin'              => date("d")."-".date("m")."-".$anioSig,
                                'materia_id'            => null,
                                'nombre'                => null,
                                'duracion'              => 250,
                                'precio'                => 500,
                                'menu_info'             => 1,
                                'menu_biblio_archivos'  => 1,
                                'menu_temario'          => 1,
                                'menu_biblio'           => 1,
                                'menu_seguimiento'      => 1,
                                'menu_eventos'          => 1,
                                'menu_chat'             => 1,
                                'menu_foro'             => 1,
                                'menu_ejercicios'       => 1,
                                'modalidad'             => 'mensual'
                                );

    $this->array_modulo = array(  'pulsadosCursos' => null,
                                  'totalCursos'    => null,
                                  'nombre'         => null,
                                  'precio'         => '250',
                                  'modalidad'      => 'mensual',
                                  'descripcion'    => 'descripcion modulo'
                                 );
    $this->array_usuario = array(  'usuario'      => 'usuarioTest',
                                   'dni'          => '123456789',
                                   'nombre'       => 'nombretest',
                                   'apellidos'    => 'test',
                                   'email'        => 'usuarioTest@yahoo.es',
                                   'email2'       => 'usuarioTest@yahoo.es',
                                   'pwd_email'          => 'pruebasTest', //para acceder al correo yahoo
                                   'emailstop'    => 0,
                                   'telefono'     => '912345646',
                                   'telefono2'    => '912345646',
                                   'institucion'  => 'samarco',
                                   'departamento' => 'pruebas',
                                   'direccion'    => 'balle del tormes',
                                   'cp'           => '28001',
                                   'ciudad'       => 'madrid',
                                   'pais'         => 73
                             );

  }


  public function loggin($msg=true)
  { //$this->browser->
    $this->test->diag(''); $this->test->diag('++++++++++++++++loggin para administracion '.$this->nombre_usuario.'+++++++++++++++++++++++++++++');
    if ($msg)
    {
      $this->test->diag('        nombreusuario => '.$this->nombre_usuario);
      $this->test->diag('        password      => '.$this->usuario_password);
    }

    $this->browser->post('login/login', array('nombreusuario'=> $this->nombre_usuario, 'password'=> $this->usuario_password))
                  ->isRedirected()
                  ->followRedirect()
                  ->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', 'Alumnos pendientes por confirmar');
  }

  public function logout()
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++logout para administracion '.$this->nombre_usuario.'+++++++++++++++++++++++++++++');
    $this->browser->get('/admin/index')
                 ->click('ln_logout')
                 ->isRedirected()
                 ->followRedirect()
                 ->isStatusCode(200);
  }

  public function inicializacion($nombre_materias,$nombre_curso,$nombre_modulos,$nombre_usuarios)
  {
    $databaseManager = sfDatabaseManager::initialize();
    //$databaseManager->initialize();
    $ok = false;
    $c = new Criteria();
    $c->add(MateriaPeer::NOMBRE, "%$nombre_materias%", Criteria::LIKE);
    $materias = MateriaPeer::doSelect($c);
    if ($materias)
    {
      foreach($materias as $materia)
        { $materia->deleteContenido();}

      $ok = true;
      MateriaPeer::doDelete($c);
    }

    $c = new Criteria();
    $c->add(PaquetePeer::NOMBRE, "%$nombre_modulos%", Criteria::LIKE);
    if (PaquetePeer::doSelect($c))
    {
      $ok = true;
      PaquetePeer::doDelete($c);
    }

    $c = new Criteria();
    $c->add(UsuarioPeer::NOMBREUSUARIO, "%$nombre_usuarios%", Criteria::LIKE);
    if (UsuarioPeer::doSelect($c))
    {
      $ok = true;
      UsuarioPeer::doDelete($c);
    }

    $this->borrarNotificaciones($nombre_materias,$nombre_curso,$nombre_modulos,$nombre_usuarios);
    if ($ok)
    {
      $this->test->diag('');
      $this->test->diag('-------------------------------------------------------------------');
      $this->test->diag('Inicializacion: eliminar datos de pruebas anteriores si han fallado');
      $this->test->diag('-------------------------------------------------------------------');
    }
  }

  public function borrarNotificaciones($nombre_materias,$nombre_curso,$nombre_modulos,$nombre_usuarios)
  {
    $databaseManager = sfDatabaseManager::initialize();

    $c = new Criteria();
    $c->add(NotificacionPeer::CONTENIDO, "%$nombre_materias%", Criteria::LIKE);
    NotificacionPeer::doDelete($c);

    $c = new Criteria();
    $c->add(NotificacionPeer::CONTENIDO, "%$nombre_modulos%", Criteria::LIKE);
    NotificacionPeer::doDelete($c);

    $c = new Criteria();
    $c->add(NotificacionPeer::CONTENIDO, "%$nombre_usuarios%", Criteria::LIKE);
    NotificacionPeer::doDelete($c);

    $c = new Criteria();
    $c->add(NotificacionPeer::CONTENIDO, "%$nombre_curso%", Criteria::LIKE);
    NotificacionPeer::doDelete($c);

    $c = new Criteria();
    $c->add(NotificacionPeer::CONTENIDO, "%".$this->array_usuario['nombre'].' '.$this->array_usuario['apellidos']."%", Criteria::LIKE);
    NotificacionPeer::doDelete($c);

    $c = new Criteria();
    $c->add(NotificacionPeer::CONTENIDO, "%nombretest_mod%", Criteria::LIKE);
    NotificacionPeer::doDelete($c);
  }


  public function checkMenu()
  {
  $this->test->diag(''); $this->test->diag('++++++++++++++++Check menu principal administrador '.$this->nombre_usuario.'++++++++++++++++');
  $this->browser->get('/admin/index')
        ->click('ln_inicio')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', 'Alumnos pendientes por confirmar')
        ->click('ln_perfil')->checkResponseElement('div', '/Perfil de usuario/')
        ->click('ln_materias')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Materias instaladas en la plataforma/')
        ->click('ln_ejercicios')->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', '/Admnistración de ejercicios/')
        ->click('ln_cursos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Cursos instalados en la plataforma/')
        ->click('ln_modulos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Módulos instalados en la plataforma/')
        ->click('ln_usuarios')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Usuarios de la plataforma/')
        ->click('ln_superUsuarios')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Usuarios de la plataforma/')
        ->click('ln_alumnos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Alumnos de la plataforma/')
        ->click('ln_profesores')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Profesores de la plataforma/')
        ->click('ln_morosos')->checkResponseElement('div[class="tit_box_mensajes"] h2[class="titbox"]', '/Alumnos con pagos pendientes de la plataforma/');
  }

  public function checkSiteMap()
  {
    $this->test->diag(''); $this->test->diag('++++++++++++++++checkSiteMap administracion '.$this->nombre_usuario.'++++++++++++++++');
    $this->browser->get('admin/nuevoCurso')->isStatusCode(200)->checkResponseElement('div', '/Alta de un nuevo curso/');
    $this->browser->get('admin/nuevoModulo')->isStatusCode(200)->checkResponseElement('body', '/Alta de un nuevo módulo/');
    $this->browser->get('admin/nuevoUsuario/rol/alumno')->isStatusCode(200)->checkResponseElement('body', '/Alta de un nuevo alumno/');
    $this->browser->get('admin/nuevoUsuario/rol/profesor')->isStatusCode(200)->checkResponseElement('body', '/Alta de un nuevo profesor/');
    $this->browser->get('admin/nuevoUsuario/rol/administrador')->isStatusCode(200)->checkResponseElement('body', '/Alta de un nuevo administrador/');
    $this->browser->get('admin/nuevoUsuario/rol/supervisor')->isStatusCode(200)->checkResponseElement('body', '/Alta de un nuevo supervisor/');
  }


  public function crearMateria($nombre='materia_test_1')
  {
     $this->test->diag('');$this->test->diag('++++++++++++++++Creando nueva materia '.$nombre.'++++++++++++++++');

     $this->browser->get('admin/editMateria')
          ->isStatusCode(200)
          ->setField('materia', $nombre)
          ->setField('width', '500')
          ->setField('height', '600')
          ->setField('my_file', sfConfig::get('sf_test_dir').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."tmateria.zip")
          ->click('guardar')
          ->isStatusCode(200)
          ->checkResponseElement('div[class="titulo_principal"] h2[class="titbox"]', "Modificar materia \"$nombre\"");

    return  $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('materia');
  }

  public function eliminarMateria($materia, $forzar=false)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++Eliminar materia ('.$materia->getNombre().')++++++++++++++++');
    //la materia esta vacio no requiere confirmacion

    $cursos = $materia->getCursos();
    $this->browser->get('admin/materias/')->click('ln_borrar_materia'.$materia->getId());
    if ($forzar)
    { //mensaje el modulo no esta vacio tiene profesores y alumnos
      $this->browser
        ->checkResponseElement('body', '/Eliminar Materia/')
        ->click('ln_conf_borrar_materia'.$materia->getId());
    }
   $this->browser
         ->isRedirected()
         ->followRedirect()
         ->checkResponseElement('div', '!/'.$materia->getNombre().'/'); //comprobamos qse a borrado la materia

    $directorio = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'materias'.DIRECTORY_SEPARATOR.$materia->getId().DIRECTORY_SEPARATOR;
     if (is_dir($directorio))
      {
        echo "ERROR \n";
        $this->browser->throwsException('strict', 'No se ha eliminado el contenido de la materia '.$materia->getId());
        throw new sfException(sprintf('No se ha eliminado el contenido de la materia "%s" .', $materia->getId()));
      }
      
   $cursos = $materia->getCursos();
   foreach ($cursos as $curso)
   {
     $dir_raiz = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'biblioteca_archivos';
     $carpeta = $dir_raiz.DIRECTORY_SEPARATOR.$curso->getId();
      if (is_dir($carpeta))
      {
        echo "ERROR \n";
        $this->browser->throwsException('strict', 'No se ha eliminado la biblioteca de archivos al eliminar la materia '.$materia->getId());
        throw new sfException(sprintf('No se ha eliminado la biblioteca de archivos al eliminar la materia "%s" .', $materia->getId()));
      }
   }  
      
  }


  public function importarEjercicios($materia)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++Importando ejercicios ('.$materia->getNombre().')++++++++++++++++');
    $this->browser->get('admin/importarEjercicios')
          ->isStatusCode(200)
          ->setField('materia', $materia->getId())
          ->setField('my_file', sfConfig::get('sf_test_dir').DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."ejercicio.xml")
          ->click("guardarEjercicio")
          ->isStatusCode(200);

     return $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('ejercicio')  ;
   }


  public function exportarEjercicios($ejercicio,$nombreXML='ejercicio')
  {

    $this->test->diag('');$this->test->diag('++++++++++++++++exportando ejercicios ('.$ejercicio->getTitulo().')+++++++');
    $this->browser->get('admin/exportarEjercicio/id/'.$ejercicio->getId())
         ->isStatusCode(200);

    $file_xml = $this->browser->getResponse()->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('xml');
    $xml = simplexml_load_string($file_xml);

    if ($xml->getName() != $nombreXML)
    {
      echo "ERROR \n";
      $this->browser->throwsException('strict', 'Al exportar el ejercicio el fichero xml no es valido');
      throw new sfException(sprintf('Al exportar el ejercicio el fichero xml no es valido'));
    }
   }

  public function eliminarEjercicio($ejercicio)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++eliminar Ejercicio ('.$ejercicio->getTitulo().')+++++++');
    $this->browser->get('admin/listarEjercicios?filtro=0')
         ->click('ln_eliminar_ejercicio'.$ejercicio->getId());
  }

  public function crearCurso($materia,$nombre='curso_test_1')
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++Creando nuevo curso '.$nombre.' para la materia '.$materia->getNombre().'++++++++++++++++');

    $this->array_curso['nombre'] = $nombre;
    $this->array_curso['materia_id'] = $materia->getId();

    $this->browser->post('admin/nuevoCurso', $this->array_curso)
         ->isStatusCode(200);

    $curso = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('curso');

    //comprobamos
    $this->browser->get('admin/cursos')
            ->isStatusCode(200)
            ->checkResponseElement('div', '/'.$curso->getNombre().'/'); //comprobamos qse añadido el curso*/
    return $curso;
  }


  public function eliminarCurso($curso)
  {
    //eliminamos
    $this->test->diag('');$this->test->diag('++++++++++++++++Eliminando curso '.$curso->getNombre().'++++++++++++++++');

   $this->browser->click('ln_cursos')
                  ->click('eliminar_curso'.$curso->getId())
                  ->isRedirected()
                  ->followRedirect()
                  ->isStatusCode(200)
                  ->checkResponseElement('div', '!/'.$curso->getNombre().'/'); //comprobamos qse ha eliminado el curso

  }

  public function crearModulo($cursos, $nombre)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++creando modulo '.$nombre.'++++++++++++++++');
    $this->test->diag('Con los cursos: ');
    $i=0;
    foreach ($cursos as $curso)
    {
      $this->array_modulo['cursos'.$i] = $curso->getId();
      $this->test->diag('               - '.$curso->getNombre());
      $i++;
    }
    $this->array_modulo['nombre']=$nombre;
    $this->array_modulo['pulsadosCursos']=$i-1;
    $this->array_modulo['totalCursos']=$i;

    $this->browser->post('admin/nuevoModulo',$this->array_modulo )
                  ->isStatusCode(200);

    $modulo = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('modulo')  ;
    // comprobar
    $this->browser->get('admin/modulos')
                  ->isStatusCode(200)
                  ->checkResponseElement('body', '/'.$modulo->getNombre().'/'); //comprobar que se ha creado

    return $modulo;
  }

  public function eliminarModulo($modulo, $forzar = false)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++Eliminar modulo '.$modulo->getNombre().'++++++++++++++++');

   $this->browser->click('ln_modulos')
                  ->click('eliminar_modulo'.$modulo->getId());

    //mensaje el modulo no esta vacio tiene profesores y alumnos
    if ($forzar)
    {
      $this->browser->checkResponseElement('body', '/Cuidado/'); //comprobamos qse a borrado la materia
      $this->browser->click('forzar_eliminar_modulo'.$modulo->getId());
    }

    $this->browser
        ->isRedirected()
        ->followRedirect()
        ->checkResponseElement('body', '!/'.$modulo->getNombre().'/'); //comprobamos qse a borrado la materia
  }

  public function matricularCurso($nombre_usuario,$curso,$totalCursos,$rol)
  {
     $this->test->diag('');$this->test->diag('++++++++++++++++Matriculando('.$rol.') '.$nombre_usuario.' en curso '.$curso->getNombre().'+++');
     $this->array_usuario['rol']=$rol;
     $this->array_usuario['totalCursos']=$totalCursos;
     $this->array_usuario['totalPaquetes']=0;
     $this->array_usuario['pulsadosCursos'] =   1;
     $this->array_usuario['pulsadosPaquetes'] = 0;
     $this->array_usuario['cursos0']=$curso->getId();
     $this->array_usuario['usuario'] = $nombre_usuario;
     $this->array_usuario['nombre']  = $nombre_usuario;
     return $this->matricularUsuario($rol);
  }

  public function matricularModulo($nombre_usuario,$modulo,$totalPaquetes,$rol='alumno')
  {
     $this->test->diag('');$this->test->diag('++++++++++++++++Matriculando('.$rol.') '.$nombre_usuario.' en modulo '.$modulo->getNombre().'+++');
     $this->array_usuario['rol']=$rol;
     $this->array_usuario['totalCursos']=0;
     $this->array_usuario['totalPaquetes']=$totalPaquetes;
     $this->array_usuario['pulsadosCursos'] =   0;
     $this->array_usuario['pulsadosPaquetes'] = 1;
     $this->array_usuario['paquetes0']=$modulo->getId();
     $this->array_usuario['usuario'] = $nombre_usuario;
     $this->array_usuario['nombre']  = $nombre_usuario;
     return $this->matricularUsuario($rol);
  }

  public function crearSupervisor($nombre_usuario)
  {
     $this->test->diag('');$this->test->diag('++++++++++++++++crear supervisor '.$nombre_usuario.' ++++++++++++++++++++++++++++++++');
     $this->array_usuario['rol']='supervisor';
     $this->array_usuario['usuario'] = $nombre_usuario;
     $this->array_usuario['nombre']  = $nombre_usuario;
     $this->array_usuario['pulsadosCursos'] =   0;
     return $this->matricularUsuario($this->array_usuario['rol']);
  }


  protected function matricularUsuario($rol)
  {
    $this->browser->post('admin/nuevoUsuario/rol/'.$rol,$this->array_usuario)
         ->isStatusCode(200);

    $usuario = $this->browser->getContext()->getActionStack()->getEntry(0)->getActionInstance()->getVarHolder()->get('usuario')  ;

    switch($rol)
    {
      case 'alumno': $ln = 'alumnos';break;
      case 'profesor': $ln = 'profesores';break;
      case 'supervisor': $ln = 'usuarios/superUsuario/1';break;
      default:        ;
    } // switch
    $this->browser->get('admin/'.$ln)
          ->isStatusCode(200)
          ->checkResponseElement('body', '/'.$usuario->getNombreusuario().'/');

   return $usuario;
  }

  public function eliminarAlumno($alumno)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++Eliminar usuario '.$alumno->getNombreusuario().'++++++++++++++++');
    $this->browser->click('ln_alumnos')
        ->click('ln_eliminar_alumno'.$alumno->getId())
        ->isRedirected()
        ->followRedirect()
        ->isStatusCode(200)
        ->checkResponseElement('body', '!/'.$alumno->getNombreusuario().'/'); //comprobamos qse a borrado el usuario

    $this->eliminadaFoto($alumno);
  }

  public function eliminarProfesor($profesor)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++Eliminar Profesor '.$profesor->getNombreusuario().'++++++++++++++++');
    $this->browser->click('ln_profesores')
        ->click('ln_eliminar_profesor'.$profesor->getId())
        ->isRedirected()
        ->followRedirect()
        ->isStatusCode(200)
        ->checkResponseElement('body', '!/'.$profesor->getNombreusuario().'/'); //comprobamos qse a borrado el usuario

    $this->eliminadaFoto($profesor);
  }


  public function eliminarUsuario($usuario,$rol)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++Eliminar usuario ('.$rol.') '.$usuario->getNombreusuario().'++++++++++++++++');
    $this->browser->get('admin/usuarios')
        ->click('ln_eliminar_usuario'.$usuario->getId())
        ->isRedirected()
        ->followRedirect()
        ->isStatusCode(200)
        ->checkResponseElement('body', '!/'.$usuario->getNombreusuario().'/'); //comprobamos qse a borrado el usuario

    $this->eliminadaFoto($usuario);
  }

  public function eliminarSuperUsuario($usuario)
  {
    $this->test->diag('');$this->test->diag('++++++++++++++++eliminarSuperUsuario ('.$usuario->getNombreusuario().')++++++++++++++++');
    $this->browser->get('admin/usuarios/superUsuario/1')
        ->click('ln_eliminar_usuario'.$usuario->getId())
        ->isRedirected()
        ->followRedirect()
        ->isStatusCode(200)
        ->checkResponseElement('body', '!/'.$usuario->getNombreusuario().'/'); //comprobamos qse a borrado el usuario

     $this->eliminadaFoto($usuario);
  }

  public function eliminadaFoto($usuario)
  {
     $imagen = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'fotos_usuarios'.DIRECTORY_SEPARATOR.$usuario->getId().'_foto.jpg';
     if (file_exists($imagen))
      {
        echo "ERROR \n";
        $this->browser->throwsException('strict', 'No se ha eliminado la imagen del usuario '.$usuario->getNombreusuario());
        throw new sfException(sprintf('No se ha eliminado la imagen del usuario "%s" .', $usuario->getNombreusuario()));
      }
   }


}
?>