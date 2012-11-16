<?php

/**
 * supervisor actions.
 *
 * @package    edoceo
 * @subpackage supervisor
 * @author     pinika
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class supervisorActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex() { return; }

  public function executeMostrar()
  {  if (!$this->getRequestParameter('tipo'))
      {$this->redirect('supervisor/index');      }
     else{ $this->tipo = $this->getRequestParameter('tipo');       }
  }

  // Nombre del metodo: executeCursos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: muestra la lista de cursos
   */
  public function executeCursos() { return; }

  // Nombre del metodo: executeFichaCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra la ficha del curso, lo hace mediante un componente en el template
   */
  public function executeFichaCurso()
  {
      if ($this->getRequestParameter('info')) {
        $this->info =  '0';
      }
      $this->idcurso = $this->getRequestParameter('idcurso');
      $this->curso = CursoPeer::retrieveByPk($this->idcurso);
	    $this->forward404Unless($this->curso);
  }

  // Nombre del metodo: executeModulos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: muestra la lista de Modulos
   */
  public function executeModulos() { return; }

  // Nombre del metodo: executeFichaCurso()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra la ficha del modulo, lo hace mediante un componente en el template
   */
  public function executeFichaModulo()
  {
      if ($this->getRequestParameter('info'))
      {
        $this->info =  '0';
      }
      $this->idmodulo = $this->getRequestParameter('idmodulo');
      $this->modulo = PaquetePeer::retrieveByPk($this->idmodulo);
	    $this->forward404Unless($this->modulo);
  }


  // Nombre del metodo: executeListaAlumnos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Lista los alumnos de un determinado curso, utiliza un componente de curso
   */
  public function executeListaAlumnos()
  {
    $c = new Criteria();
    $busqueda = 0;

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    // Si venimos de una busqueda...
    {
      $tipo = $this->getRequestParameter('tipo');
      $criterion_array = array();

      if ($this->getRequestParameter('usuario'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBREUSUARIO,"%".$this->getRequestParameter('usuario')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('dni'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('nombre'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('apellidos'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('email'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      // En esta parte se mezclan todas las condiciones segun el criterio AND u OR
      if (sizeof($criterion_array))
      {
        $cref = array_pop($criterion_array);
        if ($tipo == 'Or')
        {
          foreach ($criterion_array as $caux)
          {
            $cref->addOr($caux);
          }
        }
        else
        {
          foreach ($criterion_array as $caux)
          {
            $cref->addAnd($caux);
          }
        }
        $c->add($cref);
      }
      $busqueda = 1;
    }

    if ($this->hasRequestParameter('idcurso'))
    {
      $id_curso = $this->getRequestParameter('idcurso');
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $id_curso);
      $this->curso = CursoPeer::RetrieveByPk($id_curso);
    }
    else
    {
      $this->curso = null;
    }

    $c->add(RolPeer::NOMBRE, 'alumno');
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $c->addGroupByColumn(UsuarioPeer::ID);
    $this->busqueda = $busqueda;
    $this->alumnos = UsuarioPeer::DoSelect($c);
  }

  // Nombre del metodo: executeListaAlumnosModulo()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Lista los alumnos de un determinado modulo, utiliza un componente de curso
   */
  public function executeListaAlumnosModulo()
  {
    $paquete = PaquetePeer::retrieveByPk($this->getRequestParameter('idmodulo'));
    $this->forward404Unless($paquete);
    $busqueda = 0;

    $idmodulo = $this->getRequestParameter('idmodulo');
    $c = new Criteria();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    // Si venimos de una busqueda...
    {
      $tipo = $this->getRequestParameter('tipo');
      $criterion_array = array();

      if ($this->getRequestParameter('usuario'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBREUSUARIO,"%".$this->getRequestParameter('usuario')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('dni'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('nombre'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('apellidos'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('email'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      // En esta parte se mezclan todas las condiciones segun el criterio AND u OR
      if (sizeof($criterion_array))
      {
        $cref = array_pop($criterion_array);
        if ($tipo == 'Or')
        {
          foreach ($criterion_array as $caux)
          {
            $cref->addOr($caux);
          }
        }
        else
        {
          foreach ($criterion_array as $caux)
          {
            $cref->addAnd($caux);
          }
        }
        $c->add($cref);
      }
      $busqueda = 1;
    }


    $c->add(Rel_usuario_paquetePeer::ID_PAQUETE, $idmodulo);
    $c->addJoin(Rel_usuario_paquetePeer::ID_USUARIO, UsuarioPeer::ID);
    $this->alumnos = UsuarioPeer::DoSelect($c);

    $this->idmodulo = $idmodulo;
    $this->modulo = $paquete;
    $this->busqueda = $busqueda;
  }

  // Nombre del metodo: executeListaProfesoresModulo()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Lista los alumnos de un determinado modulo, utiliza un componente de curso
   */
  public function executeListaProfesoresModulo()
  {
     $paquete = PaquetePeer::retrieveByPk($this->getRequestParameter('idmodulo'));
     $this->forward404Unless($paquete);
     $this->cursos= $paquete->getCursos();
   	 return;
  }

  // Nombre del metodo: executeTripartita()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: muestra el template de Tripartita
   */

  public function executeTripartita()
  {
     $this->idcurso = $this->getRequestParameter('idcurso');
     $this->curso = CursoPeer::retrieveByPk($this->idcurso);
     $this->forward404Unless($this->curso);
     $this->setLayout('eventoPopUp');

  	 return;
  }
//
  protected function arreglarNombre($nombre)
  {
    $partes = explode(' ', htmlentities(strtolower($nombre)));
    $resultado = '';

    foreach ($partes as $parte) {
      if (($parte == 'de') || ($parte == 'el') || ($parte == 'la') || ($parte == 'los')  || ($parte == 'las')  || ($parte == 'del')) {
        $resultado .= ' '.$parte;
      } else {
        $resultado .= ' '.ucwords($parte);
      }
    }
    return html_entity_decode($resultado);
  }

  // Nombre del metodo: executeInformeTripartita()
  // Añadida por: angel Martin
  /* Descripcion: genera un PDF con la tripartita
   */
  public function executeInformeTripartita()
  {
    require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'tcpdf'.DIRECTORY_SEPARATOR.'tcpdf.php');
    require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'tcpdf'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'eng.php');

    $idcurso = $this->getRequestParameter('idcurso');
    $curso   = CursoPeer::RetrieveByPk($idcurso);
    $materia = MateriaPeer::RetrieveByPk($curso->getMateriaId());
    $nombre_plataforma = sfConfig::get('app_lms_nombre');

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($nombre_plataforma);
    $pdf->SetTitle("Informe de evaluacion tripartita, ".$curso->getNombre());
    $pdf->SetSubject("Informe de evaluacion tripartita");
    $pdf->SetKeywords("informe evaluacion tripartita ".$curso->getNombre());

    $titulo = html_entity_decode("Informe Fundaci&oacute;n Tripartita", ENT_NOQUOTES, 'UTF-8');
    $pdf->SetHeaderData('../../images/tripartita.jpg', 40, $titulo, $nombre_plataforma."\n".$curso->getNombre());

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont(PDF_FONT_NAME_MAIN, "", 11);

    // ESCRIBIMOS LA TABLA CON LA INFORMACION GENERAL DEL CURSO
    $htmlcontent = '<br /><br /><span style="text-decoration: underline; font-size: 19px; text-align: center;">Informaci&oacute;n general del curso</span><br /><br />';
    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(128,0,0);
		$pdf->SetLineWidth(.3);

    $pdf->SetFont('','B');
    $pdf->SetFillColor(225, 254, 216);
    $pdf->Cell(50, 7, ' Nombre del curso:', 1, 0, 'L', 1);
    $pdf->SetFont('');
    $pdf->Cell(130, 7, ' '.$curso->getNombre(), 1, 0, 'L', 0);
    $pdf->Ln();

    $pdf->SetFont('','B');
    $pdf->Cell(50, 7, html_entity_decode(" Duraci&oacute;n:", ENT_NOQUOTES, 'UTF-8'), 1, 0, 'L', 1);
    $pdf->SetFont('');
    $pdf->Cell(130, 7, ' Del '.$curso->getFechaInicio('d-m-Y').'  al  '.$curso->getFechaFin('d-m-Y'), 1, 0, 'L', 0);
    $pdf->Ln();

    $pdf->SetFont('','B');
    $pdf->Cell(50, 7, ' Horas:', 1, 0, 'L', 1);
    $pdf->SetFont('');
    $pdf->Cell(130, 7, ' '.$curso->getDuracion(), 1, 0, 'L', 0);
    $pdf->Ln();

    $pdf->Cell(180,0,'','T');
    $pdf->Ln();

    // ESCRIBIMOS LA TABLA CON LOS PROFESORES
    $htmlcontent = '<br /><br /><br /><br /><span style="text-decoration: underline; font-size: 19px; text-align: center;">Profesores que lo imparten</span><br /><br />';
    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, 'profesor');
    $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $idcurso);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
    $profesores = UsuarioPeer::DoSelect($c);

    if ($profesores) {
      $pdf->SetFillColor(225, 254, 216);
  		$pdf->SetTextColor(0);
  		$pdf->SetDrawColor(128,0,0);
  		$pdf->SetLineWidth(.3);
  		$pdf->SetFont('','B');

  		$header = array();
      $widths = array();
      $header[] = ' Nombre';
      $header[] = html_entity_decode(" Correo electr&oacute;nico", ENT_NOQUOTES, 'UTF-8');
      $widths[] = 90;
      $widths[] = 90;

  		for($i=0; $i < count($header); $i++) {
  		  $pdf->Cell($widths[$i], 7, $header[$i], 1, 0, 'L', 1);
  		}
  		$pdf->Ln();

  		$pdf->SetFillColor(230,240,255);
  		$pdf->SetTextColor(0);
  		$pdf->SetFont('');
  		$fill = false;

      foreach ($profesores as $profesor) {
        $pdf->Cell($widths[0], 6, ' '.$profesor->getApellidos().', '.$profesor->getNombre(), 'LR', 0, 'L', $fill);
        $pdf->Cell($widths[1], 6, ' '.$profesor->getEmail(), 'LR', 0, 'L', $fill);
        $fill = !$fill;
        $pdf->Ln();
      }
      $pdf->Cell(array_sum($widths),0,'','T');
      $pdf->Ln();
    } else {
      $pdf->Cell(180, 6, '(No hay profesores asignados a este curso)', '', 0, 'C', 0);
      $pdf->Ln();
    }
    $pdf->AddPage();
    $htmlcontent = '<br /><br /><span style="text-decoration: underline; font-size: 19px; text-align: center;">Temario</span><br /><br />';
    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

    // ESCRIBIMOS LA TABLA CON EL TEMARIO
    $pdf->SetFillColor(225, 254, 216);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(128,0,0);
		$pdf->SetLineWidth(.3);
		$pdf->SetFont('','B');

    $c = new Criteria();
    $c->add(TemaPeer::ID_MATERIA, $curso->getMateriaId());
    $c->addAscendingOrderByColumn(TemaPeer::NUMERO_TEMA);

    $temas = TemaPeer::DoSelect($c);

    $pdf->Cell(180, 7, " Temario", 1, 0, 'L', 1);
    $pdf->Ln();

    $pdf->SetFillColor(230,240,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('');
		$fill = false;
		$index = 1;

    foreach ($temas as $tema) {
      if ($materia->getTipo() == 'compo') {
        $pdf->Cell(180, 6, ' '.$tema->getNombre(), 'LR', 0, 'L', $fill);
      } else {
        $pdf->Cell(180, 6, " Tema $index: ".$tema->getNombre(), 'LR', 0, 'L', $fill);
      }
      $pdf->Ln();
      $fill = !$fill;
      $index++;
    }
    $pdf->Cell(180,0,'','T');
    $pdf->Ln();

    // PARTE CON EL INFORME DE LOS ALUMNOS
    $c = new Criteria();
    $c->add(RolPeer::NOMBRE, 'alumno');
    $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $curso->getId());
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_ROL, RolPeer::ID);
    $c->addJoin(Rel_usuario_rol_cursoPeer::ID_USUARIO, UsuarioPeer::ID);
    $alumnos = UsuarioPeer::DoSelect($c);

    $pdf->AddPage('LANDSCAPE');
    $htmlcontent = '<br /><span style="text-decoration: underline; font-size: 19px; text-align: center;">Listado de alumnos del curso</span><br />';
    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

    $pdf->SetFillColor(225, 254, 216);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(128,0,0);
		$pdf->SetLineWidth(.3);
		$pdf->SetFont('', 'B', 9);

    // TAMAÑO MAXIMO = 267  267  267  267  267  267  267  267  267  267  267  267  267  267  267  267
    $pdf->Cell(75, 6, " Nombre", 1, 0, 'L', 1);
    $pdf->Cell(77, 6, "Tiempo dedicado al curso", 1, 0, 'C', 1);
    $pdf->Cell(100, 6, "Ejercicios realizados", 1, 0, 'C', 1);
    $pdf->Cell(15, 6, "Nota", 1, 0, 'C', 1);
    $pdf->Ln();

    $pdf->SetFillColor(230,240,255);
    $pdf->SetFont('', '', 7);
    $fill = false;

    foreach($alumnos as $alumno)
    {
      $nombre_alumno = ' '.$alumno->getApellidos().', '.$alumno->getNombre();
      if (strlen($nombre_alumno) > 60) {$nombre_alumno = substr($nombre_alumno, 0, 57).'...';}

      $pdf->Cell(75, 6, $nombre_alumno, 'LR', 0, 'L', $fill);

      $tteoria     = $alumno->getTiempoTotalTeoria($curso->getId());	
      $tejercicios = $alumno->getTiempoTotalEjercicios($curso->getId());
      $ttotal      = $tteoria + $tejercicios;

      $_cant_en_total   = $alumno->getNumeroEjerciciosCurso($idcurso);
      $_cant_realizados = $alumno->getNumeroEjerciciosCurso($idcurso, true);
      $_val_sumanotas   = $alumno->getSumaNotasRealizados($idcurso);
      $_val_notamedia   = $_cant_realizados > 0 ? $_val_sumanotas / $_cant_realizados : 0;
      $_val_porcentaje  = $_cant_en_total > 0 ? ($_cant_realizados / $_cant_en_total) * 100 : 0;

      $texto_tiempo = sprintf("Teoria: %02dh %02dm       Ejercicios %02dh %0dm         Total: %02dh %02dm", floor($tteoria/3600), (floor($tteoria/60) % 60), floor($tejercicios/3600), (floor($tejercicios/60) % 60), floor($ttotal/3600), (floor($ttotal/60) % 60));

      $pdf->Cell(77, 6, $texto_tiempo, 'LR', 0, 'C', $fill);
      $pdf->Cell(100, 6, "Propuestos: $_cant_en_total      Realizados: $_cant_realizados       Porcentaje: ".number_format($_val_porcentaje,2)."%       Nota media: ".number_format($_val_notamedia,2), 'LR', 0, 'C', $fill);

      $c = new Criteria();
      $c->add(CalificacionesPeer::ID_USUARIO, $alumno->getId());
      $c->add(CalificacionesPeer::ID_CURSO, $idcurso);
      $cal = CalificacionesPeer::DoSelectOne($c);
      if ($cal) {$nota_final = sprintf("%01.2f", $cal->getScore());}
      else {$nota_final = '---';}

      $pdf->Cell(15, 6, $nota_final, 'LR', 0, 'C', $fill);
      $pdf->Ln();
      $fill = !$fill;
    }
    $pdf->Cell(267,0,'','T');
    $pdf->Ln();
    $pdf->Output("evaluacion_tripartita.pdf", "I");

    $this->setLayout(false); return;
  }


  // Nombre del metodo: executeListaProfesores()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Lista los profesores de un curso determinado, si no se le pasa el id del curso muestra todos los profesores
   */

  public function executeListaProfesores()
  {
    $c = new Criteria();
    $busqueda = 0;

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    // Si venimos de una busqueda...
    {
      $tipo = $this->getRequestParameter('tipo');
      $criterion_array = array();

      if ($this->getRequestParameter('usuario'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBREUSUARIO,"%".$this->getRequestParameter('usuario')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('dni'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::DNI,$this->getRequestParameter('dni'));
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('nombre'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::NOMBRE,"%".$this->getRequestParameter('nombre')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('apellidos'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::APELLIDOS,"%".$this->getRequestParameter('apellidos')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      if ($this->getRequestParameter('email'))
      {
        $criterion = $c->getNewCriterion(UsuarioPeer::EMAIL,"%".$this->getRequestParameter('email')."%",Criteria::LIKE);
        $criterion_array[] = $criterion;
      }

      // En esta parte se mezclan todas las condiciones segun el criterio AND u OR
      if (sizeof($criterion_array))
      {
        $cref = array_pop($criterion_array);
        if ($tipo == 'Or')
        {
          foreach ($criterion_array as $caux)
          {
            $cref->addOr($caux);
          }
        }
        else
        {
          foreach ($criterion_array as $caux)
          {
            $cref->addAnd($caux);
          }
        }
        $c->add($cref);
      }
      $busqueda = 1;
    }

    if ($this->hasRequestParameter('idcurso'))
    {
      $id_curso = $this->getRequestParameter('idcurso');
      $c->add(Rel_usuario_rol_cursoPeer::ID_CURSO, $id_curso);
      $this->curso = CursoPeer::RetrieveByPk($id_curso);
    }
    else
    {
      $this->curso = null;
    }

    $c->add(RolPeer::NOMBRE, 'profesor');
    $c->addJoin(RolPeer::ID, Rel_usuario_rol_cursoPeer::ID_ROL);
    $c->addJoin(UsuarioPeer::ID, Rel_usuario_rol_cursoPeer::ID_USUARIO);
    $c->addAscendingOrderByColumn(UsuarioPeer::APELLIDOS);
    $c->addGroupByColumn(UsuarioPeer::ID);
    $this->busqueda = $busqueda;
    $this->profesores = UsuarioPeer::DoSelect($c);
  }

  // Nombre del metodo: executeBuscar()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Busca usuarios en un curso (si se le pasa el id del curso, y si no en todos los cursos)
   */

  public function executeBuscar()
  {
    $this->rol = $this->getRequestParameter('rol');

    if ($this->hasRequestParameter('idcurso'))
    {
      $idcurso = $this->getRequestParameter('idcurso');
      $this->curso = CursoPeer::RetrieveByPk($idcurso);
    }
    else
    {
      $this->curso = null;
    }
  }

  // Nombre del metodo: executeListaCursos()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra los cursos en que esta matriculado un usuario
   */
  public function executeListaCursos()
  {
     $idusuario = $this->getRequestParameter('idusuario');
     $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
	   $this->forward404Unless($this->usuario);

     $this->rol = $this->getRequestParameter('rol');
     if ('profesor'==$this->rol)
     {
      	$this->cursos = $this->usuario->getCursosProfesor();
     }
     else { $cursosNoMoroso = $this->usuario->getCursosAlumno();
            $cursosMoroso = $this->usuario->getCursosMoroso();
            $this->cursos = array_merge($cursosNoMoroso, $cursosMoroso);
		      }
  }

  // Nombre del metodo: executeFichasEvaluacion()
  // Añadida por: Jacobo Chaquet
  /* Descripcion: Muestra las fichas de evaluacion de un curso
   */
  public function executeFichasEvaluacion()
  {
    $this->idcurso = $this->getRequestParameter('idcurso');
    $curso = CursoPeer::retrieveByPk($this->idcurso);
	  $this->forward404Unless($curso);

    $this->alumnos= $curso->getAlumnos();
    $this->setLayout('PopUpEvaluacion');
  }


  // Nombre del metodo: executeListarCursosAlumno()
  // Añadida por: angel Martin Latasa
  /* Descripcion: Muestra los cursos de un alumno
   */

  public function executeListarCursosAlumno()
  {
    $idusuario = $this->getRequestParameter('idusuario');

    if ($this->hasRequestParameter('moroso'))
    {
      $usuario = UsuarioPeer::RetrieveByPk($idusuario);
      $moroso = $this->getRequestParameter('moroso');
      $idcurso = $this->getRequestParameter('idcurso');
      $curso = CursoPeer::RetrieveByPk($idcurso);

      $con = Propel::getConnection();
      try
      {
        $con->begin();

        if ($moroso == 'no')
        {
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
        foreach ($administradores as $administrador)
        {
          $notificacion = new Notificacion();
          $notificacion->setInfo($administrador->getId(),$idcurso,'Reanudado el acceso '.$usuario->getNombreusuario(),'Reanudado el acceso a '.$usuario->getNombre().' '.$usuario->getApellidos().' en el curso '.$curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador().'</b>',date("Y-m-d H:j"));
        }

        }
        else
        {
          if ($moroso == 'si')
          {
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

            foreach ($administradores as $administrador)
            {
              $notificacion = new Notificacion();
              $notificacion->setInfo($administrador->getId(),$idcurso,'Prohibido el acceso '.$usuario->getNombreusuario(),'Prohibido el acceso a '.$usuario->getNombre().' '.$usuario->getApellidos().' en el curso '.$curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador().'</b>',date("Y-m-d H:j"));
            }
          }
        }
        $con->commit();
      }
      catch (Exception $e)
      {
        $con->rollback();
        throw $e;
      }
    }

    if ($this->hasRequestParameter('delcurso'))
    {
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
      foreach ($administradores as $administrador)
      {
        $notificacion = new Notificacion();
        $notificacion->setInfo($administrador->getId(),$idcurso,'Eliminado '.$rol.' '.$usuario->getNombreusuario().' de curso','Eliminado '.$rol.' '.$usuario->getNombre().' '.$usuario->getApellidos().' del curso '.$curso->getNombre().' por administrador <b>'.$this->getUser()->getAdministrador().'</b>',date("Y-m-d H:j"));
      }
    }

    $this->usuario = UsuarioPeer::retrieveByPk($idusuario);
    $this->forward404Unless($this->usuario);

    $cursosNoMoroso = $this->usuario->getCursosAlumno();
    $cursosMoroso = $this->usuario->getCursosMoroso();
    $this->cursos = array_merge($cursosNoMoroso, $cursosMoroso);
  }


  // Nombre del metodo: executeListarCursosProfesor()
  // Añadida por: angel Martin Latasa
  /* Descripcion: Muestra los cursos que imparte un profesor
   */

  public function executeListarCursosProfesor()
  {
    $idusuario = $this->getRequestParameter('id');
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
}
