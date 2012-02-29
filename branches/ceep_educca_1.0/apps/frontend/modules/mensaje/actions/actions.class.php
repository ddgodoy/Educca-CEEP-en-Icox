<?php

/**
 * mensaje actions.
 *
 * @package    edoceo
 * @subpackage mensaje
 * @author     Angel Martin Latasa
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class mensajeActions extends sfActions
{

   // Nombre del metodo: comprobarPermiso($curso)
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Comprueba que el usuario tiene permiso para ver contenidos, si no los tiene logout
   */

  private function comprobarPermisoMensaje($idmensaje)
  {
    if (!$idmensaje) {
        $this->getContext()->getController()->forward('login','logout');
    }
    if (!$this->getUser()->hasCredential('supervisor')) {
            $mensaje = MensajePeer::RetrieveByPk($idmensaje);
            if (!$mensaje) {
                $this->getContext()->getController()->forward('login','logout');
            }
            $usuarioId = $this->getUser()->getAnyId();
            if ( ($mensaje->getIdPropietario()!= $usuarioId) &&
                 ($mensaje->getIdEmisor()!= $usuarioId) &&
                 ($mensaje->getIdDestinatario() != $usuarioId) )

            {
                 $this->getContext()->getController()->forward('login','logout');
            }
        }

  }


  // Accion #1
  public function executeIndex()
  {

  }


  // Accion #2
  // Extrae los mensajes recibidos del usuario que esta conectado y los pasa
  // como parametro en un array al template correspondiente
  public function executeMensajesRecibidos()
  {
    // Se obtienen los cursos a los que atiende o que enseña el usuario que esta
    // conectado para pasarlos al template
    $cursos_temp = $this->getUser()->getCursosAny();
    $cursos = array();
    $cursos[0] = "Todos los cursos";
    foreach($cursos_temp as $curso_temp) {
      $cursos[$curso_temp->getIdCurso()] = $curso_temp->getCurso()->getNombre();
    }
    $this->cursos = $cursos;
  }


  // Accion #3
  // Extrae los mensajes recibidos del usuario que esta conectado y los pasa
  // como parametro en un array al template correspondiente
  public function executeListarMensajesRecibidos()
  {

    // Recogemos el curso del que se quieren  los mensajes
    $id_curso = $this->getRequestParameter('filtro');

    if ($id_curso) {

      // Si se elegio un curso como filtro mostramos los mensajes de dicho curso
      $this->mensajes = $this->getUser()->getMensajesRecibidosCurso($id_curso, 0);

    } else {

      // Sino mostramos todos los mensajes
      $this->mensajes = $this->getUser()->getMensajesRecibidosRolCursos(0);

    }
  }

  public function executeListarMensajesRecibidosCorto()
  {
    // Recogemos el curso del que se quieren  los mensajes
    $id_curso = $this->getRequestParameter('filtro');

    $mensajes = $this->getUser()->getMensajesRecibidosRolCursos(0,1);

	  $primeros= array_chunk($mensajes,5);

    if ($primeros != null) {
      $this->mensajes = $primeros[0];
    } else {
      $this->mensajes = array();
    }

  }

  // Accion #4
  // Borra mensajes de la bandeja de salida
  public function executeBorrarMensajesRecibidos()
  {

      // Si se hizo submit con delete...
      $total_mensajes = $this->getRequestParameter('total_mensajes');
      // Buscamos los checkbox de cada mensaje que estaban activos y borramos
      // los mensajes correspondientes DE FORMA PERMANENTE (asi ocurre
      // con los mensajes de la bandeja de salida)
      for ($i = 0; $i < $total_mensajes; $i++) {
        if ($this->hasRequestParameter("mensaje$i")) {
          $id_mensaje = $this->getRequestParameter("mensaje$i");
          $mensaje = MensajePeer::RetrieveByPk($id_mensaje);
          $mensaje->setBorrado(1);
          $mensaje->save();
        }
      }
      $this->forward('mensaje', 'listarMensajesRecibidos');
  }


  // Accion #5
  // Extrae los mensajes enviados por el usuario que esta conectado y los pasa
  // como parametro en un array al template correspondiente
  public function executeMensajesEnviados()
  {

    // Se obtienen los cursos a los que atiende o que enseña el usuario que esta
    // conectado para pasarlos al template
    $cursos_temp = $this->getUser()->getCursosAny();
    $cursos = array();
    $cursos[0] = "Todos los cursos";
    foreach($cursos_temp as $curso_temp) {
       $cursos[$curso_temp->getIdCurso()] = $curso_temp->getCurso()->getNombre();
    }
    $this->cursos = $cursos;

  }


  // Accion #6
  // Extrae los mensajes recibidos del usuario que esta conectado y los pasa
  // como parametro en un array al template correspondiente
  public function executeListarMensajesEnviados()
  {

    // Recogemos el curso del que se quieren  los mensajes
    $id_curso = $this->getRequestParameter('filtro');

    if ($id_curso) {

      // Si se elegio un curso como filtro mostramos los mensajes de dicho curso
      $this->mensajes = $this->getUser()->getMensajesEnviadosCurso($id_curso, 0);

    } else {

      // Sino mostramos todos los mensajes
      $this->mensajes = $this->getUser()->getMensajesEnviadosRolCursos(0);

    }
  }

  // Accion #7
  // Borra mensajes de la bandeja de salida
  public function executeBorrarMensajesEnviados()
  {

      // Si se hizo submit con delete...
      $total_mensajes = $this->getRequestParameter('total_mensajes');
      // Buscamos los checkbox de cada mensaje que estaban activos y borramos
      // los mensajes correspondientes DE FORMA PERMANENTE (asi ocurre
      // con los mensajes de la bandeja de salida)
      for ($i = 0; $i < $total_mensajes; $i++) {
        if ($this->hasRequestParameter("mensaje$i")) {
          $id_mensaje = $this->getRequestParameter("mensaje$i");
          $mensaje = MensajePeer::RetrieveByPk($id_mensaje);
          $mensaje->delete();
        }
      }
      $this->forward('mensaje', 'listarMensajesEnviados');
  }

// Accion #8 -Redirige al template correspondiente
  public function executeRedactarMensaje()
  {
    // Se obtienen los cursos a los que atiende o que enseña el usuario que esta conectado para pasarlos al template
    $cursos_temp = $this->getUser()->getCursosAny();

    $c = new Criteria();
    $asuntos_temp = Asunto_mensajePeer::doSelect($c);

    $cursos = array();
    $cursos[0] = "Selecciona un curso";

    foreach($cursos_temp as $curso_temp) {
     if ("vacio" != $curso_temp->getCurso()->getNombre()) {
       $cursos[$curso_temp->getIdCurso()] = $curso_temp->getCurso()->getNombre();
     }
    }
    $asuntos = array();
    $asuntos[0] = "Selecciona un asunto";

    foreach($asuntos_temp as $asunto_temp) {
			$asuntos[$asunto_temp->getId()] = $asunto_temp->getDescripcion();
    }
    $this->asuntos = $asuntos;
    $this->cursos = $cursos;
		$this->es_respuesta = 0;

    if ($this->hasRequestParameter('id_mensaje')) {
      $this->mensaje = MensajePeer::RetrieveByPk($this->getRequestParameter('id_mensaje'));
      $this->es_respuesta = 1;
    }
    if ($this->hasRequestParameter('error')) {
      $this->error = 1;
    } else {
      $this->error = 0;
    }
  }

// Accion #9 Redirige al template correspondiente
  public function executeElegirDestinatarios()
  {
    $id_asunto = $this->getRequestParameter('asunto');
    $id_curso = $this->getRequestParameter('curso');

    if (($id_curso) && ($id_asunto)) {
      $this->mostrar = 1;

      $c = new Criteria();
	    $c->add(Asunto_mensajePeer::NOMBRE, "quejas");
	    $asunto_queja = Asunto_mensajePeer::doSelectOne($c);
  	  $id_queja = $asunto_queja->getId();

      if ($id_queja == $id_asunto) {
//        $this->profesores = $this->getUser()->getSupervisores();
        $this->profesores = $this->getUser()->getAdministradores();
        $this->alumnos = array();
      } else {
        $curso = CursoPeer::RetrieveByPk($id_curso);
        $this->profesores = $this->getUser()->getProfesoresCurso($id_curso);
        $this->alumnos = $this->getUser()->getAlumnosCurso($id_curso);
      }
    } else {
      $this->mostrar = 0;
    }
  }

  // Accion #10
  // Envia el mensaje a tantos usuarios como estaban marcados en la lista
  // de destinatarios y deja un mensaje en la bandeja de salida.
  public function executeEnviarMensaje()
  {
    $numero_destinatarios = $this->getRequestParameter('numero_destinatarios');
    $destinatarios_elegidos = 0;
    $emisor = $this->getUser()->getAnyId();

    $curso = $this->getRequestParameter('curso');
    $asunto = $this->getRequestParameter('asunto');
    $contenido = $this->getRequestParameter('contenidomsj');

    $errores = array();
    $destinatarios = array();

    if (!$curso) {array_push($errores, "No ha elegido ningun curso");}
    else {
      for ($i = 0; $i < $numero_destinatarios; $i++) {
        if ($this->hasRequestParameter("usuario$i")) {
          array_push($destinatarios, $this->getRequestParameter("usuario$i"));
        }
      }
      if (!count($destinatarios)) {array_push($errores, "Debe elegir al menos un destinatario");}
    }

    if ($asunto == 0){array_push($errores, "El mensaje debe tener un asunto");}
    if ($contenido == ""){$this->redirect('mensaje/redactarMensaje?error=vacio');}



    if (!count($errores)) {
      $listado_destinatarios = "";
      $i = 0;

      if ( ($this->getUser()->hasCredential('alumno')) && $asunto != 5) {
        $hay_seguimiento = 1;
      } else
        $hay_seguimiento = 0;

      foreach ($destinatarios as $destinatario) {

        $usuario = UsuarioPeer::RetrieveByPk($destinatario);
        $nombre = $usuario->getNombre()." ".$usuario->getApellidos();

        if ($i) {$listado_destinatarios .= ", ".$nombre;}
        else {$listado_destinatarios = $nombre;}

        $c = new Criteria();
  	    $c->add(Asunto_mensajePeer::NOMBRE, "quejas");
  	    $id_r = Asunto_mensajePeer::doSelectOne($c);
    	  $id_a= $id_r ->getId();

        $mensaje = new Mensaje();
        $mensaje->setIdEmisor($emisor);
        $mensaje->setIdDestinatario($destinatario);
        $mensaje->setIdPropietario($destinatario);
        $mensaje->setIdCurso($curso);
        $mensaje->setIdAsunto($asunto);
        $mensaje->setContenido($contenido);
        $mensaje->setListaDestinatarios($nombre);
        $mensaje->setLeido(0);

        if ($id_a==$this->getRequestParameter('asunto'))
        {//mensaje para supervisor
          $mensaje->setSupervisor(1);
        }else $mensaje->setSupervisor(0);

        try // A partir de aqui comprobaremos si es un mensaje en el que hace falta seguimiento
        {
          $mensaje->save();
          $mensajeId = $mensaje->getId();
        }
        catch (Exception $e)
        {
          $this->errorMsg = sfConfig::get('mod_seguimiento_errormsj_001');
          throw new Exception($e->getMessage());
        }

        if ($hay_seguimiento) {
          $usuario = UsuarioPeer::RetrieveByPk($destinatario);

          if ($usuario->esProfesor($curso)) {
              $seguimiento = new Seguimiento_mensaje();

              $seguimiento->setIdPregunta($mensajeId);
              $seguimiento->setIdProfesor($destinatario);
              $seguimiento->save();
          }
        }

        $i++;
      }

      $mensaje = new Mensaje();
      $mensaje->setIdEmisor($emisor);
      $mensaje->setIdPropietario($emisor);
      $mensaje->setIdCurso($curso);
      $mensaje->setIdAsunto($asunto);
      $mensaje->setContenido($contenido);
      $mensaje->setListaDestinatarios($listado_destinatarios);
      $mensaje->setLeido(0);

      if ($this->getRequestParameter('respuesta_profesor')) {

          $seguimiento = Seguimiento_mensajePeer::retrieveByPk($this->getRequestParameter('id_pregunta'));
          $seguimiento->setIdProfesor($emisor);
          $seguimiento->setFechaRespuesta(date("y-m-d H:i:s"));
          $seguimiento->save();
      }

      $mensaje->save();
      $this->mensaje = $mensaje;
      $this->redirect('mensaje/mensajesEnviados');
    }

    $this->errores = $errores;
  }


  // Accion #11
  //
  public function executeMostrarMensajeRecibido()
  {
    self::comprobarPermisoMensaje($this->getRequestParameter('id_mensaje'));

    $mensaje = MensajePeer::RetrieveByPk($this->getRequestParameter('id_mensaje'));

    if ($this->hasRequestParameter('opcion')) {
      $opcion = $this->getRequestParameter('opcion');

      if ($opcion == 'Eliminar') {
        $mensaje->setBorrado(1);
        $mensaje->save();
        $this->redirect('mensaje/mensajesRecibidos');
      } else if ($opcion == 'Recuperar') {
        $mensaje->setBorrado(0);
        $mensaje->save();
        $this->redirect('mensaje/mensajesRecibidos');
      } else if ($opcion == 'Responder') {
        $this->forward('mensaje', 'redactarMensaje');
      }

    } else {
      $mensaje->setLeido(1);
      $mensaje->save();
      $this->mensaje = $mensaje;
    }
  }


  // Accion #12
  //
  public function executeMostrarMensajeEnviado()
  {
    self::comprobarPermisoMensaje($this->getRequestParameter('id_mensaje'));
    $mensaje = MensajePeer::RetrieveByPk($this->getRequestParameter('id_mensaje'));

    if ($this->hasRequestParameter('opcion')) {
      $opcion = $this->getRequestParameter('opcion');

      if ($opcion == 'Eliminar') {
        $mensaje->delete();
        $this->redirect('mensaje/mensajesEnviados');
      }

    } else {
      $this->mensaje = $mensaje;
    }
  }


  // Accion #13
  // Elimina un solo mensaje desde los templates MensajeRecibido o
  // MensajeEnviado
  public function executeDeleteSingle()
  {

    $mensaje = MensajePeer::RetrieveByPk($this->getRequestParameter('identificador_mensaje'));
    $mensaje->setBorrado(1);
    $mensaje->save();
    $this->redirect('mensaje/mensajesPapelera');
  }


  // Accion #14
  // Prepara los cursos para filtrar la papelera de mensajes
  public function executeMensajesPapelera()
  {

    // Se obtienen los cursos a los que atiende o que enseña el usuario que esta
    // conectado para pasarlos al template
    $cursos_temp = $this->getUser()->getCursosAny();
    $cursos = array();
    $cursos[0] = "Todos los cursos";
    foreach($cursos_temp as $curso_temp) {
       $cursos[$curso_temp->getIdCurso()] = $curso_temp->getCurso()->getNombre();
    }
    $this->cursos = $cursos;

  }


  // Accion #15
  // Extrae todos los mensajes de la papelera del usuario segun el curso y otros
  // parametros
  public function executeListarMensajesPapelera()
  {

    // Recogemos el curso del que se quieren  los mensajes
    $id_curso = $this->getRequestParameter('filtro');

    if ($id_curso) {

      // Si se elegio un curso como filtro mostramos los mensajes de dicho curso
      // que se borraron
      $this->mensajes = $this->getUser()->getMensajesRecibidosCurso($id_curso, 1);

    } else {

      // Sino mostramos todos los mensajes borrados
      $this->mensajes = $this->getUser()->getMensajesRecibidosRolCursos(1);

    }
  }


  // Accion #16
  public function executeBorrarMensajesPapelera()
  {

    // Si se hizo submit con Recuperar...
    $total_mensajes = $this->getRequestParameter('total_mensajes');
    // Buscamos los checkbox de cada mensaje que estaban activos y los movemos
    // a la bandeja de entrada
    for ($i = 0; $i < $total_mensajes; $i++) {
      if ($this->hasRequestParameter("mensaje$i")) {
        $id_mensaje = $this->getRequestParameter("mensaje$i");
        $mensaje = MensajePeer::RetrieveByPk($id_mensaje);
        $mensaje->delete();
      }
    }
    $this->forward('mensaje', 'listarMensajesPapelera');
  }


  // Accion #17
  public function executeRecuperarMensajesPapelera()
  {

    // Si se hizo submit con Recuperar...
    $total_mensajes = $this->getRequestParameter('total_mensajes');
    // Buscamos los checkbox de cada mensaje que estaban activos y los movemos
    // a la bandeja de entrada
    for ($i = 0; $i < $total_mensajes; $i++) {
      if ($this->hasRequestParameter("mensaje$i")) {
        $id_mensaje = $this->getRequestParameter("mensaje$i");
        $mensaje = MensajePeer::RetrieveByPk($id_mensaje);
        $mensaje->setBorrado(0);
        $mensaje->save();
      }
    }
    $this->forward('mensaje', 'listarMensajesPapelera');
  }
}
