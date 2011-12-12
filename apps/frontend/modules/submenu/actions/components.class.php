<?php

/**
 * submenu component. Muestra información relevante debajo del menú principal
 * según el módulo en que nos encontremos.
 *
 * @package    edoceo
 * @subpackage submenu
 * @author     Todor Blajev
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class submenuComponents extends sfComponents
{


  public function executeDefault()
  {
  
  }


  public function executeMensajeria()
  {
    $this->user = $this->getUser();
  }


  public function executeCalendario()
  {
    $usuario = $this->getUser();
    if ($this->getRequestParameter('idcurso')) {
      //para saber de que materia viene
      $this->idcurso = $this->getRequestParameter('idcurso');
    }
    if ($this->getRequestParameter('principal')) {
      //para saber si calendario princpal o de un curso (viene del enlace de menu)
      $this->principal = 1;
    } else {
      $this->principal = 0;
    }

	  $this->rol = $usuario->obtenerCredenciales();
  }


  public function executeEjercicio()
  {
    $usuario = $this->getUser();
    $this->rol = $usuario->obtenerCredenciales();
  }


  public function executeTareas()
  {
    $usuario = $this->getUser();
    $this->rol = $usuario->obtenerCredenciales();
  }
  
  
  public function executeEvaluacion()
  {
    $usuario = $this->getUser();
    $this->rol = $usuario->obtenerCredenciales();
  }
  
  
  public function executeSeguimiento()
  {
    $usuario = $this->getUser();
    if ($this->getRequestParameter('idcurso')) {
      //para saber de que materia viene
      $this->idcurso = $this->getRequestParameter('idcurso');
    }
    
    if ($this->getRequestParameter('principal')) {
      //para saber de que materia viene
      $this->principal = $this->getRequestParameter('principal');
    }
    
    $this->rol = $usuario->obtenerCredenciales();
  }
  
  public function executeComercial()
  {
  
  }

}
