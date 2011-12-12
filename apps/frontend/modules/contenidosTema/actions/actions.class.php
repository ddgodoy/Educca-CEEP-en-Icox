<?php

/**
 * contenidosTema actions.
 *
 * @package    edoceo
 * @subpackage contenidosTema
 * @author     Jacobo
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class contenidosTemaActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }

  public function executeVerFichero()
  {   /* obtiene el nombre del fichero en id, y lo abre en una nueva ventana con un layout distinto al principal definido
         en view.yml en config
       */
	  $this->setLayout('temaPopUp');
    $idmateria = $this->getRequestParameter('idmateria');
    $materia = MateriaPeer::retrieveByPk($idmateria);
    $this->forward404Unless($materia);

   $this->getUser()->setAttribute('materia', $idmateria);

    $idtema = $this->getRequestParameter('id');
    $tema = TemaPeer::retrieveByPk($idtema);
    $this->forward404Unless($tema);

    if (!$materia->matriculadoUsuario($this->getUser()->getAnyId()))
    {
     	$this->redirect('login/logout');
    }
    $this->materia=$materia;
    $this->tema=$tema;

		 $_SESSION['materia'.$idmateria]=  'OK';//session_id(); //SID;
  }

  protected function partialExists($context, $name)
  {
      $directory = $context->getModuleDirectory();
      if (is_readable($directory . DIRECTORY_SEPARATOR ."templates". DIRECTORY_SEPARATOR ."_". $name .".php"))
      {
         return true;
      } else {    return false;      }
   }


  // Nombre del método: executeControlTiempo()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Controla el tiempo que un usuario esta en un tema, funciona mediante ajax
   */
  public function executeControlTiempo()
  {
    /*posible estados*/
    //  0 = no iniciado
    //  1 = inciado
    //  2 = finalizado
    $esAjax = $this->getRequest()->isXmlHttpRequest();

    if ($esAjax)
    {
        $idtema = $this->getRequestParameter('idtema');   //id tiene el id de materia y tema concatenado cn el nombre del fichero
        if ($this->getUser()->hasCredential('alumno'))
         {
            $c = new Criteria();
				    $c->add(Rel_usuario_temaPeer::ID_TEMA, $idtema);
				    $c->add(Rel_usuario_temaPeer::ID_USUARIO, $this->getUser()->getAnyId());
				    $RelTiempos = Rel_usuario_temaPeer::doSelectOne($c);
				    if ($RelTiempos)
				 	  {
               $RelTiempos->setTiempo($RelTiempos->getTiempo() + 30);  /* incrementamos el tiempo segun sean el intervalo de
                                            															peticiones ajax (valor definido en el fichero verFicheroSuccess
																			                                    en la funcion periodically_call_remote en el parametro frecuency
																			                                    que esta en segundos)			 															*/
				 	      if (0==$RelTiempos->getEstado())
                {
				 				   $RelTiempos->setEstado(1);
						    }
				    }
				    else{  $RelTiempos = new Rel_usuario_tema();              /* Si es la primera vez que pincha que se cree la relacion en la BD*/
				           $RelTiempos->setIdUsuario($this->getUser()->getAnyId());
						       $RelTiempos->setIdTema($idtema);
						       $RelTiempos->setTiempo(0);
						       $RelTiempos->setEstado(1);
				        }
				$RelTiempos->save();
	    }
   }
   return sfView::NONE;
  }

  // Nombre del método: executeInitialize()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Cuando un usuario se introduce en ese tema por primera vez guardamos la fecha
   */
  public function executeInitialize()
  {
         if ($this->getUser()->hasCredential('alumno'))
         {   $idtema = $this->getRequestParameter('idtema');

    			   $c = new Criteria();
				     $c->add(Rel_usuario_temaPeer::ID_TEMA, $idtema);
				     $c->add(Rel_usuario_temaPeer::ID_USUARIO, $this->getUser()->getAnyId());
				     $RelTiempos = Rel_usuario_temaPeer::doSelectOne($c);
				     if ($RelTiempos)
				 	   {
               if (0==$RelTiempos->getEstado())
               {
				 			 	 $RelTiempos->setEstado(1);
				 				 $RelTiempos->setFechaInicio(date("Y-m-d"));
						   }
				     }
				     else{  $RelTiempos = new Rel_usuario_tema();              /* Si es la primera vez que pincha que se cree la relacion en la BD*/
				            $RelTiempos->setIdUsuario($this->getUser()->getAnyId());
						        $RelTiempos->setIdTema($idtema);
						        $RelTiempos->setTiempo(0);
						        $RelTiempos->setEstado(1);
						        $RelTiempos->setFechaInicio(date("Y-m-d"));
				         }
				 $RelTiempos->save();
	      }
   return sfView::NONE;
 }

  // Nombre del método: executeFinish()
  // Añadida por: Jacobo Chaquet
  /* Descripción: Cuando un usuario finaliza tema guardamos la fecha
   */
  public function executeFinish()
  {
        $id = $this->getRequestParameter('id');   //id tiene el id de materia y tema concatenado cn el nombre del fichero

         if ($this->getUser()->hasCredential('alumno'))
         {
           $idtema = $this->getRequestParameter('idtema');
    			 $c = new Criteria();
  				 $c->add(Rel_usuario_temaPeer::ID_TEMA, $idtema);
  				 $c->add(Rel_usuario_temaPeer::ID_USUARIO, $this->getUser()->getAnyId());
  				 $RelTiempos = Rel_usuario_temaPeer::doSelectOne($c);
  				 if ($RelTiempos)
  				 { if (2!=$RelTiempos->getEstado())
             {
  				 				$RelTiempos->setEstado(2);
  				 				$RelTiempos->setFechaCompletado(date("Y-m-d"));
  					 }
  				 }
				   else{  $RelTiempos = new Rel_usuario_tema();              /* Si es la primera vez que pincha que se cree la relacion en la BD*/
				          $RelTiempos->setIdUsuario($this->getUser()->getAnyId());
						      $RelTiempos->setIdTema($idtema);
						      $RelTiempos->setTiempo(0);
						      $RelTiempos->setEstado(2);
						      $RelTiempos->setFechaInicio(date("Y-m-d"));
						      $RelTiempos->setFechaCompletado(date("Y-m-d"));
				       }
				   $RelTiempos->save();
	       }
   return sfView::NONE;
 }

 
}
