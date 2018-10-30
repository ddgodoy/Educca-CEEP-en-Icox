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

      //Consulta fecha primer y ultima conexion al curso
       /*$c = new Criteria();
       $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getUser()->getAnyId());
       $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->idcurso);
       $handler = Rel_usuario_rol_cursoPeer::doSelectOne($c);
       $fechaPrimerConex = $handler->getFechaPrimerConex();
       $fechaUltimaConex = $handler->getFechaUltimaConex();
       $hoy = date("Y-m-d H:i:s");

       if ($handler)
            {
              if($fechaPrimerConex == NULL && $fechaUltimaConex == NULL){

                $fechaPrimerConex = $hoy;
                $fechaUltimaConex = $hoy;

              }elseif ($fechaPrimerConex=! NULL) {
                # code...
                $fechaPrimerConex = $handler->getFechaPrimerConex();
                $fechaUltimaConex = $hoy;                
              }
            }

            //actualizar fecha primer y ultima conexion al curso
            $con = Propel::getConnection();
            $c1 = new Criteria();
            $c1->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $this->getUser()->getAnyId());
            $c1->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $this->idcurso);

            $c2 = new Criteria();
            $c2->add(Rel_usuario_rol_cursoPeer::FECHA_PRIMER_CONEX, $fechaPrimerConex);
            $c2->add(Rel_usuario_rol_cursoPeer::FECHA_ULTIMA_CONEX, $fechaUltimaConex);
            BasePeer::doUpdate($c1, $c2, $con);

       $this-> fecha_primer_conex = $fechaPrimerConex;
       $this-> fecha_ultima_conex = $fechaUltimaConex;*/
//FIN DE MI CAMBIO RK



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
    $this->true_iframe = FALSE;

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
      $this->id_tema = $this->getRequestParameter('id_tema');
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
        $this->ruta_false = $ruta;
        $ruta = urldecode($this->getRequestParameter('ruta'));
        $this->true_iframe = true;
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
          CURLOPT_URL => "http://www.blinklearning.com/ws/WsSSO/wsSSO.php",
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
            "soapaction: http://www.blinklearning.com/sso/RequestAccess"
          ),
        ));

        $response = curl_exec($curl);
        
        /*echo $response;
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
      
      $array_return = array(
                            /*TECNICO CUIDADOS AUXILIARES ENFERMERIA*/    
                            197=>array(562=>array('book'=>'9788448612191', 'license'=>'RUJ62M39', 'type'=>'T'),
                                       634=>array('book'=>'9788448612191', 'license'=>'SU4WB4A9', 'type'=>'T'), 
                                       635=>array('book'=>'9788448612191', 'license'=>'DYJVCN39', 'type'=>'S'),
                                       638=>array('book'=>'9788448612191', 'license'=>'N7J2XJ49', 'type'=>'S')),
          
          
          
                            198=>array(562=>array('book'=>'9788448612092', 'license'=>'G6B2QWB9', 'type'=>'T'),
                                       634=>array('book'=>'9788448612092', 'license'=>'4ZFT7MS9', 'type'=>'T'), 
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
                            
                            /*1º T. S. EN ADMINISTRACIÓN Y FINANZAS*/           
                            207=>array(562=>array('book'=>'9788448609740', 'license'=>'ZZQVJRN9', 'type'=>'T'),
                                       636=>array('book'=>'9788448609740', 'license'=>'65U3EFU9', 'type'=>'T'),
                                       639=>array('book'=>'9788448609740', 'license'=>'JR7T75S9', 'type'=>'S'),
                                       640=>array('book'=>'9788448609740', 'license'=>'FHEHW719', 'type'=>'S')),
          
          
                            208=>array(562=>array('book'=>'9788448609702', 'license'=>'LLCKZZ99', 'type'=>'T'),
                                       636=>array('book'=>'9788448609702', 'license'=>'GMEJZUA9', 'type'=>'T'),
                                       639=>array('book'=>'9788448609702', 'license'=>'895BQK69', 'type'=>'S'),
                                       640=>array('book'=>'9788448609702', 'license'=>'5QU3MPT9', 'type'=>'S')),
          
          
                            209=>array(562=>array('book'=>'9788448187354', 'license'=>'5MR8PCH9', 'type'=>'T'),
                                       636=>array('book'=>'9788448187354', 'license'=>'2NKNKPX9', 'type'=>'T'),
                                       639=>array('book'=>'9788448187354', 'license'=>'4TWWTQY9', 'type'=>'S'),
                                       640=>array('book'=>'9788448187354', 'license'=>'Z43H3RW9', 'type'=>'S'),),   
          
          
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
                                       639=>array('book'=>'9788448609726', 'license'=>'NAC8XQM9', 'type'=>'S'),
                                       640=>array('book'=>'9788448609726', 'license'=>'JUEYPPG9', 'type'=>'S')),  
          
                            /*2º T. S. EN ADMINISTRACIÓN Y FINANZAS*/           
                            213=>array(562=>array('book'=>'9788448612252', 'license'=>'7G1Q8V99', 'type'=>'T'),
                                       637=>array('book'=>'9788448612252', 'license'=>'P4U9V869', 'type'=>'T'),
                                       641=>array('book'=>'9788448612252', 'license'=>'8RJFEPS9', 'type'=>'S'),
                                       642=>array('book'=>'9788448612252', 'license'=>'JMWXXN79', 'type'=>'S')),
          
          
                            214=>array(562=>array('book'=>'9788448612078', 'license'=>'CB11B8M9', 'type'=>'T'),
                                       637=>array('book'=>'9788448612078', 'license'=>'85USL9Z9', 'type'=>'T'),
                                       641=>array('book'=>'9788448612078', 'license'=>'VZRYZKA9', 'type'=>'S'),
                                       642=>array('book'=>'9788448612078', 'license'=>'DSUJAZP9', 'type'=>'S')), 
          
          
                            215=>array(562=>array('book'=>'9788448612153', 'license'=>'4SJL7CJ9', 'type'=>'T'),
                                       637=>array('book'=>'9788448612153', 'license'=>'V1TY66S9', 'type'=>'T'),
                                       641=>array('book'=>'9788448612153', 'license'=>'WLQVEE39', 'type'=>'S'),
                                       642=>array('book'=>'9788448612153', 'license'=>'U1DHEY69', 'type'=>'S')),
          
          
                            216=>array(562=>array('book'=>'9788448612238', 'license'=>'W11WZUC9', 'type'=>'T'),
                                       637=>array('book'=>'9788448612238', 'license'=>'MQDRNEV9', 'type'=>'T'),
                                       641=>array('book'=>'9788448612238', 'license'=>'G35VH929', 'type'=>'S'),
                                       642=>array('book'=>'9788448612238', 'license'=>'R96XK229', 'type'=>'S')), 
          
                            
                            217=>array(562=>array('book'=>'9788448194468', 'license'=>'JBNU9PK9', 'type'=>'T'),
                                       637=>array('book'=>'9788448194468', 'license'=>'YMFQN789', 'type'=>'T'),
                                       641=>array('book'=>'9788448194468', 'license'=>'UGSMBKB9', 'type'=>'S'),
                                       642=>array('book'=>'9788448194468', 'license'=>'ME1YT8T9', 'type'=>'S')),   
          
          
                            218=>array(562=>array('book'=>'9788448611972', 'license'=>'CXDF5RP9', 'type'=>'T'),
                                       637=>array('book'=>'9788448611972', 'license'=>'35SRVUN9', 'type'=>'T'),
                                       641=>array('book'=>'9788448611972', 'license'=>'Z1L6UN79', 'type'=>'S'),
                                       642=>array('book'=>'9788448611972', 'license'=>'T6FK68Z9', 'type'=>'S')),

                            // region Administración y Finanzas
                            //
                            //Comunicación y atención al cliente
                            220=>array(45=>array('book'=>'9788448609740', 'license'=>'GYQS51710', 'type'=>'T'),
                                      636=>array('book'=>'9788448609740', 'license'=>'PYSE5QT6', 'type'=>'T'),
                                      663=>array('book'=>'9788448609740', 'license'=>'Y7HC38H6', 'type'=>'S'),
                                      664=>array('book'=>'9788448609740', 'license'=>'C3F6KY56', 'type'=>'S'),
                                      665=>array('book'=>'9788448609740', 'license'=>'G3Y9FF56', 'type'=>'S'),
                                      666=>array('book'=>'9788448609740', 'license'=>'JHWF5T66', 'type'=>'S'),
                                      667=>array('book'=>'9788448609740', 'license'=>'ZVJ8KRH6', 'type'=>'S'),  
                                      668=>array('book'=>'9788448609740', 'license'=>'SFYGMP46', 'type'=>'S'),
                                      
                                      693=>array('book'=>'9788448609740', 'license'=>'Q9GK5E16', 'type'=>'S'),
                                      694=>array('book'=>'9788448609740', 'license'=>'HTYL62Z6', 'type'=>'S'),  
                                      699=>array('book'=>'9788448609740', 'license'=>'GW6GJA56', 'type'=>'S'),
                                      702=>array('book'=>'9788448609740', 'license'=>'44Q1AAC6', 'type'=>'S'),
                                ),
          
                            //apoyo Comunicación y atención al cliente
                            234=>array(
                                      687=>array('book'=>'9788448609740', 'license'=>'ZMUBTWQ6', 'type'=>'S'),  
                                      688=>array('book'=>'9788448609740', 'license'=>'KCP2EM66', 'type'=>'S'),
                                      689=>array('book'=>'9788448609740', 'license'=>'VUA6EXX6', 'type'=>'S'),
                                ),
          
                            //Gestión de la documentación jurídica y empresarial. GS.          
                            221=>array(626=>array('book'=>'9788448609702', 'license'=>'1ZDHC2D10', 'type'=>'T'),
                                       636=>array('book'=>'9788448609702', 'license'=>'54K9W7N6', 'type'=>'T'),
                                       663=>array('book'=>'9788448609702', 'license'=>'M7YANDH6', 'type'=>'S'),
                                       664=>array('book'=>'9788448609702', 'license'=>'BQ5CY576', 'type'=>'S'),
                                       665=>array('book'=>'9788448609702', 'license'=>'B8SV83C6', 'type'=>'S'),
                                       666=>array('book'=>'9788448609702', 'license'=>'DPFGPWG6', 'type'=>'S'),
                                       667=>array('book'=>'9788448609702', 'license'=>'J8ZRFH56', 'type'=>'S'),  
                                       668=>array('book'=>'9788448609702', 'license'=>'GS4NJCB6', 'type'=>'S'),
                                
                                       693=>array('book'=>'9788448609702', 'license'=>'ZWTWVGN6', 'type'=>'S'),
                                       694=>array('book'=>'9788448609702', 'license'=>'9ND3HA66', 'type'=>'S'),  
                                       699=>array('book'=>'9788448609702', 'license'=>'G2K286B6', 'type'=>'S'),
                                       702=>array('book'=>'9788448609702', 'license'=>'Y5F4NNW6', 'type'=>'S'),
                                ),
          
                            //apoyo Gestión de la documentación jurídica y empresarial. GS. 
                            235=>array(
                                       687=>array('book'=>'9788448609702', 'license'=>'CU48X1Y6', 'type'=>'S'),  
                                       688=>array('book'=>'9788448609702', 'license'=>'35AXBUL6', 'type'=>'S'),
                                       689=>array('book'=>'9788448609702', 'license'=>'1ETUTFJ6', 'type'=>'S'),
                                ),
          
          
                            //Ingles            
                            222=>array(617=>array('book'=>'9788448187354', 'license'=>'3CRBGXY10', 'type'=>'T'),
                                       636=>array('book'=>'9788448187354', 'license'=>'LEGZ1FH10', 'type'=>'T'),
                                       663=>array('book'=>'9788448187354', 'license'=>'ULZDBM26', 'type'=>'S'),
                                       664=>array('book'=>'9788448187354', 'license'=>'9Y55EKA6', 'type'=>'S'),
                                       665=>array('book'=>'9788448187354', 'license'=>'YGHPDF76', 'type'=>'S'),
                                       666=>array('book'=>'9788448187354', 'license'=>'ZFB3ZRE6', 'type'=>'S'),
                                       667=>array('book'=>'9788448187354', 'license'=>'2CCPZSL6', 'type'=>'S'),  
                                       668=>array('book'=>'9788448187354', 'license'=>'PD7KVXN6', 'type'=>'S'),
                                       
                                       693=>array('book'=>'9788448187354', 'license'=>'9LS3MNT6', 'type'=>'S'),
                                       694=>array('book'=>'9788448187354', 'license'=>'V26BLHZ6', 'type'=>'S'),  
                                       699=>array('book'=>'9788448187354', 'license'=>'36PYSAC6', 'type'=>'S'),
                                       702=>array('book'=>'9788448187354', 'license'=>'RY2LTBT6', 'type'=>'S'),
                                
                                ),
          
                            //apoyo Ingles 
                            236=>array(
                                       687=>array('book'=>'9788448187354', 'license'=>'8F2W6V76', 'type'=>'S'),  
                                       688=>array('book'=>'9788448187354', 'license'=>'ZPSU6RW6', 'type'=>'S'),
                                       689=>array('book'=>'9788448187354', 'license'=>'C6XHXT66', 'type'=>'S'),  
                                ),    
          
                            //Proceso Integral de la actividad comercial            
                            223=>array(626=>array('book'=>'9788448609689', 'license'=>'47ENEEC10', 'type'=>'T'),
                                       636=>array('book'=>'9788448609689', 'license'=>'M3ZNTFQ6', 'type'=>'T'),
                                       663=>array('book'=>'9788448609689', 'license'=>'E7XJCFH6', 'type'=>'S'),
                                       664=>array('book'=>'9788448609689', 'license'=>'C1JHDNB6', 'type'=>'S'),
                                       665=>array('book'=>'9788448609689', 'license'=>'ZRGPZU26', 'type'=>'S'),
                                       666=>array('book'=>'9788448609689', 'license'=>'2J759GJ6', 'type'=>'S'),
                                       667=>array('book'=>'9788448609689', 'license'=>'CS6FVG46', 'type'=>'S'),  
                                       668=>array('book'=>'9788448609689', 'license'=>'4P9G2316', 'type'=>'S'),
                                       
                                       693=>array('book'=>'9788448609689', 'license'=>'LH43LE66', 'type'=>'S'),
                                       694=>array('book'=>'9788448609689', 'license'=>'LHXCY286', 'type'=>'S'),  
                                       699=>array('book'=>'9788448609689', 'license'=>'U8Z2WKT6', 'type'=>'S'),
                                       702=>array('book'=>'9788448609689', 'license'=>'MC3LHHD6', 'type'=>'S'),
                                
                                ),
          
                            //apoyo Proceso Integral de la actividad comercial  
                            238=>array(
                                       687=>array('book'=>'9788448609689', 'license'=>'8WSHX1B6', 'type'=>'S'),  
                                       688=>array('book'=>'9788448609689', 'license'=>'B6CD6F86', 'type'=>'S'),
                                       689=>array('book'=>'9788448609689', 'license'=>'7P5BA7K6', 'type'=>'S'),
                                ),      
                            
                            //Ofimática y proceso de información            
                            224=>array(651=>array('book'=>'9788448191917', 'license'=>'2SXZA8K10', 'type'=>'T'),
                                       636=>array('book'=>'9788448191917', 'license'=>'RFFJM3W6', 'type'=>'T'),
                                       663=>array('book'=>'9788448191917', 'license'=>'G2HFFNA6', 'type'=>'S'),
                                       664=>array('book'=>'9788448191917', 'license'=>'6W6GX7D6', 'type'=>'S'),
                                       665=>array('book'=>'9788448191917', 'license'=>'Q7M9KHU6', 'type'=>'S'),
                                       666=>array('book'=>'9788448191917', 'license'=>'Q2WZJVN6', 'type'=>'S'),
                                       667=>array('book'=>'9788448191917', 'license'=>'KHW977V6', 'type'=>'S'),  
                                       668=>array('book'=>'9788448191917', 'license'=>'NYS2D4B6', 'type'=>'S'),
                                       
                                       693=>array('book'=>'9788448191917', 'license'=>'358ZWZB6', 'type'=>'S'),
                                       694=>array('book'=>'9788448191917', 'license'=>'9VU1VPM6', 'type'=>'S'),  
                                       699=>array('book'=>'9788448191917', 'license'=>'ETFCWES6', 'type'=>'S'),
                                       702=>array('book'=>'9788448191917', 'license'=>'E34SSFG6', 'type'=>'S'),
                                ),
          
                            //apoyo Ofimática y proceso de información      
                            237=>array(
                                       687=>array('book'=>'9788448191917', 'license'=>'NEJBZET6', 'type'=>'S'),  
                                       688=>array('book'=>'9788448191917', 'license'=>'RKQWDSF6', 'type'=>'S'),
                                       689=>array('book'=>'9788448191917', 'license'=>'L37RDKS6', 'type'=>'S'),
                                ),     
                            
                            //Recursos humanos y responsabilidad social corporativa           
                            225=>array(626=>array('book'=>'9788448609726', 'license'=>'3CWLQWA10', 'type'=>'T'),
                                       636=>array('book'=>'9788448609726', 'license'=>'APZ3WXC6', 'type'=>'T'),
                                       663=>array('book'=>'9788448609726', 'license'=>'STGTP876', 'type'=>'S'),
                                       664=>array('book'=>'9788448609726', 'license'=>'B7XJ1XK6', 'type'=>'S'),
                                       665=>array('book'=>'9788448609726', 'license'=>'AQWGLR96', 'type'=>'S'),
                                       666=>array('book'=>'9788448609726', 'license'=>'H9PZ62H6', 'type'=>'S'),
                                       667=>array('book'=>'9788448609726', 'license'=>'F6XKCSH6', 'type'=>'S'),  
                                       668=>array('book'=>'9788448609726', 'license'=>'31LF68G6', 'type'=>'S'),
                                       
                                       693=>array('book'=>'9788448609726', 'license'=>'H3HUUFN6', 'type'=>'S'),
                                       694=>array('book'=>'9788448609726', 'license'=>'5PP9BCL6', 'type'=>'S'),  
                                       699=>array('book'=>'9788448609726', 'license'=>'SZVRANA6', 'type'=>'S'),
                                       702=>array('book'=>'9788448609726', 'license'=>'MVM3AYJ6', 'type'=>'S'),
                                
                                ),
          
                            //apoyo Recursos humanos y responsabilidad social corporativa    
                            239=>array(
                                       687=>array('book'=>'9788448609726', 'license'=>'3X2A1946', 'type'=>'S'),  
                                       688=>array('book'=>'9788448609726', 'license'=>'CZRFYMS6', 'type'=>'S'),
                                       689=>array('book'=>'9788448609726', 'license'=>'S9NPSPP6', 'type'=>'S'),
                                ),           
                            // endregion Administración y Finanzas           
                                       
                            //Técnico en Cuidados Auxiliares de Enfermería            
          
                            // Técnicas Básicas de Enfermería 18/19
                            226=>array( 629=>array('book'=>'9788448612191', 'license'=>'QE5VG6110', 'type'=>'T'),
                                        652=>array('book'=>'9788448612191', 'license'=>'LSWSPQ510', 'type'=>'T'),
                                        634=>array('book'=>'9788448612191', 'license'=>'VD3UF6910', 'type'=>'T'),
                                        708=>array('book'=>'9788448612191', 'license'=>'FUB5TBC6', 'type'=>'T'),
                                        655=>array('book'=>'9788448612191', 'license'=>'87VJGFK6', 'type'=>'S'),
                                        656=>array('book'=>'9788448612191', 'license'=>'1QLVRN86', 'type'=>'S'),
                                        657=>array('book'=>'9788448612191', 'license'=>'R1SLU5N6', 'type'=>'S'),
                                        658=>array('book'=>'9788448612191', 'license'=>'RSUMYBH6', 'type'=>'S'),
                                        659=>array('book'=>'9788448612191', 'license'=>'Z846Z896', 'type'=>'S'),
                                        660=>array('book'=>'9788448612191', 'license'=>'FN5ZX8K6', 'type'=>'S'),
                                        661=>array('book'=>'9788448612191', 'license'=>'X1PS5DN6', 'type'=>'S'),
                                        662=>array('book'=>'9788448612191', 'license'=>'V9CBF4V6', 'type'=>'S'),
                                        669=>array('book'=>'9788448612191', 'license'=>'YYJS9786', 'type'=>'S'),
                                        670=>array('book'=>'9788448612191', 'license'=>'NMKH2NZ6', 'type'=>'S'),
                                        671=>array('book'=>'9788448612191', 'license'=>'G7CZ3BD6', 'type'=>'S'),
                                        672=>array('book'=>'9788448612191', 'license'=>'6VVQ4MG6', 'type'=>'S'),
                                        673=>array('book'=>'9788448612191', 'license'=>'WTR52FR6', 'type'=>'S'),
                                        674=>array('book'=>'9788448612191', 'license'=>'U3MHL8L6', 'type'=>'S'),
                                        675=>array('book'=>'9788448612191', 'license'=>'FA4NQ6C6', 'type'=>'S'),
                                        676=>array('book'=>'9788448612191', 'license'=>'SB8UD586', 'type'=>'S'),
                                        677=>array('book'=>'9788448612191', 'license'=>'J88AXK96', 'type'=>'S'),
                                        678=>array('book'=>'9788448612191', 'license'=>'QJJWPZH6', 'type'=>'S'),
                                        679=>array('book'=>'9788448612191', 'license'=>'PM79JGW6', 'type'=>'S'),
                                        680=>array('book'=>'9788448612191', 'license'=>'UW5HB7U6', 'type'=>'S'),
                                        681=>array('book'=>'9788448612191', 'license'=>'TFRX63R6', 'type'=>'S'),
                                        682=>array('book'=>'9788448612191', 'license'=>'LN2QUBD6', 'type'=>'S'),
                                        683=>array('book'=>'9788448612191', 'license'=>'5BK1RYP6', 'type'=>'S'),
                                        684=>array('book'=>'9788448612191', 'license'=>'CXRR2P86', 'type'=>'S'),
                                        685=>array('book'=>'9788448612191', 'license'=>'RSAX1LT6', 'type'=>'S'),
                                        686=>array('book'=>'9788448612191', 'license'=>'PU5DKG76', 'type'=>'S'),
                                
                                        691=>array('book'=>'9788448612191', 'license'=>'Z4ALH9C6', 'type'=>'S'),
                                        692=>array('book'=>'9788448612191', 'license'=>'ZK64RBX6', 'type'=>'S'),
                                        696=>array('book'=>'9788448612191', 'license'=>'3X3M5RL6', 'type'=>'S'),
                                        697=>array('book'=>'9788448612191', 'license'=>'XSCJ2S96', 'type'=>'S'),
                                        698=>array('book'=>'9788448612191', 'license'=>'Y4XH5W96', 'type'=>'S'),
                                        700=>array('book'=>'9788448612191', 'license'=>'ALXGZFK6', 'type'=>'S'),
                                        701=>array('book'=>'9788448612191', 'license'=>'9LNP1ME6', 'type'=>'S'),
                                
                                        704=>array('book'=>'9788448612191', 'license'=>'LMV39Z66', 'type'=>'S'),
                                        705=>array('book'=>'9788448612191', 'license'=>'CBF4WY46', 'type'=>'S'),
                                        706=>array('book'=>'9788448612191', 'license'=>'RTT6RF56', 'type'=>'S'),
                                        707=>array('book'=>'9788448612191', 'license'=>'FJTJ9636', 'type'=>'S'),
                                        711=>array('book'=>'9788448612191', 'license'=>'TQNWY216', 'type'=>'S'), 
                                        712=>array('book'=>'9788448612191', 'license'=>'T95L5SQ6', 'type'=>'S'), 
                                        713=>array('book'=>'9788448612191', 'license'=>'T7L7T2W6', 'type'=>'S'),
                                        714=>array('book'=>'9788448612191', 'license'=>'RQWGVLM6', 'type'=>'S'),
                                        718=>array('book'=>'9788448612191', 'license'=>'WU6V2ZR6', 'type'=>'S'),
                                ), 

                            //Higiene del medio hospitalario 18/19    
                            227=>array( 631=>array('book'=>'9788448609665', 'license'=>'X4HW21U10', 'type'=>'T'),
                                        653=>array('book'=>'9788448609665', 'license'=>'RVM5XGX10', 'type'=>'T'),
                                        634=>array('book'=>'9788448609665', 'license'=>'U1MWCR96', 'type'=>'T'),
                                        708=>array('book'=>'9788448609665', 'license'=>'APU5GC86', 'type'=>'T'),
                                        655=>array('book'=>'9788448609665', 'license'=>'GD1HCKE6', 'type'=>'S'),
                                        656=>array('book'=>'9788448609665', 'license'=>'JGEWC7C6', 'type'=>'S'),
                                        657=>array('book'=>'9788448609665', 'license'=>'BSR4GJD6', 'type'=>'S'),
                                        658=>array('book'=>'9788448609665', 'license'=>'4A8MX686', 'type'=>'S'),
                                        659=>array('book'=>'9788448609665', 'license'=>'R996QW86', 'type'=>'S'),
                                        660=>array('book'=>'9788448609665', 'license'=>'AW2S98E6', 'type'=>'S'),
                                        661=>array('book'=>'9788448609665', 'license'=>'B8JQZQX6', 'type'=>'S'),
                                        662=>array('book'=>'9788448609665', 'license'=>'RKN3AAZ6', 'type'=>'S'),
                                        669=>array('book'=>'9788448609665', 'license'=>'NS1GQMR6', 'type'=>'S'),
                                        670=>array('book'=>'9788448609665', 'license'=>'94JBBX26', 'type'=>'S'),
                                        671=>array('book'=>'9788448609665', 'license'=>'RTTP1ES6', 'type'=>'S'),
                                        672=>array('book'=>'9788448609665', 'license'=>'FA4C8CP6', 'type'=>'S'),
                                        673=>array('book'=>'9788448609665', 'license'=>'UDPGREU6', 'type'=>'S'),
                                        674=>array('book'=>'9788448609665', 'license'=>'2T1MAE66', 'type'=>'S'),
                                        675=>array('book'=>'9788448609665', 'license'=>'Z3ZYXD16', 'type'=>'S'),
                                        676=>array('book'=>'9788448609665', 'license'=>'1FRWQCU6', 'type'=>'S'),
                                        677=>array('book'=>'9788448609665', 'license'=>'UU2718P6', 'type'=>'S'),
                                        678=>array('book'=>'9788448609665', 'license'=>'UWWHMVX6', 'type'=>'S'),
                                        679=>array('book'=>'9788448609665', 'license'=>'G3KDC486', 'type'=>'S'),
                                        680=>array('book'=>'9788448609665', 'license'=>'K5VH74V6', 'type'=>'S'),
                                        681=>array('book'=>'9788448609665', 'license'=>'2NDESV86', 'type'=>'S'),
                                        682=>array('book'=>'9788448609665', 'license'=>'QJXYSDH6', 'type'=>'S'),
                                        683=>array('book'=>'9788448609665', 'license'=>'FN164WC6', 'type'=>'S'),
                                        684=>array('book'=>'9788448609665', 'license'=>'JUULLYT6', 'type'=>'S'),
                                        685=>array('book'=>'9788448609665', 'license'=>'ELKUCPD6', 'type'=>'S'),
                                        686=>array('book'=>'9788448609665', 'license'=>'P1REEJA6', 'type'=>'S'),
                                
                                        691=>array('book'=>'9788448609665', 'license'=>'43FLR6Z6', 'type'=>'S'),
                                        692=>array('book'=>'9788448609665', 'license'=>'VTH2QLV6', 'type'=>'S'),
                                        696=>array('book'=>'9788448609665', 'license'=>'AVPMEPN6', 'type'=>'S'),
                                        697=>array('book'=>'9788448609665', 'license'=>'RVNGQQD6', 'type'=>'S'),
                                        698=>array('book'=>'9788448609665', 'license'=>'UQ8XZVA6', 'type'=>'S'),
                                        700=>array('book'=>'9788448609665', 'license'=>'6845S276', 'type'=>'S'),
                                        701=>array('book'=>'9788448609665', 'license'=>'NWTTMDC6', 'type'=>'S'),
                                
                                        704=>array('book'=>'9788448609665', 'license'=>'R81R9T56', 'type'=>'S'),
                                        705=>array('book'=>'9788448609665', 'license'=>'WBH5A866', 'type'=>'S'),
                                        706=>array('book'=>'9788448609665', 'license'=>'GRV11HH6', 'type'=>'S'),
                                        707=>array('book'=>'9788448609665', 'license'=>'FBA3BKN6', 'type'=>'S'),
                                        711=>array('book'=>'9788448609665', 'license'=>'MEVD2GD6', 'type'=>'S'),
                                        712=>array('book'=>'9788448609665', 'license'=>'NGK2U3U6', 'type'=>'S'),
                                        713=>array('book'=>'9788448609665', 'license'=>'WXZZXWG6', 'type'=>'S'), 
                                        714=>array('book'=>'9788448609665', 'license'=>'5R6HZKE6', 'type'=>'S'), 
                                        718=>array('book'=>'9788448609665', 'license'=>'HR6JBEQ6', 'type'=>'S'), 
                                ),
          
                            //Técnicas de ayuda Odontológica/Estomatológica 18/19           
                            229=>array( 629=>array('book'=>'9788448612092', 'license'=>'US1YHLY10', 'type'=>'T'),
                                        634=>array('book'=>'9788448612092', 'license'=>'GG3N7YS10', 'type'=>'T'),
                                        653=>array('book'=>'9788448612092', 'license'=>'SN8BFBF6', 'type'=>'T'),
                                        708=>array('book'=>'9788448612092', 'license'=>'2SMNVLQ6', 'type'=>'T'),
                                        655=>array('book'=>'9788448612092', 'license'=>'84HYQKK6', 'type'=>'S'),
                                        656=>array('book'=>'9788448612092', 'license'=>'AZ9RUD16', 'type'=>'S'),
                                        657=>array('book'=>'9788448612092', 'license'=>'AAAEK1X6', 'type'=>'S'),
                                        658=>array('book'=>'9788448612092', 'license'=>'XHU52KX6', 'type'=>'S'),
                                        659=>array('book'=>'9788448612092', 'license'=>'CFATJD86', 'type'=>'S'),
                                        660=>array('book'=>'9788448612092', 'license'=>'8943L4M6', 'type'=>'S'),
                                        661=>array('book'=>'9788448612092', 'license'=>'G7P1K5V6', 'type'=>'S'),
                                        662=>array('book'=>'9788448612092', 'license'=>'MQ93G426', 'type'=>'S'),
                                        669=>array('book'=>'9788448612092', 'license'=>'XDASXPY6', 'type'=>'S'),
                                        670=>array('book'=>'9788448612092', 'license'=>'NLSPZWV6', 'type'=>'S'),
                                        671=>array('book'=>'9788448612092', 'license'=>'2DPFG556', 'type'=>'S'),
                                        672=>array('book'=>'9788448612092', 'license'=>'TRC9KR66', 'type'=>'S'),
                                        673=>array('book'=>'9788448612092', 'license'=>'PG9TE8D6', 'type'=>'S'),
                                        674=>array('book'=>'9788448612092', 'license'=>'7GJWXBP6', 'type'=>'S'),
                                        675=>array('book'=>'9788448612092', 'license'=>'K3T3VTX6', 'type'=>'S'),
                                        676=>array('book'=>'9788448612092', 'license'=>'5U1GUUS6', 'type'=>'S'),
                                        677=>array('book'=>'9788448612092', 'license'=>'NEJMAQ56', 'type'=>'S'),
                                        678=>array('book'=>'9788448612092', 'license'=>'WX1Y2LF6', 'type'=>'S'),
                                        679=>array('book'=>'9788448612092', 'license'=>'W5AGNRX6', 'type'=>'S'),
                                        680=>array('book'=>'9788448612092', 'license'=>'GLHRH3M6', 'type'=>'S'),
                                        681=>array('book'=>'9788448612092', 'license'=>'LGTUCRG6', 'type'=>'S'),
                                        682=>array('book'=>'9788448612092', 'license'=>'NQQ8TFG6', 'type'=>'S'),
                                        683=>array('book'=>'9788448612092', 'license'=>'TWZCZHL6', 'type'=>'S'),
                                        684=>array('book'=>'9788448612092', 'license'=>'MBCAMTC6', 'type'=>'S'),
                                        685=>array('book'=>'9788448612092', 'license'=>'P7PMSHP6', 'type'=>'S'),
                                        686=>array('book'=>'9788448612092', 'license'=>'RKJ9QK36', 'type'=>'S'),
                                
                                        691=>array('book'=>'9788448612092', 'license'=>'2ZMDBUW6', 'type'=>'S'),
                                        692=>array('book'=>'9788448612092', 'license'=>'VWMAEUZ6', 'type'=>'S'),
                                        696=>array('book'=>'9788448612092', 'license'=>'QEUADAB6', 'type'=>'S'),
                                        697=>array('book'=>'9788448612092', 'license'=>'PYJQCDC6', 'type'=>'S'),
                                        698=>array('book'=>'9788448612092', 'license'=>'6G7BG326', 'type'=>'S'),
                                        700=>array('book'=>'9788448612092', 'license'=>'VPVLHFM6', 'type'=>'S'),
                                        701=>array('book'=>'9788448612092', 'license'=>'HZYJXJV6', 'type'=>'S'),
                                
                                        704=>array('book'=>'9788448612092', 'license'=>'QZ5KPL46', 'type'=>'S'),
                                        705=>array('book'=>'9788448612092', 'license'=>'YHFUAM36', 'type'=>'S'),
                                        706=>array('book'=>'9788448612092', 'license'=>'L74SJ1Q6', 'type'=>'S'),
                                        707=>array('book'=>'9788448612092', 'license'=>'RW6H92R6', 'type'=>'S'),
                                        711=>array('book'=>'9788448612092', 'license'=>'D7U4UHT6', 'type'=>'S'),
                                        712=>array('book'=>'9788448612092', 'license'=>'NVWH1KZ6', 'type'=>'S'),
                                        713=>array('book'=>'9788448612092', 'license'=>'H2F3E9P6', 'type'=>'S'),
                                        718=>array('book'=>'9788448612092', 'license'=>'H8WK4SX6', 'type'=>'S'),
                                ),

                            // Promoción de la salud 18/19    
                            230=>array( 649=>array('book'=>'9788448612054', 'license'=>'L13JMTB10', 'type'=>'T'),
                                        634=>array('book'=>'9788448612054', 'license'=>'HKFQ3YL10', 'type'=>'T'),
                                        708=>array('book'=>'9788448612054', 'license'=>'HMKZ9EZ6', 'type'=>'T'),
                                        655=>array('book'=>'9788448612054', 'license'=>'1J7HPS66', 'type'=>'S'),
                                        656=>array('book'=>'9788448612054', 'license'=>'QH88ZGS6', 'type'=>'S'),
                                        657=>array('book'=>'9788448612054', 'license'=>'Z8VNG6G6', 'type'=>'S'),
                                        658=>array('book'=>'9788448612054', 'license'=>'2EB4LRX6', 'type'=>'S'),
                                        659=>array('book'=>'9788448612054', 'license'=>'WY9W6966', 'type'=>'S'),
                                        660=>array('book'=>'9788448612054', 'license'=>'7DBEMGX6', 'type'=>'S'),
                                        661=>array('book'=>'9788448612054', 'license'=>'GF9UMGM6', 'type'=>'S'),
                                        662=>array('book'=>'9788448612054', 'license'=>'ENK963M6', 'type'=>'S'),
                                        669=>array('book'=>'9788448612054', 'license'=>'NXAMZLM6', 'type'=>'S'),
                                        670=>array('book'=>'9788448612054', 'license'=>'ZF6YH3V6', 'type'=>'S'),
                                        671=>array('book'=>'9788448612054', 'license'=>'9AM9CPV6', 'type'=>'S'),
                                        672=>array('book'=>'9788448612054', 'license'=>'SG3QW2Y6', 'type'=>'S'),
                                        673=>array('book'=>'9788448612054', 'license'=>'YR86JB36', 'type'=>'S'),
                                        674=>array('book'=>'9788448612054', 'license'=>'ZTLV4DB6', 'type'=>'S'),
                                        675=>array('book'=>'9788448612054', 'license'=>'MLH2B5J6', 'type'=>'S'),
                                        676=>array('book'=>'9788448612054', 'license'=>'WPFYQQG6', 'type'=>'S'),
                                        677=>array('book'=>'9788448612054', 'license'=>'S5WM22S6', 'type'=>'S'),
                                        678=>array('book'=>'9788448612054', 'license'=>'KU1DB8G6', 'type'=>'S'),
                                        679=>array('book'=>'9788448612054', 'license'=>'QPRRM5A6', 'type'=>'S'),
                                        680=>array('book'=>'9788448612054', 'license'=>'UED1P3M6', 'type'=>'S'),
                                        681=>array('book'=>'9788448612054', 'license'=>'6T3ABDQ6', 'type'=>'S'),
                                        682=>array('book'=>'9788448612054', 'license'=>'TM2Q2UP6', 'type'=>'S'),
                                        683=>array('book'=>'9788448612054', 'license'=>'WY8BX126', 'type'=>'S'),
                                        684=>array('book'=>'9788448612054', 'license'=>'55YY1G16', 'type'=>'S'),
                                        685=>array('book'=>'9788448612054', 'license'=>'D5WFTGK6', 'type'=>'S'),
                                        686=>array('book'=>'9788448612054', 'license'=>'1WBNVF36', 'type'=>'S'),
                                        
                                        691=>array('book'=>'9788448612054', 'license'=>'3LHUDF66', 'type'=>'S'),
                                        692=>array('book'=>'9788448612054', 'license'=>'6DPR4P76', 'type'=>'S'),
                                        696=>array('book'=>'9788448612054', 'license'=>'X1C5MV36', 'type'=>'S'),
                                        697=>array('book'=>'9788448612054', 'license'=>'JS2TC1C6', 'type'=>'S'),
                                        698=>array('book'=>'9788448612054', 'license'=>'UAUGLS76', 'type'=>'S'),
                                        700=>array('book'=>'9788448612054', 'license'=>'VAXS9S76', 'type'=>'S'),
                                        701=>array('book'=>'9788448612054', 'license'=>'TRDMF6U6', 'type'=>'S'),
                                
                                        704=>array('book'=>'9788448612054', 'license'=>'QGEGCWU6', 'type'=>'S'),
                                        705=>array('book'=>'9788448612054', 'license'=>'XGB5KEP6', 'type'=>'S'),
                                        706=>array('book'=>'9788448612054', 'license'=>'XTV7TFV6', 'type'=>'S'),
                                        707=>array('book'=>'9788448612054', 'license'=>'BP9JD3H6', 'type'=>'S'),
                                        711=>array('book'=>'9788448612054', 'license'=>'Y5YQ7TU6', 'type'=>'S'),
                                        712=>array('book'=>'9788448612054', 'license'=>'T8BP1MX6', 'type'=>'S'),
                                        713=>array('book'=>'9788448612054', 'license'=>'VE7X43Z6', 'type'=>'S'),
                                        718=>array('book'=>'9788448612054', 'license'=>'EY2FZG16', 'type'=>'S'),
                                ),

                            // Operaciones administrativas 18/19        
                            231=>array( 649=>array('book'=>'9788448612030', 'license'=>'764T9ST10', 'type'=>'T'),
                                        634=>array('book'=>'9788448612030', 'license'=>'FW3FSSX10', 'type'=>'T'),
                                        708=>array('book'=>'9788448612030', 'license'=>'BSEZVS16', 'type'=>'T'),
                                        655=>array('book'=>'9788448612030', 'license'=>'4QSC2BR6', 'type'=>'S'),
                                        656=>array('book'=>'9788448612030', 'license'=>'BG16LET6', 'type'=>'S'),
                                        657=>array('book'=>'9788448612030', 'license'=>'WPX6A266', 'type'=>'S'),
                                        658=>array('book'=>'9788448612030', 'license'=>'EGB6FUR6', 'type'=>'S'),
                                        659=>array('book'=>'9788448612030', 'license'=>'D4SQFSR6', 'type'=>'S'),
                                        660=>array('book'=>'9788448612030', 'license'=>'EACTQHP6', 'type'=>'S'),
                                        661=>array('book'=>'9788448612030', 'license'=>'REK9Z1T6', 'type'=>'S'),
                                        662=>array('book'=>'9788448612030', 'license'=>'PR7CJU36', 'type'=>'S'),
                                        669=>array('book'=>'9788448612030', 'license'=>'PYQLSRY6', 'type'=>'S'),
                                        670=>array('book'=>'9788448612030', 'license'=>'4SFBXNV6', 'type'=>'S'),
                                        671=>array('book'=>'9788448612030', 'license'=>'V6C2Y5N6', 'type'=>'S'),
                                        672=>array('book'=>'9788448612030', 'license'=>'9AC1MEU6', 'type'=>'S'),
                                        673=>array('book'=>'9788448612030', 'license'=>'6BWJN356', 'type'=>'S'),
                                        674=>array('book'=>'9788448612030', 'license'=>'GDBAEKF6', 'type'=>'S'),
                                        675=>array('book'=>'9788448612030', 'license'=>'53W51966', 'type'=>'S'),
                                        676=>array('book'=>'9788448612030', 'license'=>'JDDT8UG6', 'type'=>'S'),
                                        677=>array('book'=>'9788448612030', 'license'=>'69395B36', 'type'=>'S'),
                                        678=>array('book'=>'9788448612030', 'license'=>'C7RRRRK6', 'type'=>'S'),
                                        679=>array('book'=>'9788448612030', 'license'=>'2TC9FHM6', 'type'=>'S'),
                                        680=>array('book'=>'9788448612030', 'license'=>'D89Y7L76', 'type'=>'S'),
                                        681=>array('book'=>'9788448612030', 'license'=>'A2YSR2V6', 'type'=>'S'),
                                        682=>array('book'=>'9788448612030', 'license'=>'V4XJKKV6', 'type'=>'S'),
                                        683=>array('book'=>'9788448612030', 'license'=>'9514K8R6', 'type'=>'S'),
                                        684=>array('book'=>'9788448612030', 'license'=>'QF4L3GE6', 'type'=>'S'),
                                        685=>array('book'=>'9788448612030', 'license'=>'PBP2J786', 'type'=>'S'),
                                        686=>array('book'=>'9788448612030', 'license'=>'UZUTA926', 'type'=>'S'),
                                        
                                        691=>array('book'=>'9788448612030', 'license'=>'6UZL6V46', 'type'=>'S'),
                                        692=>array('book'=>'9788448612030', 'license'=>'C2KQ4DT6', 'type'=>'S'),
                                        696=>array('book'=>'9788448612030', 'license'=>'TU5FWQQ6', 'type'=>'S'),
                                        697=>array('book'=>'9788448612030', 'license'=>'RPKFH6B6', 'type'=>'S'),
                                        698=>array('book'=>'9788448612030', 'license'=>'CDD2JPG6', 'type'=>'S'),
                                        700=>array('book'=>'9788448612030', 'license'=>'N2DVDPR6', 'type'=>'S'),
                                        701=>array('book'=>'9788448612030', 'license'=>'HTG1KST6', 'type'=>'S'),
                                
                                        704=>array('book'=>'9788448612030', 'license'=>'QVYASVB6', 'type'=>'S'),
                                        705=>array('book'=>'9788448612030', 'license'=>'NSXEJQG6', 'type'=>'S'),
                                        706=>array('book'=>'9788448612030', 'license'=>'AUQ9XZ26', 'type'=>'S'),
                                        707=>array('book'=>'9788448612030', 'license'=>'WCPNBL16', 'type'=>'S'),
                                        711=>array('book'=>'9788448612030', 'license'=>'GBXMQQ56', 'type'=>'S'),
                                        712=>array('book'=>'9788448612030', 'license'=>'QKYMC9U6', 'type'=>'S'),
                                        713=>array('book'=>'9788448612030', 'license'=>'AM1YXDF6', 'type'=>'S'),
                                        718=>array('book'=>'9788448612030', 'license'=>'VKGYLH96', 'type'=>'S'),
                                ),
                            
                            // Formación y Orientación Laboral Grado Medio 18/19    
                            228=>array( 626=>array('book'=>'9788448611996', 'license'=>'5H3YM8410', 'type'=>'T'),
                                        634=>array('book'=>'9788448611996', 'license'=>'61666Q210', 'type'=>'T'),
                                        708=>array('book'=>'9788448611996', 'license'=>'U52L83F6', 'type'=>'T'),
                                        655=>array('book'=>'9788448611996', 'license'=>'S3FFQXT6', 'type'=>'S'),
                                        656=>array('book'=>'9788448611996', 'license'=>'49V2WN36', 'type'=>'S'),
                                        657=>array('book'=>'9788448611996', 'license'=>'KDHNBW66', 'type'=>'S'),
                                        658=>array('book'=>'9788448611996', 'license'=>'JREAS1H6', 'type'=>'S'),
                                        659=>array('book'=>'9788448611996', 'license'=>'6N3LL5Z6', 'type'=>'S'),
                                        660=>array('book'=>'9788448611996', 'license'=>'TCX33TB6', 'type'=>'S'),
                                        661=>array('book'=>'9788448611996', 'license'=>'J8GWRDD6', 'type'=>'S'),
                                        662=>array('book'=>'9788448611996', 'license'=>'CFJBE836', 'type'=>'S'),
                                        669=>array('book'=>'9788448611996', 'license'=>'M31HPN96', 'type'=>'S'),
                                        670=>array('book'=>'9788448611996', 'license'=>'2JAAKC56', 'type'=>'S'),
                                        671=>array('book'=>'9788448611996', 'license'=>'MTN7N4F6', 'type'=>'S'),
                                        672=>array('book'=>'9788448611996', 'license'=>'G2XNRDK6', 'type'=>'S'),
                                        673=>array('book'=>'9788448611996', 'license'=>'TAWMBK26', 'type'=>'S'),
                                        674=>array('book'=>'9788448611996', 'license'=>'N61825T6', 'type'=>'S'),
                                        675=>array('book'=>'9788448611996', 'license'=>'CL3T1B76', 'type'=>'S'),
                                        676=>array('book'=>'9788448611996', 'license'=>'FLE4AV66', 'type'=>'S'),
                                        677=>array('book'=>'9788448611996', 'license'=>'G9DJUCT6', 'type'=>'S'),
                                        678=>array('book'=>'9788448611996', 'license'=>'5RKYZQ46', 'type'=>'S'),
                                        679=>array('book'=>'9788448611996', 'license'=>'ZRSUVNG6', 'type'=>'S'),
                                        680=>array('book'=>'9788448611996', 'license'=>'5EMNGHX6', 'type'=>'S'),
                                        681=>array('book'=>'9788448611996', 'license'=>'47GZT236', 'type'=>'S'),
                                        682=>array('book'=>'9788448611996', 'license'=>'M6XDE6L6', 'type'=>'S'),
                                        683=>array('book'=>'9788448611996', 'license'=>'JEVQMNZ6', 'type'=>'S'),
                                        684=>array('book'=>'9788448611996', 'license'=>'XDZCB8V6', 'type'=>'S'),
                                        685=>array('book'=>'9788448611996', 'license'=>'PDQK2B66', 'type'=>'S'),
                                        686=>array('book'=>'9788448611996', 'license'=>'R68HVA36', 'type'=>'S'),
                                
                                        691=>array('book'=>'9788448611996', 'license'=>'TSX3TV46', 'type'=>'S'),
                                        692=>array('book'=>'9788448611996', 'license'=>'KWLENW46', 'type'=>'S'),
                                        696=>array('book'=>'9788448611996', 'license'=>'G27ZRNB6', 'type'=>'S'),
                                        697=>array('book'=>'9788448611996', 'license'=>'XFWS2SU6', 'type'=>'S'),
                                        698=>array('book'=>'9788448611996', 'license'=>'U7BEGCN6', 'type'=>'S'),
                                        700=>array('book'=>'9788448611996', 'license'=>'BWUAYA86', 'type'=>'S'),
                                        701=>array('book'=>'9788448611996', 'license'=>'85VFBBT6', 'type'=>'S'),
                                
                                        704=>array('book'=>'9788448611996', 'license'=>'7F4GUSF6', 'type'=>'S'),
                                        705=>array('book'=>'9788448611996', 'license'=>'F4K4DVT6', 'type'=>'S'),
                                        706=>array('book'=>'9788448611996', 'license'=>'9SR9M1S6', 'type'=>'S'),
                                        707=>array('book'=>'9788448611996', 'license'=>'B561XHX6', 'type'=>'S'),
                                        711=>array('book'=>'9788448611996', 'license'=>'RGQFSAF6', 'type'=>'S'),
                                        712=>array('book'=>'9788448611996', 'license'=>'3D4UYRA6', 'type'=>'S'),
                                        713=>array('book'=>'9788448611996', 'license'=>'B6J919V6', 'type'=>'S'),
                                        718=>array('book'=>'9788448611996', 'license'=>'7NPG38X6', 'type'=>'S'),
                                ),         

                            // Relaciones en el equipo de trabajo 18/19    
                            232=>array( 45=>array('book'=>'9788448608569', 'license'=>'TDFPJ2K10', 'type'=>'T'),
                                        634=>array('book'=>'9788448608569', 'license'=>'U61EWY96', 'type'=>'T'),
                                        708=>array('book'=>'9788448608569', 'license'=>'VF9TPKY6', 'type'=>'T'),
                                        655=>array('book'=>'9788448608569', 'license'=>'CJT79UZ6', 'type'=>'S'),
                                        656=>array('book'=>'9788448608569', 'license'=>'NVL225D6', 'type'=>'S'),
                                        657=>array('book'=>'9788448608569', 'license'=>'7LQGV3N6', 'type'=>'S'),
                                        658=>array('book'=>'9788448608569', 'license'=>'5U6TDZR6', 'type'=>'S'),
                                        659=>array('book'=>'9788448608569', 'license'=>'HBML4AM6', 'type'=>'S'),
                                        660=>array('book'=>'9788448608569', 'license'=>'MKBR4B96', 'type'=>'S'),
                                        661=>array('book'=>'9788448608569', 'license'=>'VMQ8QYR6', 'type'=>'S'),
                                        662=>array('book'=>'9788448608569', 'license'=>'56KKK536', 'type'=>'S'),
                                        669=>array('book'=>'9788448608569', 'license'=>'M1M3UES6', 'type'=>'S'),
                                        670=>array('book'=>'9788448608569', 'license'=>'3ZJFXCN6', 'type'=>'S'),
                                        671=>array('book'=>'9788448608569', 'license'=>'AX6YHC26', 'type'=>'S'),
                                        672=>array('book'=>'9788448608569', 'license'=>'5X4SC3T6', 'type'=>'S'),
                                        673=>array('book'=>'9788448608569', 'license'=>'WVV63KS6', 'type'=>'S'),
                                        674=>array('book'=>'9788448608569', 'license'=>'FPNGUYY6', 'type'=>'S'),
                                        675=>array('book'=>'9788448608569', 'license'=>'YTF7N626', 'type'=>'S'),
                                        676=>array('book'=>'9788448608569', 'license'=>'P7U6Z5X6', 'type'=>'S'),
                                        677=>array('book'=>'9788448608569', 'license'=>'MK2DNE36', 'type'=>'S'),
                                        678=>array('book'=>'9788448608569', 'license'=>'76NJKM96', 'type'=>'S'),
                                        679=>array('book'=>'9788448608569', 'license'=>'MYG3CGM6', 'type'=>'S'),
                                        680=>array('book'=>'9788448608569', 'license'=>'3WXA2ZF6', 'type'=>'S'),
                                        681=>array('book'=>'9788448608569', 'license'=>'C7K16WN6', 'type'=>'S'),
                                        682=>array('book'=>'9788448608569', 'license'=>'C78B6YB6', 'type'=>'S'),
                                        683=>array('book'=>'9788448608569', 'license'=>'UG657NX6', 'type'=>'S'),
                                        684=>array('book'=>'9788448608569', 'license'=>'XRPKE4Z6', 'type'=>'S'),
                                        685=>array('book'=>'9788448608569', 'license'=>'S4R7RUG6', 'type'=>'S'),
                                        686=>array('book'=>'9788448608569', 'license'=>'VGHWHG76', 'type'=>'S'),
                                
                                        691=>array('book'=>'9788448608569', 'license'=>'7EZF9WT6', 'type'=>'S'),
                                        692=>array('book'=>'9788448608569', 'license'=>'B32QVKV6', 'type'=>'S'),
                                        696=>array('book'=>'9788448608569', 'license'=>'8P7YM7C6', 'type'=>'S'),
                                        697=>array('book'=>'9788448608569', 'license'=>'R5NZC396', 'type'=>'S'),
                                        698=>array('book'=>'9788448608569', 'license'=>'7FAWYQW6', 'type'=>'S'),
                                        700=>array('book'=>'9788448608569', 'license'=>'225UL776', 'type'=>'S'),
                                        701=>array('book'=>'9788448608569', 'license'=>'KKG5FLT6', 'type'=>'S'),
                                
                                        704=>array('book'=>'9788448608569', 'license'=>'R9LEWWA6', 'type'=>'S'),
                                        705=>array('book'=>'9788448608569', 'license'=>'9B1UR1L6', 'type'=>'S'),
                                        706=>array('book'=>'9788448608569', 'license'=>'659CW276', 'type'=>'S'),
                                        707=>array('book'=>'9788448608569', 'license'=>'7G1SH2Q6', 'type'=>'S'),
                                        711=>array('book'=>'9788448608569', 'license'=>'D7Z3UPR6', 'type'=>'S'),
                                        712=>array('book'=>'9788448608569', 'license'=>'QZ7ZSRM6', 'type'=>'S'),
                                        713=>array('book'=>'9788448608569', 'license'=>'5XA7LFY6', 'type'=>'S'),
                                        718=>array('book'=>'9788448608569', 'license'=>'G6KFAYN6', 'type'=>'S'),
                                      
                                ),         
      );
      
      return !empty($array_return[$id_curso][$id_user])?$array_return[$id_curso][$id_user]:false;
  }

} // end class