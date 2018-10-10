<?php

/**
 * tripartita actions.
 *
 * @package    edoceo
 * @subpackage tripartita
 * @authors    pinika
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class tripartitaActions extends sfActions
{
//
  public function executeIndex()
  {
		$this->user_id = $this->getRequestParameter('user_id', 0);
		$this->sAction = !empty($this->user_id) ? 'actualizar' : 'crear';
		$this->aPaises = self::getPaises();
		$this->aCursos = self::getCursos();

		## init values
		$this->nombreusuario = ''; $this->error_usuario     = 0;
    $this->dni           = ''; $this->error_dni         = 0;
    $this->nombre        = ''; $this->error_nombre      = 0;
    $this->apellidos     = ''; $this->error_apellidos   = 0;
    $this->email         = ''; $this->error_email       = 0;
    $this->emailstop     = 1;  $this->error_emailstop   = 0;
    $this->telefono1     = ''; $this->error_telefono1   = 0;
    $this->telefono2     = ''; $this->error_telefono2   = 0;
    $this->institucion   = ''; $this->error_institucion = 0;
    $this->departamento  = ''; $this->error_departamento= 0;
    $this->direccion     = ''; $this->error_direccion   = 0;
    $this->cp            = ''; $this->error_cp          = 0;
    $this->ciudad        = ''; $this->error_ciudad      = 0;
    $this->pais          = 73; $this->error_pais        = 0;
    $this->userCursos    = array();

    ## get info from DB
    if ($this->sAction == 'actualizar') {
    	$usuario = self::getObjUsuarioById($this->user_id);
    	
    	$this->nombreusuario = $usuario->getNombreusuario();
	    $this->dni           = $usuario->getDni();
	    $this->nombre        = $usuario->getNombre();
	    $this->apellidos     = $usuario->getApellidos();
	    $this->email         = $usuario->getEmail();
	    $this->emailstop     = $usuario->getEmailstop();
	    $this->telefono1     = $usuario->getTelefono1();
	    $this->telefono2     = $usuario->getTelefono2();
	    $this->institucion   = $usuario->getInstitucion();
	    $this->departamento  = $usuario->getDepartamento();
	    $this->direccion     = $usuario->getDireccion();
	    $this->cp            = $usuario->getCp();
	    $this->ciudad        = $usuario->getCiudad();
	    $this->pais          = $usuario->getPaisId();
	    $this->userCursos    = self::getUserCursosTripartita($this->user_id);
    }
		## rec/update data
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->nombreusuario = $this->getRequestParameter('usuario');
      $this->dni           = $this->getRequestParameter('dni');
      $this->nombre        = $this->getRequestParameter('nombre');
      $this->apellidos     = $this->getRequestParameter('apellidos');
      $this->email         = $this->getRequestParameter('email');
      $this->emailstop     = $this->getRequestParameter('emailstop');
      $this->telefono1     = $this->getRequestParameter('telefono');
      $this->telefono2     = $this->getRequestParameter('telefono2');
      $this->institucion   = $this->getRequestParameter('institucion');
      $this->departamento  = $this->getRequestParameter('departamento');
      $this->direccion     = $this->getRequestParameter('direccion');
      $this->cp            = $this->getRequestParameter('cp');
      $this->ciudad        = $this->getRequestParameter('ciudad');
      $this->pais          = $this->getRequestParameter('pais');
      $this->userCursos    = $this->getRequestParameter('cursos_rel');
      
      ## check empty values
      $may_continue = true;

      if (empty($this->nombreusuario)) { $this->error_usuario = 1; $may_continue = false; }
      if (empty($this->dni))           { $this->error_dni = 1; $may_continue = false; }
      if (empty($this->nombre))        { $this->error_nombre = 1; $may_continue = false; }
      if (empty($this->apellidos))     { $this->error_apellidos = 1; $may_continue = false; }
      if (empty($this->email))         { $this->error_email = 1; $may_continue = false; }
      if (empty($this->telefono1))     { $this->error_telefono1 = 1; $may_continue = false; }
      if (empty($this->direccion))     { $this->error_direccion = 1; $may_continue = false; }
      if (empty($this->cp))            { $this->error_cp = 1; $may_continue = false; }
      if (empty($this->ciudad))        { $this->error_ciudad = 1; $may_continue = false; }

      ## proceed (if no errors)
      if ($may_continue) {
	      $con = Propel::getConnection();
	 	    $pwd = ""; substr($this->nombre,0,3).substr($this->apellidos,0,3).rand(100,999); $this->pwd = $pwd;	

	 	    try {
	        $con->begin();
	
	        $usuario = new Usuario();
	        $usuario->setNombre($this->nombre);
	        $usuario->setApellidos($this->apellidos);
	        $usuario->setNombreusuario($this->nombreusuario);
	        $usuario->setDni($this->dni);
	        $usuario->setEmail($this->email);
	        $usuario->setEmailstop($this->emailstop);
	        $usuario->setTelefono1($this->telefono1);
	        $usuario->setTelefono2($this->telefono2);
	        $usuario->setInstitucion($this->institucion);
	        $usuario->setDepartamento($this->departamento);
	        $usuario->setDireccion($this->direccion);
	        $usuario->setCp($this->cp);
	        $usuario->setCiudad($this->ciudad);
	        $usuario->setPaisId($this->pais);
	        $usuario->setPresencial(0);
	        $usuario->emailUsuario(NULL, 3, 'confirmacion');
	        $usuario->setConfirmado(1);
	        $usuario->save($con);
	
	        ## notificacion administradores
	        $administradores = $this->getUser()->getAdministradores();
	
	        foreach ($administradores as $administrador) {
	          $notificacion = new Notificacion();
	          $notificacion->setInfo(
	          	$administrador->getId(), NULL, 'Nuevo Supervisor Tripartita', 'Nuevo Supervisor Tripartita '.$usuario->getNombre().' '.$usuario->getApellidos().
	          	' creado por administrador <b>'.$this->getUser()->getAdministrador()->getNombreusuario().'</b>', date("Y-m-d H:j"), NULL);
	        }
	        ## relacion supervisor_curso vacio
	        $c = new Criteria(); $c->add(CursoPeer::NOMBRE, "vacio"); $curso = CursoPeer::doSelectOne($c);
	
	        $rel = new Rel_usuario_rol_curso();
	        $rel->setIdCurso($curso->getId());
	        $rel->setIdUsuario($usuario->getId());
	        $rel->setTripartita(1);
	        $rel->setIdRol(3);
	        $rel->save($con);
	
	        ## relacion supervisor cursos seleccionados
	        if (!empty($this->userCursos)) {
	        	## clear table
	        	$cDel = new Criteria();
  					$cDel->add(Rel_tripartita_cursoPeer::ID_USUARIO, $usuario->getId());
  					$oDel = Rel_tripartita_cursoPeer::doselect($cDel);
  					if ($oDel) { $oDel->delete(); }

  					## rec cursos tripartita
  					foreach ($this->userCursos as $rel_curso) {
  						$oRelTrip = new Rel_tripartita_curso();
  						$oRelTrip->setIdUsuario($usuario->getId());
  						$oRelTrip->setIdCurso($rel_curso);
  						$oRelTrip->save();
  					}
	        }
	        $con->commit();

	        ## to list
	        $this->redirect('admin/usuarios?superUsuario=1&tm='.$this->sAction); exit();
	      }
	      catch (Exception $e) { $con->rollback(); throw $e; }
      }
    }
    ## show formulario
  	$this->setTemplate('formulario');
  }
//
  public static function getPaises()
  {
  	$c = new Criteria();
  	$aPaises = array();
    $oPaises = PaisPeer::doselect($c);

    foreach ($oPaises as $pais) {
      $aPaises[$pais->getId()]= $pais->getNombre();
    }
    return $aPaises;
  }
//
  public static function getCursos()
  {
  	$c = new Criteria();
  	$c->add(CursoPeer::NOMBRE, 'vacio', CRITERIA::NOT_LIKE);
  	$c->addAscendingOrderByColumn(CursoPeer::NOMBRE);

  	$aCursos = array();
    $oCursos = CursoPeer::doselect($c);

    foreach ($oCursos as $curso) {
      $aCursos[$curso->getId()]= $curso->getNombre();
    }
    return $aCursos;
  }
//
  public static function getUserCursosTripartita($user_id)
  {
  	$c = new Criteria();
  	$c->add(Rel_tripartita_cursoPeer::ID_USUARIO, $user_id);
  	$c->addJoin(Rel_tripartita_cursoPeer::ID_CURSO, CursoPeer::ID);

  	$aCursos = array();
    $oCursos = Rel_tripartita_cursoPeer::doselect($c);

    foreach ($oCursos as $curso) {
      $aCursos[$curso->getCurso()->getId()]= $curso->getCurso()->getNombre();
    }
    return $aCursos;
  }
//
	public static function getObjUsuarioById($user_id)
	{
		$c = new Criteria();
  	$c->add(UsuarioPeer::ID, $user_id);
  	$usuario = UsuarioPeer::doSelectOne($c);

  	return $usuario;
	}

} // end class