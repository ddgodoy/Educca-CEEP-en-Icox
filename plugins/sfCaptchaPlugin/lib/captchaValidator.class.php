<?php

class captchaValidator extends sfValidator {
  public function execute (&$value, &$error) {
    $g = new Captcha(sfContext::getInstance()->getUser()->getAttribute('captcha'));
    if ($g->verify($value))
      return true;

    $error = $this->getParameter('error', sfConfig::get('app_captcha_error', 'Debe especificar un n�mero de validaci�n'));
    return false;
  }
}
?>