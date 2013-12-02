<?php
/**
 * usuario actions.
 *
 * @package    edoceo
 * @subpackage usuario
 * @author     Jacobo Chaquet
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class usuarioActions extends sfActions
{
 /**
 *
 * @name         executeMostrarPerfil()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Muestra el perfil de un usuario, si el que invoca este metodo es el administrador o supervisor podra ver todos los perfiles, en otro caso solo el perfil propio.
 */

  public function executeMostrarPerfil()
  {
    if ( $this->getUser()->hasCredential('administrador') || ($this->getUser()->hasCredential('supervisor')) )
    {
      if( $this->getRequestParameter('idusuario'))
        { $this->usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('idusuario'));
          $this->forward404Unless($this->usuario);
          return;
		    }
     }
     $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
     $this->forward404Unless($this->usuario);
  }

 /**
 *
 * @name         executeEditarPerfil()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Muestra el formulario de editar perfir y lo guarda
 */
  public function executeEditarPerfil()
  {
    if ( $this->getUser()->hasCredential('administrador') )
    {
      if( $this->getRequestParameter('idusuario'))
        { $this->usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('idusuario'));
		    }
		   else $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
	   }
	   else   $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
     $this->forward404Unless($this->usuario);

     if ($this->getRequest()->getMethod() == sfRequest::POST)
     {
         $this->usuario->setDni($this->getRequestParameter('dni'));
         $this->usuario->setNombre($this->getRequestParameter('nombre'));
	       $this->usuario->setApellidos($this->getRequestParameter('apellidos'));
	       $this->usuario->setEmail($this->getRequestParameter('email'));
	       $this->usuario->setEmailstop($this->getRequestParameter('emailstop'));
	       $this->usuario->setTelefono1($this->getRequestParameter('telefono1'));
	       $this->usuario->setTelefono2($this->getRequestParameter('telefono2'));
	       $this->usuario->setInstitucion($this->getRequestParameter('institucion'));
	       $this->usuario->setDepartamento($this->getRequestParameter('departamento'));
	       $this->usuario->setDireccion($this->getRequestParameter('direccion'));
	       $this->usuario->setCp($this->getRequestParameter('cp'));
	       $this->usuario->setCiudad($this->getRequestParameter('ciudad'));
	       $this->usuario->setPaisId($this->getRequestParameter('pais'));
	       $this->usuario->save();

         $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
         return;
    }
    else{ if ($this->usuario->getEmailStop() == 0)
  	          $this->selected =0;
	        else $this->selected =1;

	        $c = new Criteria();
	        $paises = PaisPeer::doselect($c);

	        $opcionesPais = array();
	        foreach ($paises as $pais)
            	 {$opcionesPais[$pais->getId()]= $pais->getNombre();}

          $this->opcionesPais = $opcionesPais;
         }
 }

 /**
 *
 * @name         validateEditarPerfil()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Valida el formulario de cambio de informacion personal. Se mostrara en una capa mediante AJAX
 */
   public function validateEditarPerfil()
  {
    $ok = true ;
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $dni= $this->getRequestParameter('dni');
      $nombre = $this->getRequestParameter('nombre');
      $apellidos = $this->getRequestParameter('apellidos');
      $email = $this->getRequestParameter('email');
      $emailstop = $this->getRequestParameter('emailstop');
      $telefono1 = $this->getRequestParameter('telefono1');
      $telefono2 = $this->getRequestParameter('telefono2');
      $institucion = $this->getRequestParameter('institucion');
      $departamento = $this->getRequestParameter('departamento');
      $direccion = $this->getRequestParameter('direccion');
      $cp = $this->getRequestParameter('cp');
      $ciudad = $this->getRequestParameter('ciudad');
      $pais = $this->getRequestParameter('pais');

      $ValidadorStr = new sfStringValidator();
      $ValidadorStr->initialize($this->getContext(), array(
      			'min'       => 2,
      			'min_error' => 'El campo es muy corto (m�nimo 2 caracteres)',
      			'max'       => 100,
      			'max_error' => 'El campo es muy largo (m�ximo 100 caracteres)',
    				));
      if (! $dni)
      { $this->getRequest()->setError('dni', 'Debe indicar el DNI');
        $ok = false ;  }

      if (! $nombre)
      { $this->getRequest()->setError('nombre', 'Debe indicar el NOMBRE');
        $ok = false ;  }
      //else {   if (!$ValidadorStr->execute(&$nombre,&$error))
      else {   if (!$ValidadorStr->execute($nombre,$error))
  			      {   $this->getRequest()->setError('nombre', $error);
  			         $ok = false ;  }
         	 }

      if (! $apellidos)
      { $this->getRequest()->setError('apellidos', 'Debe indicar los APELLIDOS');
        $ok = false ;  }
      //else {   if (!$ValidadorStr->execute(&$apellidos,&$error))
      else {   if (!$ValidadorStr->execute($apellidos,$error))
  		    	   {   $this->getRequest()->setError('apellido', $error);
  			          $ok = false ;  }
         	 }

      if (! $email)
      { $this->getRequest()->setError('email', 'Debe indicar el EMAIL');
        $ok = false ;  }
      else {  $ValidadorEmail = new sfEmailValidator();
              $ValidadorEmail->initialize($this->getContext(), null);
  	          //if (!$ValidadorEmail->execute(&$email, &$error))
  	          if (!$ValidadorEmail->execute($email, $error))
  			      {   $this->getRequest()->setError('email', 'Direcci�n de email no es v�lida');
  			          $ok = false ;  }
         	  }

      if (! $pais)
      {  $this->getRequest()->setError('pais', 'Debe indicar el PAIS');
         $ok = false ;  }
    }
     return $ok;
    }
 /**
 *
 * @name         validateModificarPassword()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Valida el formulario de cambio de password. Se mostrara en una capa mediante AJAX
 */
   public function validateModificarPassword()
  {
   $ok = true ;
 	 if ($this->getRequest()->getMethod() == sfRequest::POST)
   {
    	  $pwd= $this->getRequestParameter('pwd');
        $pwd1 = $this->getRequestParameter('pwd1');
        $pwd2 = $this->getRequestParameter('pwd2');

        $ValidadorStr = new sfStringValidator();
        $ValidadorStr->initialize($this->getContext(), array(
    			'min'       => 5,
    			'min_error' => 'El campo es muy corto (m&iacute;nimo 6 caracteres)',
    			'max'       => 20,
    			'max_error' => 'El campo es muy largo (m&aacute;ximo 20 caracteres)',
  				));

        if (! $pwd)
            {   $this->getRequest()->setError('Contrase&ntilde;a original', 'Debe indicar la contrase&ntilde;a');
                $ok = false ;  }
        //else {   if (!$ValidadorStr->execute(&$pwd,&$error))
        else {   if (!$ValidadorStr->execute($pwd,$error))
		  	         {   $this->getRequest()->setError('Contrase&ntilde;a original', $error);
			                $ok = false ;  }
			           if ($ok)
                 {
			             $usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
                   $nombreUsuario = $usuario->getNombreusuario();
			             $loginValidator = new myLoginValidator();
			             $loginValidator->initialize($this->getContext(), null);
			             //if (!$loginValidator->execute2(&$nombreUsuario,&$pwd,&$error))
			             if (!$loginValidator->execute2($nombreUsuario,$pwd,$error))
			             {
                     $this->getRequest()->setError('Contrase&ntilde;a original no v&aacute;lida', $error);
			               $ok = false ;
                    }
			            }
       	      }

        if (! $pwd1)
            { $this->getRequest()->setError('nueva contrase&ntilde;a', 'Debe indicar la nueva contrase&ntilde;a');
              $ok = false ;  }
        //else {   if (!$ValidadorStr->execute(&$pwd1,&$error))
        else {   if (!$ValidadorStr->execute($pwd1,$error))
		      	     {
                     $this->getRequest()->setError('nueva contrase&ntilde;a', $error);
			               $ok = false ;
                 }
       	     }

        if (! $pwd2)
        {   $this->getRequest()->setError('Repita contrase&ntilde;a', 'Debe indicar repetir la contrase&ntilde;a');
            $ok = false ;  }
        //else {   if (!$ValidadorStr->execute(&$pwd2,&$error))
        else {   if (!$ValidadorStr->execute($pwd2,$error))
		      	     {
                     $this->getRequest()->setError('Repita contrase&ntilde;a', $error);
			               $ok = false ;
                  }
       	     }

        if ($pwd1!=$pwd2)
        {
            $this->getRequest()->setError('Contrase&ntilde;as', 'Las nuevas contrase&ntilde;as no coinciden');
            $ok = false ;
        }
   }
   return $ok;
  }

 /**
 *
 * @name         executeModificarPassword()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   sirve para que el usuario cambie su contrase�a
 */
  public function executeModificarPassword()
  {
     $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
     $this->forward404Unless($this->usuario);

      if ($this->getRequest()->getMethod() == sfRequest::POST)
      {
            $pwd1 = $this->getRequestParameter('pwd1');
            $con = Propel::getConnection();
      			try
      			{
          			$con->begin();
          			$this->usuario->setPassword($pwd1);
                $this->usuario->save($con);
          			$con->commit();
             }
      			 catch (Exception $e)
      				{	$con->rollback();
        				throw $e;
      				}
                //echo "ok2<br>";
              $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
              return;
      }
      return;
  }

 /**
 *
 * @name         validateModificarFoto()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Valida el formulario de cambio de foto
 */
   public function validateModificarFoto()
  {
   $ok = true ;
 	 if ($this->getRequest()->getMethod() == sfRequest::POST)
   {
      	/*$file = $this->getRequest()->getFileName('file');

        if ($this->getRequest()->getFileName('file'))
             {
               if (".jpg"!=substr($file,strlen($file)-4, 4))
               {
                 $this->getRequest()->setError('Fichero', 'El fichero tiene que ser jpg');
			           $ok = false ;
			           $this->setLayout('eventoPopUp');
                }
             }*/
    }
   return $ok;
  }

 /**
 *
 * @name         executeModificarFoto()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   sirve para que el usuario cambie su foto
 */
  public function executeModificarFoto()
  {

     if ( $this->getUser()->hasCredential('administrador') )
     {
      if( $this->getRequestParameter('idusuario'))
        {
          $this->usuario = UsuarioPeer::retrieveByPk($this->getRequestParameter('idusuario'));
		    }else $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
     }else  $this->usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());

     $this->forward404Unless($this->usuario);
     $this->setLayout('eventoPopUp');

      if ($this->getRequest()->getMethod() == sfRequest::POST)
      {
          //$fileName = $this->getRequest()->getFileName('file');
          if (is_readable($_FILES['file']['tmp_name']))
          {

            $thumbnail = new sfThumbnail(65, 75,false,false);
            //$thumbnail->loadFile($this->getRequest()->getFilePath('file'));
            $thumbnail->loadFile($_FILES['file']['tmp_name']);
            $thumbnail->save(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'fotos_usuarios'.DIRECTORY_SEPARATOR.$this->usuario->getId().'_foto.jpg', 'image/jpeg');
            chmod(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'fotos_usuarios'.DIRECTORY_SEPARATOR.$this->usuario->getId().'_foto.jpg',0777);
            $foto=1;
          }
          else { $foto=0;       }

          $con = Propel::getConnection();
  			  try
  				{
      			$con->begin();
      			$this->usuario->setFoto($foto);
      			$this->usuario->save();
      			$con->commit();
          }
  			  catch (Exception $e)
  				{	$con->rollback();
    				throw $e;
  				}
            //echo "ok2<br>";
          $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
          return;
      }
      return;
  }

  public function handleErrorModificarFoto()
  {
    $this->setLayout('eventoPopUp');
  }
  
  
  
  public function executeAyuda ()
  {
    $mensaje = '';
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    // 
    {
      $asunto = $this->getRequestParameter('asunto');
      $comentario = $this->getRequestParameter('comentario');
      $mensaje = "<strong>Asunto:</strong> $asunto<br><br><strong>Comentario:</strong> $comentario";
      $id = $this->getUser()->getAnyId();
      $usuario = UsuarioPeer::RetrieveByPk($id);
      $usuario->emailUsuario(0, 2, 'ayuda', $mensaje);
    }
    $this->mensaje = $mensaje;
  }
}
