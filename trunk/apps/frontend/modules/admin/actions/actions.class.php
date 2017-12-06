<?php

/**
 * admin actions.
 *
 * @package    edoceo
 * @subpackage admin
 * @authors    Todor Blajev y Jacobo Chaquet
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class adminActions extends sfActions
{
  /**
   * executeIndex(), el index debe mostrar en portada informacion relevante
   * sobre los alumnos
   * Autor: Todor Todorov
   */
  public function executeIndex()
  {
    $usuario = new Usuario();
    $c = new Criteria();
    $c->add(UsuarioPeer::CONFIRMADO,'0');
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $this->alumnos = $usuario->getAlumnos(null,$c);
    return;
  }

  /**
   *  Nombre del metodo: executeMaterias()
   * Autor: Jacobo Chaquet
   * Descripcion: Lista todos las materias
   */
  public function executeMaterias()
  {
    $c = new Criteria(); $this->materias = MateriaPeer::doSelect($c); return;
  }

  /*
   *  Nombre del metodo: executeEjercicios()
   *  Autor: Angel Martin
   *  Descripcion: Accede a la gestion de ejercicios de administrador
   */
  public function executeEjercicios()
  {
    $ntareas = 0;
    $nejercicios = 0;

    if ($this->hasRequestParameter('idelete')) {
      $id_ejercicio = $this->getRequestParameter('idelete');
      $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);

	  if ($ejercicio) {
		  $id_solucion = $ejercicio->getIdSolucion();
		  $this->titulo_ejercicio = $ejercicio->getTitulo();

		  $c0 = new Criteria();
		  $c0->add(TareaPeer::ID_EJERCICIO, $id_ejercicio);
		  $ntareas = TareaPeer::DoCount($c0);

		  $c0 = new Criteria();
		  $c0->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $id_ejercicio);
		  $nejercicios = Ejercicio_resueltoPeer::DoCount($c0);
		  if ($id_solucion) {$nejercicios--;}

		  if (($ntareas == 0) && ($nejercicios == 0)) {
				$c1 = new Criteria();
				$c1->add(Seleccion_cuestion_testPeer::ID_EJERCICIO_RESUELTO, $id_solucion);
				Seleccion_cuestion_testPeer::DoDelete($c1);
	
				$c2 = new Criteria();
				$c2->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $id_solucion);
				Respuesta_cuestion_cortaPeer::DoDelete($c1);
	
				$solucion = Ejercicio_resueltoPeer::RetrieveByPk($id_solucion);
				if ($solucion) {$solucion->delete();}
	
				$ejercicio->setIdSolucion(NULL);
				$ejercicio->save();
				$ejercicio->delete();
		  }
		}
    }
    $this->ntareas = $ntareas;
    $this->nejercicios = $nejercicios;

    $c = new Criteria();
	  $this->materias = MateriaPeer::doSelect($c);
    return;
  }

  /*
   *  Nombre del metodo: executeListarEjercicios()
   *  Autor: Angel Martin
   *  Descripcion: Lista ejercicios para administracion
   */
  public function executeListarEjercicios()
  {
    $id_materia = $this->getRequestParameter('filtro');
    $this->modificar_ejericicio = $this->getRequestParameter('edita-ejercicio',false);
    $this->idusuario = $this->getRequestParameter('idusuario');
    $this->idcurso = $this->getRequestParameter('idcurso');
    $c = new Criteria();
    if ($id_materia) {$c->add(EjercicioPeer::ID_MATERIA, $id_materia);}
    $this->ejercicios = EjercicioPeer::DoSelect($c);
  }

  private function crearExpMat($cuestion, $tipo, $id, $latex_formula)
  {
    $tamano = 11;

  	$latexrender_path = SF_ROOT_DIR.'/web/latexrender';
  	$picture_path = SF_ROOT_DIR.'/web/images/ecuaciones';
  	$picture_path_http = '';
  	$temp_path = SF_ROOT_DIR.'/web/images/ecuaciones/tmp';

  	if ($cuestion) {
  	  $picture_name = 'cuestion'.$tipo.'_'.$id;
    } else {
      $picture_name = 'respuesta'.$tipo.'_'.$id;
    }
  	include_once(SF_ROOT_DIR.'/web/latexrender/class.latexrender.php');

  	$latex = new LatexRender($picture_name, $picture_path, $picture_path_http, $temp_path);
		$latex->setFontSize($tamano);
		$url = $latex->getFormulaURL($latex_formula);
  }

  /*
   *  Nombre del metodo: executeImportarEjercicios()
   *  Autor: Angel Martin
   *  Descripcion: Lista ejercicios para administracion
   */
  public function executeImportarEjercicios()
  {
    $this->errors = array();
    $mensaje_importar = '';

    // Si se ha hecho submit procesamos el formulario
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
        if ($this->getRequest()->getFileName('my_file')) {
            if (is_readable($_FILES['my_file']['tmp_name'])) {
              $my_file = $_FILES['my_file']['tmp_name'];
              $id_materia = $this->getRequestParameter('materia');
              $xml = simplexml_load_file($my_file);
              if (!$xml) {$this->errors[] = 'Fichero XML incorrecto - fallo en load'; return;}

              $ejercicio = new Ejercicio();
              $solucion_ejercicio = new Ejercicio_resuelto();

              if ($xml->getName() != 'ejercicio') {$this->errors[] = 'Fichero XML incorrecto - fallo en esquema 1'; return;}

              $id_admin = $this->getUser()->getAnyId();
              $solucion_ejercicio->setIdAutor($id_admin);
              $ejercicio->setIdAutor($id_admin);
              $ejercicio->setIdMateria($id_materia);
              $ejercicio->setNombreAutor((string) $xml['nombre_autor']);
              $tipo = $xml['tipo'];
              $ejercicio->setTipo((string) $xml['tipo']);
              $ejercicio->setTitulo((string) $xml['titulo']);
              $ejercicio->setTestMultiple((int) $xml['test_multiple']);
              $ejercicio->setTestResta((int) $xml['test_resta']);
              $numero_respuestas_test = (int) $xml['numero_respuestas'];
              $ejercicio->setNumeroRespuestas($numero_respuestas_test);
              $ejercicio->setSolucion((int) $xml['solucion']);
              $ejercicio->setExpresionesMatematicas((int) $xml['expresiones_matematicas']);
              $ejercicio->setNumeroHojas((int) $xml['numero_hojas']);

              $expmat = $ejercicio->getExpresionesMatematicas();

              $array_cuestiones = array();
              $array_soluciones = array();
              $index1 = 0;

              foreach ($xml->children() as $cuestion) {
                if ($cuestion->getName() != 'cuestion') {$this->errors[] = 'Fichero XML incorrecto - fallo en esquema 2'; return;}

                switch ($tipo) {
                  case 'test':
                    $enunciado = (string) $cuestion->pregunta;
                    $cref = new Cuestion_test();
                    $cref->setPregunta($enunciado);
                    $cref->setNumeroRespuestasCorrectas((int) $cuestion['ncorrectas']);
                    $cref->setNumeroRespuestasIncorrectas((int) $cuestion['nincorrectas']);
                    $array_cuestiones[$index1] = $cref;

                    $index2 = 0;
                    foreach ($cuestion->respuestas->respuesta as $respuesta) {
                      $rref = new Respuesta_cuestion_test();
                      if ($respuesta['correcta']) {
                        $correcta = (int) $respuesta['correcta'];
                      } else {
                        $correcta = 0;
                      }
                      $rref->setCorrecta($correcta);
                      $rref->setRespuesta((string) $respuesta);
                      $array_soluciones["$index1.$index2"] = $rref;
                      $index2++;
                    }
                    $index1++;
                  break;

                  case 'cuestionario':
                    $enunciado = (string) $cuestion->pregunta;
                    $puntuacion = (string) $cuestion['puntuacion'];

                    $cref = new Cuestion_corta();
                    $cref->setPregunta($enunciado);
                    $cref->setPuntuacion($puntuacion);
                    $array_cuestiones[] = $cref;

                    $solucion = (string) $cuestion->solucion;
                    $sref = new Respuesta_cuestion_corta();
                    $sref->setRespuesta($solucion);
                    $array_soluciones[] = $sref;
                  break;

                  case 'problemas':
                    $enunciado = (string) $cuestion->pregunta;
                    $puntuacion = (string) $cuestion['puntuacion'];

                    $cref = new Cuestion_practica();
                    $cref->setContenidoLatex($enunciado);
                    $cref->setPuntuacion($puntuacion);
                    $array_cuestiones[] = $cref;
                  break;
                  default: break;
                }
              }
              // Bucle2
              switch ($tipo) {
                case 'test':
                  $ejercicio->save();
                  $solucion_ejercicio->setIdEjercicio($ejercicio->getId());
                  $solucion_ejercicio->save();
                  $ejercicio->setIdSolucion($solucion_ejercicio->getId());
                  $ejercicio->save();

                  $index1 = 0;
                  foreach ($array_cuestiones as $cref) {
                    $cref->setIdEjercicio($ejercicio->getId());
                    $cref->save();

                    // Procesamiento de expresiones matematicas
                    if ($expmat) {
                      $this->crearExpMat(1, 't', $cref->getId(), $cref->getPregunta());
                    }
                    for ($index2 = 0; $index2 < $numero_respuestas_test; $index2++) {
                      $rref = $array_soluciones["$index1.$index2"];
                      $rref->setIdCuestionTest($cref->getId());
                      $rref->save();

                      if ($rref->getCorrecta()) {
                        $sref = new Seleccion_cuestion_test();
                        $sref->setIdEjercicioResuelto($solucion_ejercicio->getId());
                        $sref->setIdRespuestaCuestionTest($rref->getId());
                        $sref->save();
                      }
                      // Procesamiento de expresiones matematicas
                      if ($expmat) {
                        $this->crearExpMat(0, 't', $rref->getId(), $rref->getRespuesta());
                      }
                    }
                    $index1++;
                  }
                break;

                case 'cuestionario':
                  // Guardamos el ejercicio y sus preguntas si todo fue bien
                  $ejercicio->save();
                  $solucion_ejercicio->setIdEjercicio($ejercicio->getId());
                  $solucion_ejercicio->save();
                  $ejercicio->setIdSolucion($solucion_ejercicio->getId());
                  $ejercicio->save();

                  for ($index = 0; $index < sizeof($array_cuestiones); $index++) {
                    $cref = $array_cuestiones[$index];
                    $cref->setIdEjercicio($ejercicio->getId());
                    $cref->save();

                    $sref = $array_soluciones[$index];
                    $sref->setIdCuestionCorta($cref->getId());
                    $sref->setIdEjercicioResuelto($solucion_ejercicio->getId());
                    $sref->save();

                    // Procesamiento de expresiones matematicas
                    if ($expmat) {
                      $this->crearExpMat(1, 'c', $cref->getId(), $cref->getPregunta());
                      $this->crearExpMat(0, 'c', $sref->getId(), $sref->getRespuesta());
                    }
                  }
                break;

                case 'problemas':
                  // Guardamos el ejercicio y sus preguntas si todo fue bien
                  $ejercicio->save();
                  $solucion_ejercicio->setIdEjercicio($ejercicio->getId());
                  $solucion_ejercicio->save();
                  $ejercicio->setIdSolucion($solucion_ejercicio->getId());
                  $ejercicio->save();

                  for ($index = 0; $index < sizeof($array_cuestiones); $index++) {
                    $cref = $array_cuestiones[$index];
                    $cref->setIdEjercicio($ejercicio->getId());
                    $cref->save();

                    // Procesamiento de expresiones matematicas
                    if ($expmat) {
                      $this->crearExpMat(1, 'p', $cref->getId(), $cref->getContenidoLatex());
                    }
                  }
                break;
                default: break;
              }
              $mensaje_importar = '<strong>El ejercicio "'.$ejercicio->getTitulo().'" importado satisfactoriamente</strong>';
              $this->ejercicio = $ejercicio; // necesario para los test
            }
        }
    }
    $c = new Criteria();
    $this->materias = MateriaPeer::DoSelect($c);
    $this->errors = $this->errors;
    $this->mensaje_importar = $mensaje_importar;
  }

  /*
   *  Nombre del metodo: executeImportarEjercicios()
   *  Autor: Angel Martin
   *  Descripcion: Lista ejercicios para administracion
   */
  public function executeExportarEjercicio()
  {
    $this->setLayout(false);
    $id_ejercicio = $this->getRequestParameter('id');
    $ejercicio = EjercicioPeer::RetrieveByPk($id_ejercicio);
    $id_solucion = $ejercicio->getIdSolucion();

    if ($ejercicio->getNombreAutor()) {
      $nombre_autor = $ejercicio->getNombreAutor();
    } else {
      $autor = UsuarioPeer::RetrieveByPk($ejercicio->getIdAutor());
      $nombre_autor = $autor->getNombre().' '.$autor->getApellidos();
    }
    $tipo = $ejercicio->getTipo();
    $titulo = $ejercicio->getTitulo();
    $testmultiple = $ejercicio->getTestMultiple();
    $testresta = $ejercicio->getTestResta();
    $solucion = $ejercicio->getSolucion();
    $numerorespuestas = $ejercicio->getNumeroRespuestas();
    $expmat = $ejercicio->getExpresionesMatematicas();
    $numhojas = $ejercicio->getNumeroHojas();
    $xml = "<ejercicio nombre_autor=\"$nombre_autor\" tipo=\"$tipo\" titulo=\"$titulo\" test_multiple=\"$testmultiple\" test_resta=\"$testresta\" numero_respuestas=\"$numerorespuestas\" solucion=\"$solucion\" expresiones_matematicas=\"$expmat\" numero_hojas=\"$numhojas\">\n";

    // PARTE DE CUESTIONARIO
    $c = new Criteria();
    $c->add(Cuestion_cortaPeer::ID_EJERCICIO, $id_ejercicio);
    $cuestiones = Cuestion_cortaPeer::DoSelect($c);

    foreach ($cuestiones as $cuestion) {
      $pregunta = $cuestion->getPregunta();
      $puntuacion = $cuestion->getPuntuacion();
      $xml .= "<cuestion puntuacion=\"$puntuacion\">\n";
      $xml .= "<pregunta>$pregunta</pregunta>\n";

      if ($id_solucion) {
        $c2 = new Criteria();
        $c2->add(Respuesta_cuestion_cortaPeer::ID_EJERCICIO_RESUELTO, $id_solucion);
        $c2->add(Respuesta_cuestion_cortaPeer::ID_CUESTION_CORTA, $cuestion->getId());
        $respuesta = Respuesta_cuestion_cortaPeer::DoSelectOne($c2);
        $xml .= "<solucion>".$respuesta->getRespuesta()."</solucion>\n";
      }
      $xml .= "</cuestion>\n";
    }
    // PARTE DE TEST
    $c = new Criteria();
    $c->add(Cuestion_testPeer::ID_EJERCICIO, $id_ejercicio);
    $cuestiones = Cuestion_testPeer::DoSelect($c);

    foreach ($cuestiones as $cuestion) {
      $pregunta = $cuestion->getPregunta();
      $ncorrectas = $cuestion->getNumeroRespuestasCorrectas();
      $nincorrectas = $cuestion->getNumeroRespuestasIncorrectas();
      $xml .= "<cuestion ncorrectas=\"$ncorrectas\" nincorrectas=\"$nincorrectas\">\n";
      $xml .= "<pregunta>$pregunta</pregunta>\n";
      $xml .= "<respuestas>\n";

      $c2 = new Criteria();
      $c2->add(Respuesta_cuestion_testPeer::ID_CUESTION_TEST, $cuestion->getId());
      $respuestas = Respuesta_cuestion_testPeer::DoSelect($c2);

      foreach ($respuestas as $respuesta) {
        $xml .= "<respuesta correcta=\"".$respuesta->getCorrecta()."\">";
        $xml .= $respuesta->getRespuesta();
        $xml .= "</respuesta>\n";
      }
      $xml .= "</respuestas>\n";
      $xml .= "</cuestion>\n";
    }
    // PARTE DE PROBLEMAS
    $c = new Criteria();
    $c->add(Cuestion_practicaPeer::ID_EJERCICIO, $id_ejercicio);
    $cuestiones = Cuestion_practicaPeer::DoSelect($c);

    foreach ($cuestiones as $cuestion) {
      $pregunta = $cuestion->getContenidoLatex();
      $puntuacion = $cuestion->getPuntuacion();
      $xml .= "<cuestion puntuacion=\"$puntuacion\">\n";
      $xml .= "<pregunta>$pregunta</pregunta>\n";
      $xml .= "</cuestion>\n";
    }
    $xml.="</ejercicio>";

    $id_usuario = $this->getUser()->getAnyId();
    $this->xml = $xml;
    $nombre = $ejercicio->getTitulo();

    if (strlen($nombre) > 20) {
      $nombre = substr($nombre, 0, 20);
    }
    $this->nombre = $nombre;
  }

  // Nombre del metodo: executeUsuarios()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Lista todos los usuarios confirmados de la plataforma*/

  public function executeUsuarios()
  {
    $c = new Criteria();
    $busqueda = 0;

    if ($this->getRequestParameter('superUsuario')) {
      $this->superUsuario = '1';
      $criterion1 = $c->getNewCriterion(RolPeer::NOMBRE, 'administrador');
      $criterion2 = $c->getNewCriterion(RolPeer::NOMBRE, 'supervisor');
      $criterion1->addOr($criterion2);
      $c->add($criterion1);
      $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    }
    // Si venimos de una busqueda...
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
      $tipo = $this->getRequestParameter('tipo');
      $criterion_array = array();

      if ($this->getRequestParameter('usuario')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBREUSUARIO,"%".$this->getRequestParameter('usuario')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('dni')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('nombre')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('apellidos')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('email')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      // En esta parte se mezclan todas las condiciones segun el criterio AND u OR
      if (sizeof($criterion_array)) {
        $cref = array_pop($criterion_array);
        if ($tipo == 'Or') {
          foreach ($criterion_array as $caux) { $cref->addOr($caux); }
        } else {
          foreach ($criterion_array as $caux) { $cref->addAnd($caux); }
        }
        $c->add($cref);
      }
      $busqueda = 1;
    }
    $c->add(UsuarioPeer::CONFIRMADO,'1');
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO, 'LEFT JOIN');

    $c->addDescendingOrderByColumn(Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $c->addGroupByColumn(UsuarioPeer::ID);
    $this->busqueda = $busqueda;
    $this->usuarios = UsuarioPeer::DoSelect($c);
  }

  /***************************************
   ** Lista todos los cursos y paquetes **
   ** para poder gestionarlos           **
   **************************************/
  public function executeCursos()
  {
      $c = new Criteria();
	    $this->cursos = CursoPeer::doSelect($c);
      return;
  }

  // Nombre del metodo: executeNuevoCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra el formulario de creacion de curso o bien inserta e inicializa el curso dado*/

  public function executeNuevoCurso()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
    	  $fechaInicio = $this->getRequestParameter('fechaInicio');
        $fechaFin = $this->getRequestParameter('fechaFin');
        list($diaInicio,$mesInicio, $anioInicio) = split("[-]", $fechaInicio);
        list($diaFin,$mesFin, $anioFin) = split("[-]", $fechaFin);
        $fechaInicio = $anioInicio."-".$mesInicio."-".$diaInicio;
        $fechaFin = $anioFin."-".$mesFin."-".$diaFin;
        $materia = MateriaPeer::RetrieveByPk($this->getRequestParameter('materia_id'));

        $con = Propel::getConnection();
  			try {
    			    $con->begin();
    	  	    $curso = new Curso();
           		$curso->setNombre($this->getRequestParameter('nombre'));
           		$curso->setFechaInicio($fechaInicio." 00:00:00");
           		$curso->setFechaFin($fechaFin." 00:00:00");
				      $curso->setScan($this->getRequestParameter('scan'));
           		$curso->setDuracion($this->getRequestParameter('duracion'));
           		$curso->setPrecio($this->getRequestParameter('precio'));
           		$curso->setMateriaId((int)$this->getRequestParameter('materia_id'));
  		        $curso->setMenuInfo((int)$this->getRequestParameter('menu_info'));
  		        $curso->setMenuTemario((int)$this->getRequestParameter('menu_temario'));
      				$curso->setMenuBiblio((int)$this->getRequestParameter('menu_biblio'));
              $curso->setMenuBibliotecaArchivos((int)$this->getRequestParameter('menu_biblio_archivos'));
      				$curso->setMenuSeguimiento((int)$this->getRequestParameter('menu_seguimiento'));
      				$curso->setMenuEventos((int)$this->getRequestParameter('menu_eventos'));
      				$curso->setMenuChat((int)$this->getRequestParameter('menu_chat'));
      				$curso->setMenuForo((int)$this->getRequestParameter('menu_foro'));
      				$curso->setMenuEjercicios((int)$this->getRequestParameter('menu_ejercicios'));
      				if ($materia->getTipo() == 'compo') {$curso->setMenuPlanificacionAlumnos(0);}
      				$modalidad = $this->getRequestParameter('modalidad');
      				if ($modalidad == 'mensual') {$curso->setMensual(1);}
      				else {$curso->setMensual(0);}
           		$curso->save($con);

    				  $strname= new sfSimpleForumTools();
    					$foro = new sfSimpleForumForum();
    					$foro->setName($this->getRequestParameter('nombre'));
    					$foro->setCursoId($curso->getId());
    					$foro->setStrippedName($strname->stripText($this->getRequestParameter('nombre')));
    					$foro->setDescription("Foro del curso ".$this->getRequestParameter('nombre'));
    					$foro->save($con);

    					$administradores= $this->getUser()->getAdministradores();

	            foreach ($administradores as $administrador) {
	            	  $notificacion = new Notificacion();
    	           $notificacion->setInfo($administrador->getId(),$curso->getId(),'Nuevo Curso','Creaci&oacute;n del curso: <b>'.$curso->getNombre().'</b> por '.$this->getUser()->getAdministrador()->getNombreusuario(),date("Y-m-d H:j"));
    	        }
    					$con->commit();
          }
  			catch (Exception $e) {
  					$con->rollback();
    				throw $e;
  				}
       $this->mostrarForm = 'No'; // para que en el template no vuelva ha salir el formulario
       $this->curso = $curso;
       return;
    } else {  /* Hay que mostrar el formulario con la lista de cursos */
             $c = new Criteria();
        	   $materias = MateriaPeer::doSelect($c);

             $opciones = array();
             foreach ($materias as $materia) {
                $opciones[$materia->getId()] = $materia->getNombre();
        	   }
        	   $this->opciones = $opciones;

        	   $opcionesScan = array();
        	   $opcionesScan[0]= "No";
        	   $opcionesScan[1]= "Si";

        	   $this->opcionesScan = $opcionesScan;
           }
      return;
  }

 /**
 *
 * @name         validateImagenCurso()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   Valida el formulario de cambio de foto
 */
   public function validateImagenCurso()
  {
   $ok = true ;
 	 if ($this->getRequest()->getMethod() == sfRequest::POST) {
      	$file = $this->getRequest()->getFileName('file');

        if ($this->getRequest()->getFileName('file')) {
           if (".jpg" != substr($file,strlen($file)-4, 4)) {
             $this->getRequest()->setError('Fichero', 'El fichero tiene que ser jpg'); $ok = false ;
            }
         }
    }
   return $ok;
  }

  // Nombre del metodo: executeImagenCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: guarda una imagen del curso para el cartel comercial */
  public function executeImagenCurso()
  {
    if (!$this->getRequestParameter('idcurso')) {
      $this->redirect('admin/cursos');
    }
    $this->curso = CursoPeer::retrieveByPk($this->getRequestParameter('idcurso'));
    $this->forward404Unless($this->curso);

    if ($this->getRequest()->getMethod() == sfRequest::POST) {
          $fileName = $this->getRequest()->getFileName('file');

          if ($fileName) { 
          	$thumbnail = new sfThumbnail(253, 550,false,false,95);
            $thumbnail->loadFile($this->getRequest()->getFilePath('file'));
            $thumbnail->save(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'img_cursos'.DIRECTORY_SEPARATOR.'portada_'.$this->curso->getId().'.jpg', 'image/jpeg');
            @chmod(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'img_cursos'.DIRECTORY_SEPARATOR.'portada_'.$this->curso->getId(),0777);

            $administradores = $this->getUser()->getAdministradores();

      	     foreach ($administradores as $administrador) {  
       	     	  $notificacion = new Notificacion();
          	    $notificacion->setInfo($administrador->getId(),$this->curso->getId(),'Nueva imagen Curso','Eliminada imagen del curso: <b>'.$this->curso->getNombre().'</b> por '.$this->getUser()->getAdministrador()->getNombreusuario(),date("Y-m-d H:i"));
          	 }

          }
       $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
       return;
    } else {    }
      return;
  }

  // Nombre del metodo: executEliminarImagenCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: elimina la imagen del curso*/

  public function executeEliminarImagenCurso()
  {
  	if (!$this->getRequestParameter('idcurso')) { $this->redirect('admin/cursos'); }
    $curso = CursoPeer::retrieveByPk($this->getRequestParameter('idcurso'));
    $this->forward404Unless($curso);

    if (file_exists(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'img_cursos'.DIRECTORY_SEPARATOR.'portada_'.$curso->getId().'.jpg')) {
       unlink(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'img_cursos'.DIRECTORY_SEPARATOR.'portada_'.$curso->getId().'.jpg');

       $administradores= $this->getUser()->getAdministradores();

	     foreach ($administradores as $administrador) {  
	     		$notificacion = new Notificacion();
    	    $notificacion->setInfo($administrador->getId(),$curso->getId(),'Eliminaci&oacute;n imagen Curso','Eliminada imagen del curso: <b>'.$curso->getNombre().'</b> por '.$this->getUser()->getAdministrador()->getNombreusuario(),date("Y-m-d H:j"));
    	 }
    }
    return $this->redirect('admin/cursos');
  }

  /*************************************************
   ** Muestra la lista de alumnos de la plataforma *
   ************************************************/
  public function executeAlumnos()
  {
    $c = new Criteria();
    $busqueda = 0;

    $this->modificar_ejericicio = $this->getRequestParameter('edita-ejercicio',false);
    $idcurso = $this->getRequestParameter('idcurso');
    $idmodulo = $this->getRequestParameter('idmodulo');

    // Si venimos de una busqueda...
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
      $tipo = $this->getRequestParameter('tipo');
      $criterion_array = array();

      if ($this->getRequestParameter('usuario')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBREUSUARIO,"%".$this->getRequestParameter('usuario')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('dni')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('nombre')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('apellidos')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('email')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      // En esta parte se mezclan todas las condiciones segun el criterio AND u OR
      if (sizeof($criterion_array)) {
        $cref = array_pop($criterion_array);

        if ($tipo == 'Or') {
          foreach ($criterion_array as $caux) { $cref->addOr($caux); }
        } else {
          foreach ($criterion_array as $caux) { $cref->addAnd($caux); }
        }
        $c->add($cref);
      }
      $busqueda = 1;
    }
    $curso = null;
    $modulo = null;

    $c->add(RolPeer::NOMBRE, 'alumno');
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $c->addGroupByColumn(UsuarioPeer::ID);

    if ($idcurso) {
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $idcurso);
      $curso = CursoPeer::RetrieveByPk($idcurso);
    }
    if ($idmodulo) {
      $modulo = PaquetePeer::RetrieveByPk($idmodulo);
      unset($c);
      $c = new Criteria();
      $c->add(Rel_usuario_paquetePeer::ID_PAQUETE, $idmodulo);
      $c->addJoin(Rel_usuario_paquetePeer::ID_USUARIO, UsuarioPeer::ID);
    }
    $this->busqueda = $busqueda;
    $this->alumnos = UsuarioPeer::DoSelect($c);
    $this->curso = $curso;
    $this->modulo = $modulo;
  }

  /*************************************************
   ** Muestra la lista de alumnos de la plataforma *
   ************************************************/
  public function executeMorosos()
  {
    $c = new Criteria();
    $busqueda = 0;

    // Si venimos de una busqueda...
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
      $tipo = $this->getRequestParameter('tipo');
      $criterion_array = array();

      if ($this->getRequestParameter('usuario')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBREUSUARIO,"%".$this->getRequestParameter('usuario')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('dni')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('nombre')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('apellidos')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('email')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      // En esta parte se mezclan todas las condiciones segun el criterio AND u OR
      if (sizeof($criterion_array)) {
        $cref = array_pop($criterion_array);
        if ($tipo == 'Or') {
          foreach ($criterion_array as $caux) { $cref->addOr($caux); }
        } else {
          foreach ($criterion_array as $caux) { $cref->addAnd($caux); }
        }
        $c->add($cref);
      }
      $busqueda = 1;
    }
    $c->add(RolPeer::NOMBRE, 'moroso');
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $c->addGroupByColumn(UsuarioPeer::ID);
    $this->busqueda = $busqueda;
    $this->alumnos = UsuarioPeer::DoSelect($c);
  }

  public function executeProfesores()
  {
    $c = new Criteria();
    $busqueda = 0;
    $idcurso = $this->getRequestParameter('idcurso');

    // Si venimos de una busqueda...
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
      $tipo = $this->getRequestParameter('tipo');
      $criterion_array = array();

      if ($this->getRequestParameter('usuario')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBREUSUARIO,"%".$this->getRequestParameter('usuario')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('dni')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('nombre')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('apellidos')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      if ($this->getRequestParameter('email')) {
        $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }
      // En esta parte se mezclan todas las condiciones segun el criterio AND u OR
      if (sizeof($criterion_array)) {
        $cref = array_pop($criterion_array);
        if ($tipo == 'Or') {
          foreach ($criterion_array as $caux) { $cref->addOr($caux); }
        } else {
          foreach ($criterion_array as $caux) { $cref->addAnd($caux); }
        }
        $c->add($cref);
      }
      $busqueda = 1;
    }
    $curso = null;
    $c->add(RolPeer::NOMBRE, 'profesor');
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $c->addGroupByColumn(UsuarioPeer::ID);

    if ($idcurso) {
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $idcurso);
      $curso = CursoPeer::RetrieveByPk($idcurso);
    }
    $this->busqueda = $busqueda;
    $this->curso = $curso;
    $this->profesores = UsuarioPeer::DoSelect($c);
  }

  // Nombre del metodo: executeModulos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Lista todos los paquetes
   */
  public function executeModulos()
  {
    $c = new Criteria(); $this->modulos = PaquetePeer::doSelect($c); return;
  }

  // Nombre del metodo: executeNuevoUsuario()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra el formulario de creacion de un usuario (profesor/alumno)
    			  o bien inserta e inicializa el modulo dado
   */
  public function executeNuevoUsuario()
  {
    $rol = $this->getRequestParameter('rol');
    $inspector = $this->getRequestParameter('inspector',0);            
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
      $nombreusuario= $this->getRequestParameter('usuario');
      $dni= $this->getRequestParameter('dni');
      $nombre = $this->getRequestParameter('nombre');
      $apellidos = $this->getRequestParameter('apellidos');
      $email = $this->getRequestParameter('email');
      $emailstop = $this->getRequestParameter('emailstop');
      $telefono1 = $this->getRequestParameter('telefono');
      $telefono2 = $this->getRequestParameter('telefono2');
      $institucion = $this->getRequestParameter('institucion');
      $departamento = $this->getRequestParameter('departamento');
      $direccion = $this->getRequestParameter('direccion');
      $cp = $this->getRequestParameter('cp');
      $ciudad = $this->getRequestParameter('ciudad');
      $pais = $this->getRequestParameter('pais');

 	    $pwd = ""; substr($nombre,0,3).substr($apellidos,0,3).rand(100,999);
      $this->pwd = $pwd;
      $con = Propel::getConnection();
      try {
        $con->begin();

        $usuario = new Usuario();
        $usuario->setNombre($nombre);
        $usuario->setApellidos($apellidos);
        $usuario->setNombreusuario($nombreusuario);
        $usuario->setDni($dni);
        $usuario->setEmail($email);
        $usuario->setEmailstop($emailstop);
        $usuario->setTelefono1($telefono1);
        $usuario->setTelefono2($telefono2);
        $usuario->setInstitucion($institucion);
        $usuario->setDepartamento($departamento);
        $usuario->setDireccion($direccion);
        $usuario->setCp($cp);
        $usuario->setCiudad($ciudad);
        $usuario->setPaisId($pais);
        $usuario->setPresencial(0);
        $usuario->setInspector($inspector);
        $usuario->emailUsuario(null,3,'confirmacion'); //genera tb el password
        $usuario->setConfirmado(1);
        $usuario->save($con);

        if ("alumno" == $rol) {
          $tipo=0;
        } else {
          $tipo=null;
        }
        $administradores = $this->getUser()->getAdministradores();

        foreach ($administradores as $administrador) {
          $notificacion = new Notificacion();
          $notificacion->setInfo($administrador->getId(),null,'Nuevo '.$rol,'Nuevo '.$rol.' '.$usuario->getNombre().' '.$usuario->getApellidos().' creado por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"),$tipo);
        }
        $cursos = array();
        $pulsados = $this->getRequestParameter('pulsadosCursos');
        $total = $this->getRequestParameter('totalCursos');
        $c = new Criteria();

        $c->add(RolPeer::NOMBRE, $rol);
        $rolh = RolPeer::doSelectOne($c);
        $id_rol = $rolh->getId();

        if (($rol == "administrador") || ($rol == "supervisor")) {
          $c = new Criteria();
          $c->add(CursoPeer::NOMBRE, "vacio");
          $curso = CursoPeer::doSelectOne($c);

          $rel = new Rel_usuario_rol_curso();
          $rel->setIdCurso($curso->getId());
          $rel->setIdRol($id_rol);
          $rel->setIdUsuario($usuario->getId());
          $rel->save($con);
        } else {
          for ( $i=0; $i<$total; $i++ ) {
            $micurso = $this->getRequestParameter("cursos$i");
            if ($micurso) {
              $curso= CursoPeer::retrieveByPk($micurso);
              $this->forward404Unless($curso);

              $rel = new Rel_usuario_rol_curso();
              $rel->setIdCurso($micurso);
              $rel->setIdRol($id_rol);
              $rel->setIdUsuario($usuario->getId());
              $rel->save($con);
            }
          }
        }
        if ($this->getRequestParameter('pulsadosPaquetes')) {
          $pulsados = $this->getRequestParameter('pulsadosPaquetes');
          $total = $this->getRequestParameter('totalPaquetes');

          for ( $i=0;$i<$total;$i++ ) {
            $mipaquete = $this->getRequestParameter("paquetes$i");
            if ( $mipaquete ) {
              $paquete= PaquetePeer::retrieveByPk($mipaquete);
              $this->forward404Unless($paquete);

              $rel = new Rel_usuario_paquete();
              $rel->setIdPaquete($mipaquete);
              $rel->setIdUsuario($usuario->getId());
              $rel->save($con);

              $cursos = $paquete->getCursos();
              foreach($cursos as $curso) {
                $c = new Criteria();
                $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $usuario->getId());
                $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso->getCurso()->getId());

                if (!Rel_usuario_rol_cursoPeer::doSelect($c)) {
                  $rel = new Rel_usuario_rol_curso();
                  $rel->setIdCurso($curso->getCurso()->getId());
                  $rel->setIdRol($id_rol);
                  $rel->setIdUsuario($usuario->getId());
                  $rel->save($con);
				}}}}}
        $con->commit();
      }
      catch (Exception $e) {
        $con->rollback(); throw $e;
      }
      $this->mostrarForm = 'No'; // para que en el template no vuelva ha salir el formulario
      $this->usuario = $usuario; // necesario para las pruebas
    } else {
      /* Hay que mostrar el formulario con la lista de cursos*/
      $this->usuario = new Usuario();

      $c = new Criteria();
      $c->add(CursoPeer::NOMBRE, "vacio", Criteria::NOT_EQUAL);
      $this->cursos = CursoPeer::doSelect($c);

      $c = new Criteria();
      $this->paquetes = PaquetePeer::doSelect($c);

      $c = new Criteria();
      $this->paises = PaisPeer::doselect($c);
      $opcionesPais = array();

      foreach ($this->paises as $pais) {
        $opcionesPais[$pais->getId()]= $pais->getNombre();
      }
      $this->opcionesPais = $opcionesPais;
    }
    $this->rol = $rol;
    $this->inspector = $inspector;
  }

  // Nombre del metodo: executeNuevoModulo()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra el formulario de creacion de modulo
    			  o bien inserta e inicializa el modulo dado
   */
  public function executeNuevoModulo()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
          $j=0;
	        $k=0;
	        $cursos=array();
	        $error=array();
	        $pulsados = $this->getRequestParameter('pulsadosCursos');
	        $total = $this->getRequestParameter('totalCursos');
	        $c = new sfEventCalendar('month', date("Y-m-d"));

	        for ( $i=0;$i<$total;$i++ ) {    
    				$micurso = $this->getRequestParameter("cursos$i");
    				   if ( $micurso ) {
    				    $curso= CursoPeer::retrieveByPk($micurso);
    						$this->forward404Unless($curso);

    						if (!isset($diaInicioPaquete)) {
    							$diaInicioPaquete = $curso->getFechaInicio("d");
    							$mesInicioPaquete = $curso->getFechaInicio("m");
    							$anioInicioPaquete = $curso->getFechaInicio("Y");

    							$diaFinPaquete = $curso->getFechaFin("d");
    							$mesFinPaquete = $curso->getFechaFin("m");
    							$anioFinPaquete = $curso->getFechaFin("Y");
    							$scan= $curso->getScan();
    						   } else {
    							     $scan += $curso->getScan();
    							     $compFechas = $c->getCalendar()->compareDates($curso->getFechaInicio("d"),$curso->getFechaInicio("m"),$curso->getFechaInicio("Y"),
    							                                                   $diaInicioPaquete,$mesInicioPaquete,$anioInicioPaquete);
        			         //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
        			         if (-1==$compFechas) {
        			            $diaInicioPaquete = $curso->getFechaInicio("d");
    							        $mesInicioPaquete = $curso->getFechaInicio("m");
    							        $anioInicioPaquete = $curso->getFechaInicio("Y");
        			          }
        			         $compFechas = $c->getCalendar()->compareDates($curso->getFechaFin("d"),$curso->getFechaFin("m"),$curso->getFechaFin("Y"),
    							                                                   $diaFinPaquete,$mesFinPaquete,$anioFinPaquete);
        			         //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
        			         if (1==$compFechas) {
        			            $diaFinPaquete = $curso->getFechaFin("d");
    							        $mesFinPaquete = $curso->getFechaFin("m");
    							        $anioFinPaquete = $curso->getFechaFin("Y");
        			          }
    						    }
    	          }
	      }
      	if (isset($diaInicioPaquete)) {
              $con = Propel::getConnection();
        			try {
          			  $con->begin();

          			  $modulo = new Paquete();
                 	$modulo->setNombre($this->getRequestParameter('nombre'));
                 	$modulo->setPrecio($this->getRequestParameter('precio'));
                 	$modulo->setFechaInicio($anioInicioPaquete."-".$mesInicioPaquete."-".$diaInicioPaquete);  //2007-08-02 11:58:55
                 	$modulo->setFechaFin($anioFinPaquete."-".$mesFinPaquete."-".$diaFinPaquete);
                 	$modalidad = $this->getRequestParameter('modalidad');

                 	if ($modalidad == 'mensual') {$modulo->setMensual(1);} else {$modulo->setMensual(0);}

                 	$modulo->setScan($scan);
                 	$modulo->setDescripcion($this->getRequestParameter('descripcion'));
          			  $modulo->save($con);

          			  for ( $i=0;$i<$total;$i++ ) {
                    $micurso = $this->getRequestParameter("cursos$i");
      				      if ( $micurso ) {
      				        $curso= CursoPeer::retrieveByPk($micurso);
      						    $this->forward404Unless($curso);
      						    $rel_paquete_curso = new Rel_paquete_curso();
      						    $rel_paquete_curso->setIdCurso($micurso);
      						    $rel_paquete_curso->setIdPaquete($modulo->getId());
      						    $rel_paquete_curso->save($con);
      				      }
      				    }
                 $administradores= $this->getUser()->getAdministradores();

      				   foreach ($administradores as $administrador) {  
      	         		$notificacion = new Notificacion();
          	        $notificacion->setInfo($administrador->getId(),null,'Nuevo m&oacute;dulo','Nuevo m&oacute;dulo '.$modulo->getNombre().' creado por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
          	     }
          			 $con->commit();
                }
        			catch (Exception $e) {	
        					$con->rollback(); throw $e;
        				}
        		  $this->fechaInicio=$diaInicioPaquete."-".$mesInicioPaquete."-".$anioInicioPaquete;
      	      $this->fechaFin=$diaFinPaquete."-".$mesFinPaquete."-".$anioFinPaquete;

      	      if ($scan>0) {
      	        	$this->scan="Si";
      	      } else $this->scan="No";
      }
             $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
             $this->modulo = $modulo; // necesario para test
    } else {
              /* Hay que mostrar el formulario con la lista de cursos*/
              $c = new Criteria();
              $c->add(CursoPeer::NOMBRE, "vacio", Criteria::NOT_EQUAL);
              $this->cursos = CursoPeer::doSelect($c);
          }
    return;
  }

  // Nombre del metodo: actualizaModulos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Si se modifica un curso, mira en que modulos esta y actualiza si hace falta las fechas, webcam, y scan
   */
  private function actualizaModulos($idcurso,$scanAntes,$scanDesp)
  {
      if ($scanAntes==null) {
        	$scanAntes=0;
      }
		  $curso = CursoPeer::retrieveByPk($idcurso);
			$diaInicioCurso = $curso->getFechaInicio("d");
			$mesInicioCurso = $curso->getFechaInicio("m");
			$anioInicioCurso = $curso->getFechaInicio("Y");

			$diaFinCurso = $curso->getFechaFin("d");
			$mesFinCurso = $curso->getFechaFin("m");
			$anioFinCurso = $curso->getFechaFin("Y");

      $c = new sfEventCalendar('month', date("Y-m-d"));

    	$c2 = new Criteria();
			$c2->add(Rel_paquete_cursoPeer::ID_CURSO,$idcurso);
			$results = Rel_paquete_cursoPeer::doSelect($c2);

			foreach($results as $result) {
			    $idmodulo = $result->getPaquete()->getId();
			  	$diaInicioPaquete = $result->getPaquete()->getFechaInicio("d");
					$mesInicioPaquete = $result->getPaquete()->getFechaInicio("m");
					$anioInicioPaquete = $result->getPaquete()->getFechaInicio("Y");

					$diaFinPaquete = $result->getPaquete()->getFechaFin("d");
					$mesFinPaquete = $result->getPaquete()->getFechaFin("m");
					$anioFinPaquete = $result->getPaquete()->getFechaFin("Y");

					$compFechas = $c->getCalendar()->compareDates($diaInicioCurso,$mesInicioCurso,$anioInicioCurso,
							                                         $diaInicioPaquete,$mesInicioPaquete,$anioInicioPaquete);
    			//Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
    			if (-1==$compFechas) {
    			   //actualizar fecha inicio paquete
		        $con = Propel::getConnection();
						$c1 = new Criteria();
						$c1->add(PaquetePeer::ID, $idmodulo );

						$c2 = new Criteria();
						$c2->add(PaquetePeer::FECHA_INICIO, $curso->getFechaInicio());
	          BasePeer::doUpdate($c1, $c2, $con);
    		   }
    			 $compFechas = $c->getCalendar()->compareDates($diaFinCurso,$mesFinCurso,$anioFinCurso, $diaFinPaquete,$mesFinPaquete,$anioFinPaquete);

    			 //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
 			     if (1==$compFechas) {
    			      //actualizar fecha fin paquete
    			      $con = Propel::getConnection();
    						$c1 = new Criteria();
    						$c1->add(PaquetePeer::ID, $idmodulo );

    						$c2 = new Criteria();
    						$c2->add(PaquetePeer::FECHA_FIN, $curso->getFechaFin());
    	        	BasePeer::doUpdate($c1, $c2, $con);
           }
    			 $scan =  $scanDesp - $scanAntes ;

    			 if (0!=$scan) {
    			    $modulo = PaquetePeer::retrieveByPk($idmodulo);
    			    $con = Propel::getConnection();
					  	$c1 = new Criteria();
						  $c1->add(PaquetePeer::ID, $idmodulo );

						  $c2 = new Criteria();
						  $c2->add(PaquetePeer::SCAN, $modulo->getScan()+$scan);
	        		BasePeer::doUpdate($c1, $c2, $con);
           }
			}
  }

  // Nombre del metodo: executeModificarCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Modifica la informacion de un curso
   */
  public function executeModificarCurso()
  {
      $idcurso = $this->getRequestParameter('idcurso');
	    $this->curso = CursoPeer::retrieveByPk($idcurso);
	    $this->forward404Unless($this->curso);

		$scanAntes = $this->curso->getScan();

	     if ($this->getRequest()->getMethod() == sfRequest::POST) {
          $con = Propel::getConnection();

         	try {
      			 $con->begin();
             $this->curso->setNombre($this->getRequestParameter('nombre'));
  			     $this->curso->setFechaInicio($this->getRequestParameter('fechaInicio'));
  			     $this->curso->setFechaFin($this->getRequestParameter('fechaFin'));
				     $this->curso->setScan($this->getRequestParameter('scan'));
  			     $this->curso->setDuracion($this->getRequestParameter('duracion'));
  			     $this->curso->setPrecio($this->getRequestParameter('precio'));
             $this->curso->setMenuBibliotecaArchivos($this->getRequestParameter('menu_biblio_archivos'));
    				 $this->curso->setMenuInfo($this->getRequestParameter('menu_info'));
    				 $this->curso->setMenuBiblio($this->getRequestParameter('menu_biblio'));
    				 $this->curso->setMenuTemario($this->getRequestParameter('menu_temario'));
    				 $this->curso->setMenuSeguimiento($this->getRequestParameter('menu_seguimiento'));
    				 $this->curso->setMenuEventos($this->getRequestParameter('menu_eventos'));
    				 $this->curso->setMenuChat($this->getRequestParameter('menu_chat'));
    				 $this->curso->setMenuForo($this->getRequestParameter('menu_foro'));
    				 $this->curso->setMenuEjercicios($this->getRequestParameter('menu_ejercicios'));
   			     $this->curso->setMateriaId($this->getRequestParameter('materia_id'));
             $modalidad = $this->getRequestParameter('modalidad');

             if ($modalidad == 'mensual') {$this->curso->setMensual(1);} else {$this->curso->setMensual(0);}

             $this->curso->save($con);
             $administradores= $this->getUser()->getAdministradores();

      	     foreach ($administradores as $administrador) {  
       	     		$notificacion = new Notificacion();
          	    $notificacion->setInfo($administrador->getId(),$this->curso->getId(),'Modifiaci&oacute;n Curso','Modificado curso: <b>'.$this->curso->getNombre().'</b> por '.$this->getUser()->getAdministrador()->getNombreusuario(),date("Y-m-d H:j"));
          	 }
      			 $con->commit();
  				}
  			catch (Exception $e) {
  				$con->rollback(); throw $e;
  			}
		    self::actualizaModulos($idcurso,$scanAntes,$this->getRequestParameter('scan'));

		    $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
		    return;

      } else {
			/* Hay que mostrar el formulario con la lista de materias */
			$c = new Criteria();
			$materias = MateriaPeer::doSelect($c);
			$opciones = array();

			foreach ($materias as $materia) {
			  $opciones[$materia->getId()] = $materia->getNombre();
			}
			$this->opciones = $opciones;

			$opcionesScan = array();
			$opcionesScan[0]= "No";
			$opcionesScan[1]= "Si";

			$this->opcionesScan = $opcionesScan;
     }
     return;
  }

  // Nombre del metodo: executeModificarModulo()
  // Añadida por: Jacobo Chaquet
  // Descripcion: Modifica la informacion de un curso
  public function executeModificarModulo()
  {
      $idmodulo = $this->getRequestParameter('idmodulo');
	    $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
	    $this->forward404Unless($this->modulo);

	     if ($this->getRequest()->getMethod() == sfRequest::POST) {
          $j=0;
	        $k=0;
	        $cursos=array();
	        $pulsados = $this->getRequestParameter('pulsadosCursos');
	        $total = $this->getRequestParameter('totalCursos');

	        $c = new sfEventCalendar('month', date("Y-m-d"));

	        for ( $i=0;$i<$total;$i++ ) {  
				  	$micurso = $this->getRequestParameter("cursos$i");

  				   if ( $micurso ) {
    				    $curso= CursoPeer::retrieveByPk($micurso);
    						$this->forward404Unless($curso);

    						if (!isset($diaInicioPaquete)) {
        							$diaInicioPaquete = $curso->getFechaInicio("d");
        							$mesInicioPaquete = $curso->getFechaInicio("m");
        							$anioInicioPaquete = $curso->getFechaInicio("Y");
        							$diaFinPaquete = $curso->getFechaFin("d");
        							$mesFinPaquete = $curso->getFechaFin("m");
        							$anioFinPaquete = $curso->getFechaFin("Y");
        							$scan= $curso->getScan();
        				} else {
    							     $scan += $curso->getScan();
    							     $compFechas = $c->getCalendar()->compareDates($curso->getFechaInicio("d"),$curso->getFechaInicio("m"),$curso->getFechaInicio("Y"),
    							                                                $diaInicioPaquete,$mesInicioPaquete,$anioInicioPaquete);
        			         //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
        			         if (-1==$compFechas) {
        			            $diaInicioPaquete = $curso->getFechaInicio("d");
    							        $mesInicioPaquete = $curso->getFechaInicio("m");
    							        $anioInicioPaquete = $curso->getFechaInicio("Y");
        			           }
        			          $compFechas = $c->getCalendar()->compareDates($curso->getFechaFin("d"),$curso->getFechaFin("m"),$curso->getFechaFin("Y"),
    							                                                $diaFinPaquete,$mesFinPaquete,$anioFinPaquete);
        			          //Return: 0 on equality, 1 if date 1 is greater, -1 if smaller
        			          if (1==$compFechas) {
        			            $diaFinPaquete = $curso->getFechaFin("d");
    							        $mesFinPaquete = $curso->getFechaFin("m");
    							        $anioFinPaquete = $curso->getFechaFin("Y");
        			           }
    						    }
	             }
	     }
	        if (isset($diaInicioPaquete)) {
           $con = Propel::getConnection();
  			   try {
          			$con->begin();

      			    $c1 = new Criteria();
      			    $c1->add(PaquetePeer::ID, $idmodulo);
                $modalidad = $this->getRequestParameter('modalidad');
                if ($modalidad == 'mensual') {$mensual = 1;}
                else {$mensual = 0;}
      			    $c2 = new Criteria();
      			    $c2->add(PaquetePeer::NOMBRE, $this->getRequestParameter('nombre'));
      			    $c2->add(PaquetePeer::FECHA_INICIO, $anioInicioPaquete."-".$mesInicioPaquete."-".$diaInicioPaquete);
      				  $c2->add(PaquetePeer::FECHA_FIN, $anioFinPaquete."-".$mesFinPaquete."-".$diaFinPaquete);
      				  $c2->add(PaquetePeer::PRECIO, $this->getRequestParameter('precio'));
      				  $c2->add(PaquetePeer::MENSUAL, $mensual);
      				  $c2->add(PaquetePeer::SCAN, $scan);
      				  $c2->add(PaquetePeer::DESCRIPCION, $this->getRequestParameter('descripcion'));

      	        BasePeer::doUpdate($c1, $c2, $con);

                $criteria = new Criteria();
        			  $criteria->add(Rel_paquete_cursoPeer::ID_PAQUETE,$idmodulo);
        			  Rel_paquete_cursoPeer::doDelete($criteria);

          			for ( $i=0;$i<$total;$i++ ) {  
      				    	$micurso = $this->getRequestParameter("cursos$i");
      				       if ( $micurso ) {
                        $curso= CursoPeer::retrieveByPk($micurso);
      						      $this->forward404Unless($curso);
      							    $rel_paquete_curso = new Rel_paquete_curso();
      						      $rel_paquete_curso->setIdCurso($micurso);
      						      $rel_paquete_curso->setIdPaquete($idmodulo);
      						      $rel_paquete_curso->save($con);
      						    }
      				    }
 				     	  $administradores= $this->getUser()->getAdministradores();

                foreach ($administradores as $administrador) {  
                	$notificacion = new Notificacion();
                   $notificacion->setInfo($administrador->getId(),null,'M&oacute;dulo modificado','M&oacute;dulo modificado '.$this->modulo->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
                }
          			$con->commit();
            }
  			   catch (Exception $e)
  				    {	$con->rollback(); throw $e;
  				    }
  			   $this->fechaInicio=$diaInicioPaquete."-".$mesInicioPaquete."-".$anioInicioPaquete;
	         $this->fechaFin=$diaFinPaquete."-".$mesFinPaquete."-".$anioFinPaquete;

	         if ($scan>0) {
              $this->scan="Si";
	           } else $this->scan="No";

       }
         $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
       } else {
	                $this->cursosActuales = $this->modulo->getRel_paquete_cursosJoinCurso();
            	    $c2 = new Criteria();
            	    $criterion1 = $c2->getNewCriterion(CursoPeer::NOMBRE, "vacio",Criteria::NOT_EQUAL);

            	    foreach($this->cursosActuales as $cursosActual) {
            	         $criterion2 = $c2->getNewCriterion(CursoPeer::ID, $cursosActual->getCurso()->getId(),Criteria::NOT_EQUAL);
            	    	   $criterion1->addAnd($criterion2);
            	      }
            	     $c2->add($criterion1);
            	     $this->restosCursos = CursoPeer::doSelect($c2);
              }
  return;
  }

  // Nombre del metodo: executeListarCursosAlumno()
  // Añadida por: Angel Martin Latasa
  /* Descripcion: Muestra los cursos de un alumno
   */
  public function executeListarCursosAlumno()
  {
    $idusuario = $this->getRequestParameter('idusuario');
    $this->modificar_ejericicio = $this->getRequestParameter('edita-ejercicio',false);
    if ($this->hasRequestParameter('moroso')) {
      $usuario = UsuarioPeer::RetrieveByPk($idusuario);
      $moroso = $this->getRequestParameter('moroso');
      $idcurso = $this->getRequestParameter('idcurso');
      $curso = CursoPeer::RetrieveByPk($idcurso);

      $con = Propel::getConnection();
      try {
        $con->begin();

        if ($moroso == 'no') {
        $usuario->setMoroso( $usuario->getMoroso() - 1 );
        $usuario->save($con);

        $c = new Criteria();
        $c->add(RolPeer::NOMBRE, "alumno");
        $rol = RolPeer::doSelectOne($c);
        $id_rol = $rol->getId();

        $c2 = new Criteria();
        $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
        $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$idcurso);

        $resul = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
        $resul->setIdRol($id_rol);
        $resul->save($con);

        $administradores = $this->getUser()->getAdministradores();
        foreach ($administradores as $administrador) {
          $notificacion = new Notificacion();
          $notificacion->setInfo($administrador->getId(),$idcurso,'Reanudado el acceso '.$usuario->getNombreusuario(),'Reanudado el acceso a '.$usuario->getNombre().' '.$usuario->getApellidos().' en el curso '.$curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
        }
        } else {
          if ($moroso == 'si') {
            $usuario->setMoroso( $usuario->getMoroso() + 1 );
            $usuario->save($con);

            $c = new Criteria();
            $c->add(RolPeer::NOMBRE, "moroso");
            $rol = RolPeer::doSelectOne($c);
            $id_rol = $rol->getId();

            $c2 = new Criteria();
            $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
            $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$idcurso);

            $resul = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
            $resul->setIdRol($id_rol);
            $resul->save($con);

            $administradores = $this->getUser()->getAdministradores();

            foreach ($administradores as $administrador) {
              $notificacion = new Notificacion();
              $notificacion->setInfo($administrador->getId(),$idcurso,'Prohibido el acceso '.$usuario->getNombreusuario(),'Prohibido el acceso a '.$usuario->getNombre().' '.$usuario->getApellidos().' en el curso '.$curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
            }
          }
        }
        $con->commit();
      }
      catch (Exception $e) { $con->rollback(); throw $e; }
    }
    if ($this->hasRequestParameter('delcurso')) {
      $idcurso = $this->getRequestParameter('delcurso');

      $c = new Criteria();
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$idcurso);
      $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO,$idusuario);
      $rel = Rel_usuario_rol_cursoPeer::doSelectOne($c);
      $rolh = RolPeer::RetrieveByPk($rel->getIdRol());
      $rol = $rolh->getNombre();
      $usuario = UsuarioPeer::RetrieveByPk($rel->getIdUsuario());
      $curso = CursoPeer::RetrieveByPk($idcurso);

      Rel_usuario_rol_cursoPeer::doDelete($c);

      $administradores= $this->getUser()->getAdministradores();
      foreach ($administradores as $administrador) {
        $notificacion = new Notificacion();
        $notificacion->setInfo($administrador->getId(),$idcurso,'Eliminado '.$rol.' '.$usuario->getNombreusuario().' de curso','Eliminado '.$rol.' '.$usuario->getNombre().' '.$usuario->getApellidos().' del curso '.$curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
      }
    }
    $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
    $this->forward404Unless($this->usuario);

    $cursosNoMoroso = $this->usuario->getCursosAlumno();
    $cursosMoroso = $this->usuario->getCursosMoroso();
    $this->cursos = array_merge($cursosNoMoroso, $cursosMoroso);
  }

  // Nombre del metodo: executeListarCursosProfesor()
  // Añadida por: Angel Martin Latasa
  /* Descripcion: Muestra los cursos que imparte un profesor
   */
  public function executeListarCursosProfesor()
  {
    $idusuario = $this->getRequestParameter('id');

    if ($this->hasRequestParameter('delcurso')) {
      $idcurso = $this->getRequestParameter('delcurso');

      $c = new Criteria();
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$idcurso);
      $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO,$idusuario);
      $rel = Rel_usuario_rol_cursoPeer::doSelectOne($c);
      $rolh = RolPeer::RetrieveByPk($rel->getIdRol());
      $rol = $rolh->getNombre();
      $usuario = UsuarioPeer::RetrieveByPk($rel->getIdUsuario());
      $curso = CursoPeer::RetrieveByPk($idcurso);

      Rel_usuario_rol_cursoPeer::doDelete($c);

      $administradores= $this->getUser()->getAdministradores();
      foreach ($administradores as $administrador) {
        $notificacion = new Notificacion();
        $notificacion->setInfo($administrador->getId(),$idcurso,'Eliminado '.$rol.' '.$usuario->getNombreusuario().' de curso','Eliminado '.$rol.' '.$usuario->getNombre().' '.$usuario->getApellidos().' del curso '.$curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
      }
    }
    $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
    $this->forward404Unless($this->usuario);
    $this->cursos = $this->usuario->getCursosProfesor();
  }

  // Nombre del metodo: executeListaModulos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra los modulos en que esta matriculado un usuario
   */
  public function executeListaModulos()
  {
     $idusuario = $this->getRequestParameter('idusuario');
     $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
	   $this->forward404Unless($this->usuario);

     $this->rol = $this->getRequestParameter('rol');
     $this->modulos = $this->usuario->getPaquetes();
  }

  // Nombre del metodo: eliminarUsuario()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Elimina un usuario
   */
  public function executeEliminarUsuario()
  {
    $idusuario = $this->getRequestParameter('idusuario');
    $usuario = UsuarioPeer::retrieveByPk($idusuario);
    $this->forward404Unless($usuario);

    if (($usuario->getNombreusuario() != 'admin') && ($usuario->getNombreusuario() != 'supervisor')) {
      $c = new Criteria();
      $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
      Rel_usuario_rol_cursoPeer::DoDelete($c);

      $imagen = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'fotos_usuarios'.DIRECTORY_SEPARATOR.$idusuario.'_foto.jpg';
      if (file_exists($imagen)) {
        @unlink($imagen);
      }
      $administradores= $this->getUser()->getAdministradores();
      foreach ($administradores as $administrador) {  
      	$notificacion = new Notificacion();
        $notificacion->setInfo($administrador->getId(),null,'Eliminado usuario','Eliminado usuario '.$usuario->getNombre().' '.$usuario->getApellidos().'('.$usuario->getNombreusuario().') por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
      }
      $usuario->delete();
    }
    $rol = $this->getRequestParameter('rol');

    if ("profesor" == $rol) {
      $this->redirect('admin/profesores');
    } else{ 
    			 if ("alumno" == $rol) {  
           	$this->redirect('admin/alumnos');
           } else {
           		if ($this->getRequestParameter('superUsuario')) { $this->redirect('admin/usuarios?superUsuario=1'); } else $this->redirect('admin/usuarios');
           }
          }
  }

 /**
 *
 * @name         executeConfirmarUsuario()
 * @access       public
 * @author       Jacobo Chaquet
 * @deprecated   confirma al usuario
 */
  public function executeConfirmarUsuario()
  {
    $idusuario = $this->getRequestParameter('idusuario');
    $usuario = UsuarioPeer::retrieveByPk($idusuario);
    $this->forward404Unless($usuario);

    $usuario->emailUsuario(null,3,'confirmacion');

    $administradores= $this->getUser()->getAdministradores();
    foreach ($administradores as $administrador) {  
    	 $notificacion = new Notificacion();
       $notificacion->setInfo($administrador->getId(),null,'Usuario confirmado '.$usuario->getNombreusuario(),'Usuario confirmado '.$usuario->getNombre().' '.$usuario->getApellidos().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
    }
    $this->redirect('admin/index');
  }

  // Nombre del metodo: eliminarCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Elimina un curso si no tiene alumnos
   */
  public function executeEliminarCurso()
  {
     $idcurso = $this->getRequestParameter('idcurso');
     $this->curso = CursoPeer::retrieveByPk($idcurso);
     $this->forward404Unless($this->curso);

     if ($this->curso->vacio()) {
         $administradores= $this->getUser()->getAdministradores();
         foreach ($administradores as $administrador) {  
	            	 $notificacion = new Notificacion();
    	           $notificacion->setInfo($administrador->getId(),null,'Curso Eliminado','Curso borrado: <b>'.$this->curso->getNombre().'</b> por '.$this->getUser()->getAdministrador()->getNombreusuario(),date("Y-m-d H:j"));
    	        }
         $this->curso->delete();
     }else {//echo "No se puede borrar tiene alumnos inscritos";
            if ($this->getRequestParameter('forzar')) {
              $this->curso->eliminarAll();
            }else  return sfView::ALERT;
           }
     $this->redirect('admin/cursos');
  }

  // Nombre del metodo: eliminarModulo()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Elimina un modulo si no tiene alumnos
   */
  public function executeEliminarModulo()
  {
   $idmodulo = $this->getRequestParameter('idmodulo');
   $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
   $this->forward404Unless($this->modulo);

   if ($this->modulo->estaVacio()) {
   	  $administradores= $this->getUser()->getAdministradores();

      foreach ($administradores as $administrador) {  
      	 $notificacion = new Notificacion();
         $notificacion->setInfo($administrador->getId(),null,'M&oacute;dulo eliminado','M&oacute;dulo eliminado'.$this->modulo->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
      }
      $this->modulo->eliminarAll();
   }else { if ($this->getRequestParameter('forzar'))
            {
              $this->modulo->eliminarAll();
            }else  return sfView::ALERT;
         }
   $this->redirect('admin/modulos');
  }

  // Nombre del metodo: executeEliminarCursoUsuario()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Elimina un curso a un usuario
   */
  public function executeEliminarCursoUsuario()
  {
     $idusuario = $this->getRequestParameter('idusuario');
     $usuario = UsuarioPeer::retrieveByPk($idusuario);
     $this->forward404Unless($usuario);

     $idcurso = $this->getRequestParameter('idcurso');
     $curso = CursoPeer::retrieveByPk($idcurso);
     $this->forward404Unless($curso);

     $rol = $this->getRequestParameter('rol');

     $c = new Criteria();
     if ("profesor"==$rol)
  	   { 	   $c->add(RolPeer::NOMBRE, "profesor");}
     else	$c->add(RolPeer::NOMBRE, "alumno");

     $su_rol = RolPeer::doSelectOne($c);
     $id_rol = $su_rol->getId();

     $c = new Criteria();
     $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$idcurso);
     $c->add(Rel_usuario_rol_cursoPeer::ID_ROL,$id_rol);
     $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO,$idusuario);

     $res = Rel_usuario_rol_cursoPeer::doDelete($c);

     $administradores= $this->getUser()->getAdministradores();
     foreach ($administradores as $administrador)
     {  $notificacion = new Notificacion();
        $notificacion->setInfo($administrador->getId(),$idcurso,'Eliminado '.$rol.' '.$usuario->getNombreusuario().' de curso','Eliminado '.$rol.' '.$usuario->getNombre().' '.$usuario->getApellidos().' del curso '.$curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
     }
     $this->redirect('admin/listaCursos?idusuario='.$idusuario.'&rol='.$rol);
  }

 // Nombre del metodo: eliminarModuloUsuario()
 // Añadida por: Jacobo Chaquet
 /* Descripcion: Elimina un curso a un usuario */
  public function executeEliminarModuloUsuario()
  {
     $idusuario = $this->getRequestParameter('idusuario');
     $usuario = UsuarioPeer::retrieveByPk($idusuario);

     $idmodulo = $this->getRequestParameter('idmodulo');
     $modulo = PaquetePeer::retrieveByPk($idmodulo);

     $c = new Criteria();
  	 if ("profesor"==$this->rol)
  	   { 	   $c->add(RolPeer::NOMBRE, "profesor");}
     else	$c->add(RolPeer::NOMBRE, "alumno");

     $rol = RolPeer::doSelectOne($c);
     $id_rol = $rol->getId();

     $con = Propel::getConnection();
     try {
    				$con->begin();
  	  			$c = new Criteria();
     				$c->add(Rel_usuario_paquetePeer::ID_PAQUETE,$idmodulo);
     				$c->add(Rel_usuario_paquetePeer::ID_USUARIO,$idusuario);

     				$res = Rel_usuario_paquetePeer::doDelete($c,$con);
  			    $cursos= $modulo->getCursos();

     				foreach ($cursos as  $curso) {
     						    $c = new Criteria();
     				        $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$curso->getCurso()->getId());
     				        $c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO,$idusuario);
     				        $c->add(Rel_usuario_rol_cursoPeer::ID_ROL,$id_rol);
     				        Rel_usuario_rol_cursoPeer::doDelete($c,$con);
     					}

         		$administradores= $this->getUser()->getAdministradores();
            foreach ($administradores as $administrador)
            {  $notificacion = new Notificacion();
               $notificacion->setInfo($administrador->getId(),null,'Eliminado '.$usuario->getNombreusuario().' de m&oacute;dulo','Eliminado usuario '.$usuario->getNombre().' '.$usuario->getApellidos().'('.$usuario->getNombreusuario().') del m&oacute;dulo '.$modulo->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
            }
  				 $con->commit();
  			 }
    	catch (Exception $e) {	$con->rollback(); throw $e; }

     $rol = $this->getRequestParameter('rol');
     $this->redirect('admin/listaModulos?idusuario='.$idusuario.'&rol='.$rol);
  }

  // Nombre del metodo: AniadirCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Aniade curso */
  public function executeAniadirCurso()
  {
   $idusuario = $this->getRequestParameter('idusuario');
   $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
   $this->forward404Unless($this->usuario);

   $this->rol = $this->getRequestParameter('rol');
   $c = new Criteria();

	 if ("profesor"==$this->rol) { $c->add(RolPeer::NOMBRE, "profesor"); } else	$c->add(RolPeer::NOMBRE, "alumno");

    $rol = RolPeer::doSelectOne($c);
    $id_rol = $rol->getId();

    if ($this->getRequest()->getMethod() == sfRequest::POST) {
          $j=0;
	        $k=0;
	        $cursos=array();
	        $pulsados = $this->getRequestParameter('pulsadosCursos');
	        $total = $this->getRequestParameter('totalCursos');
	        $con = Propel::getConnection();

  			  try {
    			 $con->begin();

	        	for ( $i=0;$i<$total;$i++ ) {
              $micurso = $this->getRequestParameter("cursos$i");

				   		if ( $micurso ) {
				        	$curso= CursoPeer::retrieveByPk($micurso);
							    $this->forward404Unless($curso);
    							$relacion = new Rel_usuario_rol_curso();
    							$relacion->setIdUsuario($idusuario);
    							$relacion->setIdCurso($micurso);
    							$relacion->setIdRol($id_rol);
    							$relacion->save($con);

    							$administradores= $this->getUser()->getAdministradores();
                  foreach ($administradores as $administrador)
                  {  $notificacion = new Notificacion();
                     $notificacion->setInfo($administrador->getId(),$micurso,'A&ntilde;adido '.$this->usuario->getNombreusuario().' a curso','A&ntilde;adido '.$this->rol.' '.$this->usuario->getNombre().' '.$this->usuario->getApellidos().' al curso '.$curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
                  }
					      }
				     }
				     $con->commit();
				  }
  			  catch (Exception $e) { $con->rollback(); throw $e; }

          $this->idusuario=$idusuario;
		      $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
          return;
    } else {
            /* Hay que mostrar el formulario con los cursos que el usuario no tiene con ese rol */
            $cursosAct =  $this->usuario->getCursos();
            $c = new Criteria();

            $criterion1 = $c->getNewCriterion(CursoPeer::NOMBRE, "vacio",Criteria::NOT_EQUAL);
  	        foreach($cursosAct as $cursoActual) {
  	         $criterion2 = $c->getNewCriterion(CursoPeer::ID, $cursoActual->getCurso()->getId(),Criteria::NOT_EQUAL);
  	    	   $criterion1->addAnd($criterion2);
  		      }
  	        $c->add($criterion1);
            $this->cursos = CursoPeer::doSelect($c);
           }
      return;
  }

 // Nombre del metodo: AniadirModulo()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Aniade curso */
  public function executeAniadirModulo()
  {
   $idusuario = $this->getRequestParameter('idusuario');
   $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
   $this->forward404Unless($this->usuario);

   $this->rol = $this->getRequestParameter('rol');
   $c = new Criteria();
   $c->add(RolPeer::NOMBRE, "alumno");
   $rol = RolPeer::doSelectOne($c);
   $id_rol = $rol->getId();

   if ($this->getRequest()->getMethod() == sfRequest::POST) {
          $j=0;
	        $k=0;
	        $pulsados = $this->getRequestParameter('pulsadosModulos');
	        $total = $this->getRequestParameter('totalModulos');

	        $con = Propel::getConnection();
          $this->idusuario=$idusuario;
  		    $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
		      $this->errores ="";

  			  try {
    			  $con->begin();

	        	for ( $i=0;$i<$total;$i++ )
					  {  $mimodulo = $this->getRequestParameter("modulos$i");
				   		 if ( $mimodulo ) {
				        	$modulo= PaquetePeer::retrieveByPk($mimodulo);
							    $this->forward404Unless($modulo);

    							$rel = new Rel_usuario_paquete();
    							$rel->setIdUsuario($idusuario);
    							$rel->setIdPaquete($mimodulo);
    							$rel->save($con);

    							$cursos = $modulo->getCursos();
    							foreach( $cursos as $curso) {
    							  	$c = new Criteria();
       								$c->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
       								$c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso->getCurso()->getId());
       								$result = Rel_usuario_rol_cursoPeer::doSelectOne($c);

       								if (!$result) {
       									$rel = new Rel_usuario_rol_curso();
       									$rel->setIdRol($id_rol);
       									$rel->setIdUsuario($idusuario);
       									$rel->setIdCurso($curso->getCurso()->getId());
       									$rel->save($con);
   								     }else if ($result->getIdRol()!=$id_rol) {
   								   	        $errores=" ERROR no se puede dar de alta en el modulo ".$modulo->getNombre().", en el curso ".$curso->getCurso()->getNombre()." ya tenia rol de ".$result->getRol()->getNombre();
   								   	        $this->errores = $errores;
   								   	        return;
   								           }
                  }
                  $administradores= $this->getUser()->getAdministradores();
                  foreach ($administradores as $administrador)
                  {  $notificacion = new Notificacion();
                     $notificacion->setInfo($administrador->getId(),null,'A&ntilde;adido m&oacute;dulo a '.$this->usuario->getNombreusuario(),'A&ntilde;adido '.$this->usuario->getNombre().' '.$this->usuario->getApellidos().' al m&oacute;dulo '.$modulo->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
                  }
                }
				     }
				     $con->commit();
				  }
  			  catch (Exception $e) {	$con->rollback(); throw $e; }
           return;
      } else {
                /* Hay que mostrar el formulario con los cursos que el usuario no tiene con ese rol */
        	   	  $modulosAct =  $this->usuario->getPaquetes();
        	   	  if (count($modulosAct)>0) {
                     $c = new Criteria();
                     $criterion1 = $c->getNewCriterion(PaquetePeer::ID, $modulosAct[0]->getPaquete()->getId(),Criteria::NOT_EQUAL);
                     array_shift ($modulosAct);

        	           foreach($modulosAct as $moduloActual) {
        	             $criterion2 = $c->getNewCriterion(PaquetePeer::ID, $moduloActual->getPaquete()->getId(),Criteria::NOT_EQUAL);
        	    	       $criterion1->addAnd($criterion2);
        		         }
                      $c->add($criterion1);
        	            $this->modulos =    PaquetePeer::doSelect($c);
        	       } else { $aux = new Paquete();
        			            $this->modulos = $aux->getTodosPaquetes();
        	               }
                }
      return;
  }

  // Nombre del metodo: executeListaCursosModulo()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra los cursos de un modulo */
  public function executeListaCursosModulo()
  {
      $idmodulo = $this->getRequestParameter('idmodulo');
      $this->modulo = PaquetePeer::retrieveByPk($idmodulo);
	    $this->forward404Unless($this->modulo);
      $this->cursos= $this->modulo->getCursos();
  }

  // Nombre del metodo: executeMoroso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: cambia el estado de moroso a No moroso y viceversa */
  public function executeMoroso()
  {
     $idusuario = $this->getRequestParameter('idusuario');
     $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
     $this->forward404Unless($this->usuario);

     $idcurso = $this->getRequestParameter('idcurso');
     $this->curso = CursoPeer::retrieveByPk($idcurso);
     $this->forward404Unless($this->curso);

    if ($this->getRequestParameter('moroso')) {
     	 $moroso = $this->getRequestParameter('moroso');
    }else $this->redirect('admin/listaCursos?idusuario='.$idusuario.'&rol=alumno');

    $con = Propel::getConnection();
   	try {
    		$con->begin();

     		 if ($moroso == 'no') {
  		   	   $this->usuario->setMoroso( $this->usuario->getMoroso() - 1 );
  		   	   $this->usuario->save($con);

   			     $c = new Criteria();
             $c->add(RolPeer::NOMBRE, "alumno");
     			   $rol = RolPeer::doSelectOne($c);
     			   $id_rol = $rol->getId();

  			     $c2 = new Criteria();
      		   $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
      		   $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$idcurso);

  			     $resul = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
  			     $resul->setIdRol($id_rol);
  			     $resul->save($con);

  		   	   $administradores= $this->getUser()->getAdministradores();
             foreach ($administradores as $administrador)
      	            {  $notificacion = new Notificacion();
          	           $notificacion->setInfo($administrador->getId(),$idcurso,'Reanudado el acceso '.$this->usuario->getNombreusuario(),'Reanudado el acceso a '.$this->usuario->getNombre().' '.$this->usuario->getApellidos().' en el curso '.$this->curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
          	        }
     			}else { if ($moroso == 'si') {
  			            $this->usuario->setMoroso( $this->usuario->getMoroso() + 1 );
     			          $this->usuario->save($con);

  			            $c = new Criteria();
                    $c->add(RolPeer::NOMBRE, "moroso");
     					      $rol = RolPeer::doSelectOne($c);
     					      $id_rol = $rol->getId();

  					        $c2 = new Criteria();
      				      $c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
      				      $c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$idcurso);

  					        $resul = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
  					        $resul->setIdRol($id_rol);
  					        $resul->save($con);

  					        $administradores= $this->getUser()->getAdministradores();
                     foreach ($administradores as $administrador)
              	            {  $notificacion = new Notificacion();
                  	           $notificacion->setInfo($administrador->getId(),$idcurso,'Prohibido el acceso '.$this->usuario->getNombreusuario(),'Prohibido el acceso a '.$this->usuario->getNombre().' '.$this->usuario->getApellidos().' en el curso '.$this->curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
                  	        }
                  }
  				     }
     		 $con->commit();
		}
    catch (Exception $e) {	$con->rollback(); throw $e; }
    $this->redirect('admin/listaCursos?idusuario='.$idusuario.'&rol=alumno');
  }

  // Nombre del metodo: executeMorosoModulo()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: cambia el estado de moroso a No moroso y viceversa de un usuario en un modulo */
  public function executeMorosoModulo()
  {
     $idusuario = $this->getRequestParameter('idusuario');
     $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
     $this->forward404Unless($this->usuario);

     $idmodulo = $this->getRequestParameter('idmodulo');
     $this->paquete = PaquetePeer::retrieveByPk($idmodulo);
     $this->forward404Unless($this->paquete);
     if ($this->getRequestParameter('moroso'))
     {
     	 $moroso = $this->getRequestParameter('moroso');
     }else $this->redirect('admin/listaModulos?idusuario='.$idusuario.'&rol=alumno');

     $con = Propel::getConnection();
     try {
      	$con->begin();
     		$c2 = new Criteria();
        $c2->add(Rel_paquete_cursoPeer::ID_PAQUETE, $idmodulo);
        $rels = Rel_paquete_cursoPeer::doSelect($c2);
        $numCursos = Rel_paquete_cursoPeer::doCount($c2);

     		if ($moroso == 'no') {
  		   	   $this->usuario->setMoroso( $this->usuario->getMoroso() - $numCursos );
  		   	   $this->usuario->save($con);

  		   	   $c = new Criteria();
             $c->add(RolPeer::NOMBRE, "alumno");
     			   $rol = RolPeer::doSelectOne($c);
     			   $id_rol = $rol->getId();

             foreach($rels as $rel) {
             		$c2 = new Criteria();
      		   		$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
      		   		$c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$rel->getIdCurso());

  			   		  $resul = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
  			  		  $resul->setIdRol($id_rol);
  			   		  $resul->save($con);
             }
            $administradores= $this->getUser()->getAdministradores();
             foreach ($administradores as $administrador)
      	            {  $notificacion = new Notificacion();
          	           $notificacion->setInfo($administrador->getId(),null,'Reanudado el acceso a '.$this->usuario->getNombreusuario(),'Reanudado el acceso a '.$this->usuario->getNombre().' '.$this->usuario->getApellidos().' en el m&oacute;dulo '.$this->paquete->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
          	        }
        } else {  if ($moroso == 'si') {
  			        	$this->usuario->setMoroso( $this->usuario->getMoroso() + $numCursos );
  		   	   			$this->usuario->save($con);

  				        $c = new Criteria();
      	          $c->add(RolPeer::NOMBRE, "moroso");
     						  $rol = RolPeer::doSelectOne($c);
     						  $id_rol = $rol->getId();

  						    foreach($rels as $rel) {
                 			$c2 = new Criteria();
      		   					$c2->add(Rel_usuario_rol_cursoPeer::ID_USUARIO, $idusuario);
      		   					$c2->add(Rel_usuario_rol_cursoPeer::ID_CURSO,$rel->getIdCurso());

  			   					  $resul = Rel_usuario_rol_cursoPeer::doSelectOne($c2);
  			  					  $resul->setIdRol($id_rol);
  			   					  $resul->save($con);
                  }
                  $administradores= $this->getUser()->getAdministradores();
                  foreach ($administradores as $administrador)
      	            {  $notificacion = new Notificacion();
          	           $notificacion->setInfo($administrador->getId(),null,'Prohibido el acceso a '.$this->usuario->getNombreusuario(),'Prohibido el acceso a '.$this->usuario->getNombre().' '.$this->usuario->getApellidos().' en el m&oacute;dulo '.$this->paquete->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>',date("Y-m-d H:j"));
          	        }
                }
  			     }
     		$con->commit();
     }
     catch (Exception $e) {	$con->rollback(); throw $e; }
     $this->redirect('admin/listaModulos?idusuario='.$idusuario.'&rol=alumno');
   }

  // Nombre del metodo: executeBuscar()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Busca usuarios
   */
  public function executeBuscar()
  {
     $this->rol = $this->getRequestParameter('rol');
     $this->modificar_ejericicio = $this->getRequestParameter('edita-ejercicio',false);
     if ($this->getRequest()->getMethod() == sfRequest::POST) {
        $tipo = $this->getRequestParameter('tipo');
        $c = new Criteria();

        if ($this->rol) {
          if ($this->rol=="profesor") {
             $c->add(RolPeer::NOMBRE, "profesor");
           }else $c->add(RolPeer::NOMBRE, "alumno");
           $rol = RolPeer::doSelectOne($c);
           $id_rol = $rol->getId();
        }
        $c = new Criteria();
  			$c2 = new Criteria();

  			if ($this->getRequestParameter('usuario')) {
  				$criterion = $c->getNewCriterion(UsuarioPeer::NOMBREUSUARIO,"%".$this->getRequestParameter('usuario')."%",Criteria::LIKE);
  			}
  			if ($this->getRequestParameter('dni')) {
  				if (!isset($criterion)) {
  				      $criterion = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
  				}else { $criterionAux = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
  				    		if ("Or"==$tipo[0]) {
  				         	 $criterion->addOr($criterionAux);
  				        }else  $criterion->addAnd($criterionAux);
  			         }
        }
  			if ($this->getRequestParameter('nombre')) {
  				if (!isset($criterion)) {
  				      $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
  				}else { $criterionAux = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
  						    if ("Or"==$tipo[0]) {
  				         	 $criterion->addOr($criterionAux);
  				        }else  $criterion->addAnd($criterionAux);
  			        }
  			}
  			if ($this->getRequestParameter('apellidos')) {
  			  if (!isset($criterion)) {
  				      $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
  				}else { $criterionAux = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
  				    		if ("Or"==$tipo[0]) {
  				         	 $criterion->addOr($criterionAux);
  				        }else  $criterion->addAnd($criterionAux);
  			        }
  			}
  			 if ($this->getRequestParameter('email')) {
  				if (!isset($criterion)) {
  				      $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
  				}else { $criterionAux = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
  				    		if ("Or"==$tipo[0]) {
  				         	 $criterion->addOr($criterionAux);
  				        }else  $criterion->addAnd($criterionAux);
  			         }
  			}
  			 if (isset($criterion)) { 	 $c2->add($criterion);      }

  			 if ($this->rol) {
           $c2->addGroupByColumn(Rel_usuario_rol_cursoPeer::ID_USUARIO);
           $c2->add(Rel_usuario_rol_cursoPeer::ID_ROL,$id_rol);
           $this->usuarios = Rel_usuario_rol_cursoPeer::doSelectJoinUsuario($c2);
          } else  $this->usuarios = UsuarioPeer::doSelect($c2);

  			 $this->mostrarForm='No'; // para que en el template no vuelva ha salir el formulario
  			 return;
     }
     return;
  }

/**
 * This function creates recursive directories if it doesn't already exist
 *
 * @param String  The path that should be created
 * @return  void
 */
function create_dirs($path)
{
  if (!is_dir($path)) {
    $directory_path = "";
    $directories = explode("/",$path);
    $count = 0;
    array_pop($directories);

    foreach($directories as $directory) {
      $directory_path .= $directory."/";

      if (! @is_dir($directory_path)) {
        @mkdir($directory_path); @chmod($directory_path, 0777);
      }
      $count++;
    }
    if (!$count) {
      $directories = explode('\\', $path);
      array_pop($directories);

      foreach($directories as $directory) {
        $directory_path .= $directory."/";

        if (! @is_dir($directory_path)) {
          @mkdir($directory_path); @chmod($directory_path, 0777);
        }
        $count++;
      }
    }
  }
}

function unzip($src_file, $dest_dir=false, $create_zip_name_dir=true, $overwrite=true)
{
  if ($zip = zip_open($src_file)) {
    if ($zip) {
      $splitter = ($create_zip_name_dir === true) ? "." : "/";
      if ($dest_dir === false) $dest_dir = substr($src_file, 0, strrpos($src_file, $splitter))."/";

      // Create the directories to the destination dir if they don't already exist
      self::create_dirs($dest_dir);
      // For every file in the zip-packet
      while ($zip_entry = zip_read($zip)) {
        // Now we're going to create the directories in the destination directories
        // If the file is not in the root dir
        $pos_last_slash = strrpos(zip_entry_name($zip_entry), "/");

        if ($pos_last_slash !== false) {
          // Create the directory where the zip-entry should be saved (with a "/" at the end)
          self::create_dirs($dest_dir.substr(zip_entry_name($zip_entry), 0, $pos_last_slash+1));
        }
        if (zip_entry_open($zip,$zip_entry,"r")) {
          // The name of the file to save on the disk
          $file_name = $dest_dir.zip_entry_name($zip_entry);

          // Check if the files should be overwritten or not
          if ($overwrite === true || $overwrite === false && !is_file($file_name)) {
            // Get the content of the zip entry
            $fstream = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            @file_put_contents($file_name, $fstream );
            $extension = strtolower(substr($file_name, -3));

            if ($extension == 'php') {
              @unlink($file_name);
            } else {
              chmod($file_name, 0777);
            }
          }
          zip_entry_close($zip_entry);
        }
      }
      zip_close($zip);
    }
  } else {
    return false;
  }
  return true;
}

  // Nombre del metodo: executeEditMateria()
  // Creada por: Angel Martin
  // Descripcion: crea/edita una materia
  public function executeEditMateria()
  {
    $id = $this->getRequestParameter('idmateria');

    if ($id) {
      $materia = MateriaPeer::RetrieveByPk($id);
      $tipo= 'Modificaci&oacute;n';
    } else {
      $materia = new Materia();
      $tipo = 'Creaci&oacute;n';
    }
    $this->materia = $materia;

    $errores = array();
    $errores['materia'] = '';
    $errores['width'] = '';
    $errores['height'] = '';
    $errores['my_file'] = '';
    $errores['scorm'] = '';

    // Si se ha hecho submit procesamos el formulario
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
      $nombremateria = $this->getRequestParameter('materia');
      $height = $this->getRequestParameter('height');
      $width = $this->getRequestParameter('width');
      $informacion = $this->getRequestParameter('informacion');
      $normativa = $this->getRequestParameter('normativa');
      $file = $this->getRequest()->getFileName('my_file');
      $nerrores = 0;

      if (!$nombremateria) {
        $errores['materia'] .= '&uarr; Debe indicar el nombre de la materia &uarr;<br>'; $nerrores++;
      }
      if (!$height) {
        $errores['height'] .= '&uarr; Debe proporcionar la altura de la ventana donde se visualizar&aacute; el contenido del curso &uarr;<br>'; $nerrores++;
      }
      if (!is_numeric($height)) {
        $errores['height'] .= '&uarr; La altura debe ser un n&uacute;mero &uarr;<br>'; $nerrores++;
      }
      if (!$width) {
        $errores['width'] .= '&uarr; Debe proporcionar la anchura de la ventana donde se visualizar&aacute; el contenido del curso &uarr;<br>'; $nerrores++;
      }
      if (!is_numeric($width)) {
        $errores['width'] .= '&uarr; La anchura debe ser un n&uacute;mero &uarr;<br>'; $nerrores++;
      }
      if (($file) && (".zip"!=substr($file,strlen($file)-4, 4))) {
        $errores['my_file'] .= '&uarr; El fichero con el contenido del curso debe ser un comprimido en formato zip &uarr;<br>'; $nerrores++;
      }
      if (!$nerrores) {
        // Iniciamos los parametros para transacciones seguras con la base de datos
        $con = Propel::getConnection();
        $fallo_bbdd = 0;

        try {
          $con->begin();
          $materia->setTemasTotales($this->numeroTemas);
          $materia->setNombre($nombremateria);
          $materia->setHeight($height);
          $materia->setWidth($width);
          $materia->setInformacion($informacion);
          $materia->setNormativa($normativa);
          $materia->setTemasTotales(0);
          if (!$id) {$materia->setTipo('vacia');}
          $materia->save($con);

          $administradores = $this->getUser()->getAdministradores();
	        foreach ($administradores as $administrador) {
            $notificacion = new Notificacion();
	          $notificacion->setInfo($administrador->getId(),null,$tipo.' materia',$tipo.' materia: <b>'.$materia->getNombre().'</b> por '.$this->getUser()->getAdministrador()->getNombreusuario(),date("Y-m-d H:j"));
	        }
          $con->commit();
        }
        catch (Exception $e) {
          $con->rollback();
          $fallo_bbdd = 1;
          throw $e;
        }
        $id = $materia->getId();

         ## process zip file (if applicable)
          $folderTempZip = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR;
          $mayProcessZip = is_readable($_FILES['my_file']['tmp_name']) || is_readable($folderTempZip.$ftp_file) ? true : false;

          if ((!$fallo_bbdd) && $mayProcessZip) {
          // Si la consulta se realizo con exito y se subio un fichero... borramos los temas anteriores
          $c = new Criteria();
          $c->add(TemaPeer::ID_MATERIA, $id);
          TemaPeer::DoDelete($c);

          // Borramos los objetos SCO anteriores registrados en la plataforma (cuidado !!)
          if (!$this->hasRequestParameter('conservarcontenido')) {
          $c = new Criteria();
          $c->add(Sco12Peer::ID_MATERIA, $materia->getId());
          Sco12Peer::DoDelete($c);
          }
          $whereToUnzip = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'materias'.DIRECTORY_SEPARATOR.$materia->getId().DIRECTORY_SEPARATOR;
          $materia->deleteContenido($whereToUnzip);

          if ($_FILES['my_file']['size'] > 0) { // --------------- upload zip
          $zipFile = $folderTempZip.$materia->getId().'.zip';
          if (file_exists($zipFile)) { unlink($zipFile) ; }
          copy($_FILES['my_file']['tmp_name'], $zipFile);
          } else { // -------------------------------------------- select from list
          $zipFile = $folderTempZip.$ftp_file;
          }
          $zip = zip_open($zipFile);

          if ($zip) {
          $result = self::unzip($zipFile, $whereToUnzip, true, true);
          $scorm = false;
          $compo = false;
          $ficheros = array();

          while ($zip_entry = zip_read($zip)) {
          $entrada = zip_entry_name($zip_entry);

          $extension = substr($entrada, -4);
          if (($extension == '.htm') || ($extension == 'html')) {$ficheros[] = $entrada;}
          if ($entrada == 'imsmanifest.xml') {$scorm = true;}
          if ($entrada == 'Content/Projects/Res/project.xml') {$compo = true;}
          }
          zip_close($zip);
          @unlink($zipFile);

            // Procesamiento de objetos SCO tanto para cursos SCORM como para Composica
            if ($scorm) {
              $scormh = new scormManifestHandler();
              $scormh->initialize($whereToUnzip, $materia->getId());
              if ($scormh->getLastError()) {$errores['scorm'] = 'El curso esta en formato SCORM pero contiene alg&uacute;n error y no se pudo cargar'; return;}
              $scormh->loadScos();
              if ($scormh->getLastError() > 50) {$errores['scorm'] = 'El curso esta en formato SCORM pero contiene alg&uacute;n error y no se pudo cargar'; return;}
            }
            // Procesamiento cursos solo scorm (temas)
            if ((!$compo) && $scorm) {
              $cs = new Criteria();
              $cs->add(Sco12Peer::ID_MATERIA, $materia->getId());
              $cs->addAscendingOrderByColumn(Sco12Peer::ID);
              $scs = Sco12Peer::DoSelect($cs);

              $zindex = 1;
              foreach ($scs as $sc) {
                $tema = new Tema();
                $tema->setIdMateria($materia->getId());
                $tema->setNombre($sc->getTitle());
                $tema->setNumeroTema($zindex);
                $tema->save();
                $zindex++;
              }
            }
            // Procesamiento cursos composica
            if ($compo && $scorm) {
              
              $materia->setTipo('compo');
              $materia->save();

              $ruta = $whereToUnzip.'Content/Projects/Res/project.xml';
              $xml = simplexml_load_file($ruta);
              $capitulos = $xml->structure;
              $indice = 1;

              $chapter = $capitulos->chapter?$capitulos->chapter:$capitulos->page;
              
              foreach ($chapter as $capitulo) {
                $titulo = (string)$capitulo['title'];
                $tema = new Tema();
                $tema->setIdMateria($id);
                $tema->setNombre($titulo);
                $tema->setNumeroTema($indice);
                $tema->save();
                $indice++;
              }
            }
            // Procesamiento cursos scorm
            if ($scorm && !$compo) {
              $materia->setTipo('scorm'.$scormh->getScormVersion());
              $materia->save();
            }
            // Procesamiento cursos no scorm
            if (!$scorm && !$compo) {
              $materia->setTipo('segmentada');
              $materia->save();
            }
          } else {
            $errores['fichero'] = 'La materia se cre&oacute; correctamente pero el fichero zip proporcionado no es v&aacute;lido. Vuelva a intentarlo con otro fichero para a&ntilde;adir el contenido te&oacute;rico de la materia. '; $nerrores++;
          }
        }
      } // Cierre del if !nerrores
    } // Cierre if (request=post...)
    $this->materia = $materia;

    if (($materia->getTipo() == 'compo') || ($materia->getTipo() == 'segmentada')) {
      $c = new Criteria();
      $c->add(TemaPeer::ID_MATERIA, $id);
      $c->addAscendingOrderByColumn(TemaPeer::NUMERO_TEMA);
      $this->temas = TemaPeer::DoSelect($c);
      $this->ntemas = TemaPeer::DoCount($c);
    }
    if ($materia->getTipo() == 'scorm1.2') {
      $c = new Criteria();
      $c->add(Sco12Peer::ID_MATERIA, $materia->getId());
      $c->addAscendingOrderByColumn(Sco12Peer::ID);
      $this->scos = Sco12Peer::DoSelect($c);
      $this->ntemas = Sco12Peer::DoCount($c);
    }
    $this->errores = $errores;
  }

  // Nombre del metodo: executeContenidoMateria()
  // Creada por: Angel Martin
  // Descripcion: En caso de contenidos segmentados (no scorm) esta funcion explora la estructura de directorios de la materia
  // y encuentra las paginas que podran ser usadas como indice de cada tema
  public function executeContenidoMateria()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST) {
      $maxtemas = $this->getRequestParameter('maxtemas');
      $id_materia = $this->getRequestParameter('idmateria');

      // Borramos la asignacion de temas anterior
      $c = new Criteria();
      $c->add(TemaPeer::ID_MATERIA, $id_materia);
      TemaPeer::DoDelete($c);

      for ($index = 0; $index < $maxtemas; $index++) {
        $nombre = $this->getRequestParameter("nombretema$index");
        $fichero = $this->getRequestParameter("selecttema$index");

        if (($nombre) && ($fichero)) {
          $tema = new Tema();
          $tema->setIdMateria($id_materia);
          $tema->setNombre($nombre);
          $tema->setNumeroTema($index + 1);
          $tema->setFichero($fichero);
          $tema->save();
        }
      }
      $this->redirect('admin/editMateria?idmateria='.$id_materia);
    } else
    // Llegamos a esta pagina desde la ficha de la materia
    {
      $id = $this->getRequestParameter('idmateria');
      $materia = MateriaPeer::RetrieveByPk($id);

      $c = new Criteria();
      $c->add(TemaPeer::ID_MATERIA, $id);

      if (TemaPeer::DoCount($c)) {
        $this->display_warning = true;
      } else {
        $this->display_warning = false;
      }
      $this->materia = $materia;
      $ruta = sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.'materias'.DIRECTORY_SEPARATOR.$materia->getId();

      $directorios = array();
      $resultados = array();
      $nerrores = 0;
      $ruta_length = strlen($ruta) + 1;

      // Inicializamos la lista de directorios con el directorio inicial
      $directorios[] = $ruta;
      $ndirectorios = 1;
      $index = 0;

      // Recorremos la estructura de directorios donde esta almacenado el curso
      // para encontrar los ficheros .htm y .html
      while ($ndirectorios) {
        $directorio = $directorios[$index];
        $ndirectorios--;
        $index++;

        if ($gestor = opendir($directorio)) {
          $ruta_actual = $directorio.DIRECTORY_SEPARATOR;

          while (false !== ($archivo = readdir($gestor))) {
            if (($archivo == '.') || ($archivo == '..')) {
              continue;
            }
            $ruta_archivo = $ruta_actual.$archivo;

            if (is_dir($ruta_archivo)) {
              $directorios[] = $ruta_archivo;
              $ndirectorios++;
              continue;
            }
            $extension = substr($archivo, -4);

            if (('html'==$extension) || ('.htm'==$extension)) {
              $resultados[] = substr($ruta_archivo, $ruta_length);
            }
          }// Cierre del while anidado
        } else {
          $nerrores++; break;
        }
      } // Cierre del while principal
      $this->resultados = $resultados;
    }
  }

  private function procesarDirectorio( $path,$dir,$materiaId )
  {
    if (is_dir($path.DIRECTORY_SEPARATOR.$dir)) {
      $dirAux=$path.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR;
      $dirAux2=$path.DIRECTORY_SEPARATOR.$dir;

      if ($gd = opendir( $dirAux)) {
          while (($archivo = readdir($gd)) !== false) {
              if  ( (filetype($dirAux . $archivo)=='dir') && ($archivo!='.') && ($archivo!='..') ) {
                 if (-1==self::procesarDirectorio( $dirAux2,$archivo,$materiaId))
                 {return(-1);}
              }else{ if  (filetype($dirAux . $archivo)=='file')
                     { $exte = split( "[.]", $archivo );
                       if (count($exte)>0) {
                          $extension= $exte[count($exte)-1];

                          if ( ('html'==$extension) || ('htm'==$extension) || ('php'==$extension) || (ereg('php[[:digit:]]',$extension) )) {
                             $fp= @fopen($dirAux.substr($archivo,0,strlen($archivo)-strlen($extension))."tmp", "w");
                             $cabecera="<? \$idmateria= $materiaId;if (\$_GET['sid']) {  session_id(strip_tags(\$_GET['sid']));}   session_start(); \$sid=session_id();    if (!\$_SESSION['materia'.\$idmateria])   {     die();    }?>";

                             if (fwrite($fp, $cabecera) === FALSE) {
                                return(-1);
                             }
                             $fp2= @fopen($dirAux.$archivo, "r");
                             $bufer="";

                             while (!feof($fp2)) {
                                 $bufer .= fgets($fp2, 8192);
                             }
                                 $patron = "/(<.*=.*\.)(html|htm)(.*>)/iU";
                                 $reemplazo = "\\1php\\3"; //cambiamos las extensiones de los enlaces de html o htm a php
                                 $bufer=preg_replace($patron, $reemplazo, $bufer);

                                 $php = array("<?","<?php");
                                 $bufer = str_replace($php, "&lt;", $bufer); //si hay codigo php se anula

                                 $patron = "/(<script\s*language=\s*)(\"|')(\s*php\s*)(\"|')(.*>)/iU";
                                 $reemplazo = "&lt?";
                                 $bufer=preg_replace($patron, $reemplazo, $bufer);

                                 $php = array("?>");
                                 $bufer = str_replace($php, "&gt;", $bufer); //si hay codigo php se anula

                                 $patron = "/(<frame)([^.]*)(src=)(\")([^\"]*)(\")(.*>)/iU"; //en los frames hay qpasar el sid para no perder la sesion
                                 $reemplazo = "\\1\\2\\3\\4\\5?sid=<?echo \$sid?>\\6\\7";
                                 $bufer=preg_replace($patron, $reemplazo, $bufer);

                                 $patron = "/(<frame)([^.]*)(src=)(\')([^\']*)(\')(.*>)/iU";
                                 $bufer=preg_replace($patron, $reemplazo, $bufer);

                                 $patron = "/(<iframe)([^.]*)(src=)(\')([^\']*)(\')(.*>)/iU"; //en los iframes hay qpasar el sid para no perder la sesion
                                 $bufer=preg_replace($patron, $reemplazo, $bufer);

                                 $patron = "/(<iframe)([^.]*)(src=)(\')([^\']*)(\')(.*>)/iU";
                                 $bufer=preg_replace($patron, $reemplazo, $bufer);

                                 if (fwrite($fp, $bufer) === FALSE) { return(-1); }

                             fclose ($fp2);
                             fclose($fp);
                             unlink($dirAux.$archivo);

                             $nombreFich= substr($archivo,0,strlen($archivo)-strlen($extension))."tmp";
                             $nombreFich2= substr($archivo,0,strlen($archivo)-strlen($extension))."php";

                             if (file_exists($dirAux.$nombreFich2)) {
                               unlink($dirAux.$nombreFich2);
                             }
                             rename($dirAux.$nombreFich, $dirAux.$nombreFich2 );
                         }
                       }
                     }
                   }
          }
          closedir($gd);
      }
    }
  }

  // Nombre del metodo: eliminarMateria()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Elimina una materia, tanto de la base de datos, como los ficheros */
  public function executeEliminarMateria()
  {
   $idmateria = $this->getRequestParameter('idmateria');
   $this->materia = MateriaPeer::retrieveByPk($idmateria);
   $this->forward404Unless($this->materia);

   if ( (!$this->materia->tieneCursos()) && (!$this->materia->tieneEjercicios())) {
      $this->materia->deleteContenido();
      $administradores= $this->getUser()->getAdministradores();

      foreach ($administradores as $administrador)
      {  $notificacion = new Notificacion();
         $notificacion->setInfo($administrador->getId(),null,'Materia borrada','Materia borrada: <b>'.$this->materia->getNombre().'</b> por '.$this->getUser()->getAdministrador()->getNombreusuario(),date("Y-m-d H:j"));
      }
   	  $this->materia->delete();
   	  $this->redirect('admin/materias');
   }else {
           $this->cursos = $this->materia->getCursos();
           if ($this->getRequestParameter('conf')) {
              //confirmacion de borrar todos los cursos y sus alumnos
              $con = Propel::getConnection();
              $trans=1;
               try {
    			       $con->begin();

    			      $administradores= $this->getUser()->getAdministradores();
      	        foreach ($administradores as $administrador)
      	            {  $notificacion = new Notificacion();
          	           $notificacion->setInfo($administrador->getId(),null,'Materia borrada','Materia borrada: <b>'.$this->materia->getNombre().'</b> por '.$this->getUser()->getAdministrador()->getNombreusuario(),date("Y-m-d H:j"));
          	        }
                 $this->materia->deleteCursos();
                 $this->materia->delete($con);
    			       $con->commit();
                }
  			       catch (Exception $e)
  				      {	$con->rollback();
  				        $trans=0;
    				      throw $e;
  				      }
  			        if (1==$trans)
                 {$this->materia->deleteContenido();}
                $this->redirect('admin/materias');
           }
        }
  }

  // Nombre del metodo: executeMatricular()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Permite matricular a un usuario en un curso tanto de profesor como de alumno */
  public function executeMatricular()
  {
    $idusuario = $this->getRequestParameter('idusuario');
    $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
    $this->forward404Unless($this->usuario);

    $opciones = array();
    $opciones['alumno'] = 'Alumno';
    $opciones['profesor'] = 'Profesor';
    $this->opciones = $opciones;

    $opciones2 = array();
    $opciones2['curso'] = 'Curso';
    $opciones2['modulo'] = 'Modulo';
    $this->opciones2 = $opciones2;
  }

  // Nombre del metodo: executeFichaCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra la ficha del curso, lo hace mediante un componente en el template */
  public function executeFichaCurso()
  {
      if ($this->getRequestParameter('info')) {
        $this->info =  '0';
      }
      $this->idcurso = $this->getRequestParameter('idcurso');
      $this->curso = CursoPeer::retrieveByPk($this->idcurso);
	    $this->forward404Unless($this->curso);
  }

  public function executeFichaModulo()
  {
      if ($this->getRequestParameter('info')) {
        $this->info =  '0';
      }
      $this->idmodulo = $this->getRequestParameter('idmodulo');
      $this->modulo = PaquetePeer::retrieveByPk($this->idmodulo);
	    $this->forward404Unless($this->modulo);
  }

  // Nombre del metodo: executeFichaCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra la ficha del curso, lo hace mediante un componente en el template */
  public function executeInicializarEjercicios()
  {
      if ($this->getRequestParameter('idcurso')) {
        $curso = CursoPeer::retrieveByPk($this->getRequestParameter('idcurso'));
        $this->forward404Unless($curso);
        $materia= $curso->getMateria();
        $con = Propel::getConnection();

      	try {
    		   $con->begin();
    		   $c1 = new Criteria();
   	       $c1->add(EjercicioPeer::ID_MATERIA, $materia->getId() );

          	// update set
          	$c2 = new Criteria();
          	$c2->add(EjercicioPeer::PUBLICADO, 0);
          	$c2->add(EjercicioPeer::SOLUCION, 0);

          	BasePeer::doUpdate($c1, $c2, $con);
            $con->commit();
         } catch (Exception $e) {	$con->rollback(); throw $e; }
      }
      $this->redirect('admin/cursos');
  }

  // Nombre del metodo: executeEliminarNotificacion()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Elimina notificacion */
  public function executeEliminarNotificacion()
  {
    $id = $this->getRequestParameter('idnotificacion');
    $notificacion = NotificacionPeer::retrieveByPk($id);
    $this->forward404Unless($notificacion);

    $notificacion->delete();

    $this->redirect('admin/index');
  }

  // Nombre del metodo: executeEliminarNotificaciones()
  // Añadida por: Angel Martin Latasa
  /* Descripcion: Elimina las notificaciones seleccionadas */
  public function executeEliminarNotificaciones()
  {
    $total = $this->getRequestParameter('total_notificaciones');

    for($i = 0; $i < $total; $i++) {
      if ($this->hasRequestParameter("checkn$i")) {
        $id = $this->getRequestParameter("checkn$i");
        $notificacion = NotificacionPeer::retrieveByPk($id);
        $notificacion->delete();
      }
    }
    $this->redirect('admin/index');
  }

  public function executeEditarEjercicioAlumno()
  {
      $id_usuario = $this->getRequestParameter('idusuario');
      $id_curso = $this->getRequestParameter('idcurso');
      $id_ejercicio = $this->getRequestParameter('idejercicio');
      $id_materia = $this->getRequestParameter('filtro');

      if($id_usuario && $id_curso && $id_materia && $id_ejercicio)
      {
          $this->usuario = UsuarioPeer::retrieveByPK($id_usuario);
          $this->curso = CursoPeer::retrieveByPK($id_curso);
          $this->ejercicio = EjercicioPeer::retrieveByPK($id_ejercicio);

          $this->arrayEstado = array('1'=>'Realizado', 2=>'No Realizado');
          $this->estado = 2;
          $this->nota = 0;
          $this->tiempo = 0;

          $c = new Criteria();
          $c->add(Ejercicio_resueltoPeer::ID_AUTOR, $id_usuario);
          $c->add(Ejercicio_resueltoPeer::ID_EJERCICIO, $id_ejercicio);
          $ejercicio_resuelto = Ejercicio_resueltoPeer::doSelectOne($c);

          if($ejercicio_resuelto)
          {
              $this->estado = $ejercicio_resuelto->getIdCorrector()?1:2;
              $this->nota = $ejercicio_resuelto->getScore();
              $this->tiempo = $ejercicio_resuelto->getTiempo();
          }

          if($this->getRequest()->getMethod() == sfRequest::POST)
          {
              $this->estado = $this->getRequestParameter('estado');
              $this->nota = $this->getRequestParameter('nota');
              $this->tiempo = $this->getRequestParameter('tiempo');

              if(!$ejercicio_resuelto){
                  
                    $ejercicio_resuelto = new Ejercicio_resuelto();
                    $ejercicio_resuelto->setIdAutor($id_usuario);
                    $ejercicio_resuelto->setIdEjercicio($id_ejercicio);
                    $ejercicio_resuelto->setAciertos(1);
                    $ejercicio_resuelto->setIdCurso($id_curso);
              }

              if($this->estado==1)
              {
                $ejercicio_resuelto->setIdCorrector($this->ejercicio->getIdAutor());
              }
              elseif($this->estado!=1)
              {
                $ejercicio_resuelto->setIdCorrector(null);
              }

              $ejercicio_resuelto->setScore($this->nota);
              $ejercicio_resuelto->setTiempo($this->tiempo);
              $ejercicio_resuelto->save();
              $this->getUser()->setAttribute('notice', 'El ejercicio fue modificado para el alumno');
              $this->redirect('admin/editarEjercicioAlumno?idusuario='.$id_usuario.'&filtro='.$id_materia.'&idcurso='.$id_curso.'&idejercicio='.$id_ejercicio);
          }


          
      }
      else
      {
           $this->redirect('admin/alumnos');
      }    
  }

} // end class