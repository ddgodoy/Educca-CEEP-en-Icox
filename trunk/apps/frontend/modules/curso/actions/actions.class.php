<?php
/**
 * curso actions.
 *
 * @package    edoceo
 * @subpackage curso
 * @author     Jacobo Chaquet y Santiago Martinez de la Riva
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class cursoActions extends sfActions
{
  public function executeIndex()
  {
    $this->idcurso = $this->getRequestParameter('idcurso');

    $this->getUser()->comprobarPermiso($this->idcurso);
    
    $this->getUser()->setCursoMenu($this->idcurso);
	  $c = new Criteria();
	  $c->add(CursoPeer::ID, $this->idcurso);
	  $this->curso = CursoPeer::doSelectOne($c);
	  $this->forward404Unless($this->curso);

    $usuario = $this->getUser();

  	$this->rol = $usuario->obtenerCredenciales();
  	
  	if ($this->rol == 'alumno' || $this->rol == 'moroso') { // check fechas inicio/fin para acceder (if applicable)
	  	if ($this->curso->checkAccesoSegunFechasLimite($this->curso->getFechaInicio('Y-m-d'), $this->curso->getFechaFin('Y-m-d')) != 'si') {
		  	$this->redirect('alumno/index');
		  }
  	}   
  }

  public function executeList()
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(CursoPeer::ID);
    
    $this->cursos = CursoPeer::doSelect($c);
    $this->forward404Unless($this->cursos);
  }

   public function executeCalendario()
  {
      $this->cursos = $this->getUser()->getCursosAlumno();
      $this->hoy= date("Y/m/d") ;
  }

 public function validateDarAlta()
  {
    $pulsados = $this->getRequestParameter('pulsadosCursos');
    $pulsados += $this->getRequestParameter('pulsadosPaquetes');

    if ($pulsados==0)
    {
      $this->getRequest()->setError('curso', 'Debe indicar el/los curso/s o paquete/s ha matricularse');
      return false;
    }

    return true;
  }

  // Nombre del metodo: altaPaquete($idpaquete)
  // Añadida por: Jacobo Chaquet
  /* Descripcion: - metodo privado invocado desde executeDarAlta()
                  - da de alta a un usuario como alumno (tabla rel_usuario_rol_curso)
                  - comprueba que el usuario no estubiera dado de alta ya en el curso
                  - devuelve un array $result de arrays del tipo:
                  			$result[0] = [OK|ERROR]  indica si se ha realizado la insercion (ERROR = el usuario ya esta en ese curso)
                  			$result[1] = nombre del curso
                  			$result[2] = Nombre del rol, solo lo devuelve en caso de $result[0]==ERROR para saber su rol
   */

	private function altaPaquete($idpaquete)
	{
	        $paquete= PaquetePeer::retrieveByPk($idpaquete);
	        $cursos = $paquete->getRel_paquete_cursos();

	        $result = array();
	        $i=0;

	        foreach($cursos as $curso){
	            $result[$i] = self::altaCurso($curso->getCurso()->getId());
	          	$i++;
	        }
	        return $result;
   	}

	  // Nombre del metodo: altaCurso($idcurso)
	  // Añadida por: Jacobo Chaquet
	  /* Descripcion: - metodo privado invocado desde executeDarAlta() o altaPaquete
	                  - da de alta a un usuario como alumno (tabla rel_usuario_rol_curso)
	                  - comprueba que el usuario no estubiera dado de alta ya en el curso
	                  - devuelve un array $result
	                  			$result[0] = [OK|ERROR]  indica si se ha realizado la insercion (ERROR = el usuario ya esta en ese curso)
	                  			$result[1] = nombre del curso
	                  			$result[2] = Nombre del rol, solo lo devuelve en caso de $result[0]==ERROR para saber su rol
	   */

	private function altaCurso($idcurso)
	{
	     $c0 = new Criteria();
	     $c0->add(RolPeer::NOMBRE, "alumno");
	     $rol = RolPeer::doSelectOne($c0);
	     $rolID = $rol->getId();

			 $c = new Criteria();
	     $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getUser()->getAnyId());
	     $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $idcurso);
	     $handler = Rel_usuario_rol_cursoPeer::doSelectOne($c);
	     if (!$handler)
       { // nuevo en curso
	          $result[0] = "OK";
	     	    $c1 = new Criteria();
	     	    $c1->add(CursoPeer::ID, $idcurso );
	         	$curso = CursoPeer::doSelectOne($c1);
	         	$nombreCurso = strtoupper( $curso->getNombre() );
	          $result[1] = $nombreCurso ;

				    $Rel_usuario_rol_curso = new Rel_usuario_rol_curso();
				    $Rel_usuario_rol_curso->setIdUsuario($this->getUser()->getAnyId());
				    $Rel_usuario_rol_curso->setIdCurso($idcurso);
				    $Rel_usuario_rol_curso->setIdRol($rolID);
				    $Rel_usuario_rol_curso->save();
						return $result;
				         	}
			 else{  $result[0] = "ERROR";
			        $c1 = new Criteria();
	            $c1->add(CursoPeer::ID, $handler->getIdCurso() );
	            $curso = CursoPeer::doSelectOne($c1);
	            $result[1] = strtoupper( $curso->getNombre() );
	            $c2 = new Criteria();
	            $c2->add(RolPeer::ID, $handler->getIdRol());
	            $rol = RolPeer::doSelectOne($c2);
	             $result[2] = strtoupper( $rol->getNombre() );
	            return $result;
				   }
	}

	  // Nombre del metodo: executeDarAlta()
	  // Añadida por: Jacobo Chaquet
	  /* Descripcion: Viene de Ajax, recibe un form con una serie checkbox con el ID del curso
	     el form se valida solo con el metodo validateDarAlta()
	     Se comprobara que el usuario no este inscrito en alguno de los cursos seleccionados, si lo esta mostrara mensaje de error en la vista
	   */
	public function executeDarAlta()
	{
	  $esAjax = $this->getRequest()->isXmlHttpRequest();
	  if ($esAjax) {
	        $j=0;
	        $k=0;
	        $cursos=array();
	        $error=array();

	        $pulsados = $this->getRequestParameter('pulsadosCursos');
	        $total = $this->getRequestParameter('totalCursos');

	        for ( $i=0;$i<$total;$i++ )
  				{  $micurso = $this->getRequestParameter("cursos$i");
  				   if ( $micurso )
             {
  				        $result = self::altaCurso($micurso);
  				        if ($result[0]=="OK")
                  { //alta correcta
  				            $cursos[$j]= $result[1] ;
  				           	$j++;
  						        if ($j==$total) { break;}
  				        }
  				        else{ $error[$k]="No se ha podido matricular en el curso ".$result[1].". Ya estaba matriculado como ".$result[2];
  	                    $k++;
  						        }
  	          }
  				}
	        $pulsados = $this->getRequestParameter('pulsadosPaquetes');
	        $total = $this->getRequestParameter('totalPaquetes');

	         for ( $i=0;$i<$total;$i++ )
    				{  $miPaquete = $this->getRequestParameter("paquetes$i");
    				   if ( $miPaquete )
               {
        						 $c = new Criteria();
        	           $c->add(Rel_usuario_paquetePeer::ID_USUARIO, $this->getUser()->getAnyId());
        	           $c->add(Rel_usuario_paquetePeer::ID_PAQUETE, $miPaquete);
        	           $handler = Rel_usuario_rol_cursoPeer::doSelectOne($c);
        						 if (!$handler)
                     { //comprobamos que no este dado de alta en el paquete
        						 	 $resultados = self::altaPaquete($miPaquete);
        					     foreach($resultados as $result )
                       {
          			          if ($result[0]=="OK")
                          { //alta correcta
          					        $cursos[$j]= $result[1] ;
          					        $j++;
          				    	   }
          				        	  else{  $error[$k]="No se ha podido matricular en el curso ".$result[1].". Ya estaba matriculado como ".$result[2];
          				            	      $k++;
          	                       }
        	              }
        	              $Rel_usuario_paquete = new Rel_usuario_paquete();
        						    $Rel_usuario_paquete->setIdUsuario($this->getUser()->getAnyId());
        						    $Rel_usuario_paquete->setIdPaquete($miPaquete);

        						    if ( $Rel_usuario_paquete->save() )
                        {
          						     $paket= PaquetePeer::retrieveByPk($miPaquete);
          						  	 $cursos[$j]= "Dado de alta en el Paquete: ".$paket->getNombre() ;
          					       $j++;
        						     };
        				       }
        				       else {  $paket= PaquetePeer::retrieveByPk($miPaquete);
        					             $error[$k]="No se ha podido matricular en el Paquete ".$paket->getNombre().". Ya estaba matriculado";
        				               $k++;
        	                  }
               }
    				}
	      $this->cursos = $cursos ;
	      $this->errores = $error ;
	  		return ;
	    }
	}
	  // Nombre del metodo: executeInfoPaquete()
	  // Añadida por: Jacobo Chaquet
	  /* Descripcion: Muestrara la informacion de un paquete, se usa a la hora de matricularse
	   */
	public function executeInfoPaquete()
	{    $esAjax = $this->getRequest()->isXmlHttpRequest();
	     if ($esAjax) {
	        $id = $this->getRequestParameter('id');
	        $this->paquete = PaquetePeer::retrieveByPk($id);
	        $this->cursos = $this->paquete->getRel_paquete_cursos();
	     }

	}
	  // Nombre del metodo: executeInfoCurso()
	  // Añadida por: Jacobo Chaquet
	  /* Descripcion: Muestrara la informacion de un curso, se usa a la hora de matricularse
	   */
	public function executeInfoCurso()
	{    $esAjax = $this->getRequest()->isXmlHttpRequest();
	     if ($esAjax) {
	        $id = $this->getRequestParameter('id');
	        $this->curso = CursoPeer::retrieveByPk($id);
	     }

	}
	  // Nombre del metodo: executeCerrar()
	  // Añadida por: Jacobo Chaquet
	  /* Descripcion: Sirve para cerrar las capas ajax
	   */
	public function executeCerrar()
	{   return ;
	}
//
    private function traducir_de_fecha_scorm12 ($string)
    {
      $parametros = explode(':', $string);

      $horas = (int) $parametros[0];
      $minutos = (int) $parametros[1];
      $segundos = floor((int) $parametros[2]);

      $total = ($horas * 3600) + ($minutos * 60) + $segundos;
      return $total;
    }

    // Nombre del metodo: executeMostrarTemas()
    // Añadida por: Todor Blajev
    /* Descripcion: Accion para mostrar los temas correspondientes a la materia de un curso
     */
    public function executeMostrarTemas()
    {
       $this->idcurso = $this->getRequestParameter('idcurso');
       $this->getUser()->comprobarPermiso($this->idcurso);
       $this->is_alumno = $this->getUser()->hasCredential('alumno');

       $c = new Criteria();
       $c->add(CursoPeer::ID, $this->idcurso);
       $this->curso = CursoPeer::doSelectOne($c);

       $this->idmateria = $this->curso->getMateriaId();
       $this->nombrecurso = $this->curso->getNombre();


       $materia = MateriaPeer::retrieveByPk($this->idmateria);
       $this->forward404Unless($materia);

       $this->height = $materia->getHeight();
       $this->width = $materia->getWidth();
       if (!$this->height) { $this->height=580;}
       if (!$this->width) { $this->width=737;}
       $this->materia = $materia;
       $this->id_usuario = $this->getUser()->getAnyId();
       
       $array_book = $this->getBookAndLicense($this->id_usuario, $this->idcurso);
       
       $this->url_libro = NULL;
       
       if($array_book){
           $this->url_libro = $this->getUrlBlinkBook($array_book['book'],$array_book['license'], $array_book['type']); 
       }
    }
	//
	public function executeMostrarBibliografia()
  {
      $this->idcurso = $this->getRequestParameter('idcurso');

      $this->getUser()->comprobarPermiso($this->idcurso);

      $this->getUser()->setCursoMenu($this->idcurso);
  	  $c = new Criteria();
  	  $c->add(CursoPeer::ID, $this->idcurso);
  	  $this->curso = CursoPeer::doSelectOne($c);
  	  $this->forward404Unless($this->curso);
      //return $this->forward('curso', 'list');

      $usuario = $this->getUser();

  		$this->rol = $usuario->obtenerCredenciales();

     $this->idcurso = $this->getRequestParameter('idcurso');

     $c = new Criteria();
	   $c->add(CursoPeer::ID, $this->idcurso);
	   $this->curso = CursoPeer::doSelectOne($c);

	   $this->idmateria = $this->curso->getMateriaId();
	   $this->nombrecurso = $this->curso->getNombre();

     $c = new Criteria();
	   $c->add(LibroPeer::ID_MATERIA, $this->idmateria);
	   $this->libros = LibroPeer::doSelect($c);
           
     $this->usuario =  UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());       
  }

   // Nombre del metodo: NuevoLibro()
  // Añadida por: Santiago Martinez de la Riva
  // Modificada por: Jacobo Chaquet. Pasa hacer 2 acciones nuevoLibro y guardarLibro
  /* Descripcion: Genera la plantilla del nuevo libro
  				  Puede recibir parametros:
					  - idcurso y idalumno: si los recibe en su template no apareceran los select de estos // Nombre del metodo: GuardarLibro()
                      - Guarda un nuevo libro, que sera mostrado en la Bibliografia tanto de
                        alumnos como de profesores
   */

  public function executeNuevoLibro()
  {  $this->idcurso = $this->getRequestParameter('idcurso');

     if ($this->getRequest()->getMethod() == sfRequest::POST)
     {
        $c = new Criteria();
        $c->add(CursoPeer::ID, $this->idcurso);
        $this->curso = CursoPeer::doSelectOne($c);
        $this->forward404Unless($this->curso);

        //Se inserta el nuevo libro con los atributos correspondientes
       $libro = new Libro();
       $libro->setNombre($this->getRequestParameter('nombre'));
       $libro->setAutor($this->getRequestParameter('autor'));
       $libro->setEditorial($this->getRequestParameter('editorial'));
       $libro->setAnioPublicacion($this->getRequestParameter('publicacion'));
       $libro->setIsbn($this->getRequestParameter('isbn'));
       $libro->setIdMateria($this->curso->getMateriaId());
       $libro->save();
       //return $this->redirect('curso/mostrarBibliografia?idcurso='.$this->idcurso);

       $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
       return;
     }
     else{
            //$this->getUser()->setCursoMenu($this->idcurso);
  	        $c = new Criteria();
  	        $c->add(CursoPeer::ID, $this->idcurso);
  	        $this->curso = CursoPeer::doSelectOne($c);
  	        $this->forward404Unless($this->curso);
         }
  }
      // Nombre del metodo: executeEliminarLibro()
	  // Añadida por: Jacobo Chaquet
	  /* Descripcion: Elimina un libro de la bibliografia
	   */
  public function executeEliminarLibro() {
      $this->getUser()->comprobarPermiso($this->getUser()->getCursoMenu());

      $libro = LibroPeer::retrieveByPk($this->getRequestParameter('idlibro'));
      $this->forward404Unless($libro);
      $libro->delete();
      return $this->redirect('curso/mostrarBibliografia?idcurso='.$this->getUser()->getCursoMenu());
  }

   // Nombre del metodo: executeModificarLibro()
   // Añadida por: Jacobo Chaquet
  /* Descripcion: Modifica un libro de la bibliografia.
   */
  public function executeModificarLibro()
  {
      $this->getUser()->comprobarPermiso($this->getUser()->getCursoMenu());
	    $this->libro = LibroPeer::retrieveByPk($this->getRequestParameter('idlibro'));
	    $this->forward404Unless($this->libro);

	     if ($this->getRequest()->getMethod() == sfRequest::POST)
       {
	      $con = Propel::getConnection();
  			try
  				{
    	       		$con->begin();
                $this->libro->setNombre($this->getRequestParameter('nombre'));
                $this->libro->setAutor($this->getRequestParameter('autor'));
                $this->libro->setEditorial($this->getRequestParameter('editorial'));
                $this->libro->setAnioPublicacion($this->getRequestParameter('publicacion'));
                $this->libro->setIsbn($this->getRequestParameter('isbn'));
                $this->libro->save($con);
    			      $con->commit();
          }
  			catch (Exception $e)
  				{	$con->rollback();
    				throw $e;
  				}
        $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
        return;
      } else { return;      }
  }

    // Nombre del metodo: executeMostrarBibliografia()
	  // Añadida por: Todor Todorov Blajev
	  /* Descripcion: Accion que saca la informacion y normativa de un curso.
	   */
	public function executeMostrarNormativa()
  {
	    $id = $this->getRequestParameter('idcurso');
      $this->getUser()->comprobarPermiso($id);

      $this->getUser()->setCursoMenu($id);
	    $this->curso = CursoPeer::retrieveByPk($id);
  	  $this->forward404Unless($this->curso);

      $usuario = $this->getUser();
  		$this->rol = $usuario->obtenerCredenciales();
      $this->idcurso = $this->getRequestParameter('idcurso');
  }

  public function executeModificarNormativa()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
          $idcurso = $this->getRequestParameter('idcurso');

          $curso = CursoPeer::retrieveByPk($idcurso);

          $idmateria = $curso -> getMateria()->getId();

          $con = Propel::getConnection();

    			$c1 = new Criteria();
    			$c1->add(CursoPeer::ID, $idcurso );

    			$c2 = new Criteria();
    			$c2->add(CursoPeer::INFORMACION_EXTENDIDA, $this->getRequestParameter('infoextendida'));

	        BasePeer::doUpdate($c1, $c2, $con);

	        $c3 = new Criteria();
    			$c3->add(MateriaPeer::ID, $idmateria );

    			$c4 = new Criteria();
    			$c4->add(MateriaPeer::NORMATIVA, $this->getRequestParameter('normativa'));
    			$c4->add(MateriaPeer::INFORMACION, $this->getRequestParameter('info'));

	        BasePeer::doUpdate($c3, $c4, $con);

	        return $this->redirect('curso/mostrarNormativa?idcurso='.$idcurso);

	  } else {
        	    $id = $this->getRequestParameter('idcurso');

              $this->getUser()->comprobarPermiso($id);

              $this->getUser()->setCursoMenu($id);
        	    $this->curso = CursoPeer::retrieveByPk($id);
          	  $this->forward404Unless($this->curso);

              $usuario = $this->getUser();

              $curso = $this->curso;

          		$this->rol = $usuario->obtenerCredenciales();

              $this->idcurso = $this->getRequestParameter('idcurso');

              $this->info = $curso->getMateria()->getInformacion();

              $this->infoextendida = $curso->getInformacionExtendida();

              $this->normativa = $curso->getMateria()->getNormativa();
          }
  }

  // Nombre del metodo: executeMostrarContenido()
  // Añadida por: Angel Martin Latasa
  /* Descripcion: Muestra el contenido de un curso SCORM
  */
  public function executeMostrarContenido()
  {
    $this->setLayout('scormBrowser');

    $user = $this->getUser();
    $id_usuario = $user->getAnyId();

    if ($this->hasRequestParameter('id'))
    {
      $id_materia = $this->getRequestParameter('id');
      $materia = MateriaPeer::RetrieveByPk($id_materia);

      if ($materia)
      {
        if ($materia->getTipo() == 'compo')
        {
         $c = new Criteria;
         $c->add(Sco12Peer::ID_MATERIA, $materia->getId());
         $sco12 = Sco12Peer::DoSelectOne($c);
         $id_sco12 = $sco12->getId();

         $c = new Criteria();
         $c->add(Rel_usuario_sco12Peer::ID_SCO12, $id_sco12);
         $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $id_usuario);
         $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
        }
        else   {   return;     }
      }
      else   {   return;     }
    }

    if ($this->hasRequestParameter('sco12id'))
    {
      $id_sco12 = $this->getRequestParameter('sco12id');
      $this->sco = $id_sco12;
      $this->curso_id = $this->getRequestParameter('id_curso');
      $sco12 = Sco12Peer::RetrieveByPk($id_sco12);

      $id_materia = $sco12->getIdMateria();
      $materia = MateriaPeer::RetrieveByPk($id_materia);
      $c = new Criteria();
      $c->add(Rel_usuario_sco12Peer::ID_SCO12, $id_sco12);
      $c->add(Rel_usuario_sco12Peer::ID_USUARIO, $id_usuario);
      $rel = Rel_usuario_sco12Peer::DoSelectOne($c);
    }
    if (!$rel)
    {
      $rel = new Rel_usuario_sco12();
      $rel->setIdUsuario($id_usuario);
      $rel->setIdSco12($id_sco12);
      $rel->setLessonLocation('');
      $rel->setCredit('credit');
      $rel->setLessonStatus('not attempted');
      $rel->setEntry('ab-initio');
      $rel->setScoreRaw('');
      $rel->setScoreMax('');
      $rel->setScoreMin('');
      $rel->setTotalTime('00:00:00');
      $rel->setLessonMode('normal');
      $rel->setSuspendData('');
      $rel->setComments('');
      $rel->setCommentsFromLms('');
      $rel->setPreferenceAudio('0');
      $rel->setPreferenceLanguage('');
      $rel->setPreferenceSpeed('0');
      $rel->setPreferenceText('0');
      $rel->save();
    }
    else
    {
      $tiempo_total = $rel->getTotalTime();
      $ultima_sesion = $rel->getSessionTime();
      if ($ultima_sesion)
      {
        $parametros1 = explode(':', $tiempo_total);
        $parametros2 = explode(':', $ultima_sesion);

        $secs = ((int) $parametros1[2]) + ((int) $parametros2[2]);
        $acarreo = floor($secs / 60);
        $secs = $secs % 60;

        $mins = ((int) $parametros1[1]) + ((int) $parametros2[1]) + $acarreo;
        $acarreo = floor($mins / 60);
        $mins = $mins % 60;

        $horas = ((int) $parametros1[0]) + ((int) $parametros2[0]) + $acarreo;

        if ($horas < 100) {$resultado = sprintf("%02d:%02d:%02d", $horas, $mins, $secs);}
        else {$resultado = sprintf("%04d:%02d:%02d", $horas, $mins, $secs);}

        $rel->setSessionTime('');
        $rel->setTotalTime($resultado);
        $rel->save();
      }
    }
    //$ruta =  SF_ROOT_DIR.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'materias'.DIRECTORY_SEPARATOR.$id_materia.DIRECTORY_SEPARATOR.$sco12->getFile();

    $cmi = new CMI($id_usuario, $id_sco12);
    $user->setAttribute('objeto_cmi', $cmi);

    $file = $sco12->getFile();
    
    /*if (strpos($file, '/') !== false && $id_materia == 74) {
    	$auxi = explode('/', $file);
    	$last = count($auxi) - 1;
    	$file = $auxi[$last];
    }*/
    
    $ruta = '/materias/'.$id_materia.'/'.$file;
    
    if($this->hasRequestParameter('ruta')){
        $ruta = urldecode($this->getRequestParameter('ruta'));
    }
    
    $this->ruta   = $ruta;
    $this->width  = $materia->getWidth();
    $this->height = $materia->getHeight();
  }
  
  /*
   * getUrlBlinkBook
   * @books string
   * @license string
   * @return url
   */
  private function getUrlBlinkBook($books, $license, $type){
            
          $usuario = UsuarioPeer::retrieveByPk($this->getUser()->getAnyId());  
          
          /*echo '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sso="http://www.blinklearning.com/sso/">
                                <soapenv:Header>
                                        <sso:WSEAuthenticateHeader>
                                                <sso:User>nhY66IdY</sso:User>
                                                <sso:Password>GRfBp6Gq</sso:Password>
                                        </sso:WSEAuthenticateHeader>
                                </soapenv:Header>
                                <soapenv:Body>
                                        <sso:RequestAccess>
                                                <sso:Id>'.$usuario->getId().'</sso:Id>
                                                <sso:Name>'.$usuario->getNombre().'</sso:Name>
                                                <sso:Surname>'.$usuario->getApellidos().'</sso:Surname>
                                                <sso:Email>'.$usuario->getEmail().'</sso:Email>
                                                <sso:Books>
                                                        <sso:Book>'.$books.'</sso:Book>
                                                </sso:Books>
                                                <sso:Licenses>
                                                        <sso:License>'.$license.'</sso:License>
                                                </sso:Licenses>
                                                <sso:OperationCode>viewbook</sso:OperationCode>
                                                <sso:ActivityId>'.$books.'</sso:ActivityId>
                                                <sso:UserType>'.$type.'</sso:UserType>
                                        </sso:RequestAccess>
                                </soapenv:Body>
                        </soapenv:Envelope>'; */
          
          $curl = curl_init();

          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.blinklearning.com/ws/WsSSO/wsSSO.php",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:sso="http://www.blinklearning.com/sso/">
                                <soapenv:Header>
                                        <sso:WSEAuthenticateHeader>
                                                <sso:User>nhY66IdY</sso:User>
                                                <sso:Password>GRfBp6Gq</sso:Password>
                                        </sso:WSEAuthenticateHeader>
                                </soapenv:Header>
                                <soapenv:Body>
                                        <sso:RequestAccess>
                                                <sso:Id>'.$usuario->getId().'</sso:Id>
                                                <sso:Name>'.$usuario->getNombre().'</sso:Name>
                                                <sso:Surname>'.$usuario->getApellidos().'</sso:Surname>
                                                <sso:Email>'.$usuario->getEmail().'</sso:Email>
                                                <sso:Books>
                                                        <sso:Book>'.$books.'</sso:Book>
                                                </sso:Books>
                                                <sso:Licenses>
                                                        <sso:License>'.$license.'</sso:License>
                                                </sso:Licenses>
                                                <sso:OperationCode>viewbook</sso:OperationCode>
                                                <sso:ActivityId>'.$books.'</sso:ActivityId>
                                                <sso:UserType>'.$type.'</sso:UserType>
                                        </sso:RequestAccess>
                                </soapenv:Body>
                        </soapenv:Envelope>',
          CURLOPT_HTTPHEADER => array(
            "accept-encoding: gzip,deflate",
            "cache-control: no-cache",
            "content-type: text/xml;charset=UTF-8",
            "host: blinkwpre.blinklearning.com",
            "soapaction: https://www.blinklearning.com/sso/RequestAccess"
          ),
        ));

        $response = curl_exec($curl);
        
       /* echo $response;
        exit();*/
        
        $err = curl_error($curl);

        curl_close($curl);

        $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:', 'ns1:', 'soap-env:envelope:'], '', $response);
        $xml = simplexml_load_string($clean_xml);
            
        return $xml->Body->RequestAccessResponse->RequestAccessResult->URL;
  } 
  
  /**
   * 
   * @param int $id_user
   * @param int $id_curso
   * @return array
   */
  private function getBookAndLicense($id_user, $id_curso){
      
      $array_return = array(197=>array(562=>array('book'=>'9788448612191', 'license'=>'RUJ62M39', 'type'=>'T'),
                                       634=>array('book'=>'9788448612191', 'license'=>'S36XSAQ9', 'type'=>'T'), 
                                       635=>array('book'=>'9788448612191', 'license'=>'DYJVCN39', 'type'=>'S'),
                                       638=>array('book'=>'9788448612191', 'license'=>'N7J2XJ49', 'type'=>'S')),
          
          
          
                            198=>array(562=>array('book'=>'9788448612092', 'license'=>'G6B2QWB9', 'type'=>'T'),
                                       634=>array('book'=>'9788448612092', 'license'=>'J8YKXKJ9', 'type'=>'T'), 
                                       635=>array('book'=>'9788448612092', 'license'=>'73R9ST59', 'type'=>'S'),
                                       638=>array('book'=>'9788448612092', 'license'=>'ULS2JPV9', 'type'=>'S')),
          
          
          
                            199=>array(562=>array('book'=>'9788448609665', 'license'=>'XRZCGFH9', 'type'=>'T'),
                                       634=>array('book'=>'9788448609665', 'license'=>'VV7LHLD9', 'type'=>'T'), 
                                       635=>array('book'=>'9788448609665', 'license'=>'BSJMAMQ9', 'type'=>'S'),
                                       638=>array('book'=>'9788448609665', 'license'=>'6C389ZT9', 'type'=>'S')),
          
          
          
                            200=>array(562=>array('book'=>'9788448612030', 'license'=>'G386SXA9', 'type'=>'T'),
                                       634=>array('book'=>'9788448612030', 'license'=>'DDUAN5K9', 'type'=>'T'), 
                                       635=>array('book'=>'9788448612030', 'license'=>'L96UPW99', 'type'=>'S'),
                                       638=>array('book'=>'9788448612030', 'license'=>'61KH23F9', 'type'=>'S')),
          
          
          
                            201=>array(562=>array('book'=>'9788448612054', 'license'=>'4LALG1A9', 'type'=>'T'),
                                       634=>array('book'=>'9788448612054', 'license'=>'MRL23HV9', 'type'=>'T'),
                                       635=>array('book'=>'9788448612054', 'license'=>'UHM9L959', 'type'=>'S'),
                                       638=>array('book'=>'9788448612054', 'license'=>'XPKSKVC9', 'type'=>'S')),
          
          
                            202=>array(562=>array('book'=>'9788448611996', 'license'=>'MB4Q41B9', 'type'=>'T'),
                                       634=>array('book'=>'9788448611996', 'license'=>'5K8N7VX9', 'type'=>'T'),
                                       635=>array('book'=>'9788448611996', 'license'=>'J4U2Q6X10','type'=>'S'),
                                       638=>array('book'=>'9788448611996', 'license'=>'VPLWJGK10','type'=>'S')), 
          
          
          
                            203=>array(562=>array('book'=>'9788448608569', 'license'=>'7DTV1Z69', 'type'=>'T'),
                                       634=>array('book'=>'9788448608569', 'license'=>'FWNTF889', 'type'=>'T'),
                                       635=>array('book'=>'9788448608569', 'license'=>'UEH9EV59', 'type'=>'S'),
                                       638=>array('book'=>'9788448608569', 'license'=>'Q2PEJX69', 'type'=>'S')),
                            
          
                            207=>array(562=>array('book'=>'9788448609740', 'license'=>'ZZQVJRN9', 'type'=>'T'),
                                       636=>array('book'=>'9788448609740', 'license'=>'S78GHYE9', 'type'=>'T'),
                                       639=>array('book'=>'9788448609740', 'license'=>'JR7T75S9', 'type'=>'S'),
                                       640=>array('book'=>'9788448609740', 'license'=>'FHEHW719', 'type'=>'S')),
          
          
                            208=>array(562=>array('book'=>'9788448609702', 'license'=>'LLCKZZ99', 'type'=>'T'),
                                       636=>array('book'=>'9788448609702', 'license'=>'GMEJZUA9', 'type'=>'T'),
                                       639=>array('book'=>'9788448609702', 'license'=>'895BQK69', 'type'=>'S'),
                                       640=>array('book'=>'9788448609702', 'license'=>'5QU3MPT9', 'type'=>'S')),
          
          
                            209=>array(562=>array('book'=>'9788448187354', 'license'=>'5MR8PCH9', 'type'=>'T'),
                                       636=>array('book'=>'9788448187354', 'license'=>'2NKNKPX9', 'type'=>'T'),
                                       639=>array('book'=>'9788448187354', 'license'=>'4TWWTQY9', 'type'=>'S'),
                                       640=>array('book'=>'9788448187354', 'license'=>'Z43H3RW9', 'type'=>'S')),   
          
          
                            210=>array(562=>array('book'=>'9788448191917', 'license'=>'LZVQ54T9', 'type'=>'T'),
                                       636=>array('book'=>'9788448191917', 'license'=>'EGX5ML89', 'type'=>'T'),
                                       639=>array('book'=>'9788448191917', 'license'=>'1A4SZZX9', 'type'=>'S'),
                                       640=>array('book'=>'9788448191917', 'license'=>'G2ASHXU9', 'type'=>'S')),
          
          
                            211=>array(562=>array('book'=>'9788448609689', 'license'=>'4YAF8569', 'type'=>'T'),
                                       636=>array('book'=>'9788448609689', 'license'=>'M5JPNJL9', 'type'=>'T'),
                                       639=>array('book'=>'9788448609689', 'license'=>'Z3TRPXK9', 'type'=>'S'),
                                       640=>array('book'=>'9788448609689', 'license'=>'LFYX6R19', 'type'=>'S')),  
          
                            
                            212=>array(562=>array('book'=>'9788448609726', 'license'=>'Q6LFAB39', 'type'=>'T'),
                                       636=>array('book'=>'9788448609726', 'license'=>'XTYFHQF9', 'type'=>'T'),
                                       639=>array('book'=>'9788448609726', 'license'=>'MWUFN2X9', 'type'=>'S'),
                                       640=>array('book'=>'9788448609726', 'license'=>'JUEYPPG9', 'type'=>'S')),           
      );
      
      return !empty($array_return[$id_curso][$id_user])?$array_return[$id_curso][$id_user]:false;
  }

} // end class