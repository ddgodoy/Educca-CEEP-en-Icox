<?php

/**
 * menu_top actions.
 *
 * @package    edoceo
 * @subpackage menu_top
 * @author     Todor Blajev y Santiago Mart�nez de la Riva
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class menu_topComponents extends sfComponents
{
  /**
   * Executes default action
   *
   */

     // Action #1

  public function executeDefault()
  {
      $this->accionActual = $this->getActionName();
  }

  /**
   * Executes Alumno action
   *
   */

     // Action #2

     //Nombre: executeAlumno
     //Descripci�n: recoge la acci�n yl el m�dulo estando en alumno

  public function executeAlumno()
  {
      $this->moduloActual = $this->getModuleName();
      $this->accionActual = $this->getActionName();

  }

  /**
   * Executes Profesor action
   */

     // Action #3

     //Nombre: executeProfesor
     //Descripci�n: recoge la acci�n y el m�dulo estando en profesor

  public function executeProfesor()
  {
      $this->moduloActual = $this->getModuleName();
      $this->accionActual = $this->getActionName();
  }

  /**
   * Executes Supervisor action
   */

     // Action #4

     //Nombre: executeSupervisor
     //Descripci�n: recoge la acci�n y en m�dulo estando en supervisor

  public function executeSupervisor()
  {
      $this->moduloActual = $this->getModuleName();
      $this->accionActual = $this->getActionName();
  }
  
  public function executeAdministrador()
  {
      $this->moduloActual = $this->getModuleName();
      $this->accionActual = $this->getActionName();
  }


  public function executeMoroso()
  {
      $this->moduloActual = $this->getModuleName();
      $this->accionActual = $this->getActionName();
  }
  
  
  public function executeVariable()
    {
      $this->moduloActual = $this->getModuleName();
      $this->accionActual = $this->getActionName();

	    $usuario = $this->getUser();

	    if ( $usuario->hasCredential('alumno') ) {
	        $this->rol = 'alumno';
	    } else if ($usuario->hasCredential('profesor')) {
	        $this->rol = 'profesor';
      } else if ($usuario->hasCredential('supervisor')) {
	        $this->rol = 'supervisor';
      } else if ($usuario->hasCredential('administrador')) {
	        $this->rol = 'administrador';
      } else if ($usuario->hasCredential('moroso')) {
	        $this->rol = 'moroso';
      } else {
          $this->rol = 'noregistrado';
      }
    }

}
