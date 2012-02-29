<?php

class nuevoModuloValidator extends sfValidator
{

  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->setParameter('modulo_error', 'Invalid input');

    $this->getParameterHolder()->add($parameters);

    return true;
  }

  public function execute(&$value, &$error)
  {
    $pulsadosCursos_param = $this->getParameter('pulsadosCursos');
    $pulsadosCursos = $this->getContext()->getRequest()->getParameter($pulsadosCursos_param);

    if ($pulsadosCursos<=0)
    {
      $error = 'Debe indicar los cursos que forman el m&oacute;dulo ';
      return false ;
    }
    return true;
  }
}

