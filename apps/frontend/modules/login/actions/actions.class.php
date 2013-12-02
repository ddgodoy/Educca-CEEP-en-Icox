<?php

/**
 * login actions.
 *
 * @package    edoceo
 * @subpackage login
 * @author     Todor Blajev
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class loginActions extends sfActions
{


  public function executeRedireccionar()
  {
    $usuario = $this->getUser();
    $id_usuario = $usuario->getAnyId();
    $usuarioObj = UsuarioPeer::retrieveByPk($id_usuario);
    $this->forward404Unless($usuarioObj);

    // Destino por defecto en caso de error
    $destino = '/login/login';

    if ($usuarioObj->getConfirmado())
    {

      if ($usuario->hasCredential('alumno'))
      {
        $id_alumno = $usuario->getAlumnoId();
        $c = new Criteria();
        $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_alumno);
        $c->add(RolPeer::NOMBRE, 'alumno');
        $c->add(Tipo_eventoPeer::CLASE, 'examen');
        $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_alumno);
        $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::GREATER_THAN);
        $criterion2 = $c->getNewCriterion(EventoPeer::FECHA_INICIO, (time() + 1800), Criteria::LESS_THAN);
        $criterion1->addAnd($criterion2);
        $c->add($criterion1);
        $c->add(Rel_usuario_tareaPeer::ENTREGADA, 0);

        $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
        $c->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, TareaPeer::ID_CURSO);
        $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
        $c->addJoin(EventoPeer::ID_TIPO_EVENTO, Tipo_eventoPeer::ID);
        $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);

        $ex_obligatorio = EventoPeer::DoSelectOne($c);

        if ($ex_obligatorio)
        {
          $usuario->clearCredentials();
          $usuario->addCredential('examinandose');
          $usuario->setAttribute('id_evento', $ex_obligatorio->getId(), 'examinandose');
          $usuario->setAttribute('tipo_examen', 'obligatorio', 'examinandose');
          $usuario->setAttribute('id_usuario', $id_alumno, 'examinandose');
          $destino = '/examen/index';
        }
        else
        {
          $c = new Criteria();
          $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_alumno);
          $c->add(RolPeer::NOMBRE, 'alumno');
          $c->add(Tipo_eventoPeer::CLASE, 'examensorpresa');
          $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_alumno);
          $criterion1 = $c->getNewCriterion(EventoPeer::FECHA_FIN, time(), Criteria::GREATER_THAN);
          $criterion2 = $c->getNewCriterion(EventoPeer::FECHA_INICIO, time(), Criteria::LESS_THAN);
          $criterion1->addAnd($criterion2);
          $c->add($criterion1);
          $c->add(Rel_usuario_tareaPeer::ENTREGADA, 0);

          $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
          $c->addJoin(Rel_usuario_rol_cursoPeer::ID_CURSO, TareaPeer::ID_CURSO);
          $c->addJoin(TareaPeer::ID_EVENTO, EventoPeer::ID);
          $c->addJoin(EventoPeer::ID_TIPO_EVENTO, Tipo_eventoPeer::ID);
          $c->addJoin(TareaPeer::ID, Rel_usuario_tareaPeer::ID_TAREA);

          $ex_sorpresa = EventoPeer::DoSelectOne($c);

          if ($ex_sorpresa)
          {
            $usuario->clearCredentials();
            $usuario->addCredential('examinandose');
            $usuario->setAttribute('id_evento', $ex_sorpresa->getId(), 'examinandose');
            $usuario->setAttribute('tipo_examen', 'sorpresa', 'examinandose');
            $usuario->setAttribute('id_usuario', $id_alumno, 'examinandose');
            $usuario->setAttribute('checkpoint', time(), 'examinandose');
            $destino = '/examen/index';
          }
          else
          {
            $destino = '/alumno/index';
            if ($usuario->hasAttribute('pendientes_pago'))
            {
              $destino = '/alumno/moroso';  
            }
          }
        }
      }

      if ($usuario->hasCredential('supervisor'))
      {
        $destino = '/supervisor/index';
      }

      if ($usuario->hasCredential('profesor'))
      {
        $destino = '/profesor/index';
      }

      if ($usuario->hasCredential('administrador'))
      {
        $destino = '/admin/index';
      }

      if ($usuario->hasCredential('moroso'))
      {
        $destino = '/moroso/index';
      }

    }

   $numconex = $usuarioObj->getNumconexion()+1;
   $usuarioObj->setNumconexion($numconex);
   $usuarioObj->save();
   $usuario->setAttribute('numconex', $numconex);

   if ( ($usuario->hasCredential('alumno')) || ($usuario->hasCredential('profesor')))
   {
     $ip=self::getRealIP();
 	   $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
     $this->usuario->setUltimoacceso(date("Y-m-d H:i:s"));
     $this->usuario->setUltimaip($ip);
     $this->usuario->save();
   }
  return $this->redirect($destino);

  }


  /**
   * Executes login action
   *
   */
	public function executeLogin()
	{ if ($this->getRequest()->getMethod() == sfRequest::POST)
	  {
	    // handle the form submission
	    $usuario = $this->getUser();
	    if ($usuario->hasCredential('seleccion'))
	    {
        return $this->redirect('/login/seleccion');
      }

	    $id_usuario = $usuario->getAnyId();
	    if (!$id_usuario)
      {
	      return $this->renderText('<html><body>Error, no tiene credenciales</body></html>');
	    }
	    $usuarioObj = UsuarioPeer::retrieveByPk($id_usuario);
      $this->forward404Unless($usuarioObj);

      return $this->forward('login', 'redireccionar');
	 }
	}


  /**
   * Executes logout action
   *
   */
   private function getRealIP()
   { if( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )
      {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );

      // los proxys van a�adiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar
      // una direcci�n ip que no sea del rango privado. En caso de no
      // encontrarse ninguna se toma como valor el REMOTE_ADDR

      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);

      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');

            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }

   return $client_ip;

   }

	public function executeLogout()
  {
    $usuario = $this->getUser();
    if ($usuario->hasCredential('examinandose'))
    {
      $id_evento = $usuario->getAttribute('id_evento', '', 'examinandose');
      $evento = EventoPeer::RetrieveByPk($id_evento);
      $c = new Criteria();
      $c->add(TareaPeer::ID_EVENTO, $evento->getId());
      $tarea = TareaPeer::DoSelectOne($c);
      $id_tarea = $tarea->getId();
      $id_alumno = $usuario->getAttribute('id_usuario', '', 'examinandose');
      $c = new Criteria();
      $c->add(Rel_usuario_tareaPeer::ID_TAREA, $id_tarea);
      $c->add(Rel_usuario_tareaPeer::ID_USUARIO, $id_alumno);
      $relacion = Rel_usuario_tareaPeer::DoSelectOne($c);

      $checkpoint = $usuario->getAttribute('checkpoint', '', 'examinandose');
      $ahora = time();
      $diferencia = $ahora - $checkpoint;
      $tiempo_restante = $relacion->getTiempoRestante();
      $nuevo_restante = $tiempo_restante - $diferencia;
      if ($nuevo_restante < 0) {$nuevo_restante = 0;}
      $relacion->setTiempoRestante($nuevo_restante);
      $relacion->save();
    }

    $usuario->signOut();
    $this->redirect('@homepage');
  }

  public function executeSeleccion()
  {

    if ($this->getUser()->hasCredential('seleccion'))
    {
      $id_usuario = $this->getUser()->getAttribute('usuario_id', '', 'seleccion');
      $usuario = UsuarioPeer::RetrieveByPk($id_usuario);
      $c = new Criteria();
      $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario);
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
      $c->setDistinct();
      $roles = RolPeer::DoSelect($c);
      $nroles = RolPeer::DoCount($c);

      if (!$nroles)
      {
        return $this->redirect('/login/login');
      }

      $lista_roles = array();
      $hay_alumno = false;
      $hay_moroso = false;

      foreach ($roles as $rol)
      {
        if ($rol->getNombre() == 'alumno') {$hay_alumno = true; continue;}
        if ($rol->getNombre() == 'moroso') {$hay_moroso = true; continue;}
        $lista_roles[] = $rol->getNombre();
      }

      // El alumno y el moroso se cuentan como uno
      if ($hay_alumno || $hay_moroso) {$lista_roles[] = 'alumno';}

      $this->roles = $lista_roles;
      $this->nombre = $usuario->getNombre();

    }
    else
    {
      return $this->redirect('/login/login');
    }

  }

  public function executeSeleccionOk()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
	  {
	    $rol = $this->getRequest()->getParameter('rol');
	    $id_usuario = $this->getUser()->getAttribute('usuario_id', '', 'seleccion');

	    $c = new Criteria();
	    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario);
	    $c->add(RolPeer::NOMBRE, $rol);
	    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

      $usuario = UsuarioPeer::RetrieveByPk($id_usuario);

	    if (Rel_usuario_rol_cursoPeer::DoCount($c))
	    // Comprobacion adicional para saber si el usuario realmente tiene ese rol en algun curso
	    {
        $this->getUser()->asignarCredenciales($usuario, $rol);
      }
      else
      // �nicamente se llega aqu� si el usuario es moroso y no es alumno en ning�n curso
      {
        $c = new Criteria();
  	    $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $id_usuario);
  	    $c->add(RolPeer::NOMBRE, 'moroso');
  	    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);

        if (Rel_usuario_rol_cursoPeer::DoCount($c))
        // Comprobaci�n adicional para ver que realmente es moroso
        {
          $this->getUser()->asignarCredenciales($usuario, 'moroso');
        }
        else
        {
          return $this->redirect('/login/login');
        }
      }

	  }
	  return $this->forward('login', 'redireccionar');
  }


  // Nombre del m�todo: validateClaveolvidada()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: Valida el formulario de Clave olvidada
  				  Se mostrara en capa mediante AJAX
   */
   public function validateClaveolvidada()
  { $ok = true ;

   if ($this->getRequest()->getMethod() == sfRequest::POST) {
    $dni= $this->getRequestParameter('dni');
    $email = $this->getRequestParameter('email');

    $ValidadorStr = new sfStringValidator();
    $ValidadorStr->initialize($this->getContext(), array(
    			'min'       => 2,
    			'min_error' => 'El campo es muy corto (m&iacute;nimo 2 caracteres)',
    			'max'       => 100,
    			'max_error' => 'El campo es muy largo (m&aacute;ximo 100 caracteres)',
  				));
  if (! $dni)
  { $this->getRequest()->setError('dni', 'Debe indicar el DNI');
    $ok = false ;   }


  if (! $email)
   { $this->getRequest()->setError('email', 'Debe indicar el EMAIL');
     $ok = false ;  }
    else {  $ValidadorEmail = new sfEmailValidator();
            $ValidadorEmail->initialize($this->getContext(), null);
	        //if (!$ValidadorEmail->execute(&$email, &$error))
	        if (!$ValidadorEmail->execute($email, $error))
			   {   $this->getRequest()->setError('email', 'Direcci&oacute;n de email no es v&aacute;lida');
			       $ok = false ;}
    	}

   if ($ok) {
    $c1 = new Criteria();
	$c1->add(UsuarioPeer::EMAIL, $email);
    $result = UsuarioPeer::doSelect($c1);
    if (!$result) {
            $this->getRequest()->setError('email', 'La direcci&oacute;n de email no corresponde a ning&uacute;n usuario');
			$ok = false ;
        }
    $c1->add(UsuarioPeer::DNI, $dni);
    $result = UsuarioPeer::doSelect($c1);
    if (!$result) {
            $this->getRequest()->setError('dni', "El DNI no corresponde al usuario con direcci&oacute;n de email $email");
			$ok = false ;
        }

    }
   }
   return $ok;
  }

  // Nombre del m�todo: enviarCorreo($usuario,$pwd,$email)
  // A�adida por: Jacobo Chaquet
  /* Descripci�n: enviar un correo al usuario indicandole su loggin y password
   */

  private function enviarCorreo($usuario,$pwd,$email)
  {
    $message = "<html><head></head><body>Bienvenido a la academia����<br><br><br><b>usuario:</b>".$usuario."<br><b>password:</b>".$pwd."</body></html>";

    $cabeceras = "From: adra-online@email.com\r\nContent-type: text/html\r\n";
    mail($email,'Bienvenido a la academia Adra',$message,$cabeceras);

  }

  // Nombre del m�todo: Claveolvidada
  // A�adida por: Jacobo Chaquet
  /* Descripci�n:   si el usuario olvida su clave se genera una clave aleatoria y se le envia a su correo, para ello el
                    usuario debe indicar su correo y su DNI
   */
	public function executeClaveolvidada()
	{
	 if ($this->getRequest()->getMethod() == sfRequest::POST) {

         $c1 = new Criteria();
	       $c1->add(UsuarioPeer::EMAIL, $this->getRequestParameter('email'));
	       $c1->add(UsuarioPeer::DNI, $this->getRequestParameter('dni'));
         $usuarios = UsuarioPeer::doSelect($c1);
         foreach ($usuarios as $usuario)
         {
           if ($usuario)
           {
              $usuario->emailUsuario(null,-1,"pre-confirmacion");
				    }
         }

       $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
       return;
	 }
	 else{
         }
	}

  // Nombre del m�todo: UsuarioValido()
  // A�adida por: Jacobo Chaquet
  /* Descripci�n:   Comprueba que no haya dos o mas usuarios conectados si los hay expulsa a todos menos al �ltimo que entro
   */

	public function executeUsuarioValido()
	{
    if ($this->getRequest()->isXmlHttpRequest()) {
        //echo "entra<br>";
          $user = $this->getUser();
          if ($user->hasAttribute('numconex')) {
              $usuarioObj = UsuarioPeer::retrieveByPk($user->getAnyId());
              $this->forward404Unless($usuarioObj);
             if ($usuarioObj->getNumconexion()!=$user->getAttribute('numconex', '')) {//echo "entra";
                     $this->getUser()->signOut();
                     $this->getResponse()->setStatusCode(401);
              }
           }
       }
    }


  /**
   * Manejador de Errores
   *
   */
	public function handleErrorLogin()
	{
	  return sfView::SUCCESS;
	}



}
