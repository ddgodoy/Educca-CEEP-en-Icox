<?php

class nuevoUsuarioValidator extends sfValidator
{

  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->setParameter('curso_error', 'Invalid input');

    $this->getParameterHolder()->add($parameters);

    return true;
  }

  public function execute(&$value, &$error)
  {
    $pulsadosCursos_param = $this->getParameter('pulsadosCursos');
    $pulsadosCursos = $this->getContext()->getRequest()->getParameter($pulsadosCursos_param);

    $pulsadosPaquetes_param = $this->getParameter('pulsadosPaquetes');
    $pulsadosPaquetes = $this->getContext()->getRequest()->getParameter($pulsadosPaquetes_param);

    $rol_param = $this->getParameter('rol');
    $rol = $this->getContext()->getRequest()->getParameter($rol_param);

    if (('administrador'==$rol) || ('supervisor'==$rol) )
    {
      return true;
    }

    $total = $pulsadosCursos + $pulsadosPaquetes;
    if ($total<=0)
    {
      $error = 'Debe indicar los cursos o modulos a matricularse ';
      return false ;
    }
    return true;
  }
}

