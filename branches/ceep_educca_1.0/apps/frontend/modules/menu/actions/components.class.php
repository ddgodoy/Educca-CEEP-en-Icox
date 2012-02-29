<?php

class menuComponents extends sfComponents
{
    /**
     * Executes Alumno action
     */
    public function executeDefault()
    {
    }

    public function executeAlumno()
    {
	     $c = new Criteria();
	     $c->add(CursoPeer::ID, $this->getUser()->getCursoMenu());
	     $this->curso = CursoPeer::doSelectOne($c);

	     $usuario = $this->getUser();

	     $this->rol = 'alumno';
      }




    /**
     * Executes Profesor action
     */

    public function executeProfesor()
    {
	     $c = new Criteria();
	     $c->add(CursoPeer::ID, $this->getUser()->getCursoMenu());
	     $this->curso = CursoPeer::doSelectOne($c);

	     $usuario = $this->getUser();

    	 $this->rol = 'profesor';

    }

    /**
     * Executes Supervisor action
     */

    public function executeSupervisor()
    {
    }
     
    /**
     * Executes Administrador action
     */

    public function executeAdministrador()
    {
    }
    
    
    public function executeMoroso()
    {
    }
    
    /**
     * Se ejecuta cuando no conocemos el rol (por ej en el módulo correo)
     */

    public function executeVariable()
    {
      // handle the form submission
      if ($this->getUser()->getCursoMenu()) { //para saber de que materia viene
      	$this->idcurso = $this->getRequestParameter('idcurso');
	     $c = new Criteria();
	     $c->add(CursoPeer::ID, $this->idcurso);
	     $this->curso = CursoPeer::doSelectOne($c);}

	    $usuario = $this->getUser();

	    if ( $usuario->hasCredential('alumno') ) {
	        $this->rol = 'alumno';
	    } else if ($usuario->hasCredential('profesor')) {
	        $this->rol = 'profesor';
      } else if ($usuario->hasCredential('supervisor')) {
	        $this->rol = 'supervisor';
      } else  if ($usuario->hasCredential('administrador')) {
	        $this->rol = 'administrador';
	    } else  if ($usuario->hasCredential('moroso')) {
	        $this->rol = 'moroso';
			} else {   // Llega aqui en la portada comercial cuando un usuario no esta registrado
			    $this->rol = 'noregistrado';
      }
    }

    public function executeExamen()
    {
    }

}
