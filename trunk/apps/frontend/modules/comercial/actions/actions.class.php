<?php
/**
 * comercial actions.
 *
 * @package    edoceo
 * @subpackage comercial
 * @authors    Jacobo Chaquet, Todor Todorov, Angel Martin
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class comercialActions extends sfActions
{
  /**
   * Executes index action
   */
  public function executeIndex()
  {
    if ($this->getRequestParameter('ft') == 1) {
  	  // Si es la primera ejecucion borramos el modulo setup
  	  $directory = SF_ROOT_DIR.'/apps/frontend/modules/setup';

  	  $this->recursive_remove_directory($directory,true);

  	  // Configuramos el modulo inicial
	    // Cargamos el fichero de configuracion inicial y lo modificamos

      $config = sfYAML::Load(SF_ROOT_DIR.'/apps/frontend/config/app.yml');
      $config['all']['core']['minicial'] = 'comercial';
  	  $config['all']['core']['ainicial'] = 'index';

  	  // Borramos el fichero de configuracion anterior
  	  unlink(SF_ROOT_DIR.'/apps/frontend/config/app.yml');

  	  $fichero = fopen(SF_ROOT_DIR.'/apps/frontend/config/app.yml','w');

  	  // Escribimos el nuevo fichero
  	  fwrite($fichero, sfYAML::Dump($config));

  	  fclose($fichero);

  	  // Borramos la cache
  	  $directory = SF_ROOT_DIR.'/cache';

  	  $this->recursive_remove_directory($directory,true);
    }
    $this->getUser()->getAttributeHolder()->remove('idcurso');

    $c = new Criteria();
    $c->add(PaquetePeer::FECHA_FIN, time(), Criteria::GREATER_THAN);
    $this->paquetes = PaquetePeer::DoSelect($c);

    $c = new Criteria();
    $c->add(CursoPeer::FECHA_FIN, time(), Criteria::GREATER_THAN);
    $this->cursos = CursoPeer::DoSelect($c);

  }
	//
  public function executeFicha()
  {
    if ($this->getRequestParameter('idcurso'))
    {
      $this->idcurso = $this->getRequestParameter('idcurso');
  	  $this->curso = CursoPeer::retrieveByPk($this->idcurso);

  	  $c = new Criteria();
  	  $c->add(TemaPeer::ID_MATERIA, $this->curso->getMateria()->getId());
          $c->addAscendingOrderByColumn(TemaPeer::ID);

  	  $this->temas = TemaPeer::doSelect($c);
    }
    else if ($this->getRequestParameter('idmodulo'))
    {
      $this->idmodulo = $this->getRequestParameter('idmodulo');
  	  $this->modulo = PaquetePeer::retrieveByPk($this->idmodulo);

  	  $this->cursos = $this->modulo->getRel_paquete_cursosJoinCurso();
    }
  }

  public function executeMatricula()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
	  {
	    // Damos de alta un usuario en un nuevo curso o modulo, puede que sea nuevo o no
	    $usuario = new Usuario();
	    $usuario->alta($this->getRequest()->getParameterHolder(),true);

      if ($this->getRequestParameter('idcurso'))
      {
        $this->redirect('comercial/confirmacion?idcurso='.$this->getRequestParameter('idcurso'));
      }
      else if ($this->getRequestParameter('idmodulo'))
      {
        $this->redirect('comercial/confirmacion?idmodulo='.$this->getRequestParameter('idmodulo'));
      }

    } else {
      if (($this->getUser()->hasCredential('alumno')) || ($this->getUser()->hasCredential('profesor')))
      {
        if ($this->getRequestParameter('idcurso'))
        {
          $idcurso = $this->getRequestParameter('idcurso');
          $this->curso = CursoPeer::retrieveByPk($idcurso);
        }
        else if ($this->getRequestParameter('idmodulo'))
        {
          $idmodulo = $this->getRequestParameter('idmodulo');
          $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
        }
        return sfView::ALERT;

      } else {
        if ($this->getRequestParameter('idcurso'))
        {
          $idcurso = $this->getRequestParameter('idcurso');
          $this->curso = CursoPeer::retrieveByPk($idcurso);
        }
        else if ($this->getRequestParameter('idmodulo'))
        {
          $idmodulo = $this->getRequestParameter('idmodulo');
          $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
        }

        $c = new Criteria();
        $paises = PaisPeer::doselect($c);

        $opcionesPais = array();
        foreach ($paises as $pais)
          $opcionesPais[$pais->getId()]= $pais->getNombre();

        $this->opcionesPais = $opcionesPais;

        $g = new Captcha();
        $this->getUser()->setAttribute('captcha', $g->generate());
      }
    }
  }

  /**
   * Manejador de Errores
   *
   */
	public function handleErrorMatricula()
	{
	  $idcurso = $this->getRequestParameter('idcurso');
    $this->curso = CursoPeer::retrieveByPk($idcurso);

    $c = new Criteria();
    $paises = PaisPeer::doselect($c);

    $opcionesPais = array();
    foreach ($paises as $pais)
      $opcionesPais[$pais->getId()]= htmlentities($pais->getNombre());

    $this->opcionesPais = $opcionesPais;

    $g = new Captcha();
    $this->getUser()->setAttribute('captcha', $g->generate());

	  return sfView::SUCCESS;
	}

	/**************************************
	 **** Confirmacion de inscripcion *****
	 *************************************/

	 public function executeConfirmacion() {
	   if ($this->getRequestParameter('idcurso'))
     {
	     $idref = $this->getRequestParameter('idcurso');
	     $curso = CursoPeer::retrieveByPk($idref);
	     $elem = 0;

	   } else if ($this->getRequestParameter('idmodulo'))
            {
      	     $idref = $this->getRequestParameter('idmodulo');
      	     $modulo = PaquetePeer::retrieveByPk($idref);
             $elem = 1;
      	   }

      if ($this->getRequestParameter('yaregistrado'))
      {
        $usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());
        $usuario->emailUsuario($idref,$elem,$tipo='alta');
        /*notificacion a administrador*/
        $con = Propel::getConnection();
        try
	      {
	         $con->begin();
	         $administradores= $this->getUser()->getAdministradores();
	         foreach ($administradores as $administrador)
	         {
    	         $notificacion = new Notificacion();
    					 $notificacion->setIdCurso(null);
    					 $notificacion->setIdUsuario($administrador->getId());
    					 $notificacion->setTitulo("Nueva matricula");
    					 if ($this->getRequestParameter('idcurso'))
               {
    					   $notificacion->setContenido("El usuario <b>".$usuario->getNombre()." ".$usuario->getApellidos()."</b> se ha matriculado en el curso <b>".$curso->getNombre()."</b> espere ha que realize el pago para darle de alta.");
    					 }else if ($this->getRequestParameter('idmodulo'))
                     {
                       $notificacion->setContenido("El usuario <b>".$usuario->getNombre()." ".$usuario->getApellidos()."</b> se ha matriculado en el modulo <b>".$modulo->getNombre()."</b> espere ha que realize el pago para darle de alta.");
                     }

    					 $notificacion->setFecha(date("Y-m-d"));
    					 $notificacion->setTipo(0); //nuevo curso
    					 $notificacion->save($con);
           }

           $con->commit();
        }
  			catch (Exception $e)
  				{	$con->rollback();
    				throw $e;
  				}
      }
   }
	//
  public function executeInvitados()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
	  {
      //$this->redirect('comercial/confirmacion?idmodulo='.$this->getRequestParameter('idmodulo'));
      $usuario = new Usuario();
      $usuario->nuevoInvitado(); // se genera Password y se le envia email
      return $this->renderText("<html><body><b>Su alta se ha procesado correctamente.<br /><br /> En breve se le enviar&aacute; un correo con los datos de acceso.</b></body></html>");
    } else {
      $c = new Criteria();
      $paises = PaisPeer::doselect($c);

      $opcionesPais = array();
      foreach ($paises as $pais)
        $opcionesPais[$pais->getId()] = $pais->getNombre();

      $this->opcionesPais = $opcionesPais;

      $g = new Captcha();
      $this->getUser()->setAttribute('captcha', $g->generate());

    }
  }
  //
  // Funcion auxiliar para el borrado del modulo setup
  //
  private function recursive_remove_directory($directory, $empty=FALSE)
  {
     // if the path has a slash at the end we remove it here
     if(substr($directory,-1) == '/')
     {
         $directory = substr($directory,0,-1);
     }
     // if the path is not valid or is not a directory ...
     if(!file_exists($directory) || !is_dir($directory))
     {
         // ... we return false and exit the function
         return FALSE;

     // ... if the path is not readable
     }elseif(!is_readable($directory))
     {
         // ... we return false and exit the function
         return FALSE;

     // ... else if the path is readable
     }else{

         // we open the directory
         $handle = opendir($directory);

         // and scan through the items inside
         while (FALSE !== ($item = readdir($handle)))
         {
             // if the filepointer is not the current directory
             // or the parent directory
             if($item != '.' && $item != '..')
             {
                 // we build the new path to delete
                 $path = $directory.'/'.$item;

                 // if the new path is a directory
                 if(is_dir($path))
                 {
                     // we call this function with the new path
                     $this->recursive_remove_directory($path);

                 // if the new path is a file
                 }else{
                     // we remove the file
                     unlink($path);
                 }
             }
         }
         // close the directory
         closedir($handle);

         // if the option to empty is not set to true
         if($empty == FALSE)
         {
             // try to delete the now empty directory
             if(!rmdir($directory))
             {
                 // return false if not possible
                 return FALSE;
             }
         }
         // return success
         return TRUE;
     }
  }

} // end class