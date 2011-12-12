<?php

class myMensajeValidator extends sfValidator
{

  public function initialize ($context, $parameters = null)
  {
    // Initialize parent
    parent::initialize($context);
 
    // Set default parameters value
    $this->setParameter('spam_error', 'This is spam');
 
    // Set parameters
    $this->getParameterHolder()->add($parameters);
 
    return true;
  }

  public function execute (&$value, &$error)
  {
    if (!$value) {$error = "Debe especificar un curso"; return false;}
    return true;
  }
 

}
