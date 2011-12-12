<?php

class myLoginValidator extends sfValidator
{
  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->setParameter('login_error', 'Entrada no v&aacute;lida');

    $this->getParameterHolder()->add($parameters);

    return true;
  }



  public function execute(&$value, &$error)
  {
    $password_param = $this->getParameter('password');
    $password = $this->getContext()->getRequest()->getParameter($password_param);

    $login = $value;

    $c = new Criteria();
    $c->add(UsuarioPeer::NOMBREUSUARIO, $login);
    $usuario = UsuarioPeer::doSelectOne($c);

    // nickname exists?
    if ($usuario)
    {
      // password is OK?
      if (sha1($usuario->getSalt().$password) == $usuario->getSha1Password())
      {
        if ($usuario->getConfirmado())
        {
          $this->getContext()->getUser()->signIn($usuario);
          return true;
        }
        else
        {
          $error = "Este usuario todav&iacute;a no ha sido activado por la administraci&oacute;n";
          return false;
        }
      }
    }

    $error = $this->getParameter('login_error');
    return false;
  }




  public function execute2(&$value, &$pwd, &$error)
  {
    $password = $pwd;

    $login = $value;

    $c = new Criteria();
    $c->add(UsuarioPeer::NOMBREUSUARIO, $login);
    $usuario = UsuarioPeer::doSelectOne($c);

    // nickname exists?
    if ($usuario)
    {
      // password is OK?
      if (sha1($usuario->getSalt().$password) == $usuario->getSha1Password())
      {
        //$this->getContext()->getUser()->signIn($usuario);
        return true;
      }
    }

    $error = $this->getParameter('login_error');
    return false;
  }
}
