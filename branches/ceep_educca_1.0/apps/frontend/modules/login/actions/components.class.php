<?php

/**
 * login actions.
 *
 * @package    edoceo
 * @subpackage login
 * @author     Todor Blajev
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class loginComponents extends sfComponents
{

  public function executeDefault() {

  }

  /**
   * Executes login action
   *
   */
	public function executeLogin()
	{
	  if (($this->getRequest()->getMethod() == sfRequest::POST)&&($this->getRequestParameter('password')))
	  {
	    // handle the form submission
	    $usuario = $this->getUser();

	    if ( ($usuario->hasCredential('alumno')) && ($usuario->hasCredential('profesor'))) {
	        $destino = '/login/seleccion';
	    } else { if ($usuario->hasCredential('alumno')) {
	                       $destino = '/alumno/index';
                  }else { if ($usuario->hasCredential('supervisor')) {
	                           $destino = '/supervisor/index';
                           }else { if ($usuario->hasCredential('profesor')) {
	       			                    $destino = '/profesor/index';
	    		                    } else { if ($usuario->hasCredential('administrador')) {
	       			                       $destino = '/admin/index';
	    		                        } else{ if ($usuario->hasCredential('moroso')) {
	       			                                 $destino = '/moroso/index';
	    		                              } else {  $destino = '/login/login';      //No debería llegar aquí
                                                    }
                                             }
                                        }
									}
						}

      }

   $usuarioObj = UsuarioPeer::retrieveByPk($usuario->getAnyId());
   $this->forward404Unless($usuarioObj);
   $numconex = $usuarioObj->getNumconexion()+1;
   $usuarioObj->setNumconexion($numconex);
   $usuarioObj->save();
   $usuario->setAttribute('numconex', $numconex);


   if ( ($usuario->hasCredential('alumno')) || ($usuario->hasCredential('profesor'))) {
     $ip=self::getRealIP();
 	 $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
     $this->usuario->setUltimoacceso(date("Y-m-d H:i:s"));
     $this->usuario->setUltimaip($ip);
     $this->usuario->save();
    }
     return $this->redirect($destino);
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

      // los proxys van añadiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar
      // una dirección ip que no sea del rango privado. En caso de no
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

	/* if ($usuario->hasCredential('alumno')) {
	                  $id = $this->getUser()->getAlumnoId() ; }
			      else { if ($usuario->hasCredential('supervisor')) {
	                           $id = $this->getUser()->getSupervisorId() ;    }
      			          else{  if ($usuario->hasCredential('profesor')) {
	       				      	      $id = $this->getUser()->getProfesorId();
	    			              } else { if ($usuario->hasCredential('moroso')) {
	       				      	                  $id = $this->getUser()->getMorosoId();
	    			                       } else { if ($usuario->hasCredential('administrador')) {
	       				      	                        $id = $this->getUser()->getAdministradorId();
	    			                                 } else {$this->redirect('@homepage');}
								                  }

								         }
                               }
                        }*/


    $this->getUser()->signOut();

    $this->redirect('@homepage');
  }

  public function executeSeleccion()
  {
   $this->nombre = $this->getUser()->getNombreAlumno();
  }

  public function executeSeleccionOk()
  {if ($this->getRequest()->getMethod() == sfRequest::POST)
	  {
	    $modo = $this->getRequest()->getParameter('modo');
	    if ($modo=="alumno") {
	    	$this->getUser()->removeCredential('profesor');
	    	$destino = '/alumno/index';
	    }
	    else {	$this->getUser()->removeCredential('alumno');
	    	    $destino = '/profesor/index';
		   }
	  }
	  return $this->redirect($destino);
  }


  // Nombre del método: validateClaveolvidada()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Valida el formulario de Clave olvidada
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
	        if (!$ValidadorEmail->execute(&$email, &$error))
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

  // Nombre del método: enviarCorreo($usuario,$pwd,$email)
  // Añadida por: Jacobo Chaquet
  /* Descripción: enviar un correo al usuario indicandole su loggin y password
   */

  private function enviarCorreo($usuario,$pwd,$email)
  {
    $message = "<html><head></head><body>Bienvenido a la academia¡¡¡¡<br><br><br><b>usuario:</b>".$usuario."<br><b>password:</b>".$pwd."</body></html>";

    $cabeceras = "From: adra-online@email.com\r\nContent-type: text/html\r\n";
    mail($email,'Bienvenido a la academia Adra',$message,$cabeceras);

  }

  // Nombre del método: Claveolvidada
  // Añadida por: Jacobo Chaquet
  /* Descripción:   si el usuario olvida su clave se genera una clave aleatoria y se le envia a su correo, para ello el
                    usuario debe indicar su correo y su DNI
   */
	public function executeClaveolvidada()
	{
	 if ($this->getRequest()->getMethod() == sfRequest::POST) {

           $c1 = new Criteria();
	       $c1->add(UsuarioPeer::EMAIL, $this->getRequestParameter('email'));
	       $c1->add(UsuarioPeer::DNI, $this->getRequestParameter('dni'));
           $usuario = UsuarioPeer::doSelectOne($c1);

           if ($usuario) {
               $ok =true;
               $pwd = substr($usuario->getNombre(),0,3).substr($usuario->getApellidos(),0,3).rand(100,999);

		        $con = Propel::getConnection();
  		    	try
  				{
    		  	   $con->begin();
             	   $usuario->setPassword($pwd);
           		   $usuario->save($con);

    			    $con->commit();
               }
  			catch (Exception $e)
  				{	$con->rollback();
  				    $ok=false;
    				throw $e;
  				}

           if ($ok) { self::enviarCorreo($usuario->getNombreusuario(),$pwd,$this->getRequestParameter('email'));}
           $this->pwd=$pwd;
           }

       $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
       return;
	 }
	 else{
         }
	}

  // Nombre del método: UsuarioValido()
  // Añadida por: Jacobo Chaquet
  /* Descripción:   Comprueba que no haya dos o mas usuarios conectados si los hay expulsa a todos menos al último que entro
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
